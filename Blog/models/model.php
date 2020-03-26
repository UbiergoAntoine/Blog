<?php
include "./class/user.class.php";
class Model {

    function getConnection()
    {
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=master_eil;charset=utf8', 'root', '');
            return $db;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
    
    public function getLogin(){
        $user = "";
        $_SESSION["userVerified"] = false;
        if(isset($_REQUEST['login']) and isset($_REQUEST['password'])){
            $newUser = array();
            $login = $_REQUEST['login'];
            $pass = md5($_REQUEST['password']);
            $result = $this->loginUser($login,$pass);
            if($result["response"] == "OK"){
                $newUser["data"] = new User($result['data']);
                $newUser["response"] = "OK";
                $_SESSION["userVerified"] = true;
                return $newUser;
            } else{
                echo "Le mot de passe est inccorect";
                $_SESSION["userVerified"] = false;
                return false;
            }
            return $newUser;
        } else {
            $_SESSION["userVerified"] = false;
            return false;
        }
        return -999;
    }

    public function loginUser($email, $password){    
        $conn = $this->getConnection();

        $response['response'] = 'OK';
        $sql= "SELECT * FROM personne WHERE Email LIKE :email AND MotDePasse LIKE :password;"; 
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR); 
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        
        $stmt->execute();
        
        if($stmt->rowCount() == 1){
            $response['data'] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else{
            $response['response'] = 'KO';
        }
        
        return $response;
        
    }

    public function getArticles() {
        $result = "";
        $conn = $this->getConnection();
        $sql = "SELECT * FROM article;";
    
        $stmt = $conn->prepare($sql);
       
        $stmt -> execute();
    
        if($stmt->rowCount() > 0){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            
            $result = false;
            
        }
        return $result;
    }
    
    public function getArticle($postId)
    {
        $conn = getConnection();
        $sql = ('SELECT * FROM article WHERE id = ?');
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($postId));
    
        if($stmt->rowCount() > 0){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else{
            $result = false;
        }
        return $result;
    }    
}
