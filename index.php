<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<form method="post"
      action="./index.php">
      <p>User : </p> <input type="text" name="user" />
      <p>Mdp : </p>  <input type="password" name="password" />
      <input type="submit" value="Valider" />
</form>
</body>
</html>








<?php
if (isset($_POST['user']) AND $_POST['password']) {
try {
	$bdd = new PDO('mysql:host=localhost;dbname=exerciceblog;charset=utf8', 'root', '');
}
catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('SELECT * FROM login WHERE user = ? AND password = ?');

$req->bindParam(1,$_POST['user']);
$req->bindParam(2,$_POST['password']);
$req->execute();


if ($req->rowCount() > 0) {
  $result = $req->fetchAll(PDO::FETCH_ASSOC);
} else {
  $result = false;
  echo '<p>Mot de passe incorrect</p>';
}
        // SI le login est réussi on ajoute deux variables sessions contenant le login et le mdp
  if ($result != false) {
    $_SESSION['userInfo'] = $result;
    header('location: blog.php');
  }
  } else {
    $_SESSION['userInfo'] = $result;

  }

    ?>
