<?php
include '../db-connection/connection.php';

if(!empty($_POST['id'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM department WHERE id = '$id'";
    $run = mysqli_query($connection, $sql);
    if($run){
        echo '1';
    }
}