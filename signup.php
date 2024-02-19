
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
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
.form{
    position: absolute;
    left: 50%;
    height: 100%;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
}
.form form{
    box-shadow:0 0 5px #b1b1b1;
    border-radius:5px;
    width:75%;
    height: 93%;
    overflow-y: scroll;
    padding:10px;
    border-radius: 5px;
}
.form form a{
    text-decoration: none;
}
.form form button{
    background: rgb(0, 0, 69);
    color: #fff;
}
.form form button:hover{
    background: rgb(0, 0, 69);
    color: #fff;
}
.form form .form-group{
    width: 100%;
    margin-top: 10px;
}
.form form .form-group > .form-control{
    margin-top: 0 !important;
}
.form form .form-group p{
    width: 100%;
    display: flex;
    justify-content: flex-start;
}
.con{
    position: fixed;
    left: 0;
    top: 0;
    width: 100% !important;
    height: 100%;
    padding: 0;
}
.text{
    position: absolute;
    left: 0;
    top: 0;
    margin: 0;
    height: 100%;
    background: rgb(0, 0, 69);
    color: #d7d7d7;
    display: flex;
    justify-content: center;
    align-items: center;
}
.text .welcome{
    font-size:40px;
}

@media only screen and (max-width: 900px){
    .con{
        display: flex;
        flex-direction: column;
    }
    .form{
        position: relative;
        left: 0;
        height: 70%;
        width: 100%;
    }
    .text{
        position: relative;
        height: 20%;
        width: 100%;
    }
    .text .welcome{
        font-size: 30px;
    }
    .form form{
        width: 80%;
        height: 97%;
    }
}
</style>
</head>
<body>
<?php include 'admin/functions/functions.php' ?>
<div class="con col-12">
<div class="text col-6" align="center">
    <p class="welcome">WELCOME!<br>Register Now...</p>
</div>
    <div class="form col-6" align="center">
        <form action="server/registration.php" method="post">
            <h5>Sign Up</h5>
            <label class="form-group">
                <p>Username</p>
                <input name="username" id="username" class="form-control" type="text">
                </label>
            <label class="form-group">
                <p>First Name</p>
                <input name="Fname" id="fname" class="form-control" type="text">
            </label>
            <label class="form-group">
                <p>Last Name</p>
                <input name="Lname" id="lname" class="form-control" type="text">
            </label>
            <label class="form-group">
                <p>Email</p>
                <input name="email" id="email" class="form-control" type="text">
            </label>
            <label class="form-group">
                <p>Phone</p>
                <div class="error3 mb-2 text-danger"></div>
                <input name="phone" id="phone" class="form-control" type="text">
            </label>
            <label class="form-group">
                <p>Department</p>
                <select name="department" id="department" class="form-control">
                    <option value="0">--select--</option>
                    <?php department_selection();?>
                </select>
            </label>
            <label class="form-group">
                <p>Password</p>
            </label>
            <div class="error mb-2 text-danger"></div>
                <input name="password" id="password" class="form-control" type="password">
            </label>
            <label class="form-group">
                <p>Confirm Password</p>
                <div class="error2 mb-2 text-danger"></div>
                <input name="cpassword" id="cpassword" class="form-control" type="password">
            </label><br/>
            <button name="signup" type="submit" id="submit" class="btn mt-3 mb-2 form-control">Sign Up</button>
            <a href="login.php">Have account? Log in</a>
        </form>
    </div>
</div>
</body>
<script>
    $(window).ready(function(){
        $('#submit').on('click', function(e){
            if($('#username').val() == ''){
                e.preventDefault();
                $('#username').css('border', '1px solid red');
                $($('#username')).on('blur', function(){
                    if($('#username').val() != ''){
                        $('#username').css('border', '1px solid green');
                    }
                })
            }
            else if($('#fname').val() == ''){
                e.preventDefault();
                $('#fname').css('border', '1px solid red');
                $($('#fname')).on('blur', function(){
                    if($('#fname').val() != ''){
                        $('#fname').css('border', '1px solid green');
                    }
                })
            }
            else if($('#lname').val() == ''){
                e.preventDefault();
                $('#lname').css('border', '1px solid red');
                $($('#lname')).on('blur', function(){
                    if($('#lname').val() != ''){
                        $('#lname').css('border', '1px solid green');
                    }
                })
            }
            else if($('#email').val() == '' || IsEmail($('#email').val()) == false){
                e.preventDefault();
                $('#email').css('border', '1px solid red');
                $($('#email')).on('blur', function(){
                    if($('#email').val() != '' && IsEmail($('#email').val()) == true){
                        $('#email').css('border', '1px solid green');
                    }
                })
            }
            else if($('#phone').val().length < 10 || $('#phone').val().length > 10){
                e.preventDefault();
                $('#phone').css('border', '1px solid red');
                $('.error3').html('Invalid phone number');
                $('#phone').on('blur', function(){
                    if($(this).val().length = 10){
                        $(this).css('border', '1px solid green'); 
                        $('.error3').html('');
                    }
                })
            }
            else if($('#department').children('option:selected').val() == '0'){
                e.preventDefault();
                $('#department').css('border', '1px solid red');
                $($('#department')).on('blur', function(){
                    if($('#department').children('option:selected').val() != '0'){
                        $('#department').css('border', '1px solid green');
                    }
                })
            }
            else if($('#password').val().length < 4){
                e.preventDefault();
                $('.error').text('Atleast 4 charcters are required!')
                $('#password').css('border', '1px solid red');
                $($('#password')).on('blur', function(){
                    if($('#password').val().length >= 4){
                        $('.error').text('')
                        $('#password').css('border', '1px solid green');
                    }
                })
            }
            else if($('#cpassword').val() != $('#password').val()){
                e.preventDefault();
                $('.error2').text('Password mismatch');
                $('#cpassword').css('border', '1px solid red');
                $($('#cpassword')).on('blur', function(){
                    if($('#cpassword').val() == $('#password').val()){
                        $('.error').text('')
                        $('#password').css('border', '1px solid green');
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
    })
</script>
</html>