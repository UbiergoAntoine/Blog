<?php
require('controllers/controller.php');
require('controllers/blog.php');

$request = $_SERVER['REQUEST_URI'];
$controllers = new Controller();
$pathProject = "/AFIP/Blog/Blog";
if(isset($_SESSION["userVerified"]) && $_SESSION["userVerified"] == true) {
    if(isset($_SESSION["userId"])){
        $blogController = new Blog();
    }
    if (isset($_GET['action'])) {
        switch($_GET['action']){
            case "listPosts":
                listPosts();
                unset($_GET["action"]);
            break;
            case "login":
                include './views/indexView.php';
                unset($_GET);
            break;
            case "visitor":
                include './views/indexVisitorView.php';
                unset($_GET);
            break;
            case "logout":
                session_start();
                $_SESSION = array();
                if(isset($_SESSION['status'])) {
                    unset($_SESSION['status']);
                    if(isset($_COOKIE[session_name()]))
                        setcookie(session_name(), '', time() - 1000);
                        session_destroy();
                }
                unset($_GET["action"]);
                header('Location: index.php');
            break;
            case "post":
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    post();
                }
                else {
                    echo 'Erreur : aucun identifiant de billet envoyé';
                }
            break;
            case "viewListArticlesByUser":
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    include './views/ownedArticlesView.php';
                }
            break;
            case "editArticle":
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $controllers->editArticle($_GET["id"]);
                    if(isset($_POST["submit"]) && isset($_REQUEST)){
                        if(isset($_REQUEST["title"]) && isset($_REQUEST["commentaire"])) {
                            if($_FILES["fileToUpload"]["name"] != ""){
                                $target_dir = "./photos/";
                                $target_file = $target_dir . $controllers->generateChar(5). "_" . basename($_FILES["fileToUpload"]["name"]);
                                $uploadOk = 1;
                                if ($_FILES["fileToUpload"]["size"] > 200000) {
                                    echo "Désolé l'image est supérieure à 2Mo !";
                                    $uploadOk = 0;
                                } else {
                                    $uploadOk = 1;
                                }
                                $currentValue = $controllers->model->getArticle($_GET["id"]);
                                $filenameArr = explode("/",$currentValue["Filename"]);
                                $filenameWithChar = end($filenameArr);
                                $filenameWithCharArr = explode("_",$filenameWithChar);
                                $filename = end($filenameWithCharArr);

                                if($_REQUEST["title"] != $currentValue["Titre"] || $_REQUEST["commentaire"] != $currentValue["Commentaire"] || $_FILES["fileToUpload"]["name"] != $filename){

                                    if ($uploadOk == 0) {
                                        echo "Votre fichier ne peut être uploadé.";
                                    } else {
                                        echo "\n Aucune erreur dans le transfert du fichier. <br>";
                                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                            $filename = basename( $_FILES["fileToUpload"]["name"]);
                                            echo "Le fichier ". $filename. " a été copié dans le répertoire photos <br>";
                                            if($controllers->saveArticle(array($target_file, htmlspecialchars($_POST["commentaire"],ENT_QUOTES), htmlspecialchars($_POST["title"], ENT_QUOTES),$_GET['id']))) {
                                                echo "Modification du Post réussi ! <br>";
                                            }
                                        } else {
                                            echo "Désolé nous n'avons pas pu transférer votre fichier.";
                                        }
                                    }
                                } else {
                                    echo "Aucun champs n'a été modifié, veuillez changer un des champs.";
                                }
                            } else {
                                $currentValue = $controllers->model->getArticle($_GET["id"]);
                                if($controllers->saveArticle(array($currentValue["Filename"], htmlspecialchars($_POST["commentaire"],ENT_QUOTES), htmlspecialchars($_POST["title"], ENT_QUOTES),$_GET['id']))) {
                                    echo "Modification du Post réussi ! <br>";
                                }
                            }

                        }
                    }
                }
            break;

            case "deleteArticle":
                if (isset($_GET['idArticle']) && $_GET['idArticle'] > 0) {
                    $controllers->deletePost($_GET['idArticle']);

                }
                else {
                    echo 'Erreur : aucun identifiant de post envoyé';
                }
            break;
            case "confirmDeleteArticle":
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $controllers->confirmDeletePost($_GET['id']);
                }
                else {
                    echo 'Erreur : aucun identifiant de post envoyé';
                }
            break;
            case "createArticle":
                $controllers->createArticle();
                // Validation user create article
                if(isset($_POST["submit"]) && isset($_REQUEST)){
                    if(isset($_REQUEST["title"]) || isset($_REQUEST["commentaire"]) || isset($_FILES["fileToUpload"]["name"])){
                        $target_dir = "./photos/";
                        $target_file = $target_dir . $controllers->generateChar(5). "_" . basename($_FILES["fileToUpload"]["name"]);
                        $uploadOk = 1;
                        if ($_FILES["fileToUpload"]["size"] > 200000) {
                            echo "Désolé l'image est supérieure à 2Mo !";
                            $uploadOk = 0;
                        } else {
                            $uploadOk = 1;
                        }
                        if ($uploadOk == 0) {
                            echo "Votre fichier ne peut être uploadé.";
                        } else {
                            echo "\n Aucune erreur dans le transfert du fichier. <br>";
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                $filename = basename( $_FILES["fileToUpload"]["name"]);
                                echo "Le fichier ". $filename. " a été copié dans le répertoire photos <br>";
                                if($controllers->saveNewArticle(array($_REQUEST["title"], $_REQUEST["commentaire"], $target_file, $_SESSION["userId"]))) {
                                    echo "Ajout du Post réussi ! <br>";
                                }
                            } else {
                                echo "Désolé nous n'avons pas pu transférer votre fichier.";
                            }
                        }
                    }

                }
            break;
        }
    }
    else {
        $blogController = new Blog();
        include './views/indexView.php';
    }
}
// On vérifie que l'action soit = "visitor" afin de le rediriger vers l'index des visiteurs
// Soit l'utilisateur arrive à se log et on le redirige vers le login view des utilisateurs connectés
else {
    if (isset($_GET['action'])) {
        if($_GET['action'] == "visitor"){
            include './views/indexVisitorView.php';
        } else {
            include 'views/loginView.php';
            unset($_GET['action']);
        }
    } else {
        if(isset($_REQUEST['login']) and isset($_REQUEST['password']))
        {
            $controllers->invoke($_REQUEST['login'], $_REQUEST['password']);
        } else {
            include 'views/loginView.php';
            unset($_GET['action']);
        }
    }

}
?>