<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
$login = checkLoginStatus();
$message = "入力エラーがあります";
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:room.php');
    exit;
    }

if(!CsrfValidator::validate(filter_input(INPUT_POST, 'token'))){
    header('Content-type: text/plain; charset=UTF-8', true, 400);
    die('CSRF validation failed.');
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

    if($_SESSION['edit'] == 'mypage'){
        $url = $_SESSION['return_uri'];
        header('Location:'.$url);
        exit;    
    }elseif($_SESSION['edit'] == 'index'){
        $team = $pbook['team'];
        $url = "index.php?page=0&team=".$team;
        header('Location:'.$url);
        exit;
    }
}

    