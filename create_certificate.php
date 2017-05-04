<?php
error_reporting(E_ALL);
require_once 'core.php';
require 'GenerateByGD.php';

$image = new GenerateByGD();

if (isset($_GET['right_answers'],$_GET['all_answers'])) {
    if (!empty($_GET['user_name'])) {
        $user_name = $_GET['user_name'];
    } else {
        $user_name = get_authorised_user_data()['name'];
    }
    $right_answers = $_GET['right_answers'];
    $all_answers = $_GET['all_answers'];
    $image->create_certificate($user_name, $right_answers, $all_answers);
} else {
    $image->create_certificate_collapse();
}
