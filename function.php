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
function assignmentPost(){
    $pbook['user_id'] = $_POST['user_id'] ?? '';
    $pbook['sp_name'] = $_POST['sp_name'] ?? '';
    $pbook['team'] = $_POST['team'] ?? '';
    $pbook['picture'] = $_FILES['picture']['name'] ?? '';
    $pbook['description'] = $_POST['description'] ?? '';
    return $pbook;
}
function validatePbook(){
    if(isset($pbook['sp_name']) == ''){
        $error['sp_name'] = 'blank';
    }elseif(mb_strlen($pbook['sp_name']) > 50){
        $error['sp_name'] = 'length';
    }
    if(isset($pbook['team']) == ''){
        $error['team'] = 'blank';
    }
    if(isset($pbook['picture']) == ''){
        $error['picture'] = 'blank';
    }
    $filename = $_FILES['picture']['name'];
    if(!empty($filename)){
        $ext = substr($filename, -3);
        if($ext != 'jpg' && $ext != 'JPG' && $ext != 'png'){
            $error['picture'] = 'type';
        }
    }
    if(isset($pbook['description']) == ''){
        $error['description'] = 'blank';
    }
    return $error;
}

