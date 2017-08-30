<?php

class CharacterManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function addCharacter(Character $char)
    {
        var_dump($char);
        $rq = $this->_db->prepare('INSERT INTO game_character(id, name, life, strength, damage, level, xp) VALUES (:id, :name, :life, :strength, :damage, :level, :xp) ');
        $rq->bindValue(':id', $char->id(), PDO::PARAM_INT);
        $rq->bindValue(':name', $char->name());
        $rq->bindValue(':life', $char->life(), PDO::PARAM_INT);
        $rq->bindValue(':strength', $char->strength(), PDO::PARAM_INT);
        $rq->bindValue(':damage', $char->damage(), PDO::PARAM_INT);
        $rq->bindValue(':level', $char->level(), PDO::PARAM_INT);
        $rq->bindValue(':xp', $char->xp(), PDO::PARAM_INT);
        $rq->execute();

        echo $char->name(), ' est chargé en BDD<br />';
    }

    public function deleteCharacter(Character $char)
    {
        $rq = $this->_db->prepare('DELETE FROM game_character WHERE id=:id');
        $rq->bindValue(':id', $char->id());
        $rq->execute();
    }

    public function getCharacter($id)
    {
        $rq = $this->_db->prepare('SELECT * FROM game_character WHERE id=:id');
        $rq->bindValue(':id', $id, PDO::PARAM_INT);
        $rq->execute();

        $datas = $rq->fetch(PDO::FETCH_ASSOC);
        return new Character($datas);
    }

    public function getCharacters()
    {
        $chars = [];

        $rq = $this->_db->prepare('SELECT * FROM game_character ORDER BY name');
        $rq->execute();

        while($datas = $rq->fetchAll(PDO::FETCH_ASSOC))
        {
            $chars[] = new Character($datas);
        }

        return $chars;
    }

    public function updateCharacter(Character $char)
    {
        $rq = $this->_db->prepare('UPDATE game_character SET life=:life; strength=:strength, damage=:damage, level=:level, xp=:xp WHERE id=:id');
        $rq->bindValue(':life', $char->life(), PDO::PARAM_INT);
        $rq->bindValue(':strength', $char->strength(), PDO::PARAM_INT);
        $rq->bindValue(':damage', $char->damage(), PDO::PARAM_INT);
        $rq->bindValue(':level', $char->level(), PDO::PARAM_INT);
        $rq->bindValue(':xp', $char->xp(), PDO::PARAM_INT);
        $rq->bindValue(':id', $char->id(), PDO::PARAM_INT);
        $rq->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
