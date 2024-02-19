<?php
session_start();
include 'connection.php';

if(isset($_POST['message'])){
    $message = $_POST['message'];
    $id = $_SESSION['id'];
    $select = "SELECT * FROM employee WHERE employee_id = $id";
    $run = mysqli_query($connection, $select);
    $employee = mysqli_fetch_assoc($run);

    $department = $employee['department'];
    $sql = "INSERT INTO message (employee_id, message_from, department, content, message_read, admin_read) VALUES ($id, $id, $department, '$message', 'Yes', 'No')";
    $run2 = mysqli_query($connection, $sql);
    if($run2){
        echo '1';
    }
    else{
        echo '0';
    }
}