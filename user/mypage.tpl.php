<!DOCTYPE html>
<html>
<?php include('../header_inc.php'); ?>
<body>
<h2><?php h($message) ;?></h2>
<p></p>
<label>名前</label>
<?php h($member['nickname']); ?>
<p></p>
<label>プロフィール画像</label>
<p></p>
<img src="../files/<?php h($member['image']); ?>" 
width="300" height="300" alt="" />
<p></p>
<label>自己紹介文</label>
<?php  h($member['introduction']); ?>
<p></p>
<label>生年月日</label>
<?=$member['birthday'] ; ?>
<p></p>
<label>性別</label>
<?php if($member['gender'] == 'male'){echo '男';}; ?>
<?php if($member['gender'] == 'female'){echo '女';}; ?>
<?php if($member['gender'] == 'unselected'){echo '未選択';}; ?>
<p></p>
<label>班</label>
<?php if($member['team'] == 'sea'){echo '海';} ;?>
<?php if($member['team'] == 'kinoko'){echo 'きのこ';} ;?>
<?php if($member['team'] == 'plant'){echo '植物';} ;?>
<p></p>
<!-- $memberから値をとってきて表示する -->
<label>ID(メールアドレス）</label>
<?php h($member['email']); ?>
<p></p>
<h2>投稿一覧</h2>
<?php foreach($pbooks as $pbook): ?>
        <hr>
        <p>[種名]:<?php h($pbook['sp_name']); ?><br></p>
        <p>[写真]:<img src="../files/<?php h($pbook['picture']); ?>" 
        width="300" height="300" alt="" />
        <br></p>
        <p>[説明]:<br><?php hbr($pbook['description']); ?><br></p>
        <?php if(((isset($_SESSION['id']))&&($_SESSION['time']+3600)>time()) && $_SESSION['id'] == $pbook['user_id']):?>
        <p><a href='../edit.php?id=<?=$pbook['id']; ?>'>投稿を編集</a></p>
        <p><a href='../delete_check.php?id=<?=$pbook['id']; ?>&team=<?=$pbook['team']?>'>投稿を削除</a></p>
    <?php endif; ?>
    <?php endforeach; ?>

<p></p>
<hr>
<p><a href="../room.php">班一覧に戻る</a></p>

<p></p>

<?php include('../footer_inc.php'); ?>
</body>