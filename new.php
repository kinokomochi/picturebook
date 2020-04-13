<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once('init.php');
$login = checkLoginStatus();
if(!$login){
    $_SESSION['return_uri'] =  URL_ROOT."new.php";
    header('Location:login/login.php');
    exit;
}

if($login){
$message = "図鑑登録";
require_once ('new.tpl.php');
}
