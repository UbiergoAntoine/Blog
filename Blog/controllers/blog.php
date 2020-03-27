<?php
require('./models/blog.php');
class Blog {
    public $model;
    public $userInfo;

    public function __construct() {
        $this->model = new BlogModel();
        $this->userInfo = $this->model->getUserInfo($_SESSION["userId"]);
    }

    function addArticle($filename, $comm, $titre)
    {
        $affectedLines = InsertImage($filename, $comm, $titre);
    
        if ($affectedLines === false) {
            die('Impossible d\'ajouter l\'article !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postId);
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
