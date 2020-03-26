<?php $title = 'Mon blog'; 
var_dump($blogController);?>

<?php ob_start(); ?>
<h1>Blog</h1>
<a href="index.php">Se déconnecter</a>
<hr>
<h3>Bienvenue <?php echo $userVerified["data"]->getNom() . " " . $userVerified["data"]->getPrenom() ?></h3>
<h3>Le <?php $dt = new DateTime(); echo $dt->format('d-m-Y H:i:s');  ?></h3>
<?php $blogController->listPosts(); ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>