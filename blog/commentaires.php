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

        <div class="container">

        <h1>Un blog fait en PHP par un débutant !</h1>

        <?php

        // --------------------------------------------------------------------------------------------------------------- Affichage du billet
        $recup_billets = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_billet, \'%d/%m/%Y à %Hh%imin%ss\') AS date_billet_fr FROM billets WHERE id=?'); // On récupère les billets en BDD par ordre décroissant
        $recup_billets->execute(array($_GET['id'])); // On éxecute la requête avec les données envoyées par la page précédente

        $post_lines = $recup_billets->rowCount();

        if ($post_lines >= 1) //Si il y a au moins une ligne dans la table on affiche le billet et la zone de commentaires
        {
            $billets = $recup_billets->fetch()
            ?>
            <div class="content">
                <?php include 'display_post.php'; ?>
                <a href="index.php">Retour aux billets</a>
            </div>
            <?php
            $recup_billets->closeCursor(); // Fin de la requête

            // --------------------------------------------------------------------------------------------------------------- Affichage des commentaires
            $recup_commentaires = $bdd->prepare('SELECT id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh %imin %ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet=? ORDER BY date_commentaire DESC');
            $recup_commentaires->execute(array($_GET['id']));

            $comments_lines = $recup_commentaires->rowCount();

            if ($comments_lines >= 1)
            {
                while ($commentaires = $recup_commentaires->fetch())
                {
                ?>
                <div class="commentaires">
                    <p>(<?php echo htmlspecialchars($commentaires['date_commentaire_fr']) ?>) <span><?php echo htmlspecialchars(utf8_encode($commentaires['auteur'])) ?> : </span><?php echo htmlspecialchars(utf8_encode($commentaires['commentaire'])) ?></p>
                </div>
                <?php
                }
                $recup_commentaires->closeCursor(); // Fin de la requête
            }
            else
            {
            ?>
                <div class="content">
                    <p>Il n'y a aucun commentaire pour le moment.</p>
                </div>
            <?php
            }
            ?>

            <!----------------------------------------------------------------------------------------------------------------- Formulaire d'ajout de commentaire-->

            <div class="content">

                <h3>Laisser un commentaire</h3>

                <form method="post" action="post_commentaire.php?id=<?php echo htmlspecialchars($_GET['id']) ?>">

                    <input type="text" name="post_auteur" placeholder="Votre pseudo"/>
                    <input type="textarea" name="post_commentaire" placeholder="Votre message"/>
                    <input type="submit" value="Envoyer"/>

                </form>

            </div>

            <?php
        }
        else // Sinon on affiche un petit message d'erreur
        {
            ?>
            <div class="content">
                <p>Oups ! Nous avons perdu ce billet... <a href="index.php">Retour aux billets</a></p>
            </div>
            <?php
        }
        ?>

            </div>

    </body>

    </html>
