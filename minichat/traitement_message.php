<?php

if(!empty($_POST['pseudo']))
{
    setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
}

try
        {
            //Connection to database
            $bdd = new PDO('mysql:host=localhost;dbname=chat;chartset=utf8', 'root', '');
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        }
        catch (Exception $e)
        {
            //If error, display error message
            die('Erreur : ' . $e->getMessage());
        }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini-chat</title>
    </head>

    <body>
        <?php
        // If POST data are empty, display error message
        if (empty($_POST['pseudo']) OR empty($_POST['message']))
        {
            echo '<p>Oh ! Nous n\'avons pas compris votre message. Veillez à bien préciser votre pseudo et votre message. <a href="index.php">Retour au Chat</a></p>';
        }
        else // Or insert message into database and go to index.php
        {
            $write = $bdd->prepare('INSERT INTO chat(pseudo, message, date_ajout) VALUES(?, ?, NOW())');
            $write->execute(array(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['message'])));
            $write->closeCursor();
            header('Location: index.php');
        }
        ?>
    </body>
</html>
