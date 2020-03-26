<?php
class User {
    
    private $_id;
    private $_nom;
    private $_prenom;
    private $_email;
    private $_motdepasse;
    

    public function __construct($result){
        $this->_id = (int) $result["Id"];
        $this->_nom = (string) $result["Nom"];
        $this->_prenom = (string) $result["Prenom"];
        $this->_email = (string) $result["Email"];
        $this->_motdepasse = (string) $result["MotDePasse"];
          
    }
    public function Logout() {
        if(isset($_SESSION['status'])) {
            unset($_SESSION['status']);
            unset($_SESSION['email']);
            if(isset($_COOKIE[session_name()])) 
                setcookie(session_name(), '', time() - 1000);
                session_destroy();
        }
    }
    public function Login(){
        if(isset($_SESSION['Auth']) and isset($_SESSION['Auth']['login']) and isset($_SESSION['Auth']['pass'])){
            extract($_SESSION['Auth']);
            $user = loginUser($login,$pass);
            if($user["response"] == "OK"){
                return $user;
            }
            return $user;
        }
        return false;
    }
    
    public static function confirm_Member() {
        if(isset($_SESSION['userObject'])) return header("location: ");
    }
    
    public function getInfo($result){
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    public function getAllInfo(){
        $allInfo = array($this->currentUserId,$this->currentUsername,$this->currentUserEmail,$this->currentUserPassword);
        return $allInfo;
    }
    public function getId() {
        return $this->_id;        
    }
    public function getEmail() {
        return $this->_email;
    }
    public function getMDP() {
        return $this->_motdepasse;
    }
    public function getNom() {
        return $this->_nom;
    }
    public function getPrenom() {
        return $this->_prenom;
    }
    
}