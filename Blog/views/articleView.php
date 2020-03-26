<?php $title = 'Accès visiteur'; ?>

<?php ob_start(); ?>
<h1>Blog</h1>
<em><a href="index.php?action=login">Se connecter</a></em>
<hr>
<h3>Bienvenue visiteur !</h3>
<h3>Le <?php $dt = new DateTime(); echo $dt->format('d-m-Y H:i:s');  ?></h3>

<p>"<?= $article["Titre"] ?> "</p>
<img src="<?= $article["Filename"] ?>" border="0" />;
<br />
<em><p>"<?= $article["Commentaire"] ?> "</p></em>
<hr><br>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>