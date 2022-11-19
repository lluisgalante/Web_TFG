<?php
function addMessagetoChat(string $incoming_mail, string $outcoming_mail, int $session_id, int $problem_id, string $msg):bool
{
    try {
        // Create a transaction so if any insertion fails no object will be created
        $connection = connectDB();
        $connection->beginTransaction();


        $statement = $connection->prepare("INSERT INTO messages(incoming_mail_id, outgoing_mail_id, session_id, problem_id, msg) 
            VALUES(:incoming_mail_id, :outgoing_mail_id, :session_id, :problem_id, :msg)");
        $statement->execute(array(":incoming_mail_id" => $incoming_mail, ":outgoing_mail_id"=>$outcoming_mail, ":session_id"=>$session_id, ":problem_id"=>$problem_id,":msg" => $msg));
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

        $statement = $connection->prepare("SELECT msg FROM messages WHERE outgoing_mail_id=:outgoing_mail_id AND incoming_mail_id=:incoming_mail_id AND session_id=:session_id AND problem_id=:problem_id");
        $statement->execute(array(":outgoing_mail_id"=> $outgoing_mail, ":incoming_mail_id"=> $incoming_mail, ":session_id"=> $session_id, ":problem_id"=>$problem_id));
        $messages = $statement->fetchAll(PDO::FETCH_ASSOC);

        $connection = null;
    }catch(PDOException $e){
        echo 'Error showing the chats: ' . $e->getMessage();
        return [null];
    }
    return $messages;
}