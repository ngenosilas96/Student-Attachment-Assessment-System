<?php
session_start();
include '../db-connection/connection.php';

$report_id = $_POST['task_id'];

$sql = "UPDATE report SET approve = 1 WHERE report_id = $report_id";
$run = mysqli_query($connection, $sql);
if($run){
    echo '1';
}
else{
    echo '0';
}