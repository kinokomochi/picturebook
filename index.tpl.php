<!DOCTYPE html>
<html>
<?php include('header_inc.php') ?>
<body>
<div class="fixed-top">
    <div class="header navbar navbar-dark bg-dark shadow-sm">    
        <div class="header_logo"><a id="header_title" href="<?php URL_ROOT ?>room.php">PictureBook</a></div>
        <div class="header_list">
            <?php if($login): ?>
                <ul>
                    <li>ようこそ！<a href="<?php URL_ROOT ?>user/mypage.php?page=0&user_id=<?=$_SESSION['id']?>"><?=$_SESSION['nickname']?>さん</a>!</li>
                    <li><a href="<?php URL_ROOT ?>new.php"> 写真投稿 </li>
                    <li><a href="<?php URL_ROOT ?>room.php"> 班一覧 </li>
                    <li><a href="<?php URL_ROOT ?>login/logout.php">ログアウト </a></li>
                <ul>
            <?php elseif(!$login): ?>
                <ul>
                    <li>ログインして図鑑を投稿してね！</li>
                    <li><a href="<?php URL_ROOT ?>login/login.php">ログイン </a></li>
                    <li><a href="<?php URL_ROOT ?>login/signup.php">メンバー登録 </a></li>
                </ul>
            <?php endif ;?>
        </div>
</div>
</div>
<br>

<div class="search_container">
    <label>種名検索</label>
    <form action="search.php?page=0">
        <input type="hidden" name="page" value="0">
        <input type="text" name="keyword">
        <input type="submit" name="submit" value="検索する">
    </form>
</div>
<br>
<div class="index_<?=$_GET['team'] ?>">
    <div class="jumbotron text-center">
        <div class="col-md-12">
            <h2><?php h($message) ; ?></h2>
        </div>
    </div>
    <div class="index_container">
        <div class="row row-height">
            <p></p>
            <?php foreach($pbooks as $pbook): ?>
            <div class="col-md-4 border-bottom">
                <?php if($login):?>
                <a href="user/mypage.php?page=0&user_id=<?=$pbook['user_id'];?>">
                <?php endif; ?>
                <p><?php h($pbook['nickname']) ;?>
                <?php if($login):?>
                </a>
                <?php endif; ?>
                さんの投稿
                <?php if($login && $_SESSION['id'] == $pbook['user_id']):?>
                <a href="edit.php?id=<?=$pbook['id']; ?>">  編集</a> /
                <a href="delete_check.php?id=<?=$pbook['id']; ?>&team=<?=$pbook['team']?>">  削除</a>
                <?php endif; ?>

                <div class="index_picture_container">
                    <div class="index_picture_<?=$_GET['team'] ?>">
                        <img class="img" src="files/<?php h($pbook['picture']); ?>" 
                        width="300" height="300" alt="" />
                    </div>
                </div>
                <br>
                <p class="sp_name"><?php h($pbook['sp_name']); ?></p>
                <p><?php hbr($pbook['description']); ?><br></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div class="pagination_container">
        <?php for($i=0; $i < $pages; $i++) : ?>
        <div class="pagination_display">
            <?php if($_GET['page'] == $i): ?>
                <?=$_GET['page']+1 .'ページ'; ?>
            <?php else: ?>
                <?php printf("<a href='?page=%d&team=%s'>%dページへ</a><br />\n", $i, $_GET['team'], $i+1); ?>
            <?php endif; ?>
        </div>
        <?php endfor; ?>
    </div>
</div>

<div class="footer">
    <hr>
    <p>
        <a href="room.php">班一覧に戻る</a>/
        <a href="new.php"> 写真登録</a>
    </p>
    <?php include('footer_inc.php') ?>
</div>
</body>
</html>