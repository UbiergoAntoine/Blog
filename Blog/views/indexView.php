<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Liste de tous les articles auteurs confondu</h1>
<a href="?action=logout">Se déconnecter</a>
<a href="?action=viewListArticlesByUser&id=<?= $blogController->userInfo["Id"] ?>">Liste de mes articles</a>
<hr>
<h3>Bienvenue <?php echo $blogController->userInfo["Nom"]  . " " . $blogController->userInfo["Prenom"] ?></h3>
<h3>Le <?php $dt = new DateTime(); echo $dt->format('d-m-Y H:i:s');  ?></h3>
<?php $blogController->listPosts(); ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>