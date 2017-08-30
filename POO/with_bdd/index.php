<?php
function loadClass($class)
{
   require $class .'.php';
}

spl_autoload_register('loadClass'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

// --------------------------------------------------------------------------------------------------------------- Connection à la base de données
$db = new PDO('mysql:host=localhost;dbname=battle_game', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$manager = new CharacterManager($db);

//Nouvelle instance
$char = new Character([
    'name' => 'Ploup',
    'life' => 80,
    'strength' => 50,
    'damage' => 25,
    'level' => 1,
    'xp' => 0
]);

echo 'Le nom de la nouvelle instance est ', $char->life(), '<br/>';

//On enregistre la nouvelle instance en bdd. Pourquoi ça marche pas ?!
$manager->addCharacter($char);



/*while ($character_datas = $get_character_datas->fetch(PDO::FETCH_ASSOC))
{
    $hero = new Character($character_datas);

    echo 'Notre héros s\'appelle ', $hero->name(), ', c\'est un personnage de niveau ',$hero->level() ,' (',$hero->xp() ,'pts d\'XP), il a ', $hero->life(), 'pts de vie, ', $hero->strength(), 'pts de force et il fait ',$hero->damage() ,'pts de dégâts. <br />';
}*/

