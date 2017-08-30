<h2>Ouvrir, modifier et fermer un fichier</h2>

<?php
//On ouvre le fichier
$fichier_a_modifier = fopen('compteur.txt', 'r+');

//On modifie le fichier
$nombre_vues = fgets($fichier_a_modifier); // On lit la première ligne
$nombre_vues += 1; // On augmente de 1 le nombre de vues
fseek($fichier_a_modifier, 0); // On remet le curseur au début du nombre
fputs($fichier_a_modifier, $nombre_vues); // On écrit le nouveau nombre de vues

//On ferme le fichier
fclose($fichier_a_modifier);

echo '<p>Cette page a été vue ' . $nombre_vues . ' fois !</p>'
?>
