<?php
//Файл для получения json-файла и его декодирования
$dirname = 'json_files';
$file_name = $_GET['file_name'];
if (!empty($file_name) && file_exists($dirname . '/' . $file_name)) {
    $content = file_get_contents($dirname . '/' . $file_name);
    $response = json_decode($content, true);
} else {
    header("HTTP/1.0 404 Not Found");
    exit(include('404.php'));
}
?>