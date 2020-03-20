<?php 
session_start();
require_once('function.php');
$pbook = ['id'=>'', 'sp_name'=>'', 'picture'=>'', 'description'=>'',
          'team'=>'', 'user_id'=>''];
var_dump($_SESSION);
if(!isset($_SESSION['id'])){
    $_SESSION['return_uri'] =  "http://localhost/pbook/new.php";
    header('Location:login/login.php');
    exit;
}

if(isset($_SESSION['id']) && ($_SESSION['time']) + 3600 > time()){
// require_once ('db_connect.php');//DBに接続
// //DBからログインしているメンバーのuser.idを取得してpicture.user_idと紐付けたい。　
// $sql = 'SELECT * FROM user WHERE id = :id';
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
// $stmt->execute();
// $member = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($member);
// $pdo = null;
// $stmt = null;

$message = "図鑑登録";
require_once ('new.tpl.php');
// var_dump($member);
}
