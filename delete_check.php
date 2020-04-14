<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
$login = checkLoginStatus();
displayLink($login);
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $_SESSION['uri'] = $_SERVER['HTTP_REFERER'];
}else{
    header('Location:'.$_SERVER['HTTP_REFERER']);
}
$pdo = connectDB();
$pbook = lookUpPbook($pdo, $id);   
$message = "この投稿を削除しますか？";    
require_once ('delete_check.tpl.php');
