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
        <title>Blog</title>

        <link rel="stylesheet" type="text/css" href="../style.css">

    </head>

    <body>

        <div class="container">

            <?php

            // --------------------------------------------------------------------------------------------------------------- Get data of the post
            $query_post = $bdd->prepare('SELECT id, titre, contenu, date_billet FROM billets WHERE id=?');
            $query_post->execute(array($_GET['id']));
            $post = $query_post->fetch();

            if(empty($post)) //If $post data is empty, display error message
            {
            ?>
            <div class="billet">
                <p>Oups ! Nous avons perdu ce billet... <a href="index.php">Retour aux billets</a></p>
            </div>
            <?php
            }
            else //Or display post and comments
            {
            ?>
            <div class="content">

                <form method="post" action="save_post.php?id=<?php echo $_GET['id']; ?>">

                    <p><input type="text" name="post_title" value="<?php echo utf8_encode($post['titre']); ?>"/></p>
                    <p><input type="text" name="post_date" value="<?php echo $post['date_billet']; ?>"/></p>
                    <p><textarea name="post_content" class="textarea"><?php echo utf8_encode($post['contenu']); ?></textarea></p>
                    <p><input type="submit" value="Sauvegarder"/></p>

                </form>

            </div>
            <?php
            $query_post->closeCursor(); // End of request

            // --------------------------------------------------------------------------------------------------------------- Affichage des commentaires
            $query_comments = $bdd->prepare('SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh %imin %ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet=? ORDER BY date_commentaire DESC');
            $query_comments->execute(array($_GET['id']));

                if(empty($query_comments)) //If $comments data is empty, display error message
                {
                ?>
                <div class="billet">
                    <p>Il n'y a aucun commentaire pour le moment.</p>
                </div>

                <div class="content">
                <?php
                }
                else
                {
                while ($comments = $query_comments->fetch())
                {
                ?>
                    <p class="admin_list_post"><?php echo htmlspecialchars($comments['id']) ?> | <?php echo htmlspecialchars($comments['date_commentaire_fr']) ?> | <span><?php echo htmlspecialchars(utf8_encode($comments['auteur'])) ?> : </span><?php echo htmlspecialchars(utf8_encode($comments['commentaire'])) ?> | <a href="delete_comment.php?id=<?php echo htmlspecialchars($comments['id']); ?>&id_post=<?php echo htmlspecialchars($_GET['id']); ?>">X</a></p>
                <?php
                }
                $query_comments->closeCursor(); // Fin de la requête
                }
            }
            ?>
                    <br /><a href="index.php">Retour aux billets</a>

                </div>



        </div>

    </body>

    </html>
