<?php include('header_inc.php') ?>
<body>
<?php session_start(); ?>
<?php if(isset($_SESSION['id']) && $_SESSION['time']+3600 > time()):?>
        <p><a href="login/logout.php">ログアウト</a></p>
    <?php else: ?>
    <p><a href="login/login.php">ログイン</a></p> 
    <p><a href="login/signup.php">メンバー登録</a></p> 
    <?php endif; ?>



    <h1>オリジナル図鑑</h1>
<p><a href="kinoko/index.php">きのこの部屋</a></p>
<p><a href="plant/index.php">植物の部屋</a></p>
<p><a href="sea/index.php">海の部屋</a></p>


<?php 
   

?>
<?php include('footer_inc.php') ?>
</body>
</html>

