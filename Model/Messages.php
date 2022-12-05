<?php
function addMessagetoChat(string $incoming_mail, string $outcoming_mail, int $session_id, int $problem_id, string $msg, string $date):bool
{
    try {
        // Create a transaction so if any insertion fails no object will be created
        $connection = connectDB();
        $connection->beginTransaction();


        $statement = $connection->prepare("INSERT INTO messages(incoming_mail_id, outgoing_mail_id, session_id, problem_id, msg, date) 
            VALUES(:incoming_mail_id, :outgoing_mail_id, :session_id, :problem_id, :msg, :date)");
        $statement->execute(array(":incoming_mail_id" => $incoming_mail, ":outgoing_mail_id"=>$outcoming_mail, ":session_id"=>$session_id, ":problem_id"=>$problem_id,":msg" => $msg, ":date"=>$date));
        //$sessionId = $connection->lastInsertId();

        // Commit the changes
        $connection->commit();
        $connection = null;
    } catch (PDOException $e) {
        echo 'Error making the chat: ' . $e->getMessage();
        return false;
    }
    return true;
}
function viewchats(string $incoming_mail, string $outgoing_mail, int $session_id, int $problem_id):array
{
    try{
        $connection = connectDB();

        $statement = $connection->prepare("SELECT msg,date,incoming_mail_id FROM messages WHERE ((outgoing_mail_id=:outgoing_mail_id AND incoming_mail_id=:incoming_mail_id) OR (outgoing_mail_id=:incoming_mail_id AND incoming_mail_id=:outgoing_mail_id)) AND session_id=:session_id AND problem_id=:problem_id");
        $statement->execute(array(":outgoing_mail_id"=> $outgoing_mail, ":incoming_mail_id"=> $incoming_mail, ":session_id"=> $session_id, ":problem_id"=>$problem_id));
        $messages = $statement->fetchAll(PDO::FETCH_ASSOC);

        $connection = null;
    }catch(PDOException $e){
        echo 'Error showing the chats: ' . $e->getMessage();
        return [null];
    }
    return $messages;
}
function viewchatsAsStudent(string $student_mail, int $session_id, int $problem_id):array
{
    try{
        $connection = connectDB();

        $statement = $connection->prepare("SELECT msg, date, incoming_mail_id FROM messages WHERE (incoming_mail_id=:incoming_mail_id OR outgoing_mail_id=:outgoing_mail_id) AND session_id=:session_id AND problem_id=:problem_id");
        $statement->execute(array(":incoming_mail_id"=> $student_mail,":outgoing_mail_id"=> $student_mail, ":session_id"=> $session_id, ":problem_id"=>$problem_id));
        $messages = $statement->fetchAll(PDO::FETCH_ASSOC);

        $connection = null;
    }catch(PDOException $e){
        echo 'Error showing the chats: ' . $e->getMessage();
        return [null];
    }
    return $messages;
}
function getTeacherEmailFromChat(string $student_mail, int $session_id, int $problem_id):string
{
    try{
        $connection = connectDB();

        $statement = $connection->prepare("SELECT outgoing_mail_id FROM messages WHERE incoming_mail_id=:incoming_mail_id AND session_id=:session_id AND problem_id=:problem_id");
        $statement->execute(array(":incoming_mail_id"=> $student_mail, ":session_id"=> $session_id, ":problem_id"=>$problem_id));
        $emails = $statement->fetchAll(PDO::FETCH_ASSOC);
        $teacher_email=$emails[0]['outgoing_mail_id'];

        $connection = null;
    }catch(PDOException $e){
        echo 'Error getting teacher email: ' . $e->getMessage();
    }
    return $teacher_email;
}
function unviwedStudentsChat():array
{
    try{
        $connection = connectDB();

        $statement = $connection->prepare("SELECT outgoing_mail_id FROM messages WHERE viewed=:cero");
        $statement->execute(array(":cero"=>'0'));
        $emails = $statement->fetchAll(PDO::FETCH_ASSOC);

        $cleaned_emails =[];
        foreach ($emails as $e){array_push($cleaned_emails,$e['outgoing_mail_id']);}
        $cleaned_emails = array_unique($cleaned_emails); //Removes duplicate values from an array

    }catch (PDOException $e){
        echo 'Error getting emails of users with unviwed chats by the teacher: ' . $e->getMessage();
    }
    return $cleaned_emails;
}

function changeViewedChatStatus(string $mail1):bool
{
    try{
        $connection = connectDB();
        $statement = $connection->prepare("UPDATE messages SET viewed=:one WHERE outgoing_mail_id=:mail1");
        $statement->execute(array(":one"=>'1', ":mail1"=>$mail1));

    }catch (PDOException $e){
        echo 'Error changing chats viewed status: ' . $e->getMessage();
        return false;
    }
    return true;
}