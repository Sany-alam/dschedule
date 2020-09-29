<?php
include("../../connection.php");
session_start();
$doctor = $_SESSION['doctor']['id'];
date_default_timezone_set('Asia/Dhaka');
$date = date('d-m-Y');

if(isset($_POST['createPrescription'])){
    $appointment_id = $_POST['appointment_id'];
    $prescription = $_POST['prescription'];
    $sql = "INSERT INTO `tbl_prescription_regular`(`appointment_id`, `prescription`) VALUES ('$appointment_id','$prescription')";
    $res = mysqli_query($conn,$sql);
    if($res){
        echo "ok";
    }else{
        echo var_dump($res);
    }
}

if(isset($_POST['editPrescription'])){
    $prescription_id = $_POST['prescription_id'];
    $sql = "SELECT * FROM `tbl_prescription_regular` WHERE `id` = '$prescription_id'";
    $res = mysqli_query($conn,$sql);
    echo json_encode(mysqli_fetch_array($res));
}

if(isset($_POST['updatePrescription'])){
    $prescription_id = $_POST['prescription_id'];
    $prescription = $_POST['prescription'];
    $sql = "UPDATE `tbl_prescription_regular` SET `prescription`= '$prescription' WHERE `id` = '$prescription_id'";
    $res = mysqli_query($conn,$sql);
    if($res){
        echo "ok";
    }else{
        echo var_dump($res);
    }
}

if (isset($_POST['deleteReport'])) {
    $report_id = $_POST['report_id'];
    $report_name = $_POST['report_name'];
    unlink('../images/'.$report_name);
    $sql = "DELETE FROM `tbl_report_regular` WHERE `id` = '$report_id'";
    $res = mysqli_query($conn,$sql);
}


if (isset($_POST['addReports'])) {
    $appointment_id = $_POST['appointment_id'];
    $dir = "../images/";
    $img_name = $date.$_FILES['reports']['name'];
    if (file_exists($dir.$img_name)) {
        echo "Report already exists!";
    }else{
        move_uploaded_file($_FILES['reports']['tmp_name'],$dir.$img_name);
        $sql = "INSERT INTO `tbl_report_regular`(`appointment_id`, `image`) VALUES ('$appointment_id','$img_name')";
        $res = mysqli_query($conn,$sql);
    }
}

if (isset($_POST['reports'])) {
    $appointment_id = $_POST['appointment_id'];
    $sql = "SELECT * FROM `tbl_report_regular` WHERE `appointment_id` = '$appointment_id' ORDER BY id DESC";
    $res = mysqli_query($conn,$sql);
    while ($reports = mysqli_fetch_assoc($res)) {
        ?>
            <a class="" target="blank" href="images/<?php echo $reports['image']; ?>">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top"src="images/<?php echo $reports['image']; ?>" alt="unavailable report">
                <div class="card-body">
                    <a onclick="deleteReport(<?php echo $reports['id']; ?>,'<?php echo $reports['image']; ?>')" href="javascript:void(0)" class="btn btn-danger">Delete</a>
                </div>
            </div>
            </a>
        <?php
    }
    if(mysqli_num_rows($res)==0){
        ?>
        <h3 class="d-flex justify-content-center align-items-center">Report not available</h3>
        <?php
    }
}

if(isset($_POST['editNote'])){
    $id = $_POST['id'];
    $sql = "SELECT * FROM `tbl_appoint` WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
    $fetch = mysqli_fetch_array($res);
    echo json_encode($fetch);
}

if(isset($_POST['sendingTextToPatientOfAppointment'])){
    $id = $_POST['id'];
    $text = $_POST['text'];
    $sql = "UPDATE `tbl_appoint` SET `note`='$text' WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
}

if (isset($_POST['showExceptTodayAppointments'])) {
    $sql = "SELECT * FROM `tbl_appoint` WHERE `doctor_id` = '$doctor' ORDER By date DESC";
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
                    <th></th>
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
                    <td><button class="btn btn-sm btn-primary" onclick="reports(<?php echo $fetch['id'] ?>)">Reports</button></td>
                    <td>
                        <?php
                        $appoint_id = $fetch['id'];
                        $sql_prescription = "SELECT * FROM `tbl_prescription_regular` WHERE `appointment_id` = '$appoint_id'";
                        $res_prescription = mysqli_query($conn,$sql_prescription);
                        if(mysqli_num_rows($res_prescription)>0){
                            $prescription = mysqli_fetch_assoc($res_prescription);
                            ?><button class="btn btn-sm btn-primary" onclick="UpdatePrescription(<?php echo $prescription['id'] ?>)">Update Prescription</button><?php
                        }else{
                            ?><button class="btn btn-sm btn-primary" onclick="prescription(<?php echo $appoint_id ?>)">Add Prescription</button><?php
                        }
                        ?>
                    </td>
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
    $sql = "UPDATE `tbl_appoint` SET `in_queue`=$queue WHERE `id` = '$appointId'";
    $res = mysqli_query($conn,$sql);
}

if (isset($_POST['showTodayAppointments'])) {
    date_default_timezone_set('Asia/Dhaka');
    $dateBySlash = date('j/n/Y');
    $dateExploded = explode('/',$dateBySlash);
    $date = $dateExploded[0].'-'.$dateExploded[1].'-'.$dateExploded[2];
    $doctor = $_SESSION['doctor']['id'];
    $sql = "SELECT * FROM `tbl_appoint` WHERE `doctor_id` = $doctor AND `date` = '$date' ORDER By `serial` ASC";
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
                    <th>In queue</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($appoint = mysqli_fetch_assoc($res)) {
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
                    <td><input id="queue<?php echo $appoint['id'] ?>" type="checkbox" class="checkbox"/></td>
                    <td><button class="btn btn-sm btn-primary" onclick="patientDetail(<?php echo $appoint['patient_id'] ?>)">View profile</button></td>
                    <script>
                    if(<?php echo $appoint['in_queue'] ?> == "0"){$("#queue<?php echo $appoint['id'] ?>").prop("checked",false)}else{$("#queue<?php echo $appoint['id'] ?>").prop("checked",true)}
        
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
                </tr>
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