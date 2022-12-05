<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/Messages.php";

//The function of this ajax is to provide the list of mails of students who have chats unread by the teacher to the jquery script in html/editor.php.

$unviwed_chats = unviwedStudentsChat(); //Array that keeps mails of students who have chats that the teacher has not read yet.

echo json_encode($unviwed_chats);