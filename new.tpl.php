<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>
<body>
<h2><?=$message ; ?></h2>
    <p></p>
 <!-- create.phpにpostメソッドで値を渡すフォーム   -->
<form action="create.php" method="post" enctype="multipart/form-data">

    <label>種名</label>
    <!-- name属性は$_POSTのキーとなる。$_POST['sp_name'] -->
    <input type="text" name="sp_name" value="<?php if(isset($sp_name)){ echo $sp_name;}?>">
    <!-- もしcreate.phpで作った$error配列に値が入っていたらメッセージを出す -->
    <!-- エラーがあれば配列に値が入って$errorが定義された状態になるが、
    $error配列が空の時、未定義の状態になりNoticeエラーが発生する。 -->
    <?php if(isset($error) && $error['sp_name'] == 'blank'): ?>
    <p>*種名を登録してください*</p>
    <?php endif; ?>
    <label>班</label>
    <!-- name属性は$_POSTのキーとなる。$_POST['team'] -->
    <select name="team">
    <option disabled="disabled" selected value="0">選んでね</option>
    <!-- value属性の値はname属性をキーとしてその値となってセットで$_POSTに渡される。 -->
    <!-- create.phpで定義した$teamにすでに値が入っていれば、その値を表示する。 -->
    <option value="sea"<?php if(isset($team) && $team == 'sea'){echo 'selected';} ?>>海</option>
    <option value="kinoko"<?php if(isset($team) && $team == 'kinoko'){echo 'selected';} ?>>きのこ</option>
    <option value="plant"<?php if(isset($team) && $team == 'plant'){echo 'selected';} ?>>植物</option>
    </select>
    
    <?php if(isset($error) && $error['team'] == 'blank'): ?>
    <p>*班を選んでください*</p>
    <?php endif; ?>
    <p></p>
    <label>写真</label>
    <input type="file" name="picture" />
    <p></p>
    <?php if(isset($error) && $error['picture'] == 'type'): ?>
    <p>*写真は「.gif」もしくは「.png」の形式で登録してください*</p>
    <?php endif; ?>
    <?php if(isset($error) && !empty($error)): ?>
    <p>*もう一度写真を登録してください*</p>
    <?php endif; ?>
    <label>説明</label>
    <!-- name属性は$_POSTのキーとなる。$_POST['description'] -->
    <textarea name="description" cols="40" row="80"><?php if(isset($description)){ echo $description;}?></textarea>
    <p></p>
    <!-- もしcreate.phpで作った$error配列に値が入っていたらメッセージを出す -->
    <!-- エラーがあれば配列に値が入って$errorが定義された状態になるが、
    $error配列が空の時、未定義の状態になりNoticeエラーが発生する。
    その問題はissetで$errorの中身の有無をみてやると解消された -->

    <?php if(isset($error) && $error['description'] == 'blank'): ?>
    <p>*説明を登録してください*</p>
    <?php endif; ?>
    <!-- 「登録する」ボタンが押されると、submitがキー、登録するが値として$_POSTに渡される。 -->
    <input type="submit" name="submit" value="登録する">
</form>
    <p><a href="room.php">班一覧に戻る</a></p>


 





<?php include('footer_inc.php') ?>
</body>
</html>