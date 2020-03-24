<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
	<link href="style.css" rel="stylesheet" />
    </head>

    <body>
        <h1>Mon super blog !</h1>
        <a href="blog.php">Retour à la liste des billets</a>

<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=exerciceblog;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Récupération du billet
$req = $bdd->prepare('SELECT id, titre, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
$req->execute(array($_GET['billet']));
$donnees = $req->fetch();
?>

<div class="news">
    <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
    </h3>

    <p>
    <?php
    echo nl2br(htmlspecialchars($donnees['content']));
    ?>
    </p>
</div>

<h2>Commentaires</h2>

<?php
$req->closeCursor();

// Récupération des commentaires
$req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
$req->execute(array($_GET['billet']));

while ($donnees = $req->fetch())
{
?>
<p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
<p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
<?php
}
$req->closeCursor();
?>

<form id="blogForm" action="blog.php" method="post" enctype="multipart/form-data">
        <p>
                Formulaire d'envoi de fichier :<br />
                <input type="text" name="title" /><br />
                <textarea rows="4" cols="50" name="comment" form="blogForm">
Entrez le content...</textarea>
                <input type="file" name="image" /><br />
                <input type="submit" name="submit" value="Envoyer le fichier" />
        </p>
</form>
<?php

$handle = opendir(dirname(realpath(FILE)).'/images/');
        while($file = readdir($handle)){
          if($file !== '.' && $file !== '..'){
            $imgInfo = getInfoImage($file);
            echo "<h3>".$imgInfo[0]["title"]."</h3>";
            echo '<img src="images/'.$file.'" border="0" />';
            echo "<p>".$imgInfo[0]["comment"]."</p>";
            echo "<hr><br>";
          }
        }

if(isset($_POST["submit"])) {
  $target_dir = "./images/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $uploadOk = 1;
  if ($_FILES["image"]["size"] > 200000) {
      echo "Désolé l'image est supérieure à 2Mo !";
      $uploadOk = 0;
  } else {
      $uploadOk = 1;
  }
  if ($uploadOk == 0) {
      echo "Votre fichier ne peut être uploader.";
  } else {
      echo "\n Aucune erreur dans le transfert du fichier. <br>";
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
          $image = basename( $_FILES["image"]["name"]);
          echo "Le fichier ". $image. " a été copié dans le répertoire photos <br>";
          if(InsertImage($image, $_POST["comment"], $_POST["title"])) {
              echo "Ajout du commentaire réussi ! <br>";
          }
      } else {
          echo "Désolé nous n'avons pas pu transférer votre fichier.";
      }
  }
}

function InsertImage($image, $comment, $title) {
    $result = "";
    $conn = "";
    try{
        $conn = new PDO("mysql:host=localhost;dbname=master_eil", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }catch(PDOException $exception){
        error_log("Connection error: " . $exception->getMessage());
    }
    $sql = "INSERT INTO billets (image, comment, title) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt -> bindParam(1, $image, PDO::PARAM_STR);
    $stmt -> bindParam(2, $comment, PDO::PARAM_STR);
    $stmt -> bindParam(3, $title, PDO::PARAM_STR);

    if($stmt -> execute()){
        return true;
    }
    else{
        return false;
    }
}
?>
</body>
</html>