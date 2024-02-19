<!DOCTYPE html>
<?php $title = 'In Leave Employees';?>
<html lang="en">
    <?php include 'includes/header.php';?>
<body>
    <div id="content">
        <h4>Employees under Leave</h4>
        <table>
            <?php under_leave();?>
        </table>
    </div>
    <script src="main.js"></script>
    <script>
        $(document).ready(function(){
            $('td > button').on('click', function(){
                var id = $(this).val();
                $.ajax({
                    url: "server/employee-back.php",
                    data: {id: id},
                    method: 'post',
                    success: function (response) {
                        if(response){
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