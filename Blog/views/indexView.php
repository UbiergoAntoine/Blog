<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Liste des articles de tous auteurs</h1>
<a href="?action=viewListArticlesByUser&id=<?= $blogController->userInfo["Id"] ?>">Liste de mes articles</a>
<!-- On propose à l'utilisateur de consulter lal liste des posts uniquement dont il est l'auteur -->
<a href="?action=logout">Se déconnecter</a>
<hr>
<div style="text-align:center">
<h3>Bienvenu <?php echo $blogController->userInfo["Prenom"]  . " " . $blogController->userInfo["Nom"] ?> !</h3>
    <h3><?php $dt = new DateTime(); echo $dt->format('d-m-Y H:i:s');  ?></h3>
</div>

<hr>
<?php $blogController->listPosts(); ?>
<!-- On retourne la liste de tous les posts, auteurs confondus -->
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
