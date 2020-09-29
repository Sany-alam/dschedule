<?php
// database connection
include("../../connection.php");
session_start();

if(isset($_POST['deleteLimitSchedule'])){
    $doctor_id = $_POST['doctor_id'];
    $day = $_POST['day'];
    $limit = $_POST['limit'];
    $sql = "DELETE FROM `tbl_day_limits_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = '$day' AND `patient_limit` = '$limit'";
    $res = mysqli_query($conn,$sql);
}

if(isset($_POST['changeLimitSchedule'])){
    $doctor_id = $_POST['doctor_id'];
    $day = $_POST['day'];
    $limit = $_POST['limit'];
    $sql = "UPDATE `tbl_day_limits_tele` SET `patient_limit`='$limit' WHERE `doctor_id` = '$doctor_id' AND `day` = '$day'";
    $res = mysqli_query($conn,$sql);
}

if(isset($_POST['changeLimitModal'])){
    $doctor_id = $_POST['doctor_id'];
    $day = $_POST['day'];
    $sql = "SELECT * FROM `tbl_day_limits_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = '$day'";
    $res = mysqli_query($conn,$sql);
    $fetch = mysqli_fetch_array($res);
    echo json_encode($fetch);
}

if(isset($_POST['setLimitInShcedule'])){
    $doctor_id = $_POST['doctor_id'];
    $day = $_POST['day'];
    $limit = $_POST['limit'];
    $sql = "INSERT INTO `tbl_day_limits_tele`(`doctor_id`,`day`,`patient_limit`) VALUES ('$doctor_id','$day','$limit')";
    $res = mysqli_query($conn,$sql);
}

