<?php
session_start();
error_reporting(0);
include 'connection.php';

if(isset($_POST['submit']) && isset($_POST['user_id'])){
    $password = $_POST['password'];
    $id = $_POST['user_id'];

    $password = stripcslashes($password);
    $id = stripcslashes($id);

    $password = mysqli_real_escape_string($connection, $password);
    $id = mysqli_real_escape_string($connection, $id);

    $decoded_id = base64_decode($id);
    
    $encryp_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE employee SET password = '$encryp_password' WHERE employee_id = '$decoded_id'";
    $run = mysqli_query($connection, $sql);

    if($run){
        $_SESSION['register-successful'] = "Password Reset successful. You can now log in...";
        echo '<script>window.location.assign("../login.php")</script>';
    }
    else{
        echo '<script>alert("Server error! If problem persists, contact the admin...")</script>';
        echo '<script>window.location.assign("../resetpass.php")</script>';
    }
}