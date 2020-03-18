<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL);
require_once ('db_connect.php');
require_once('function.php');
require_once('init.php');
$message = "入力エラーがあります";
// var_dump($member);
// var_dump($_SESSION);

    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        header('Location:room.php');
        exit;
    }
    $pbook = assignmentPost();
    var_dump($pbook);
    $error = validatePbook($pbook);
    //var_dump($_POST);

    if($_SESSION['id'] != '' || hasError($error)){
        logD($pbook, 'pbook');
        logD($error, 'error');
        require_once('new.tpl.php');
        exit;
    }
    // var_dump($error);
    //     if(isset($error)){
    //         require_once ('new.tpl.php');
    //     }
        //$errorに値が一つも入っていなければDBに接続する
        if(!isset($error)){
            $picture = date('YmdHis') . $_FILES['picture']['name'];
            move_uploaded_file($_FILES['picture']['tmp_name'], '/Applications/XAMPP/xamppfiles/htdocs/pbook/files/'.$picture);

        //入力内容をDBに保存する
        //description青文字なぜか　予約語？
        $sql = 'INSERT INTO picture (sp_name, team, picture, description, user_id)
                VALUES (:sp_name, :team, :picture, :description, :user_id)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':sp_name', $pbook['sp_name'], PDO::PARAM_STR);
        $stmt->bindValue(':team', $pbook['team'], PDO::PARAM_STR);
        $stmt->bindValue(':picture', $pbook['picture'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $pbook['description'], PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $pbook['user_id'], PDO::PARAM_INT);
        $stmt->execute();

        //print_r($_FILES);
        $pdo = null;
        $stmt = null;

        $team = $pbook['team'];
        $url = "{$team}/index.php";
        header('Location:'.$url);
        exit();
        }
    
