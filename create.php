<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL);
require_once('init.php');
require_once('function.php');
$message = "入力エラーがあります";
// var_dump($member);

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:room.php');
    exit;
    }
$pbook = assignmentPost();
$error = validatePbook($pbook);
var_dump($pbook);

//var_dump($_POST);
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
        
        // //入力内容をDBに保存する
        // //description青文字なぜか　予約語？
        // $sql = 'INSERT INTO picture (sp_name, team, picture, description, user_id)
        //         VALUES (:sp_name, :team, :picture, :description, :user_id)';
        // $stmt = $pdo->prepare($sql);
        // $stmt->bindValue(':sp_name', $pbook['sp_name'], PDO::PARAM_STR);
        // $stmt->bindValue(':team', $pbook['team'], PDO::PARAM_STR);
        // $stmt->bindValue(':picture', $pbook['picture'], PDO::PARAM_STR);
        // $stmt->bindValue(':description', $pbook['description'], PDO::PARAM_STR);
        // $stmt->bindValue(':user_id', $pbook['user_id'], PDO::PARAM_INT);
        // $stmt->execute();

        // //print_r($_FILES);
        // $pdo = null;
        // $stmt = null;

        $team = $pbook['team'];
        $url = "{$team}/index.php";
        header('Location:'.$url);
        exit();
        }
    
