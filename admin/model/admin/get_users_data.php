<?php
function get_user_id($user_email)
{
    global $bdd;
    $user_email = (string) $user_email;

    $query_user_id = $bdd->prepare('SELECT id FROM users WHERE email=:user_email');
    $query_user_id->bindParam(':user_email', $user_email);
    $query_user_id->execute();
    $id = $query_user_id->fetch();
    $id = $id['id'];

    return $id;
}

function get_user_email($user_email)
{
    global $bdd;
    $user_email = (string) $user_email;

    $query_user_email = $bdd->prepare('SELECT email FROM users WHERE email=:user_email');
    $query_user_email->bindParam(':user_email', $user_email);
    $query_user_email->execute();
    $email = $query_user_email->fetch();
    $email = $email['email'];

    return $email;
}

function get_user_password($user_email)
{
    global $bdd;
    $user_email = (string) $user_email;

    $query_user_password = $bdd->prepare('SELECT pass FROM users WHERE email=:user_email');
    $query_user_password->bindParam(':user_email', $user_email);
    $query_user_password->execute();
    $password = $query_user_password->fetch();
    $password = $password['pass'];

    return $password;
}

function get_user_datas($id)
{
    global $bdd;
    $id = (int) $id;

    $query_user_datas = $bdd->prepare('SELECT id, pass, email, registration_date, first_name, last_name, siret, social_security FROM users WHERE id=:id');
    $query_user_datas->bindParam(':id', $id);
    $query_user_datas->execute();
    $user_datas = $query_user_datas->fetch();

    return $user_datas;
}

function create_user($enterring_email, $user_password_hashed)
{
    global $bdd;
    $enterring_email = (string) $enterring_email;
    $user_password_hashed = (string) $user_password_hashed;

    $write_user = $bdd->prepare('INSERT INTO users (pass, email, registration_date) VALUES (:pass,:email,NOW())');
    $write_user->bindParam(':pass', $user_password_hashed);
    $write_user->bindParam(':email', $enterring_email);
    $write_user->execute();

}

function update_user($new_first_name, $new_last_name, $new_mail, $new_siret, $new_social_security, $id)
{
    global $bdd;
    $new_first_name = (string) $new_first_name;
    $new_last_name = (string) $new_last_name;
    $new_mail = (string) $new_mail;
    $new_siret = (int) $new_siret;
    $new_social_security = (string) $new_social_security;

    $update_user = $bdd->prepare('UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email, siret=:siret, social_security=:social_security WHERE id=:id');
    $update_user->bindParam(':first_name', $new_first_name);
    $update_user->bindParam(':last_name', $new_last_name);
    $update_user->bindParam(':email', $new_mail);
    $update_user->bindParam(':siret', $new_siret);
    $update_user->bindParam(':social_security', $new_social_security);
    $update_user->bindParam(':id', $id);
    $update_user->execute();

}

function update_password($id, $new_password)
{
    global $bdd;
    $id = (int) $id;
    $new_password = (string) $new_password;

    $update_user = $bdd->prepare('UPDATE users SET pass=:new_password WHERE id=:id');
    $update_user->bindParam(':new_password', $new_password);
    $update_user->bindParam(':id', $id);
    $update_user->execute();

}
