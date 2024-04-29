<!DOCTYPE html>
<?php session_start(); include 'server/connection.php' ?>
<html>
<head>
    <title>Intern Hub</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logos.png">
    <link rel="stylesheet" href="employee.css">
    <link rel="stylesheet" href="admin/libraries/css/bootstrap.min.css">
    <link rel="stylesheet" href="./admin/libraries/fontawesome/css/all.css">
    <script src="./admin/libraries/jquery-3.6.0.min.js"></script>
    <script src="./admin/libraries/tinymce/tinymce.min.js"></script>
<?php
if(isset($_SESSION['username']) && (time() - $_SESSION['login-time']) <= 36000){
?>
    <div class="navbar px-3 pt-3">
        <?php include 'header.php';?>
    </div><?php } else{ echo '<script>window.location.assign("login.php")</script>';}?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Signika+Negative:wght@500&display=swap');
        *{
            font-family: 'Signika Negative', sans-serif;
        }
        
        .navbar{
            background: rgb(0, 0, 69);
            display: flex;
            flex-direction: row;
            align-items: baseline;
            justify-content: space-between;
            height: fit-content;
        }
        .navbar .brand a{
            font-size: 20px;
            font-weight: 500;
        }
        .navbar a{
            text-decoration: none;
            color: #f2f2f2;
        }
        #outer{
            width: 95%;
            margin-left: 50%;
            transform: translateX(-50%);
            margin-top: 25px;
            height: 85%;
            position: fixed;
            background: #f5f5f5;
            border-radius: 5px;
            border: 1px solid #ececec;
            overflow-y: scroll;
            overflow-x: hidden;
        }
        #outer h4{
            width: 95%;
            border-bottom: 1px solid #d1d1d1;
            margin: 20px;
            padding-bottom: 7px;
        }
        #tasks{
            width: 80%;
            margin-left: 50%;
            transform: translateX(-50%);
        }
        #tasks > #row{
            width: 100%;
            display: flex;
            flex-direction: row;
            background: #fff;
            border: 1px solid #f3f3f3;
            box-shadow: 0 0 5px #c3c3c3;
            margin-bottom: 15px;
            padding: 7px;
            border-radius: 4px;
            height: 55px;
            overflow: hidden;
            transition: .3 ease-in-out;
            overflow-x: auto;
        }
        #tasks > #row #picture img{
            width: 80%;
            height: auto;
        }
        #tasks > #row > #remarks{
            width: 70%;
        }
        /* #tasks > #row > #remarks p::after{
            content: "...";
        } */
        #tasks > #row >div p{
            line-height: 40px;
        }
        #tasks > #row #name button:focus{
            box-shadow: none;
            border-width: 0;
        }
        #tasks > #row >div:nth-child(1), #tasks > #row> div:nth-child(2), #tasks > #row> div:nth-child(3), #tasks > #row> div:nth-child(4){
            width: 20%;
        }
        #tasks > button{
            background: rgb(0, 0, 69);
            color: #fff;
        }
        #name button > .fa-minus{
            display: none;
        }
        .note{
            background: #ffebc6;
            padding: 10px;
            border-left: 5px solid #ffc558;
            width: fit-content;
            height: 45px;
            display: flex;
            justify-content: center;
            border-radius: 0 4px 4px 0;
        }
        .note p{
            display: flex;
            justify-content: center;
        }
        #floating-message-icon{
            position: fixed;
            background: #6fc3ff;
            color: #fff;
            bottom: 60px;
            right: 60px;
            width: 50px;
            height: 50px;
            box-shadow: 0 0 8px rgba(0, 0, 0, .5);
            font-size: 26px;
            border-radius: 50%;
        }
        #floating-message{
            position: fixed;
            box-shadow: 0 0 8px rgba(0, 0, 0, .3);
            background: #fff;
            color: #000;
            bottom: 150px;
            right: 60px;
            width: 330px;
            height: 370px;
            background: #6fc3ff;
            padding: 15px;
            border-radius: 10px;
            display: none;
        }
        #floating-message form textarea{
            background: #fff;
            border-radius: 7px;
            resize: none;
        }
        #floating-message form #send-message{
            background: #fff;
            color: #6fc3ff;
            width: 100%;
            border-radius: 50px;
        }

        /*Responsiveness*/
        @media only screen and (max-width: 900px){
            .navbar a{
                font-size: 25px;
            }
            .navbar #options a{
                font-size: 18px;
            }
            #tasks{
                width: 97%;
            }
            #outer h4{
                font-size: 30px;
            }
            #tasks > #row >div:nth-child(1), #tasks > #row> div:nth-child(2), #tasks > #row> div:nth-child(3), #tasks > #row> div:nth-child(4){
                width: 25%;
            }
            #tasks > #row >div, #tasks > button{
                font-size: 20px;
            }
            #floating-message-icon{
                bottom: 70px;
                right: 40px;
                width: 60px;
                height: 60px;
                font-size: 32px;
            }
            #floating-message{
                width: 370px;
            }
        }

        @media only screen and (max-width: 500px){
            .navbar a{
                font-size: 15px !important;
            }
            #tasks{
                width: 97%;
            }
            #tasks > #row #picture img{
                width: 100%;
                height: auto;
            }
            #outer h4{
                font-size: 20px;
            }
            #tasks > #row >div:nth-child(1), #tasks > #row> div:nth-child(2), #tasks > #row> div:nth-child(3), #tasks > #row> div:nth-child(4){
                width: 25%;
            }
            #tasks > #row >div, #tasks > button{
                font-size: 15px;
            }
            #floating-message-icon{
                bottom: 60px;
                right: 20px;
                width: 60px;
                height: 60px;
                font-size: 32px;
            }
            #floating-message{
                width: 350px;
                right: 30px;
            }
        }

        .indicator{
            position: absolute;
            right: 10px;
            width: 60px !important;
            top: 0px;
            padding: 2px 5px;
            font-size: 12px
        }

    </style>
