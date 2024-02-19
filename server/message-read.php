<?php
session_start();
include 'connection.php';

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];

    $update = "UPDATE message set message_read = 'Yes' WHERE employee_id = $id AND message_read = 'No'";
    $run = mysqli_query($connection, $update);
    if($run){
        echo '1';
    }
    else{
        echo '0';
    }
}