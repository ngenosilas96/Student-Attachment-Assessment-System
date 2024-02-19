<!DOCTYPE html>
<?php $title = 'Dashboard';?>
<html lang="en">
    <?php include 'includes/header.php';?>
<body>
    <div id="content">
        <h4>Dashboard</h4>
        <div class="analysis">
            <div id="total-employees"><i class="fa-solid fa-users"></i><span>Total Students</span><p><?php total_employees()?></p></div>
            <div id="employees-today"><i class="fa-solid fa-users"></i><span>Students Present Today</span><p><?php present_today()?></p></div>
            <div id="total-branches"><i class="fa-solid fa-building"></i><span>Total Organizations</span><p><?php total_branches()?></p></div>
        </div>
    </div>
    <script src="main.js"></script>
</body>
<?php include 'includes/footer.php' ?>
</html>