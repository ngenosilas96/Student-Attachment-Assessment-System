<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
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
        .container {
    width: 400px;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color:white;
}
body{
    background-color: grey;
}

h2 {
    text-align: center;
}

.form-row {
    margin-bottom: 10px;
}

label {
    display: inline-block;
    
}

input[type="text"],
input[type="password"] {
    width: 100%;
}
.form-group{
    width: 100%;
    margin-bottom: 10px;
}
button[type="submit"] {
    margin-left: 50%;
    transform: translateX(-50%);
    background-color: blue;
    color: white;
    align-items: center;
    width:40%;
}
grid{
    justify-content: space-evenly;
}
    @media only screen and (max-width: 900px){
        .container {
            width: 70%;
        }
    }
        @media only screen and (max-width: 500px){
            .container {
                width: 90%;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <form id="resetForm" action="server/resetpassword.php" method="post">
            <h4>Password Reset</h4>
                <input type="hidden" name="user_id" value="<?php echo $_GET['id']?>">
                <label class="form-group" for="newPassword">New Password:
                    <div class="error w-100 text-danger"></div>
                <input class="form-control" name="password" type="password" id="newPassword">
            </label>
           
                <label class="form-group" for="confirmPassword">Confirm Password:
                <input class="form-control" type="password" id="confirmPassword">
            </label>
        
                <button class="form-control" name="submit" type="submit">Reset Password</button>
        </form>
    </div>
    <script>

// Function to validate the form
$('form button').on('click', function(e){
    if($('#newPassword').val() == '' || $('#confirmPassword').val() == ''){
        e.preventDefault();
        alert('Fill all the fields');
    }
    else if($('#newPassword').val().length < 4){
        e.preventDefault();
        $('.error').text('Must be a 4 or more character password');
        $('#newPassword').blur(function(){
            if($('#newPassword').val().length >= 4){
                $('.error').text('');
            }
        })
    }
    else if($('#newPassword').val() != $('#confirmPassword').val()){
        e.preventDefault();
        alert('Password mismatch');
    }
})


    </script>
</body>
</html>
