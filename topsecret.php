<?php

$pseudo = strip_tags($_POST['pseudo']);
$password = strip_tags($_POST['pass']);

if ($pseudo == 'BlackMamba' && $password == 'kangourou')
{
    echo '<p>Vous êtes bien ' . $pseudo . ', vous avez le droit d\'accéder aux données hyper sensibles de la NASA !</p>';
}
else
{
    echo '<p>Votre mot de passe ou votre pseudo n\'est pas valide. Vous ne pouvez pas accéder à cette page.</p>';
}

?>
