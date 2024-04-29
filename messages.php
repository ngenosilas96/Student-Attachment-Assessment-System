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
    <link rel="stylesheet" href="admin/libraries/fontawesome/css/all.css">
    <script src="admin/libraries/jquery-3.6.0.min.js"></script>
    <script src="admin/libraries/tinymce/tinymce.min.js"></script>
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
        }
        #outer h4{
            width: 95%;
            border-bottom: 1px solid #d1d1d1;
            margin: 20px;
            padding-bottom: 7px;
        }
        #outer img{
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-left: 15%;
        }
        form{
            margin: 20px auto;
            width: 50%;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }
        form #submit{
            margin-left: 75%;
            background: rgb(0, 0, 69);
            color: #fff;
            margin-top: 20px;
        }
        form input, form select{
            margin-bottom: 20px;
        }
        #message-part{
            position: relative;
            border: 1px solid #bdbdbd;
            border-radius: 5px;
            padding: 15px;
            margin-left: 50%;
            transform: translateX(-50%);
            max-height: 70vh;
            overflow-y: auto;
            padding-bottom: 85px;
        }
        #message-part .card-footer{
            font-size: 13px !important;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        #message-part .card-header{
            background: rgba(0, 0, 0, .6);
            color: #e3e3e3;
        }
        #message-part .card{
            margin-bottom: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, .1);
            background: rgb(224, 240, 255);
        }
        .reply-card{
            margin-left: 50%;
            transform: translateX(-45%);
            background: #fff !important;
        }
        #message-reply{
            position: absolute;
            bottom: 30px;
            left: 47%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, .8);
            padding: 20px 10px;
            border-radius: 7px;
            display: none;
        }
        #message-reply .form-group{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
        #message-reply .form-group textarea{
            resize: none;
            max-height: 100px;
            overflow-y: auto;
        }

        @media only screen and (max-width: 900px){
            .navbar a{
                font-size: 25px;
            }
            .navbar #options a{
                font-size: 18px;
            }
            #outer{
                overflow-x: hidden;
            }
            #outer h4{
                font-size: 30px;
            }
            form{
                width: 100%;
            }
            #message-part{
                width: 90%;
            }
            .reply-card{
                margin-left: 50%;
                transform: translateX(-48%);
                width: 100%;
            }
            #message-reply{
                width: 100%;
                padding: 10px 5px;
                left: 50%;
                transform: translateX(-50%);
            }
        }
        @media only screen and (max-width: 500px){
            .navbar a{
                font-size: 15px !important;
            }
            #outer h4{
                font-size: 20px;
            }
            #message-part{
                width: 100%;
            }
        }

    </style>
