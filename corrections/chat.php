<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="styles.css">
	<title>Mini-chat</title>
</head>
<body>
	<h1>Bienvenue sur le mini-chat !</h1>
	<p><em>Vous pouvez, sur ce chat,  publier des messages à condition d'inscrire son pseudo
		et son message.</em></p><br/>

		<?php
		if(isset($_COOKIE['pseudo']))
		{
			$cookiePseudo = $_COOKIE['pseudo'];
		}

		?>

		<form method="post" action="chat_post.php">
			<label> Pseudo : <input type="text" name="pseudo" value="<?php echo $cookiePseudo; ?>" /></label>
			<br/><br/>
			<label>Message : <input type="text" name="message" /></label><br/><br/>
			<input type="submit" value="Envoyer" />
		</form>

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
			FROM minichat ORDER BY date_ajout DESC LIMIT 0,5');

		while($donnees = $requete->fetch())
		{
			echo '<p>' .$donnees['date_ajout_fr']. '<strong> ' .$donnees['pseudo']. '</strong> : '
			.$donnees['message']. '</p>';
		}

		$requete->closeCursor();

		$requete = $bdd->query('SELECT COUNT(*) AS nb_messages FROM minichat');
		$donnees = $requete->fetch();
		$nb_messages = $donnees['nb_messages'];

		if($nb_messages >= 6)
		{
			?>
			<span class="lienAnciensMessages">Consulter les anciens messages du chat : <a href="anciensMessages.php">1</a></span>
			<?php
		}


		?>

	</body>
	</html>
