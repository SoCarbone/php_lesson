<?php

include_once('model/sql_connection.php');

if (!isset($_GET['section']) OR $_GET['section'] == 'index')
{
    include_once('controler/blog/index.php');
}
