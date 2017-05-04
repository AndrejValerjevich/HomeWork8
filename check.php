<?php
error_reporting(E_ALL);
require_once 'core.php';
require 'get_file.php';

if (!is_authorised() && !empty($_GET['user_name'])) {
    $user_name = $_GET['user_name'];
    $GET_user_name = "&user_name=$user_name";
} else {
    $GET_user_name = '';
}

//Проверим, пройден ли сам тест
if (isset($_POST) && count($_POST)==count($response)) {
    $count_POST_mas = 0;
    $results = [];
    $right_answers = 0;//Посчитаем, сколько правильных ответов (понадобится для надписи на сертификате)
    foreach ($response as $answer) {
        if (is_array($answer['answers'][$_POST["q$count_POST_mas"]])) {
            $results[] = "Верно!";
            $right_answers++;
        } else {
            $results[] = "Не верно!";
        }
        $count_POST_mas++;
    }
}
else {
    $results[] = null;
}

$all_answers = count($response);//Посчитаем, сколько всего заданий (понадобится для надписи на сертификате)

include 'header.php';
?>
<div class="main-container">
    <fieldset class="main-container-fieldset-main">
        <p class="main-container-fieldset-main__logout"><a href="logout.php">Выйти</a></p>
        <form action="test.php?file_name=<?= $file_name?><?= $GET_user_name ?>" method="POST">
            <?php if ($results[0]!=null) {?>
                <p class="main-container-fieldset-main__text"><img src="create_certificate.php?right_answers=<?= $right_answers ?>&all_answers=<?= $all_answers ?><?= $GET_user_name ?>" width="400" height="250"></p>
                <?php $count=1; foreach ($results as $value) { ?>
                    <p class="main-container-fieldset-main__text">Ответ на задание <?= $count?> : <?= $value?></p><br/>
        <?php $count++; } ?>
                <p class="main-container-p__button"><input class="main-container__button-check" type="submit" value="Решить снова ->"></p>
            <?php } else { ?>
                <p class="main-container-fieldset-main__text">Вы прошли не весь тест! Пожалуйста, пройдите тест целиком!</p>
                <p class="main-container-p__button"><input class="main-container__button-check" type="submit" value="Пройти снова ->"></p>
            <?php } ?>
        </form>

        <form action="list.php" method="POST">
            <p class="main-container-p__button"><input class="main-container__button-check" type="submit" value="<- Список тестов"></p>
        </form>
    </fieldset>
</div>

<?php include 'footer.php'; ?>
