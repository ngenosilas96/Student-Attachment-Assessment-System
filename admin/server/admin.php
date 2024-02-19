<?php
session_start();
include '../db-connection/connection.php';

        if(isset($_POST['add'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $department = $_POST['department'];

            $sql = "INSERT INTO admin (username, email, department, password) values('$username', '$email', '$department', '$password')";
            $run = mysqli_query($connection, $sql);
            if($run){
                echo '<script>window.location.assign("../admins.php")</script>';
            }
        }
        ?>