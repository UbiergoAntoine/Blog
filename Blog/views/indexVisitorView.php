<!-- La vue du visiteur, qui a accès à la lecture de tous les posts seulement -->
<?php $title = 'Accès visiteur'; ?>

<?php ob_start(); ?>
<h1>Blog</h1>
<em><a href="index.php?action=login">Se connecter</a></em>
<hr>
<h3>Bienvenue visiteur !</h3>
<h3>Le <?php $dt = new DateTime(); echo $dt->format('d-m-Y H:i:s');  ?></h3>
<?php $controllers->listPosts(); ?>
<!-- On retourne la liste de tous les posts, auteurs confondus -->
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>