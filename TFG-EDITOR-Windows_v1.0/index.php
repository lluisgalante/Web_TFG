<?php
session_start();
include_once __DIR__ . "/Model/constants.php";
include_once __DIR__ . "/Model/redirectionUtils.php";

$query = $_GET["query"] ?? VIEW_SUBJECT_LIST;

if (isset($_SESSION["email"])) {
    # If the user is a Student the views are restricted
    if ($_SESSION['user_type'] == STUDENT && !in_array($query, STUDENT_VIEWS)) {
        header("Location:/index.php");
    }
} else {
    # If the user is anonymous he can only log in or register
    if (!in_array($query, ANONYMOUS_USER_VIEWS)) {
        header("Location:/index.php?error=1");
    }
}

switch ($query) {
    case VIEW_PROBLEMS_LIST:
        include __DIR__ . "/Controller/lists/problemList.php";
        break;
    case VIEW_LOGIN_FORM:
        include __DIR__ . "/Controller/forms/loginForm.php";
        break;
    case VIEW_REGISTER_FORM:
        include __DIR__ . "/Controller/forms/registerForm.php";
        break;
    case VIEW_PROBLEM_CREATE:
        include __DIR__ . "/Controller/forms/problemNewDiskForm.php";
        break;
    case VIEW_EDITOR:
        include __DIR__ . "/Controller/editor.php";  // TODO
        break;
    case VIEW_SUBJECT_CREATE:
        include __DIR__ . "/Controller/forms/newSubjectForm.php";
        break;
    case VIEW_SOMETHING:
        include __DIR__ . "/Model/zipFolder.php";
        break;
    case VIEW_PROBLEM_EDIT:
        include __DIR__ . "/Controller/forms/problemEditForm.php";
        break;
    case VIEW_SESSION_FORM:
        include __DIR__ . "/Controller/forms/sessionCreationForm.php";
        break;
    case VIEW_SESSION_LIST:
        include __DIR__ . "/Controller/lists/sessionList.php";
        break;
    case VIEW_SESSION_PROBLEMS_LIST:
        include __DIR__ . "/Controller/lists/sessionProblemsList.php";
        break;
    case VIEW_PROBLEM_CREATE_GIT:
        include __DIR__ . "/Controller/forms/problemNewGithubForm.php";
        break;
    default:
        include __DIR__ . "/Controller/lists/subjectList.php";
        break;
}
