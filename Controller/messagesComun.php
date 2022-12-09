<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/Messages.php";


$outgoing_email = $_SESSION["email"];//teacher
$sessionId = $_GET['session'];
$problemId = $_GET['problem'];

//VIEW CHATS FALTA

$messages= viewComunChats($outgoing_email, $sessionId, $problemId);

//////

include_once __DIR__ . "/../View/html/messagesComun.php";