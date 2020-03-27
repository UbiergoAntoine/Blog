<?php
if ($ownArticles) {foreach ($ownArticles as $key => $value)
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
            <hr><br>
        </p>
    </div>
<?php
}}else{
?>
    <p>Aucun article rédigé par vous. Veuillez cliquer sur
    <a href="index.php?action=createArticle"> créer un article</a></p>

<?php
}
?>