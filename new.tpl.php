<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>
<body>
<h2><?=$message ; ?></h2>
    <p></p>
   
<form action='create.php' method='post'　enctype='multipart/form-data'>

    <label>種名</label>
    <input type='text' name='sp_name'>
    <?php if($error['sp_name'] == 'blank'): ?>
    <p>*種名を登録してください*</p>
    <?php endif; ?>
    <label>班</label>
    <select name='team'>
    <option value="disabled">選んでね</option>
    <option value='sea'>海</option>
    <option value='kinoko'>きのこ</option>
    <option value='plant'>植物</option>
    </select>
    <p></p>
    <label>写真</label>
    <input type='file' name='picture' />
    <p></p>
    <?php if($error['picture'] == 'type'): ?>
    <p>*写真は「.gif」もしくは「.png」の形式で登録してください*</p>
    <?php endif; ?>
    <?php if(!empty($error)): ?>
    <p>*もう一度写真を登録してください*</p>
    <?php endif; ?>
    <label>説明</label>
    <textarea name='description' cols='40' row='80'></textarea>
    <p></p>
    <?php if($error['description'] == 'blank'): ?>
    <p>*説明を登録してください*</p>
    <?php endif; ?>
    <input type='submit' name='submit' value='登録する'>
</form>
    <p><a href='room.php'>班一覧に戻る</a></p>


 





<?php include('footer_inc.php') ?>
</body>
</html>