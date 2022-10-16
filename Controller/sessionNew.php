<?php
session_start();
include_once __DIR__ . "/../Model/constants.php";
include_once __DIR__ . "/../Model/redirectionUtils.php";
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/professor.php";
include_once __DIR__ . "/../Model/session.php";

$user_type = $_SESSION['user_type'];
if ($user_type != PROFESSOR) {
    redirectLocation();
}

$name = $_POST['name'];
$subjectId = $_POST['subject'];
$problemIds = $_POST['problems'];
$class_group = $_POST['class_group'];

$professorEmail = $_SESSION['email'];
$professor = getProfessor(professorEmail: $professorEmail);
$professorId = $professor['id'];

$sessionId = createSession(name:$name, professorId:$professorId, subjectId: $subjectId, problemIds:$problemIds, class_group: $class_group);
if ($sessionId === 0) {
    redirectLocation();
}

redirectLocation(VIEW_SESSION_PROBLEMS_LIST, array("session" => $sessionId));
