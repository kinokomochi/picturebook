<!DOCTYPE html>
<html>
<?php include('../header_inc.php'); ?>
<body>
<label>プロフィール画像</label>
<p></p>
<a href="myimg_edit.php"><img src="../files/<?php h($_SESSION['image']); ?>" 
width="300" height="300" alt="" /></a>
<p></p>
<h3><?=$message ;?></h3>
<form action="myprofile_check.php" method="post">
<input type="hidden" name="image" value="<?php h($user['image']); ?>">
<label>名前</label>
<input type="text" name="nickname" value="<?php if(isset($user['nickname'])){echo $user['nickname'];} ?>">
<?php if(isset($error['nickname']) && $error['nickname'] == 'blank'): ?>
<p>＊名前を入力して下さい＊</p>
<?php endif; ?>
<?php if(isset($error['nickname']) && $error['nickname'] == 'length'): ?>
<p>＊名前は20文字以内で入力して下さい＊</p>
<?php endif; ?>
<p></p>
<label>自己紹介文</label>
<textarea name="introduction" row="40" cols="80"><?php if(isset($user['introduction'])){echo $user['introduction'];} ?></textarea>
<?php if(isset($error['introduction']) && $error['introduction'] == 'blank'): ?>
<p>＊自己紹介文をを登録して下さい＊</p>
<?php endif; ?>

<p></p>
<label>生年月日</label>
<select name="year">
<?php optionLoop('1950', date('Y'), $user['year']); ?> 
</select>年
<select name="month">
<?php optionLoop('1', 12, $user['month']); ?> 
</select>月
<select name="day">
<?php optionLoop('1',31, $user['day']); ?> 
</select>日
<?php if(isset($error['birthday']) && $error['birthday'] == 'failed'): ?>
<p>＊存在する生年月日を入力して下さい＊</p>
<?php endif; ?>
<p></p>
<label>性別</label>
<td>男<input type="radio" name="gender" value="male"<?php if(isset($user['gender']) && $user['gender'] == 'male'){echo 'checked';}?>></td>
<td>女<input type="radio" name="gender" value="female"<?php if(isset($user['gender']) && $user['gender'] == 'female'){echo 'checked';}?>></td>
<td>未選択<input type="radio" name="gender" value="unselected"<?php if(isset($user['gender']) && $user['gender'] == 'unselected'){echo 'checked';}?>></td>
<?php if(isset($error['gender']) && $error['gender'] == 'blank'): ?>
<p>＊性別を選択して下さい＊</p>
<?php endif; ?>
<p></p>
<label>班</label>
<select name="team">
<option value="">選択してね</option>
<option value="sea"<?php if(isset($user['team']) && $user['team'] == 'sea'){echo 'selected';} ?>>海</option>
<option value="kinoko"<?php if(isset($user['team']) && $user['team'] == 'kinoko'){echo 'selected';} ?>>きのこ</option>
<option value="plant"<?php if(isset($user['team']) && $user['team'] == 'plant'){echo 'selected';} ?>>植物</option>
</select>
<?php if(isset($error['team']) && $error['team'] == 'blank'): ?>
<p>＊班を選択して下さい＊</p>
<?php endif; ?>
<p></p>
<input type="submit" name="submit" value="登録確認画面へ">
</form>
<hr>
<p><a href="../room.php">班一覧に戻る</a></p>


<?php include('../footer_inc.php'); ?>
</body>
</html>