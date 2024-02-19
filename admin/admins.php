<!DOCTYPE html>
<?php $title = 'Admins';?>
<html lang="en">
    <?php include 'includes/header.php';?>
<body>
    <div id="content">
        <h4>Admins</h4>
        <div class="branch-search w-100 form-group my-3 d-flex flex-row">
            <button class="btn btn-success mx-3 new-branch">New Admin</button>
        </div>
        <table>
            <?php fetch_admins()?>
        </table>
        <style>
            #new{
                width: 100%;
                height: 100%;
                position: fixed;
                top: 50px;
                left: 20%;
                background: rgba(0, 0, 0, .3);
                z-index: 10;
                display: none;
            }
            #new form{
                width: 40%;
                position: absolute;
                top: 20%;
                left: 40%;
                transform: translateX(-50%);
                background: #fff;
                border-radius: 4px;
            }
            @media only screen and (max-width: 750px){
                #new{
                    left: 0;
                }
                #new form{
                    width: 80%;
                    left: 50%;
                }
            }
        </style>
        <div id="new">
            <form action="server/admin.php" method="post" class="form-group p-3">
                <div class="my-2 d-flex flex-row justify-content-between w-100"><h5>Add new Admin</h5><i class="fa-solid fa-xmark"></i></div>
                <input type="text" class="form-control w-100 my-2" name="username" id="username" placeholder="Enter Admin username...">
                <input type="text" class="form-control w-100 my-2" name="email" id="email" placeholder="Enter Admin email...">
                <select name="department" id="department" class="form-control w-100 my-2">
                    <?php departments_for_reg()?>
                </select>
                <input type="password" class="form-control w-100 my-2" name="password" id="password" placeholder="Enter Password...">
                <button type="submit" class="btn btn-primary form-control" name="add">Add</button>
            </form>
        </div>
    </div>
    <script src="main.js"></script>
    <script>
        $(window).ready(function(){
            $('.branch-search button').on('click', function(){
                $('#new').fadeIn(300);
                $('#new > form .fa-xmark').on('click', function(){
                    $('#new').fadeOut(300);
                })
            })

            $('#new form button').on('click', function(e){
                if($('#username').val() == ''){
                    e.preventDefault();
                    $('#username').css('border', '1px solid red');
                    $('#username').blur(function(){
                        if($('#username').val() != ''){
                            $('#username').css('border', '1px solid green');
                        }
                    })
                }
                else if($('#email').val() == '' || IsEmail($('#email').val()) == false){
                    e.preventDefault();
                    $('#email').css('border', '1px solid red');
                    $('#email').blur(function(){
                        if($('#email').val() != '' || IsEmail($('#email').val()) == true){
                            $('#email').css('border', '1px solid green');
                        }
                    })
                }
                else if($('#password').val() == ''){
                    e.preventDefault();
                    $('#password').css('border', '1px solid red');

                }
                else if($('#password').val().length < 8){
                    e.preventDefault();
                    alert('Password must be atleast 8 characters');
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

            //deleting admin
            $('td > button').on('click', function(){
                var id = $(this).val();
                $.ajax({
                    url: "server/delete-admin.php",
                    data: {id: id},
                    method: 'post',
                    success: function (response) {
                        if(response){
                            location.reload();
                        }
                    }
                });
            })

            //searching for admin
            $('.branch-search form input').keyup(function(){
                var word = $(this).val();
                $.ajax({
                    url: "server/search-admin.php",
                    method: 'get',
                    data: {word: word},
                    success: function (response) {
                        if(response != ''){
                            $('table').html(response);
                            //deleting row
                                $('td > button').on('click', function(){
                                var id = $(this).val();
                                $.ajax({
                                    url: "server/delete-admin.php",
                                    data: {id: id},
                                    method: 'post',
                                    success: function (response) {
                                        if(response){
                                            location.reload();
                                        }
                                    }
                                });
                            })
                        }
                        else{
                            location.reload();
                        }
                    }
                });
            })
        })
    </script>
</body>
<?php include 'includes/footer.php' ?>
</html>