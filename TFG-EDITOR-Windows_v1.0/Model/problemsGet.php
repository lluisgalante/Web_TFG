<?php

function getProblemsWithSubject($subject_id): array
{
    $problems = [];
    try {
        $connection = connectDB();
        $statement =
            $connection->prepare("SELECT id, title, visibility FROM problem WHERE subject_id=:subject_id");
        $statement->bindParam(":subject_id", $subject_id);
        $statement->execute();
        $problems = $statement->fetchAll();
        $connection = null;
    } catch (PDOException $e) {
        echo 'Error obtaining the problems of the subject: ' . $e->getMessage();
    }
    return $problems;
}

function getProblemsWithSession(int $session_id): array
{
    $problems = [];
    try {
        $connection = connectDB();
        // Get all the problem ids of the session
        $statement = $connection->prepare("SELECT problem_id FROM session_problems WHERE session_id=:session_id");
        $statement->bindParam(":session_id", $session_id);
        $statement->execute();
        $problem_ids = $statement->fetchAll(PDO::FETCH_COLUMN);

        // Get all the data of the problems
        $statement = $connection->prepare("SELECT id, title FROM problem WHERE id=:problem_id");
        foreach ($problem_ids as $problem_id) {
            $statement->bindParam(":problem_id", $problem_id);
            $statement->execute();
            $problems[] = $statement->fetch(PDO::FETCH_ASSOC);
        }
        $connection = null;
    } catch (PDOException $e) {
        echo 'Error obtaining the problems of the session: ' . $e->getMessage();
    }
    return $problems;
}

function getProblemWithId($problem_id)
{
    $problem = null;
    try {
        $connection = connectDB();
        $statement = $connection->prepare("SELECT * FROM problem WHERE id= :problem_id");
        $statement->execute(array(":problem_id" => $problem_id));
        $problem = $statement->fetch(PDO::FETCH_ASSOC);
        $connection = null;
    } catch (PDOException $e) {
        echo 'Error obtaining the problem: ' . $e->getMessage();
    }
    return $problem;
}

function getSubjects(): array
{
    $subjects = [];
    try {
        $connection = connectDB();
        // Get all the subjects and append add a field to know whether it has active sessions or not
        $statement = $connection->prepare("
            SELECT id, title, course, description, 
                   (SELECT EXISTS(SELECT * from session WHERE subject_id=subject.id)) as has_active_sessions
            FROM subject");
        $statement->execute();
        $subjects = $statement->fetchAll(PDO::FETCH_ASSOC);
        $connection = null;
    } catch (PDOException $e) {
        echo 'Error obtaining the subjects: ' . $e->getMessage();
    }
    return $subjects;
}

function createSolution($problem_route, $problem_id, $subject_id, $user_email) : bool
{
    $created = false;
    try {
        $connection = connectDB();
        $statement = $connection->prepare(
            "INSERT INTO solution(route, problem_id, subject_id, user)
            VALUES (:route, :problem_id, :subject_id, :user_email)"
        );
        
        $statement->execute(array(":route" => $problem_route, ":problem_id" => $problem_id,
            ":subject_id" => $subject_id, ":user_email" => $user_email));
        
        $connection = null;
        $statement->closeCursor();
        $created = true;
    } catch (Exception $e) {
        echo "Error creating the solution: " . $e->getMessage();
    }
    return $created;
}

function getStudentsWithSessionAndProblem(int $session_id, int $problem_id): array
{
    $students = [];
    try {
        $connection = connectDB();
        $statement = $connection->prepare(
            "SELECT solution.user FROM solution 
            JOIN student ON (student.session_id = :session_id AND student.email= solution.user)
            WHERE solution.problem_id= :problem_id"
        );
        $statement->execute(array(":problem_id" => $problem_id, ":session_id" => $session_id));
        $students = $statement->fetchAll(PDO::FETCH_ASSOC);
        $connection = null;
    } catch (PDOException $e) {
        echo 'Error retrieving the students: ' . $e->getMessage();
    }
    return $students;
}

function setSolutionAsEditing($problem_id, $student_email, $editing_before, $editing_after) : void
{
    try {
        $connection = connectDB();
        $statement = $connection->prepare(
            "UPDATE solution SET editing= :editing_after 
            WHERE problem_id= :problem_id and editing = :editing_before and user = :student_email"
        );
        $statement->execute(array(":problem_id" => $problem_id, "editing_after"=> $editing_after,
            ":editing_before" => $editing_before, ":student_email" => $student_email));
        $statement->fetch(PDO::FETCH_ASSOC);

        $connection = null;
    } catch (PDOException $e) {
        echo "Couldn't set the solution as being edited: " . $e->getMessage();
    }
}

function setSolutionAsEdited($problem_id): bool
{
    $result = False;
    try {
        $connection = connectDB();
        $statement = $connection->prepare("UPDATE solution SET edited=1 WHERE problem_id= :problem_id");
        $statement->execute(array(":problem_id" => $problem_id));
        $statement->fetch(PDO::FETCH_ASSOC);
        $connection = null;

        $result = True;
    } catch (PDOException $e) {
        echo 'Error setting the solutions as edited: ' . $e->getMessage();
    }
    return $result;
}

function getSolution($problem_id, $user_email)
{
    $solution = null;
    try {
        $connection = connectDB();
        $statement = $connection->prepare(
            "SELECT * FROM solution WHERE problem_id= :problem_id and user= :user_email"
        );
        $statement->execute(array(":problem_id" => $problem_id, ":user_email" => $user_email));
        $solution = $statement->fetch(PDO::FETCH_ASSOC);
        $connection = null;
    } catch (PDOException $e) {
        echo 'Error retrieving the solution: ' . $e->getMessage();
    }
    return $solution;
}


function unsetSolutionEdited($id, $mail) : bool
{
    $updated = False;
    try {
        $connection = connectDB();
        $statement = $connection->prepare("UPDATE solution SET edited=0 WHERE problem_id= :id and user= :mail");
        $statement->execute(array(":id" => $id, ":mail" => $mail));
        $statement->fetch(PDO::FETCH_ASSOC);
        $connection = null;
        $updated = True;
    } catch (PDOException $e) {

        echo 'Error setting the solution as not edited' . $e->getMessage();
    }
    return $updated;
}


function updateProblem($problem_id, $description, $max_memory_usage, $max_execution_time, $programming_language) : bool
{
    $updated = false;
    try {
        $connection = connectDB();
        $statement = $connection->prepare("UPDATE problem SET description=:description, memory=:max_memory_usage,
                   time=:max_execution_time, language=:programming_language WHERE id= :problem_id");

        $statement->execute(array(':description'=>$description, ':max_memory_usage'=>$max_memory_usage,
            ':max_execution_time'=>$max_execution_time, ':programming_language' => $programming_language,
            ':problem_id'=>$problem_id));
        $statement->fetch();
        $connection = null;

        $updated = true;
    } catch (PDOException $e) {
        echo 'Error updating the problem: ' . $e->getMessage();
    }
    return $updated;
}
