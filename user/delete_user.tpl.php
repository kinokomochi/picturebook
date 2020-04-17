<!DOCTYPE html>
<html>
<?php include('../header_inc.php') ?>
<body>
<h3><?=$user['nickname']; ?>のユーザー情報を削除しますか？</h3>
<p>※投稿したデータも全て失われますがよろしいですか？</p>
<p></p>
<a href="delete_user_complete.php"><p>削除する</p></a>
<a href="mypage.php?page=0&user_id=<?=$_SESSION['id']; ?>"><p>マイページに戻る</p></a>

<hr>
<p><a href="../room.php">班一覧に戻る</a></p>

<?php include('../footer_inc.php') ?>
