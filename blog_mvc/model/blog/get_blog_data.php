<?php
function get_posts($offset, $limit)
{
    global $bdd;
    $offset = (int) $offset;
    $limit = (int) $limit;

    $query_posts = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_billet, \'%d/%m/%Y à %Hh%imin%ss\') AS date_billet_fr FROM billets ORDER BY date_billet DESC LIMIT :offset, :limit');
    $query_posts->bindParam(':offset', $offset, PDO::PARAM_INT);
    $query_posts->bindParam(':limit', $limit, PDO::PARAM_INT);
    $query_posts->execute();
    $posts = $query_posts->fetchAll();

    return $posts;
}

function get_posts_total()
{
    global $bdd;

    // Get the count total of posts
    $get_posts_total = $bdd->query('SELECT COUNT(*) AS nb_posts FROM billets');

    return $get_posts_total;
}

function get_post($post_id)
{
    global $bdd;
    $post_id = (int) $post_id;

    // Get the count total of posts
    $get_post = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_billet, \'%d/%m/%Y à %Hh%imin%ss\') AS date_billet_fr FROM billets WHERE id=:id_post');
    $get_post->bindParam(':id_post', $post_id, PDO::PARAM_INT);
    $get_post->execute();
    $post = $get_post->fetch();

    return $post;
}

function get_comments($id_post, $offset, $limit)
{
    global $bdd;
    $offset = (int) $offset;
    $limit = (int) $limit;
    $id_post = (int) $id_post;

    $query_comments = $bdd->prepare('SELECT id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh %imin %ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet=:id_post ORDER BY date_commentaire DESC LIMIT :offset, :limit');
    $query_comments->bindParam(':offset', $offset, PDO::PARAM_INT);
    $query_comments->bindParam(':limit', $limit, PDO::PARAM_INT);
    $query_comments->bindParam(':id_post', $id_post, PDO::PARAM_INT);
    $query_comments->execute();
    $comments = $query_comments->fetchAll();

    return $comments;
}
