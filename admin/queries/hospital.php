<?php 
// database connection
include("../../connection.php");
session_start();

if (isset($_POST['AddingHospital'])) {
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $password = "123456";
    $sql = "INSERT INTO `tbl_hospital`(`name`, `details`) VALUES ('$name','$detail')";
    $res = mysqli_query($conn,$sql);
}

if (isset($_POST['Show'])) {
    $query = "SELECT * FROM `tbl_hospital`";
    $result = mysqli_query($conn,$query);
    $table = '<table class="table table-hover e-commerce-table">
                <thead >
                    <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody >';
    while ($row=mysqli_fetch_array($result)) {
        $table .='
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['details'].'</td>
                <td>
                    <button class="btn btn-info" onclick="edit('.$row['id'].')">Edit</button>
                </td>
                <td>
                    <button class="btn btn-danger" onclick="del('.$row['id'].')">Delete</button>
                </td>
            </tr>';
    }
    $table .='</tbody>
            </table>
            <script src="assets/vendors/datatables/jquery.dataTables.min.js"></script>
            <script src="assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
            <script src="assets/vendors/datatables/e-commerce-order-list.js"></script>';
    echo $table;
}


if (isset($_POST['DeleteHospital'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM `tbl_hospital` WHERE `id` = '$id'";
    $result = mysqli_query($conn,$query);
}

if (isset($_POST['EditHospital'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM `tbl_hospital` WHERE id = '$id'";
    $result = mysqli_query($conn,$query);
    $item = mysqli_fetch_array($result);
    echo json_encode($item);
}

if (isset($_POST['UpdateHospital'])) {
    $id = $_POST['id'];
    $hospital = $_POST['hospital'];
    $detail = $_POST['detail'];
    $query = "UPDATE `tbl_hospital` SET `name`='$hospital',`details`='$detail' WHERE `id` = '$id'";
    $result = mysqli_query($conn,$query);
}

?>