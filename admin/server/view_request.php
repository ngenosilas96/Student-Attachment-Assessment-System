<?php
session_start();
include '../db-connection/connection.php';

$request_id = $_POST['id'];
$sql = "SELECT * FROM leave_request WHERE id = $request_id";
$run = mysqli_query($connection, $sql);
$details = mysqli_fetch_assoc($run);

$id = $details['employee_id'];
$sql2 = "SELECT * FROM employee WHERE employee_id = $id";
$run2 = mysqli_query($connection, $sql2);
$details2 = mysqli_fetch_assoc($run2);

$from = date('d-m-Y', strtotime($details['from_date']));
$to = date('d-m-Y', strtotime($details['to_when']));
$employee = $details2['fname'].' '.$details2['lname'];
$department = $details2['department'];
$reason = $details['reason'];
$data = array(
    'employee_fname' => "$employee",
    'department' => "$department",
    'from' => "$from",
    'to' => "$to",
    'reason' => "$reason"
);
echo json_encode($data);