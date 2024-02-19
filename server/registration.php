<?php 
error_reporting(0);
session_start();
require "../admin/db-connection/connection.php";

if(isset($_POST["signup"])){
    $username = $_POST["username"];
    $Fname = $_POST["Fname"];
    $Lname = $_POST["Lname"];
    $email = $_POST["email"];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $password = $_POST["password"];

    $username = stripcslashes($username);
    $Fname = stripcslashes($Fname);
    $Lname = stripcslashes($Lname);
    $email = stripcslashes($email);
    $phone = stripcslashes($phone);
    $department = stripcslashes($department);
    $password = stripcslashes($password);

    $email = mysqli_real_escape_string($connection, $email);
    $Fname = mysqli_real_escape_string($connection, $Fname);
    $Lname = mysqli_real_escape_string($connection, $Lname);
    $username = mysqli_real_escape_string($connection, $username);
    $phone = mysqli_real_escape_string($connection, $phone);
    $department = mysqli_real_escape_string($connection, $department);
    $password = mysqli_real_escape_string($connection, $password);

    $select = "SELECT * FROM employee where email='$email'";
    $run = mysqli_query($connection, $select);
    $rows = mysqli_num_rows($run);

    if($rows > 0){
        echo '<script>
        alert("That email is already registered!");
        window.location.assign("../signup.php")
        </script>';

    }
    else{
        $encryp_password = password_hash($password, PASSWORD_DEFAULT);
        $sql="INSERT INTO employee (username, Fname, Lname, email, approval, under_leave, phone, department, password) values('$username','$Fname','$Lname','$email', 'Not Approved', 'No','$phone', '$department', '$encryp_password')";
        $run =mysqli_query ($connection, $sql);
        if($run){
            $_SESSION['register-successful'] = "Registration successful. Now log in...";
            echo '<script>
            window.location.assign("../login.php")
            </script>';
        }
    }
}
?>
