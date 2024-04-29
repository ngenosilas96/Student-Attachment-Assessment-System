<?php
session_start();
include '../db-connection/connection.php';

if(isset($_POST['save'])){
    extract($_POST);
    $user_id = $_SESSION['admin-id'];
    $department = $_SESSION['department'];
    $sql = "INSERT INTO meetings (user_id, department, date, time, link, note) values ($user_id, '$department', '$date', '$time', '$link', '$note')";
    $run = mysqli_query($connection, $sql);
    echo '<script>window.location.assign("../captures.php")</script>';
}