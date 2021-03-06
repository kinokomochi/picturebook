<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>
<body class="pbook">
<div class="signup_text">
    <h2><?php h($message); ?></h2>
</div>
<div class="signup_container">
    <form action="signup_check.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="token" value="<?=CsrfValidator::generate() ?>">
    <div class="form_group">
        <label>名前</label>
        <input type="text" name="nickname" class="form-control" value="<?php if(isset($user['nickname'])){echo $user['nickname'];} ?>">
        <?php if(isset($error['nickname']) && $error['nickname'] == 'blank'): ?>
        <p class="error">＊名前を入力して下さい＊</p>
        <?php endif; ?>
        <?php if(isset($error['nickname']) && $error['nickname'] == 'length'): ?>
        <p class="error">＊名前は20文字以内で入力して下さい＊</p>
        <?php endif; ?>
        <p></p>
    </div>
    <div class="form_group">
        <label>プロフィール画像</label><br>
        <input type="file" name="image">
        <?php if(isset($error['image']) && $error['image'] == 'type'): ?>
        <p class="error">＊画像は「jpg」または「png」形式で登録して下さい＊</p>
        <?php endif; ?>
        <?php if(isset($error['image']) && $error['image'] == 'blank'): ?>
        <p class="error">＊画像を登録して下さい＊</p>
        <?php endif; ?>
        <?php if(!isset($error['image']) && (!empty($error)) || !empty($emailError) || !empty($passwordError)): ?>
        <p class="error">＊もう一度画像を登録してください＊</p>
        <?php endif; ?>
        <p></p>
    </div>
    <div class="form_group">
        <label>自己紹介文</label>
        <textarea name="introduction" row="40" cols="80" class="form-control"><?php if(isset($user['introduction'])){echo $user['introduction'];} ?></textarea>
        <?php if(isset($error['introduction']) && $error['introduction'] == 'blank'): ?>
        <p class="error">＊自己紹介文をを登録して下さい＊</p>
        <?php endif; ?>
        <p></p>
    </div>
    <div class="form_group">
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
        <p class="error">＊存在する生年月日を入力して下さい＊</p>
        <?php endif; ?>
        <p></p>
    </div>
    <div class="form_group">
        <label>性別</label>
        <td>男<input type="radio" name="gender" value="male"<?php if(isset($user['gender']) && $user['gender'] == 'male'){echo 'checked';}?>></td>
        <td>女<input type="radio" name="gender" value="female"<?php if(isset($user['gender']) && $user['gender'] == 'female'){echo 'checked';}?>></td>
        <td>未選択<input type="radio" name="gender" value="unselected"<?php if(isset($user['gender']) && $user['gender'] == 'unselected'){echo 'checked';}?>></td>
        <?php if(isset($error['gender']) && $error['gender'] == 'blank'): ?>
        <p class="error">＊性別を選択して下さい＊</p>
        <?php endif; ?>
        <p></p>
    </div>
    <div class="form_group">
        <label>班</label>
        <select name="team">
        <option value="">選択してね</option>
        <option value="sea"<?php if(isset($user['team']) && $user['team'] == 'sea'){echo 'selected';} ?>>海</option>
        <option value="kinoko"<?php if(isset($user['team']) && $user['team'] == 'kinoko'){echo 'selected';} ?>>きのこ</option>
        <option value="plant"<?php if(isset($user['team']) && $user['team'] == 'plant'){echo 'selected';} ?>>植物</option>
        </select>
        <?php if(isset($error['team']) && $error['team'] == 'blank'): ?>
        <p class="error">＊班を選択して下さい＊</p>
        <?php endif; ?>
        <p></p>
    </div>
    <div class="form_group">
        <label>ID(メールアドレス）</label>
        <input type="text" name="email" class="form-control" value="<?php if(isset($user['email']) && $user['email'] != ''){echo $user['email'];} ?>">
        <?php if(isset($emailError['email']) && $emailError['email'] == 'blank'): ?>
        <p class="error">＊ID（メールアドレス）を入力して下さい＊</p>
        <?php endif; ?>
        <?php if(isset($emailError['email']) && $emailError['email'] =='failed'): ?>
        <p class="error">＊正しいメールアドレスを登録してください＊</p>
        <?php endif; ?>
        <?php if(isset($emailError['email']) && $emailError['email'] == 'duplicate'): ?>
        <p class="error">＊他のメールアドレスを登録してください*</p>
        <?php endif; ?>
        <p></p>
    </div>
    <div class="form_group">
        <label>パスワード</label>
        <p>（＊大文字・小文字を含む8文字以上20文字以下の英数字で入力してください＊）</p>
        <input type="password" name="password">
        <?php if(isset($passwordError['password']) && $passwordError['password'] == 'blank'): ?>
        <p class="error">＊パスワードを入力して下さい＊</p>
        <?php endif; ?>
        <?php if(isset($passwordError['password']) && $passwordError['password'] == 'illegal'): ?>
        <p class="error">＊正しい形式でパスワードを入力して下さい＊</p>
        <?php endif; ?>
        <?php if(isset($passwordError['password']) && $passwordError['password'] == 'failed'): ?>
        <p class="error">＊パスワードが一致しません＊</p>
        <?php endif; ?>
        <p></p>
    </div>
    <div class="form_group">
        <label>パスワード(再入力）</label><br>
        <input type="password" name="password_re_enter">
        <?php if(isset($passwordError['password_re_enter']) && $passwordError['password_re_enter'] == 'blank'): ?>
        <p class="error">＊パスワードを再入力して下さい＊</p>
        <?php endif; ?>
        <p></p>
    </div>
    <input type="submit" name="submit" value="登録確認画面へ">
    </form>
</div>
<hr>
<div class="footer">
    <p><a href="../room.php">班一覧に戻る</a></p>
    <?php include('../footer_inc.php') ?>
</div>


