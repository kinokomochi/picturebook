<?php 
session_start();
    require_once ('../db_connect.php');
    require_once ('../function.php');
    $sql = 'SELECT picture.id, picture.team, sp_name, picture, description, user_id, user.nickname  
            FROM picture LEFT JOIN user 
            ON picture.user_id = user.id WHERE picture.team = "plant"';
    $stmt = $pdo->prepare($sql);
    // $stmt->bindValue(':sp_name', $sp_name, PDO::PARAM_STR);
    // $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->execute();
    $pbooks = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $pbooks[] = $row;
    }
    $pdo = null;
    $stmt = null;

    $message = "植物の部屋";



    require_once ('../index.tpl.php');
