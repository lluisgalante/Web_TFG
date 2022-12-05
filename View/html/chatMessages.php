
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Editor</title>

    <link rel="shortcut icon" href="/View/images/favicon.png">
    <link rel="stylesheet" href="/View/css/external/w3.css">
    <link rel="stylesheet" href="/View/css/external/bootstrap.min.css">
    <link rel="stylesheet" href="/View/css/external/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="/View/css/external/all.css">
    <link rel="stylesheet" href="/View/css/forms.css"/>
    <link rel="stylesheet" href="/View/css/style.css"/>
    <link rel="stylesheet" href="/View/css/editor.css"/>
    <link rel="stylesheet" href="/View/css/style.css"/>
    <link rel="stylesheet" href="/View/css/chatMessages.css"/>

    <script src="/View/js/external/jquery.min.js"></script>
    <script src="/View/js/external/popper.min.js"></script>
    <script src="/View/js/external/bootstrap.min.js"></script>
    <script src="/View/js/external/bootstrap-toggle.min.js"></script>
    <script src="/View/js/external/all.min.js"></script>
    <script src="/View/js/external/editor/ace.js"></script>
    <script src="/View/js/external/editor/theme-monokai.js"></script>
    <script src="/View/js/chat.js"></script>
    <script src="/View/js/global.js"></script>

</head>
<body  class="d-flex flex-column min-vh-100" <?php echo $_SESSION['theme'] ?> >
<?php include_once(__DIR__ . '/header.php');
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/Messages.php";?>


<div class="chat-popup" id="myForm">
    <div class="form-container">
    <h1>Chat - <?php echo $student_data['name'] . " ". $student_data['surname'] ?></h1><p>Sessió <?php echo $_GET['session']?> - Problema  <?php echo$_GET['problem']?></p>
        <br>
        <div class="messages">
        <?php if(!empty($messages)){
            foreach($messages as $message){?>
                <div class="<?php if($message['incoming_mail_id']==$_SESSION['email']){echo "other"; }else{echo "self";} ?>"><p><?php echo $message['msg']?></p></div>
            <?php }
        }?>
        </div>

        <form action="/Controller/sendMessageTeacher.php" method="POST"">
        <input id = "o_mail" name="o_mail" value="<?php echo $_SESSION["email"]?>" style="display:none">
        <input id ="i_mail" name="i_mail" value="<?php echo $_GET['user']?>" style="display:none">
        <input id ="sessionId" name="sessionId" value="<?php echo $_GET['session']?>" style="display:none">
        <input id ="problem" name="problem" value="<?php echo $_GET['problem']?>" style="display:none">

        <label for="message"></label>
        <div class="form-inline">
            <input  placeholder="Type message.." type="text" id="message" name="message" required><br><br>
            <button type="submit" class="btn" id="submit" >
                <img class="icon" src="/View/images/send.png">
            </button>
        </div>
    </div>

    <style>
        .form-container{
            margin-bottom:20px;
        }
        #submit{
            border:none !important;
            border-radius:50px !important;
            background-color: transparent !important;
        }
        .form-inline{
            display: flex;
            justify-content: center;
        }
        input[type=text] {
            border: 0;
            background-color: white;
            border-radius: 5px;
            padding:10px;
            width: 15%;
            transition: 200ms all ease-in;

        }
        input[type=text]:hover{
            width: 25%;
        }
        p{
            padding: 12px;
            text-align: center;
        }
        .messages{
            margin-left:30%;
            margin-right:30%;
        }
        .self{
            margin-left:40%;
            background-color: rgba(60, 179, 113, 0.8) !important;
            border-radius: 10px;
        }
        .other{
            margin-right:40%;
            background-color: rgba(105, 150, 255, 0.8) !important;
            border-radius: 10px;
        }
    </style>

</div>

<?php if (!empty($folder_route)) { ?>
    <p id="folder_route" hidden><?php echo $folder_route ?></p>
<?php } ?>
<?php include_once(__DIR__ . '/footer.html') ?>
</body>