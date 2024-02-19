<?php
$host="localhost";
$username="root";
$password='';
$db="timesheet";

$connection= mysqli_connect($host,$username,$password,$db);
if(!$connection){
    echo "<h6> connection failed </h6>";
}
?>