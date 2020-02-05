<!DOCTYPE html>
<html>
<?php include('../header_inc.php') ?>
<body>
<h2><?=$message ; ?></h2>
    <p></p>
   
    <?php foreach($pbooks as $pbook){ ?>
        <hr>
        <p>[種名]:<?=$pbook['sp_name']."\n<br>" ?></p>
        <p>[写真]:<?=$pbook['picture']."\n<br>" ?></p>
        <p>[説明]:<?= $pbook['description']."\n<br>"; ?></p>
        <p><a href='../edit.php?id=<?=$pbook['id'] ?>'>投稿を編集</a></p>
        <p><a href='../delete_check.php?id=<?=$pbook['id'] ?>&team=<?=$pbook['team']?>'>投稿を削除</a></p>
    <?php } ?>
    <hr>
    <p><a href='../room.php'>班一覧に戻る</a></p>
        <p><a href='../new.php'> 写真登録</a></p>






<?php include('../footer_inc.php') ?>
</body>
</html>