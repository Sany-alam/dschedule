<?php
include("../../connection.php");
session_start();
$doctor = $_SESSION['doctor']['id'];
date_default_timezone_set('Asia/Dhaka');
$date = date('d-m-Y');

if(isset($_POST['editNote'])){
    $id = $_POST['id'];
    $sql = "SELECT * FROM `tbl_appoint_tele` WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
    $fetch = mysqli_fetch_array($res);
    echo json_encode($fetch);
}

if(isset($_POST['sendingTextToPatientOfAppointment'])){
    $id = $_POST['id'];
    $text = $_POST['text'];
    $sql = "UPDATE `tbl_appoint_tele` SET `note`='$text' WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
}

if (isset($_POST['showExceptTodayAppointments'])) {
    $sql = "SELECT * FROM `tbl_appoint_tele` WHERE `doctor_id` = '$doctor' ORDER By date DESC";
    $res = mysqli_query($conn,$sql);
    ?>
    <div class="table-responsive">
        <table class="table table-hover e-commerce-table">
            <thead >
                <tr>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($fetch = mysqli_fetch_assoc($res)) {
                $id = $fetch['patient_id'];
                $sql2 = "SELECT * FROM `tbl_patient` WHERE `id` = '$id'";
                $res2 = mysqli_query($conn,$sql2);
                $patient = mysqli_fetch_array($res2);
                ?>
                <tr>
                    <td><?php echo $fetch['serial'] ?></td>
                    <td><?php echo $patient['name'] ?></td>
                    <td><?php echo $fetch['date'] ?></td>
                    <td><button class="btn btn-sm btn-primary" onclick="patientDetail(<?php echo $fetch['patient_id'] ?>)">View profile</button></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <script src="assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="assets/vendors/datatables/e-commerce-order-list.js"></script>
    <?php
}

if(isset($_POST['inqueue'])){
    $appointId = $_POST['id'];
    $queue = $_POST['queue'];
    $sql = "UPDATE `tbl_appoint_tele` SET `in_queue`=$queue WHERE `id` = '$appointId'";
    $res = mysqli_query($conn,$sql);
}

if (isset($_POST['showTodayAppointments'])) {
    date_default_timezone_set('Asia/Dhaka');
    $dateBySlash = date('j/n/Y');
    $dateExploded = explode('/',$dateBySlash);
    $date = $dateExploded[0].'-'.$dateExploded[1].'-'.$dateExploded[2];
    $sql = "SELECT * FROM `tbl_appoint_tele` WHERE `doctor_id` = '$doctor' AND `date` = '$date' ORDER By date DESC";
    $res = mysqli_query($conn,$sql);
    ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead >
                <tr>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Send text</th>
                    <th>Whatsapp number</th>
                    <th>In queue</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($appoint = mysqli_fetch_array($res)) {
                $id = $appoint['id'];
                $patient_id = $appoint['patient_id'];
                $sql1 = "SELECT * FROM `tbl_patient` WHERE `id` = '$patient_id'";
                $res1 = mysqli_query($conn,$sql1);
                $patient = mysqli_fetch_array($res1);
                ?>
                <tr>
                    <td><?php echo $appoint['serial'] ?></td>
                    <td><?php echo $patient['name'] ?></td>
                    <td><?php echo $appoint['date'] ?></td>
                    <?php
                    if(empty($appoint['note'])){
                        ?>
                        <td><button class="btn btn-sm btn-primary" onclick="sendNote(<?php echo $appoint['id'] ?>,'<?php echo $patient['msisdn']; ?>')">Send message</button></td>
                        <?php
                    }else{
                        ?>
                        <td><button class="btn btn-sm btn-success" onclick="editNote(<?php echo $appoint['id'] ?>,'<?php echo $patient['msisdn']; ?>')">Edit message</button></td>
                        <?php
                    }
                    ?>
                    <td><?php echo $appoint['whatsapp_number'] ?></td>
                    <td><input id="queue<?php echo $appoint['id'] ?>" type="checkbox" class="checkbox"/></td>
                    <td><button class="btn btn-sm btn-primary" onclick="patientDetail(<?php echo $appoint['patient_id'] ?>)">View profile</button></td>
                </tr>
                <script>
                    if(<?php echo $appoint['in_queue']; ?> == "0"){$("#queue<?php echo $appoint['id'] ?>").prop("checked",false)}else{$("#queue<?php echo $appoint['id'] ?>").prop("checked",true)}
        
                    $("#queue<?php echo $appoint['id'] ?>").change(function(){
                        if ($("#queue<?php echo $appoint['id'] ?>").is(":checked")){
                            queue = 1;
                        }
                        else{
                            queue = 0;
                        }
                        var formData= new FormData();
                        formData.append("id","<?php echo $appoint['id'] ?>");
                        formData.append("queue",queue);
                        formData.append("inqueue","inqueue");
                        $.ajax({
                            processData: false,
                            contentType: false,
                            url:"queries/appointments.php",
                            type:"POST",
                            data:formData,
                            success:function(data,status){
                                if(data == "done"){
                                    showTodayAppointments();
                                }else{
                                    console.log(data);
                                }
                            },
                        });
                    });
                    </script>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
}

if (isset($_POST['patientDetail'])) {
    $id = $_POST['patient_id'];
    $sql = "SELECT * FROM `tbl_patient` WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
    $fetch = mysqli_fetch_array($res);
    echo json_encode($fetch);
}