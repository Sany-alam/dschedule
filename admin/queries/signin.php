<?php 
// database connection
include("../../connection.php");
session_start();

if (isset($_POST['signin'])) {
    $email = $_POST['userName'];
    $password = $_POST['password'];
    if ($email === "admin" && $password === "password") {
        $_SESSION['admin'] = ['username'=>'admin','password'=>'password'];
    }
    else{
        echo "Invalid Credentials";
    }
}