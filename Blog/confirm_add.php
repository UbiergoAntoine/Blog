<?php
echo "<a href='formulaire.php'>Ajouter un nouveau fichier</a>";
if(isset($_POST["submit"])) {
    $target_dir = "./photos/";
    $target_file = $target_dir . generateChar(5). "_" . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    if ($_FILES["fileToUpload"]["size"] > 200000) {
        echo "Désolé l'image est supérieure à 2Mo !";
        $uploadOk = 0;
    } else {
        $uploadOk = 1;
    }
    if ($uploadOk == 0) {
        echo "Votre fichier ne peut être uploader.";
    } else {
        echo "\n Aucune erreur dans le transfert du fichier. <br>";
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $filename = basename( $_FILES["fileToUpload"]["name"]);
            echo "Le fichier ". $filename. " a été copié dans le répertoire photos <br>";
            if(InsertImage($target_file, htmlspecialchars($_POST["commentaire"],ENT_QUOTES), htmlspecialchars($_POST["title"], ENT_QUOTES))) {
                echo "Ajout du commentaire réussi ! <br>";
            }
        } else {
            echo "Désolé nous n'avons pas pu transférer votre fichier.";
        }
    }
}

function InsertImage($fileName, $commentaire, $title) {
    $result = "";
    $conn = "";
    try{
        $conn = new PDO("mysql:host=localhost;dbname=master_eil", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }catch(PDOException $exception){
        error_log("Connection error: " . $exception->getMessage());
    }

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
function generateChar($longueur){
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longueurMax = strlen($caracteres);
    $chaineAleatoire = '';
    for ($i = 0; $i < $longueur; $i++)
    {
    $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
    }
    return $chaineAleatoire;
}
?>