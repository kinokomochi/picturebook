<!DOCTYPE html>
<html>
<?php include('../header_inc.php'); ?>
<body>
<h2><?=$message; ?></h2>
<!-- <p><?=$msg; ?> -->
<form action="login_check.php" method="post">
<?php if(isset($error['login']) && $error['login'] == 'failed'): ?>
<p>＊ID(メールアドレス)・パスワードいずれかの認証に失敗しました＊</p>
<?php endif; ?>
<label>ID(メールアドレス)</label>
<input type="text" name="email">
<?php if(isset($error['email']) && $error['email'] == 'blank'): ?>
<p>＊ID(メールアドレス)が入力されていません＊</p>
<?php endif; ?>
<p></p>
<label>パスワード<label>
<input type="text" name="password">
<?php if(isset($error['password']) && $error['password'] == 'blank'): ?>
<p>＊パスワードが入力されていません*</p>
<?php endif; ?>
<p></p>
<input type="submit" name="submit" value="ログイン">
<p></p>
</form>


<?php include('../footer_inc.php'); ?>
</body>
</html>