<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once('init.php');
$message = "入力エラーがあります";
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:room.php');
    exit;
    }
$pbook = assignmentPost();
$error = validatePbook($pbook);

if(hasError($error)){
    logD($pbook, 'pbook');
    logD($error, 'error');
    require_once ('edit.tpl.php');
}
$pdo = connectDB();

if(!hasError($error)){ 
    $pbook = savePbook($pdo, $pbook);
    logD($pbook, 'update a pbook');

    $team = $pbook['team'];
    $url = "index.php?team=".$team;
    header('Location:'.$url);
    exit();
}

    