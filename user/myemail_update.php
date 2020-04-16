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
$user = makeNewEmailFromPost();
$pdo = connectDB();
updateEmail($pdo, $_SESSION['id'], $user['email']);
logD($user['email'], 'update a myemail');

header('Location:mypage.php');

