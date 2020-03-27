<?php $title = "Supprimer ". $articleInfo['Titre'] ."";?>

<?php ob_start(); ?>
<a href="?action=viewListArticlesByUser&id=<?= $blogController->userInfo["Id"] ?>">Liste de mes articles</a>
<a href="index.php">Liste des articles de tous auteurs</a>
<a href="?action=logout">Se déconnecter</a>

<h3>Êtes-vous sûr de vouloir supprimer <?= $articleInfo['Titre'] ?> ?</h3>
<a  href="?action=deleteArticle&idArticle=<?= $articleInfo['Id'] ?>">Oui, supprimer</a>
<a  href="?action=viewListArticlesByUser&id=<?= $blogController->userInfo["Id"] ?>">Non</a>
<hr>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>