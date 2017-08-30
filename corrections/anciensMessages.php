
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="styles.css">
	<title>Anciens messages</title>
</head>
<body>
<h2>Voici les 5 avant-derniers messages : </h2>
	<?php



	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(\PDO::MYSQL_ATTR_INIT_COMMAND
			=> 'SET NAMES utf8'));
	}
	catch(Exception $e)
	{
		die('Erreur :'.$e->getMessage());
	}


	$requete = $bdd->query('SELECT pseudo, message,
		DATE_FORMAT(date_ajout, \'[%Y-%m-%d %Hh:%imin:%ss]\') AS date_ajout_fr
		FROM minichat ORDER BY date_ajout DESC LIMIT 5,5');

	while($donnees = $requete->fetch())
	{
		echo '<p>' .$donnees['date_ajout_fr']. '<strong> ' .$donnees['pseudo']. '</strong> : '
		.$donnees['message']. '</p>';
	}

	?>
	<br/>
	<a href="chat.php">Revenir au fil d'actualité</a>
</body>
</html>
