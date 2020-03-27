
<?php
require('controllers/controller.php');
require('controllers/blog.php');

$request = $_SERVER['REQUEST_URI'];
$controllers = new Controller();
// $_SESSION["userVerified"] = false;
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


