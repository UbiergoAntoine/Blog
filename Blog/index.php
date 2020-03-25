<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form class="login-space" method="POST" action="index.php">
        <label for="login">E-Mail : </label>
        <input type="text" name="login"/><br><br>
        <label for="password">Mot de passe : </label>
        <input type="password" name="password"/><br>
        <button type="submit">Valider</button>
    </form>
</body>
<style>

html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    display: table
}
.login-space {
    padding : 50px;
}
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}
</style>
</html>

<?php
session_start();
if(isset($_POST["login"]) && isset($_POST["password"])) {
    $result = "";
    $conn = "";
    try{
        $conn = new PDO("mysql:host=localhost;dbname=master_eil", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }catch(PDOException $exception){
        error_log("Connection error: " . $exception->getMessage());
    }

    $sql = "SELECT * FROM Personne WHERE Email = ? AND MotDePasse = ?";

    $stmt = $conn->prepare($sql);
    
    $stmt -> bindParam(1, $_POST["login"], PDO::PARAM_STR);
    $stmt -> bindParam(2, md5($_POST["password"]), PDO::PARAM_STR);

    $stmt -> execute();

    if($stmt->rowCount() > 0){
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        
        $result = false;
        
    }
    if($result != false){
        $_SESSION["auth"] = $result;
    } else {
        $_SESSION["auth"] = null;
    }

    if($_SESSION["auth"] != null){
        header('Location: formulaire.php');
    }
}

?>