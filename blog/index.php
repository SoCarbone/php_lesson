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
        if(empty($_GET))
         {
            $min_limit = 0;
            $max_limit = 5;
            $page = 1;
         }
        else
        {
            if($_GET['page'] == 1)
            {
                $min_limit = 0;
                $max_limit = 5;
            }
            else
            {
                $max_limit = ceil(htmlspecialchars($_GET['page'])) * 5;
                $min_limit = ceil((htmlspecialchars($_GET['page'])) * 5) - 5;
            }
            $page = $_GET['page'];
        }

        // --------------------------------------------------------------------------------------------------------------- Affichage des billets du blog
        // On récupère les billets en BDD par ordre décroissant suivant la page demandée
        $recup_billets = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_billet, \'%d/%m/%Y à %Hh%imin%ss\') AS date_billet_fr FROM billets ORDER BY date_billet DESC LIMIT '. $min_limit .', '. $max_limit .'');

        while ($billets = $recup_billets->fetch())
        {
        ?>
        <div class="content">
            <?php include 'display_post.php'; ?>
            <a href="commentaires.php?id=<?php echo htmlspecialchars($billets['id']) ?>" class="billet">Voir les commentaires</a>
        </div>
        <?php
        }
        $recup_billets->closeCursor(); // Fin de la requête

        ?>

        <!--Pagination des billets-->
        <div class="content">
        <?php
            // On récupère le nombre de billets total, et on le divise par 5 pour avoir le nombre de pages
            $posts_count = $bdd->query('SELECT COUNT(*) AS nb_posts FROM billets');
            $nb_posts = $posts_count->fetch();
            $nb_pages = ceil($nb_posts['nb_posts'] / 5);

            $page_number = 1;
            // On affiche les liens correspondant a chaque page
            for($page_number = 1; $page_number <= $nb_pages; $page_number++)
            {
                ?>
                    <a href="index.php?page=<?php echo $page_number ?>" class="page_number <?php if($page_number == $page){echo 'active';} ?>"><?php echo $page_number ?></a>
                <?php
            }
        ?>
        </div>

        </div>

    </body>

    </html>
