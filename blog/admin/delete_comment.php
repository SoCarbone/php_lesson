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
        if(empty($_GET))
        {
            //If no POST data, display error message
            echo 'Oups ! Il y a eu une erreur. Nous ne savons plus quel commentaire vous vouliez supprimer.';
        }
        else
        {
            $delete_comment = $bdd->prepare('DELETE FROM commentaires WHERE id=?');
            $delete_comment->execute(array(htmlspecialchars($_GET['id'])));
            $delete_comment->closeCursor(); // End of request
            $id_url = $_GET['id_post'];
            header("Location: edit_post.php?id=$id_url");
        }
        ?>

    </body>

</html>
