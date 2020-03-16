<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>
<body>

<h2><?php h($message) ; ?></h2>
    <p></p>
 <!-- create.phpにpostメソッドで値を渡すフォーム   -->
<form action="create.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?=$member['id']; ?>">
    <label>種名</label>
    <!-- name属性は$_POSTのキーとなる。$_POST['sp_name'] -->
    <input type="text" name="sp_name" value="<?php if(isset($pbook['sp_name'])){ echo $pbook['sp_name'];}?>">
    <!-- もしcreate.phpで作った$error配列に値が入っていたらメッセージを出す -->
    <!-- エラーがあれば配列に値が入って$errorが定義された状態になるが、
    $error配列が空の時、未定義の状態になりNoticeエラーが発生する。 -->
    <?php if(isset($error['sp_name']) && $error['sp_name'] == 'blank'): ?>
    <p>*種名を登録してください*</p>
    <?php endif; ?>
    <?php if(isset($error['sp_name']) && $error['sp_name'] == 'length'): ?>
    <p>*種名は５０文字以内で登録してください*</p>
    <?php endif; ?>
    <label>班</label>
    <!-- name属性は$_POSTのキーとなる。$_POST['team'] -->
    <select name="team">
    <option value="">選んでね</option>
    <!-- value属性の値はname属性をキーとしてその値となってセットで$_POSTに渡される。 -->
    <!-- create.phpで定義した$teamにすでに値が入っていれば、その値を表示する。 -->
    <option value="sea"<?php if(isset($pbook['team']) && $pbook['team'] == 'sea'){echo 'selected';} ?>>海</option>
    <option value="kinoko"<?php if(isset($pbook['team']) && $pbook['team'] == 'kinoko'){echo 'selected';} ?>>きのこ</option>
    <option value="plant"<?php if(isset($pbook['team']) && $pbook['team'] == 'plant'){echo 'selected';} ?>>植物</option>
    </select>
    
    <?php if(isset($error['team']) && $error['team'] == 'blank'): ?>
    <p>*班を選んでください*</p>
    <?php endif; ?>
    <p></p>
    <label>写真</label>
    <input type="file" name="picture" />
    <p></p>
    <?php if(isset($error['picture']) && $error['picture'] == 'blank'): ?>
    <p>*写真を登録してください*</p>
    <?php endif; ?>
    <?php if(isset($error['picture']) && $error['picture'] == 'type'): ?>
    <p>*写真は「.gif」もしくは「.png」の形式で登録してください*</p>
    <?php endif; ?>
    <?php if(!isset($error['picture']) && !empty($error)): ?>
    <p>*もう一度写真を登録してください*</p>
    <?php endif; ?>
    <label>説明</label>
    <!-- name属性は$_POSTのキーとなる。$_POST['description'] -->
    <textarea name="description" cols="40" row="80"><?php if(isset($pbook['description'])){ echo $pbook['description'];}?></textarea>
    <p></p>
    <!-- もしcreate.phpで作った$error配列に値が入っていたらメッセージを出す -->
    <!-- エラーがあれば配列に値が入って$errorが定義された状態になるが、
    $error配列が空の時、未定義の状態になりNoticeエラーが発生する。
    その問題はissetで$errorの中身の有無をみてやると解消された -->

    <?php if(isset($error['description']) && $error['description'] == 'blank'): ?>
    <p>*説明を登録してください*</p>
    <?php endif; ?>
    <!-- 「登録する」ボタンが押されると、submitがキー、登録するが値として$_POSTに渡される。 -->
    <input type="submit" name="submit" value="登録する">
</form>
    <p><a href="room.php">班一覧に戻る</a></p>
    <?php if(isset($_SESSION)): ?>
    <p><a href="login/logout.php">ログアウトする</a></p>
    <?php endif; ?>

<?php include('footer_inc.php') ?>
</body>
</html>