<?php
error_reporting(E_ALL);

if (is_authorised()) {
    $guest_name = 'Вы вошли как: '.get_authorised_user_data()['name'];
} elseif (!empty($_GET['user_name'])) {
    $guest_name = 'Вы вошли как: '.$_GET['user_name'];
} else {
    $guest_name = '';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Тестирование</title>
</head>
<body>
<header class="navigation clearfix">
    <ul class="navigation__ul">
        <li class="navigation__ul__item"><a class="navigation__ul__item__logo" href="list.php"><img class="navigation__ul__item__logo" src="img/image.png" alt="Главная страница"></a></li>
        <li class="navigation__ul__item"><a class="navigation__ul__item__link" href="list.php">Главная</a></li>
        <li class="navigation__ul__item"><a class="navigation__ul__item__link" href="list.php">Список тестов</a></li>
        <li class="navigation__ul__item-last"><a class="navigation__ul__item__link" href="list.php"><?= $guest_name?></a></li>
    </ul>
</header>