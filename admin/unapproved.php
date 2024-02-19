<!DOCTYPE html>
<?php $title = 'Unapproved Employees';?>
<html lang="en">
    <?php include 'includes/header.php';?>
<body>
    <div id="content">
        <h4>Unapproved Employees</h4>
        <table id="unapproved" class="col-md-8 display nowrap">
            <?php unapproved(); ?>
        </table>
    </div>
    <script src="main.js"></script>
    <script>
        $(document).ready(function(){
            //Approving an employee
            $('td > button').on('click', function(){
                var id = $(this).val();
                $.ajax({
                    url: "server/approve.php",
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
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/autofill/2.6.0/js/dataTables.autoFill.min.js"></script>
<script>
    new DataTable('#unapproved', {
    autoFill: true
});
</script>
</html>