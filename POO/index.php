<?php

function loadClass($class)
{
   require $class .'.php';
}

spl_autoload_register('loadClass'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

// Instanciation d'une classe.
$char = new Character(Character::BIG_STRENGTH, 25);
$pnj = new Character(Character::AVERAGE_STRENGTH, 12);

$char->setStrength(50);

// Appel d'une méthode ou d'un attribut avec l'opérateur ->
$char->hit($pnj);
echo 'Le héros frappe le monstre<br />';
$char->winXp($pnj->strength());
echo 'Le héros fait ', $char->strength(), 'pts de dégâts et prend ', $pnj->strength(), 'pts d\'expérience<br />';
echo 'Le héros dit: "', Character::speak() ,'"';

$pnj->hit($char);
$pnj->winXp();

?>
<hr>
<?php
$inst1 = new Counter();
$inst2 = new Counter();
echo 'La classe a été instanciée : ', Counter::displayCounting(), ' fois';
