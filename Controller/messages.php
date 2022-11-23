<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/Messages.php";

$outgoing_email = $_SESSION["email"];
$incoming_email= $_GET['user'];
$sessionId=$_GET['session'];
$problemId = $_GET['problem'];

$messages= viewchats($incoming_email, $outgoing_email, $sessionId, $problemId);
//var_dump($messages);

include_once __DIR__ . "/../View/html/chatMessages.php";