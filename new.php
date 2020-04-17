<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
$login = checkLoginStatus();
if(!$login){
    $_SESSION['return_uri'] =  URL_ROOT."new.php";
    header('Location:login/login.php');
    exit;
}

$_SESSION['return_uri'] = $_SERVER['HTTP_REFERER'];
$message = "図鑑登録";
require_once ('new.tpl.php');

