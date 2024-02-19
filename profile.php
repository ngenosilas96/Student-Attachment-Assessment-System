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
    <?php include 'admin/functions/functions.php'?>
    <div id="outer">
        <h4>Your Profile</h4>
        <img src="user.png" alt="Thumbnail">
        <?php
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM employee WHERE employee_id = '$id'";
        $run = mysqli_query($connection, $sql);
        $details = mysqli_fetch_assoc($run);
        ?>
        <form action="server/save-profile.php" method="post">
            <input name="username" id="username" value="<?php echo $details['username'] ?>" class="form-control" type="text" placeholder="Username...">
            <input name="Fname" id="fname" value="<?php echo $details['fname'] ?>" class="form-control" type="text" placeholder="First name...">
            <input name="Lname" id="lname" value="<?php echo $details['lname'] ?>" class="form-control" type="text" placeholder="Last name...">
            <input name="email" id="email" value="<?php echo $details['email'] ?>" class="form-control" type="text" placeholder="Email address...">
            <input name="phone" id="phone" value="<?php echo $details['phone'] ?>" class="form-control" type="text" placeholder="Phone...">
            <select name="department" id="department" class="form-control">
                <option value="<?php echo $details['department'] ?>"><?php echo $details['department'] ?></option>
                <?php department_selection() ?>
            </select>
            <input name="password" minlength='4' id="password" value="" class="form-control" type="password" placeholder="Password...">
            <button type="submit" class="btn" name="submit" id="submit">Save</button>
        </form>
    </div>
</body>
<script>
    $(window).ready(function(){
        $('#submit').on('click', function(e){

            if($('#username').val() == '' || $('#fname').val() == '' || $('#lname').val() == '' || $('#phone').val() == '' ||$('#department').children('option:selected').val() == ''){
                e.preventDefault();
                alert('Fill all the fields');
            }
            else if(IsEmail($('#email').val()) == false){
                e.preventDefault();
                $('#email').css('border', '1px solid red');
                alert('Enter a valid email');
                $('#email').blur(function(){
                    if(IsEmail($('#email').val()) == true){
                        $('#email').css('border', '1px solid green');
                    }
                })
            }
        })
        function IsEmail(email) {
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!regex.test(email)) {
                return false;
                }else{
                return true;
                }
            }

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