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
                            <a class="nav-link active" id="today-tab" data-toggle="tab" href="#today" role="tab" aria-controls="today" aria-selected="true">Today</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="weekly-tab" data-toggle="tab" href="#weekly" role="tab" aria-controls="weekly" aria-selected="false">All</a>
                        </li>
                    </ul>
                    <div class="tab-content m-t-15" id="myTabContent">
                        <div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="today-tab">
                            
                            <div id="today-table"></div>

                        </div>
                        <div class="tab-pane fade" id="weekly" role="tabpanel" aria-labelledby="weekly-tab">
                            
                            <div id="except-today-table"></div>

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
    <div class="modal fade" id="patientDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Patient information</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>Name : <p class="d-inline-block" id="name"></p></div>
                    <div>Email : <p class="d-inline-block" id="email"></p></div>
                    <div>Phone : <p class="d-inline-block" id="msisdn"></p></div>
                    <div>Address : <p class="d-inline-block" id="address"></p></div>
                    <div>Age : <p class="d-inline-block" id="age"></p></div>
                    <div>Gender : <p class="d-inline-block" id="gender"></p></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="SendNoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Send message</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="hidden_text_user_id" type="hidden"/>
                    <input id="hidden_text_user_msisdn" type="hidden"/>
                    <div class="form-group">
                        <label for="text">Text</label>
                        <textarea class="form-control" placeholder="Write a textt" id="text"></textarea>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button id="send-note" class="btn btn-sm btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditNoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Send message</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="edit_hidden_text_user_id" type="hidden"/>
                    <input id="edit_hidden_text_user_msisdn" type="hidden"/>
                    <div class="form-group">
                        <label for="text">Text</label>
                        <textarea class="form-control" placeholder="Write a textt" id="edit_text"></textarea>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button id="uppdate-note" class="btn btn-sm btn-primary">Send again</button>
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
                <div class="modal-body">
                    <div id="report-images"></div>
                    <input type="hidden" id="appointment_id">
                    <div class="d-flex justify-content-between align-items-center">
                        <input type="file" id="report">
                        <button class="btn btn-sm btn-primary my-3" id="addReport">Add reports</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <!--modals-->
