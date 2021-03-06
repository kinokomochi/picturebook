<!DOCTYPE html>
<html>
<?php include('header_inc.php'); ?>
<body class="pbook">
<div class="signup_text">
    <h2><?php h($message) ;?></h2>
</div>
<div class="signup_container">
    <div class="signup_container_main">
        <form action="signup_complete.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="token" value="<?=CsrfValidator::generate() ?>">
        <div class="form_group">
            <label>名前: </label>
            <?php if(isset($user['nickname'])){ h($user['nickname']);}; ?>
            <input type="hidden" name="nickname" class="form-control" value="<?=$user['nickname']; ?>">
            <p></p>
        </div>
        <div class="form_group">
            <label>プロフィール画像</label>
            <input type="hidden" name="image" value="<?=$user['image']; ?>">
            <p></p>
            <?php if(isset($user['image'])):?>
            <img src="../files/<?php h($user['image']); ?>" 
            width="300" height="300" alt="" />
            <?php endif; ?>
            <p></p>
        </div>
        <div class="form_group">
            <label>自己紹介文: </label>
            <input type="hidden" name="introduction" value="<?=$user['introduction']; ?>">
            <?php if(isset($user['introduction'])){ hbr($user['introduction']);}; ?>
            <p></p>
        </div>
        <div class="form_group">
            <label>生年月日: </label>
            <?php if(isset($user['year']) && isset($user['month']) && isset($user['day'])): ?>
            <?php $birthday = $user['year'] . "-" . $user['month'] . "-" . $user['day']; ?>
            <?=$birthday ; ?>
            <?php endif; ?>
            <input type="hidden" name="birthday" value="<?=$birthday; ?>">
            <p></p>
        </div>
        <div class="form_group">
            <label>性別: </label>
            <input type="hidden" name="gender" value="<?=$user['gender']; ?>">
            <?php if(isset($user['gender']) && $user['gender'] == 'male'){echo '男';}; ?>
            <?php if(isset($user['gender']) && $user['gender'] == 'female'){echo '女';}; ?>
            <?php if(isset($user['gender']) && $user['gender'] == 'unselected'){echo '未選択';}; ?>
            <p></p>
        </div>
        <div class="form_group">
            <label>班: </label>
            <input type="hidden" name="team" value="<?=$user['team']; ?>">
            <?php if(isset($user['team']) && $user['team'] == 'sea'){echo '海';} ;?>
            <?php if(isset($user['team']) && $user['team'] == 'kinoko'){echo 'きのこ';} ;?>
            <?php if(isset($user['team']) && $user['team'] == 'plant'){echo '植物';} ;?>
            <p></p>
        </div>
        <div class="form_group">
            <label>ID(メールアドレス）: </label>
            <input type="hidden" name="email" value="<?=$user['email']; ?>">
            <?php if(isset($user['email'])){ h($user['email']);}; ?>
            <p></p>
        </div>
        <div class="form_group">
            <label>パスワード: </label>
            <input type="hidden" name="password" value="<?=$user['password']; ?>">
            <?php if(isset($user['password'])){echo '********';}; ?>
            <p></p>
        </div>
        <input type="submit" name="submit" value="登録内容送信">
        </form>
        <a href="signup.php?action=rewrite"><p>編集し直す</p></a>
    </div>
</div>
<hr>
<div class="footer">
    <p><a href="../room.php">班一覧に戻る</a></p>
    <?php include('../footer_inc.php'); ?>
</div>
<p></p>

</body>