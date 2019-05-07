<?php
require 'class/user.php';
$user = new User();
$user->regSubmit();
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Challange Masters Online</title>
    <link rel="shortcut icon" href="icons/titel_icon_2.png" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/cmo.css">
    <script src="js/jquery-3.4.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <!--<div class="jumbotron">-->
            <div class='text-center'>
                <div class="vertical_middle">
                    <img class="img-responsive" src="img/logo/logo_full.png">
                    <div style="text-align: left;">
                        <form action="game.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="text-danger" for="index_user">Name:</label>
                                <input type="text" class="form-control" id="index_user" name="nickname" required>
                            </div>
                            <div class="form-group">
                                <label class="text-danger" for="index_password">Password:</label>
                                <input type="password" class="form-control" id="index_password" name="pass" required>
                            </div>
                            <br>
                            <div class='text-center'>
                                <input type="submit" class="btn btn-info" name="SubmitButton" value="Enter CMO World!">
                            </div>
                        </form>
                    </div>
                    <br><a href="reg.php">Registration</a>
                </div>
            </div>
        <!--</div>-->
    </div>
</div>
</body>
</html>