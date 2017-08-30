<?php

// Définition d'une classe
class Character // Syntaxe d'une classe. Nom de la classe avec une majuscule suivant la notation PEAR
{
    // Attributs privés
    private $_strength = 20; // Valeur par défaut à 50. Pas d'appel à une fonction, une variable superglobale ou pas.
    private $_location = 'Grenoble'; //
    private $_xp = 10;
    private $_damage = 0;

    private static $_speech = 'Ah ah je suis le plus fort !';

    // Déclaration de constantes pour la force
    const LITTLE_STRENGTH = 25;
    const AVERAGE_STRENGTH = 50;
    const BIG_STRENGTH = 90;

    // Méthodes privées ou publiques
    public function move()
    {
        echo 'Je me déplace';
    }
    public function hit(Character $pnjToHit)
    {
        $pnjToHit->_damage += $this->_strength;
    }
    public function winXp()
    {
        $this->_xp = $this->_xp + 1;
    }
    public function displayXp()
    {
        echo $this->_xp;
    }



    //Constructeur qui crée une instance avec des valeur spécifique. Toujours en public !
    public function __construct($strength, $damage)
    {
        echo 'Une instance créée ! <br />'; // Message qui s'affiche à chaque instance créée
        $this->setStrength($strength);
        $this->setDamage($damage);
        $this->_experience = 1;
    }

    //Mutateur chargé de modifier l'attribut force
    public function setStrength($strength)
    {
        if (in_array($strength, [self::LITTLE_STRENGTH, self::AVERAGE_STRENGTH, self::BIG_STRENGTH]))
        {
            $this->_strength = $strength;
        }
    }

    //Mutateur chargé de modifier l'attribut les dégâts
    public function setDamage($damage)
    {
        if (!is_int($damage))
        {
            trigger_error('Les dégats d\'un personnage doivent être un nombre entier', E_USER_WARNING);
            return;
        }

        if ($damage > 100)
        {
            trigger_error('Les dégats d\'un personnage doit être inférieur à 100', E_USER_WARNING);
            return;
        }

        $this->_damage = $damage;
    }

    //Méthode qui se charge de renvoyer le contenu de l'attribut
    public function strength()
    {
        return $this->_strength;
    }

    public static function speak()
    {
        echo self::$_speech;
    }
}
