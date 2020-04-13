<!DOCTYPE html>
<html>
<?php include('../header_inc.php'); ?>
<body>
<p>現在のプロフィール画像</p>
<p>[写真]:<img src="../files/<?php h($user['image']); ?>" 
        width="300" height="300" alt="" />
<br></p>
<form action="myimg_check.php" method="post" enctype="multipart/form-data">
<label>新しいプロフィール画像</label>
<p></p>
<input type="file" name="image">
<?php if(isset($error['image']) && $error['image'] == 'type'): ?>
<p>＊画像は「jpg」または「png」形式で登録して下さい＊</p>
<?php endif; ?>
<?php if(isset($error['image']) && $error['image'] == 'blank'): ?>
<p>＊画像を登録して下さい＊</p>
<?php endif; ?>
<?php if(!isset($error['image']) && (!empty($error)) || !empty($emailError) || !empty($passwordError)): ?>
<p>＊もう一度画像を登録してください＊</p>
<?php endif; ?>
<p></p>
<input type="submit" name="submit" value="登録確認画面へ">
</form>

<hr>
<p><a href="../room.php">班一覧に戻る</a></p>


<?php include('../footer_inc.php'); ?>
</body>
</html>