<?php
require_once 'core.php';
if (!is_authorised()) {
    unset($_SESSION['Login_Amount']);
    unset($_SESSION['Captcha']);
    $_GET['user_name'] = null;
    redirect('index');
} else {
    unset($_SESSION['Login_Amount']);
    unset($_SESSION['Captcha']);
    $_GET['user_name'] = null;
    logout();
    redirect('index');

}
?>