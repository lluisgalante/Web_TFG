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
    
    $statement = $connection->prepare('DELETE FROM problem WHERE id = :problem_id');
    $statement->execute(array(":problem_id" => $problem_id));
    $connection = null;
} catch (PDOException $e) {
    echo 'Error deleting the problem' . $e->getMessage();
}

$route = $problem['route'];
if (is_dir($problem['route'])) {
    remove_dir($route);
}
