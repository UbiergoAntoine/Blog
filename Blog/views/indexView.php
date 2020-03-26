<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Blog</h1>
<hr>
<h3>Bienvenue <?php echo $reslt["data"]->getNom() . " " . $reslt["data"]->getPrenom() ?></h3>
<h3>Le <?php $dt = new DateTime(); echo $dt->format('d-m-Y H:i:s');  ?></h3>
<?php $controllers->listPosts(); ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>