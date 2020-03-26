<?php
foreach ($posts as $key => $value)
{
?>

    <div class="news">
        <h3>
            <?= htmlspecialchars($value['Titre']) ?>
            <!-- <em>le </em> -->
        </h3>

        <p>
            <img src="<?= htmlspecialchars($value["Filename"]) ?>"/>;
            <br />
            <em><p>"<?= $value["Commentaire"] ?> "</p></em>
            <a href="articleView.php?id=<?= $value['Id'] ?>">Voir plus ...</a>
            <hr><br>
        </p>
    </div>
<?php
}
?>