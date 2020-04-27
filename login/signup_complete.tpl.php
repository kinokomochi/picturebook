<!DOCTYPE html>
<html>
<?php include('header_inc.php'); ?>
<body class="pbook">
<div class="signupcmp_container">
<h2>登録が完了しました。</h2>
<hr>
    <p><a href="../user/mypage.php?page=0&user_id=<?=$_SESSION['id'];?>">マイページへ移動</a></p>
    <p><a href="../room.php">班一覧に戻る</a></p>
</div>
<div class="footer">
    <?php include('../footer_inc.php'); ?>
</div>
</body>
</html>