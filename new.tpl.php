<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>
<body class="pbook">
<div class="fixed-top">
    <div class="header navbar navbar-dark bg-dark shadow-sm">    
        <div class="header_logo">PictureBook</div>
        <div class="header_list">
            <?php if($login): ?>
                <ul>
                    <li>ようこそ！<a href="<?php URL_ROOT ?>user/mypage.php?page=0&user_id=<?=$_SESSION['id']?>"><?=$_SESSION['nickname']?>さん</a>!</li>
                    <li><a href="<?php URL_ROOT ?>new.php"> 写真投稿 </li>
                    <li><a href="<?php URL_ROOT ?>login/logout.php">ログアウト </a></li>
                <ul>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="new_title">
    <h2><?php h($message) ; ?></h2>
    <p></p>
</div>
<div class="new_container">
    <form action="create.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="token" value="<?=CsrfValidator::generate() ?>">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
        <div class="form-group">
            <label>種名</label>
            <input type="text" name="sp_name" class="form-control" 
            value="<?php if(isset($pbook['sp_name'])){ echo $pbook['sp_name'];}?>">
            <?php if(isset($error['sp_name']) && $error['sp_name'] == 'blank'): ?>
            <p class="error">*種名を登録してください*</p>
            <?php endif; ?>
            <?php if(isset($error['sp_name']) && $error['sp_name'] == 'length'): ?>
            <p class="error">*種名は５０文字以内で登録してください*</p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>班</label>
            <select name="team">
            <option value="">選んでね</option>
            <option value="sea"<?php if(isset($pbook['team']) && $pbook['team'] == 'sea'){echo 'selected';} ?>>海</option>
            <option value="kinoko"<?php if(isset($pbook['team']) && $pbook['team'] == 'kinoko'){echo 'selected';} ?>>きのこ</option>
            <option value="plant"<?php if(isset($pbook['team']) && $pbook['team'] == 'plant'){echo 'selected';} ?>>植物</option>
            </select>
            <?php if(isset($error['team']) && $error['team'] == 'blank'): ?>
            <p class="error">*班を選んでください*</p>
            <?php endif; ?>
            <p></p>
        </div>
        <div class="form-group">
            <label>写真</label>
            <input type="file" name="picture" />
            <p></p>
            <?php if(isset($error['picture']) && $error['picture'] == 'blank'): ?>
            <p class="error">*写真を登録してください*</p>
            <?php endif; ?>
            <?php if(isset($error['picture']) && $error['picture'] == 'type'): ?>
            <p class="error">*写真は「.gif」もしくは「.png」の形式で登録してください*</p>
            <?php endif; ?>
            <?php if(!isset($error['picture']) && !empty($error)): ?>
            <p class="error">*もう一度写真を登録してください*</p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>説明</label>
            <textarea name="description" cols="40" row="80" class="form-control"><?php if(isset($pbook['description'])){ echo $pbook['description'];}?></textarea>
            <p></p>
            <?php if(isset($error['description']) && $error['description'] == 'blank'): ?>
            <p class="error">*説明を登録してください*</p>
            <?php endif; ?>
        </div>
        <input type="submit" name="submit" value="登録する">
    </form>
</div>
<div class="footer">
    <p><a href="room.php">班一覧に戻る</a></p>
    <?php include('footer_inc.php') ?>
</div>
</body>
</html>