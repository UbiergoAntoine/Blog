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
            <img src="<?= $value["Filename"] ?>" border="0" />;
            <br />
            <em><p>"<?= $value["Commentaire"] ?> "</p></em>
            <a href="index.php?action=post?id=<?= $value['Id'] ?>">Voir plus ...</a>
            <hr><br>
        </p>
    </div>
<?php
}
?>