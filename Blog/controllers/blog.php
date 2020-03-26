<?php

function addArticle($filename, $comment, $titre)
{
    $result = postArticle($filename, $comment, $titre);
    var_dump($result);
    if ($result === false) {
        die('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}