<?php
session_start();
if (isset($_SESSION['admin'])) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <link rel="icon" href="../images/logo.png" sizes="16x16 32x32" type="image/png">
    <?php include("includes/css.php"); ?> <!-- head tag -->
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
                    <div class="card p-4">
                        <div class="d-flex justify-content-between my-3">
                            <h3>Doctors</h3>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add doctor</button>
                        </div>
                        <div class="table-responsive" id="data-table">
                            
                        </div>
                    </div>
                </div>
                <!-- page content -->
            </div>
            <!-- Content Wrapper END -->
        </div>
        <!-- Page Container END -->
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="form-row my-2">
            <div class="col form-group">
                <input id="name" type="text" class="form-control" placeholder="Doctor's Name">
            </div>
            <div class="col form-group">
                <input id="email" type="email" class="form-control" placeholder="Doctor's Email">
            </div>
        </div>
        <div class="form-row my-2">
            <div class="col form-group">
                <input id="msisdn" type="text" class="form-control" placeholder="Doctor's Phone">
            </div>
            <div class="col form-group">
                <select id="specialty" class="form-control">

                </select>
            </div>
        </div>
        <div class="form-row my-2">
            <div class="col form-group">
                <textarea id="detail" class="form-control" placeholder="Details"></textarea>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="add">Save</button>
      </div>
    </div>
  </div>
</div>

</body>
<script>
    $(function() {
        $("#add").on('click',function() {
            if ($("#name").val().length != 0 && $("#email").val().length != 0 && $("#msisdn").val().length != 0 && $("#specialty").val().length != 0) {
                var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
                if(!pattern.test($("#email").val()))
                {
                    alert("Invalid email");
                }else{
                    var pattern2 = new RegExp(/^(?:\+88|01)?(?:\d{11}|\d{13})$/);
                    if(!pattern2.test($("#msisdn").val())){
                        alert("Invalid phone number");
                    }else{
                        var formData= new FormData();
                        formData.append('name',$("#name").val());
                        formData.append('email',$("#email").val());
                        formData.append('msisdn',$("#msisdn").val());
                        formData.append('specialty',$("#specialty").val());
                        formData.append('detail',$("#detail").val());
                        formData.append('AddingDoctor',"AddingDoctor");
                        $.ajax({
                            processData: false,
                            contentType: false,
                            url:"queries/doctor-query.php",
                            type:'POST',
                            data: formData,
                            success:function(data,status){
                                if (data.length != 0) {
                                    alert(data);
                                }else{
                                    showing();
                                    $("#addModal").modal('hide');
                                    $("#name").val("");
                                    $("#email").val("");
                                    $("#msisdn").val("");
                                    $("#specialty").val("");
                                    $("#detail").val("");
                                }
                            },
                        });
                    }
                }
            }
        });

        showing();
        showingspecialty();
    })

    function showingspecialty() {
        var formData= new FormData();
        formData.append('ShowSpecialty',"ShowSpecialty");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/doctor-query.php",
            type:'POST',
            data:formData,
            success:function(data,status){
                $("#edit-specialty").html(data);
                $("#specialty").html(data);
            },
        });
    }
    function showing() {
        var formData= new FormData();
        formData.append('Show',"Show");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/doctor-query.php",
            type:'POST',
            data:formData,
            success:function(data,status){
                $("#data-table").html(data);
            },
        });
    }

    function activity(id) {
        var formData = new FormData();
        formData.append('id',id);
        formData.append('ChangeActivity',"ChangeActivity");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/doctor-query.php",
            type:'POST',
            data:formData,
            success:function(data,status){
                console.log(data);
                // a = JSON.parse(data);
                // $("#edit-specialty-id").val(a.id);
                // $("#edit-specialty").val(a.name);
                // $("#specialty-modal").modal('show');
            },
        });
    }

    function del(id) {
        var formData= new FormData();
        formData.append('id',id);
        formData.append('DeleteDoctor',"DeleteDoctor");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/doctor-query.php",
            type:'POST',
            data:formData,
            success:function(data,status){
                showing();
            },
        });
    }

    $("a[href='index.php']").parent("li").addClass("active");
</script>
</html>
    <?php
}else{
    header('location:login.php');
}











 ?>