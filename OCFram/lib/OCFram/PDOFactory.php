<?php
namespace OCFram;

class PDOFactory
{
  public static function getMysqlConnexion()
  {
    $db = new \PDO('mysql:host=localhost;dbname=news', 'root', ''); //TODO : Essayer de faire un objet Config et de récupérer les infos de la BDD bar ce biais
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    return $db;
  }
}
