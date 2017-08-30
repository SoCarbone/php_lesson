<?php

include_once('model/sql_connection.php');

if (!isset($_GET['section']) OR $_GET['section'] == 'post')
{
    include_once('controler/blog/post.php');
}
