<?php
class CharacterManager
{
    //Les attributs
    private $_db;

    //Construction
    public function __construct($db)
    {
        $this->getDb($db);
    }

    //Les méthodes
    public function isCharacterExist($info)
    {
        if (is_int($info)) //Si on recoit l'id
        {
            $rq = $this->_db->prepare('SELECT COUNT(*) FROM tp_character WHERE id=:id');
            $rq->bindValue(':id', $info, PDO::PARAM_INT);
        }
        else //SI on recoit le nom
        {
            $rq = $this->_db->prepare('SELECT COUNT(*) FROM tp_character WHERE name=:name');
            $rq->bindValue(':name', $info, PDO::PARAM_STR);
        }
        $rq->execute();
        return (bool) $rq->fetchColumn();
    }
    public function addCharacter(Character $char)
    {
        $rq = $this->_db->prepare('INSERT INTO tp_character (name, type, damage, skill, xp, level, hit, last_hit, last_care, wake_up) VALUES (:name, :type, 0, 4, 0, 1, 3, now(), now(), 0)');
        $rq->bindValue(':name', $char->name(), PDO::PARAM_STR);
        $rq->bindValue(':type', $char->type(), PDO::PARAM_STR);
        $rq->execute();
    }
    public function getCharacter($name)
    {
        /*if (is_int($info)) //Si on recoit l'id
        {
            $rq = $this->_db->prepare('SELECT * FROM tp_character WHERE id=:id');
            $rq->bindValue(':id', $info, PDO::PARAM_INT);
        }*/
        /*else //SI on recoit le nom
        {*/
            $rq = $this->_db->prepare('SELECT * FROM tp_character WHERE name=:name');
            $rq->bindValue(':name', htmlspecialchars($name));
        /*}*/
        $rq->execute();
        $char = $rq->fetch(PDO::FETCH_ASSOC);

        switch ($char['type'])
        {
            case 'magician': return new Magician($char);
            case 'warrior': return new Warrior($char);
            default: return null;
        }

    }
    public function getCharactersList($name)
    {
        $chars = [];
        $rq = $this->_db->prepare('SELECT * FROM tp_character WHERE name<>:name ORDER BY xp DESC');
        $rq->bindValue(':name', $name, PDO::PARAM_STR);
        $rq->execute();

        while($datas = $rq->fetch(PDO::FETCH_ASSOC))
        {
            switch ($datas['type'])
            {
                case 'magician': $chars[] = new Magician($datas); break;
                case 'warrior': $chars[] = new Warrior($datas); break;
            }
        }
        return $chars;
    }
    public function updateCharacter(Character $char)
    {

        $rq = $this->_db->prepare('UPDATE tp_character SET damage=:damage, skill=:skill, xp=:xp, level=:level, hit=:hit, last_hit=:last_hit, last_care=:last_care, wake_up=:wake_up WHERE id=:id');
        $rq->bindValue(':damage', $char->damage(), PDO::PARAM_INT);
        $rq->bindValue(':skill', $char->skill(), PDO::PARAM_INT);
        $rq->bindValue(':xp', $char->xp(), PDO::PARAM_INT);
        $rq->bindValue(':level', $char->level(), PDO::PARAM_INT);
        $rq->bindValue(':hit', $char->hit(), PDO::PARAM_INT);
        $rq->bindValue(':last_hit', $char->lastHit(), PDO::PARAM_STR);
        $rq->bindValue(':last_care', $char->lastCare(), PDO::PARAM_STR);
        $rq->bindValue(':wake_up', $char->wakeUp(), PDO::PARAM_STR);
        $rq->bindValue(':id', $char->id(), PDO::PARAM_INT);
        $rq->execute();
    }
    public function countCharacter()
    {
        return $rq = $this->_db->query('SELECT COUNT(*) FROM tp_character')->fetchColumn();
    }
    public function deleteCharacter(Character $char)
    {
        $rq = $this->_db->prepare('DELETE FROM tp_character WHERE id=:id');
        $rq->bindValue(':id', $char->id(), PDO::PARAM_INT);
        $rq->execute();
    }

    //Setters
    public function getDb(PDO $db)
    {
        $this->_db = $db;
    }
}
