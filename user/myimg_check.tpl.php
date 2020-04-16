<!DOCTYPE html>
<html>
<?php include('../header_inc.php'); ?>
<body>
<h3><?=$message; ?></h3>
<p><a href="myimg_edit.php">画像を選び直す</a></p>
<form action="myimg_update.php" method="post" enctype="multipart/form-data">
<label>新しいプロフィール画像</label>
<p></p>
<?php if(isset($user['newImage'])):?>
<img src="../files/<?php h($user['newImage']); ?>" 
width="300" height="300" alt="" />
<?php endif; ?>
<input type="submit" name="submit" value="更新する"> 
</form>
<hr>
<p><a href="../room.php">班一覧に戻る</a></p>
<?php include('../footer_inc.php'); ?>
</body>
</html>