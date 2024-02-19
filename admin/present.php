<!DOCTYPE html>
<?php $title = 'Employees Present Today';?>
<html lang="en">
    <?php include 'includes/header.php';?>
<body>

    <div id="content">
        <h4>Students Present Today</h4>
        <div class="employee-present w-50 form-group my-3">
            <form action="#" method="get">
                <input type="text" class="form-control" placeholder="Search for Students present...">
            </form>
        </div>
        <table>
            <?php present_today2()?>
        </table>
    </div>
    <script src="main.js"></script>
    <script>
        $('.employee-present form input').on('keyup', function(){
            var search = $(this).val();
            $.ajax({
                url: "server/today.php",
                data: {search: search},
                method: 'get',
                success: function (response) {
                    $('table').html(response);
                }
            });
        })
    </script>
</body>
<?php include 'includes/footer.php' ?>
</html>