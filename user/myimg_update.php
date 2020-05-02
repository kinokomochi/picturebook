<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';

$login = checkLoginStatus();
if(!$login){
    header('Location:./../login/login.php');
}

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:room.php');
    exit;
}

if(!CsrfValidator::validate(filter_input(INPUT_POST, 'token'))){
    header('Content-type: text/plain; charset=UTF-8', true, 400);
    die('CSRF validation failed.');
}

$newImage = $_SESSION['newImage'];
$pdo = connectDB();
updateNewImage($pdo, $_SESSION['id'], $newImage);
logD($newImage, 'update a myimg');

header('Location:mypage.php?page=0&user_id='.$_SESSION['id']);

