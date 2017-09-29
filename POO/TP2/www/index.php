<?php

include_once ('../templates/bootstrap.php');
include_once ('../templates/header.php');

if(isset($_GET) AND isset($_GET['page'])){
    $page = '../templates/' . $_GET['page'] . '.php';
    $lost = '../templates/404.php';

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
    include_once ('../templates/news.php');
}

include_once ('../templates/footer.php');
