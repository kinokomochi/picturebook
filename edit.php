<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
$login = checkLoginStatus();
if(!$login){
    header('Location: login/login.php');
    exit;
}
if(isset($_GET['id'])){
    $pbook['id'] = $_GET['id'];
    $_SESSION['uri'] = $_SERVER['HTTP_REFERER'];
    logD($pbook['id']);
}

$pdo = connectDB();
$pbook = lookUpPbook($pdo, $pbook['id']);
$_SESSION['return_uri'] = $_SERVER['HTTP_REFERER'];

$message = "図鑑編集";
require_once ('edit.tpl.php');
