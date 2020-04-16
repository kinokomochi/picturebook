<!DOCTYPE html>
<html>
<?php include('../header_inc.php') ?>
<body>
<?php if(isset($message)): ?>
<h2><?php h($message); ?></h2>
<?php endif; ?>
<form action="myemail_check.php" method="post">
<label>ID(メールアドレス）</label>
<input type="text" name="email" value="<?php if(isset($user['email']) && $user['email'] != ''){echo $user['email'];} ?>">
<?php if(isset($error['email']) && $error['email'] == 'blank'): ?>
<p>＊ID（メールアドレス）を入力して下さい＊</p>
<?php endif; ?>
<?php if(isset($error['email']) && $error['email'] =='failed'): ?>
<p>＊正しいメールアドレスを登録してください＊</p>
<?php endif; ?>
<?php if(isset($error['email']) && $error['email'] == 'duplicate'): ?>
<p>＊他のメールアドレスを登録してください*</p>
<?php endif; ?>
<p></p>
<input type="submit" name="submit" value="登録確認画面へ">
</form>
<hr>
<p><a href="../room.php">班一覧に戻る</a></p>

<?php include('../footer_inc.php') ?>
