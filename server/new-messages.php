<?php
session_start();
include 'connection.php';
$id = $_SESSION['id'];

$sql = "SELECT * FROM message WHERE message_read = 'No' AND employee_id = $id";
$run = mysqli_query($connection, $sql);
$rows = mysqli_num_rows($run);
if($rows > 0){
    echo '1';
}
else{
    echo '0';
}