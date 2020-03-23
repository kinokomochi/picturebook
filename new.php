<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once('init.php');
$pbook = ['id'=>'', 'sp_name'=>'', 'picture'=>'', 'description'=>'',
          'team'=>'', 'user_id'=>''];
if(($_SESSION['time'] + 3600) <= time()){
    $_SESSION['return_uri'] =  "http://localhost/pbook/new.php";
    header('Location:login/login.php');
    exit;
}

if(isset($_SESSION['id']) && ($_SESSION['time'] + 3600) > time()){

$message = "図鑑登録";
require_once ('new.tpl.php');
// var_dump($member);
}