</body>
<?php include("includes/javascripts.php"); ?>
<script>
    $("a[href='index.php']").parent("li").addClass("active");
    $(function(){
        function allappointments(){
        showTodayAppointments();
        showExceptTodayAppointments();
        }
        allappointments();
        
        $("#send-note").click(function(){
            var id = $("#hidden_text_user_id").val();
            var text = $("#text").val();
            var msisdn = $("#hidden_text_user_msisdn").val();
            data = new FormData();
            data.append('id',id);
            data.append('text',text);
            data.append('sendingTextToPatientOfAppointment','sendingTextToPatientOfAppointment');
            $.ajax({
                processData: false,
                contentType: false,
                url:"queries/appointments.php",
                type:'POST',
                data: data,
                success:function(data,status){
                    alert("Sent Successfully");
                    allappointments();
                    sendsms(msisdn,text);
                    $("#SendNoteModal").modal("hide");
                },
            });
        });
        
        $("#uppdate-note").click(function(){
            var id = $("#edit_hidden_text_user_id").val();
            var text = $("#edit_text").val();
            var msisdn = $("#edit_hidden_text_user_msisdn").val();
            data = new FormData();
            data.append('id',id);
            data.append('text',text);
            data.append('sendingTextToPatientOfAppointment','sendingTextToPatientOfAppointment');
            $.ajax({
                processData: false,
                contentType: false,
                url:"queries/appointments.php",
                type:'POST',
                data: data,
                success:function(data,status){
                    alert("Sent Successfully");
                    allappointments();
                    sendsms(msisdn,text);
                    $("#EditNoteModal").modal("hide");
                },
            });
        });

        $("#SubmitPrescription").click(function(){
            if($("#prescription").val().length!=0){
                data = new FormData();
                data.append('appointment_id',$("#hidden_id").val());
                data.append('prescription',$("#prescription").val());
                data.append('createPrescription','createPrescription');
                $.ajax({
                    processData: false,
                    contentType: false,
                    url:"queries/appointments.php",
                    type:'POST',
                    data: data,
                    success:function(data,status){
                        if(data == "ok"){
                            $("#PrescriptionModal").modal('hide')
                            alert("Prescription added");
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
                data = new FormData();
                data.append('prescription_id',prescription_hidden_id);
                data.append('prescription',edit_prescription);
                data.append('updatePrescription','updatePrescription');
                $.ajax({
                    processData: false,
                    contentType: false,
                    url:"queries/appointments.php",
                    type:'POST',
                    data: data,
                    success:function(data,status){
                        if(data == "ok"){
                            $("#UpdatePrescriptionModal").modal('hide')
                            alert("Prescription updated");
                        }else{
                            console.log(data);
                        }
                    },
                });
        })

        $("#addReport").click(function() {
            if ($("#report")[0].files[0].length != 0) {
                data = new FormData();
                data.append('addReports','addReports');
                data.append('appointment_id',$("#appointment_id").val());
                data.append('reports',$("#report")[0].files[0]);
                $.ajax({
                    processData: false,
                    contentType: false,
                    url:"queries/appointments.php",
                    type:'POST',
                    data: data,
                    success:function(data,status){
                        showReports($("#appointment_id").val());
                        $("#report").val('');
                        if (data.length!=0) {
                            alert(data);
                        }
                    },
                });
            }
        });
    });

    function UpdatePrescription(prescription_id){
        data = new FormData();
        data.append('prescription_id',prescription_id);
        data.append('editPrescription','editPrescription');
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/appointments.php",
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

    function prescription(appointment_id){
        $("#hidden_id").val(appointment_id)
        $("#PrescriptionModal").modal('show')
    }

    function deleteReport(id,name) {
        data = new FormData();
        data.append('deleteReport','deleteReport');
        data.append('report_id',id);
        data.append('report_name',name);
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/appointments.php",
            type:'POST',
            data: data,
            success:function(data,status){
                showReports($("#appointment_id").val());
            },
        });
    }

    function reports(appointment_id) {
        showReports(appointment_id);
        $("#appointment_id").val(appointment_id);
        $("#ReportImageModal").modal('show');
    }

    function showReports(appointment_id) {
        data = new FormData();
        data.append('appointment_id',appointment_id);
        data.append('reports','reports');
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/appointments.php",
            type:'POST',
            data: data,
            success:function(data,status){
                $("#report-images").html(data);
            },
        });
    }
    
    function sendsms(phone,text){
        data = new FormData();
        data.append('msisdn',phone);
        data.append('message',text);
        $.ajax({
            processData: false,
            contentType: false,
            url:"http://www.quiz-hunt.com/exam/api/send_message",
            type:'POST',
            data: data,
            success:function(data,status){
            },
        });
    }

    function editNote(id,phone){
        data = new FormData();
        data.append('editNote','editNote');
        data.append('id',id);
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/appointments.php",
            type:'POST',
            data: data,
            success:function(data,status){
                all = JSON.parse(data)
                console.log(all);
                $("#edit_hidden_text_user_id").val(all.id);
                $("#edit_hidden_text_user_msisdn").val(phone);
                $("#edit_text").val(all.note);
                $("#EditNoteModal").modal("show");
            },
        });
    }

    function sendNote(id,msisdn){
        $("#hidden_text_user_msisdn").val(msisdn);
        $("#hidden_text_user_id").val(id);
        $("#SendNoteModal").modal("show");
    }
    
    function patientDetail(id) {
        data = new FormData();
        data.append('patientDetail','patientDetail');
        data.append('patient_id',id);
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/appointments.php",
            type:'POST',
            data: data,
            success:function(data,status){
                all = JSON.parse(data);
                $("#name").html(all.name);
                $("#msisdn").html(all.msisdn);
                $("#age").html(all.age);
                $("#email").html(all.email);
                $("#gender").html(all.gender);
                $("#address").html(all.address);
                $("#patientDetailModal").modal('show');
            },
        });
    }
    

    function showTodayAppointments() {
        data = new FormData();
        data.append('showTodayAppointments','showTodayAppointments');
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/appointments.php",
            type:'POST',
            data: data,
            success:function(data,status){
                $("#today-table").html(data);
            },
        });
    }

    function showExceptTodayAppointments() {
        data = new FormData();
        data.append('showExceptTodayAppointments','showExceptTodayAppointments');
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/appointments.php",
            type:'POST',
            data: data,
            success:function(data,status){
                $("#except-today-table").html(data);
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