<?php 
session_start();
var_dump($_SESSION);
    require_once ('../db_connect.php');
    require_once ('../function.php');
    $sql = 'SELECT * FROM picture WHERE team = "plant"';
    $stmt = $pdo->prepare($sql);
    //$stmt->bindValue(':team', $team, PDO::PARAM_STR);
    // $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->execute();
    $pbooks = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $pbooks[] = $row;
    }
    //print_r($pbooks);
    $pdo = null;
    $stmt = null;

    $message = "植物の部屋";



    require_once ('../index.tpl.php');
