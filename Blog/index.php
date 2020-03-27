<?php
require('controllers/controller.php');
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
                }
                if(isset($_POST["submit"]) && isset($_REQUEST)){
                    if(!isset($_REQUEST["title"])){
                        echo "pas de titre";
                    }
                    if(!isset($_REQUEST["commentaire"])){
                        echo "pas de commentaire";
                    }
                    if(!isset($_FILES["fileToUpload"])){
                        echo "pas de fichier";
                    }
                    if(isset($_REQUEST["title"]) && isset($_REQUEST["commentaire"]) && isset($_FILES["fileToUpload"])) {
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
                                if($controllers->saveArticle(array($target_file, htmlspecialchars($_POST["commentaire"],ENT_QUOTES), htmlspecialchars($_POST["title"], ENT_QUOTES)))) {
                                    echo "Modification du Post réussi ! <br>";
                                }
                            } else {
                                echo "Désolé nous n'avons pas pu transférer votre fichier.";
                            }
                        }
                    }
                }


            break;
            case "deleteArticle":
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                        addArticle($_GET['id'], $_POST['author'], $_POST['comment']);
                    }
                    else {
                        echo 'Erreur : tous les champs ne sont pas remplis !';
                    }
                }
                else {
                    echo 'Erreur : aucun identifiant de billet envoyé';
                }
            break;
            // case "createArticle":
            //     if (isset($_GET['id']) && $_GET['id'] > 0) {
            //         if (!empty($_POST['author']) && !empty($_POST['comment'])) {
            //             addArticle($_GET['id'], $_POST['author'], $_POST['comment']);
            //         }
            //         else {
            //             echo 'Erreur : tous les champs ne sont pas remplis !';
            //         }
            //     }
            //     else {
            //         echo 'Erreur : aucun identifiant de billet envoyé';
            //     }
            // break;
            case "saveArticle":
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                        addArticle($_GET['id'], $_POST['author'], $_POST['comment']);
                    }
                    else {
                        echo 'Erreur : tous les champs ne sont pas remplis !';
                    }
                }
                else {
                    echo 'Erreur : aucun identifiant de billet envoyé';
                }
            break;
        }
    }
    else {
        $blogController = new Blog();
        include './views/indexView.php';
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
?>