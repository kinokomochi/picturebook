<!DOCTYPE html>
<html>
<?php include('../header_inc.php'); ?>
<body>
<h3><?=$message; ?></h3>
<form action="myemail_update.php" method="post">
<p></p>
<label>ID(メールアドレス）</label>
<input type="hidden" name="email" value="<?=$user['email']; ?>">
<?php if(isset($user['email'])){ h($user['email']);}; ?>
<p></p>
<input type="submit" name="submit" value="更新する"> 
</form>
<a href="myemail_edit.php?action=rewrite"><p>編集し直す</p></a>
<hr>
<p><a href="../room.php">班一覧に戻る</a></p>
<?php include('../footer_inc.php'); ?>
</body>
</html>