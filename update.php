<?php 
    if(isset($_POST['submit'])){
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'utf-8');
        $team = htmlspecialchars($_POST['team'], ENT_QUOTES, 'utf-8');
        $sp_name = htmlspecialchars($_POST['sp_name'], ENT_QUOTES, 'utf-8');
        $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'utf-8');

    }
    var_dump($_POST);
    echo $_POST['id']."\n";
    echo $_POST['sp_name']."\n";
    echo $_POST['team']."\n";
    echo $_POST['description']."\n";
    echo $id;
    echo $sp_name;
    require_once ('db_connect.php');
    $sql = 'UPDATE picture 
            SET sp_name = :sp_name, team = :team, description = :description
            WHERE picture.id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':sp_name', $sp_name, PDO::PARAM_STR);
    $stmt->bindValue(':team', $team, PDO::PARAM_STR);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->execute();

    
    
    
    $pdo =null;
    $stmt = null;

    

    //echo $team;
    $url = "{$team}/index.php";
    header('Location:'.$url);
    exit();

    