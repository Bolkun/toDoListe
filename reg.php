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
<div class="container">
    <div class="row">
        <!--<div class="jumbotron">-->
            <div class='text-center'>
                <div class="vertical_middle">
                    <img class="img-responsive" src="img/logo/logo_full.png">
                    <div style="text-align: left;">
                        <form name="regform" action="index.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="text-danger" for="reg_name">Name:</label>
                                <input name="nickname" type="text" class="form-control" id="reg_name" required>
                            </div>
                            <fieldset>
                                <legend class="text-danger">Gender:</legend>
                                <div style="margin-top: -10px;">
                                    <label class="checkbox-inline radiobox_inline">
                                        <input type="radio" name="gender" value="m" checked> Male
                                        <span class="checkmark_radio"></span>
                                    </label>
                                    <label class="checkbox-inline radiobox_inline">
                                        <input type="radio" name="gender" value="f"> Female
                                        <span class="checkmark_radio"></span>
                                    </label>
                                </div>
                            </fieldset>
                            <div class="form-group">
                                <label class="text-danger" for="reg_pass">Password:</label>
                                <input name="pass" type="password" class="form-control" id="reg_pass" required>
                            </div>
                            <div class="form-group">
                                <label class="text-danger" for="reg_pass2">Reenter Password:</label>
                                <input name="pass2" type="password" class="form-control" id="reg_pass2" required>
                            </div>
                            <div class="form-group">
                                <label class="text-danger" for="reg_birthsday">Birthsday:</label>
                                <input name="bday" type="date" class="form-control" id="reg_birthsday" required>
                            </div>
                            <div class="form-group">
                                <label class="text-danger" for="reg_email">Email:</label>
                                <input name="email" type="email" class="form-control" id="reg_email" required>
                            </div>
                            <div class="form-group">
                                <label class="checkbox-inline checkbox_inline">
                                    <input name="law" type="checkbox" class="form-control" required>
                                        I read <a style="z-index: 999;" href="law.html" target="_blank">data protection</a>
                                        and agree with its content for game CMO.
                                    <span class="checkmark_checkbox"></span>
                                </label>
                            </div>
                            <br>
                            <div class='text-center'>
                                <input type="submit" class="btn btn-info" name="reg" value="Registrate">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!--</div>-->
    </div>
</div>
</body>
</html>