<!DOCTYPE html>
<?php $title = 'Organizations';?>
<html lang="en">
    <?php include 'includes/header.php';?>
<body>
    <div id="content">
        <h4>Organizations</h4>
        <div class="branch-search w-100 form-group my-3 d-flex flex-row">
            <form action="#" method="get">
                <input type="text" class="form-control" placeholder="Search for a organ...">
            </form>
            <button class="btn btn-success mx-3 new-branch">New Branch</button>
        </div>
        <table>
                <?php
                fetch_branches(); 
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
            <form action="server/add-branch.php" method="post" class="form-group p-3">
                <div class="my-2 d-flex flex-row justify-content-between w-100"><h5>Add Organization</h5><i class="fa-solid fa-xmark"></i></div>
                <input type="text" class="form-control w-100 my-2" name="branch-number" id="branch-number" placeholder="Enter Organization number...">
                <input type="text" class="form-control w-100 my-2" name="branch-name" id="branch-name" placeholder="Enter Organization name...">
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
                if($('#branch-number').val() == ''){
                    e.preventDefault();
                    $('#branch-number').css('border', '1px solid red');
                }
                if($('#branch-name').val() == ''){
                    e.preventDefault();
                    $('#branch-name').css('border', '1px solid red');
                }
            })

            //deleting a branch
            $('td > button').on('click', function(){
                var id = $(this).val();
                $.ajax({
                    url: "server/delete-branch.php",
                    data: {id: id},
                    method: 'post',
                    success: function (response) {
                        if(response){
                            location.reload();
                        }
                    }
                });
            })

            //searching a branch
            $('.branch-search form input').keyup(function(){
                var word = $(this).val();
                $.ajax({
                    url: "server/search-branch.php",
                    method: 'get',
                    data: {word: word},
                    success: function (response) {
                        if(response != ''){
                            $('table').html(response);
                            //deleting row
                                $('td > button').on('click', function(){
                                var id = $(this).val();
                                $.ajax({
                                    url: "server/delete-branch.php",
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