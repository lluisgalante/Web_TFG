<?php
session_start();
include_once __DIR__ . "/connection.php";

function remove_dir($route) {
    $dir = opendir($route);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            $full = $route . '/' . $file;
            if (is_dir($full)) {
                remove_dir($full);
            } else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    rmdir($route);
}

$connection = connectDB();
$problem_id = $_POST['id'];
try {

    $statement = $connection->prepare("SELECT * FROM problem WHERE id= :problem_id");
    $statement->execute(array(":problem_id" => $problem_id));
    $problem = $statement->fetch(PDO::FETCH_ASSOC);
    print_r("1");
} catch (PDOException $e) {
    echo 'Error deleting the problem 1' . $e->getMessage();
}

try {
    $statement = $connection->prepare('DELETE FROM session_problems WHERE problem_id = :problem_id');
    $statement->execute(array(":problem_id" => $problem_id));
    print_r("2");
} catch (PDOException $e) {
    echo 'Error deleting the problem 2' . $e->getMessage();
}
try {
    print_r($problem_id);
    $statement = $connection->prepare('DELETE FROM problem WHERE id = :problem_id');
    $statement->execute(array(":problem_id" => $problem_id));
    $connection = null;
    print_r("3");
} catch (PDOException $e) {
    echo 'Error deleting the problem 3' . $e->getMessage();
}

$route = $problem['route'];
if (is_dir($problem['route'])) {
    remove_dir($route);
}
