<?php
include "user.php";
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

    public function getLogin($login, $pass){
        $user = "";
        $_SESSION["userVerified"] = false;
        $newUser = array();
        $pass = md5($pass);
        $result = $this->loginUser($login,$pass);
        if($result["response"] == "OK"){
            $newUser["data"] = new User($result['data']);
            $newUser["response"] = "OK";
            $_SESSION["userVerified"] = true;
            return $newUser;
        } else{
            echo "<p style='padding:5px;text-align:center'>Le mot de passe est inccorect<p>";
            $_SESSION["userVerified"] = false;
            return false;
        }
        return -999;
    }

    public function getUserInfo($id_user)
    {
        $conn = $this->getConnection();
        $sql = 'SELECT * FROM personne WHERE Id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($id_user));

        if($stmt->rowCount() > 0){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else{
            $result = false;
        }
        return $result;
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

    public function InsertImage($fileName, $commentaire, $title) {
        $result = "";
        $conn =  $this->getConnection();

        $sql = "INSERT INTO galerie (filename, commentaire, titre) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt -> bindParam(1, $fileName, PDO::PARAM_STR);
        $stmt -> bindParam(2, $commentaire, PDO::PARAM_STR);
        $stmt -> bindParam(3, $title, PDO::PARAM_STR);

        if($stmt -> execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function UpdateArticle($data) {
        $result = "";
        $conn =  $this->getConnection();

        $sql = "UPDATE article SET Filename = ?, Commentaire = ?, Titre = ? WHERE Id = ?";

        $stmt = $conn->prepare($sql);

        $stmt -> bindParam(1, $data[0], PDO::PARAM_STR);
        $stmt -> bindParam(2, $data[1], PDO::PARAM_STR);
        $stmt -> bindParam(3, $data[2], PDO::PARAM_STR);
        $stmt -> bindParam(4, $data[3], PDO::PARAM_STR);

        if($stmt -> execute()){
            return true;
        }
        else{
            return false;
        }
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

    public function createArticle($data) {
        $result = "";
        $conn = $this->getConnection();
        $sql = "INSERT INTO Article (Titre, Commentaire, Filename, id_user) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt -> bindParam(1, $data[0], PDO::PARAM_STR);
        $stmt -> bindParam(2, $data[1], PDO::PARAM_STR);
        $stmt -> bindParam(3, $data[2], PDO::PARAM_STR);
        $stmt -> bindParam(4, $data[3], PDO::PARAM_INT);

        $stmt -> execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{

            return false;

        }
        return false;
    }

    public function getArticle($postId)
    {
        $conn = $this->getConnection();
        $sql = 'SELECT * FROM article WHERE id = ?';
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

    public function getArticleByUser($id_user)
    {
        $conn = $this->getConnection();
        $sql = 'SELECT * FROM article WHERE id_user = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($id_user));

        if($stmt->rowCount() > 0){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            $result = false;
        }
        return $result;
    }

    public function deleteArticle($idArticle)
    {
        $conn = $this->getConnection();
        $sql = 'DELETE FROM article WHERE Id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($idArticle));

        return $stmt->rowCount();
    }
}
