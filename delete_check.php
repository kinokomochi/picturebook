<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $team = $_GET['team'];
    }
    
    require_once ('db_connect.php');
    $sql = 'SELECT * FROM picture WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $pbook = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $pdo =null;
    $stmt = null;

    $message = "この投稿を削除しますか？";

    //var_dump($_GET);
    //echo $team;
    require_once ('delete_check.tpl.php');
