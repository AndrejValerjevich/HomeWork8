<?php
function login($login, $password)
{
    $all_users = get_all_users_data();
    foreach ($all_users as $user) {
        if ($user['login'] == $login && $user['password'] == $password) {
            unset($user['password']);
            $_SESSION['user'] = $user;
            return true;
        }
    }
    return false;
}

function logout()
{
    session_destroy();
}

function generate_new_code() {
    $code = mt_rand(1000000, 9999999);
    $_SESSION['Captcha'] = $code;
    return $code;
}

function is_captcha_done() {
    if ($_POST['captcha'] == $_SESSION['Captcha']) {
        return true;
    } else {
        return false;
    }
}

function get_authorised_user_data()
{
    if (!empty($_SESSION['user'])) {
        return $_SESSION['user'];
    } else {
        return null;
    }
}

function get_all_users_data()
{
    $users_data = file_get_contents('login.json');
    $decoded_data = json_decode($users_data,true);
    if(!$decoded_data) {
        return [];
    } else {
        return $decoded_data;
    }
}

function is_authorised()
{
    return get_authorised_user_data() !== null;
}

function is_POST()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function get_param($name)
{
    return filter_input(INPUT_POST, $name);
}

function redirect($path)
{
    header("location: $path.php");
    die;
}
?>