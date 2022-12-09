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
    <script src="/View/js/editor2.js"></script>
    <script src="/View/js/global.js"></script>
</head>

<body class="d-flex flex-column min-vh-100" <?php echo $_SESSION['theme'] ?>>
<?php include_once(__DIR__ . '/header.php');?>
<?php if (!empty($folder_route)) { ?>
    <p id="folder_route" hidden><?php echo $folder_route ?></p>
<?php } ?>
<div class="container-fluid">
    <p class="text-center font-weight-bold problem-title"><?php echo $problem["title"] . " - Solució"; ?></p>
</div>

<div id="editor-container" class="container-fluid">
    <p id="programming_language" hidden><?php echo $problem["language"]; ?></p>

    <div class="editor-sub-container">
        <button id="execute" class="btn" onclick="executeCode('<?php echo "{$_SESSION['email']}"?>', <?php if(isset($_GET['session'])){echo $_GET['session'];} else{ ?> '<?php echo "NO"; ?> ' <?php  }?>, <?php echo $_SESSION['user_type']?>, '<?php echo "{$_GET['user']}"?>')" title="Executar">
            <img class="icon" src="/View/images/execute.png" alt="Executar">
        </button>
        <?php if($problem["description"]) { ?>
            <button id="show-description" type="button" class="btn" >
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
        <?php if($problem["description"]) { ?>
            <div class="content"><p><?php echo htmlspecialchars($problem["description"]); ?></p></div>
        <?php } ?>

        <div id="files" class="mt-1"></div>
        <div id="editor" onclick="<?php if(isset($_GET["session"])){ if(getSessionStatus($_GET["session"]) == 'deactivated' && isset($_SESSION['user_type']) && $_SESSION['user_type'] === STUDENT){ echo "disableEdit()";}}?>"></div>
        <div id="notebook"></div>
        <div id="answer"></div>
    </div>
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
<div id="add_file_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Importa o crea un nou fitxer</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="modal-buttons">
                    <form id="2" action="/Controller/UploadSolutionFile.php" method="post" enctype="multipart/form-data">
                        <button type="submit" onclick="receiveFile2()" class="btn" data-dismiss="modal">
                            Importar
                        </button>
                        <input type="hidden" name="query" value="<?php echo $_GET["query"]?>"/>
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
