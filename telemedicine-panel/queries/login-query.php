<?php 

// database connection
include("../../connection.php");
session_start();

if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `tbl_doctor_tele` WHERE `email` = '$email' AND `password` = '$password'";
    $res = mysqli_query($conn,$sql);
    $fetch = mysqli_fetch_assoc($res);
    if (mysqli_num_rows($res)>0) {
        if ($fetch['status'] == 0) {
            echo "inactive";
        }else{
            echo "ok";
            $_SESSION['doctor'] = $fetch;
        }
    }
    else{
        echo "not ok";
    }
}

// login page end

?>