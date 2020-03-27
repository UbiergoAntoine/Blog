<?php $title = 'Mon blog';
var_dump($articleInfo);?>

<?php ob_start(); ?>
<a href="index.php">Se déconnecter</a>
<a href="?action=viewListArticlesByUser&id=<?= $blogController->userInfo["Id"] ?>">Liste de article</a>
<a href="index.php">Liste des articles de tous auteurs</a>

<h1>Êtes-vous ûr de vouloir supprimer ?<?= $articleInfo['Titre'] ?></h1>
<a  href="?action=deleteArticle&idArticle=<?= $articleInfo['Id'] ?>">Oui, supprimer</a>
<a  href="?action=viewListArticlesByUser&id=<?= $blogController->userInfo["Id"] ?>">Non</a>
<hr>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>