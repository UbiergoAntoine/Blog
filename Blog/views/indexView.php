<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Liste des articles de tous auteurs</h1>
<a href="?action=viewListArticlesByUser&id=<?= $blogController->userInfo["Id"] ?>">Liste de mes articles</a>
<a href="?action=logout">Se déconnecter</a>
<hr>
<h3>Bienvenue <?php echo $blogController->userInfo["Nom"]  . " " . $blogController->userInfo["Prenom"] ?></h3>
<h3>Le <?php $dt = new DateTime(); echo $dt->format('d-m-Y H:i:s');  ?></h3>
<?php $blogController->listPosts(); ?>
<!-- On retourne la liste de tous les posts, auteurs confondus -->
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
