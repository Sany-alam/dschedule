<?php 
// database connection
include("../../connection.php");
session_start();

if (isset($_POST['AddingSpecialty'])) {
    $specialty = $_POST['specialty'];

    $query = "SELECT * FROM `tbl_specialty_tele` WHERE name = `$specialty`";
    $confirm = mysqli_query($conn,$query);
    if ($confirm) {
        echo json_encode($confirm);
    }
    else{
        $query = "INSERT INTO `tbl_specialty_tele`(`name`) VALUES ('$specialty')";
        $confirm = mysqli_query($conn,$query);
        if ($confirm) {
            echo "Added";
        }else{
            var_dump($confirm);
        }
    }
}



if (isset($_POST['ShowSpecialty'])) {
    $query = "SELECT * FROM tbl_specialty_tele";
    $result = mysqli_query($conn,$query);
    $table = '<table class="table table-hover e-commerce-table">
                <thead >
                    <tr>
                        <th>Speciality</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody >';
    while ($row=mysqli_fetch_array($result)) {
        $table .= '
            <tr>
                <td>'.$row['name'].'</td>
                <td>
                    <button class="btn btn-info" onclick="edit('.$row['id'].')">Edit</button>
                </td>
                <td>
                    <button class="btn btn-danger" onclick="del('.$row['id'].')">Delete</button>
                </td>
            </tr>
            ';
    }
    $table .='</tbody>
            </table>
            <script src="assets/vendors/datatables/jquery.dataTables.min.js"></script>
            <script src="assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
            <script src="assets/vendors/datatables/e-commerce-order-list.js"></script>';
    echo $table;
}


if (isset($_POST['EditSpecialty'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM tbl_specialty_tele WHERE id = '$id'";
    $result = mysqli_query($conn,$query);
    $item = mysqli_fetch_array($result);
    echo json_encode($item);
}

if (isset($_POST['DeleteSpecialty'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM `tbl_specialty_tele` WHERE `id` = '$id'";
    $result = mysqli_query($conn,$query);
}

if (isset($_POST['UpdateSpecialty'])) {
    $id = $_POST['id'];
    $specialty = $_POST['specialty'];
    $query = "UPDATE `tbl_specialty_tele` SET `name`='$specialty' WHERE `id` = '$id'";
    $result = mysqli_query($conn,$query);
}
?>