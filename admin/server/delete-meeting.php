<?php
session_start();
include '../db-connection/connection.php';

if(isset($_POST['meeting_id'])){
    $m_id = $_POST['meeting_id'];

    $sql = "DELETE FROM meetings WHERE id = $m_id";
    $run = mysqli_query($connection, $sql);
    if($run){
        echo '1';
    }
    else{
        echo '0';
    }
}