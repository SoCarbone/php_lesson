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
        <title>Admin Blog</title>

        <link rel="stylesheet" type="text/css" href="../style.css">

    </head>

    <body>

        <div class="container">

            <h1>Administration du blog fait en PHP par un débutant !</h1>
            <?php
            // --------------------------------------------------------------------------------------------------------------- Affichage des billets du blog
            // On récupère les billets en BDD par ordre décroissant suivant la page demandée
            $recup_billets = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_billet, \'%d/%m/%Y à %Hh%imin%ss\') AS date_billet_fr FROM billets ORDER BY date_billet');

            while ($billets = $recup_billets->fetch())
            {
            ?>

                <p class="admin_list_post"><?php echo htmlspecialchars($billets['id']); ?> | <?php echo htmlspecialchars(utf8_encode($billets['titre'])); ?> | <?php echo htmlspecialchars($billets['date_billet_fr']); ?> | <a href="edit_post.php?id=<?php echo htmlspecialchars($billets['id']); ?>">Editer</a> | <a href="delete_post.php?id=<?php echo htmlspecialchars($billets['id']); ?>">X</a></p>


            <?php
            }
            $recup_billets->closeCursor(); // Fin de la requête
            ?>

            <div class="content">

                <h2>Créer un nouveau billet</h3>

                <form method="post" action="add_post.php">

                    <p><input type="text" name="post_title" placeholder="Le titre"/></p>
                    <p><input type="textarea" name="post_content" placeholder="Le contenu"/></p>
                    <p><input type="submit" value="Envoyer"/></p>

                </form>

            </div>


        </div>


    </body>

    </html>


