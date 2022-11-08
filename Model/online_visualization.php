<?php
function createStudentSessionRelation(string $email, int $session_id, string $output):bool
{
    $created = false;
    try {
        $connection = connectDB();
        $statement = $connection->prepare(
            "INSERT INTO student_session_online(student_email, session_id, output, number_lines_file, executed_times_count, teacher_executed_times_count) 
            VALUES (:student_email, :session_id, :output, :number_lines_file, :executed_times_count, :teacher_executed_times_count )"
        );

        $statement->execute(array(":student_email" => $email, ":session_id" => $session_id, ":output" => $output,
            ":number_lines_file"=>  "" ,  ":executed_times_count" => 1, ":teacher_executed_times_count"=>0));
        $statement->closeCursor();
        $connection = null;
        $created = true;

    } catch (Exception $e) {
        echo "Student_Session not created: " . $e->getMessage();
    }
    return $created;
}
function getStudentSessionRelation():array
{
    try {
        $connection = connectDB();
        $statement = $connection->prepare("SELECT * FROM student_session_online ");
        $statement->execute();
        $array_result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $connection = null;

    } catch (PDOException $e) {
        echo 'Error geting student_sessions_relation array: ' . $e->getMessage();
    }
    return $array_result;
}
function updateData(string $email, int $session_id, string $output):void
{
    try {
        $connection = connectDB();
        $statement = $connection->prepare("UPDATE student_session_online SET executed_times_count = executed_times_count + 1  WHERE student_email=:student_email and session_id=:session_id");
        $statement->execute(array(":student_email" => $email, ":session_id" => $session_id));

        $statement = $connection->prepare("UPDATE student_session_online SET output =:output WHERE student_email=:student_email and session_id=:session_id");
        $statement->execute(array(":student_email" => $email, ":session_id" => $session_id, ":output"=>$output));
        $statement->closeCursor();
        $connection = null;
    } catch (Exception $e) {
        echo "Student_Session not created: " . $e->getMessage();
    }
}
function teacherUpdatesStudentCode(string $email, int $session_id):void
{
    $connection = connectDB();
    $statement = $connection->prepare("UPDATE student_session_online SET teacher_executed_times_count = teacher_executed_times_count + 1  WHERE student_email=:student_email and session_id=:session_id");
    $statement->execute(array(":student_email" => $email, ":session_id" => $session_id));
}

