<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Blog</title>

    <link rel="stylesheet" type="text/css" href="view/css/style.css">

</head>

<body>

    <div class="container">

        <h1>Un blog fait en PHP par un débutant !</h1>

        <div class="post">
            <h2>
                <?php echo $the_post['titre']; ?>
            </h2>
            <p class="post_content">
                <?php echo $the_post['contenu']; ?>
            </p>
            <p class="date_post">Billet créé le
                <?php echo $the_post['date_billet_fr']; ?>
            </p>
        </div>

        <div class="comments">

            <?php
            if (empty($comments))
            {
                ?>
                <div class="comment">
                    <p class="comments_error">Il n'y a aucun commentaire pour le moment.</p>
                </div>
                <?php
            }
            else
            {
                foreach($comments as $comment)
                {
                ?>
                    <div class="comment">
                    <p><span class="comment_author"><?php echo $comment['auteur'] ?> : </span><?php echo $comment['commentaire'] ?></p>
                    <p><span class="comment_date"><?php echo $comment['date_commentaire_fr'] ?></span></p>
                </div>
                    <?php
                }
            }
            ?>

        </div>

        <p class="bouton"><a href="./blog.php">Retour aux billets</a></p>

        <div class="content">
            <?php

            // Display link to pages
            /*for($page_number = 1; $page_number <= $nb_pages; $page_number++)
            {
                ?>
                <a href="blog.php?page=<?php echo $page_number ?>" class="page_number <?php if($page_number == $page){echo 'active';} ?>">
                    <?php echo $page_number ?>
                </a>
                <?php
            } */
        ?>
        </div>

    </div>

</body>

</html>
