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
$user = makeNewProfileFromPost();
$pdo = connectDB();
updateProfile($pdo, $_SESSION['id'], $user);
logD($user, 'update a myprof');

header('Location:mypage.php');

