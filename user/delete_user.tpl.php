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
                    <li>ようこそ！<a href="<?php URL_ROOT ?>mypage.php?page=0&user_id=<?=$_SESSION['id']?>"><?=$_SESSION['nickname']?>さん</a>!</li>
                    <li><a href="<?php URL_ROOT ?>./../new.php"> 写真投稿 </li>
                    <li><a href="<?php URL_ROOT ?>./../login/logout.php">ログアウト </a></li>
                <ul>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="user_delete_container">
    <p></p>
    <h3><?php h($user['nickname']); ?>のユーザー情報を削除しますか？</h3>
    <p>※投稿したデータも全て失われますがよろしいですか？</p>
    <p></p>
    <a href="delete_user_complete.php"><p>削除する</p></a>
    <a href="mypage.php?page=0&user_id=<?=$_SESSION['id']; ?>"><p>マイページに戻る</p></a>
</div>
<div class="footer">
    <hr>
    <p><a href="../room.php">班一覧に戻る</a></p>
    <?php include('../footer_inc.php') ?>
</div>
