<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>

<body>
<p><a href="login/logout.php">ログアウト</a></p>
<h2><?php h($message) ; ?></h2>
    <p></p>
        <p>[種名]:<?php h($pbook['sp_name'])."\n<br>" ?></p>
        <p>[写真]:<img src="files/<?php h($pbook['picture']); ?>" 
        width="300" height="300" alt="" /> <br></p>
        <p>[説明]:<?php hbr($pbook['description'])."\n<br>"; ?></p>

        
        <p><a href="delete.php?id=<?=$pbook['id'] ?>&team=<?=$pbook['team'] ?>">投稿を削除</a></p>
        <p><a href="room.php">班一覧に戻る</a></p>

<?php include('footer_inc.php') ?>
</body>
</html>