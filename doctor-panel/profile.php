<?php 
session_start();
if (isset($_SESSION['doctor'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile</title>
    <link rel="icon" href="images/logo.png" sizes="16x16 32x32" type="image/png">
    <link href="assets/vendors/dropify/css/dropify.min.css" rel="stylesheet">
    <?php include("includes/css.php"); ?> <!-- css -->
    <!-- page css -->
    <?php include("includes/javascripts.php"); ?>
</head>
<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <?php include("includes/header.php"); ?>
            <!-- Header END -->

            <!-- Side Nav START -->
            <?php include("includes/sideNav.php"); ?>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                <!-- Content Wrapper START -->
                <div class="main-content">
                    <!-- page content -->
                        <div class="card">
                            <div class="card-body">
                                <div class="form-row my-2">
                                    <div class="col-6 form-group my-2">
                                        <input id="name" type="text" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="col-6 form-group my-2">
                                        <input id="phone" type="text" class="form-control" placeholder="Phone">
                                    </div>
                                    <div class="col-6 form-group my-2">
                                        <input id="email" type="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="col-6 form-group my-2">
                                        <input id="detail" type="text" class="form-control" placeholder="Detail">
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary btn-sm" id="save-info">Save</button>
                                </div>
                            </div>
                        </div>
                        <div class="card p-4">
                            <div class="card-header"><h3 class="py-4">Upload image</h3></div>
                            <div class="card-body">
                                <input type="file" class="dropify" id="img">
                                <button class="btn btn-sm btn-primary my-3" id="upload-img">Upload</button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header py-3">
                                <h3 class="">Change Password</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert" id="pass-alert"></div>
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="old-password">Password :</label>
                                        <input type="password" class="form-control" id="old-password" placeholder="Password">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="new-password">New Password :</label>
                                        <input type="password" class="form-control" id="new-password" placeholder="New Password">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="confirm-password">Confirm New Password :</label>
                                        <input type="password" class="form-control" id="confirm-password" placeholder="Cpnfirm Password">
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-sm" id="save-password">Save</button>
                            </div>
                        </div>
                    <!-- page content -->
                </div>
                <!-- Content Wrapper END -->
            </div>
            <!-- Page Container END -->
        </div>
    </div>
</body>

<script src="assets/vendors/dropify/js/dropify.min.js"></script>
<script>
$(function() {
    $('.select2').select2();
    $("a[href='profile.php']").parent("li").addClass("active");
    $('.dropify').dropify();

    $("#upload-img").click(function() {
        if ($("#img").val().length != 0) {
            data = new FormData();
            data.append('img',$("#img")[0].files[0]);
            data.append('UploadImage',"UploadImage");
            $.ajax({
                processData: false,
                contentType: false,
                url:"queries/profile-query.php",
                type:'POST',
                data: data,
                success:function(data,status){
                    location.reload();
                },
            });
        }
    });

    $("#save-info").click(function() {
        data = new FormData();
        data.append('name',$("#name").val());
        data.append('phone',$("#phone").val());
        data.append('email',$("#email").val());
        data.append('detail',$("#detail").val());
        data.append('Adding',"Adding");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/profile-query.php",
            type:'POST',
            data: data,
            success:function(data,status){
                showing();
                alert(data);
            },
        });
    });

    $("#save-password").click(function() {
        data = new FormData();
        data.append('old',$("#old-password").val());
        data.append('new',$("#new-password").val());
        data.append('confirm',$("#confirm-password").val());
        data.append('ChangingPassword',"ChangingPassword");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/profile-query.php",
            type:'POST',
            data: data,
            success:function(data,status){
                if (data == "notmatched") {
                    $("#pass-alert").addClass('alert-danger').text("Password not matched");
                    setTimeout(function() { 
                        $("#pass-alert").removeClass('alert-danger').removeClass('alert-success').text("");
                    }, 5000);
                }else{
                    $("#pass-alert").removeClass('alert-danger').text("");
                    $("#pass-alert").addClass('alert-success').text("Succesfully updated");
                    setTimeout(function() { 
                        $("#pass-alert").removeClass('alert-danger').removeClass('alert-success').text("");
                    }, 5000);

                    $("#old-password").val("")
                    $("#new-password").val("")
                    $("#confirm-password").val("")
                }
            },
        });
        // alert($("#old-password").val()+" "+$("#new-password").val()+" "+$("#confirm-password").val());
    });

    showing();
});

function showing() {
    data = new FormData();
    data.append('Showing',"Showing");
    $.ajax({
        processData: false,
        contentType: false,
        url:"queries/profile-query.php",
        type:'POST',
        data: data,
        success:function(data,status){
            a = JSON.parse(data);
            $("#name").val(a.name);
            $("#detail").val(a.details);
            $("#phone").val(a.msisdn);
            $("#email").val(a.email);
        },
    });
}
</script>
</html>
<?php
}
else{
    header('location:login.php');
}