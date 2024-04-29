<?php
session_start();
include '../db-connection/connection.php';

$report_id = $_POST['task_id'];

$sql = "SELECT * FROM report where report_id = $report_id";
$run = mysqli_query($connection, $sql);
$details = mysqli_fetch_assoc($run);

if($details['picture'] != null || $details['picture'] != ''){
    unlink('../../uploads/img/'.$details['picture']);
}

$sql2 = "DELETE FROM report where report_id = $report_id";
$run2 = mysqli_query($connection, $sql2);
if($run2){
    echo '1';
}
else{
    echo '2';
}