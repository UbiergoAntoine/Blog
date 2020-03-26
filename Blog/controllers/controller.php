<?php
session_start();
require('./models/model.php');
require('./controllers/blog.php');
class Controller {
    public $model;

    public function __construct() {
        $this->model = new Model();
    }
    
    public function invoke($login, $pass){
        $userVerified = $this->model->getLogin($login,$pass);
        $blogController = new Blog();
        if(isset($userVerified) && $userVerified != false && $userVerified["response"] == "OK") {
            $_SESSION["userVerified"] = true;
            require('./views/indexView.php');
        } else {
            $_SESSION["userVerified"] = false;
            require('./views/loginView.php');
        }
        
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
