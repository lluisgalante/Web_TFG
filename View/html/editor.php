<?php if (!isset($problem)) {
    redirectLocation();
} ?>
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

<body class="d-flex flex-column min-vh-100" <?php echo $_SESSION['theme'] ?>>
<?php include_once(__DIR__ . '/header.php');
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/Messages.php";?>
<?php if (!empty($folder_route)) { ?>
    <p id="folder_route" hidden><?php echo $folder_route ?></p>
<?php } ?>

<div class="container-fluid">
    <?php if ((!empty($solution)) && ($solution["edited"] == 1)) { ?>
        <div class="alert alert-info " id="edition_msg">
            <p>Vols obtenir els canvis del professor?</p>
            <div class="alert-buttons">
                <button type="button" class="btn" data-toggle="modal" data-target="#get_changes_modal">Si</button>
                <button type="button" class="btn" data-dismiss="alert">No</button>
            </div>
        </div>
    <?php } ?>
    
    <?php if ($_SESSION['user_type'] == PROFESSOR && isset($_GET["edit"])) { ?>
        <p class="alert alert-warning" id="error_msg"><strong> Estas modificant el problema arrel </strong>
    <?php } ?>
    
    <?php if (isset($_GET["uploaded"])) { ?>
        <?php $negation = $_GET["uploaded"]? "": "no"; ?>
            <p class="alert alert-warning"><strong> <?php echo "El problema $negation s'ha pujat a GitHub." ?> </strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </p>
    <?php } ?>
    
    <p class="alert alert-warning" hidden id="root_modified"><strong>El professor està editant </strong></p>
    <p class="alert alert-danger" hidden id="error_msg_libraries"><strong>Les llibreries que s'estàn utilitzant no estàn
            soportades </strong>
        <button id="error_msg_libraries_btn" type="button" class="close">&times;</button>
    </p>
    <p class="text-center font-weight-bold problem-title"><?php echo $problem["title"]; ?></p>
</div>

