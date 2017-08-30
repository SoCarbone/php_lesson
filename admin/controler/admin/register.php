<?php
include_once('model/admin/get_users_data.php');

// Verification if email is at true format and if is already exists
if(isset($_POST['user_email']))
{
    $verification_email = false;
    $enterring_email = stripslashes($_POST['user_email']);
    $enterring_email = htmlspecialchars($_POST['user_email']);
    $email = get_user_email($enterring_email);

    if(preg_match('#[a-z0-9._-]+@[a-z0-9._-]+#', $enterring_email))
    {
        $verification_email = true;
    }
}

// Verification of the similarity between the registered passwords
if(isset($_POST['user_password']) AND isset($_POST['second_user_password']))
{
    $first_user_password = htmlspecialchars($_POST['user_password']);
    $user_password_hashed = hash('sha256', $first_user_password, FALSE);
    $second_user_password = htmlspecialchars($_POST['second_user_password']);
    $second_user_password_hashed = hash('sha256', $second_user_password, FALSE);
}

//If good, register the user ine the database
if(isset($_POST['user_email']) AND $verification_email == true AND isset($_POST['user_password']) AND isset($_POST['second_user_password']) AND $user_password_hashed = $second_user_password_hashed)
{
    create_user($enterring_email, $user_password_hashed);
    header("Location: index.php");
}

include_once('view/admin/register.php');
