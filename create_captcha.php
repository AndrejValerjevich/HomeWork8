<?php
error_reporting(E_ALL);
require_once 'core.php';
require 'GenerateByGD.php';

$image = new GenerateByGD();

$image->create_captcha(generate_new_code());