<div id="editor-container" class="container-fluid">
    <p id="programming_language" hidden><?php echo $problem["language"]; ?></p>

    <div class="editor-sub-container">
        <button id="execute" class="btn" onclick="executeCode('<?php echo "{$_SESSION['email']}"?>', <?php if(isset($_GET['session'])){echo $_GET['session'];} else{ ?> '<?php echo "NO"; ?> ' <?php  }?>, <?php echo $_SESSION['user_type']?>, '<?php echo "{$_GET['user']}"?>')" title="Executar">
            <img class="icon" src="/View/images/execute.png" alt="Executar">
        </button>
        <?php if($problem["description"]) { ?>
            <button id="show-description" type="button" class="btn">
                <img class="icon" src="/View/images/description.png" alt="Descripció">
            </button>
        <?php } ?>
        <button class="btn add-object" data-toggle="modal" data-target="#add_file_modal" title="Afegit fitxer">
            <img class="icon" src="/View/images/file.png" alt="Afegit fitxer">
        </button>
        <button id="github-add-file" class="btn github" data-toggle="modal" data-target="#github-form-modal"
                title="Afegir fitxer desde GitHub">
            <img class="icon" src="/View/images/file.png" alt="Afegir fitxer desde GitHub">
        </button>
        <button id="save" class="btn" onclick="save()" title="Guardar">
            <img class="icon" src="/View/images/save.png" alt="Guardar"/>
        </button>
        <button id="github-upload" class="btn github" data-toggle="modal" data-target="#github-form-modal"
                title="Pujar a GitHub">
            <img class="icon github" src="/View/images/save.png" alt="Pujar a GitHub">
        </button>

        <?php if ($_SESSION['user_type'] == PROFESSOR) { ?>

            <button class="btn add_solution" data-toggle="modal" data-target="#PS" title="Importar Solució">
                <img class="icon" src="/View/images/edit_solution.png" alt="Afegida Solucio">
            </button>
        <?php } ?>

        <?php if($problem["description"]) { ?>
            <div class="content"><p><?php echo htmlspecialchars($problem["description"]); ?></p></div>
        <?php } ?>

        <div id="files" class="mt-1"></div>
        <div id="editor" onclick="<?php if(isset($_GET["session"])){ if(getSessionStatus($_GET["session"]) == 'deactivated' && isset($_SESSION['user_type']) && $_SESSION['user_type'] === STUDENT){ echo "disableEdit()";}}?>"></div>
        <div id="notebook"></div>
        <div id="answer"></div>
    </div>


   <?php if ($_SESSION['user_type'] == STUDENT && isset($_GET['session'])) { ?>
    <div class="messages" style="width:350px">
        <?php if(count(viewchatsAsStudent($_SESSION["email"], $_GET['session'], $_GET['problem']))>0){?><h2 style="text-align: center">Chat</h2><?php }?>
        <br>
        <div class="messages-child">
            <?php if(!empty($messages)){
                foreach($messages as $message){?>
                    <div class="<?php if($message['incoming_mail_id']==$_SESSION['email']){echo "other"; }else{echo "self";} ?>"><p><?php echo $message['msg']?></p></div>
                <?php }
            }?>
        </div>

        <form action="/Controller/sendMessageStudent.php" method="POST"">
        <input id ="o_mail" name="o_mail" value="<?php echo $_SESSION["email"]?>" style="display:none">
        <input id ="sessionId" name="sessionId" value="<?php echo $_GET['session']?>" style="display:none">
        <input id ="problem" name="problem" value="<?php echo $_GET['problem']?>" style="display:none">

        <?php if(count(viewchatsAsStudent($_SESSION["email"], $_GET['session'], $_GET['problem']))>0){?>
        <label for="message"></label>
        <div class="form-inline">
            <input  placeholder="Type message.." type="text" id="message" name="message" required><br><br>
            <button type="submit" class="btn" id="submit" >
                <img class="icon" src="/View/images/send.png">
            </button>
        </div>
        <?php }?>
    </div>
        <script>
            window.setInterval(refreshMessages, 2000);
            function refreshMessages(){
                let outgoing_email= document.getElementById("o_mail").value;
                let sessionId = document.getElementById("sessionId").value;
                let problemId = document.getElementById("problem").value;

                $.ajax({
                    url: "/Controller/UpdateChatsAjaxStudent.php",
                    method: "POST",
                    data:{
                        outgoing_email: outgoing_email,
                        sessionId: sessionId,
                        problemId: problemId,
                    },
                    success: function(response) {
                        let messages_aux= JSON.parse(response);
                        let messages= [];
                        for(let i=0; i < messages_aux.length; i++){
                            messages.push(messages_aux[i]['msg']);
                        }
                        console.log(messages);
                        var text = $.trim($('.messages-child').text());//to remove the leading and trailing whitespace only

                        screenMessages = text.split('\n ');
                        let trim_screenMessages =[];
                        for(let i=0; i < screenMessages.length; i++){
                            trim_screenMessages.push(screenMessages[i].trimStart());
                        }
                        console.log(trim_screenMessages);//Mensajes en la pantalla
                        console.log(messages);//Mensajes en la BD.
                        //messages.push("PRUEBA");
                        let difference = messages.filter(x => !trim_screenMessages.includes(x));//https://stackoverflow.com/questions/1187518/how-to-get-the-difference-between-two-arrays-in-javascript
                        console.log("Difernecias:" + difference);
                        messages_n= [];
                        repeated_messages={};

                        trim_screenMessages_n=[];
                        repeated_trim_screenMessages={};

                        trim_screenMessages.push(difference);

                        if(trim_screenMessages==0 &&difference.length > 0){
                            $('.messages-child').append('<div class="other"><p>\n '+difference+'</p></div>');
                            $('.form-inline').append('<input placeholder="Type message.." type="text" id="message" name="message" required="">');

                        }

                        if(difference.length > 0) {
                            $('.messages-child').append('<div class="other"><p>\n '+difference+'</p></div>');
                        }

                        for(let i = 0; i < messages.length; i++){

                            if(messages_n.includes(messages[i]))
                            {
                                if(Object.keys(repeated_messages).includes(messages[i])){

                                    repeated_messages[messages[i]] = repeated_messages[messages[i]] + 1;
                                }
                                else{
                                    repeated_messages[messages[i]] = 1;
                                }
                            }
                            else{ messages_n.push(messages[i]); }
                        }

                        for(let i = 0; i < trim_screenMessages.length; i++){

                            if(trim_screenMessages_n.includes(trim_screenMessages[i]))
                            {
                                if(Object.keys(repeated_trim_screenMessages).includes(trim_screenMessages[i])){

                                    repeated_trim_screenMessages[trim_screenMessages[i]] = repeated_trim_screenMessages[trim_screenMessages[i]] + 1;

                                }
                                else{
                                    repeated_trim_screenMessages[trim_screenMessages[i]] = 1;
                                }
                            }
                            else{ trim_screenMessages_n.push(trim_screenMessages[i]); }
                        }

                        for (const [key, value] of Object.entries(repeated_messages)) {
                            console.log(key, value);
                            if (Object.keys(repeated_trim_screenMessages).includes(key)){
                                if(repeated_messages[key] === repeated_trim_screenMessages[key]){
                                    //Todo correcto
                                }
                                else if ( repeated_messages[key] >repeated_trim_screenMessages[key]){
                                    $('.messages-child').append('<div class="other"><p>\n '+key+'</p></div>');
                                }
                            }
                            else{
                                //Repetida en la BD, pero no en la Screen
                                console.log("Mensaje repetido: "+ repeated_messages[key]);

                                $('.messages-child').append('<div class="other"><p>\n '+key+'</p></div>');
                            }
                        }
                    },
                })
            }
        </script>
    <style>
        .messages{
            margin:10px;
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
            width:50%;
            transition: 200ms all ease-in;
        }
        input[type=text]:hover{
            width: 70%;
        }
        p{
            padding: 12px;
            text-align: center;
        }
        .self{
            margin-left:20%;
            background-color: rgba(60, 179, 113, 0.8) !important;
            border-radius: 10px;

        }
        .other{
            margin-right:20%;
            background-color: rgba(105, 150, 255, 0.8) !important;
            border-radius: 10px;
        }
    </style>

    <?php } ?>
    <?php if ($_SESSION['user_type'] == PROFESSOR) { ?>
        <div class="students-list">
            <ul>
                <?php if (!empty($students)) { ?>
                    <div class="students-list-header">
                        <?php if (isset($_GET["view-mode"])) { ?>
                            <a class="btn"
                               href="<?php echo"/index.php?query=Editor Problemas&problem=".$_GET['problem']."&session=".$_GET['session']?>">
                                &#8592;
                            </a>
                        <?php } ?>
                        <h4>Estudiants</h4>
                    </div>
                    <?php foreach ($students as $student) { ?>
                        <li <?php echo $_GET['user'] === $student['user']? "class='selected'": "" ?>>
                            <a href="<?php echo "/index.php?query=Editor Problemas&problem=".$_GET['problem']."&view-mode=1&user=".
                                $student["user"]."&session=".$_GET['session'] ?>"
                               class="btn email" id ="btn-eamail"><?php echo $student["user"] ?></a>
                            <a href="<?php echo "/index.php?query=Editor Problemas&problem=".$_GET['problem']."&view-mode=2&user=".
                                $student["user"]."&session=".$_GET['session'] ?>"
                               class="btn view" title="Veure"><i class="fas fa-eye"></i></a>
                            <a href="<?php echo "/index.php?query=Ver chat&problem=".$_GET['problem']."&show-chat=1&user=".
                                $student["user"]."&session=".$_GET['session'] ?>" class = "btn chat"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16"> <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/> </svg></a>
                            <a class = "btn showPro" id ="showPro"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16"> <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/> </svg></a>
                        </li>
                        <h6 class="follow_up_student_info">
                                <li id = "executed_count">Execucions alumne:  <?php echo $student["executed_times_count"]?></li><hr />
                                <li id = "teacher_executed_count">Execucions tutor:  <?php echo$student["teacher_executed_times_count"]?></li><hr />
                                <p>Output: <span class= "extra"> <?php echo $student["output"]?></span></p>
                        </h6>
                    <?php }
                } ?>
            </ul>
        </div>
        <style>
            .follow_up_student_info{
                display:none;
                margin-top: 10px;
                background-color: rgba(130,163,255, 0.5) !important;
                padding: 10px 10px 5px 10px;
                border-radius: 10px;
                font-size: 1rem;
                max-width: 350px;
                min-width: 350px;
            }
            .showPro:hover~#follow_up_student_info{
                display: block;
            }
        </style>
    <script>
        window.setInterval(refreshMessages, 2000);
        function refreshMessages() {
            $.ajax({
                url: "/Controller/updateChatsAjaxRedColor.php",
                method: "POST",
                success: function (response) {
                    let unviwed_chats = JSON.parse(response); // This array keeps the emails of the students that have messages that the teacher has not read yet.
                    for (let i=0; i< unviwed_chats.length; i++){
                        let all_emails = $("*").find("a#btn-eamail.btn.email").text();
                        console.log(all_emails);
                        if(all_emails.search(unviwed_chats[i]) != -1){
                            $('a#btn-eamail.btn.email:contains('+unviwed_chats[i]+')').next().next().find('svg').attr("fill","red");
                        }
                    }
                }
            })
        }
    </script>
    <?php } ?>
