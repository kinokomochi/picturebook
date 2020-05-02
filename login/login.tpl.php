<!DOCTYPE html>
<html>
<?php include('header_inc.php'); ?>
<body class="pbook">
<div class="login_title">
    <h2><?php h($message); ?></h2>
</div>

<div class="login_container">
    <form action="login_check.php" method="post">
        <input type="hidden" name="token" value="<?=CsrfValidator::generate() ?>">
        <div class="form-group">
            <label>ID(メールアドレス)</label>
            <input type="text" name="email" class="form-control"　
            value="<?php if(isset($user['email'])){echo $user['email'];}?>">
            <?php if(isset($error['login']) && $error['login'] == 'failed'): ?>
            <p class="error">＊ID(メールアドレス)・パスワードいずれかの認証に失敗しました＊</p>
            <?php endif; ?>
            <?php if(isset($error['email']) && $error['email'] == 'blank'): ?>
            <p class="error">＊ID(メールアドレス)が入力されていません＊</p>
            <?php endif; ?>
            <?php if(isset($error['login']) && $error['login'] == 'failed'): ?>
            <p class="error">＊正しいID(メールアドレス)を入力してください＊</p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="password" class="form-control" 
            value="<?php if(isset($user['password'])){echo $user['password'];}?>">
            <?php if(isset($error['password']) && $error['password'] == 'blank'): ?>
            <p class="error">＊パスワードが入力されていません＊</p>
            <?php endif; ?>
            <?php if(isset($error['login']) && $error['login'] == 'failed'): ?>
            <p class="error">＊正しいパスワードを入力してください＊</p>
            <?php endif; ?>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="save" value="on">ログイン情報を保持する
            </label>
        </div>
        <button type="submit" name="submit">ログイン</button>
    </form>
</div>

<div class="footer">
    <h6>メンバー登録がまだの方はこちら</h6>
    <p><a href="signup.php">メンバー登録</a></p>
    <hr>
    <p><a href="../room.php">班一覧に戻る</a></p>
    <?php include('../footer_inc.php'); ?>
</div>


</body>
</html>