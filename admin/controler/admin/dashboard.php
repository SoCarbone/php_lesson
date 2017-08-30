<?php
include_once('model/admin/get_users_data.php');

if($_SESSION['authorized_user'] != true)
{
    header("Location: index.php");
}

if(isset($_POST['logout']) AND $_POST['logout'] == true)
{
    session_destroy();
    header("Location: index.php");
}

$verification_email = false;

// Verification if email is at true format
if(isset($_POST['email']))
{
    $verification_email = false;
    $new_email = htmlspecialchars($_POST['email']);
    $email = get_user_email($new_email);

    if(preg_match('#[a-z0-9._-]+@[a-z0-9._-]+#', $new_email))
    {
        $verification_email = true;
    }
}

if(isset($_POST['first_name']) AND isset($_POST['last_name']) AND isset($_POST['email']) AND $verification_email == true AND isset($_POST['siret']) AND isset($_POST['social_security']))
{
    echo 'Tout est OK !';
    $new_first_name = htmlspecialchars($_POST['first_name']);
    $new_last_name = htmlspecialchars($_POST['last_name']);
    $new_siret = htmlspecialchars($_POST['siret']);
    $new_social_security = htmlspecialchars($_POST['social_security']);
    $id = $_SESSION['id'];

    update_user($new_first_name, $new_last_name, $new_email, $new_siret, $new_social_security, $id);

    $_SESSION['first_name'] = $new_first_name;
}

$user_datas = get_user_datas($_SESSION['id']);
$user_data['first_name'] = htmlspecialchars($user_datas['first_name']);
$user_data['last_name'] = htmlspecialchars($user_datas['last_name']);
$user_data['email'] = htmlspecialchars($user_datas['email']);
$user_data['siret'] = htmlspecialchars($user_datas['siret']);
$user_data['social_security'] = htmlspecialchars($user_datas['social_security']);

$existing_password = false;
$similarity_password = false;

// Verification if the passwword is already exists for this email
if(isset($_POST['actual_password']))
{
    $actual_password = htmlspecialchars($_POST['actual_password']);
    $actual_password_hashed = hash('sha256', $actual_password, FALSE);
    $password = get_user_password($user_data['email']);

    if($password == $actual_password_hashed) {
        $existing_password = true;
    }
}

// Verification of the similarity between the registered passwords
if(isset($_POST['new_password_1']) AND isset($_POST['new_password_2']))
{
    $first_new_password = htmlspecialchars($_POST['new_password_1']);
    $first_new_password_hashed = hash('sha256', $first_new_password, FALSE);
    $second_new_password = htmlspecialchars($_POST['new_password_2']);
    $second_new_password_hashed = hash('sha256', $second_new_password, FALSE);

    if($first_new_password_hashed == $second_new_password_hashed)
    {
        $similarity_password = true;
    }
}

//If good, register the user ine the database
if(isset($_POST['actual_password']) AND $existing_password == true AND isset($_POST['new_password_1']) AND isset($_POST['new_password_2']) AND $similarity_password == true)
{
    update_password($_SESSION['id'], $first_new_password_hashed);
}

include_once('view/admin/dashboard.php');
