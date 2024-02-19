<?php
include '../db-connection/connection.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sql1 = "SELECT * FROM report WHERE employee_id = '$id'";
    $run1 = mysqli_query($connection, $sql1);
    $rows = mysqli_num_rows($run1);

    if($rows > 0){
        $sql = "DELETE FROM report where employee_id = '$id'";
        $run = mysqli_query($connection, $sql);

        if($run){
            $sql = "DELETE FROM employee  WHERE employee_id = '$id'";
            $run = mysqli_query($connection, $sql);

            if($run){
                echo '1';
            }
        }
    }
    else{
        $sql = "DELETE FROM employee  WHERE employee_id = '$id'";
        $run = mysqli_query($connection, $sql);

        if($run){
            echo '1';
        }
    }
}
?>