</head>
<body>
    <?php include 'admin/functions/functions.php'?>
    <div id="outer">
        <h4>Your Messages</h4>
        <div id="message-part" class="col-md-8">
    <?php
    $id = $_SESSION['id'];

    $messageQuery = "SELECT * FROM message WHERE employee_id = $id AND parent_message_id IS NULL ORDER BY date";
    $messageResult = mysqli_query($connection, $messageQuery);
    $number_of_messages = mysqli_num_rows($messageResult);

    $employee = "SELECT * FROM employee WHERE employee_id = $id";
    $employeeResult = mysqli_query($connection, $employee);
    $employeeDetails = mysqli_fetch_assoc($employeeResult);

    if($number_of_messages > 0){
        while ($messageDetails = mysqli_fetch_assoc($messageResult)) {
            $parentMessageId = $messageDetails['id'];
    
            // Display the original message
            displayMessage($messageDetails, 'You');
    
            // Display reply messages
            displayReplyMessages($connection, $parentMessageId, $id);
        }
    }
    else{?>
        <h6>No messages</h6>
        <?php
    }
    ?>

    <?php
    // Function to display a message card
    function displayMessage($messageDetails, $headerText) {
        ?>
        <div class="card col-md-9">
            <div class="card-header"><?php echo $headerText; ?></div>
            <div class="card-body"><?php echo $messageDetails['content']; ?></div>
            <div class="card-footer">
                <span>
                    <?php
                    $dateTime = new DateTime($messageDetails['date']);
                    $timeOnly = $dateTime->format('H:i:s');
                    echo date('d-m-Y', strtotime($messageDetails['date'])) . '&nbsp;&nbsp;&nbsp;&nbsp;' . $timeOnly;
                    ?>
                </span>
            </div>
        </div>
        <?php
    }

    // Function to display reply messages
    function displayReplyMessages($connection, $parentMessageId, $id) {
        $replyQuery = "SELECT * FROM message WHERE parent_message_id = $parentMessageId ORDER BY date";
        $replyResult = mysqli_query($connection, $replyQuery);

        while ($replyDetails = mysqli_fetch_assoc($replyResult)) {
            $adminId = $replyDetails['admin_id'];
            $adminUsername = getAdminUsername($connection, $adminId);

            // Check if the message is from an admin
            $isFromAdmin = ($replyDetails['message_from'] != $id);

            if($replyDetails['message_to'] == $id && $replyDetails['message_from'] != $id){
                displayMessage2($replyDetails, $adminId, $parentMessageId, $isFromAdmin, ($isFromAdmin) ? $adminUsername . ' to you' : 'Admin to you', 'reply-card');
            }
            else if($replyDetails['message_from'] == $id){
                displayMessage2($replyDetails, $adminId, $parentMessageId, $isFromAdmin,'You to '.$adminUsername, 'reply-card');
            }

            // // Display the reply message with "reply-card" class for admin messages
            // displayMessage2($replyDetails, $adminId, $parentMessageId, $isFromAdmin, ($isFromAdmin) ? $adminUsername . ' to you' : 'Admin to you', 'reply-card');
        }
    }

    // Function to get admin username
    function getAdminUsername($connection, $adminId) {
        if ($adminId != null) {
            $adminQuery = "SELECT username FROM admin WHERE id = $adminId";
            $adminResult = mysqli_query($connection, $adminQuery);
            $adminDetails = mysqli_fetch_assoc($adminResult);

            return ($adminDetails) ? $adminDetails['username'] : 'Unknown Admin';
        }
        return '';
    }

    // Function to display a message card with an optional class
    function displayMessage2($replyDetails, $adminId, $parentMessageId, $isFromAdmin, $headerText, $additionalClass = '') {
        ?>
        <div class="card col-md-9 <?php echo $additionalClass; ?>">
            <div class="card-header"><?php echo $headerText; ?></div>
            <div class="card-body"><?php echo $replyDetails['content']; ?></div>
            <div class="card-footer">
                <span>
                    <?php
                    $dateTime = new DateTime($replyDetails['date']);
                    $timeOnly = $dateTime->format('H:i:s');
                    echo date('d-m-Y', strtotime($replyDetails['date'])); ?> 
                    &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $timeOnly;
                    ?>
                </span>
                <?php
                // Display reply button only if the message is from an admin
                if ($isFromAdmin) {
                    ?>
                    <button class="btn btn-sm btn-outline-light text-primary reply" value="<?php echo $parentMessageId; ?>">reply<input type="hidden" value="<?php echo $adminId; ?>"></button>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>


        <div id="message-reply" class="col-md-7">
            <input type="hidden" id="message-id">
            <div class="form-group">
                <textarea name="message" id="message" cols="30" rows="1" class="form-control"></textarea>
                <button class="btn btn-outline-primary mx-3" id="send"><i class="fa-regular fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</body>
<script>
    $(window).ready(function(){
        //toggling menu in small screens
        $('#mini-menu').on('click', function () {
            if ($('#options').hasClass('toggleMenu')) {
                $('#options').removeClass('toggleMenu');
            }
            else {
                $('#options').addClass('toggleMenu');
            }
        });

        $(document).on('click', '.reply', function(){
            $('#message-reply').show();
            var parent_id = $(this).val();
            var admin_id = $(this).find('input').val();
            $('#message-reply #send').on('click', function(){
                var message = $('#message-reply #message').val();
                if(message != ''){
                    $.ajax({
                        type: "post",
                        url: "server/reply-message.php",
                        data: {parent_id: parent_id, admin_id: admin_id, message: message},
                        dataType: "text",
                        success: function (response) {
                            console.log(response);
                            if(response == '1'){
                                alert('Message sent successfully!');
                                location.reload();
                            }
                            else if(response == '0'){
                                alert('Failed. Something went wrong!');
                                location.reload();
                            }
                        },
                        error: function(){
                            alert('Server Error');
                            location.reload();
                        }
                    });
                }
                else{
                    $('#message-reply #message').css('border', '1px solid red');
                }
            })
        })

        //marking messages as read
        $.ajax({
            type: "post",
            url: "server/message-read.php",
            dataType: "text",
            success: function (response) {
            }
        });

        //scroll message part automatically to the bottom
        var messagePartDiv = document.getElementById('message-part');
        messagePartDiv.scrollTop = messagePartDiv.scrollHeight;
    });
</script>
</html>