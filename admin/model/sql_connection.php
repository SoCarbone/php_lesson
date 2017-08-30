<?php

// --------------------------------------------------------------------------------------------------------------- Connection à la base de données
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=freelance_crm;chartset=utf8', 'root', '');
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    //If errors, display error message
    die('Erreur : ' . $e->getMessage());
}
