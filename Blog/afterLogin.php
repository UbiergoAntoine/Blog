<?php
if(isset($_GET['url'])){
    $url = explode("/",$_GET['url']);
}
var_dump($_SESSION["userVerified"]);
if(isset($reslt) && $reslt != false && $reslt["response"] == "OK" && $_SESSION["userVerified"] == true) {
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

?>