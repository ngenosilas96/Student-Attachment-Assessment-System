<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
    <title>Intern Hub </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logos.png">
    <link rel="stylesheet" href="admin/libraries/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/libraries/fontawesome/css/all.css">
    <link rel="stylesheet" href="employee.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.6.0/css/autoFill.dataTables.min.css">
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
        .form-outer{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, .4);
            z-index: 20;
            display: none;
        }
        form{
            position: relative;
            margin: 10px auto;
            width: 50%;
            background: #fff;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }
        form #timeEntryForm{
            width: 100%;
            display: flex;
            flex-direction: column;
        }
        form #timeEntryForm input, form #timeEntryForm select, form #timeEntryForm textarea, form #timeEntryForm button{
            margin-bottom: 20px;
        }
        form #submit{
            margin-left: 75%;
            background: rgb(0, 0, 69);
            color: #fff;
            margin-top: 20px;
        }
        .tox .tox-promotion, .tox:not([dir=rtl]) .tox-statusbar__branding{
            display: none !important;
        }
        table {
            width: 100%;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        #close{
            position: absolute;
            right: 15px;
            top: 10px;
            width: fit-content;
            height: fit-content;
            outline: none;
            border: none;
            background: transparent;
        }
        #close:focus{
            outline: none;
            border: none;
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
        }

        @media only screen and (max-width: 500px){
            .navbar a{
                font-size: 15px !important;
            }
            #outer h4{
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <?php include 'admin/functions/functions.php' ?>
    <div id="outer" class="px-3">
        <h4>Leave Requests</h4>
        <button class="btn btn-sm text-light mb-3 mx-3" id="request-leave" style="background: rgb(0, 0, 69);">Send Request</button>
        <table id="unapproved" class="w-100 display nowrap mx-3">
            <?php personal_leave_requests() ?>
        </table>
        <div class="form-outer">
            <form action="server/leave.php" method="post">
                <button id="close"><i class="fa-solid fa-times"></i></button>
                <?php
                    if (isset($_SESSION['request_sent'])) { ?>
                        <div class="alert alert-success my-2" style="height: fit-content;" role="alert">
                            <strong>
                                <?php echo $_SESSION['request_sent']; ?>
                            </strong>
                        </div>
                        <?php
                        unset($_SESSION['request_sent']);
                    } ?>
                <div id="timeEntryForm">
                    <label for="from-date">From When:</label>
                    <input type="date" class="form-control" id="from-date" name="from-date">
                    <label for="to-when">To When:</label>
                    <input type="date" name="to-when" class="form-control" id="to-when">
                    <label for="reason">Reason:</label>
                    <textarea id="reason" name="reason" class="remarks form-control" rows="13"></textarea>
                    <button  id="send" type="submit" name="send" class="btn w-25 btn-secondary mt-2">Send</button>
                </div>
            </form>
        </div>
    </div>
    <script src="admin/libraries/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.6.0/js/dataTables.autoFill.min.js"></script>
    <script>
        //adding editing features to remarks
        tinymce.init({
                selector: '.remarks'
            });

        //report validation
        $('#send').on('click', function(e){
            if($('#from-date').val() == 0){
                e.preventDefault();
                console.log('Date required!');
                $('#from-date').css('border', '1px solid red');
                $('#from-date').on('change', function(){
                    if($('#from-date').val() != ''){
                        $('#from-date').css('border', '1px solid green');
                    }
                })
            }
            else if($('#to-when').val() == 0){
                e.preventDefault();
                $('#to-when').css('border', '1px solid red');
                $('#to-when').on('change', function(){
                    if($('#to-when').val() != ''){
                        $('#to-when').css('border', '1px solid green');
                    }
                })
            }
            else if(tinyMCE.activeEditor.getContent({format : 'text'}) == ''){
                e.preventDefault();
                alert('Reason is empty!');
            }
        })

        $('#request-leave').on('click', function(){
            $('.form-outer').show();
        })

        $('form #close').on('click', function(e){
            e.preventDefault();
            $('.form-outer').hide();
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

        new DataTable('#unapproved', {
            autoFill: true,
            scrollX: true, // Enable horizontal scrolling
            //responsive: true, // Enable responsive design
        });
    </script>
</body>
</html>