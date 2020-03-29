<?php include('header_inc.php') ?>
<body>
<?php session_start(); ?>
<?php require_once __DIR__ . '/vendor/autoload.php'; ?>
<?php require_once 'init.php'; ?>
<?php $login = checkLoginStatus(); ?>
<?php displayLink($login); ?>
    <h1>オリジナル図鑑</h1>
<p><a href="index.php?team=kinoko">きのこの部屋</a></p>
<p><a href="index.php?team=plant">植物の部屋</a></p>
<p><a href="index.php?team=sea">海の部屋</a></p>


<?php 
   

?>
<?php include('footer_inc.php') ?>
</body>
</html>

