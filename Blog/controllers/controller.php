<?php
require('./models/model.php');
class Controller {
    public $model;

    public function __construct() {
        $this->model = new Model();
    }
    
    public function invoke(){
        $reslt = $this->model->Login();
        if(isset($reslt) && $reslt != false && $reslt["response"] == "OK") {
            include './views/indexView.php';
        } else {
            include './views/loginView.php';
        }
    }

    public function listPosts()
    {
        $posts = $this->model->getArticles();
        require('./views/listArticlesView.php');
    }
    
    public function post()
    {
        $post = getPost($_GET['id']);
        $comments = getComments($_GET['id']);
    
        require('postView.php');
    }
}
