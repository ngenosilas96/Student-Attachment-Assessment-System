<?php
session_start();
include '../db-connection/connection.php';

        if(isset($_POST['add'])){
            $bnumber = $_POST['department-number'];
            $bname = $_POST['department-name'];

            $sql = "INSERT INTO department (department_number, department_name) values('$bnumber', '$bname')";
            $run = mysqli_query($connection, $sql);
            if($run){
                echo '<script>window.location.assign("../department.php")</script>';
            }
        }
        ?>