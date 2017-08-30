<?php
include_once('model/admin/get_users_data.php');

$verification_email = false;
$verification_password = false;

// Verification if email is at true format and if is already exists
if(isset($_POST['user_email']))
{
    $enterring_email = stripslashes($_POST['user_email']);
    $enterring_email = htmlspecialchars($_POST['user_email']);
    $email = get_user_email($enterring_email);

    if($enterring_email == $email)
    {
        $verification_email = true;
    }
}

// Verification if the passwword is already exists for this email
if(isset($_POST['user_password']))
{
    $user_password = htmlspecialchars($_POST['user_password']);
    $user_password_hashed = hash('sha256', $user_password, FALSE);
    $password = get_user_password($enterring_email);

    if($password == $user_password_hashed) {
        $verification_password = true;
    }
}

if($verification_email == true AND $verification_password == true)
{
    $user_id = get_user_id($enterring_email);
    $id['id'] = htmlspecialchars($user_id['id']);

    $_SESSION['authorized_user'] = true;
    $_SESSION['id'] = $id['id'];
    header("Location: dashboard.php");
}

// Display the view of blog
include_once('view/admin/index.php');
