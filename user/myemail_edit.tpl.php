<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>
<body>
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
<div class="email_edit_container">
    <?php if(isset($message)): ?>
    <p></p>
    <h2><?php h($message); ?></h2>
    <?php endif; ?>
    <form action="myemail_check.php" method="post">
        <div class="form-group">
            <label>ID(メールアドレス）</label>
            <input type="text" name="email" class="form-control"  value="<?php if(isset($user['email']) && $user['email'] != ''){h($user['email']);} ?>">
            <?php if(isset($error['email']) && $error['email'] == 'blank'): ?>
            <p class="error">＊ID（メールアドレス）を入力して下さい＊</p>
            <?php endif; ?>
            <?php if(isset($error['email']) && $error['email'] =='failed'): ?>
            <p class="error">＊正しいメールアドレスを登録してください＊</p>
            <?php endif; ?>
            <?php if(isset($error['email']) && $error['email'] == 'duplicate'): ?>
            <p class="error">＊他のメールアドレスを登録してください*</p>
            <?php endif; ?>
            <p></p>
        </div>
        <input type="submit" name="submit" value="登録確認画面へ">
    </form>
    <hr>
</div>
<div class="footer">
    <p><a href="../room.php">班一覧に戻る</a></p>
    <?php include('../footer_inc.php') ?>
</div>
