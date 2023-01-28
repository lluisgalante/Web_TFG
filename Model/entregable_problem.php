<?php

function checkIfEntregableStudentRelationExists($problemId, $NIU):bool
{
    try {
        $connection = connectDB();
        $statement = $connection->prepare("SELECT * FROM entregable_student_grade WHERE problem_id= :problem_id AND student_NIU= :student_NIU");
        $statement->execute(array(":problem_id" => $problemId, ":student_NIU" => $NIU));
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $connection = null;

        $exists = count($data)>0? true : false;

    } catch (Exception $e) {
        echo "Error creating EntregableStudentRelation: " . $e->getMessage();
        return false;
    }
    return $exists;
}
function createEntregableStudentRelation(int $problemId, int $NIU): bool
{
    try {

        $connection = connectDB();
        $statement = $connection->prepare("INSERT INTO entregable_student_grade( problem_id, student_NIU, grade) VALUES (:problem_id, :student_NIU, :grade)");
        $statement->execute(array(":problem_id" => $problemId, ":student_NIU" => $NIU, ":grade" => 0));
        $connection = null;

    } catch (Exception $e) {
        echo "Error creating EntregableStudentRelation: " . $e->getMessage();
        return false;
    }
    return true;
}
function updateGradeEntregable(int $problemId, int $NIU, int $grade): bool
{
    try {

        $connection = connectDB();
        $statement = $connection->prepare("UPDATE entregable_student_grade SET grade= :grade WHERE problem_id= :problem_id AND student_NIU= :student_NIU");
        $statement->execute(array(":grade" => $grade, ":problem_id" => $problemId, ":student_NIU" => $NIU));
        $connection = null;

    } catch (Exception $e) {
        echo "Error updating grade: " . $e->getMessage();
        return false;
    }
    return true;
}
function getEntregableData($problemId):array{
    try {

        $connection = connectDB();
        $statement = $connection->prepare("SELECT * FROM entregable_student_grade WHERE problem_id= :problem_id");
        $statement->execute(array(":problem_id" => $problemId));
        $problemData= $statement->fetchAll(PDO::FETCH_ASSOC);
        $connection = null;

    } catch (Exception $e) {
        echo "Error getting problem Users data to create CSV: " . $e->getMessage();
    }
    return $problemData;
}

function getEntregableGrade($NIU, $problemId):int
{
    try {

        $connection = connectDB();
        $statement = $connection->prepare("SELECT grade FROM entregable_student_grade WHERE problem_id= :problem_id AND student_NIU= :student_NIU");
        $statement->execute(array(":problem_id" => $problemId, ":student_NIU" => $NIU));
        $grade = $statement->fetch(PDO::FETCH_ASSOC);
        $connection = null;

    } catch (Exception $e) {
        echo "Error getting student grade: " . $e->getMessage();
        return false;
    }
    if(is_null($grade['grade'])){$grade['grade']=0;}
    return $grade['grade'];
}