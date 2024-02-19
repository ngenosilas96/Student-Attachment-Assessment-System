<?php
session_start();
require 'db-connection/connection.php';

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password= $_POST['password'];

    $email = stripcslashes($email);
    $password = stripcslashes($password);

    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);

    if($rows < 1){
        echo '<script>alert("No such account or email/password may be wrong!");</script>';
        echo '<script>window.location.assign("../admin")</script>';
    }
    else{
        $details = mysqli_fetch_assoc($run);
        $_SESSION['admin-username'] = $details['username'];
        $_SESSION['admin-id'] = $details['id'];
        $_SESSION['department'] = $details['department'];
        $_SESSION['admin-login-time'] = time();
        echo '<script>window.location.assign("../admin")</script>';
    }
}