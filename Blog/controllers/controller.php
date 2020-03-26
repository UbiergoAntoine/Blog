<?php
session_start();
require('./models/model.php');
class Controller {
    public $model;

    public function __construct() {
        $this->model = new Model();
    }

    public function invoke() {
        $reslt = $this->model->getLogin();
        if(isset($reslt) && $reslt != false && $reslt["response"] == "OK") {
            $_SESSION["userVerified"] = true;
            return $reslt;
        } else {
            $_SESSION["userVerified"] = false;
            return false;
        }

    }

    public function listPosts() {
        $posts = $this->model->getArticles();
        require('./views/listArticlesView.php');
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
}
