<?php $title = 'Mon blog';
var_dump($articleInfo);?>

<?php ob_start(); ?>
<h1>Êtes-vous ûr de vouloir supprimer ?<?= $articleInfo['Titre'] ?></h1>
<a href="index.php">Se déconnecter</a>
<a href="?action=viewListArticlesByUser&id=<?= $blogController->userInfo["Id"] ?>">Liste de article</a>
<a href="index.php">Liste des articles de tous auteurs</a>


<a  href="?action=deleteArticle&idArticle=<?= $articleInfo['Id'] ?>" value="Oui" ></a>
<a  href="?action=viewListArticlesByUser&id=<?= $blogController->userInfo["Id"] ?>">Non</a>
<a href="index.php?action=deleteArticle&id=<?= $value['Id'] ?>">Supprimer l'article</a>
<hr>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>