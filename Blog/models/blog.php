<?php


public function postArticle($fileName, $commentaire, $title) {
    $result = "";
    $conn = "";
    try{
        $conn = new PDO("mysql:host=localhost;dbname=master_eil", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }catch(PDOException $exception){
        error_log("Connection error: " . $exception->getMessage());
    }

    $sql = "INSERT INTO article (filename, commentaire, titre) VALUES (?, ?, ?)";

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