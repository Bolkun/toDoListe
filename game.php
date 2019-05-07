<?php
require 'class/user.php';

$user = new User();
$user->loginSubmit();
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Challange Masters Online</title>
    <link rel="shortcut icon" href="img/logo/titel_icon.png" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/cmo.css">
    <script src="js/jquery-3.4.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div id='main'>
    <div id='kyotoCity'>
        <?php require 'menu.php'; ?>
        <br><br><br>
        <?php // require 'class/npc/doctorA.php'; ?>
        <?php // require 'class/npc/trainingCamp.php'; ?>
        <?php // require 'class/npc/sellerGogi.php'; ?>
    </div>
    <div id='kyotoCity_forest'>
        <?php // require 'class/npc/forest.php'; ?>
    </div>
    <div id='reinforcement_div'>
        <?php // require 'class/npc/simulation.php'; ?>
    </div>
</div>
<div id='chat'>
    <?php // require 'chat.php'; ?>
</div>
<div id='room'>
    <?php // require 'room.php'; ?>
</div>
<div id='footer'>
    <?php // require 'footer.php'; ?>
</div>
</body>
</html>