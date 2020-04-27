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
<div class="myimg_check_container">
    <div class="myimg_check_title">
        <p></p>
        <h3><?=$message; ?></h3>
    </div>
    <div class="image_form">
        <p><a href="myimg_edit.php">画像を選び直す</a></p>
        <form action="myimg_update.php" method="post" enctype="multipart/form-data">
            <label>新しいプロフィール画像</label>
            <p></p>
            <?php if(isset($user['newImage'])):?>
            <img class="img" src="../files/<?php h($user['newImage']); ?>" 
            width="300" height="300" alt="" />
            <?php endif; ?>
            <p></p>
            <input type="submit" name="submit" value="更新する"> 
        </form>
        <hr>
    </div>
</div>
<div class="footer">
	<p><a href="../room.php">班一覧に戻る</a></p>
	<?php include('../footer_inc.php'); ?>
</div>
</body>
</html>