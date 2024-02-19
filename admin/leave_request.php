<?php error_reporting(0)?>
<!DOCTYPE html>
<?php $title = 'Unapproved Employees';?>
<html lang="en">
    <?php include 'includes/header.php';?>
    <style>
        .view-div{
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            width: 40%;
            height: fit-content;
            background: #fff;
            z-index: 20;
            box-shadow: 0 0 15px rgba(0, 0, 0, .3);
            border-radius: 5px;
            display: none;
            padding: 15px;
        }
        @media(max-width: 690px){
            .view-div{
                width: 80%;
            }
        }
    </style>
<body>
    <div id="content">
        <h4>Leave Requests</h4>
        <table id="unapproved" class="col-md-8 display nowrap">
            <?php leave_requests() ?>
        </table>
        <div class="view-div">
            <h5>Leave Request</h5>
            <p id="name">Kevin</p>
            <p id="department">ICT</p>
            <p id="from-d">From: date</p>
            <p id="to-d" class="mb-3">To: date</p>
            <div id="reason">Reason</div>
            <button class="btn btn-sm btn-secondary" id="close">Close</button>
        </div>
    </div>

    <script src="main.js"></script>
    <script>
        $(document).ready(function(){
            //view request
            $('td > .view').on('click', function(){
                var id = $(this).val();
                $.ajax({
                    url: "server/view_request.php",
                    data: {id: id},
                    method: 'post',
                    dataType: 'json',
                    success: function (response) {
                        $('#name').text(response.employee);
                        $('#department').text(response.department);
                        $('#from-d').text('From: '+response.from);
                        $('#to-d').text('To: '+response.to);
                        $('#reason').html('Reason:<br>'+response.reason);
                        $('.view-div').show();
                    }
                });
                $('.view-div #close').on('click', function(){
                    $('.view-div').hide();
                })
            })

            //Approve request
            $('td > .approve').on('click', function(){
                var id = $(this).val();
                $.ajax({
                    url: "server/approve_request.php",
                    data: {id: id},
                    method: 'post',
                    dataType: 'text',
                    success: function (response) {
                        if(response == '1'){
                            alert('Approved successfully!');
                            location.reload();
                        }
                        else if(response == '2'){
                            alert('Approval Failed!');
                        }
                    }
                });
            })

            //Decline request
            $('td > .decline').on('click', function(){
                var id = $(this).val();
                $.ajax({
                    url: "server/decline_request.php",
                    data: {id: id},
                    method: 'post',
                    dataType: 'text',
                    success: function (response) {
                        if(response == '1'){
                            alert('Declined successfully!');
                            location.reload();
                        }
                        else if(response == '2'){
                            alert('Decline Failed!');
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