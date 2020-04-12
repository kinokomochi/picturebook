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
    $member = ['id'=>'','nickname'=>'', 'email'=>'', 'password'=>''];
    $user = makeSignupUserFromPost();
        move_uploaded_file($_FILES['image']['tmp_name'], '/Applications/XAMPP/xamppfiles/htdocs/pbook/files/'.$user['image']);

    logD($user, 'signup new user');
    logD($user['image'], 'user image');
    logD($_FILES, 'user file');
    logD($_POST, '$post');

    $pdo = connectDB();
    $user = saveUser($pdo, $user);
    $member = lookUpUser($pdo,  $user['email']);
    $uri = 'signup_complete.tpl.php';
    $transition = returnOrMovePage($member['id'], $member['nickname'],  $uri);
}