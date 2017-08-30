<?php

class Character
{
    private $_id;
    private $_name;
    private $_life;
    private $_strength;
    private $_damage;
    private $_level;
    private $_xp;

    public function __construct(array $char=array())
    {
        $this->hydrate($char);
    }

    public function hydrate(array $char)
    {
        foreach ($char as $key => $value)
        {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    // Getters
    public function id() { return $this->_id; }
    public function name() { return $this->_name; }
    public function life() { return $this->_life; }
    public function strength() { return $this->_strength; }
    public function damage() { return $this->_damage; }
    public function level() { return $this->_level; }
    public function xp() { return $this->_xp; }

    // Setters
    public function setId($id)
    {
        $id = (int)$id;

        if($id > 0)
        {
            $this->_id = $id;
        }
    }

    public function setName($name)
    {
        if(is_string($name))
        {
            $this->_name = $name;
        }
    }

    public function setLife($life)
    {
        $life = (int)$life;

        if($life >= 0 AND $life <= 100)
        {
            $this->_life = $life;
        }
    }

    public function setStrength($strength)
    {
        $strength = (int)$strength;

        if($strength > 0 AND $strength <= 50)
        {
            $this->_strength = $strength;
        }
    }

    public function setDamage($damage)
    {
        $damage = (int)$damage;

        if($damage > 0 AND $damage <= 25)
        {
            $this->_damage = $damage;
        }
    }

    public function setLevel($level)
    {
        $level = (int)$level;

        if($level > 0 AND $level <= 20)
        {
            $this->_level = $level;
        }
    }

    public function setXp($xp)
    {
        $xp = (int)$xp;

        if($xp >= 0)
        {
            $this->_xp = $xp;
        }
    }
}
