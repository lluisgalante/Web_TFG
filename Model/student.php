<?php
function getStudentFullNameByNiu($NIU) : array
{

    try {
        $connection = connectDB();
        $statement = $connection->prepare("SELECT name,surname FROM student WHERE NIU= :NIU");
        $statement->bindParam(":NIU", $NIU);
        $statement->execute();
        $student_full_name = $statement->fetch(PDO::FETCH_ASSOC);
        //$student_full_name = $student_full_name["surname"] . ', ' . $student_full_name["name"];
        $connection = null;
    } catch (PDOException $e) {
        echo 'Error obtaining student full name: ' . $e->getMessage();
    }
    return $student_full_name;
}