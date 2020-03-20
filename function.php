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
    $pbook['id'] = $_POST['id'] ?? '';
    $pbook['user_id'] = $_POST['user_id'] ?? '';
    $pbook['sp_name'] = $_POST['sp_name'] ?? '';
    $pbook['team'] = $_POST['team'] ?? '';
    $pbook['picture'] = $_FILES['picture']['name'] ?? '';
    $pbook['description'] = $_POST['description'] ?? '';
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
            $ext = substr($filename, -3);
            if($ext != 'jpg' && $ext != 'JPG' && $ext != 'png'){
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
//logI($sql, 'SQL');
    $stmt = $pdo->prepare($sql);
    if( !$newPbook ){
        $stmt->bindValue(':id', $pbook['id'], PDO::PARAM_INT);
    }
    $stmt->bindValue(':sp_name', $pbook['sp_name'], PDO::PARAM_STR);
    $stmt->bindValue(':team', $pbook['team'], PDO::PARAM_STR);
    $stmt->bindValue(':picture', $pbook['picture'], PDO::PARAM_STR);
    $stmt->bindValue(':description', $pbook['description'], PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $pbook['user_id'], PDO::PARAM_INT);
    $stmt->execute();

    return $pbook;
}

function findAllPbook ($pdo, $team) {
    $sql = 'SELECT picture.id, picture.team, sp_name, picture, description, user_id, user.nickname  
    FROM picture LEFT JOIN user 
    ON picture.user_id = user.id WHERE picture.team = :team
    ORDER BY picture.id DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':team', $team, PDO::PARAM_STR);
    $stmt->execute();
    $pbooks = [];
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}