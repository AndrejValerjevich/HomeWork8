<?php
error_reporting(E_ALL);
require_once 'core.php';
if (!is_authorised() && empty($_GET['user_name'])) {
    redirect('index');
}

if (!is_authorised() && !empty($_GET['user_name'])) {
    $user_name = $_GET['user_name'];
    $GET_user_name = "&user_name=$user_name";
} else {
    $GET_user_name = '';
}

require 'get_file.php';
include 'header.php';
?>
    <div class="main-container">
        <fieldset class="main-container-fieldset-main">
            <div class="clearfix">
                <?php if (is_authorised()) {?>
                    <p class="main-container-fieldset-main__add-test"><a href="list.php?delete_file=<?= $file_name?>">-удалить этот тест!</a></p>
                <?php } ?>
                <p class="main-container-fieldset-main__logout"><a href="logout.php">Выйти</a></p><br/>
            </div><br/>
            <form action="check.php?file_name=<?= $file_name?><?= $GET_user_name ?>" method="POST">
                <p class="main-container-fieldset-main__text">Тест: <?= stristr($file_name, '.', true)?></p><br/>
                <?php $count=0; foreach ($response as $test)  {?>
                    <fieldset class="main-container-fieldset-tests">
                        <legend class="main-container-fieldset-tests__legend"><?= $test['question'] ?></legend>
                        <?php for ($i = 0; $i < 4; $i++ ) { ?>
                        <label><input type="radio" name="q<?= $count?>" value="<?= $i ?>"><?=((!is_array($test['answers'][$i])) ? $test['answers'][$i] : $test['answers'][$i]['answer'])?></label>
                        <?php } ?>
                    </fieldset>
                    <?php $count++; } ?>
                <p class="main-container-p__button"><input class="main-container__button-check" type="submit" value="Отправить"></p>
            </form>
        </fieldset>
    </div>

<?php include 'footer.php'; ?>