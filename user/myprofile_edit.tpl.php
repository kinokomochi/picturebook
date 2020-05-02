<!DOCTYPE html>
<html>
<?php include('header_inc.php'); ?>
<body class="pbook">
<div class="fixed-top">
    <div class="header navbar navbar-dark bg-dark shadow-sm">    
        <div class="header_logo">PictureBook</div>
        <div class="header_list">
            <?php if($login): ?>
                <ul>
                    <li>ようこそ！<a href="<?php URL_ROOT ?>mypage.php?page=0&user_id=<?=$_SESSION['id']?>"><?=$_SESSION['nickname']?>さん</a>!</li>
                    <li><a href="<?php URL_ROOT ?>./../new.php"> 写真投稿 </li>
                    <li><a href="<?php URL_ROOT ?>./../login/logout.php">ログアウト </a></li>
                <ul>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="prof_edit_container">
    <div class="myimg_image">
        <label>プロフィール画像</label><br>
        <a href="myimg_edit.php"><img class="img" src="../files/<?php h($_SESSION['image']); ?>" 
        width="300" height="300" alt="" /></a>
        <p></p>
    </div>
    <div class="prof_edit_title">
        <h3><?php h($message) ;?></h3>
    </div>
    <div class="prof_edit_container">
        <form action="myprofile_check.php" method="post">
        <input type="hidden" name="token" value="<?=CsrfValidator::generate() ?>">
        <input type="hidden" name="image" value="<?php h($user['image']); ?>">
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
            <input type="submit" name="submit" value="登録確認画面へ">
        </form>
        <hr>
    </div>
</div>
<p><a href="../room.php">班一覧に戻る</a></p>


<?php include('../footer_inc.php'); ?>
</body>
</html>