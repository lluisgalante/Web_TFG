<?php
function createStudentSessionRelation(string $email, int $session_id, string $output, int $problemId, int $problemLines, string $problemQualityInfo):bool
{
    $created = false;
    try {
        $connection = connectDB();
        $statement = $connection->prepare(
            "INSERT INTO student_session_online(student_email, session_id, problem_id, output, number_lines_file, solution_quality, executed_times_count, teacher_executed_times_count) 
            VALUES (:student_email, :session_id, :problem_id, :output, :number_lines_file, :solution_quality, :executed_times_count, :teacher_executed_times_count )"
        );

        $statement->execute(array(":student_email" => $email, ":session_id" => $session_id, ":problem_id" => $problemId, ":output" => $output,
            ":number_lines_file"=> $problemLines,  ":solution_quality" => $problemQualityInfo, ":executed_times_count" => 1, ":teacher_executed_times_count"=> 0));
        $statement->closeCursor();
        $connection = null;
        $created = true;

    } catch (Exception $e) {
        echo "Student_Session not created: " . $e->getMessage();
    }
    return $created;
}
function createStudentSessionRelationNoOutput(string $email, int $session_id, int $problemId, int $problemLines, string $problemQualityInfo):bool
{
    $created = false;
    try {
        $connection = connectDB();
        $statement = $connection->prepare(
            "INSERT INTO student_session_online(student_email, session_id, problem_id, number_lines_file, solution_quality, executed_times_count, teacher_executed_times_count) 
            VALUES (:student_email, :session_id, :problem_id, :number_lines_file, :solution_quality, :executed_times_count, :teacher_executed_times_count )"
        );

        $statement->execute(array(":student_email" => $email, ":session_id" => $session_id, ":problem_id" => $problemId,
            ":number_lines_file"=> $problemLines,  ":solution_quality" => $problemQualityInfo, ":executed_times_count" => 0, ":teacher_executed_times_count"=> 0));
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
function updateData(string $email, int $session_id, string $output, int $problemId, int $problemLines, string $problemQualityInfo):void
{
    try {
        $connection = connectDB();
        $statement = $connection->prepare("UPDATE student_session_online SET executed_times_count = executed_times_count + 1  WHERE student_email=:student_email and session_id=:session_id and problem_id=:problem_id");
        $statement->execute(array(":student_email" => $email, ":session_id" => $session_id, ":problem_id"=>$problemId));

        $statement = $connection->prepare("UPDATE student_session_online SET output =:output, number_lines_file=:number_lines_file, solution_quality=:solution_quality WHERE student_email=:student_email and session_id=:session_id and problem_id=:problem_id");
        $statement->execute(array(":student_email" => $email, ":session_id" => $session_id, ":output"=>$output,":number_lines_file"=> $problemLines, ":solution_quality" => $problemQualityInfo, ":problem_id"=>$problemId));
        $statement->closeCursor();
        $connection = null;
    } catch (Exception $e) {
        echo "Student_Session not created: " . $e->getMessage();
    }
}
function updateDataNoOutput(string $email, int $session_id, int $problemId, int $problemLines, string $problemQualityInfo):void
{
    try {
        $connection = connectDB();
        $statement = $connection->prepare("UPDATE student_session_online SET number_lines_file=:number_lines_file, solution_quality=:solution_quality WHERE student_email=:student_email and session_id=:session_id and problem_id=:problem_id");
        $statement->execute(array(":student_email" => $email, ":session_id" => $session_id,":number_lines_file"=> $problemLines, ":solution_quality" => $problemQualityInfo, ":problem_id"=>$problemId));
        $statement->closeCursor();
        $connection = null;
    } catch (Exception $e) {
        echo "Student_Session not created: " . $e->getMessage();
    }
}
function teacherUpdatesStudentCode(string $email, int $session_id, string $output, int $problemId, int $problemLines, string $problemQualityInfo):void
{
    $connection = connectDB();
    $statement = $connection->prepare("UPDATE student_session_online SET teacher_executed_times_count = teacher_executed_times_count + 1, output = :output, number_lines_file=:number_lines_file, solution_quality=:solution_quality WHERE student_email=:student_email and session_id=:session_id and problem_id=:problem_id");
    $statement->execute(array(":output"=>$output, ":student_email" => $email, ":session_id" => $session_id, ":output"=>$output,":number_lines_file"=> $problemLines, ":solution_quality" => $problemQualityInfo, ":problem_id"=>$problemId));
    $statement->closeCursor();
    $connection = null;
}
function getStudentsSessionExtraData(int $session_id, int $problemId):array
{
    try {
        $connection = connectDB();
        $statement = $connection->prepare("SELECT student_email, output, executed_times_count, teacher_executed_times_count, number_lines_file, solution_quality  FROM student_session_online WHERE session_id=:session_id and problem_id=:problem_id");
        $statement->execute(array(":session_id" => $session_id, ":problem_id" => $problemId));
        $array_result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $connection = null;

    } catch (PDOException $e) {
        echo 'Error en getStudentsSessionExtraData() : ' . $e->getMessage();
    }
    return $array_result;
}