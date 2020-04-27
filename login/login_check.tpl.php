<!DOCTYPE html>
<html>
<?php include('header_inc.php'); ?>
<body class="pbook">
<div class="login_check_container">
    <h2>ログインに成功しました！</h2>
    <p></p>
    <p><a href="../user/mypage.php?page=0&user_id=<?=$_SESSION['id'];?>">マイページへ移動</a></p>
    <p><a href="./../room.php">班一覧へ戻る</a></p>
    <p><a href="./../new.php">写真投稿</a></p>
    <p><a href="logout.php">ログアウト</a></p>
    <p></p>
</div>
<div class="footer">
    <?php include('../footer_inc.php'); ?>
</div>
</body>
</html>