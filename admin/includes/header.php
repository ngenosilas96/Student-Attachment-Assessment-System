<head>
    <?php session_start();
    include 'db-connection/connection.php'; 
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logos.png">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="libraries/css/bootstrap.min.css">
    <link rel="stylesheet" href="libraries/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.6.0/css/autoFill.dataTables.min.css">
    <script src="libraries/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.6.0/js/dataTables.autoFill.min.js"></script>
    <title><?php echo $title?></title>

    <?php
    if(isset($_SESSION['admin-login-time']) && time() - $_SESSION['admin-login-time'] <= 36000 && isset($_SESSION['admin-username'])){
    ?>
    <?php include 'functions/functions.php' ?>

    <div class="header">
        <nav id="navbar">
            <div id="title" class="mx-3 d-flex flex-row"><i class="fa-solid fa-bars" style="margin-right: 15px"></i>Intern Hub</div>
            <div id="links" class="mx-3">
                <a href="javascript:void()" id="messages-not"><i class="fa-regular fa-message"></i><span></span></a>
                <div id="messages-not2">
                    <?php message_notification()?>
                </div>
                <a href="javascript:void()" style="margin-left: 30px;" id="notification"><i class="fa-solid fa-bell"></i>
                <div id="messages">
                    <?php leave_requests_notification()?>
                </div>
                </a>
                <a href="profile.php" style="margin-left: 30px;"><i class="fa-solid fa-circle-user"></i> <?php echo $_SESSION['admin-username']; ?></a>
            </div>
        </nav>
    </div>
    <div class="sidebar">
        <div class="top-part mb-3">
            <h6>Administrator</h6>
            <p><span></span>Online</p>
        </div>
        <div id="pages">
            <a href="./"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a href="tasks.php"><i class="fa-solid fa-briefcase"></i> Tasks Done</a>
            <a href="#" id="dropdown"><i class="fa-solid fa-users"></i> Students</a>
                <div id="dropdown-links">
                    <a href="all-employees.php"><i class="fa-solid fa-users"></i> All Students</a>
                    <a href="present.php"><i class="fa-solid fa-users"></i> Present Today</a>
                    <a href="leave_request.php"><i class="fa-solid fa-users"></i> Leave Requests</a>
                    <a href="leave.php"><i class="fa-solid fa-users"></i> Students on leave</a>
                    <a href="unapproved.php"><i class="fa-solid fa-users"></i> Unapproved Students</a>
                </div>
            <a href="branches.php"><i class="fa-solid fa-building"></i> Organizations</a>
            <a href="department.php"><i class="fas fa-table"></i> Departments</a>
            <a href="reports.php"><i class="fa-regular fa-file"></i> Reports</a>
            <a href="admins.php"><i class="fa-solid fa-user-lock"></i> Admins</a>
            <a href="captures.php"><i class="fa-solid fa-camera"></i> Live Captures</a>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sign Out</a>
        </div>
    </div>
    <?php }
    else{
        session_unset();
        session_destroy();
        echo '<script>window.location.assign("login.html")</script>';
    }
    ?>
</head>