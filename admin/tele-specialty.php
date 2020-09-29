<?php
session_start();
if ($_SESSION['admin']) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/logo.png" sizes="16x16 32x32" type="image/png">
    <title>Speciality</title>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <input type="text" id="specialty" class="col form-control" placeholder="Speciality" />
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" id="add">Add</button>
                                </div>
                            </div>
                            <div class="table-responsive" id="data">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper END -->
            </div>
            <!-- Page Container END -->
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="specialty-modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <input type="hidden" id="edit-specialty-id">
            <div class="row justify-content-center m-0 p-0">
                <div class="form-group col-8 m-0 p-0">
                    <input type="text" id="edit-specialty" class="form-control" placeholder="Specialty" />
                </div>
                <div class="form-group col-2 m-0 p-0">
                    <button type="button" class="btn btn-primary" id="update">Save</button>
                </div>
                <div class="form-group col-2 m-0 p-0">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>


<script>
    $(function() {
        $("a[href='tele-specialty.php']").parent("li").addClass("active");


        $("#add").on('click',function() {
            if ($("#specialty").val().length != 0) {
                var formData= new FormData();
                formData.append('specialty',$("#specialty").val());
                formData.append('AddingSpecialty',"AddingSpecialty");
                $.ajax({
                    processData: false,
                    contentType: false,
                    url:"queries/tele-specialty-query.php",
                    type:'POST',
                    data: formData,
                    success:function(data,status){
                        if (data === "Added") {
                            showing();
                        }else{
                            alert(data);
                        }
                    },
                });
            }
        });

        $("#update").click(function() {
            var formData= new FormData();
            formData.append('specialty',$("#edit-specialty").val());
            formData.append('id',$("#edit-specialty-id").val());
            formData.append('UpdateSpecialty',"UpdateSpecialty");
            $.ajax({
                processData: false,
                contentType: false,
                url:"queries/tele-specialty-query.php",
                type:'POST',
                data: formData,
                success:function(data,status){
                    showing();
                    $("#specialty-modal").modal('hide');
                },
            });
        });

        showing();
    })

    function showing() {
        var formData= new FormData();
        formData.append('ShowSpecialty',"ShowSpecialty");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/tele-specialty-query.php",
            type:'POST',
            data:formData,
            success:function(data,status){
                $("#data").html(data);
            },
        });
    }

    function edit(id) {
        var formData= new FormData();
        formData.append('id',id);
        formData.append('EditSpecialty',"EditSpecialty");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/tele-specialty-query.php",
            type:'POST',
            data:formData,
            success:function(data,status){
                a = JSON.parse(data);
                $("#edit-specialty-id").val(a.id);
                $("#edit-specialty").val(a.name);
                $("#specialty-modal").modal('show');
            },
        });
    }

    function del(id) {
        var formData= new FormData();
        formData.append('id',id);
        formData.append('DeleteSpecialty',"DeleteSpecialty");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/tele-specialty-query.php",
            type:'POST',
            data:formData,
            success:function(data,status){
                showing();
            },
        });
    }
</script>
</html>
    <?php
}else{
    header('location:login.php');
}
?>