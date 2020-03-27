<?php
if ($posts) {foreach ($posts as $key => $value)
{
?>

    <div class="news">
        <h3>
            <?= htmlspecialchars($value['Titre']) ?>
        </h3>

        <p>
            <img src="<?= htmlspecialchars($value["Filename"]) ?>"/>;
            <br />
            <em><p>"<?= $value["Commentaire"] ?> "</p></em>
            <hr><br>
        </p>
    </div>
<?php
}}else{
?>
    <p>Aucun articles de la communauté</p>
<?php
}
?>
<!-- View qui affiche de la liste de tous les posts auteurs confondus -->