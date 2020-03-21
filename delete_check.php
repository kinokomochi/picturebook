<?php 
require_once('function.php');
require_once __DIR__ . '/vendor/autoload.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $team = $_GET['team'];
}
$pdo = connectDB();
$pbook = lookUpPbook($pdo, $id);   

$message = "この投稿を削除しますか？";    
require_once ('delete_check.tpl.php');
