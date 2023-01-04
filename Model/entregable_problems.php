<?php

function createRelationProblemEntregableStudent(int $problemId, int $NIU): bool
{
    try {
        $connection = connectDB();

        $statement = $connection->prepare(
            "INSERT INTO problem_entrgable_student_grade( problem_id, student_NIU, grade )
            VALUES (:problem_id, :student_NIU, :grade)"
        );

        $statement->execute(array(":problem_id" => $problemId, ":student_NIU" => $NIU, ":grade" => 0)
        );

        $connection = null;
    } catch (Exception $e) {
        echo "Error creating the problemEntregable: " . $e->getMessage();
        return false;
    }
    return true;
}
function addGradeToProblemEntregable(int $problemId, int $NIU, int $grade): bool
{
    try {
        $connection = connectDB();
        $statement = "SELECT * FROM problem_entrgable_student_grade WHEREproblem_id=: problem_id AND student_NIU=:student_NIU ";

        $statement->execute(array(":problem_id" => $problemId, ":student_NIU" => $NIU, ":grade" => $grade)
        );
        print($statement);

       /* $statement = $connection->prepare("UPDATE problem_entrgable_student_grade SET grade=:grade WHERE  problem_id=: problem_id AND student_NIU=:student_NIU");


        $statement->execute(array(":problem_id" => $problemId, ":student_NIU" => $NIU, ":grade" => $grade)
        );*/

        $connection = null;
    } catch (Exception $e) {
        echo "Error creating the problem: " . $e->getMessage();
        return false;
    }
    return true;
}