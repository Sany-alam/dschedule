<?php
// database connection
include("../../connection.php");
session_start();

if (isset($_POST['Showing'])) {
    $id = $_SESSION['doctor']['id'];
    $query = "SELECT * FROM `tbl_doctor` WHERE `id` = '$id'";
    $result = mysqli_query($conn,$query);
    $fetch = mysqli_fetch_assoc($result);
    echo json_encode($fetch);
}

if (isset($_POST['Adding'])) {
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $id = $_SESSION['doctor']['id'];
    $query = "UPDATE `tbl_doctor` SET `name`= '$name',`details`= '$detail',`email`= '$email',`msisdn`= '$phone' WHERE `id` = '$id'";
    $result = mysqli_query($conn,$query);
    if($result){
        echo "Successfully updated";
    }else{
        echo "Something went wrong";
    }
}


if (isset($_POST['ChangingPassword'])) {
    $confirm = $_POST['confirm'];
    $new = $_POST['new'];
    $old = $_POST['old'];
    $id = $_SESSION['doctor']['id'];

    $query = "SELECT * FROM `tbl_doctor` WHERE `id` = '$id'";
    $result = mysqli_query($conn,$query);
    $fetch = mysqli_fetch_assoc($result);


    if ($old != $fetch['password']) {
        echo "notmatched";
    }elseif($confirm != $new){
        echo "notmatched";
    }else{
        $query = "UPDATE `tbl_doctor` SET `password`= '$new' WHERE `id` = '$id'";
        $result = mysqli_query($conn,$query);
        echo "done";
    }
}




if (isset($_POST['UploadImage'])){
    $id = $_SESSION['doctor']['id'];
    $first_sql = "SELECT * FROM `tbl_doctor` WHERE `id` = '$id'";
    $first_result = mysqli_query($conn,$first_sql);
    $first_fetch = mysqli_fetch_array($first_result);

    if ($first_fetch['image']) {
        unlink('../'.$first_fetch['image']);
    }

    move_uploaded_file($_FILES['img']['tmp_name'],"../images/".$_FILES['img']['name']);
    $img = "images/".$_FILES['img']['name'];

    $second_sql = "UPDATE `tbl_doctor` SET `image`= '$img' WHERE `id` = '$id'";
    $second_result = mysqli_query($conn,$second_sql);

    $_SESSION['doctor']['image'] = $img;
}