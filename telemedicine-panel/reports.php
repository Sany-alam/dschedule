<?php
session_start();
if (isset($_SESSION['doctor'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/logo.png" sizes="16x16 32x32" type="image/png">
    <title>Home</title>
    <?php include("includes/css.php"); ?> <!-- head tag -->
    <link rel="stylesheet" href="assets/vendors/datatables/dataTables.bootstrap.min.css">
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
                        
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="today-tab" data-toggle="tab" href="#today" role="tab" aria-controls="today" aria-selected="true">Recent</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="weekly-tab" data-toggle="tab" href="#weekly" role="tab" aria-controls="weekly" aria-selected="false">All</a>
                        </li>
                    </ul>
                    <div class="tab-content m-t-15" id="myTabContent">
                        <div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="today-tab">
                            
                            <div id="recent-table"></div>

                        </div>
                        <div class="tab-pane fade" id="weekly" role="tabpanel" aria-labelledby="weekly-tab">
                            
                            <div id="all-table"></div>

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
    
    <!--modals-->
    <div class="modal fade" id="PrescriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Prescription</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="hidden_id" type="hidden"/>
                    <div class="form-group">
                        <label for="text">Text</label>
                        <textarea class="form-control" placeholder="Prescribe" id="prescription"></textarea>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button id="SubmitPrescription" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="UpdatePrescriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Prescription</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="prescription_hidden_id" type="hidden"/>
                    <div class="form-group">
                        <label for="text">Prescription</label>
                        <textarea class="form-control" placeholder="Prescribe" id="edit_prescription"></textarea>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button id="UpdatePrescription" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ReportImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Reports</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="report-images">
                    
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("includes/javascripts.php"); ?>
<script>
    $("a[href='reports.php']").parent("li").addClass("active");
    $(function(){
        boathReports();
        
        $("#SubmitPrescription").click(function(){
            if($("#prescription").val().length!=0){
                data = new FormData();
                data.append('appointment_id',$("#hidden_id").val());
                data.append('prescription',$("#prescription").val());
                data.append('createPrescription','createPrescription');
                $.ajax({
                    processData: false,
                    contentType: false,
                    url:"queries/report-query.php",
                    type:'POST',
                    data: data,
                    success:function(data,status){
                        if(data == "ok"){
                            $("#PrescriptionModal").modal('hide')
                            boathReports()
                        }else{
                            console.log(data);
                        }
                    },
                });   
            }
        })
        
        $("#UpdatePrescription").click(function(){
            prescription_hidden_id = $("#prescription_hidden_id").val();
            edit_prescription = $("#edit_prescription").val();
            if($("#edit_prescription").val().length!=0){
                data = new FormData();
                data.append('prescription_id',prescription_hidden_id);
                data.append('prescription',edit_prescription);
                data.append('updatePrescription','updatePrescription');
                $.ajax({
                    processData: false,
                    contentType: false,
                    url:"queries/report-query.php",
                    type:'POST',
                    data: data,
                    success:function(data,status){
                        if(data == "ok"){
                            $("#UpdatePrescriptionModal").modal('hide')
                            boathReports()
                        }else{
                            console.log(data);
                        }
                    },
                });   
            }
        })
    })
    
    function boathReports(){
        recentReport();
        allReports();
    }
    
    function SubmitPrescription(appointment_id){
        $("#hidden_id").val(appointment_id)
        $("#PrescriptionModal").modal('show')
    }
    
    function UpdatePrescription(prescription_id){
        data = new FormData();
        data.append('prescription_id',prescription_id);
        data.append('editPrescription','editPrescription');
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/report-query.php",
            type:'POST',
            data: data,
            success:function(data,status){
                all = JSON.parse(data)
                $("#prescription_hidden_id").val(all.id);
                $("#edit_prescription").val(all.prescription);
                $("#UpdatePrescriptionModal").modal('show')
            },
        });
    }
    
    function reports(appointment_id){
        data = new FormData();
        data.append('appointment_id',appointment_id);
        data.append('reportImages','reportImages');
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/report-query.php",
            type:'POST',
            data: data,
            success:function(data,status){
                $("#report-images").html(data);
                $("#ReportImageModal").modal('show');
            },
        });
    }
    
    function recentReport(){
        data = new FormData();
        data.append('recentReport','recentReport');
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/report-query.php",
            type:'POST',
            data: data,
            success:function(data,status){
                $("#recent-table").html(data)
            },
        });
    }
    
    function allReports(){
        data = new FormData();
        data.append('allReport','allReport');
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/report-query.php",
            type:'POST',
            data: data,
            success:function(data,status){
                $("#all-table").html(data)
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