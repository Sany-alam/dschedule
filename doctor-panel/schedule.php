<?php 
session_start();
if (isset($_SESSION['doctor'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Schedules</title>
    <link rel="icon" href="images/logo.png" sizes="16x16 32x32" type="image/png">
    <?php include("includes/css.php"); ?> <!-- head tag -->
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
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h2>Schedules</h2>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addScheduleModal">Add Schedule</button>
                        </div>
                    </div>
                        <!-- <div class="card-body"> -->
                            <div id="saterday"></div>
                            <div id="sunday"></div>
                            <div id="monday"></div>
                            <div id="tuesday"></div>
                            <div id="wednesday"></div>
                            <div id="thursday"></div>
                            <div id="friday"></div>
                        <!-- </div> -->
                    <!-- page content -->
                </div>
                <!-- Content Wrapper END -->
            </div>
            <!-- Page Container END -->
        </div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="addScheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="day">Select day</label>
                    <select class="form-control" id="day">
                        <option value="">Select day</option>
                        <option value="mon">Monday</option>
                        <option value="tue">Tuesday</option>
                        <option value="wed">Wednesday</option>
                        <option value="thu">Thursday</option>
                        <option value="fri">Friday</option>
                        <option value="sat">Saturday</option>
                        <option value="sun">Sunday</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="start_time">Start from</label>
                    <input class="form-control" type="time" id="start_time">
                </div>
                <div class="form-group">
                    <label for="end_time">End in</label>
                    <input class="form-control" type="time" id="end_time">
                </div>
                <div class="form-group">
                    <label for="note">Note</label>
                    <textarea id="note" class="form-control"></textarea>
                </div>
                <!--<div class="form-check">-->
                <!--    <input class="form-check-input" type="checkbox" id="status">-->
                <!--    <label class="form-check-label" for="status">Status</label>-->
                <!--</div>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addSchedule">Save changes</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editScheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="schedule_id">
                <div class="form-group">
                    <label for="update_day">Select day</label>
                    <select class="form-control" id="update_day">
                        <option value="">Select day</option>
                        <option value="mon">Monday</option>
                        <option value="tue">Tuesday</option>
                        <option value="wed">Wednesday</option>
                        <option value="thu">Thursday</option>
                        <option value="fri">Friday</option>
                        <option value="sat">Saturday</option>
                        <option value="sun">Sunday</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="update_start_time">Start from</label>
                    <input class="form-control" type="time" id="update_start_time">
                </div>
                <div class="form-group">
                    <label for="update_end_time">End in</label>
                    <input class="form-control" type="time" id="update_end_time">
                </div>
                <div class="form-group">
                    <label for="update_note">Note</label>
                    <textarea id="update_note" class="form-control"></textarea>
                </div>
                <!--<div class="form-check">-->
                <!--    <input class="form-check-input" type="checkbox" id="update_status">-->
                <!--    <label class="form-check-label" for="update_status">Status</label>-->
                <!--</div>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="deleteSchedule">Delete</button>
                <button type="button" class="btn btn-primary" id="updateSchedule">Update changes</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="setLimitScheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Limit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="doctor_limit_hidden_id" type="hidden"/>
                <input id="doctor_limit_hidden_day" type="hidden"/>
                <input type="number" id="limit" class="form-control"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="setLimitSchedule">Save changes</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="changeLimitScheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Limit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="change_doctor_limit_hidden_id" type="hidden"/>
                <input id="change_doctor_limit_hidden_day" type="hidden"/>
                <input type="number" id="change_limit" class="form-control"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="deleteLimitSchedule">Delete</button>
                <button type="button" class="btn btn-primary" id="changeLimitSchedule">Update changes</button>
            </div>
            </div>
        </div>
    </div>
    <!-- modal -->
</body>
<?php include("includes/javascripts.php"); ?>
<script>
    $("a[href='schedule.php']").parent("li").addClass("active");

    $(function() {
        showing();

        $("#day").on("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                $("#addSchedule").click();
            }
        });
        $("#addSchedule").click(function() {
            data = new FormData();
            data.append('day',$("#day").val());
            data.append('start_time',$("#start_time").val());
            data.append('end_time',$("#end_time").val());
            data.append('note',$("#note").val());
            if ($("#status").is(":checked")) {
                status = 1;
            }else{
                status = 0;
            }
            data.append('status',status);
            data.append('addSchedule',"addSchedule");
            $.ajax({
                processData: false,
                contentType: false,
                url:"queries/schedule-query.php",
                type:'POST',
                data: data,
                success:function(data,status){
                    if (data.length != 0) {
                        alert(data);
                    }
                    showing();
                    $("#day").val('');
                    $("#start_time").val('');
                    $("#end_time").val('');
                    $("#note").val('');
                    $("#status").prop('checked',false);
                    $("#addScheduleModal").modal('hide');
                    alert("Schedule Added successfully");
                },
            });
        })

        $("#update_day").on("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                $("#updateSchedule").click();
            }
        });
        $("#updateSchedule").click(function() {
            data = new FormData();
            data.append('id',$("#schedule_id").val());
            data.append('day',$("#update_day").val());
            data.append('start_time',$("#update_start_time").val());
            data.append('end_time',$("#update_end_time").val());
            data.append('note',$("#update_note").val());
            if ($("#update_status").is(":checked")) {
                status = 1;
            }else{
                status = 0;
            }
            data.append('status',status);
            data.append('updateSchedule',"updateSchedule");
            $.ajax({
                processData: false,
                contentType: false,
                url:"queries/schedule-query.php",
                type:'POST',
                data: data,
                success:function(data,status){
                    if (data.length != 0) {
                        alert(data);
                    }
                    showing();
                    $("#editScheduleModal").modal('hide');
                    alert("Schedule Updated successfully");
                },
            });
        })

        $("#deleteSchedule").click(function() {
            data = new FormData();
            data.append('id',$("#schedule_id").val());
            data.append('deleteSchedule',"deleteSchedule");
            $.ajax({
                processData: false,
                contentType: false,
                url:"queries/schedule-query.php",
                type:'POST',
                data: data,
                success:function(data,status){
                    showing();
                    $("#editScheduleModal").modal('hide');
                },
            });
        })
        
        $("#setLimitSchedule").click(function(){
            d_id = $("#doctor_limit_hidden_id").val();
            day = $("#doctor_limit_hidden_day").val();
            limit = $("#limit").val();
            data = new FormData();
            data.append('doctor_id',d_id);
            data.append('day',day);
            data.append('limit',limit);
            data.append('setLimitInShcedule',"setLimitInShcedule");
            $.ajax({
                processData: false,
                contentType: false,
                url:"queries/schedule-query.php",
                type:'POST',
                data: data,
                success:function(data,status){
                   showing();
                   $("#limit").val('');
                   $("#setLimitScheduleModal").modal('hide');
                },
            });
        });
        
        $("#changeLimitSchedule").click(function(){
            d_id = $("#change_doctor_limit_hidden_id").val();
            day = $("#change_doctor_limit_hidden_day").val();
            limit = $("#change_limit").val();
            data = new FormData();
            data.append('doctor_id',d_id);
            data.append('day',day);
            data.append('limit',limit);
            data.append('changeLimitSchedule',"changeLimitSchedule");
            $.ajax({
                processData: false,
                contentType: false,
                url:"queries/schedule-query.php",
                type:'POST',
                data: data,
                success:function(data,status){
                   showing();
                   $("#changeLimitScheduleModal").modal("hide");
                },
            });
        });
        
        $("#deleteLimitSchedule").click(function(){
            d_id = $("#change_doctor_limit_hidden_id").val();
            day = $("#change_doctor_limit_hidden_day").val();
            limit = $("#change_limit").val();
            data = new FormData();
            data.append('doctor_id',d_id);
            data.append('day',day);
            data.append('limit',limit);
            data.append('deleteLimitSchedule',"deleteLimitSchedule");
            $.ajax({
                processData: false,
                contentType: false,
                url:"queries/schedule-query.php",
                type:'POST',
                data: data,
                success:function(data,status){
                   showing();
                   $("#changeLimitScheduleModal").modal("hide");
                },
            });
        });
    });

    function setLimit(id,day){
        $("#doctor_limit_hidden_id").val(id);
        $("#doctor_limit_hidden_day").val(day);
        $("#setLimitScheduleModal").modal("show");
    }

    function changeLimit(id,day){
        data = new FormData();
        data.append('doctor_id',id);
        data.append('day',day);
        data.append('changeLimitModal',"changeLimitModal");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/schedule-query.php",
            type:'POST',
            data: data,
            success:function(data,status){
                all = JSON.parse(data);
                $("#change_doctor_limit_hidden_id").val(all.doctor_id);
                $("#change_doctor_limit_hidden_day").val(all.day);
                $("#change_limit").val(all.patient_limit);
                $("#changeLimitScheduleModal").modal("show");
            },
        });
    }

    function showing() {
        data = new FormData();
        data.append('showingSchedule',"showingSchedule");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/schedule-query.php",
            type:'POST',
            data: data,
            success:function(data,status){
                all = JSON.parse(data);
                $("#saterday").html(all.sat);
                $("#sunday").html(all.sun);
                $("#monday").html(all.mon);
                $("#tuesday").html(all.tue);
                $("#wednesday").html(all.wed);
                $("#thursday").html(all.thu);
                $("#friday").html(all.fri);
            },
        });
    }


    function schedule(id) {
        data = new FormData();
        data.append('id',id);
        data.append('Schedule',"Schedule");
        $.ajax({
            processData: false,
            contentType: false,
            url:"queries/schedule-query.php",
            type:'POST',
            data: data,
            success:function(data,status){
                all = JSON.parse(data);
                $("#schedule_id").val(all.id);
                $("#update_start_time").val(all.start_time);
                $("#update_end_time").val(all.end_time);
                $("#update_day").val(all.day);
                $("#update_note").val(all.note);
                if (all.status == 1) {
                    $("#update_status").prop('checked',true);
                }
                $("#update_status").val(all.status);
                $("#editScheduleModal").modal('show');
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