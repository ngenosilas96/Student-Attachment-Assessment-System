<?php
session_start();
include 'connection.php';

if(isset($_POST['send']) && isset($_SESSION['id'])){
    $from_date = $_POST['from-date'];
    $to_when = $_POST['to-when'];
    $reason = $_POST['reason'];
    $employee_id = $_SESSION['id'];

    $sql = 'INSERT INTO leave_request (employee_id, from_date, to_when, reason, accepted) VALUES ("'.$employee_id.'", "'.$from_date.'", "'.$to_when.'", "'.$reason.'", "Pending")';
    $run = mysqli_query($connection, $sql);

    if($run){
        $_SESSION['request_sent'] = 'Request sent successfully!';
        echo '<script>window.location.assign("../leave.php")</script>';
    }
    else{
        echo '<script>alert("Something went wrong, try again!")</script>';
        echo '<script>window.location.assign("../leave.php")</script>';
    }

}
else{
    echo '<script>alert("something is not set")</script>';
    echo '<script>window.location.assign("../leave.php")</script>';
}