<?php $title = 'Mon blog'; 
var_dump($controllers);?>

<?php ob_start(); ?>
<h1>Blog</h1>
<a href="index.php">Se déconnecter</a>
<hr>
<h3>Bienvenue <?php echo $reslt["data"]->getNom() . " " . $reslt["data"]->getPrenom() ?></h3>
<h3>Le <?php $dt = new DateTime(); echo $dt->format('d-m-Y H:i:s');  ?></h3>
<?php
    echo get_current_user();
?>


<?php $controllers->listPosts(); ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>