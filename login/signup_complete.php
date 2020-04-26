<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once('../init.php');
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:../room.php');
    exit;
}
if(!isset($_SESSION['token']) || !isset($_POST['token'])
|| $_SESSION['token'] != $_POST['token']){
    header('Location:../room.php');
}

$member = ['id'=>'','nickname'=>'', 'email'=>'', 'password'=>''];
$user = makeSignupUserFromPost();
$user['image'] = $_SESSION['image'];
logD($user, 'signup new user');
logD($_SESSION, 'session');
logD($_POST, '$post');

$pdo = connectDB();
$user = saveUser($pdo, $user);
$member = lookUpUser($pdo,  $user['email']);
logD($member, 'member:');

$uri = 'signup_complete.tpl.php';
setCookieAndSession($member['id'], $member['nickname']);
returnOrMovePage($uri);
