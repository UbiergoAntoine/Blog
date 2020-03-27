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

    public function listPosts() {
        $posts = $this->model->getArticles();
        require('./views/listArticlesView.php');
    }

    public function listPostsByUser($id_user) {
        $blogController = new Blog();
        $ownArticles = $this->model->getArticleByUser($this->userInfo["Id"]);
        require('./views/ownedArticlesView.php');
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

    function addArticle($filename, $comm, $titre, $id_user) {
        $affectedLines = InsertImage($filename, $comm, $titre, $id_user);
        if ($affectedLines === false) {
            die('Impossible d\'ajouter l\'article !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }



}
