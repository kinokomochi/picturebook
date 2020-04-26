<!DOCTYPE html>
<html>

<?php include('header_inc.php'); ?>
<body>
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
<div class="myimg_edit_container">
	<p class="myimg_title">現在のプロフィール画像</p>
	<div class="myimg_image">
		<p><img class="img" src="../files/<?php h($user['image']); ?>" 
		width="300" height="300" alt="" />
		<br></p>
	</div>
	<div class="image_form">
		<form action="myimg_check.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>新しいプロフィール画像</label>
				<p></p>
				<div class="img_form">
					<label for="form_button">
						<span class="bottun">画像を選択</span>
						<input id="form_button" type="file" name="newImage">
					</label>
					<?php if(isset($error['newImage']) && $error['newImage'] == 'type'): ?>
						<p class="error">＊画像は「jpg」または「png」形式で登録して下さい＊</p>
					<?php endif; ?>
					<?php if(isset($error['newImage']) && $error['newImage'] == 'blank'): ?>
						<p class="error">＊画像を登録して下さい＊</p>
					<?php endif; ?>
					<p></p>
					<input type="submit" name="submit" value="登録確認画面へ">
				</div>
				<p></p>
			</div>
		</form>
	</div>
</div>
<hr>
<div class="footer">
	<p><a href="../room.php">班一覧に戻る</a></p>
	<?php include('../footer_inc.php'); ?>
</div>
</body>
</html>