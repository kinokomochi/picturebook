<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

require_once('../init.php');
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:../room.php');
    exit;
}
if(isset($_SESSION['token']) && isset($_POST['token'])
&& $_SESSION['token'] == $_POST['token']){
    $user = makeSignupUserFromPost();
    $pdo = connectDB();
    $user = saveUser($pdo, $user);
    $member = lookUpUser($pdo, $user['email']);
    $uri = 'signup_complete.tpl.php';
    $transition = returnOrMovePage($member['id'], $uri);
}