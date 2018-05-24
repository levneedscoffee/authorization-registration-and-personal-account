<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$string = file_get_contents('../config.json');
$path = json_decode($string, true)['path'];
define('PATH', $path);


require_once (PATH."/vendor/autoload.php");
require_once (PATH."/app/Controllers/FrontController.php");

$obj = new Auth\Controllers\FrontController();
$obj->start();