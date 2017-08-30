<h2>Données GET</h2>

<p><a href="bonjour.php?nom=Colombo&amp;prenom=Alexis&amp;repeter=8">Page suivante</a></p>

<h2>Formulaire et données POST</h2>

<form method="post" action="cible.php" enctype="multipart/form-data">

    <input type="text" name="firstname" placeholder="Prénom" value="Alexis" />

    <p>Aimez vous les frites ?</p>
    <p><input type="radio" name="french_chips_reply" value="yes" checked> <label for="yes">Oui</label> <input type="radio" name="french_chips_reply" value="no" /> <label for="no">Non</label></p>

    <p><input type="file" name="upload_file" id="upload_file" /></p>

    <input type="submit" value="Envoyer" />

</form>

<h2>Accès au données de la NASA</h2>

<?php

if (!isset($_POST['pseudo']) || !isset($_POST['pass']) )
{
?>

    <form method="post" action="index.php">

        <p><input type="text" name="pseudo" placeholder="Pseudo" value="BlackMamba" /></p>

        <p><input type="password" name="pass" placeholder="Mot de passe" value="kangourou" /></p>

        <input type="submit" value="Entrer" />

    </form>

    <?php

}
elseif (htmlspecialchars($_POST['pseudo']) != 'BlackMamba' || htmlspecialchars($_POST['pass']) != 'kangourou')
{
    echo '<p>Votre pseudo ou mot de passe n\'est pas valide.</p>';
}
else
{
    echo '<p>Vous êtes bien ' . strip_tags($_POST['pseudo']) . ', vous avez le droit d\'accéder aux données hyper sensibles de la NASA !</p>';
}

?>
