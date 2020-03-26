<?php
class Blog {
    public $model;

    public function __construct() {
        $this->model = new Model();
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
    
    public function post()
    {
        $article = getArticle($_GET['id']);
    
        require('articleView.php');
    }

   

}
