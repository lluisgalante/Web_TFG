<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/online_visualization.php";

$user_type = $_POST['userType'];// 1 = Student, 0 = teacher.
$session_id = intval($_POST['id']);
$user_email = $_POST['email']; //Este user puede ser tanto el mail del profesor como el del alumno
$output = $_POST['output'];

var_dump($output);
if($user_type == 1) {// STUDENT
    $array_student_sessions = getStudentSessionRelation();
    $exists = false;
    foreach ($array_student_sessions as $array_student_session) {

        if ($array_student_session['student_email'] == $user_email && $array_student_session['session_id'] == $session_id) {
            $exists = true;
        }
    }
    if (!$exists) { //Student-Sesion aun no existe
        createStudentSessionRelation($user_email, $session_id, $output);
    } else {
        updateData($user_email, $session_id, $output);
    }
}
else{ //$user_type == 0 -> El profesor está editando el código de un alunmno guardado en la variable $_POST['usuario_visualizado']

    $mate = $_POST['usuario_visualizado']; //El PROFESOR(0) está ejecutando el código de este alumno.
    teacherUpdatesStudentCode($mate, $session_id, $output);


}
