<?php
// error_reporting(0);
include 'connection.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = stripcslashes($email);
    $password = stripcslashes($password);

    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $sql = "SELECT * FROM employee WHERE email = '$email'";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);
    $details = mysqli_fetch_assoc($run);

    $decryp_password = password_verify($password, $details['password']);

    if($rows > 0){
        if($password == $decryp_password){
            session_start();
            $_SESSION['username'] = $details['username'];
            $_SESSION['login-time'] = time();
            $_SESSION['id'] = $details['employee_id'];
            $id = $_SESSION['id'];

            if($details['last_login'] == null || date('m-d-Y', strtotime($details['last_login'])) <= date('m-d-Y')){
                $update = "UPDATE employee SET last_login = CURRENT_TIMESTAMP WHERE employee_id = $id";
                $run2 = mysqli_query($connection, $update);
                if($run2){
                    echo '<script>window.location.assign("../")</script>';
                }
            }else{
                echo '<script>window.location.assign("../")</script>';
            }
        }
        else{
            echo '<script>alert("Password Incorrect!")</script>';
            echo '<script>window.location.assign("../login.php")</script>';
        }
    }
    else{
        echo '<script>alert("Email not registered!")</script>';
        echo '<script>window.location.assign("../login.php")</script>';
    }
}