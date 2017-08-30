<?php

include_once('model/sql_connection.php');
include_once('controler/config.php');

if (!isset($_GET['section']) OR $_GET['section'] == 'register')
{
    include_once('controler/admin/register.php');
}
