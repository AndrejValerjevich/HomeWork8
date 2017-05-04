<?php
error_reporting(E_ALL);
require 'core.php';
if (!is_authorised()) {
    redirect('index');
}
include 'header.php';
?>

<div class="main-container">
    <fieldset class="main-container-fieldset-main">
        <p class="main-container-fieldset-main__text">Загрузить можно только json-формат:)</p><br/>
        <form enctype="multipart/form-data" method="post" action="list.php">
            <p class="main-container-p__button"><input accept="application/json" type="file" name="json_file"  class="main-container__button-file"></p>
            <p class="main-container-p__button"><input type="submit" value="Загрузить файл!" class="main-container__button"></p>
        </form>
    </fieldset>
</div>

<?php include 'footer.php'; ?>