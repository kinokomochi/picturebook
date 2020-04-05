<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>
<body>
<h3><?php echoSearchResult($total) ?></h3>
<?php foreach($pbooks as $pbook): ?>
<p><?php h($pbook['nickname']) ;?>さんの投稿</p>
<p>[種名]:<?php h($pbook['sp_name']); ?><br></p>
<p>[写真]:<img src="files/<?php h($pbook['picture']); ?>" 
width="300" height="300" alt="" />
<br></p>
<p>[説明]:<br><?php hbr($pbook['description']); ?><br></p>
<?php if($login && $_SESSION['id'] == $pbook['user_id']):?>
<p><a href='edit.php?id=<?=$pbook['id']; ?>'>投稿を編集</a></p>
<p><a href='delete_check.php?id=<?=$pbook['id']; ?>&team=<?=$pbook['team']?>'>投稿を削除</a></p>
<? endif; ?>
<?php endforeach; ?>
<?php for($i=0; $i < $pages; $i++) : ?>
    <?php if($_GET['page'] == $i): ?>
    <?=$_GET['page']+1  .'ページ'; ?>
    <?php else: ?>
    <?php printf("<a href='?page=%d&keyword=%s'>%dページへ</a><br />\n", $i,$_GET['keyword'], $i+1); ?>
    <?php endif; ?>
    <?php endfor; ?>
<hr>
    <p><a href="room.php">班一覧に戻る</a></p>
    <p><a href="new.php"> 写真登録</a></p>

<?php include('footer_inc.php') ?>

</body>
</html>