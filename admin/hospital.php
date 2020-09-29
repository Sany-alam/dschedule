<?php
session_start();
if (isset($_SESSION['admin'])) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/logo.png" sizes="16x16 32x32" type="image/png">
    <title>Hospital</title>
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
                            <h3>Hospitals</h3>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add hospital</button>
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
    <div class="modal-header">
        <h2>Hospital</h2>
    </div>
      <div class="modal-body">
      <div class="form-group">
        <label for="name">names</label>
        <input type="text" id="name" class="form-control">
      </div>
      <div class="form-group">
        <label for="detail">Details</label>
        <textarea id="detail" class="form-control"></textarea>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="add">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="hospital-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h2>Hospital</h2>
    </div>
      <div class="modal-body">
          <input id="edit-hospital-id" type="hidden"/>
      <div class="form-group">
        <label for="edit-hospital">names</label>
        <input type="text" id="edit-hospital" class="form-control">
      </div>
      <div class="form-group">
        <label for="edit-hospital-detail">Details</label>
        <textarea id="edit-hospital-detail" class="form-control"></textarea>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update">Save</button>
      </div>
    </div>
  </div>
</div>

</body>
<script>
    $(function() {
        $("#add").on('click',function() {
            if ($("#name").val().length != 0 && $("#detail").val().length != 0) {
                var formData= new FormData();
                formData.append('name',$("#name").val());
                formData.append('detail',$("#detail").val());
                formData.append('AddingHospital',"AddingHospital");
                $.ajax({
                    processData: false,
                    contentType: false,
                    url:"queries/hospital.php",
                    type:'POST',
                    data: formData,
                    success:function(data,status){
                        if (data.length != 0) {
                            alert(data);
                        }else{
                            showing();
                            $("#addModal").modal('hide');
                            $("#name").val("");
                            $("#detail").val("");
                        }
                    },
                });
            }
        });
        
        $("#update").click(function() {
            var formData= new FormData();
            formData.append('detail',$("#edit-hospital-detail").val());
            formData.append('hospital',$("#edit-hospital").val());
            formData.append('id',$("#edit-hospital-id").val());
            formData.append('UpdateHospital',"UpdateHospital");
            $.ajax({
                processData: false,
                contentType: false,
                url:"queries/hospital.php",
                type:'POST',
                data: formData,
                success:function(data,status){
                    showing();
                    $("#hospital-modal").modal('hide');
                },
            });
        });

        showing();
    })
    
    function edit(id) {
        var formData= new FormData();
        formData.append('id',id);
        formData.append('EditHospital',"EditHospital");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/hospital.php",
            type:'POST',
            data:formData,
            success:function(data,status){
                a = JSON.parse(data);
                $("#edit-hospital-id").val(a.id);
                $("#edit-hospital").val(a.name);
                $("#edit-hospital-detail").val(a.details);
                $("#hospital-modal").modal('show');
            },
        });
    }
    
    function showing() {
        var formData= new FormData();
        formData.append('Show',"Show");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/hospital.php",
            type:'POST',
            data:formData,
            success:function(data,status){
                $("#data-table").html(data);
            },
        });
    }

    function del(id) {
        var formData= new FormData();
        formData.append('id',id);
        formData.append('DeleteHospital',"DeleteHospital");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/hospital.php",
            type:'POST',
            data:formData,
            success:function(data,status){
                showing();
            },
        });
    }

    $("a[href='hospital.php']").parent("li").addClass("active");
</script>
</html>
    <?php
}else{
    header('location:login.php');
}











 ?>