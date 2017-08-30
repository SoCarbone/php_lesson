<?php
if(!empty($_POST['pseudo']) AND !empty($_POST['message']))
{
		try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test', 'root','',
		array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	}
	catch(Exception $e)
	{
		die('Erreur :'.$e->getMessage());
	}

	$requete = $bdd->prepare('INSERT INTO minichat(pseudo, message, date_ajout) VALUES(?, ?, NOW()) ');
	$requete->execute(array($_POST['pseudo'], $_POST['message']));

	header('Location:chat.php');
	$requete->closeCursor();
}
else
{
	echo 'Erreur : Vous n\'avez pas inséré de pseudo ou de commentaire.';
	?><br/><br/><a href="chat.php">Retour au fil d'actualité</a>
	<?php
}

setcookie('pseudo', $_POST['pseudo'], time()+365*24*3600, null, null, true, false);
?>
