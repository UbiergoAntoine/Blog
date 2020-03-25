<?php 
    if(!isset($_SESSION)) 
    { 
        session_start();
        
    }
    if(!isset($_SESSION['auth'])){
        echo "error";
        session_destroy();
        header('Location: index.php');
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire ajout de contenu</title>
</head>
<body>
    <h1>Formuliare d'ajout de contenu au Blog</h1>
    <form method="POST" action="confirm_add.php" enctype="multipart/form-data">
        <label>Titre: </label><input type="text" name="title" /><br>
        <label for="commentaire">Commentaire</label><br>
        <textarea id="commentaire" name="commentaire"
          rows="5" cols="33" placeholder="Veuillez entrer le commentaire du fichier à transférer"></textarea>
        <p>Choisissez une photo avec une taille inférieure à 2Mo.</p>
        <input type="file" id="fileToUpload" name="fileToUpload" value="Parcourir..." /><br><br>
        <button type="submit" name="submit">Envoyer</button>
    </form>
    <a href="blog.php">Page d'affichage du blog</a><br>
</body>
<style>
    form {
        padding: 10px;
    }
</style>

</html>

