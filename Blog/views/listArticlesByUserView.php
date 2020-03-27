<?php
foreach ($ownArticles as $key => $value)
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
            <a href="index.php?action=editArticle&id=<?= $value['Id'] ?>">Mode édition</a>
            <!-- <a href="index.php?action=createArticle">Créer un article</a> -->
            <hr><br>
        </p>
    </div>
<?php
}
?>