<?php 
require_once __DIR__ . '/vendor/autoload.php';
require_once ('init.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $team = $_GET['team'];

}
$pdo = connectDB();
$pbook = deletePbook($pdo, $id);
$url = "index.php?team=".$team;
header('Location:'.$url);
exit();

    