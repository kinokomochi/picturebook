<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>
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
<div class="pw_edit_container">
    <div class="pw_edit_title">
        <?php if(isset($message)): ?>
            <h2><?php h($message); ?></h2>
        <?php endif; ?>
    </div>
    <form action="myPassword_check.php" method="post">
        <div class="form-group">
            <label>現在のパスワード</label>
            <input type="password" name="currentPass" class="form-control">
            <?php if(isset($cerror['currentPass']) && $cerror['currentPass'] == 'blank'): ?>
                <p class="error">＊パスワードを入力して下さい＊</p>
            <?php endif; ?>
            <?php if(isset($cerror['currentPass']) && $cerror['currentPass'] == 'notpass'): ?>
                <p class="error">＊正しいパスワードを入力して下さい＊</p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>新しいパスワード</label>
            <p>（＊大文字・小文字を含む8文字以上20文字以下の英数字で入力してください＊）</p>
            <input type="password" name="newPass" class="form-control">
            <?php if(isset($error['newPass']) && $error['newPass'] == 'blank'): ?>
            <p class="error">＊パスワードを入力して下さい＊</p>
            <?php endif; ?>
            <?php if(isset($error['newPass']) && $error['newPass'] == 'illegal'): ?>
            <p class="error">＊正しい形式でパスワードを入力して下さい＊</p>
            <?php endif; ?>
            <?php if(isset($error['newPass']) && $error['newPass'] == 'failed'): ?>
            <p class="error">＊パスワードが一致しません＊</p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>パスワード(再入力）</label>
            <input type="password" name="password_re_enter" class="form-control">
            <?php if(isset($error['password_re_enter']) && $error['password_re_enter'] == 'blank'): ?>
            <p class="error">＊パスワードを再入力して下さい＊</p>
            <?php endif; ?>
        </div>
        <input type="submit" name="submit" value="登録確認画面へ">
    </form>
</div>
<idv class="footer">
    <hr>
    <p><a href="../room.php">班一覧に戻る</a></p>
    <?php include('../footer_inc.php') ?>
</div>
