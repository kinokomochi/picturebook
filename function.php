<?php 
function h($str){
    echo htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function hbr($str){
    echo nl2br(htmlspecialchars($str, ENT_QUOTES, 'UTF-8'));
}

function optionLoop($start, $end, $selection=''){
    echo '<option value="">選択してね</option>';
    for($i=$start; $i<=$end; $i++){
        $i = sprintf('%02d', $i);
        $selected = $i==$selection?'selected':'';
        echo "<option value=\"{$i}\" $selected>{$i}</option>";
    }
}

function emptyError(){
    $error = ['sp_name'=>'', 'team'=>'', 'picture'=>'', 'description'=>''];
    return $error;
}

function hasError($error) {
    return $error['sp_name'] != ''
        || $error['team'] != ''
        || $error['picture'] != ''
        || $error['description'] != '';
}

function assignmentPost(){
    if(!isset($_POST['id'])){
        $pbook['user_id'] = $_POST['user_id'] ?? '';
        $pbook['sp_name'] = $_POST['sp_name'] ?? '';
        $pbook['team'] = $_POST['team'] ?? '';
        $pbook['picture'] = $_FILES['picture']['name'] ?? '';
        $pbook['description'] = $_POST['description'] ?? '';
    }elseif(isset($_POST['id'])){
        $pbook['id'] = $_POST['id'];
        $pbook['sp_name'] = $_POST['sp_name'] ?? '';
        $pbook['team'] = $_POST['team'] ?? '';
        $pbook['description'] = $_POST['description'] ?? '';
        $pbook['picture'] = $_POST['picture'];
    }
    return $pbook;
}

function validatePbook($pbook){
    $error = emptyError();
    if($pbook['sp_name'] == ''){
        $error['sp_name'] = 'blank';
    }elseif(mb_strlen($pbook['sp_name']) > 50){
        $error['sp_name'] = 'length';
    }
    if($pbook['team'] == ''){
        $error['team'] = 'blank';
    }
    if($pbook['picture'] == ''){
        $error['picture'] = 'blank';
    }else{
    $filename = $pbook['picture'];
        if(!empty($filename)){
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if($ext != 'jpg' && $ext != 'JPG' && $ext != 'jpeg' && $ext != 'JPEG' && $ext != 'png' && $ext != 'PNG'){
                    $error['picture'] = 'type';
            }
        }
    }
    if($pbook['description'] == ''){
        $error['description'] = 'blank';
    }
    return $error;

}

function savePbook($pdo, $pbook){
    //$newPbookが空(つまりpicture.idが空)だったら新規投稿する 
    //空じゃなかったら更新する
    $newPbook = $pbook['id'] == '';
    if( $newPbook ){
        $sql = 'INSERT INTO picture (sp_name, team, picture, description, user_id)
                VALUES (:sp_name, :team, :picture, :description, :user_id)';
    }else{
        $sql = 'UPDATE picture 
                SET sp_name = :sp_name, team = :team, description = :description
                WHERE picture.id = :id';
    }
logI($sql, 'SQL');
    $stmt = $pdo->prepare($sql);
    if( $newPbook ){ //newする時
        $stmt->bindValue(':user_id', $pbook['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':picture', $pbook['picture'], PDO::PARAM_STR);
        $stmt->bindValue(':sp_name', $pbook['sp_name'], PDO::PARAM_STR);
        $stmt->bindValue(':team', $pbook['team'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $pbook['description'], PDO::PARAM_STR);
    }elseif( !$newPbook ){
        $stmt->bindValue(':id', $pbook['id'], PDO::PARAM_INT);
        $stmt->bindValue(':sp_name', $pbook['sp_name'], PDO::PARAM_STR);
        $stmt->bindValue(':team', $pbook['team'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $pbook['description'], PDO::PARAM_STR);
    }
    $stmt->execute();
    return $pbook;
}

function findAllPbook ($pdo, $team, $start) {
    $csql = "SELECT COUNT(*) as 'cnt' FROM picture WHERE team=:team";
    $ssql = "SELECT picture.id, picture.team, sp_name, picture, description, user_id, user.nickname  
    FROM picture LEFT JOIN user ON picture.user_id = user.id 
    WHERE picture.team = :team
    ORDER BY picture.id DESC LIMIT :start, 6 ";
    $sstmt = $pdo->prepare($ssql);
    $sstmt->bindValue(':team', $team, PDO::PARAM_STR);
    $sstmt->bindValue(':start', $start * 6, PDO::PARAM_INT);
    $sstmt->execute();
    $pbooks = [];
    $pbooks = $sstmt->fetchAll(PDO::FETCH_ASSOC);

    $cstmt = $pdo->prepare($csql);
    $cstmt->bindValue(":team", $team, PDO::PARAM_STR);
    $cstmt->execute();
    $total = $cstmt->fetchColumn();
    $pages = ceil($total / 6);
    return [$pbooks, $pages];
}

function lookUpPbook($pdo, $id) {
    $sql = 'SELECT picture.id, sp_name, team, picture, description FROM picture WHERE picture.id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);    
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function deletePbook($pdo, $id){
    $sql = 'DELETE FROM picture WHERE id = :id';
    logD($sql, 'SQL');
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

function searchPbook($pdo, $keyword, $start){
    $csql = "SELECT COUNT(*) as 'cnt' FROM picture WHERE sp_name LIKE ?";
    $ssql = "SELECT picture.id, sp_name, picture.team, picture, description, user_id, user.nickname
            FROM picture LEFT JOIN user ON picture.user_id = user.id
            WHERE sp_name LIKE ? ORDER BY picture.id DESC LIMIT ?, 6 ";
    logD($ssql, 'SQL');
    $sstmt = $pdo->prepare($ssql);
    $sstmt->bindValue(1, '%' . addcslashes($keyword, '\_%') . '%',  PDO::PARAM_STR);
    $sstmt->bindValue(2, $start * 6, PDO::PARAM_INT);
    $sstmt->execute();
    $pbooks = $sstmt->fetchAll(PDO::FETCH_ASSOC);
    logD($keyword, 'keyword');
    $cstmt = $pdo->prepare($csql);
    $cstmt->bindValue(1, '%' . addcslashes($keyword, '\_%') . '%',  PDO::PARAM_STR);
    $cstmt->execute();
    $total = $cstmt->fetchColumn();
    logD($total, 'total');

    $pages = ceil($total / 6);
    logD($pages, 'count page');

    return [$pbooks, $pages, $total];
}

function echoSearchResult($total){
    if($total == 0){
        echo "検索結果は０件でした。";
    }elseif($total == 1){
        echo "検索結果は１件でした。";
    }else{
        echo "検索結果は". $total."件でした。";
    }
}