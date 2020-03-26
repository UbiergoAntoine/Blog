<?php
class User{
    private $_id;
    private $_nom;
    private $_prenom;
    private $_email;
    private $_motdepasse;


    public function __construct($result){
        $this->_id = (int) $result["id"];
        $this->_nom = (string) $result["nom"];
        $this->_prenom = (string) $result["prenom"];
        $this->_email = (string) $result["email"];
        $this->_motdepasse = (string) $result["motdepasse"];

    }

    public function loginUser(){
        $response['response'] = 'ok';
        echo $username . " " . $password;
        $sql= "SELECT * FROM personne WHERE Email LIKE :username AND MotDePasse LIKE :password;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $_id, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        $stmt->execute();

        if($stmt->rowCount() == 1){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            $response['response'] = 'KO';
        }

        return $response;

    }
}