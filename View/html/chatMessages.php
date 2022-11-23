
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
    <script src="/View/js/editor.js"></script>
    <script src="/View/js/global.js"></script>
</head>
<body  class="d-flex flex-column min-vh-100" <?php echo $_SESSION['theme'] ?> >
<?php include_once(__DIR__ . '/header.php') ?>


<div class="chat-popup" id="myForm">
    <div class="form-container">
    <h1>Chat</h1>
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
            margin-left:900px;
            margin-right:900px;
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
            /*-webkit-appearance: none;
            appearance: none;
            width: 25%;
            margin: 0;
            color: #fff;
            border-left: 0;
            font-family: inherit;
            font-size: 1em;
            transition: 200ms all ease-in;*/
        }
        input[type=text]:hover{
            width: 40%;
        }
        p{
            padding: 12px;
            text-align: center;
        }
        .self{
            background-color: rgba(60, 179, 113, 0.8) !important;
            border-radius: 10px;
        }
        .other{
            background-color: rgba(105, 150, 255, 0.8) !important;
            border-radius: 10px;
        }

    </style>
    <script>
        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
        window.setInterval(refreshMessages,2000);
        function refreshMessages(){
            let outgoing_email= document.getElementById("o_mail").value;
            let incoming_email = document.getElementById("i_mail").value;
            let sessionId = document.getElementById("sessionId").value;
            let problemId = document.getElementById("problem").value;

            $.ajax({
                url: "/Controller/UpdateChatsAjax.php",
                method: "POST",
                data:{
                    outgoing_email: outgoing_email,
                    incoming_email: incoming_email,
                    sessionId: sessionId,
                    problemId: problemId,
                },
                success: function(response) {

                    /*if(jQuery.inArray("Primer mensaje. De Ernest a Lluis",response) !== -1){
                        console.log("Funciona");
                    }else{
                        console.log("No funciona");
                    }*/
                    let messages_aux= JSON.parse(response);
                    let messages= [];
                    for(let i=0; i < messages_aux.length; i++){
                        messages.push(messages_aux[i]['msg']);
                    }
                    console.log(messages);
                    var text = $.trim($('.messages').text());//to remove the leading and trailing whitespace only


                    screenMessages = text.split('\n ');
                    let trim_screenMessages =[];
                    for(let i=0; i < screenMessages.length; i++){
                        trim_screenMessages.push(screenMessages[i].trimStart());
                    }
                    trim_screenMessages.push("PRUEBA");
                    console.log(trim_screenMessages);//Mensajes en la pantalla
                    console.log(messages);//Mensajes en la BD.

                    let difference = trim_screenMessages.filter(x => !messages.includes(x));//https://stackoverflow.com/questions/1187518/how-to-get-the-difference-between-two-arrays-in-javascript
                    console.log(difference);
                },
            })
        }
    </script>

</div>

<?php if (!empty($folder_route)) { ?>
    <p id="folder_route" hidden><?php echo $folder_route ?></p>
<?php } ?>
<?php include_once(__DIR__ . '/footer.html') ?>
</body>