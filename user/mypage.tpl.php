<!DOCTYPE html>
<html>
<?php include('../header_inc.php'); ?>
<body>
<h2><?php h($message) ;?></h2>
<p></p>
<label>名前</label>
<?php h($user['nickname']); ?>
<p></p>
<label>プロフィール画像</label>
<p></p>
<img src="../files/<?php h($user['image']); ?>" 
width="300" height="300" alt="" />
<p></p>
<label>自己紹介文</label>
<?php  h($user['introduction']); ?>
<p></p>
<label>生年月日</label>
<?=$user['birthday'] ; ?>
<p></p>
<label>性別</label>
<?php if($user['gender'] == 'male'){echo '男';}; ?>
<?php if($user['gender'] == 'female'){echo '女';}; ?>
<?php if($user['gender'] == 'unselected'){echo '未選択';}; ?>
<p></p>
<label>班</label>
<?php if($user['team'] == 'sea'){echo '海';} ;?>
<?php if($user['team'] == 'kinoko'){echo 'きのこ';} ;?>
<?php if($user['team'] == 'plant'){echo '植物';} ;?>
<p></p>

<label>ID(メールアドレス）</label>
<?php h($user['email']); ?>
<p></p>
<tr>
<p><a href="myimg_edit.php">画像編集</a>
<a href="myprofile_edit.php">プロフィール編集</a>
<a href="myemail_edit.php">Email編集</a>
<a href="myPassword_edit.php">PW編集</p></a>
</tr>
<h2><?=$user['nickname']; ?>さんの投稿一覧</h2>
<?php if(isset($pbooks[0]['id']) != null): ?>
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
    <p><a href="../new.php">投稿する</a></p>
<?php else:?>
<h4>まだ投稿がありません</h4>
<p><a href="../new.php">投稿する</a></p>
<?php endif; ?>

<?php for($i=0; $i < $pages; $i++) : ?>
    <?php if($_GET['page'] == $i): ?>
        <?=$_GET['page']+1 .'ページ'; ?>
        <?php else: ?>
        <?php printf("<a href='?page=%d'>%dページへ</a><br />\n", $i, $i+1); ?>
    <?php endif; ?>
 <?php endfor; ?>


<p></p>
<hr>
<p><a href="../room.php">班一覧に戻る</a></p>
<p><a href="delete_user.php">退会する</a></p>

<p></p>

<?php include('../footer_inc.php'); ?>
</body>