</head>
<?php
//fetching employee's tasks
function employee_tasks(){
    global $connection;
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM report WHERE employee_id = '$id' order by time_uploaded ASC";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);
        if($rows > 0){
            while($details = mysqli_fetch_assoc($run)){?>

            <div id="row" style="position: relative;">
                <?php
                if($details['approve'] == '0'){?>
                    <p class="rounded-pill text-center text-light bg-danger indicator">Declined</p>
                <?php
                }
                else if($details['approve'] == '1'){?>
                    <p class="rounded-pill text-center text-light bg-success indicator">Approved</p>
                <?php
                }
                ?>
                <div id="name"><p><button class="btn btn-sm mb-1"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-minus"></i></button><?php echo $details['date']?></p></div>
                <div class="working" id="working-hours"><p>From: <?php echo $details['time_in']?></p></div>
                <div class="working" id="working-hours"><p>To: <?php echo $details['timeout']?></p></div>
                <div id="placeofwork" style="margin-right: 70px;"><p><?php echo $details['place_of_work']?></p></div><br>
                <div id="remarks"><?php echo $details['remarks']?>
                    <?php
                    if($details['picture'] != null){
                    ?>
                    <p id="picture">
                        <img src="<?php echo 'uploads/img/'.$details['picture']?>" alt="picture">
                    </p>
                    <?php 
                    }
                    else{?>
                    <p>No image</p>
                    <?php }?>
                    <p id="download-link">
                        <?php if (!empty($details['file'])) : ?>
                            <a href="data:application/octet-stream;base64,<?php echo base64_encode($details['file']); ?>" download=<?php echo date('d-m-Y', strtotime($details['date'])).".pdf"?>>Download File attached</a>
                        <?php else : ?>
                            <p>No file attached</p>
                        <?php endif; ?>
                    </p>
                    <p><button class="btn btn-sm btn-danger delete-task" value="<?php echo $details['report_id']?>">Delete Task</button></p>
                </div>
            </div>
            <?php
            }
        }
        else{?>
            <div id="row">No task...</div>
      <?php }
      }
