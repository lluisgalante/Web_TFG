<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/session.php";

$sessionId = $_POST['session_id'];
echo"Estoy en Session Delete";
deleteSession(sessionId: $sessionId);
