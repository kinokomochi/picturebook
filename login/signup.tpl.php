<!DOCTYPE html>
<html>
<?php include('../header_inc.php') ?>
<body>
<h2><?=$message; ?></h2>
<!-- <?php //var_dump($error); ?> -->
<form action="signup_check.php" method="post" enctype="multipart/form-data">
<label>名前</label>
<input type="text" name="name" value="<?php if(isset($name) && $name != ''){echo $name;} ?>">
<?php if(isset($error['name']) && $error['name'] == 'blank'): ?>
<p>＊名前を入力して下さい＊</p>
<?php endif; ?>
<?php if(isset($error['name']) && $error['name'] == 'length'): ?>
<p>＊名前は20文字以内で入力して下さい＊</p>
<?php endif; ?>
<p></p>
<label>プロフィール画像</label>
<input type="file" name="image">
<?php if(isset($error['image']) && $error['image'] == 'type'): ?>
<p>＊画像は「gif」または「png」形式で登録して下さい＊</p>
<?php endif; ?>
<?php if(isset($error['image']) && $error['image'] == 'blank'): ?>
<p>＊画像を登録して下さい＊</p>
<?php endif; ?>
<?php if(!isset($error['image']) && !empty($error)): ?>
<p>*もう一度画像を登録してください*</p>
<?php endif; ?>
<p></p>
<label>生年月日</label>
<select name="year">
<?php optionLoop('1950', date('Y')); ?> 
</select>年
<select name="month">
<?php optionLoop('1', 12); ?> 
</select>月
<select name="day">
<?php optionLoop('1',31); ?> 
</select>日
<?php if(isset($error['birthday']) && $error['birthday'] == 'failed'): ?>
<p>＊存在する生年月日を入力して下さい＊</p>
<?php endif; ?>

<p></p>
<label>班</label>
<select name="team">
<option value="">選択してね</option>
<option value="sea"<?php if(isset($team) && $team == 'sea'){echo 'selected';} ?>>海</option>
<option value="kinoko"<?php if(isset($team) && $team == 'kinoko'){echo 'selected';} ?>>きのこ</option>
<option value="plant"<?php if(isset($team) && $team == 'plant'){echo 'selected';} ?>>植物</option>
</select>
<?php if(isset($error['team']) && $error['team'] == 'blank'): ?>
<p>＊班を選択して下さい＊</p>
<?php endif; ?>
<p></p>
<label>ID(メールアドレス）</label>
<input type="text" name="email" value="<?php if(isset($email) && $email != ''){echo $email;} ?>">
<?php if(isset($error['email']) && $error['email'] == 'blank'): ?>
<p>＊ID（メールアドレス）を入力して下さい＊</p>
<?php endif; ?>
<p></p>
<label>パスワード</label>
<input type="text" name="password">
<?php if(isset($error['password']) && $error['password'] == 'blank'): ?>
<p>＊パスワードを入力して下さい＊</p>
<?php endif; ?>
<?php if(isset($error['password']) && $error['password'] == 'failed'): ?>
<p>＊パスワードが一致しません＊</p>
<?php endif; ?>
<p></p>
<label>パスワード(再入力）</label>
<input type="text" name="password_re_enter">
<?php if(isset($error['password_re_enter']) && $error['password_re_enter'] == 'blank'): ?>
<p>＊パスワードを再入力して下さい＊</p>
<?php endif; ?>
<p></p>
<input type="submit" name="submit" value="登録確認画面へ">

</form>
<?php include('../footer_inc.php') ?>
