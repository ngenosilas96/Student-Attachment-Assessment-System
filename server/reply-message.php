<?php
session_start();
include 'connection.php';

if (isset($_POST['admin_id']) && isset($_POST['parent_id']) && isset($_POST['message'])) {
    $message = $_POST['message'];
    $id = $_SESSION['id'];
    $admin_id = $_POST['admin_id'];
    $parent_id = $_POST['parent_id'];

    $select = "SELECT * FROM employee WHERE employee_id = $id";
    $run = mysqli_query($connection, $select);
    $employee = mysqli_fetch_assoc($run);
    $department = $employee['department'];

    $insert = "INSERT INTO message(employee_id, admin_id, message_from, message_to, parent_message_id, department, content, message_read, admin_read) VALUES($id, $admin_id, $id, $admin_id, $parent_id, $department, '$message', 'Yes', 'No')";
    $run2 = mysqli_query($connection, $insert);

    if ($run2) {
        echo '1';
    } else {
        echo '0';
    }
}