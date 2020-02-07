<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>
<body>
<h2><?=$message ; ?></h2>
    <p></p>

    <p>[写真]:<?=$pbook['picture']."\n<br>" ?></p>
   
<form action='update.php' method='post'　enctype='multipart/form-data'>
    <input type='hidden' name='id' value="<?=$id ?>" > 

    <label>種名</label>
    <input type='text' name='sp_name' value="<?php echo $pbook['sp_name'] ?>">
    <label>班を選んでね</label>
    <select name='team' value="<?php echo $pbook['team'] ?>">
    <option value='sea'>海</option>
    <option value='kinoko'>きのこ</option>
    <option value='plant'>植物</option>
    </select>
    <p></p>
    <label>説明</label>
    <textarea name='description' cols='40' row='80'><?php echo $pbook['description'] ?></textarea>
    <p></p>
    <input type='submit' name='submit' value='更新する'>
    </form>
    <p><a href='room.php'>班一覧に戻る</a></p>


 <?php var_dump($pbook); ?>





<?php include('footer_inc.php') ?>
</body>
</html>