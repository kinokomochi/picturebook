<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>
<body class="pbook">
<div class="fixed-top">
    <div class="header navbar navbar-dark bg-dark shadow-sm">    
        <div class="header_logo">PictureBook</div>
        <div class="header_list">
            <ul>
                <li><a href="<?php URL_ROOT ?>./../login/login.php"> ログイン </li>
                <li><a href="<?php URL_ROOT ?>./../login/signup.php">サインアップ </a></li>
            <ul>
        </div>
    </div>
</div>
<div class="user_delete_container">
    <p></p>
    <h3>削除が完了しました</h3>
</div>
<div class="footer">
    <hr>
    <p><a href="../room.php">班一覧に戻る</a></p>
    <?php include('../footer_inc.php') ?>
</div>
