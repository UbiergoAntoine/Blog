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
        echo "Votre fichier ne peut être uploadé.";
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