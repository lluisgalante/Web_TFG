<?php
function createSubject($title, $description, $course) : int
{
    $subjectId = -1;
    try {
        $connection = connectDB();

        $statement = $connection->prepare(
            "INSERT INTO subject (title, description, course) VALUES (:title, :description,:course)"
        );
        $statement->execute(array(":title" => $title, ":description" => $description, ":course" => $course));

        $subjectId = $connection->lastInsertId();
        $connection = null;
    } catch (Exception $e) {
        echo "Error creating the subject: " . $e->getMessage();
    }
    return $subjectId;
}

function deleteSubject($subjectId) : bool
{
    try {
        $connection = connectDB();

        $statement = $connection->prepare("DELETE FROM subject WHERE id=:subjectId");
        $statement->execute(array(":subjectId" => $subjectId));

        $deleted = true;
        $connection = null;
    } catch (Exception $e) {
        $deleted = false;
    }
    return $deleted;
}