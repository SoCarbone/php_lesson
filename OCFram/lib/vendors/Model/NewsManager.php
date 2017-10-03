<?php
namespace Model;

use \OCFram\Manager;

abstract class NewsManager extends Manager
{
    abstract public function getList($start = -1, $limit = -1);

    abstract public function getNews($id);
}
