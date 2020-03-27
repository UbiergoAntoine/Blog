<?php
session_start();
require('./models/model.php');
class Controller {
    public $model;
    public $userVerified;

    public function __construct() {
        $this->model = new Model();
    }

    public function invoke($login, $pass){
        $this->userVerified = $this->model->getLogin($login,$pass);
        if(isset($this->userVerified) && $this->userVerified != false && $this->userVerified["response"] == "OK") {
            $_SESSION["userVerified"] = true;
            $_SESSION["userId"] = $this->userVerified["data"]->getId();
            $blogController = new Blog();
            require('./views/indexView.php');
        } else {
            $_SESSION["userVerified"] = false;
            require('./views/loginView.php');
        }
    }
// Retourne l'array de tous les articles en BDD
    public function listPosts() {
        $posts = $this->model->getArticles();
        require('./views/listArticlesView.php');
    }
// Retourne l'array de tous les articles par utilisateur en BDD
    public function listPostsByUser($id_user) {
        $blogController = new Blog();
        $ownArticles = $this->model->getArticleByUser($this->userInfo["Id"]);
        require('./views/ownedArticlesView.php');
    }

// Retourne l'ojet Article sélectionné en envoyant l'utilisateur sur le formulaire d'édition
    public function editArticle($idArticle) {
        $blogController = new Blog();
        $articleInfo = $this->model->getArticle($idArticle);
        require('./views/editArticleView.php');
    }
// Update l'article
    public function saveArticle($values){
        $rslt = $this->model->UpdateArticle($values);
        // if($_REQUEST["title"] != $articleInfo["Titre"] && $_REQUEST["commentaire"] != $articleInfo["Commentaire"] && $_FILES["fileToUpload"] != $articleInfo["Filename"]){
        //     echo "yes";
        // }
        var_dump($rslt);
        if($rslt){
            echo "L'article a bien été modifié, vous allez être redirigé";
            header("Location: index.php?action=viewListArticlesByUser&id=". $_SESSION["userId"] ."");
        } else {
            echo "La mise à jour de l'article n'a pas fonctionné";
        }
    }


    public function createArticle() {
        require('./views/createArticleView.php');
    }
    public function saveNewArticle($values) {
        $rslt = $this->model->createArticle($values);
        if($rslt){
            echo "L'article a bien été ajouté, vous allez être redirigé";
            header("Location: index.php?action=viewListArticlesByUser&id=". $_SESSION["userId"] ."");
        } else {
            echo "L'ajout de l'article n'a pas fonctionné";
        }
    }
    public function confirmDeletePost($idArticle) {
        $articleInfo = $this->model->getArticle($idArticle);
        require('./views/confirmDeleteView.php');
    }
    public function deletePost($idArticle) {
        $result = $this->model->deleteArticle($idArticle);
        if ($result) {
            header("Location: index.php?action=viewListArticlesByUser&id=". $_SESSION["userId"] ."");
        } else {
            echo "Impossible de supprimer l'article le post";
        }
    }


    public function post() {
        $post = getPost($_GET['id']);
        $comments = getComments($_GET['id']);

        require('postView.php');
    }

    function getUrlCurrently($filter = array()) {
        $pageURL = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? "https://" : "http://";

        $pageURL .= $_SERVER["SERVER_NAME"];

        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= ":".$_SERVER["SERVER_PORT"];
        }
        $pageURL .= $_SERVER["REQUEST_URI"];

        if (strlen($_SERVER["QUERY_STRING"]) > 0) {
            $pageURL = rtrim(substr($pageURL, 0, -strlen($_SERVER["QUERY_STRING"])), '?');
        }

        $query = $_GET;
        foreach ($filter as $key) {
            unset($query[$key]);
        }

        if (sizeof($query) > 0) {
            $pageURL .= '?' . http_build_query($query);
        }
        return $pageURL;
    }

    function generateChar($longueur){
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longueurMax = strlen($caracteres);
        $chaineAleatoire = '';
        for ($i = 0; $i < $longueur; $i++)
        {
        $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
        }
        return $chaineAleatoire;
    }
}
