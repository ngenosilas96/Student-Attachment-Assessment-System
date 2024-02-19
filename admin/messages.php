<!DOCTYPE html>
<?php $title = 'Messages';?>
<html lang="en">
    <?php include 'includes/header.php';?>
<body>
    <style>
        #content{
            overflow-x: hidden;
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
            bottom: 80px;
            left: 57%;
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
        @media only screen and (max-width: 800px){
            form{
                margin-left: 5%;
                margin-top: 15px;
            }
            form .form-control{
                width: 80%;
            }
            form button{
                margin-left: 70%;
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
                width: 70%;
                padding: 10px 5px;
                left: 60%;
                transform: translateX(-50%);
            }
        }
        @media only screen and (max-width: 500px){
            #message-part{
                width: 100%;
            }
            #message-reply{
                width: 95%;
                padding: 10px 5px;
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
    <div id="content">
        <h4>Messages</h4>
        <div id="message-part" class="col-md-8">
            <?php
            $id = $_SESSION['admin-id'];
            $dept = $_SESSION['department'];
            $message = "SELECT * FROM message WHERE department = $dept AND parent_message_id IS NULL order by date";
            $run = mysqli_query($connection, $message);
            $number_of_rows = mysqli_num_rows($run);
            if($number_of_rows > 0){
                while($message_details = mysqli_fetch_assoc($run)){
                    $employee_id = $message_details['employee_id'];
                    $employee = "SELECT * FROM employee WHERE employee_id = $employee_id";
                    $run2 = mysqli_query($connection, $employee);
                    $number_of_rows = mysqli_num_rows($run2);
                    $employee_details = mysqli_fetch_assoc($run2);
                    ?>
                    <div class="card col-md-9">
                        <div class="card-header"><?php echo $employee_details['fname'].' '.$employee_details['lname']?></div>
                        <div class="card-body"><?php echo $message_details['content']?></div>
                        <div class="card-footer"><span><?php $dateTime = new DateTime($message_details['date']);$timeOnly = $dateTime->format('H:i:s'); echo date('d-m-Y', strtotime($message_details['date']))?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $timeOnly?></span><button class="btn btn-sm btn-outline-light text-primary reply" value="<?php echo $message_details['id']?>">reply<input type="hidden" value="<?php echo $employee_id?>"></button></div>
                    </div>
                    <?php
                    $parent_message_id = $message_details['id'];
                    $message2 = "SELECT * FROM message WHERE parent_message_id = $parent_message_id order by date";
                    $run3 = mysqli_query($connection, $message2);
                    $number_of_rows = mysqli_num_rows($run3);
                    if($number_of_rows > 0){
                        while($message_details2 = mysqli_fetch_assoc($run3)){
                                $employee_id = $message_details['employee_id'];
                                $employee = "SELECT * FROM employee WHERE employee_id = $employee_id";
                                $run2 = mysqli_query($connection, $employee);
                                $number_of_rows = mysqli_num_rows($run2);
                                $employee_details = mysqli_fetch_assoc($run2);

                                $admin_id = $message_details2['admin_id'];
                                $admin = "SELECT username FROM admin WHERE id = $admin_id";
                                $admin_run = mysqli_query($connection, $admin);
                                $admin_fetch = mysqli_fetch_assoc($admin_run);
                                $admin_rows = mysqli_num_rows($admin_run);

                                if($number_of_rows > 0 && $admin_rows > 0){
                                    if($message_details2['message_from'] == $id){?>
                                        <div class="card col-md-9 reply-card">
                                            <div class="card-header">
                                                <?php
                                                echo 'You';
                                                ?>
                                            </div>
                                            <div class="card-body"><?php echo $message_details2['content']?></div>
                                            <div class="card-footer"><span><?php $dateTime = new DateTime($message_details2['date']);$timeOnly = $dateTime->format('H:i:s'); echo date('d-m-Y', strtotime($message_details2['date']))?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $timeOnly?></span></div>
                                        </div>
                                        <?php
                                    }
                                    else if($message_details2['message_from'] != $id){?>
                                        <div class="card col-md-9 reply-card">
                                            <div class="card-header">
                                                <?php
                                                echo $employee_details['fname'].' '.$employee_details['lname']
                                                ?>
                                            </div>
                                            <div class="card-body"><?php echo $message_details2['content']?></div>
                                            <div class="card-footer"><span><?php $dateTime = new DateTime($message_details2['date']);$timeOnly = $dateTime->format('H:i:s'); echo date('d-m-Y', strtotime($message_details2['date']))?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $timeOnly?></span><button class="btn btn-sm btn-outline-light text-primary reply" value="<?php echo $message_details['id']?>">reply<input type="hidden" value="<?php echo $employee_id?>"></button></div>
                                        </div>
                                        <?php
                                    }
                                }
                        }
                    }
                }
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
    <script src="main.js"></script>
    <script>
        $(window).ready(function(){
            //marking messages as read
            $.ajax({
                type: "post",
                url: "server/message-read.php",
                success: function (response) {
                }
            });
        })

        $(document).on('click', '.reply', function(){
            $('#message-reply').show();
            var parent_id = $(this).val();
            var employee_id = $(this).find('input').val();
            $('#message-reply #send').on('click', function(){
                var message = $('#message-reply #message').val();
                if(message != ''){
                    $.ajax({
                        type: "post",
                        url: "server/reply-message.php",
                        data: {parent_id: parent_id, employee_id: employee_id, message: message},
                        dataType: "text",
                        success: function (response) {
                            if(response == '1'){
                                alert('Message sent successfully!');
                                location.reload();
                            }
                            else if(response == '2'){
                                alert('Failed. Something went wrong!');
                            }
                        },
                        error: function(){
                            alert('Server Error!');
                        }
                    });
                }
                else{
                    $('#message-reply #message').css('border', '1px solid red');
                }
            })
        })

        //scroll message part automatically to the bottom
        var messagePartDiv = document.getElementById('message-part');
        messagePartDiv.scrollTop = messagePartDiv.scrollHeight;
    </script>
</body>
<?php include 'includes/footer.php'; ?>
</html>