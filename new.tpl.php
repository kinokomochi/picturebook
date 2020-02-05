<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>
<body>
<h2><?=$message ; ?></h2>
    <p></p>
   
<form action='create.php' method='post'　enctype='multipart/form-data'>
    <input type='hidden' name='id' value="<?php echo $pbook['id'] ?>" > 

    <label>種名</label>
    <input type='text' name='sp_name'>
    <label>班を選んでね</label>
    <select name='team'>
    <option value='sea'>海</option>
    <option value='kinoko'>きのこ</option>
    <option value='plant'>植物</option>
    </select>
    <p></p>
    <label>写真</lanel>
    <input type='file' name='picture'>
    <p></p>
    <label>説明</label>
    <textarea name='description' cols='40' row='80'></textarea>
    <p></p>
    <input type='submit' name='submit' value='登録する'>
    <p><a href='room.php'>班一覧に戻る</a></p>


 





<?php include('footer_inc.php') ?>
</body>
</html>