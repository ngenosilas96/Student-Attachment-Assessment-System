<?php
session_start();
include '../db-connection/connection.php';


$dept = $_SESSION['department'];
$update = "UPDATE message set admin_read = 'Yes' WHERE department = $dept AND admin_read = 'No'";
$run = mysqli_query($connection, $update);
if($run){
    echo '1';
}
else{
    echo '0';
}