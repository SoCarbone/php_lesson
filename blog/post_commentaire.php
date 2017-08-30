<?php

// --------------------------------------------------------------------------------------------------------------- Connection à la base de données
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=formation_php;chartset=utf8', 'root', '');
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    //En cas d'erreur on arrête tout et on affiche un message d'erreur
    die('Erreur : ' . $e->getMessage());
}

?>

<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Blog</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>

        <?php
        if($_POST['post_auteur'] == NULL OR $_POST['post_commentaire'] == NULL )
        {
            echo 'Un champ n\'a pas été rempli. Veuillez recommencer. <a href="commentaires?=' . $_GET['id'] . '">Retour</a>';
        }
        else
        {
            $write_commentaire = $bdd->prepare('INSERT INTO commentaires(id_billet, auteur, commentaire, date_commentaire) VALUES (?, ?, ?, NOW())');
            $write_commentaire->execute(array(htmlspecialchars($_GET['id']), utf8_decode($_POST['post_auteur']), utf8_decode($_POST['post_commentaire'])));
            $write_commentaire->closeCursor(); // Fin de la requête
            $url_billet_retour = htmlspecialchars($_GET['id']);
            header("Location: commentaires.php?id=$url_billet_retour");
        }
        ?>



    </body>

</html>
