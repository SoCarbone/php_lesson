<?php
try
{
    //On se connecte à mysql
    $bdd = new PDO('mysql:host=localhost;dbname=formation_php;chartset=utf8', 'root', '');    
}
catch (Exception $e)
{
    //En cas d'erreur on arrête tout et on affiche un message d'erreur
    die('Erreur : ' . $e->getMessage());
}

//On va chercher les dix premiers resultats de la table jeux_video, et je classe par pris décroissant, pour le croissant enlever DESC
$reponse = $bdd->query('SELECT nom, possesseur, prix FROM jeux_video WHERE possesseur=\'Patrick\' ORDER BY prix DESC LIMIT 0, 10');

//On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
 echo $donnees['nom'] . ' est à ' . $donnees['prix'] . '€<br />';
}
$reponse->closeCursor(); // Fin de la requête -------------------------------------------------------------------------------

//On va chercher tout le contenu du champ nom de la table jeux_video, les jeux qui sont à Michel et Patrick
$reponse = $bdd->query('SELECT nom, possesseur FROM jeux_video WHERE possesseur=\'Patrick\' OR possesseur=\'Michel\'');

//On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
 echo $donnees['nom'] . ' est à ' . $donnees['possesseur'] . '<br />';
}
$reponse->closeCursor(); // Fin de la requête -------------------------------------------------------------------------------

//On va chercher tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM jeux_video');

//On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
<p><strong><?php echo $donnees['nom']; ?></strong> est un jeu pour <?php echo $donnees['console']; ?>.</p>
<p>On peut y jouer à <?php echo $donnees['nbre_joueurs_max']; ?>.</p>
<p>Il a couté <?php echo $donnees['prix']; ?><sup>€</sup> à <?php echo $donnees['possesseur']; ?>.</p>
<p>Voici son commentaire : <?php echo $donnees['commentaires']; ?></p>
<br />
<?php
}
    $reponse->closeCursor(); // Fin de la requête

?>






