<?php $title = 'Mon blog';
var_dump($controllers);?>

<?php ob_start(); ?>
<h1>Liste de tous les articles auteurs confondu</h1>
<a href="index.php">Se déconnecter</a>
<a href="index.php?action=viewListArticlesByUser?id=<?= $reslt['data']->getId() ?>">Liste de mes articles</a>
<hr>
<h3>Bienvenue <?php echo $reslt["data"]->getNom() . " " . $reslt["data"]->getPrenom() ?></h3>
<h3>Le <?php $dt = new DateTime(); echo $dt->format('d-m-Y H:i:s');  ?></h3>
<?php $controllers->listPosts(); ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>