<!DOCTYPE html>
<html>
<?php include('../header_inc.php'); ?>
<body>
<h2><?php h($message) ;?></h2>
<p></p>
<form action="signup_complete.php" method="post">
<label>名前</label>
<?php if(isset($name)){ h($name);}; ?>
<input type="hidden" name="name" value="<?=$name; ?>">
<p></p>
<label>プロフィール画像</label>
<input type="hidden" name="image" value="<?=$image; ?>">
<p></p>
<?php if(isset($image)):?>
<img src="../files/<?php h($image); ?>" 
width="300" height="300" alt="" />
<?php endif; ?>
<p></p>
<label>生年月日</label>
<?php if(isset($year) && isset($month) && isset($day)): ?>
<?php $birthday = $year . "-" . $month . "-" . $day; ?>
<?=$birthday ; ?>
<?php endif; ?>
<input type="hidden" name="birthday" value="<?=$birthday; ?>">
<p></p>
<label>班</label>
<input type="hidden" name="team" value="<?=$team; ?>">
<?php if(isset($team) && $team == 'sea'){echo '海';} ;?>
<?php if(isset($team) && $team == 'kinoko'){echo 'きのこ';} ;?>
<?php if(isset($team) && $team == 'plant'){echo '植物';} ;?>
<p></p>
<label>ID(メールアドレス）</label>
<input type="hidden" name="email" value="<?=$email; ?>">
<?php if(isset($email)){ h($email);}; ?>
<p></p>
<label>パスワード</label>
<input type="hidden" name="password" value="<?=$password; ?>">
<?php if(isset($password)){echo '********';}; ?>
<p></p>
<input type="submit" name="submit" value="登録内容送信">
</form>
<hr>
<p><a href="../room.php">班一覧に戻る</a></p>

<p></p>

<?php include('../footer_inc.php'); ?>
</body>