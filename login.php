<!DOCTYPE html>
<?php session_start() ?>
<html>
<head>
<meta charset="UTF-8"/>
<title>Login</title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="logos.png">
<link rel="stylesheet" href="admin/libraries/css/bootstrap.min.css">
<link rel="stylesheet" href="admin/libraries/fontawesome/css/all.css">
<script src="admin/libraries/jquery-3.6.0.min.js"></script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Signika+Negative:wght@500&display=swap');
        *{
            font-family: 'Signika Negative', sans-serif;
        }
    form h3 {
        text-align:center;
        border-bottom:1px solid rgb(223, 223, 223);
        background-color:white;
        padding-bottom: 5px;
    }
    form {
        background-color:white;
        box-shadow:0 0 7px rgba(136, 136, 136, 0.684);
        border-radius:4px;
        margin:auto;
        margin-top:100px;
        width:500px;
        height:fit-content;
        padding:10px;
    }
    form a{
        text-decoration:none;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    form > button, form > button:hover{
        background: rgb(0, 0, 69) !important;
        color: #fff !important;
    }
    .forgot-password{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, .6);
        display: none;
    }
    .forgot-password form{
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        margin-top: 15%;
        width: 40%;
        height: fit-content;
    }
    .forgot-password form h4{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        cursor: pointer;
    }

    @media only screen and (max-width: 900px){
        form{
            width: 70%;
        }
    }
    </style>
</head>
<body>
    <form action="server/login.php" method="post" class="login form-group">
        <h3>Login</h3>
        <?php if(isset($_SESSION['register-successful'])) {?>
            <div class="alert alert-success w-100"><?php echo $_SESSION['register-successful']; session_unset(); session_destroy();?></div> <?php }?>
        <div class="error text-danger mb-2"></div>
        <input class="email mt-3 form-control" type="text" id="email" name="email" placeholder="Enter your email..."/>
        <input class="password mt-3 form-control" type="password" id="password" name="password" placeholder="Password...">
        <button class="btn mt-3 mb-2 form-control" name="login" id="login" type="submit">Log in</button>
        <a href="signup.php" class="mb-2">Don't have an account? click here</a>
        <a href="#" id="forgot-link">Forgot Password?</a> 
    </form>
<div class="forgot-password">
    <form action="#" method="post">
        <h4>Request Password Reset<i class="fa-solid fa-xmark"></i></h4>
            <input type="email" class="form-control mb-3" name="email" id="reset-email" placeholder="Enter your registered email...">
            <button type="submit" id="request" class="form-control">Request</button>
    </form>
</div>
</body>
<script type="text/javascript">
    $(window).ready(function(){
        $('#login').on('click', function(e){
            var email = $('#email').val();
            if($('#email').val() == '' || IsEmail(email) == false){
                e.preventDefault();
                $('.error').text('*Valid Email required');
                $('#email').css('border', '1px solid red');
            }
            else if($('.password').val() == ''){
                e.preventDefault();
                $('.error').text('* Password required');
                $('#password').css('border', '1px solid red');
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

        //request password validation
        $('#request').on('click', function(e){
            e.preventDefault()
            if($('#reset-email').val() == ''){
                alert('Insert Email');
            }
        })

        //opening password reset request form
        $('#forgot-link').click(function(){
            $('.forgot-password').fadeIn(500);
            $('.forgot-password form .fa-xmark').click(function(){
                $('.forgot-password').fadeOut(500);
            })
        })

        //sending email
        $('#request').on('click', function(e){
            var email = $('#reset-email').val();
            $(this).text('Sending...').attr('disabled', true);
            e.preventDefault();
            $.ajax({
                method: 'post',
                url: "server/sendEmail.php",
                data: {email: email},
                success: function (response) {
                    if(response == '1'){
                        $("#request").text('Request').attr('disabled', false);
                        alert('Email sent successfully!');
                        $('.forgot-password').fadeOut(500);
                    }
                    else if(reponse == '0'){
                        $("#request").text('Request').attr('disabled', false);
                        $('.forgot-password').fadeOut(500);
                        alert ('email not sent');
                    }
                    else{
                        alert('something went wrong!');
                        $("#request").text('Request').attr('disabled', false);
                    }
                }
            });
        })
        
    })
    </script>
</html>
