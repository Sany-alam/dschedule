<?php 
// database connection
include("../../connection.php");
session_start();

if (isset($_POST['AddingDoctor'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msisdn = $_POST['msisdn'];
    $specialty = $_POST['specialty'];
    $detail = $_POST['detail'];
    // function random_strings($length_of_string){
    //     $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    //     return substr(str_shuffle($str_result),0, $length_of_string);
    // }
    // $password = crypt(random_strings(5));
    $password = "123456";
    $a = "SELECT * FROM `tbl_doctor` WHERE `email` = '$email'";
    $a_res = mysqli_query($conn,$a);
    $a_fetch = mysqli_fetch_array($a_res);
    if (mysqli_num_rows($a_res)>0) {
        echo "Email must be unique";
    }
    else {
        $query = "INSERT INTO `tbl_doctor`(`name`, `email`, `password`, `msisdn`, `details`, `specialty_id`) VALUES ('$name','$email','$password','$msisdn','$detail','$specialty')";
        $confirm = mysqli_query($conn,$query);
    }
}



if (isset($_POST['ShowSpecialty'])) {
    $query = "SELECT * FROM tbl_specialty";
    $result = mysqli_query($conn,$query);
    $options = "<option value='' selected='true'>Doctor's specialty</option>";
    while ($row=mysqli_fetch_array($result)) {
        $options .= "<option value='".$row['id']."' selected='true'>".$row['name']."</option>";
    }
    echo $options;
}

if (isset($_POST['Show'])) {
    $query = "SELECT * FROM tbl_doctor";
    $result = mysqli_query($conn,$query);
    $table = '<table class="table table-hover e-commerce-table">
                <thead >
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Speciality</th>
                        <th>Activity</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody >';
    while ($row=mysqli_fetch_array($result)) {
        $ms_id = $row['specialty_id'];
        $sp_query = "SELECT * FROM tbl_specialty WHERE `id` = '$ms_id'";
        $sp_res = mysqli_query($conn,$sp_query);
        $sp_fetch = mysqli_fetch_assoc($sp_res);
        if ($row['image']) {
            $img = "../".$row['image'];
        }
        else {
            $img = "assets/images/avatars/Deafult-Profile-Pitcher.png";
        }
        $table .='
            <tr>
                <td>
                    <img class="avatar avatar-rounded" src="'.$img.'"/>
                </td>
                <td>'.$row['name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['msisdn'].'</td>
                <td>'.$sp_fetch['name'].'</td>
                <td>
                <label class="switch">
                    <input type="checkbox" id="status'.$row['id'].'">
                    <span class="slider round"></span>
                </label>
                </td>
                <td>
                    <button class="btn btn-danger" onclick="del('.$row['id'].')">Delete</button>
                </td>
            </tr>
            <script>
            if('.$row['status'].' == "0"){$("#status'.$row['id'].'").prop("checked",false)}else{$("#status'.$row['id'].'").prop("checked",true)}

            $("#status'.$row['id'].'").change(function(){
                if ($("#status'.$row['id'].'").is(":checked")){
                    status = 1;
                }
                else{
                    status = 0;
                }
                var formData= new FormData();
                formData.append("status",status);
                formData.append("id",'.$row['id'].');
                formData.append("ChangingStatus","ChangingStatus");
                $.ajax({
                    processData: false,
                    contentType: false,
                    url:"queries/doctor-query.php",
                    type:"POST",
                    data:formData,
                    success:function(data,status){
                        if(data == "done"){
                            showing();
                        }else{
                            alert(data);
                            console.log(data);
                        }
                    },
                });
            });
            </script>';
    }
    $table .='</tbody>
            </table>
            <script src="assets/vendors/datatables/jquery.dataTables.min.js"></script>
            <script src="assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
            <script src="assets/vendors/datatables/e-commerce-order-list.js"></script>';
    echo $table;
}


if (isset($_POST['DeleteDoctor'])) {
    $id = $_POST['id'];

    $first_sql = "SELECT * FROM `tbl_doctor` WHERE `id` = '$id'";
    $first_result = mysqli_query($conn,$first_sql);
    $first_fetch = mysqli_fetch_array($first_result);
    if ($first_fetch['image']) {
        unlink('../../'.$first_fetch['image']);
    }

    $query = "DELETE FROM `tbl_doctor` WHERE `id` = '$id'";
    $result = mysqli_query($conn,$query);
}


if (isset($_POST['ChangingStatus'])) {
    $status = $_POST['status'];
    $id = $_POST['id'];
    $sql = "UPDATE `tbl_doctor` SET `status`= '$status' WHERE `id` = '$id'";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        echo "done";
    }
    else{
        var_dump($result);
    }
}

?>