<?php
include '../db-connection/connection.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];

    $sql = "UPDATE employee SET under_leave = 'No' WHERE employee_id = '$id'";
    $run = mysqli_query($connection, $sql);

    if($run){
        echo '1';
    }
}
?>