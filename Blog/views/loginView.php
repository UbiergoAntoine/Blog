<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
    </head>

    <body>
        <form class="login-space" method="POST" action="index.php">
            <label for="login">E-Mail : </label>
            <input type="text" name="login" required/><br><br>
            <label for="password">Mot de passe : </label>
            <input type="password" name="password" required/><br>
            <button type="submit">Valider</button>
            <button type="reset">Annuler</button>
        </form>
        <a href="index.php?action=visitor"><button class="visitor-button"> Visiteur</button></a></div>
    </body>
    <style>
html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    display: table
}
.login-container {
  margin: 50px;
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

.visitor-button {
  margin: 24px auto;
  background-color: #6666d1;
}

.login-title {
  margin: auto;
  color: #6666d1;
}
</style>
</html>