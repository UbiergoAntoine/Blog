<?php $title = 'Mes articles';?>

<?php ob_start(); ?>
<h1>Liste de mes articles</h1>
<div class="navbar">
    <a href="index.php">Liste de tous les articles auteurs confondu</a>
    <a href="index.php?action=createArticle">Créer un article</a>
    <a href="?action=logout">Se déconnecter</a>
</div>


<hr>
<h3>Bienvenue <?php echo $blogController->userInfo["Nom"]  . " " . $blogController->userInfo["Prenom"] ?></h3>
<h3>Le <?php $dt = new DateTime(); echo $dt->format('d-m-Y H:i:s');  ?></h3>
<?php $blogController->listPostsByUser($_GET["id"]); ?>
<!-- On affiche la liste de tous le sposts par utilisateur, pour que seul l'auteur puisse les modifier et les supprimer -->
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>