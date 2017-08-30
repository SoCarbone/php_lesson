<?php

echo  ' Votre prénom est ' . strip_tags($_POST['firstname']) . ' ! ';

// Est ce que le visiteur aime les frites ?
if ($_POST['french_chips_reply'] == 'yes')
{
    echo 'Et vous aimez les frites';
}
else
{
    echo 'Et vous n\'aimez pas les frites';
}



// Vérification du fichier
if (isset($_FILES['upload_file']) && $_FILES['upload_file']['error'] == 0 ) // Le fichier est présent
{
    //Test de la taille du fichier, elle ne doit pas excéder 5Mo
    if ($_FILES['upload_file']['size'] <= 5242880)
    {
        //On récupère l'extension du fichier
        $infos_fichier = pathinfo($_FILES['upload_file']['name']);
        $extension_upload_file = $infos_fichier['extension'];
        // On liste les extensions autorisées
        $authorized_extensions = array('jpg','jpeg','gif','png');

        //Est ce que l'extension du fichier est autorisée
        if (in_array($extension_upload_file, $authorized_extensions))
        {
            //Envoie du fichier sur le serveur
            move_uploaded_file($_FILES['upload_file']['tmp_name'], 'uploads/'. basename($_FILES['upload_file']['name']));
            echo '<p>Merci, nous avons bien reçu votre fichier ' . $_FILES['upload_file']['name'] . '  !</p>';
        }
        else
        {
            // L'extension du fichier n'est pas autorisée
            echo '<p>Votre fichier n\'est pas autorisé. Seules les images jpg, jpeg, gif et png sont acceptées.</p>';
        }
    }
    else
    {
        echo '<p>Votre fichier est trop volumineux. Il ne doit pas dépasser 5Mo.</p>';
    }
}
else // Le fichier n'est pas présent ou il y a eu  des erreurs d'envoi
{
   echo '<p>Nous n\'avons pas reçu votre fichier.</p>';
}

?>
