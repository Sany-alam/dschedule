<?php
include("../../connection.php");
session_start();
$doctor = $_SESSION['doctor']['id'];
date_default_timezone_set('Asia/Dhaka');
$date = date('j-n-Y');

if(isset($_POST['recentReport'])){
    $sql = "SELECT * FROM `tbl_appoint_tele` WHERE `doctor_id` = '$doctor' AND `date` = '$date' ORDER By id DESC";
    $res = mysqli_query($conn,$sql);
    ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead >
                <tr>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Reports</th>
                    <th>Prescription</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($fetch = mysqli_fetch_assoc($res)) {
                $id = $fetch['patient_id'];
                $sql_patient = "SELECT * FROM `tbl_patient` WHERE `id` = '$id'";
                $res_patient = mysqli_query($conn,$sql_patient);
                $patient = mysqli_fetch_array($res_patient);
                $appoint_id = $fetch['id'];
                ?>
                <tr>
                    <td><?php echo $fetch['serial'] ?></td>
                    <td><?php echo $patient['name'] ?></td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="reports(<?php echo $appoint_id ?>)">Reports</button>
                    </td>
                    <td>
                        <?php
                        $sql_prescription = "SELECT * FROM `tbl_prescription` WHERE `appointment_id` = '$appoint_id'";
                        $res_prescription = mysqli_query($conn,$sql_prescription);
                        if(mysqli_num_rows($res_prescription)>0){
                            $prescription = mysqli_fetch_assoc($res_prescription);
                            ?><button class="btn btn-sm btn-primary" onclick="UpdatePrescription(<?php echo $prescription['id'] ?>)">Update Prescription</button><?php
                        }else{
                            ?><button class="btn btn-sm btn-primary" onclick="SubmitPrescription(<?php echo $appoint_id ?>)">Submit Prescription</button><?php
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

if(isset($_POST['allReport'])){
    $sql = "SELECT * FROM `tbl_appoint_tele` WHERE `doctor_id` = '$doctor' ORDER By id DESC";
    $res = mysqli_query($conn,$sql);
    ?>
    <div class="table-responsive">
        <table class="table table-hover e-commerce-table">
            <thead >
                <tr>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Reports</th>
                    <th>Prescription</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($fetch = mysqli_fetch_assoc($res)) {
                $id = $fetch['patient_id'];
                $sql_patient = "SELECT * FROM `tbl_patient` WHERE `id` = '$id'";
                $res_patient = mysqli_query($conn,$sql_patient);
                $patient = mysqli_fetch_array($res_patient);
                $appoint_id = $fetch['id'];
                ?>
                <tr>
                    <td><?php echo $fetch['serial'] ?></td>
                    <td><?php echo $patient['name'] ?></td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="reports(<?php echo $appoint_id ?>)">Reports</button>
                    </td>
                    <td>
                        <?php
                        $sql_prescription = "SELECT * FROM `tbl_prescription` WHERE `appointment_id` = '$appoint_id'";
                        $res_prescription = mysqli_query($conn,$sql_prescription);
                        if(mysqli_num_rows($res_prescription)>0){
                            $prescription = mysqli_fetch_assoc($res_prescription);
                            ?><button class="btn btn-sm btn-primary" onclick="UpdatePrescription(<?php echo $prescription['id'] ?>)">Update Prescription</button><?php
                        }else{
                            ?><button class="btn btn-sm btn-primary" onclick="SubmitPrescription(<?php echo $appoint_id ?>)">Submit Prescription</button><?php
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

if(isset($_POST['createPrescription'])){
    $appointment_id = $_POST['appointment_id'];
    $prescription = $_POST['prescription'];
    $sql = "INSERT INTO `tbl_prescription`(`appointment_id`, `prescription`) VALUES ('$appointment_id','$prescription')";
    $res = mysqli_query($conn,$sql);
    if($res){
        echo "ok";
    }else{
        echo var_dump($res);
    }
}

if(isset($_POST['editPrescription'])){
    $prescription_id = $_POST['prescription_id'];
    $sql = "SELECT * FROM `tbl_prescription` WHERE `id` = '$prescription_id'";
    $res = mysqli_query($conn,$sql);
    echo json_encode(mysqli_fetch_array($res));
}

if(isset($_POST['reportImages'])){
    $appointment_id = $_POST['appointment_id'];
    $sql = "SELECT * FROM `tbl_report` WHERE `appointment_id` = '$appointment_id' ORDER BY id DESC";
    $res = mysqli_query($conn,$sql);
    ?><div class="row"><?php
    while ($reports = mysqli_fetch_assoc($res)) {
        ?>
        <div class="col-md-6 bordered">
        <a class="" target="blank" href="/../doctor/reports/<?php echo $reports['image']; ?>"><img class="img-fluid rounded" src="/../doctor/reports/<?php echo $reports['image']; ?>" alt="unavailable report"></a>
        </div>
        <?php
    }
    ?></div><?php
    if(mysqli_num_rows($res)==0){
        ?>
        <h3 class="d-flex justify-content-center align-items-center">Report not available</h3>
        <?php
    }
}

if(isset($_POST['updatePrescription'])){
    $prescription_id = $_POST['prescription_id'];
    $prescription = $_POST['prescription'];
    $sql = "UPDATE `tbl_prescription` SET `prescription`= '$prescription' WHERE `id` = '$prescription_id'";
    $res = mysqli_query($conn,$sql);
    if($res){
        echo "ok";
    }else{
        echo var_dump($res);
    }
}