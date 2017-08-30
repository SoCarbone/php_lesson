<?php

class Character
{
    //Les attributs
    private $_id;
    private $_name;
    private $_damage;
    private $_xp;
    private $_level;
    private $_hit;
    private $_last_hit;
    private $_last_care;

    //Les constantes
    const ITS_ME = 1;
    const CHAR_DEAD = 2;
    const CHAR_HIT = 3;
    const CHAR_LEVEL_UP = 4;
    const NEW_DAY = 5;

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
    public function damage() { return $this->_damage; }
    public function xp() { return $this->_xp; }
    public function level() { return $this->_level; }
    public function hit() { return $this->_hit; }
    public function lastHit() { return $this->_last_hit; }
    public function lastCare() { return $this->_last_care; }

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
    public function setDamage($damage)
    {
        $damage = (int)$damage;
        if ($damage >= 0)
        {
            $this->_damage = $damage;
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
}
