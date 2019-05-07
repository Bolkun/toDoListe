<?php
$user->loadMenu();
$jsonUser = $user->jsonEncodeUser();
?>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/pop_monster_atacks.css">
    <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="js/cmo.js"></script>
</head>
<body bgcolor="orange" style="text-align: center;">
    <a class="tooltips">
        <img src='img/menu/profile.png' onclick="profile()" style="height: 80px; width: 80px; cursor: pointer;">
        <span>Profile</span>
    </a>
    <div id='pop_profile'>
        <button class="close" aria-label="Close" id='close_pop_profile' onclick="document.getElementById('pop_profile').style.display='none'">
            <span aria-hidden="true">&times;</span>
        </button><br>
        <?php require 'profile.php'; ?>
    </div>
    <a class="tooltips">
        <img src='img/menu/monsters.png' onclick="monsters()" style="height: 80px; width: 80px; cursor: pointer;">
        <span>Monsters</span>
    </a>
    <div id='pop_monsters'>
        <button class="close" aria-label="Close" id='close_pop_monsters' onclick="document.getElementById('pop_monsters').style.display='none'">
            <span aria-hidden="true">&times;</span>
        </button><br>
        <?php require 'monsters.php'; ?>
    </div>
    <a class="tooltips">
        <img src='img/menu/backpack.png' onclick="backpack()" style="height: 80px; width: 80px; cursor: pointer;">
        <span>Backpack</span>
    </a>
    <div id='pop_backpack'>
        <button class="close" aria-label="Close" id='close_pop_backpack' onclick="document.getElementById('pop_backpack').style.display='none'">
            <span aria-hidden="true">&times;</span>
        </button><br>
        <?php // require 'backpack.php'; ?>
    </div>
    <a class="tooltips">
        <img src='img/menu/post.png' onclick="post()" style="height: 80px; width: 80px; cursor: pointer;">
        <span>Post</span>
    </a>
    <div id='pop_post'>
        <button class="close" aria-label="Close" id='close_pop_post' onclick="document.getElementById('pop_post').style.display='none'">
            <span aria-hidden="true">&times;</span>
        </button><br>
        <?php // require 'post.php'; ?>
    </div>
    <a class="tooltips">
        <img src='img/menu/masters.png' onclick="masters()" style="height: 80px; width: 80px; cursor: pointer;">
        <span>Ranking</span>
    </a>
    <div id='pop_masters'>
        <button class="close" aria-label="Close" id='close_pop_masters' onclick="document.getElementById('pop_masters').style.display='none'">
            <span aria-hidden="true">&times;</span>
        </button><br>
        <?php // require 'masters.php'; ?>
    </div>
    <a class="tooltips">
        <img src='img/menu/clans.png' onclick="clans()" style="height: 80px; width: 80px; cursor: pointer;">
        <span>Clans</span>
    </a>
    <div id='pop_clans'>
        <button class="close" aria-label="Close" id='close_pop_clans' onclick="document.getElementById('pop_clans').style.display='none'">
            <span aria-hidden="true">&times;</span>
        </button><br>
        <?php // require 'clans.php'; ?>
        </div>
        <a class="tooltips">
        <img src='img/menu/cardInfo.png' onclick='cardInfo()' style="height: 80px; width: 80px; cursor: pointer;">
        <span>Monster Info</span>
    </a>
    <div id='pop_cardInfo'>
        <button class="close" aria-label="Close" id='close_pop_cardInfo' onclick="document.getElementById('pop_cardInfo').style.display='none'">
            <span aria-hidden="true">&times;</span>
        </button><br>
        <?php // require 'cardInfo.php'; ?>
    </div>
    <a class="tooltips">
        <img src='img/menu/exit.png' onclick='exit(<?php echo "$jsonUser"; ?>)' style="height: 80px; width: 80px; cursor: pointer;">
        <span>Exit</span>
    </a>
</body>
</html>