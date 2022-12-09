<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/Messages.php";
include_once __DIR__ . "/../Model/login.php";

//TEACHER
$outgoing_email = $_SESSION["email"];//teacher
$incoming_email= $_GET['user'];//student
$sessionId=$_GET['session'];
$problemId = $_GET['problem'];

$messages= viewchats($incoming_email, $outgoing_email, $sessionId, $problemId);

changeViewedChatStatus($incoming_email); //Canviar status de los mesajes de estudiante del qual el profesor este entrando y leyendo su chat. Su status pasará de ser 0 (univewd) a 1(viwed)

$student_data = getName($incoming_email);

include_once __DIR__ . "/../View/html/chatMessages.php";