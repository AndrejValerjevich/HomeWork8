<?php
error_reporting(E_ALL);
require_once 'core.php';
//Проверка на авторизованного пользователя или гостя
if (!is_authorised() && empty($_GET['user_name'])) {
    redirect('index');
}
if (!is_authorised() && !empty($_GET['user_name'])) {
    $user_name = $_GET['user_name'];
    $GET_user_name = "&user_name=$user_name";
} else {
    $GET_user_name = '';
}

//Проверка на запрос-удаление
if (isset($_GET['delete_file'])) {
    $delete_file_name = $_GET['delete_file'];
    unlink(__DIR__."/json_files/$delete_file_name");
}

$upload_directory = "json_files";
$file_moved = false;
$file_accepted = false;
if (isset($_POST, $_FILES['json_file']) && $_FILES['json_file']['size']>0) {
    $whitelist = '/.(json)$/i';
    if (preg_match($whitelist, $_FILES['json_file']['name']))
    {
        $file_name = $_FILES['json_file']['name'];
        $tmp_path = $_FILES['json_file']['tmp_name'];
        if (move_uploaded_file($tmp_path, "$upload_directory/$file_name"))
        {
            $file_moved = true;
        }
        $file_accepted = true;
    }
}
$json_files = scandir($upload_directory);
unset($json_files[0]);
unset($json_files[1]);
include 'header.php';
?>


    <div class="main-container">
        <fieldset class="main-container-fieldset-main">
            <div class="clearfix">
                <?php if (is_authorised()) {?>
                <p class="main-container-fieldset-main__add-test"><a href="admin.php">+добавить новый тест!</a></p>
                <?php } ?>
                <p class="main-container-fieldset-main__logout"><a href="logout.php">Выйти</a></p><br/>
            </div><br/>
            <p class="main-container-fieldset-main__text">Список всех тестов:</p><br/>
            <?php if ($file_moved == true && $file_accepted == true) { ?>
                <p class="main-container-fieldset-main__text">Файл был загружен:)</p>
            <?php } ?>
            <table class="main-container-table">
                <?php foreach ($json_files as $file_names) { ?>
                    <tr class="table-row">
                        <td class="table-cell"><a class="main-container__link" href="test.php?file_name=<?= $file_names?><?= $GET_user_name ?>"><?= stristr($file_names, '.', true) ?></a></td>
                    </tr>
                <?php } ?>
            </table>
        </fieldset>
    </div>


<?php include 'footer.php'; ?>