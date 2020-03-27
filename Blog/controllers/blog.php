<?php
class Blog {
    public $model;
    public $userInfo;

    public function __construct() {
        $this->model = new Model();
        if(isset($_SESSION["userId"])){
            $this->userInfo = $this->model->getUserInfo($_SESSION["userId"]);
        }
    }

    public function listPosts()
    {
        $posts = $this->model->getArticles();
        require('./views/listArticlesView.php');
    }

    public function listPostsByUser($id_user) {
        $ownArticles = $this->model->getArticleByUser($this->userInfo["Id"]);
        require('./views/listArticlesByUserView.php');
    }

    public function post()
    {
        $article = getArticle($_GET['id']);

        require('articleView.php');
    }




}
