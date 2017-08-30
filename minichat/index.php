<?php
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
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <div class="container">

        <form name="form_message" method="post" action="traitement_message.php" id="post_message">

            <p><input type="text" name="pseudo" placeholder="pseudo" <?php if (isset($_COOKIE['pseudo'])) { echo 'value="' . htmlspecialchars($_COOKIE['pseudo']) . '"'; }  ?>/></p>
            <p><textarea name="message" placeholder="Votre message"></textarea></p>
            <p><input type="submit" value="Envoyer" /></p>

        </form>

        <div id="display_messages">

            <?php
            // Get the 10 last messages in database
            $get = $bdd->query('SELECT pseudo, message, DATE_FORMAT(date_ajout, \'%d/%m/%Y à %Hh%imin%ss\') AS date_ajout_fr FROM chat AS last_messages ORDER BY ID DESC LIMIT 0, 10');
            $last_messages = $get->fetch();

            // If $last_messages is empty, display welcome message
            if (empty($last_messages))
            {
                echo '<p>Bienvenue dans mon chat ! Soyez le premier à écrire.</p>';
            }
            else // Or display last messages
            {
                while ($last_messages = $get->fetch())
                    {
                        echo '<p><span>' . htmlspecialchars($last_messages['pseudo']) . '</span> (' .htmlspecialchars($last_messages['date_ajout_fr']). ') : ' . htmlspecialchars($last_messages['message']) . '</p>';
                    }
                $get->closeCursor(); // End of request
            }
            ?>

        </div>

    </div>


</body>

</html>
