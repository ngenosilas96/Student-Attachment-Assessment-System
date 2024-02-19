<?php
session_start();
include '../db-connection/connection.php';

$request_id = $_POST['id'];
$sql = "UPDATE leave_request SET accepted = 'No' WHERE id = $request_id";
$run = mysqli_query($connection, $sql);
if($run){
    echo '1';
}
else{
    echo '2';
}