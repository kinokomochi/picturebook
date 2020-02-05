<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $team = $_GET['team'];

    }
    //var_dump($_GET);
    require_once ('db_connect.php');
    $sql = 'DELETE FROM picture WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

   
    
    
    $pdo =null;
    $stmt = null;

    

    //echo $team;
    $url = "{$team}/index.php";
    header('Location:'.$url);
    exit();

    