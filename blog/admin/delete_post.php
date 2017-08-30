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
            echo 'Oups ! Il y a eu une erreur. Nous ne savons plus quel billet vous vouliez supprimer.';
        }
        else
        {
            $delete_post = $bdd->prepare('DELETE FROM billets WHERE id=?');
            $delete_post->execute(array(htmlspecialchars($_GET['id'])));
            $delete_post->closeCursor(); // End of request
            header("Location: index.php");
        }
        ?>

    </body>

</html>
