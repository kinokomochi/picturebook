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