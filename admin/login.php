<?php 
session_start();
if (isset($_SESSION['admin'])) {
    header('location:index.php');
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("includes/css.php"); ?> <!-- head tag -->
    <link rel="icon" href="../images/logo.png" sizes="16x16 32x32" type="image/png">
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
                                        <h1>Admin panel</h1>
                                        <div class="logo logo-dark">
                                            <img class="img-fluid w-50" src="../images/logo.png"/>
                                        </div>
                                    </div>
                                    <div style="display:none;" id="warning_login_credential" class="alert alert-danger">
                                        Credentials not matched
                                    </div>
                                    <!-- <form> -->
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="userName">Username:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="text" class="form-control" id="userName" placeholder="Username">
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
                                    <!-- </form> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("includes/javascripts.php"); ?>
<script type="text/javascript">
    $("#password").on("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            $("#signin").click();
        }
    });
    $("#signin").click(function() {
        var formData= new FormData();
        formData.append('userName',$("#userName").val());
        formData.append('password',$("#password").val());
        formData.append('signin',"signin");
            $.ajax({
                processData: false,
                contentType: false,
                url:"queries/signin.php",
                type:'POST',
                data: formData,
                success:function(data,status){
                    if (data.length != 0) {
                        alert(data);
                    }else{
                        location.href="index.php";
                    }
                },
            });
    });
</script>
</html>
<?php
    }
?>
