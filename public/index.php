<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$string = file_get_contents('/var/www/auth/config.json');
$path = json_decode($string, true)['path'];
define('PATH', $path);

require_once ("/var/www/auth/vendor/autoload.php");
require_once ("/var/www/auth/app/controllers/FrontController.php");

$obj = new Auth\Controllers\FrontController();
$obj->start();