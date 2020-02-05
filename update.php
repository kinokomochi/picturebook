<?php 
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $team = $_POST['team'];
        $sp_name = $_POST['sp_name'];
        $picture = $_POST['picture'];
        $description = $_POST['description'];

    }
    //var_dump($_POST);
    require_once ('db_connect.php');
    $sql = 'UPDATE picture 
            SET sp_name = :sp_name, team = :team, picture = :picture, description = :desctiption
            WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':sp_name', $sp_name, PDO::PARAM_STR);
    $stmt->bindValue(':team', $team, PDO::PARAM_STR);
    $stmt->bindValue(':picture', $picture, PDO::PARAM_STR);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->execute();

    $sql = 'SELECT * FROM picture';
$stmt = $pdo->prepare($sql);
$stmt->execute();

$notes = $stmt->fetch(PDO::FETCH_ASSOC);

   
    
    
    $pdo =null;
    $stmt = null;

    

    //echo $team;
    $url = "{$team}/index.php";
    header('Location:'.$url);
    exit();

    