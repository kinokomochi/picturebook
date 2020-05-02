<?php 
session_start(); 
require_once __DIR__ . '/vendor/autoload.php';
$login = checkLoginStatus(); 
?>
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
            <?php elseif(!$login): ?>
                <ul>
                    <li>ログインして図鑑を投稿してね！</li>
                    <li><a href="<?php URL_ROOT ?>login/login.php">ログイン </a></li>
                    <li><a href="<?php URL_ROOT ?>login/signup.php">メンバー登録 </a></li>
                </ul>
            <?php endif ;?>
        </div>
    </div>
</div>
<br>

<div class="main_row">
    <div class="main_title col-md-12">
        <h1>オリジナル図鑑</h1>
    </div>
    <div class="row">
        <div class="main_menu col-md-4">
            <p>きのこの部屋</p>
            <div class="image_kinoko">
                <a href="index.php?page=0&team=kinoko">
                <img src="image/kinoko.png" 
                            width="200" height="200" alt="" /></a>
            </div>
        </div>
        <div class="main_menu col-md-4">
        <p>海の部屋</p>
            <a href="index.php?page=0&team=sea">
            <div class="image_sea">
                <img class="img_sea" src="image/fish_nishikianago_swim.png" 
                            width="200" height="200" alt="" /></a>
            </div>
        </div>
        <div class="main_menu col-md-4">
        <p>植物の部屋</p>
            <a href="index.php?page=0&team=plant">
            <div class="image_plant">
                <img class="img_plant" src="image/plant_haetorigusa.png" 
                            width="200" height="200" alt="" /></a>
            </div>
        </div>

    </div>
</div>
<div class="footer">
    <?php include('footer_inc.php') ?>
</div>
</body>
</html>

