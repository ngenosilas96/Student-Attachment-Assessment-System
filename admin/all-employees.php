<!DOCTYPE html>
<?php $title = 'All Students';?>
<html lang="en">
    <?php include 'includes/header.php';?>
<body>
    <div id="content">
        <h4>All Students</h4>
        <div class="employee-search col-sm-12 col-md-6 form-group my-3">
            <form action="#" method="get" class="d-flex flex-row">
                <select name="" id="search-by" class="form-control mx-3">
                    <option value="0">--search by--</option>
                    <option value="name">By Name</option>
                    <option value="department">By Department</option>
                </select>
                <input type="text" class="form-control" placeholder="Search for students...">
            </form>
        </div>
        <table>
            <?php all_employees();?>
        </table>
    </div>
    <script src="main.js"></script>
    <script>
        $(document).ready(function(){
            //Deleting an employee
            $('td > .delete').on('click', function(){
                if(!confirm('Are you sure?')){
                    $(this).preventDefault();
                }
                else{
                    var id = $(this).val();
                    $.ajax({
                        url: "server/delete-employee.php",
                        data: {id: id},
                        method: 'post',
                        success: function (response) {
                            if(response){
                                location.reload();
                            }
                        }
                    });
                }
            })

            //Declaring an employee under leave
            $('td > .leave').on('click', function(){
                var id = $(this).val();
                $.ajax({
                    url: "server/leave-employee.php",
                    data: {id: id},
                    method: 'post',
                    success: function (response) {
                        if(response){
                            location.reload();
                            alert('Successful');
                        }
                    }
                });
            })

            //searching an employee
            $('.employee-search form input').keyup(function(){
                if($('.employee-search form select').children('option:selected').val() == '0'){
                    alert("Search by what?");
                    $('.employee-search form input').val('');
                }
                else{
                    var word = $(this).val();
                    var search_by = $('.employee-search form select').children('option:selected').val();
                    $.ajax({
                        url: "server/search-employee.php",
                        method: 'get',
                        data: {word: word, search_by: search_by},
                        success: function (response) {
                            if(response != ''){
                                $('table').html(response);
                                //deleting row
                                    $('td > .delete').on('click', function(){
                                    var id = $(this).val();
                                    $.ajax({
                                        url: "server/delete-employee.php",
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
                        }
                    });
                }
            })
        })
    </script>
</body>
<?php include 'includes/footer.php' ?>
</html>