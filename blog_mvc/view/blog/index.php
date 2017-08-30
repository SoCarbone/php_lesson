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

        <?php
        foreach($posts as $post)
        {
        ?>
            <div class="post">
                <h2>
                    <?php echo $post['titre']; ?>
                </h2>
                <p class="post_content">
                    <?php echo $post['contenu']; ?>
                </p>
                <p class="date_post">Billet créé le
                    <?php echo $post['date_billet_fr']; ?>
                </p>
                <p class="comments_link"><a href="post.php?section=post&id=<?php echo $post['id']; ?>" class="billet">Voir les commentaires</a></p>
            </div>
            <?php
        }
        ?>

                <div class="content">
                    <?php

            // Display link to pages
            for($page_number = 1; $page_number <= $nb_pages; $page_number++)
            {
                ?>
                        <a href="blog.php?page=<?php echo $page_number ?>" class="page_number <?php if($page_number == $page){echo 'active';} ?>">
                            <?php echo $page_number ?>
                        </a>
                        <?php
            }
        ?>
                </div>

    </div>

</body>

</html>
