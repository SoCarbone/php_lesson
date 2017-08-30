<?php
// Get files with posts and comments function
include_once('model/blog/get_blog_data.php');

// Number of pages
/*$posts_total = get_posts_total();
$nb_posts = $posts_total->fetch();
$nb_pages = ceil($nb_posts['nb_posts'] / 5);*/

/*if(empty($_GET))
{
    $page = 1;
}
else
{
    $page = ceil(htmlspecialchars($_GET['page']));
}*/

/*$max_limit = $page * 5;
$min_limit = $max_limit - 5;*/

// Get the the post of the page (model)
$id_post = htmlspecialchars($_GET['id']);
$post = get_post($id_post);

// Posts displaying
$the_post['titre'] = htmlspecialchars(utf8_encode($post['titre']));
$the_post['contenu'] = nl2br(htmlspecialchars(utf8_encode($post['contenu'])));
$the_post['date_billet_fr'] = htmlspecialchars($post['date_billet_fr']);
$the_post['id'] = $post['id'];

// Comments displaying
// Get the 10 comments of the page (model)
$max_limit = 10;
$min_limit = 0;
$comments = get_comments($id_post, $min_limit, $max_limit );

// Posts displaying
foreach($comments as $key => $comment)
{
    $comments[$key]['auteur'] = htmlspecialchars(utf8_decode($comment['auteur']));
    $comments[$key]['commentaire'] = nl2br(htmlspecialchars(utf8_decode($comment['commentaire'])));
    $comments[$key]['date_commentaire_fr'] = htmlspecialchars($comment['date_commentaire_fr']);
}

// Display the view of blog
include_once('view/blog/post.php');
