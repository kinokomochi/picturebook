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
<div class="mypage_container"> 
    <div class="profile_container">
        <div class="profile_title">
            <h2><?php h($message) ;?></h2>
        <p></p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile_image">
                    <img class="img d-block mx-auto" src="../files/<?php h($user['image']); ?>" 
                    width="300" height="300" alt="" />
                    <p></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="profile_list">
                    <label>生年月日</label>
                    <?=$user['birthday'] ; ?>
                    <p></p>
                    <label>性別</label>
                    <?php if($user['gender'] == 'male'){echo '男';}; ?>
                    <?php if($user['gender'] == 'female'){echo '女';}; ?>
                    <?php if($user['gender'] == 'unselected'){echo '未選択';}; ?>
                    <p></p>
                    <label>班</label>
                    <?php if($user['team'] == 'sea'){echo '海';} ;?>
                    <?php if($user['team'] == 'kinoko'){echo 'きのこ';} ;?>
                    <?php if($user['team'] == 'plant'){echo '植物';} ;?>
                    <p></p>
                    <?php if($_GET['user_id'] == $_SESSION['id']): ?>
                    <label>ID(メールアドレス）</label>
                    <?php h($user['email']); ?>
                    <?php endif; ?>
                    <p></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="profile_text">
                    <label>自己紹介文</label>
                    <?php  h($user['introduction']); ?>
                    <p></p>
                </div>
            </div>
        </div>
        
        <div class="profile_edit">
            <tr>
            <?php if($_GET['user_id'] == $_SESSION['id']): ?>
            <p><a href="myimg_edit.php">画像編集</a>
            <a href="myprofile_edit.php">プロフィール編集</a>
            <a href="myemail_edit.php">Email編集</a>
            <a href="myPassword_edit.php">PW編集</p></a>
            </tr>
            <hr>
            <?php endif; ?>
        </div>
    </div>
    <div class="post_container">
        <div class ="post_title">
            <h2 class="text-center"><?=$user['nickname']; ?>さんの投稿一覧</h2>
        </div>
        <div class="row row-height">
            <?php if(isset($pbooks[0]['id']) != null): ?>
            <?php foreach($pbooks as $pbook): ?>
                <div class="col-md-4 border-bottom">
                    <?php if(((isset($_SESSION['id']))&&($_SESSION['time']+3600)>time()) && $_SESSION['id'] == $pbook['user_id']):?>
                        <a href='../edit.php?id=<?=$pbook['id']; ?>'>編集</a> / 
                        <a href='../delete_check.php?id=<?=$pbook['id']; ?>&team=<?=$pbook['team']?>'>削除</a>
                    <?php endif; ?><br></p>
                    <p><img class="img" src="../files/<?php h($pbook['picture']); ?>" 
                    width="300" height="300" alt="" />
                    <br></p>
                    <p class="sp_name"><?php h($pbook['sp_name']); ?></p>
                    <p><?php hbr($pbook['description']); ?></p>
                </div>
            <?php endforeach; ?>
            <?php else:?>
                <div class="col-md-12">
                    <h4 class="text-center">まだ投稿がありません</h4>
                </div>
            <?php endif; ?>
        </div>
        <div class="pagination_container">
            <?php for($i=0; $i < $pages; $i++) : ?>
                <div class="pagination_display">
                    <?php if($_GET['page'] == $i): ?>
                        <?=$_GET['page']+1 .'ページ'; ?>
                    <?php else: ?>
                        <?php printf("<a href='?page=%d&user_id=%s'>%dページへ</a><br />\n", $i,$_GET['user_id'], $i+1); ?>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>
<p></p>
<div class="newpost_link">
    <a href="../new.php">投稿する</a>
</div>


<div class="footer">
    <hr>
    <p>
        <a href="../room.php">班一覧に戻る</a>/
        <a href="delete_user.php">退会する</a>
    </p>
    <?php include('../footer_inc.php'); ?>
</div>
</body>
</html>