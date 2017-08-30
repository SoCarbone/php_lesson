<?php
// Get the total count of posts
include_once('model/blog/get_blog_data.php');

// Number of pages
$posts_total = get_posts_total();
$nb_posts = $posts_total->fetch();
$nb_pages = ceil($nb_posts['nb_posts'] / 5);

if(empty($_GET))
{
    $page = 1;
}
else
{
    $page = ceil(htmlspecialchars($_GET['page']));
}

$max_limit = $page * 5;
$min_limit = $max_limit - 5;

// Get the 5 posts of the page (model)
$posts = get_posts($min_limit, $max_limit);

// Posts displaying
foreach($posts as $key => $post)
{
    $posts[$key]['titre'] = htmlspecialchars(utf8_encode($post['titre']));
    $posts[$key]['contenu'] = nl2br(htmlspecialchars(utf8_encode($post['contenu'])));
}

// Display the view of blog
include_once('view/blog/index.php');
