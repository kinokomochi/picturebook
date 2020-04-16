<!DOCTYPE html>
<html>
<?php include('../header_inc.php') ?>
<body>
<?php if(isset($message)): ?>
<h2><?php h($message); ?></h2>
<?php endif; ?>
<form action="myPassword_check.php" method="post">

<label>現在のパスワード</label>
<input type="text" name="currentPass">
<?php if(isset($cerror['currentPass']) && $cerror['currentPass'] == 'blank'): ?>
<p>＊パスワードを入力して下さい＊</p>
<?php endif; ?>
<?php if(isset($cerror['currentPass']) && $cerror['currentPass'] == 'notpass'): ?>
<p>＊正しいパスワードを入力して下さい＊</p>
<?php endif; ?>

<p></p>
<label>新しいパスワード</label>
<p>（＊大文字・小文字を含む8文字以上20文字以下の英数字で入力してください＊）</p>
<input type="text" name="newPass">
<?php if(isset($error['newPass']) && $error['newPass'] == 'blank'): ?>
<p>＊パスワードを入力して下さい＊</p>
<?php endif; ?>
<?php if(isset($error['newPass']) && $error['newPass'] == 'illegal'): ?>
<p>＊正しい形式でパスワードを入力して下さい＊</p>
<?php endif; ?>
<?php if(isset($error['newPass']) && $error['newPass'] == 'failed'): ?>
<p>＊パスワードが一致しません＊</p>
<?php endif; ?>
<p></p>
<label>パスワード(再入力）</label>
<p></p>
<input type="text" name="password_re_enter">
<?php if(isset($error['password_re_enter']) && $error['password_re_enter'] == 'blank'): ?>
<p>＊パスワードを再入力して下さい＊</p>
<?php endif; ?>
<p></p>
<input type="submit" name="submit" value="登録確認画面へ">
</form>
<hr>
<p><a href="../room.php">班一覧に戻る</a></p>

<?php include('../footer_inc.php') ?>
