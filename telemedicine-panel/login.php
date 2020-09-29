<?php 
session_start();
if (!isset($_SESSION['doctor'])) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("includes/css.php"); ?> <!-- head tag -->
    <?php include("includes/javascripts.php"); ?>
    <link rel="icon" href="images/logo.png" sizes="16x16 32x32" type="image/png">
    <title>Login</title>
</head>
<body>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('assets/images/others/login-3.png')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="text-center m-b-30">
                                        <h1 class="display-5">Telemedicine Doctor's Login</h1>
                                        <div class="logo logo-dark">
                                            <img class="img-fluid w-50" src="images/logo.png"/>
                                        </div>
                                    </div>
                                    <div id="warning_login_credential" class="alert "></div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="userName">Email:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="text" class="form-control" id="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password">Password:</label>
                                            <div class="input-affix m-b-10">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" class="form-control" id="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <button type="button" class="btn btn-primary" id="signin">Sign In</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="">© 2019 ThemeNate</span>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="#">Legal</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="#">Privacy</a>
                        </li>
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
$("#warning_login_credential").hide();
    $("#password").on("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            $("#signin").click();
        }
    });
    $("#signin").click(function() {
    var formData= new FormData();
    formData.append('email',$("#email").val());
    formData.append('password',$("#password").val());
    formData.append('signin',"signin");
    $.ajax({
        processData: false,
        contentType: false,
        url:"queries/login-query.php",
        type:'POST',
        data: formData,
        success:function(data,status){
            a = $.trim(data);
            if (a === "ok") {
                location.href="index.php";
            }
            else if (a === "not ok") {
                $("#warning_login_credential").addClass("alert-danger").html("Invalid credentials").show(function() {
                    setTimeout(() => {
                        $("#warning_login_credential").removeClass("alert-danger").html("").fadeOut();
                    }, 5000);
                });
            }
            else if (a === "inactive") {
                $("#warning_login_credential").addClass("alert-danger").html("This account is deactivated").show(function() {
                    setTimeout(() => {
                        $("#warning_login_credential").removeClass("alert-danger").html("").fadeOut();
                    }, 5000);
                });
            }
        },
    });
});
</script>
</html>
    <?php
}
else{
    header('location:index.php');
}