<!DOCTYPE html>
<?php $title = 'Reports';?>
<html lang="en">
    <?php include 'includes/header.php';?>
<body>
    <style>
        #name button > .fa-minus{
            display: none;
        }
    </style>
    <div id="content">
        <h4>Tasks Done</h4>
        <div id="tasks">
            <div id="row" class="form-group w-100">
                <form action="#" method="get" class="d-flex flex-row flex-nowrap" style="width: 100%">
                    <input type="date" name="date" id="date" class="form-control w-50" style="margin-right: 10px;" placeholder="Insert date...">
                    <input type="text" id="employee_name" class="form-control" placeholder="Search based on Student's name...">
                </form>
            </div>
            <div id="contains"><?php tasks_for_admin();?></div>
        </div>
    </div>
    <script src="main.js"></script>
    <script>
        //expanding Tasks rows
        $(window).ready(function(){
            $(document).on('click', '#name button', function(){
                if($(this).closest('#row').height() <= 55){
                    $(this).closest('#row').css('height', 'fit-content');
                    $(this).children('.fa-plus').hide();
                    $(this).children('.fa-minus').show();

                }
                else{
                    $(this).closest('#row').css('height', '55px');
                    $(this).children('.fa-plus').show();
                    $(this).children('.fa-minus').hide();
                }
            })

            $('#date').on('change', function(){
                var text = $(this).val();
                $.ajax({
                    url: "server/search_task.php",
                    data: {text: text},
                    method: 'post',
                    success: function (response) {
                        if(response){
                            $('#tasks #contains').html(response);
                        }
                    }
                });
            })

            $('#employee_name').on('input', function(){
                var text = $(this).val();
                $.ajax({
                    url: "server/search_task_name.php",
                    data: {text: text},
                    method: 'post',
                    success: function (response) {
                        if(response){
                            $('#tasks #contains').html(response);
                        }
                    }
                });
            })
        })
    </script>
</body>
<?php include 'includes/footer.php' ?>
</html>