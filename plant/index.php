<?php 
    require_once ('../.gitignore/db_connect.php');
    $sql = 'SELECT * FROM picture WHERE team = "plant"';
    $stmt = $pdo->prepare($sql);
    // $stmt->bindValue(':sp_name', $sp_name, PDO::PARAM_STR);
    // $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->execute();
    $pbooks = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $pbooks[] = $row;
    }
    //print_r($pbooks);
    $pdo = null;
    $stmt = null;

    $message = "図鑑一覧";



    require_once ('../index.tpl.php');