if (isset($_POST['addSchedule'])) {
    $day = $_POST['day'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $note = $_POST['note'];
    $status = $_POST['status'];
    $doctor_id = $_SESSION['doctor']['id'];

    $sql = "INSERT INTO `tbl_schedule_tele`(`doctor_id`, `day`, `start_time`, `end_time`, `note`, `status`) VALUES ('$doctor_id','$day','$start_time','$end_time','$note','$status')";
    $res = mysqli_query($conn,$sql);
}

if (isset($_POST['updateSchedule'])) {
    $day = $_POST['day'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $note = $_POST['note'];
    $status = $_POST['status'];
    $id = $_POST['id'];;

    $sql = "UPDATE `tbl_schedule_tele` SET `day`='$day',`start_time`='$start_time',`end_time`='$end_time',`note`='$note',`status`='$status' WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
}

if (isset($_POST['showingSchedule'])) {
    $doctor_id = $_SESSION['doctor']['id'];
    $sql_sat = "SELECT * FROM `tbl_schedule_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = 'sat'";
    $res_sat = mysqli_query($conn,$sql_sat);
    $sat = '<div class="card">
    <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
    <ul class="nav" >
    <li class="nav-item border-right">
    <a class="nav-link disabled" href="#">Saturday</a>
    </li>';
    while ($fetch_sat = mysqli_fetch_array($res_sat)) {
        $sat .='<li class="nav-item">
        <a href="javascript:void(0);" onclick="schedule('.$fetch_sat['id'].')" class="nav-link">'.$fetch_sat['start_time'].'-'.$fetch_sat['end_time'].'</a>
        </li>';
    }
    $day = "sat";
    $sql_limit = "SELECT * FROM `tbl_day_limits_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = '$day'";
    $res_limit = mysqli_query($conn,$sql_limit);
    $fetch_limit = mysqli_fetch_array($res_limit);
    if(mysqli_num_rows($res_limit)>0){
        $set_button = '<button class="btn btn-light" onclick="changeLimit(\''.$doctor_id.'\',\''.$day.'\')">'.$fetch_limit['patient_limit'].'</button>';
    }else{
        $set_button = '<button class="btn btn-sm btn-primary" onclick="setLimit(\''.$doctor_id.'\',\''.$day.'\')">Set limit</button>';
    }
    $sat.='</ul>
    '.$set_button.'
    </div>
    </div>
    </div>
    ';


    $sql_sun = "SELECT * FROM `tbl_schedule_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = 'sun'";
    $res_sun = mysqli_query($conn,$sql_sun);
    $sun = '<div class="card">
    <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
    <ul class="nav" >
    <li class="nav-item border-right">
    <a class="nav-link disabled" href="#">Sunday</a>
    </li>';
    while ($fetch_sun = mysqli_fetch_array($res_sun)) {
        $sun .='<li class="nav-item">
        <a href="javascript:void(0);" onclick="schedule('.$fetch_sun['id'].')" class="nav-link">'.$fetch_sun['start_time'].'-'.$fetch_sun['end_time'].'</a>
        </li>';
    }
    $day_sun = "sun";
    $sql_limit_sun = "SELECT * FROM `tbl_day_limits_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = '$day_sun'";
    $res_limit_sun = mysqli_query($conn,$sql_limit_sun);
    $fetch_limit_sun = mysqli_fetch_array($res_limit_sun);
    if(mysqli_num_rows($res_limit_sun)>0){
        $set_button_sun = '<button class="btn btn-light" onclick="changeLimit(\''.$doctor_id.'\',\''.$day_sun.'\')">'.$fetch_limit_sun['patient_limit'].'</button>';
    }else{
        $set_button_sun = '<button class="btn btn-sm btn-primary" onclick="setLimit(\''.$doctor_id.'\',\''.$day_sun.'\')">Set limit</button>';
    }
    $sun.='</ul>
    '.$set_button_sun.'
    </div>
    </div>
    </div>
    ';


    $sql_mon = "SELECT * FROM `tbl_schedule_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = 'mon'";
    $res_mon = mysqli_query($conn,$sql_mon);
    $mon = '<div class="card">
    <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
    <ul class="nav" >
    <li class="nav-item border-right">
    <a class="nav-link disabled" href="#">Monday</a>
    </li>';
    while ($fetch_mon = mysqli_fetch_array($res_mon)) {
        $mon .='<li class="nav-item">
        <a href="javascript:void(0);" onclick="schedule('.$fetch_mon['id'].')" class="nav-link">'.$fetch_mon['start_time'].'-'.$fetch_mon['end_time'].'</a>
        </li>';
    }
    $day_mon = "mon";
    $sql_limit_mon = "SELECT * FROM `tbl_day_limits_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = '$day_mon'";
    $res_limit_mon = mysqli_query($conn,$sql_limit_mon);
    $fetch_limit_mon = mysqli_fetch_array($res_limit_mon);
    if(mysqli_num_rows($res_limit_mon)>0){
        $set_button_mon = '<button class="btn btn-light" onclick="changeLimit(\''.$doctor_id.'\',\''.$day_mon.'\')">'.$fetch_limit_mon['patient_limit'].'</button>';
    }else{
        $set_button_mon = '<button class="btn btn-sm btn-primary" onclick="setLimit(\''.$doctor_id.'\',\''.$day_mon.'\')">Set limit</button>';
    }
    $mon.='</ul>
    '.$set_button_mon.'
    </div>
    </div>
    </div>
    ';


    $sql_tue = "SELECT * FROM `tbl_schedule_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = 'tue'";
    $res_tue = mysqli_query($conn,$sql_tue);
    $tue = '<div class="card">
    <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
    <ul class="nav" >
    <li class="nav-item border-right">
    <a class="nav-link disabled" href="#">Tuesday</a>
    </li>';
    while ($fetch_tue = mysqli_fetch_array($res_tue)) {
        $tue .='<li class="nav-item">
        <a href="javascript:void(0);" onclick="schedule('.$fetch_tue['id'].')" class="nav-link">'.$fetch_tue['start_time'].'-'.$fetch_tue['end_time'].'</a>
        </li>';
    }
    $day_tue = "tue";
    $sql_limit_tue = "SELECT * FROM `tbl_day_limits_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = '$day_tue'";
    $res_limit_tue = mysqli_query($conn,$sql_limit_tue);
    $fetch_limit_tue = mysqli_fetch_array($res_limit_tue);
    if(mysqli_num_rows($res_limit_tue)>0){
        $set_button_tue = '<button class="btn btn-light" onclick="changeLimit(\''.$doctor_id.'\',\''.$day_tue.'\')">'.$fetch_limit_tue['patient_limit'].'</button>';
    }else{
        $set_button_tue = '<button class="btn btn-sm btn-primary" onclick="setLimit(\''.$doctor_id.'\',\''.$day_tue.'\')">Set limit</button>';
    }
    $tue.='</ul>
    '.$set_button_tue.'
    </div>
    </div>
    </div>
    ';


    $sql_wed = "SELECT * FROM `tbl_schedule_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = 'wed'";
    $res_wed = mysqli_query($conn,$sql_wed);
    $wed = '<div class="card">
    <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
    <ul class="nav" >
    <li class="nav-item border-right">
    <a class="nav-link disabled" href="#">Wednesday</a>
    </li>';
    while ($fetch_wed = mysqli_fetch_array($res_wed)) {
        $wed .='<li class="nav-item">
        <a href="javascript:void(0);" onclick="schedule('.$fetch_wed['id'].')" class="nav-link">'.$fetch_wed['start_time'].'-'.$fetch_wed['end_time'].'</a>
        </li>';
    }
    $day_wed = "wed";
    $sql_limit_wed = "SELECT * FROM `tbl_day_limits_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = '$day_wed'";
    $res_limit_wed = mysqli_query($conn,$sql_limit_wed);
    $fetch_limit_wed = mysqli_fetch_array($res_limit_wed);
    if(mysqli_num_rows($res_limit_wed)>0){
        $set_button_wed = '<button class="btn btn-light" onclick="changeLimit(\''.$doctor_id.'\',\''.$day_wed.'\')">'.$fetch_limit_wed['patient_limit'].'</button>';
    }else{
        $set_button_wed = '<button class="btn btn-sm btn-primary" onclick="setLimit(\''.$doctor_id.'\',\''.$day_wed.'\')">Set limit</button>';
    }
    $wed.='</ul>
    '.$set_button_wed.'
    </div>
    </div>
    </div>
    ';


    $sql_thu = "SELECT * FROM `tbl_schedule_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = 'thu'";
    $res_thu = mysqli_query($conn,$sql_thu);
    $thu = '<div class="card">
    <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
    <ul class="nav" >
    <li class="nav-item border-right">
    <a class="nav-link disabled" href="#">Thursday</a>
    </li>';
    while ($fetch_thu = mysqli_fetch_array($res_thu)) {
        $thu .='<li class="nav-item">
        <a href="javascript:void(0);" onclick="schedule('.$fetch_thu['id'].')" class="nav-link">'.$fetch_thu['start_time'].'-'.$fetch_thu['end_time'].'</a>
        </li>';
    }
    $day_thu = "thu";
    $sql_limit_thu = "SELECT * FROM `tbl_day_limits_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = '$day_thu'";
    $res_limit_thu = mysqli_query($conn,$sql_limit_thu);
    $fetch_limit_thu = mysqli_fetch_array($res_limit_thu);
    if(mysqli_num_rows($res_limit_thu)>0){
        $set_button_thu = '<button class="btn btn-light" onclick="changeLimit(\''.$doctor_id.'\',\''.$day_thu.'\')">'.$fetch_limit_thu['patient_limit'].'</button>';
    }else{
        $set_button_thu = '<button class="btn btn-sm btn-primary" onclick="setLimit(\''.$doctor_id.'\',\''.$day_thu.'\')">Set limit</button>';
    }
    $thu.='</ul>
    '.$set_button_thu.'
    </div>
    </div>
    </div>
    ';


    $sql_fri = "SELECT * FROM `tbl_schedule_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = 'fri'";
    $res_fri = mysqli_query($conn,$sql_fri);
    $fri = '<div class="card">
    <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
    <ul class="nav" >
    <li class="nav-item border-right">
    <a class="nav-link disabled" href="#">Friday</a>
    </li>';
    while ($fetch_fri = mysqli_fetch_array($res_fri)) {
        $fri .='<li class="nav-item">
        <a href="javascript:void(0);" onclick="schedule('.$fetch_fri['id'].')" class="nav-link">'.$fetch_fri['start_time'].'-'.$fetch_fri['end_time'].'t</a>
        </li>';
    }
    $day_fri = "fri";
    $sql_fri_limit = "SELECT * FROM `tbl_day_limits_tele` WHERE `doctor_id` = '$doctor_id' AND `day` = '$day_fri'";
    $res_fri_limit = mysqli_query($conn,$sql_fri_limit);
    $fetch_fri_limit = mysqli_fetch_array($res_fri_limit);
    if(mysqli_num_rows($res_fri_limit)>0){
        $set_fri_button = '<button class="btn btn-light" onclick="changeLimit(\''.$doctor_id.'\',\''.$day_fri.'\')">'.$fetch_fri_limit['patient_limit'].'</button>';
    }else{
        $set_fri_button = '<button class="btn btn-sm btn-primary" onclick="setLimit(\''.$doctor_id.'\',\''.$day_fri.'\')">Set limit</button>';
    }
    $fri.='</ul>
    '.$set_fri_button.'
    </div>
    </div>
    </div>
    ';

    echo json_encode(['sat'=>$sat,'sun'=>$sun,'mon'=>$mon,'tue'=>$tue,'wed'=>$wed,'thu'=>$thu,'fri'=>$fri]);
}

if (isset($_POST['Schedule'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM `tbl_schedule_tele` WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
    $fetch = mysqli_fetch_array($res);
    echo json_encode($fetch);
}

if (isset($_POST['deleteSchedule'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM `tbl_schedule_tele` WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
}