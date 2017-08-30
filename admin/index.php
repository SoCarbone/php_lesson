<?php
session_start();

include_once('model/sql_connection.php');
include_once('controler/config.php');

if (!isset($_GET['section']) OR $_GET['section'] == 'index')
{
    include_once('controler/admin/index.php');
}
