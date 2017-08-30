<?php

if (isset($_GET['prenom']) AND isset($_GET['nom']) AND isset($_GET['repeter']))
{
    // On force la conversion en un nombre entier
    $_GET['repeter'] = (int) $_GET['repeter'];

    //Le nombre doit être compris entre 1 et 10
    if ($_GET['repeter'] >=1 AND $_GET['repeter'] <=10)
    {
        for ($nombre_de_repetitions = 1; $nombre_de_repetitions <= $_GET['repeter']; $nombre_de_repetitions++)
        {
            echo '<p> Bonjour ' . $_GET['prenom'] . ' ' . $_GET['nom'] . ' ! </p>';
        }
    }
    else {
        echo 'Vous avez touché les paramètres !';
    }
}
else
{
    echo 'Il faut renseigner votre nom et prénom !';
}

?>

