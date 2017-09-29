<?php

include_once ('../templates/bootstrap.php');
include_once ('../templates/header.php');

if(!empty($_GET) AND isset($_GET['page'])){
    $controler = '../controler/admin_' . $_GET['page'] . '.php';
    $page = '../templates/admin/' . $_GET['page'] . '.php';
    $lost = '../templates/404.php';

    if(file_exists($controler))
    {
        include_once ($controler);
    }

    if(file_exists($page))
    {
        include_once ($page);
    }
    else{
        include_once ($lost);
    }
}
else
{
    include_once ('../controler/admin_news.php');
    include_once ('../templates/admin/news.php');
}

include_once ('../templates/footer.php');
