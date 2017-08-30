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
            $write_post = $bdd->prepare('INSERT INTO billets(titre, contenu, date_billet) VALUES (?, ?, NOW())');
            $write_post->execute(array(utf8_decode(htmlspecialchars($_POST['post_title'])), utf8_decode(htmlspecialchars($_POST['post_content']))));
            $write_post->closeCursor(); // End of request
            header("Location: index.php");
        }
        ?>

    </body>

</html>
