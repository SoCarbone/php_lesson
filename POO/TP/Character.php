<?php

abstract class Character
{
    //Les attributs
    protected $_id;
    protected $_name;
    protected $_type;
    protected $_damage;
    protected $_skill;
    protected $_xp;
    protected $_level;
    protected $_hit;
    protected $_last_hit;
    protected $_last_care;
    protected $_wake_up;

    //Les constantes
    const ITS_ME = 1;
    const CHAR_DEAD = 2;
    const CHAR_HIT = 3;
    const CHAR_LEVEL_UP = 4;
    const NEW_DAY = 5;
    const SLEEP = 6;

    //Le constructeur
    public function __construct(array $char)
    {
        $this->hydrate($char);
    }

    //Les méthodes
    public function addDamage($char)
    {
        //Augmenter de 5 les dégats
        $this->_damage += 4 + $char->level();
        $char->addXp(5);

        // si on atteind 100 de dégats, on envoie la constante de mort
        if ($this->_damage >= 100)
        {
            return self::CHAR_DEAD;
            $char->addXp(25);
        }
        // sinon on envoie la constante de personnage frappé
        $char->removeHit();
        return self::CHAR_HIT;
    }

    public function Sleep($skill)
    {
        $now = new DateTime();
        $interval = 'P' . $skill . 'M';
        $time = new dateinterval($interval);

        if ($now >= $this->_wake_up)
        {
            $time_end = $now->add($time);
            $this->_wake_up = $time_end;
        }
    }

    public function checkSleep()
    {
        if (new DateTime() < new DateTime($this->_wake_up))
        {
            return self::SLEEP;
        }
        else
        {
            return 0;
        }
    }

    public function addXp($value)
    {
        $this->_xp += $value;

        if ($this->_xp >= $this->level() * 100)
        {
            $this->addLevel();
        }
    }

    public function addLevel()
    {
        $this->_level += 1;
    }

    public function checkXp()
    {
        if ($this->_xp >= $this->level() * 100)
        {
            return self::CHAR_LEVEL_UP;
        }
    }

    public function removeHit()
    {
        $this->_hit -= 1;
        $this->_last_hit = date('Y-m-d');
    }

    public function Reset()
    {
        if($this->lastHit() != date('Y-m-d'))
        {
            $this->_hit = 3;
        }

        if($this->lastCare() != date('Y-m-d'))
        {
            $this->_damage -= 10;
            $this->_last_care = date('Y-m-d');
        }
    }

    //L'hydratation
    public function hydrate(array $char)
    {
        foreach ($char as $key => $value)
        {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    //Getters
    public function id() { return $this->_id; }
    public function name() { return $this->_name; }
    public function type() { return $this->_type; }
    public function damage() { return $this->_damage; }
    public function skill() { return $this->_skill; }
    public function xp() { return $this->_xp; }
    public function level() { return $this->_level; }
    public function hit() { return $this->_hit; }
    public function lastHit() { return $this->_last_hit; }
    public function lastCare() { return $this->_last_care; }
    public function wakeUp() { return $this->_wake_up; }

    //Setters
    public function setId($id)
    {
        $id = (int)$id;
        if ($id >= 0)
        {
            $this->_id = $id;
        }
    }
    public function setName($name)
    {
        $name = htmlspecialchars($name);
        if (is_string($name))
        {
            $this->_name = $name;
        }
    }
    public function setType($type)
    {
        $type = htmlspecialchars($type);
        if (is_string($type))
        {
            $this->_type = $type;
        }
    }
    public function setDamage($damage)
    {
        $damage = (int)$damage;
        if ($damage >= 0)
        {
            $this->_damage = $damage;
        }
    }
    public function setSkill($skill)
    {
        $skill = (int)$skill;
        if ($skill >= 0 AND $skill <= 4)
        {
            $this->_skill = $skill;
        }
        if ($this->_damage >= 0)
        {
            $this->_skill = 4;
        }
        if ($this->_damage >= 25)
        {
            $this->_skill = 3;
        }
        if ($this->_damage >= 50)
        {
            $this->_skill = 2;
        }
        if ($this->_damage >= 75)
        {
            $this->_skill = 1;
        }
        if ($this->_damage >= 90)
        {
            $this->_skill = 0;
        }
    }
    public function setXp($xp)
    {
        $xp = (int)$xp;
        if ($xp >= 0)
        {
            $this->_xp = $xp;
        }
    }
    public function setLevel($level)
    {
        $level = (int)$level;
        if ($level > 0)
        {
            $this->_level = $level;
        }
    }
    public function setHit($hit)
    {
        $hit = (int)$hit;
        if ($hit >= 0)
        {
            $this->_hit = $hit;
        }
    }
    public function setLast_hit($last_hit)
    {
        if (is_string($last_hit))
        {
            $this->_last_hit = $last_hit;
        }
    }
    public function setLast_care($last_care)
    {
        if (is_string($last_care))
        {
            $this->_last_care = $last_care;
        }
    }
    public function setWake_up($wake_up)
    {
        if (is_string($wake_up))
        {
            $this->_wake_up = $wake_up;
        }
    }


}
