<!DOCTYPE html>
<html>
<?php include('header_inc.php'); ?>
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
<div class="email_check_container">
    <h3><?php h($message); ?></h3>
    <form action="myemail_update.php" method="post">
        <input type="hidden" name="token" value="<?=CsrfValidator::generate() ?>">
        <p></p>
        <label>ID(メールアドレス）</label>
        <input type="hidden" name="email" value="<?=$user['email']; ?>">
        <?php if(isset($user['email'])){ h($user['email']);}; ?>
        <p></p>
        <input type="submit" name="submit" value="更新する"> 
    </form>
    <a href="myemail_edit.php?action=rewrite"><p>編集し直す</p></a>
</div>
<div class="footer">
    <hr>
    <p><a href="../room.php">班一覧に戻る</a></p>
    <?php include('../footer_inc.php'); ?>
</div>
</body>
</html>