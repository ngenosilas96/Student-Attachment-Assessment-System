<?php
session_start();
include 'connection.php';

if(isset($_POST['submit']) && isset($_SESSION['id']) && $_FILES['picture']['error'] != UPLOAD_ERR_NO_FILE){
    $date = $_POST['date'];
    $timein = $_POST['timein'];
    $placeofwork = $_POST['placeOfWork'];
    $remarks = $_POST['remarks'];
    // $timeout = $_POST['timeout'];
    $employee_id = $_SESSION['id'];
    // date_default_timezone_set('Africa/Nairobi'); echo date('H:i:s');
    // $timeout = date('H;i:s');
    $imageName = $_FILES['picture']['name'];
    $imageTmpName = $_FILES['picture']['tmp_name'];

    $uniqueName = time().$imageName;
    // Specify the folder to store the images
    $uploadFolder = '../uploads/img/';

    // Move the uploaded file to the specified folder
    $uploadPath = $uploadFolder . $uniqueName;
    move_uploaded_file($imageTmpName, $uploadPath);
    $file = $_FILES["file"];

    if($file["size"] > 0){

        // Check for errors during file upload
        if ($file["error"] === 0) {
            // Read file content
            $content = file_get_contents($file["tmp_name"]);

            // Escape special characters in the content
            $content = $connection->real_escape_string($content);

            $sql = 'INSERT INTO report (employee_id, date, time_in, place_of_work, remarks, picture, file) VALUES ("'.$employee_id.'", "'.$date.'", "'.$timein.'", "'.$placeofwork.'", "'.$remarks.'", "'.$uniqueName.'", "'.$content.'")';
            $run = mysqli_query($connection, $sql);

            if($run){
                $_SESSION['report-uploaded'] = 'Report successfully submitted!';
                echo '<script>window.location.assign("../index.php")</script>';
            }
            else{
                echo '<h4>Error happened</h4>';
            }
        }
    }
    else{
        $sql = 'INSERT INTO report (employee_id, date, time_in, place_of_work, remarks, picture) VALUES ("'.$employee_id.'", "'.$date.'", "'.$timein.'", "'.$placeofwork.'", "'.$remarks.'", "'.$uniqueName.'")';
        $run = mysqli_query($connection, $sql);

        if($run){
            $_SESSION['report-uploaded'] = 'Report successfully submitted!';
            echo '<script>window.location.assign("../index.php")</script>';
        }
        else{
            echo '<h4>Error happened</h4>';
        }
    }
}
else if(isset($_POST['submit']) && isset($_SESSION['id']) && $_FILES['picture']['error'] == UPLOAD_ERR_NO_FILE){
    $date = $_POST['date'];
    $timein = $_POST['timein'];
    $placeofwork = $_POST['placeOfWork'];
    $remarks = $_POST['remarks'];
    // $timeout = $_POST['timeout'];
    $employee_id = $_SESSION['id'];
    $file = $_FILES["file"];

    if($file["size"] > 0){

        // Check for errors during file upload
        if ($file["error"] === 0) {
            // Read file content
            $content = file_get_contents($file["tmp_name"]);

            // Escape special characters in the content
            $content = $connection->real_escape_string($content);

            $sql = 'INSERT INTO report (employee_id, date, time_in, place_of_work, remarks, picture, file) VALUES ("'.$employee_id.'", "'.$date.'", "'.$timein.'", "'.$placeofwork.'", "'.$remarks.'", "", "'.$content.'")';
            $run = mysqli_query($connection, $sql);

            if($run){
                $_SESSION['report-uploaded'] = 'Report successfully submitted!';
                echo '<script>window.location.assign("../index.php")</script>';
            }
            else{
                echo '<h4>Error happened</h4>';
            }
        }
    }
    else{
        $sql = 'INSERT INTO report (employee_id, date, time_in, place_of_work, remarks, picture) VALUES ("'.$employee_id.'", "'.$date.'", "'.$timein.'", "'.$placeofwork.'", "'.$remarks.'", "")';
        $run = mysqli_query($connection, $sql);

        if($run){
            $_SESSION['report-uploaded'] = 'Report successfully submitted!';
            echo '<script>window.location.assign("../index.php")</script>';
        }
        else{
            echo '<h4>Error happened</h4>';
        }
    }
}
else{
    echo 'something is not set';
}