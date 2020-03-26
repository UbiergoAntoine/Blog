<?php
session_start();
$infoUser = $_SESSION["auth"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
</head>
<body>
    <h1>Blog</h1>
    <hr>
    <h3>Bienvenue <?php echo $infoUser[0]["Nom"] . " " . $infoUser[0]["Prenom"] ?></h3>
    <h3>Le <?php $dt = new DateTime(); echo $dt->format('d-m-Y H:i:s');  ?></h3>
    <p>Bienvenue sur mon blog</p>
    <?php

        // $handle = opendir(dirname(realpath(__FILE__)).'/photos/');
        // while($file = readdir($handle)){
        //   if($file !== '.' && $file !== '..'){
        //     $imgInfo = getInfoImage($file);
        //     echo "<h3>".$imgInfo[0]["titre"]."</h3>";
        //     echo '<img src="photos/'.$file.'" border="0" />';
        //     echo "<p>".$imgInfo[0]["commentaire"]."</p>";
        //     echo "<hr><br>";
            
        //   }
        // }
        // function getInfoImage($filename) {
        //     $result = "";
        //     $conn = "";
        //     try{
        //         $conn = new PDO("mysql:host=localhost;dbname=master_eil", "root", "");
        //         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //         $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        //     }catch(PDOException $exception){
        //         error_log("Connection error: " . $exception->getMessage());
        //     }

        //     $sql = "SELECT * FROM galerie WHERE filename = ?";

        //     $stmt = $conn->prepare($sql);
            
        //     $stmt -> bindParam(1, $filename, PDO::PARAM_STR);

        //     $stmt -> execute();

        //     if($stmt->rowCount() > 0){
        //         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //     }
        //     else{
                
        //         $result = false;
                
        //     }
        //     return $result;
        // }
        $images = getAllInfo();
        if($images != false) {
            foreach ($images as $key => $value) {
                echo "<h3>".$value["Titre"]."</h3>";
                echo '<img src="'.$value["Filename"].'" border="0" />';
                echo "<p>"<?$value["Commentaire"] ?>"</p>";
                echo "<hr><br>";
            }
        }
        
        
    <a href="formulaire.php">Retour à la page d'insertion</a>
</body>
</html>