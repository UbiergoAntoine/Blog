
<?php
require('controllers/controller.php');
$request = $_SERVER['REQUEST_URI'];
$controllers = new Controller();
$controllers->getUrlCurrently(array('action'));

var_dump($_SESSION["userVerified"]);
$pathProject = "/AFIP/Blog/Blog";
if($userVerified != false && $_SESSION["userVerified"] == true) {
    var_dump($_SESSION["userVerified"]);
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
                include './view/indexVisitorView.php';
                unset($_GET);
            break;
            case "logout":
                $reslt["data"]->Logout();
                $reset = $_SERVER["REQUEST_URI"];
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
            case "addArticle":
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                        addComment($_GET['id'], $_POST['author'], $_POST['comment']);
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
    