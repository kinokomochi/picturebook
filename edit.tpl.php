<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>
<?php require_once('function.php') ?>
<body>
<h2><?=$message ; ?></h2>
    <p></p>

    <p>[写真]:<img src="files/<?php h($pbook['picture']); ?>" 
        width="300" height="300" alt="" /> <br></p>  
<form action="update.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$id ?>" > 
    <input type="hidden" name="picture" value="files/<?php $pbook['picture'] ?>" > 

    <label>種名</label>
    <input type="text" name="sp_name" value="<?php echo $pbook['sp_name']; ?>">
    <?php if(isset($error['sp_name']) && $error['sp_name'] == 'blank'): ?>
    <p>*種名を登録してください*</p>
    <?php endif; ?>
    <?php if(isset($error['sp_name']) && $error['sp_name'] == 'length'): ?>
    <p>*種名は５０文字以内で登録してください*</p>
    <?php endif; ?>
    
    <label>班</label>
    <select name="team" value="<?php echo $pbook['team'] ?>">
    <option value="">選んでね</option>
    <option value="sea"<?php if(isset($pbook['team']) && $pbook['team'] == 'sea'){echo 'selected';} ?>>海</option>
    <option value="kinoko"<?php if(isset($pbook['team']) && $pbook['team'] == 'kinoko'){echo 'selected';} ?>>きのこ</option>
    <option value="plant"<?php if(isset($pbook['team']) && $pbook['team'] == 'plant'){echo 'selected';} ?>>植物</option>
    </select>
    <?php if(isset($error['team']) && $error['team'] == 'blank'): ?>
    <p>*班を選んでください*</p>
    <?php endif; ?>
    <p></p>
    <label>説明</label>
    <textarea name="description" cols="40" row="80"><?php echo $pbook['description']; ?></textarea>
    <?php if(isset($error['description']) && $error['description'] == 'blank'): ?>
    <p>*説明を登録してください*</p>
    <?php endif; ?>
    <p></p>
    <input type="submit" name="submit" value="更新する">
    </form>
    <p><a href="room.php">班一覧に戻る</a></p>

<?php include('footer_inc.php') ?>
</body>
</html>