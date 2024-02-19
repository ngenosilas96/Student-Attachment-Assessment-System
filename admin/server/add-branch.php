<?php
session_start();
include '../db-connection/connection.php';

        if(isset($_POST['add'])){
            $bnumber = $_POST['branch-number'];
            $bname = $_POST['branch-name'];

            $sql = "INSERT INTO branch (branch_number, branch_name) values('$bnumber', '$bname')";
            $run = mysqli_query($connection, $sql);
            if($run){
                echo '<script>window.location.assign("../branches.php")</script>';
            }
        }
        ?>