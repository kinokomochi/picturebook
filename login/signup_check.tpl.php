<!DOCTYPE html>
<html>
<?php include('../header_inc.php'); ?>
<body>
<h2><?php h($message) ;?></h2>
<p></p>
<form action="signup_complete.php" method="post">
<input type="hidden" name="token" value="<?=$token; ?>">
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
<label>自己紹介文</label>
<input type="hidden" name="introduction" value="<?=$introduction; ?>">
<?php if(isset($introduction)){ h($introduction);}; ?>
<p></p>
<label>生年月日</label>
<?php if(isset($year) && isset($month) && isset($day)): ?>
<?php $birthday = $year . "-" . $month . "-" . $day; ?>
<?=$birthday ; ?>
<?php endif; ?>
<input type="hidden" name="birthday" value="<?=$birthday; ?>">
<p></p>
<label>性別</label>
<input type="hidden" name="gender" value="<?=$gender; ?>">
<?php if(isset($gender) && $gender == 'male'){echo '男';}; ?>
<?php if(isset($gender) && $gender == 'female'){echo '女';}; ?>
<?php if(isset($gender) && $gender == 'unselected'){echo '未選択';}; ?>
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