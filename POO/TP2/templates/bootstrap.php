<?php

$now = new DateTime();

include_once ('../src/config.php');

function loadClass($class)
{
   require '../lib/'. $class .'.class.php';
}

spl_autoload_register('loadClass'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

//Connection à la base de données
$db = new PDO('mysql:host=' . $db_host . ';dbname='. $db_name, $db_user, $db_pass);
$db->setAttribute($db::ATTR_ERRMODE, $db::ERRMODE_EXCEPTION);
$manager = new NewsManager($db);