</div>

<!--  MODALS -->
<div id="delete_file_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h4 class="modal-title">Estàs segur?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>L'operació serà immediata i sense possibilitat de retorn.</p>
                    <div class="modal-buttons">
                        <button type="button" class="btn" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="button" class="btn" onclick="deleteFile()" data-dismiss="modal">
                            Esborrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- NUEVO Start -->
<div id="PS" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Importa Solució Problema</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="1" action="/Controller/UploadSolutionFile.php" method="post" enctype="multipart/form-data">
                    <button type="submit" onclick="receiveFile1()" class="btn" data-dismiss="modal">
                        Importar
                    </button>
                    <input id="new_file1" type="file" name="file[]" hidden multiple>
                    <input type="hidden" name="solution_path" value="<?php echo $folder_route?? ""; ?>"/>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- NUEVO End -->
<div id="add_file_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Importa o crea un nou fitxer</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="modal-buttons">
                    <form id="2" action="/Controller/addFileFromPC.php" method="post" enctype="multipart/form-data">
                        <button type="submit" onclick="receiveFile2()" class="btn" data-dismiss="modal">
                            Importar
                        </button>
                        <input id="new_file2" type="file" name="file[]" hidden multiple>
                        <input type="hidden" name="solution_path" value="<?php echo $folder_route?? ""; ?>"/>
                    </form>
                    <button type="button" class="btn" onclick="newFile()" data-dismiss="modal">
                        Crear nou
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="get_changes_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h4 class="modal-title">Estàs segur?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>L'operació serà immediata i sense possibilitat de retorn.</p>
                    <div class="modal-buttons">
                        <button type="button" class="btn" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="button" class="btn" id="<?php echo $_GET['problem']; ?>"
                                onclick="acceptChanges(this.id)" data-dismiss="modal">
                            Obtenir canvis
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="github-form-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h4 id="github-from-modal-title" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="github-form" method="post" action="/Controller/githubAddOrUploadFiles.php">
                        <div class="input-container">
                            <input id="repo_link" class="input" type="url" name="repo_link" placeholder=" " required/>
                            <div class="cut"></div>
                            <label for="repo_link" class="placeholder ">Link del repositori GitHub</label>
                        </div>
                        <div class="modal-buttons">
                            <button type="button" class="btn" data-dismiss="modal">
                                Cancelar
                            </button>
                            <input id="github-form-submit-input" class="btn" type="submit"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once(__DIR__ . '/footer.html') ?>
</body>