<?php
error_reporting(E_ALL);
require_once 'core.php';

$warning = "";
$need_captcha = false;
if (is_POST()) {
    if (empty($_SESSION['Captcha'])) {
        if (login(get_param('login'), get_param('password'))) {
            unset($_SESSION['Login_Amount']);
            redirect('list');
        } else if (!isset($_SESSION['Login_Amount'])) {
            $_SESSION['Login_Amount'] = 1;
            $warning = "Неверный логин или пароль! Повторите ввод!";
        } else {
            $session_amount = $_SESSION['Login_Amount'];
            $session_amount++;
            $_SESSION['Login_Amount'] = $session_amount;
            if ($_SESSION['Login_Amount'] >= 5) {
                $need_captcha = true;
                $warning = "Неверный логин или пароль! Повторите ввод!";
            }
        }
    }
    else {
        if (login(get_param('login'), get_param('password')) && is_captcha_done()) {
            unset($_SESSION['Login_Amount']);
            redirect('list');
        } else {
            $session_amount = $_SESSION['Login_Amount'];
            $session_amount++;
            $_SESSION['Login_Amount'] = $session_amount;
            if ($_SESSION['Login_Amount'] >= 5) {
                $need_captcha = true;
                $warning = "Неверный логин или пароль! Повторите ввод!";
            }
        }
    }
}
include 'header.php';
?>

<div class="main-container">
    <fieldset class="main-container-fieldset-main">
        <p class="main-container-fieldset-main__text"><?= $warning ?></p><br/>
        <p class="main-container-fieldset-main__text">&#3847; Войти как авторизованный пользователь &#8582;</p><br/>
        <form method="POST">
            <p class="main-container-fieldset-main__text"><label for="login">Введите свой логин:</label></p><br/>
            <p class="main-container-p__button"><input class="main-container-fieldset-main__input" type="text" name="login"></p><br/>
            <p class="main-container-fieldset-main__text"><label for="password">Введите свой пароль:</label></p><br/>
            <p class="main-container-p__button"><input class="main-container-fieldset-main__input" type="text" name="password"></p><br/>
            <?php if ($need_captcha == true) { ?>
            <p class="main-container-fieldset-main__text"><label for="captcha">Введите капчу:</label></p><br/>
            <p class="main-container-p__button"><img src="create_captcha.php"></p><br/>
                <p class="main-container-p__button"><input class="main-container-fieldset-main__input" type="text" name="captcha"></p><br/>
            <?php } ?>
            <p class="main-container-p__button"><input type="submit" value="Вход" class="main-container__button"></p>
        </form>
        <p class="main-container-fieldset-main__text">&#3847; Либо, войти как гость &#8582;</p><br/>
        <form method="GET" action="list.php">
            <p class="main-container-fieldset-main__text"><label for="user_name">Введите своё имя:</label></p><br/>
            <p class="main-container-p__button"><input class="main-container-fieldset-main__input" type="text" name="user_name"></p>
            <p class="main-container-p__button"><input type="submit" value="Вход" class="main-container__button"></p>
        </form>
    </fieldset>
</div>

<?php include 'footer.php';?>

