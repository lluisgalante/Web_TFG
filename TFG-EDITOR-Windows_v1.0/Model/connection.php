<?php
function connectDB(): ?PDO
{
    $connection = null;
    $username = "root";
    $password = "";
    try {
        $connection = new PDO('mysql:host=localhost;dbname=webtfg', $username, $password);
        if (mysqli_connect_errno()) {
            echo mysqli_connect_error();
        }
    } catch (PDOException $e) {
        echo 'The connection failed: ' . $e->getMessage() . "\n";
    }
    return $connection;
}
