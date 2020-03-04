<?php 
function h($str){
    echo htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function hbr($str){
    echo nl2br(htmlspecialchars($str, ENT_QUOTES, 'UTF-8'));
}

function optionLoop($start, $end){
    echo '<option value="">選択してね</option>';
    for($i=$start; $i<=$end; $i++){
        $i = sprintf('%02d', $i);
        echo "<option value=\"{$i}\">{$i}</option>";
    }
}