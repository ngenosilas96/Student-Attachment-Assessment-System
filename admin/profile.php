<!DOCTYPE html>
<?php $title = 'Profile';?>
<html lang="en">
    <?php include 'includes/header.php';?>
<body>
    <style>
        #content{
            overflow-x: hidden;
        }
        img{
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
        form{
            width: 100%;
            margin-left: 10%;
        }
        form .form-control{
            margin-bottom: 20px;
            width: 30%;
        }
        form button{
            margin-left: 80%;
        }
        @media only screen and (max-width: 750px){
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
        }
    </style>
    <div id="content">
        <h4>Your Profile</h4>
        <img src="../user.png" alt="thumbnail">
        <form action="profile.php" method="post">
            <?php
            if(isset($_SESSION['admin-id'])){
                $user_id = $_SESSION['admin-id'];
                $sql = "SELECT * FROM admin WHERE id = '$user_id'";
                $run = mysqli_query($connection, $sql);
                $details = mysqli_fetch_assoc($run);
            ?>
            <input type="text" name="username" value="<?php echo $details['username']?>" class="form-control" id="username">
            <input type="email" name="email" value="<?php echo $details['email']?>" class="form-control" id="email">
            <input type="password" name="password" value="<?php echo $details['password']?>" id="password" class="form-control">
            <button type="submit" class="btn btn-primary" id="save" name="save">Save</button><?php }?>
        </form>
    </div>
    <script src="main.js"></script>
    <script>
        $('#save').on('click', function(e){
            if($('#username').val() == ''){
                e.preventDefault();
                $('#username').css('border', '1px solid red');
                $('#username').blur(function(){
                        if($('#username').val() != ''){
                            $('#username').css('border', '1px solid green');
                        }
                    })
            }
            else if(IsEmail($('#email').val()) == false){
                e.preventDefault();
                $('#email').css('border', '1px solid red');
                alert('Enter valid email');
            }
            else if($('#password').val() == '' || $('#password').val().length < 8){
                e.preventDefault();
                $('#password').css('border', '1px solid red');
                alert('Make sure your password is not empty and contains atlease 8 characters');
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
    </script>
</body>
<?php
if(isset($_POST['save'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id = $_SESSION['admin-id'];

    $update = "UPDATE admin SET username='$username', email = '$email', password = '$password' Where id = '$id'";
    $run = mysqli_query($connection, $update);
    if($run){
        $_SESSION['admin-username'] = $username;
    }
}
?>
<?php include 'includes/footer.php'; ?>
</html>