<?php
try
{
    //On se connecte à mysql
    $bdd = new PDO('mysql:host=localhost;dbname=formation_php;chartset=utf8', 'root', '');
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    //En cas d'erreur on arrête tout et on affiche un message d'erreur
    die('Erreur : ' . $e->getMessage());
}
?>

<form method="post" action="index.php">

    <p>
        <select name="console">
          <option value="NES">NES</option>
          <option value="Megadrive">Megadrive</option>
          <option value="Nintendo 64">Nintendo 64</option>
            <option value="Gamecube">Gamecube</option>
          <option value="Xbox">Xbox</option>
          <option value="PC">PC</option>
            <option value="SuperNES">SuperNES</option>
          <option value="PS2">PS2</option>
          <option value="GBA">GBA</option>
            <option value="PS">PS</option>
        </select>

        <input type="number" maxlength="3" name="prix_max" value="100" />

        <input type="number" maxlength="2" name="joueurs_min" value="1" />

        <input type="submit" value="Lister"/>

    </p>

</form>

<?php

//On va chercher dans toute la table les jeux qui correspondent aux critères demandés
if (isset($_POST['prix_max']) AND isset($_POST['joueurs_min']) AND isset($_POST['console'])) // Si toutes les données sont manquantes
{
    //On force les données prix_max et joueurs_min à être des entiers
    $_POST['prix_max'] = (int) $_POST['prix_max'];
    $_POST['joueurs_min'] = (int) $_POST['joueurs_min'];

    //On requête avec des variables préparées
    $reponse = $bdd->prepare('SELECT nom, nbre_joueurs_max, prix, possesseur, console FROM jeux_video WHERE prix <= ? AND nbre_joueurs_max >= ? AND console = ?');
    $reponse->execute(array($_POST['prix_max'], $_POST['joueurs_min'], $_POST['console']));

    if ($reponse == NULL)
    {
        echo '<p>Aucun jeux ne correspond à vos critères</p>';
    }
    else
    {
        while ($donnees = $reponse->fetch())
   {
       echo $donnees['nom'] . ' une jeu pour ' . $donnees['nbre_joueurs_max'] . ' joueurs sur ' . $donnees['console'] . ' est disponible à ' . $donnees['prix'] . '€ auprès de ' . $donnees['possesseur'] . '.<br />';
   }

    $reponse->closeCursor();
    }
}
else // Si toutes les données sont là on affiche le réslutat
{
    echo 'Remplissez tous les champs pour générer la liste';
}
?>
