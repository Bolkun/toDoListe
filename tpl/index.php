<div class="container">
    <div class="row">
        <div class="jumbotron">
            <div class='text-center'>
                <div class="vertical_middle">
                    <img class="img-responsive" src="img/logo/logo_full.png">
                    <div style="text-align: left;">
                        <form action="class/user.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="text-danger" for="index_user">Name:</label>
                                <input type="text" class="form-control" id="index_user" name="nickname">
                            </div>
                            <div class="form-group">
                                <label class="text-danger" for="index_password">Password:</label>
                                <input type="password" class="form-control" id="index_password" name="pass">
                            </div>
                            <br>
                            <div class='text-center'>
                                <input type="submit" class="btn btn-info" name="SubmitButton" value="Enter CMO World!">
                            </div>
                        </form>
                    </div>
                    <br><a href="reg.tpl">Registration</a>
                </div>
            </div>
        </div>
    </div>
</div>