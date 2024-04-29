<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
    <title>Intern Hub</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logos.png">
    <link rel="stylesheet" href="employee.css">
    <link rel="stylesheet" href="admin/libraries/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/libraries/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.6.0/css/autoFill.dataTables.min.css">
    <script src="admin/libraries/jquery-3.6.0.min.js"></script>
    <script src="admin/libraries/tinymce/tinymce.min.js"></script>
    <?php
    if(isset($_SESSION['username']) && (time() - $_SESSION['login-time']) <= 36000){
    ?>
    <div class="navbar px-3 pt-3">
        <?php include 'header.php';?>
    </div><?php } else{ echo '<script>window.location.assign("login.php")</script>';}?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Signika+Negative:wght@500&display=swap');
        *{
            font-family: 'Signika Negative', sans-serif;
        }
        .navbar{
            background: rgb(0, 0, 69);
            display: flex;
            flex-direction: row;
            align-items: baseline;
            justify-content: space-between;
            height: fit-content;
        }
        .navbar .brand a{
            font-size: 20px;
            font-weight: 500;
        }
        .navbar a{
            text-decoration: none;
            color: #f2f2f2;
        }
        #outer{
            width: 95%;
            margin-left: 50%;
            transform: translateX(-50%);
            margin-top: 25px;
            height: 85%;
            position: fixed;
            background: #f5f5f5;
            border-radius: 5px;
            border: 1px solid #ececec;
            overflow-y: scroll;
        }
        #outer h4{
            width: 95%;
            border-bottom: 1px solid #d1d1d1;
            margin: 20px;
            padding-bottom: 7px;
        }
        .tox .tox-promotion, .tox:not([dir=rtl]) .tox-statusbar__branding{
            display: none !important;
        }
        table {
            width: 100%;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        #initials{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }
        #initials .form-group{
            display: flex;
            flex-direction: column;
        }
        #pdf{
            float: right;
            margin-bottom: 10px;
        }

        .disabled{
            pointer-events: none;
            cursor: none;
        }

        @media only screen and (max-width: 900px){
            .navbar a{
                font-size: 25px;
            }
            .navbar #options a{
                font-size: 18px;
            }
            #outer{
                overflow-x: hidden;
            }
            #outer h4{
                font-size: 30px;
            }
            #unapproved{
                overflow-x: scroll !important;
            }
        }

        @media only screen and (max-width: 500px){
            .navbar a{
                font-size: 15px !important;
            }
            #outer h4{
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <?php include 'admin/functions/functions.php' ?>
    <div id="outer" class="px-3">
        <h4>Meetings</h4>
        <table id="unapproved" class="w-100 display nowrap mx-3">
            <thead>
                <tr>
                    <th>From</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id = $_SESSION['id'];
                $sql1 = "SELECT * FROM employee WHERE employee_id = $id";
                $run1 = mysqli_query($connection, $sql1);
                $fetch_employee = mysqli_fetch_assoc($run1);
                $dept = $fetch_employee['department'];

                $sql = "SELECT * FROM meetings WHERE department = $dept";
                $run = mysqli_query($connection, $sql);
                $rows = mysqli_num_rows($run);
                date_default_timezone_set('Africa/Nairobi');
                
                $currentDate = date('Y-m-d');
                if($rows > 0){
                    while($fetch = mysqli_fetch_assoc($run)){
                        $admin_id = $fetch['user_id'];
                        $sql2 = "SELECT * FROM admin WHERE id = $admin_id";
                        $run2 = mysqli_query($connection, $sql2);
                        $fetch_admin = mysqli_fetch_assoc($run2);
                        $fetchTime = trim($fetch['time']);
                        $fetchTime = date('H:i:s', strtotime($fetchTime));
                        $currentDateTime = new DateTime();
                        $currentTime = $currentDateTime->format('H:i:s');
                ?>
                        <tr>
                        <td><?php echo $fetch_admin['username']?></td>
                        <td><?php echo $fetch['date']?></td>
                        <td><?php echo $fetch['time']?></td>
                        <td><?php echo $fetch['note']?></td>
                        <td><?php
                        if(date('Y-m-d', strtotime($fetch['date'])) == $currentDate && $currentTime >= $fetchTime ){?>
                            <a href="<?php echo $fetch['link']?>" target="_blank" class="btn btn-sm btn-info">Join</a>
                        <?php
                        }
                        else if(date('Y-m-d', strtotime($fetch['date'])) > $currentDate || date('Y-m-d', strtotime($fetch['date'])) == $currentDate && $currentTime < $fetchTime){?>
                            <a href="<?php echo $fetch['link']?>" target="_blank" class="btn btn-sm btn-warning disabled">Upcoming</a>
                            <?php
                        }
                        else if(date('Y-m-d', strtotime($fetch['date'])) < $currentDate){?>
                            <a href="<?php echo $fetch['link']?>" target="_blank" class="btn btn-sm btn-secondary disabled">Not Available</a>
                        <?php
                        }
                        ?></td>
                        </tr>
                    <?php
                    }
                }?>
            </tbody>
        </table>
    </div>
    <script src="admin/libraries/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.6.0/js/dataTables.autoFill.min.js"></script>
    <script>
        //toggling menu in small screens
        $('#mini-menu').on('click', function () {
            if ($('#options').hasClass('toggleMenu')) {
                $('#options').removeClass('toggleMenu');
            }
            else {
                $('#options').addClass('toggleMenu');
            }
        })

        new DataTable('#unapproved', {
            autoFill: true,
            scrollX: true, // Enable horizontal scrolling
            responsive: true, // Enable responsive design
        });
    </script>
</body>
</html>