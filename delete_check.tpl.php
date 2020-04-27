<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>

<body class="pbook">
<div class="fixed-top">
    <div class="header navbar navbar-dark bg-dark shadow-sm">    
        <div class="header_logo">PictureBook</div>
        <div class="header_list">
            <?php if($login): ?>
                <ul>
                    <li>ようこそ！<a href="<?php URL_ROOT ?>user/mypage.php?page=0&user_id=<?=$_SESSION['id']?>"><?=$_SESSION['nickname']?>さん</a>!</li>
                    <li><a href="<?php URL_ROOT ?>new.php"> 写真投稿 </li>
                    <li><a href="<?php URL_ROOT ?>login/logout.php">ログアウト </a></li>
                <ul>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="delete_title">
    <h2><?php h($message) ; ?></h2>
    <p></p>
</div>
<div class="delete_container">
    <div class="delete_picture">
        <p><img class="img" src="files/<?php h($pbook['picture']); ?>" 
        width="300" height="300" alt="" /></p>
    </div>
    <p class="sp_name"><?php h($pbook['sp_name'])."\n<br>" ?></p>
    <p><?php hbr($pbook['description'])."\n<br>"; ?></p>
    <div class="delete_link">
        <p><a href="delete.php?id=<?=$pbook['id'] ?>&team=<?=$pbook['team'] ?>">投稿を削除</a></p>
    </div>
</div>
<div class="footer">
    <p><a href="room.php">班一覧に戻る</a></p>
    <?php include('footer_inc.php') ?>
</div>
</body>
</html>