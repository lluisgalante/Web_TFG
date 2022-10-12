<?php
session_start();
include_once __DIR__ . "/../Model/constants.php";
include_once __DIR__ . "/../Model/redirectionUtils.php";
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";


$description = $_POST['description'];
$max_memory_usage = $_POST['max_memory_usage'];
$max_execution_time = $_POST['max_execution_time'];
$programming_language = $_POST['language'];
$problemId = $_POST["problem"];

updateProblem(problem_id: $problemId,description: $description, max_memory_usage: $max_memory_usage,
    max_execution_time: $max_execution_time, programming_language:$programming_language);

$problem = getProblemWithId($problemId);

redirectLocation(VIEW_PROBLEMS_LIST,
    array('subject' => $problem['subject_id'],
        'updated' => $problemId));
