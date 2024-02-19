<?php
session_start();
include '../db-connection/connection.php';

if(isset($_POST['employee_id']) && isset($_POST['parent_id']) && isset($_POST['message'])){
    $message = $_POST['message'];
    $employee_id = $_POST['employee_id'];
    $admin_id = $_SESSION['admin-id'];
    $parent_id = $_POST['parent_id'];

    $select = "SELECT * FROM employee WHERE employee_id = $employee_id";
    $run = mysqli_query($connection, $select);
    $employee = mysqli_fetch_assoc($run);
    $department = $_SESSION['department'];

    $insert = "INSERT INTO message(employee_id, admin_id, message_from, message_to, parent_message_id, department, content, message_read, admin_read) VALUES($employee_id, $admin_id, $admin_id, $employee_id, $parent_id, $department, '$message', 'No', 'Yes')";
    $run2 = mysqli_query($connection, $insert);
    if($run2){
        echo '1';
    }
    else{
        echo '0';
    }
}