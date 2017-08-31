<?php
$today = new DateTime('Europe/Paris');
/*var_dump($today);*/

function loadClass($class)
{
   require $class .'.php';
}
spl_autoload_register('loadClass'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

session_start();

// Détruire la session si on veut changer de personnage
if (isset($_GET['destroy']) AND $_GET['destroy'] == true)
{
    session_destroy();
    header("Location: index.php");
}

$db = new PDO('mysql:host=localhost;dbname=battle_game', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$manager = new CharacterManager($db);

$battleground = false;

// Si on créé un personnage et que le nom est libre
if(isset($_POST['create']) AND $manager->isCharacterExist($_POST['name']) == false)
{
    $name = htmlspecialchars($_POST['name']);
    $type = htmlspecialchars($_POST['type']);
    $class = ucfirst($type);
    $char = new $class ([
        'name' => $name,
        'type' => $type
    ]);
    $manager->addCharacter($char);
    $_SESSION['char'] = $char->name();
    $battleground = true;
}
if(isset($_POST['create']) AND $manager->isCharacterExist($_POST['name']) == true)
{
    $message = '<p>Ce nom existe déjà</p>';
}

// Si on récupère un personnage existant
if(isset($_POST['use']) AND $manager->isCharacterExist($_POST['name']) == true)
{
    $char = $manager->getCharacter($_POST['name']);
    $_SESSION['char'] = $char->name();
    $_SESSION['type'] = $char->type();
    $battleground = true;
}
if(isset($_POST['use']) AND $manager->isCharacterExist($_POST['name']) == false)
{
    $message = 'Ce personnage n\'existe pas';
}

// Si un personnage est en session
if(isset($_SESSION['char']) AND isset($_SESSION['type']))
{
    $char = $manager->getCharacter($_SESSION['char']);
    $battleground = true;
}
?>
<!doctype html>

<html>

<head>
    <title>Mon premier jeu de combat !</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
</head>

<body>
<?php
//Mode champ de bataille
if($battleground == true)
{
    $char->Reset();
    $manager->updateCharacter($char);
    ?>

    <!--Affichage des données du personnage-->
    <h1>Le champ de bataille</h1>
    <div>
        <h2><?php echo $char->name() ?></h2>
        <h3><?php echo $char->type() ?> de niveau <?php echo $char->level() ?></h3>
        <p>Expérience : <?php echo $char->xp() ?>pts</p>
        <p>Les dégats déjà subis : <?php echo $char->damage() ?>/100</p>
        <?php
        if($char->hit() == 0)
        {
            echo '<p>Tu ne peux plus frapper aujourd\'hui</p>';
        }
        else{
            echo '<p>Tu peux encore frapper ', $char->hit(), ' fois</p>';
        }
        ?>
        <p>Niveau d'atout : <?php echo $char->skill() ?></p>
        <?php
        if($char->skill() == 0)
        {
            echo '<p>Tu ne peux plus utiliser ton pouvoir aujourd\hui</p>';
        }
        ?>
    </div>

    <a href="?destroy=true">Changer de personnage</a>

    <hr />

    <?php
    if (isset($_GET['hit']))
    {
        $component = $manager->getCharacter($_GET['hit']);
        echo '<p>', $char->name(), ' a frappé ', $component->name(), '</p>';
        $result = $component->addDamage($char);
        if ($result == 2)
        {
            echo '<p>', $component->name(), ' est mort</p>';
            $manager->deleteCharacter($component);
            echo '<p>', $char->name(), ' reçoit 25pts d\'expérience</p>';
        }
        else
        {
            echo '<p>', $component->name(), ' a maintenant ', $component->damage(), '/100 pts de dégâts</p>';
            $manager->updateCharacter($component);

            if($component->type() == 'warrior')
            {
                echo '<p>', $char->name(), ' reçoit ' . $component->getDamages($char) . 'pts d\'expérience</p>';
            }
            else
            {
                echo '<p>', $char->name(), ' reçoit 5pts d\'expérience</p>';
            }

        }

        if($char->checkXp() == 4){
            echo '<p>', $char->name(), ' passe au niveau ', $char->level(), '</p>';
        }
        var_dump($char);
        $manager->updateCharacter($char);

        echo '<a href="index.php">Retour à la liste des adversaires</a>';
    }
    elseif ($char->hit() > 0 AND $char->checkSleep() == 0)
    {
        ?>
        <div>
            <h3>Vos adversaires</h3>
            <?php
        $chars = $manager->getCharactersList($char->name());
        $chars_count = $manager->countCharacter();
        ?>

                <p>Nombre de personnages en lice :
                    <?php echo $chars_count - 1 ?>
                </p>

                <?php
        if (empty($chars))
        {
          echo 'Personne à frapper !';
        }

        else
        {
          foreach ($chars as $aChar)
          {
            echo '<a href="?hit=', $aChar->name(), '">', htmlspecialchars($aChar->name()), '</a> (dégâts : ', $aChar->damage(), '/100, atout : ', $aChar->skill(), ', niveau : ', $aChar->level(), ', xp : ', $aChar->xp(), 'pts)<br />';
              }
        }
        ?>
        </div>
        <?php
    }
    else
    {
        //Le personnage n'a plus le droit de frapper on ne lui affiche donc aucun adversaire
        if($char->checkSleep() == 6)
        {
            echo '<p>Tu es endormi jusqu\'au ', $char->wakeUp() , ' !</p>';
        }
    }
}
else
{
    if(isset($message))
    {
        echo $message;
    }
    ?>
    <form method="post" action="">
        <input type="text" name="name" placeholder="Le nom du personnage" required/>
        <select name="type" required>
            <option value="magician">Magicien</option>
            <option value="warrior">Guerrier</option>
        </select>
        <input type="submit" name="create" value="Je créé le personnage" />
        <input type="submit" name="use" value="J'utilise le personnage" />
    </form>
    <?php
}
?>

</body>

</html>
