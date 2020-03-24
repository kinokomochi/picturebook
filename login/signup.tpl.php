<!DOCTYPE html>
<html>
<?php include('../header_inc.php') ?>
<body>
<h2><?php h($message); ?></h2>
<form action="signup_check.php" method="post" enctype="multipart/form-data">
<label>名前</label>
<input type="text" name="name" value="<?php if(isset($user['name'])){echo $user['name'];} ?>">
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
<p>＊もう一度画像を登録してください＊</p>
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
<label>パスワード</label>
<p>（＊大文字・小文字を含む8文字以上20文字以下の英数字で入力してください＊）</p>
<input type="text" name="password">
<?php if(isset($error['password']) && $error['password'] == 'blank'): ?>
<p>＊パスワードを入力して下さい＊</p>
<?php endif; ?>
<?php if(isset($error['password']) && $error['password'] == 'illegal'): ?>
<p>＊正しい形式でパスワードを入力して下さい＊</p>
<?php endif; ?>
<?php if(isset($error['password']) && $error['password'] == 'failed'): ?>
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
<hr>
<p><a href="../room.php">班一覧に戻る</a></p>


</form>
<?php include('../footer_inc.php') ?>
