<?php
include 'connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if(!empty($_POST['email']) && isset($_POST['email'])){
    $email = htmlentities($_POST['email']);

    $sql = "SELECT * FROM employee WHERE email = '$email'";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);

    if($rows <= 0){
        echo '<h4>No such email registered!</h4>';
    }
    else{
        $fetch = mysqli_fetch_assoc($run);
        $name = $fetch['fname'].' '.$fetch['lname'];
        $email = $fetch['email'];
        $id = $fetch['employee_id'];
        $encode_id = base64_encode($id);
        $current_year = date('Y');

        $email_body = '<html>
        <h4>Password Reset<br>Do not let anyone else access this email.</h4>
        <p>Dear '.$name.', to reset your login password, click the link below:<br></p>
        <a href="http://192.168.100.13/TimeSheet/resetpass.php?id='.$encode_id.'">Reset password link<a/><br><br>
        <p>If this is not you, ignore.<br>#Thank you for using our platform</p>
        <p><strong>&copy; '.$current_year.' University of Embu</strong></p>
        </html>';

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '';
        $mail->Password = '';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->isHTML(true);
        $mail->setFrom('', 'University of Embu');
        $mail->addAddress($email);
        $mail->Subject = ("University of Embu (Reset password)");
        $mail->Body = $email_body;
        $mail->send();

        if($mail->send()){
            echo '1';
        }
        else{
            echo '0';
        }
    }
}
