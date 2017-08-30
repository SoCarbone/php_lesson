<?php

// --------------------------------------------------------------------------------------------------------------- Connection à la base de données
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=formation_php;chartset=utf8', 'root', '');
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    //If errors, stop and display error message
    die('Erreur : ' . $e->getMessage());
}

?>

<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Admin Blog</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>

        <?php
        if(empty($_POST))
        {
            //If no POST data, display error message
            echo 'Un champ n\'a pas été rempli. Veuillez recommencer. <a href="index.php">Retour</a>';
        }
        else
        {
            $update_post = $bdd->prepare('UPDATE billets SET titre=?, contenu=?, date_billet=? WHERE id=?');
            $update_post->execute(array(utf8_decode(htmlspecialchars($_POST['post_title'])), utf8_decode(htmlspecialchars($_POST['post_content'])), utf8_decode(htmlspecialchars($_POST['post_date'])), htmlspecialchars($_GET['id'])));
            $update_post->closeCursor(); // End of request
            $id_url = htmlspecialchars($_GET['id']);
            header("Location: edit_post.php?id=$id_url");
        }
        ?>

    </body>

</html>
