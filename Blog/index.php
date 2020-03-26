
<?php
require('controllers/controller.php');
$request = $_SERVER['REQUEST_URI'];
$controllers = new Controller();
$controllers->getUrlCurrently(array('action'));

$reslt = $controllers->invoke();
var_dump( $_SESSION["userVerified"] );
$pathProject = "/AFIP/Blog/Blog";
if($reslt != false && $_SESSION["userVerified"] == true) {
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
            case "viewListArticlesByUser":
                echo "HUFEHFHEU";
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controllers->listPostsByUser($_GET['id']);
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
        include './views/indexView.php';
    }
} else {
    echo "dlzp";
    if (isset($_GET['action'])) {
        if($_GET['action'] == "visitor"){
            include 'views/indexVisitorView.php';
            unset($_GET['action']);
        }
        if($_GET['action'] == "login"){
            include './views/loginView.php';
            unset($_GET['action']);
        }
        if($_GET['action'] == "logout"){
            include './views/loginView.php';
            unset($_GET['action']);
        }
    } else {
        include 'views/loginView.php';
        unset($_GET['action']);
    }
}