?>
<body>
    <div id="outer">
        <h4>Your Reports</h4>
        <div id="tasks">

            <!--submit notification-->
        <?php
        if (isset($_SESSION['report-uploaded'])) { ?>
            <div class="alert alert-success my-2" style="height: fit-content;" role="alert">
                <strong>
                    <?php echo $_SESSION['report-uploaded']; ?>
                </strong>
            </div>
            <?php
            unset($_SESSION['report-uploaded']);
        } 

            //checking if an employee is approved
            $id = $_SESSION['id'];
            $sql = "SELECT approval FROM employee WHERE employee_id = '$id'";
            $run = mysqli_query($connection, $sql);
            $details = mysqli_fetch_assoc($run);

            //checking if an employee is on leave
            $sql3 = "SELECT under_leave FROM employee WHERE employee_id = '$id'";
            $run3 = mysqli_query($connection, $sql3);
            $details2 = mysqli_fetch_assoc($run3);

            //checking if submission was done today
            $sql2 = "SELECT report_id FROM report WHERE employee_id = $id AND date = CURDATE()";
            $run2 = mysqli_query($connection, $sql2);
            $report_rows = mysqli_num_rows($run2);

            if($details['approval'] == 'Not Approved'){?>
                <div class="note mb-2"><p>The button below will be activated after you are approved.</p></div><button disabled class="btn mb-3">New Report</button>
            <?php }
            else if($details2['under_leave'] == 'Yes'){?>
                <div class="note mb-2"><p>You are current on Leave.</p></div><button disabled class="btn mb-3">New Report</button>
           <?php }
           else if($report_rows > 0){?>
                <div class="note mb-2" style="border-left: 5px solid #ff6d6d; background: #ffd0d0;"><p>No more submission is allowed today. Wait until tomorrow...</p></div><button disabled class="btn mb-3">New Report</button>
         <?php  }
         else{?>
            <button class="btn mb-3">New Report</button>
            <?php
         }
            ?>
            <?php employee_tasks();?>
        </div>
    </div>
</body>
<button id="floating-message-icon" class="btn text-center" title="Send a message to your department"><i class="fa-regular fa-comment"></i></button>
<div id="floating-message">
    <form>
        <h5 class="text-light">New Message</h5>
        <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
        <button class="btn btn-sm my-2" id="send-message"><i class="fa-regular fa-paper-plane"></i></button>
    </form>
</div>
<script>
    //expanding Tasks rows
    $(window).ready(function(){
        $(document).on('click', '#name button', function(){
            if($(this).closest('#row').height() <= 55){
                $(this).closest('#row').css('height', 'fit-content');
                $(this).children('.fa-plus').hide();
                $(this).children('.fa-minus').show();

            }
            else{
                $(this).closest('#row').css('height', '55px');
                $(this).children('.fa-plus').show();
                $(this).children('.fa-minus').hide();
            }
        })

        //toggling send messages
        $('#floating-message-icon').on('click', function(){
            $('#floating-message').toggle();
        })

        $('#floating-message #send-message').on('click', function(e){
            e.preventDefault();
            if($('#floating-message #message').val() != ''){
                var message = $('#floating-message #message').val();
                $.ajax({
                    type: "post",
                    url: "server/send-message.php",
                    data: {message: message},
                    dataType: "text",
                    success: function (response) {
                        if(response == '1'){
                            alert('Message sent successfully!');
                            $('#floating-message').hide();
                        }
                        else if(response == '0'){
                            alert('Failed. Something went wrong!');
                            $('#floating-message').hide();
                        }
                    },
                    error: function(){
                        alert('Server Error!');
                    }
                });
            }
            else{
                $('#floating-message #message').css('border', '2px solid red');
            }
        })

        //redirecting a page button click
        $('#tasks > button').on('click', function(){
            window.location.assign('report.php');
        })

        //removing some text on certain screen size
        var width = $(window).width();

        if(width <= 900){
            $('.working').hide();
        }

        $('.delete-task').on('click', function(){
            var task_id = $(this).val();
            $.ajax({
                type: "post",
                url: "server/delete_task.php",
                data: {task_id: task_id},
                dataType: "text",
                success: function (response) {
                    if(response == '1'){
                        location.reload();
                    }
                    else if(response == '2'){
                        alert('Something went wrong!');
                    }
                }
            });
        })

        //toggling menu in small screens
        $('#mini-menu').on('click', function () {
            if ($('#options').hasClass('toggleMenu')) {
                $('#options').removeClass('toggleMenu');
            }
            else {
                $('#options').addClass('toggleMenu');
            }
        })
    })
</script>
</html>