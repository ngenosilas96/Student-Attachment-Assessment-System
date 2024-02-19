<!DOCTYPE html>
<?php $title = 'Departments';?>
<html lang="en">
    <?php include 'includes/header.php';?>
<body>
    <div id="content">
        <h4>Departments</h4>
        <div class="department-search w-100 form-group my-3 d-flex flex-row">
            <form action="#" method="get">
                <input type="text" class="form-control" placeholder="Search for a depart...">
            </form>
            <button class="btn btn-success mx-3 new-department">New department</button>
        </div>
        <table>
                <?php
                fetch_departments(); 
                ?>
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
            <form action="server/add-department.php" method="post" class="form-group p-3">
                <div class="my-2 d-flex flex-row justify-content-between w-100"><h5>Add a department</h5><i class="fa-solid fa-xmark"></i></div>
                <input type="text" class="form-control w-100 my-2" name="department-number" id="department-number" placeholder="Enter department number...">
                <input type="text" class="form-control w-100 my-2" name="department-name" id="department-name" placeholder="Enter department name...">
                <button type="submit" class="btn btn-primary form-control" name="add">Add</button>
            </form>
        </div>
    </div>
    <script src="main.js"></script>
    <script>
        $(window).ready(function(){
            $('.department-search button').on('click', function(){
                $('#new').fadeIn(300);
                $('#new > form .fa-xmark').on('click', function(){
                    $('#new').fadeOut(300);
                })
            })

            $('#new form button').on('click', function(e){
                if($('#department-number').val() == ''){
                    e.preventDefault();
                    $('#department-number').css('border', '1px solid red');
                }
                if($('#department-name').val() == ''){
                    e.preventDefault();
                    $('#department-name').css('border', '1px solid red');
                }
            })

            //deleting a department
            $('td > button').on('click', function(){
                var id = $(this).val();
                $.ajax({
                    url: "server/delete-department.php",
                    data: {id: id},
                    method: 'post',
                    success: function (response) {
                        if(response){
                            location.reload();
                        }
                    }
                });
            })

            //searching a department
            $('.department-search form input').keyup(function(){
                var word = $(this).val();
                $.ajax({
                    url: "server/search-department.php",
                    method: 'get',
                    data: {word: word},
                    success: function (response) {
                        if(response != ''){
                            $('table').html(response);
                            //deleting row
                            $('td > button').on('click', function(){
                                var id = $(this).val();
                                $.ajax({
                                    url: "server/delete-department.php",
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