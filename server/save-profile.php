<?php
session_start();
include 'connection.php';

if(isset($_POST['submit']) && isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $username = $_POST["username"];
    $fname = $_POST["Fname"];
    $lname = $_POST["Lname"];
    $email = $_POST["email"];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $password = $_POST["password"];

    if($password == ''){
        $sql = "UPDATE employee SET username = '$username', fname = '$fname', lname = '$lname', email = '$email', phone = '$phone', department = '$department' WHERE employee_id = '$id'";
        $run = mysqli_query($connection, $sql);
        if($run){
            echo '<script>window.location.assign("../profile.php")</script>';
        }
    }
    else{
        $encryp_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE employee SET username = '$username', fname = '$fname', lname = '$lname', email = '$email', phone = '$phone', department = '$department', password = '$encryp_password' WHERE employee_id = '$id'";
        $run = mysqli_query($connection, $sql);
        if($run){
            echo '<script>window.location.assign("../profile.php")</script>';
        }
    }
}
?>