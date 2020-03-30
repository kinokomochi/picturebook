<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once('init.php');
$login = checkLoginStatus();
displayLink($login);
if($login == false){
    $_SESSION['return_uri'] =  "http://localhost/pbook/new.php";
    header('Location:login/login.php');
    exit;
}

if($login == true){
$message = "図鑑登録";
require_once ('new.tpl.php');
}
