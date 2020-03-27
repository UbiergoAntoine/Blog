<?php $title = 'Mon blog';
var_dump($articleInfo);?>

<?php ob_start(); ?>
<h1>Créer un nouvel article</h1>
<a href="index.php">Se déconnecter</a>
<a href="?action=viewListArticlesByUser&id=<?= $blogController->userInfo["Id"] ?>">Liste de mes article</a>
<a href="index.php">Liste des articles de tous auteurs</a>
    <form style="padding-top:50px" method="POST" action="" enctype="multipart/form-data">
        <label>Titre: </label><input type="text" name="title" value="<?= $articleInfo['Titre'] ?>" /><br>
        <label for="commentaire">Commentaire</label><br>
        <textarea id="commentaire" name="commentaire"
          rows="5" cols="33"><?= $articleInfo['Commentaire'] ?></textarea>
        <p>Choisissez une photo avec une taille inférieure à 2Mo.</p>
        <input type="file" id="fileToUpload" name="fileToUpload" accept="image/png, image/jpeg" value="Parcourir..." /><br><br>
        <button type="submit" name="submit">Envoyer</button>
    </form>
    <a href="index.php?action=deleteArticle&id=<?= $value['Id'] ?>">Supprimer l'article</a>
<hr>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>