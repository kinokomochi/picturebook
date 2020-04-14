<?php 
session_start();
require_once __DIR__ . '/vendor/autoload.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $team = $_GET['team'];

}
$pdo = connectDB();
$pbook = deletePbook($pdo, $id);
$url = $_SESSION['uri'];
header('Location:'.$url);
exit();

    