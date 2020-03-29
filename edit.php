<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once('init.php');
$login = checkLoginStatus();
displayLink($login);
if(!isset($_SESSION['id'])){
    header('Location: login/login.php');
    exit;
}
if(($_SESSION['id']) && ($_SESSION['time']) + 3600 > time()){

    if(isset($_GET['id'])){
        $pbook['id'] = $_GET['id'];
        logD($pbook['id']);
    }else{
        header('Location: room.php');
    }
    
    $pdo = connectDB();
    $pbook = lookUpPbook($pdo, $pbook['id']);

    $message = "図鑑編集";
    require_once ('edit.tpl.php');
}
