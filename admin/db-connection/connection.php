<?php

$username = 'root';
$password = '';
$host = 'localhost';
$db_name = 'timesheet';

$connection = new mysqli($host, $username, $password, $db_name);

if($connection -> connect_error){
    die ('<h4>Server error! Connection failed</h4>');
}