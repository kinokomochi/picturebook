<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
$login = checkLoginStatus();
displayLink($login);

$message = "入力エラーがあります";
$pbook = ['id'=>'', 'sp_name'=>'', 'picture'=>'', 'description'=>'',
          'team'=>'', 'user_id'=>''];
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:room.php');
    exit;
}
$pbook = assignmentPost($pbook);
$error = validatePbook($pbook);

if(hasError($error)){
    logD($pbook, 'pbook');
    logD($error, 'error');
    require_once('new.tpl.php');
    exit;
}
if(!hasError($error)){
    $pbook['picture'] = date('YmdHis') . $pbook['picture'];
    move_uploaded_file($_FILES['picture']['tmp_name'], '/Applications/XAMPP/xamppfiles/htdocs/pbook/files/'.$pbook['picture']);
    $pdo = connectDB();
    $pbook = savePbook($pdo, $pbook);
    logD($pbook, 'create a new pbook');
    
    $team = $pbook['team'];
    $url = "index.php?page=0&team=".$team;
    header('Location:'.$url);
    exit();
    }
    
