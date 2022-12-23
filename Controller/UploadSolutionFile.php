<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/constants.php";
include_once __DIR__ . "/../Model/redirectionUtils.php";
include_once __DIR__ . "/../Model/problemsGet.php";
include_once __DIR__ . "/../Model/problemNew.php";
include_once __DIR__ . "/../Model/addFilesToProblem.php";
session_start();

$files = array_filter($_FILES['file']['name']);


$route = str_replace('\\', '/', realpath($_POST['solution_path']));

$problemId = $_POST['problem'];
$rootEdited = filter_var($_POST['root_edited'], FILTER_VALIDATE_BOOLEAN); //De momento no se usa.
$problem = getProblemWithId($problemId);
$subjectId = $problem['subject_id'];

if (basename($route) == "teacherSolution") {/*La ruta para guardar la solucion ya fue creada antes, osea ya han subido algun archivo*/}
else{
    $route = $route . '/teacherSolution';
    mkdir($route, 0777, true);
}

try {
    uploadFiles($route, $_FILES);

} catch (WrongFileExtension | FileTooLarge $e) {
    $_SESSION['error'] = $e->getMessage();
    redirectLocation(query: VIEW_PROBLEMS_LIST, params: array('subject' => $subjectId, 'error' => 1));
    return;
} catch (Exception) {
    $_SESSION['error'] = "Error desconegut";
    redirectLocation(query: VIEW_PROBLEMS_LIST, params: array('subject' => $subjectId, 'error' => 1));
    return;
}

print(addProblemTeacherSolutionRoute($problemId,$route));

$params = array("problem" => $problemId);// OJO Pude dar conflicto si estamos en una sesión.???

if($_POST["query"] == VIEW_EDITOR ) {

   redirectLocation(VIEW_EDITOR, params: $params); //REDIRECCIONA A PROBLEMAS NO A SESIONES.
}
elseif($_POST["query"] == VIEW_PROBLEM_SOLUTION){

   redirectLocation(VIEW_PROBLEM_SOLUTION, params: $params);
}

