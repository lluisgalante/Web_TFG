<?php
session_start();

include_once __DIR__ . "/connection.php";
$connection = connectDB();
$route = $_POST['route'];
$variable = 1;

$statement = $connection->prepare("SELECT * FROM solution WHERE route=:route");
$statement->execute(array(":route" => $route));
$solutions = $statement->fetch(PDO::FETCH_ASSOC);
$connection = null;

echo $solutions['editing'];
