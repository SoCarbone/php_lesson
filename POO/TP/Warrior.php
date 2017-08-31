<?php

class Warrior extends Character
{
    public function addDamage($char)
    {
        //Augmenter de les dégats en prenant en compte l'atout du guerrier.
        $damages = $this->getDamages($char);
        $this->_damage += $damages;
        $char->addXp($damages);

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

    public function getDamages($char)
    {
        return (4 + $char->level()) - $this->skill();
    }
}
