<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/redirectionUtils.php";
include_once __DIR__ . "/../Model/session.php";
include_once __DIR__ . "/../Model/dockerUtils.php";
include_once __DIR__ . "/../Model/diskManager.php";
include_once __DIR__ . "/../Model/problemsGet.php";
include_once __DIR__ . "/../Model/constants.php";
include_once __DIR__ . "/../Model/online_visualization.php";
include_once __DIR__ . "/../Model/Messages.php";


# If only the query is set without indicating a problem return to the homepage
if (!isset($_GET["problem"]) || !isset($_SESSION["user_type"])) {
    redirectLocation();
}
$problem_id = $_GET["problem"];
$problem = getProblemWithId($problem_id);
// If a student is trying to access a private problem send him to the front page
if ($problem['visibility'] === 'Private' && isset($_SESSION['user_type']) && $_SESSION['user_type'] === STUDENT) {
    redirectLocation();
}

// Get the session id if it's set
$session_id = null;
if (isset($_GET["session"])) {$session_id = $_GET["session"];}

# The email will be the user's, unless the user is a professor spectating a student
$email = $_SESSION["email"];

if(isset($_GET["session"]) && isset($_SESSION['user_type']) && $_SESSION['user_type'] === STUDENT ){
    $messages = viewchatsAsStudent($email, $_GET['session'], $problem_id );
}

if (isset($_GET["view-mode"]) && isset($_GET["user"])) {
    # If the view_mode doesn't exist redirect to the homepage
    $view_mode = $_GET["view-mode"];
    if (!in_array($view_mode, [VIEW_MODE_EDIT, VIEW_MODE_READ_ONLY])) {
        redirectLocation();
    }

    $email = $_GET["user"];

    if ($view_mode == VIEW_MODE_EDIT) {
        setSolutionAsEditing(problem_id: $problem_id, student_email: $email, editing_before: 0, editing_after: 1);
    }
}
// Start a new jupyter container for the user if it's needed
if ($problem['language'] == 'Notebook') {
    if (isset($_SESSION['containerId'])) {
        $_SESSION['containerUsages'] += 1;
    } else {
        $containerData = runJupyterDocker($_SESSION['email']);
        $_SESSION['containerId'] = $containerData['containerId'];
        $_SESSION['containerPort'] = $containerData['containerPort'];
        $_SESSION['containerUsages'] = 1;
    }
}

# Get the problem files from the machine
$subject = $problem["subject_id"];
$problem_route = $problem["route"];
$cleaned_problem_route = str_replace('\\', '/', realpath(__DIR__ . $problem_route));

# Create the folder for the user if it doesn't already exist
$user_route = "./../app/solucions/$email";
if (!file_exists(__DIR__ . $user_route) && !mkdir(__DIR__ . $user_route)) {
    echo 'Failed to create folder';
}

$user_subject_route = "$user_route/$subject";
if (!file_exists(__DIR__ . $user_subject_route) && !mkdir(__DIR__ . $user_subject_route)) {
    echo 'Failed to create folder';
}

# Create the folder of the problem if it doesn't already exist
$problem_title = $problem["title"];
$user_solution_route = "$user_subject_route/$problem_title";

if (!file_exists(__DIR__ . $user_solution_route)) {
    if (!mkdir(__DIR__ . $user_solution_route)) {
        echo 'Failed to create folder';
        return;
    }
    $cleaned_user_solution_route = str_replace('\\', '/', realpath(__DIR__ . $user_solution_route));
    # Create the files of the problem if the folder was created right now
    $problem_files = getDirectoryFiles($cleaned_problem_route);
    foreach ($problem_files as $file) {
        $origin = $cleaned_problem_route . '/' . $file;
        $destination = $cleaned_user_solution_route . '/' . $file;
        copy($origin, $destination);
    }

    if ($_SESSION['user_type'] == STUDENT) {
        $created = createSolution($cleaned_user_solution_route, $problem_id, $subject, $email);
        if (!$created) {
            echo "Error creating the solution";
            return;
        }
    }
}

$teacher_solution_visibility = getProblemSolutionVisibility($problem_id);
$cleaned_user_solution_route = str_replace('\\', '/', realpath(__DIR__ . $user_solution_route));

// If the professor is editing the root, set the route as the problem route
$folder_route = ($_SESSION['user_type'] == PROFESSOR && isset($_GET["edit"]))?
    $cleaned_problem_route: $cleaned_user_solution_route;

if ($_SESSION['user_type'] == PROFESSOR && !is_null($session_id)) {

    $students = getStudentsWithSessionAndProblem(session_id: $session_id, problem_id: $problem_id);
    if(count($students) > 0) {
        $students_solution_data = getStudentsSessionExtraData($session_id, $problem_id); //student_email, output, executed_times_count, teacher_executed_times_count, number_lines_file, solution_quality

        //print_r($students_solution_data);
        checkAllStudentsRecivedComunMessage($students, $session_id, $problem_id);

        //TESTAR PARA LOS CASOS  EN QUE EL PROBLEMA NO TENGA SOLUCION SUBIDA POR EL PROFESOR.
        $extraData = getProblemExtraData($problem_id);
        $official_solution_quality = $extraData['solution_quality'];
        $official_solution_lines = $extraData['solution_lines'];

        //IMPORTANT to show red color to unread new chats. Only available for Teachers
        $unviwed_chats = unviwedStudentsChat($session_id, $problem_id); //Array that keeps mails of students who have chats that the teacher has not read yet.
        $_students = array();
        foreach ($students as $student) {
            $appears = false;
            foreach ($students_solution_data as $student_solution_data) {

                if ($student['user'] == $student_solution_data['student_email']) {

                    $appears = true;
                    $aux['user'] = $student['user'];
                    $aux['executed_times_count'] = $student_solution_data['executed_times_count'];
                    $aux['teacher_executed_times_count'] = $student_solution_data['teacher_executed_times_count'];

                    if ($official_solution_lines != 0) {
                        $student_lines_percentage = intval((intval($student_solution_data['number_lines_file']) * 100) / $official_solution_lines);
                    }

                    $aux['lines_percentage'] = $student_lines_percentage;
                    $aux['number_lines_file'] = $student_solution_data['number_lines_file'];
                    $aux['solution_quality'] = $student_solution_data['solution_quality'];

                    $aux['output'] = $student_solution_data['output'];
                    array_push($_students, $aux);
                }
            }
            if (!$appears) {
                $aux['user'] = $student['user'];
                $aux['executed_times_count'] = 0;
                $aux['teacher_executed_times_count'] = 0;
                $aux['lines_percentage'] = 0;
                $aux['number_lines_file'] = 0;
                $aux['solution_quality'] = "----";
                $aux['output'] = "";
                array_push($_students, $aux);
            }
        }
    }
}
$solution = getSolution($problem_id, $_SESSION['email']);

include_once __DIR__ . "/../View/html/editor.php";
