<!DOCTYPE html>
<html>
<?php include('header_inc.php'); ?>
<?php include('./../header_inc.php'); ?>
<body>
<div class="login_text">
    <h2><?php h($message); ?></h2>
</div>

<div class="login_container">
    <form action="login_check.php" method="post">
        <div class="form_group">
            <label>ID(メールアドレス)</label>
            <input type="text" name="email" class="form-control"　
            value="<?php if(isset($user['email'])){h($user['email']);}?>">
            <?php if(isset($error['login']) && $error['login'] == 'failed'): ?>
            <p>＊ID(メールアドレス)・パスワードいずれかの認証に失敗しました＊</p>
            <?php endif; ?>
            <?php if(isset($error['email']) && $error['email'] == 'blank'): ?>
            <p>＊ID(メールアドレス)が入力されていません＊</p>
            <?php endif; ?>
            <?php if(isset($error['login']) && $error['login'] == 'failed'): ?>
            <p>＊正しいID(メールアドレス)を入力してください＊</p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="password" class="form-control" 
            value="<?php if(isset($user['password'])){h($user['password']);}?>">
            <?php if(isset($error['password']) && $error['password'] == 'blank'): ?>
            <p>＊パスワードが入力されていません*</p>
            <?php endif; ?>
            <?php if(isset($error['login']) && $error['login'] == 'failed'): ?>
            <p>＊正しいパスワードを入力してください＊</p>
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
</div>


<?php include('../footer_inc.php'); ?>
</body>
</html>