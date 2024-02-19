<?php
$username = 'root';
$password = '';
$host = 'localhost';
$db_name = 'timesheet';

$connection = new mysqli($host, $username, $password, $db_name);
//employee
function employee(){
    global $connection;
    $sql = "SELECT * FROM employee";
    $run = mysqli_query($connection, $sql);?>
    <option value="">--select student--</option>
    <?php
    while($details = mysqli_fetch_assoc($run)){?>
         <option value="<?php echo $details['employee_id']?>"><?php echo $details['fname'].' '.$details['lname']?></option>
<?php }
}
//fetching branches
function fetch_branches(){
    global $connection;
    $sql = "SELECT * FROM branch";
    $run = mysqli_query($connection, $sql);?>
    <tr>
        <th>Organization Number</th>
        <th>Organization Name</th>
        <th>Actions</th>
    </tr>

    <?php while($details = mysqli_fetch_assoc($run)){?>
         <tr>
            <td><?php echo $details['branch_number']?></td>
            <td><?php echo $details['branch_name']?></td>
            <td><button class="btn btn-sm btn-danger" value="<?php echo $details['id']?>">Delete</button></td>
        </tr>
<?php }
}

//fetch depart for admin registering
function departments_for_reg(){
    global $connection;
    $sql = "SELECT * FROM department";
    $run = mysqli_query($connection, $sql);?>
    <option value="">--department--</option>
    <?php
    while($details = mysqli_fetch_assoc($run)){?>
        <option value="<?php echo $details['department_number']?>"><?php echo $details['department_name']?></option>
    <?php
    }
}

//fetching departments
function fetch_departments(){
    global $connection;
    $sql = "SELECT * FROM department";
    $run = mysqli_query($connection, $sql);?>
    <tr>
        <th>Department Number</th>
        <th>Department Name</th>
        <th>Actions</th>
    </tr>

    <?php while($details = mysqli_fetch_assoc($run)){?>
         <tr>
            <td><?php echo $details['department_number']?></td>
            <td><?php echo $details['department_name']?></td>
            <td><button class="btn btn-sm btn-danger" value="<?php echo $details['id']?>">Delete</button></td>
        </tr>
<?php }
}

//leave requests
function leave_requests(){
    global $connection;
    $dept = $_SESSION['department'];
    $sql = "SELECT * FROM leave_request order by date";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);?>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Student Department</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
<?php
        if($rows > 0){
            while($details = mysqli_fetch_assoc($run)){
                $id = $details['employee_id'];
                $sql2 = "SELECT * FROM employee WHERE employee_id = $id";
                $run2 = mysqli_query($connection, $sql2);
                $details2 = mysqli_fetch_assoc($run2);

                if($details2['department'] == $dept){
                ?>
                <tr>
                    <td><?php echo $details2['fname'].' '.$details2['lname']?></td>
                    <td><?php echo $details2['department']?></td>
                    <td><?php echo date('d-m-Y', strtotime($details['from_date']))?></td>
                    <td><?php echo date('d-m-Y', strtotime($details['to_when']))?></td>
                    <td>
                        <?php
                        if($details['accepted'] == 'Yes'){?>
                            <div class="alert alert-success py-1 m-0">Accepted</div>
                        <?php
                        }
                        else if($details['accepted'] == 'No'){?>
                            <div class="alert alert-danger py-1 m-0">Declined</div>
                        <?php
                        }
                        else if($details['accepted'] == 'Pending'){?>
                            <div class="alert alert-warning py-1 m-0">Pending</div>
                        <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($details['accepted'] == 'Yes'){?>
                            <button class="btn btn-sm btn-primary view" value="<?php echo $details['id']?>">View</button>
                        <?php
                        }
                        else if($details['accepted'] == 'No'){?>
                            <button class="btn btn-sm btn-primary view" value="<?php echo $details['id']?>">View</button>
                        <?php
                        }
                        else if($details['accepted'] == 'Pending'){?>
                            <button class="btn btn-sm btn-primary view" value="<?php echo $details['id']?>">View</button>
                            <button class="btn btn-sm btn-success approve" value="<?php echo $details['id']?>">Approve</button>
                            <button class="btn btn-sm btn-danger decline" value="<?php echo $details['id']?>">Decline</button>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php }}
        } ?>
      </tbody>
      <?php
}

//leave requests
function personal_leave_requests(){
    global $connection;
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM leave_request WHERE employee_id = $id order by date";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);?>
            <thead>
                <tr>
                    <th>Reguest Date</th>
                    <th>Leave Start Date</th>
                    <th>Leave End Date</th>
                    <th>Reason</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
<?php
        if($rows > 0){
            while($details = mysqli_fetch_assoc($run)){
                ?>
                <tr>
                    <td><?php echo date("d-m-Y",strtotime($details['date']))?></td>
                    <td><?php echo date("d-m-Y",strtotime($details['from_date']))?></td>
                    <td><?php echo date("d-m-Y",strtotime($details['to_when']))?></td>
                    <td><?php echo $details['reason']?></td>
                    <td>
                        <?php
                        if($details['accepted'] == 'Yes'){?>
                            <div class="alert alert-success py-1 m-0">Accepted</div>
                        <?php
                        }
                        else if($details['accepted'] == 'No'){?>
                            <div class="alert alert-danger py-1 m-0">Declined</div>
                        <?php
                        }
                        else if($details['accepted'] == 'Pending'){?>
                            <div class="alert alert-warning py-1 m-0">Pending</div>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php }
        } ?>
      </tbody>
      <?php
}

//leave requests notification
function leave_requests_notification(){
    global $connection;
    $dept = $_SESSION['department'];
    $sql = "SELECT * FROM leave_request WHERE accepted = 'Pending'";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);
    $details = mysqli_fetch_assoc($run);

    if($rows > 0){
        $sql2 = "SELECT * FROM employee WHERE employee_id = '".$details['employee_id']."'";
        $run2 = mysqli_query($connection, $sql2);
        $details2 = mysqli_fetch_assoc($run2);
        if($details2['department'] == $dept){?>
            <a href="leave_request.php">New leave request(s)</a>
            <?php
        }
        else{?>
            <p>No notifications yet</p>
        <?php
        }
    }
    else{?>
        <p>No notifications yet</p>
    <?php
    }
}

//fetching unapproved employees
function unapproved(){
    global $connection;
    $dept = $_SESSION['department'];
    $sql = "SELECT * FROM employee WHERE approval = 'Not Approved' and department = $dept";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);?>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Student Department</th>
                    <th>Approval</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
<?php
        if($rows > 0){
            while($details = mysqli_fetch_assoc($run)){?>
                <tr>
                    <td><?php echo $details['fname'].' '.$details['lname']?></td>
                    <td><?php echo $details['department']?></td>
                    <td><?php echo $details['approval']?></td>
                    <td><?php echo $details['phone']?></td>
                    <td><button class="btn btn-sm btn-success" value="<?php echo $details['employee_id']?>">Approve</button></td>
                </tr>
            <?php }
        } ?>
      </tbody>
      <?php
}

//fetching all employees
function all_employees(){
    global $connection;
    $dept = $_SESSION['department'];
    $sql = "SELECT * FROM employee WHERE approval ='Approved'AND department = $dept";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);?>
            <tr>
                <th>Student Name</th>
                <th>Student Department</th>
                <th>Phone Number</th>
                <th>Duration in Work/Field</th>
                <th>In Leave</th>
                <th>Actions</th>
            </tr>
<?php
        if($rows > 0){
            while($details = mysqli_fetch_assoc($run)){
                $employee_id = $details['employee_id'];
                $sql2 = "SELECT * FROM report WHERE employee_id = $employee_id";
                $run2 = mysqli_query($connection, $sql2);
                $number = mysqli_num_rows($run2);

                $department_number = $details['department'];
                $sql3 = "SELECT * FROM department WHERE department_number = $department_number";
                $run3 = mysqli_query($connection, $sql3);
                $details3 = mysqli_fetch_assoc($run3);

                $totalDays = $number;

                $years = floor($totalDays / 365);
                $remainingDays = $totalDays % 365;

                // Calculate months
                $months = floor($remainingDays / 30);
                $remainingDays %= 30;

                // Calculate weeks
                $weeks = floor($remainingDays / 7);
                $remainingDays %= 7;

                // Calculate days
                $days = $remainingDays;

                // Output the result for non-zero components
                $result = [];
                if ($years > 0) {
                    $result[] = "$years years";
                }
                if ($months > 0) {
                    $result[] = "$months months";
                }
                if ($weeks > 0) {
                    $result[] = "$weeks weeks";
                }
                if ($days > 0) {
                    $result[] = "$days days";
                }
                ?>
                <tr>
                    <td><?php echo $details['fname'].' '.$details['lname']?></td>
                    <td><?php echo $details3['department_name']?></td>
                    <td><?php echo $details['phone']?></td>
                    <td><?php echo implode(', ', $result)?></td>
                    <td><?php echo $details['under_leave']?></td>
                    <td><button class="btn btn-sm btn-danger delete" value="<?php echo $details['employee_id']?>">Delete</button><?php if($details['under_leave'] == 'No'){?><button value="<?php echo $details['employee_id']?>" class="btn btn-sm btn-warning leave">In Leave</button><?php }?></td>
                </tr>
            <?php }
        }
        else{?>
            <tr><td>No student</td></tr>
      <?php }
}

//fetching all employees under leave
function under_leave(){
    global $connection;
    $dept = $_SESSION['department'];
    $sql = "SELECT * FROM employee WHERE under_leave ='Yes' AND department = $dept";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);?>
            <tr>
                <th>Student Name</th>
                <th>Student Department</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
<?php
        if($rows > 0){
            while($details = mysqli_fetch_assoc($run)){?>

                <tr>
                    <td><?php echo $details['fname'].' '.$details['lname']?></td>
                    <td><?php echo $details['department']?></td>
                    <td><?php echo $details['phone']?></td>
                    <td><button class="btn btn-sm btn-success" value="<?php echo $details['employee_id']?>">Back to work</button></td>
                </tr>
            <?php }
        }
        else{?>
            <tr><td>No student on leave</td></tr>
      <?php }
}

//Total employees
function total_employees(){
    global $connection;
    $dept = $_SESSION['department'];
    $sql = "SELECT * FROM employee WHERE approval ='Approved' AND department = $dept";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);
        echo $rows;
}

//present employees today
function present_today(){
    global $connection;
    $dept = $_SESSION['department'];
    $sql = "SELECT * FROM report WHERE date = CURDATE()";
    $run = mysqli_query($connection, $sql);
    $rows = 0;
    
    while($details = mysqli_fetch_assoc($run)){
        $employee_id = $details["employee_id"];
        $sql2 = "SELECT * FROM employee WHERE employee_id = '$employee_id'";
        $run2 = mysqli_query($connection, $sql2);
        $details2 = mysqli_fetch_assoc($run2);
        if($details2['department'] == $dept){
            $rows++;
        }
    }
    echo $rows;
}

//Total Branches
function total_branches(){
    global $connection;
    $sql = "SELECT branch_number FROM branch";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);
        echo $rows;
}


//department selection for the employee
function department_selection(){
    global $connection;
    $sql = "SELECT * FROM department";
    $run = mysqli_query($connection, $sql);
    
    while($details = mysqli_fetch_assoc($run)){?>
        <option value="<?php echo $details['department_number']?>"><?php echo $details['department_name']?></option>
    <?php }
}

//branch selection
function branch_selection(){
    global $connection;
    $sql = "SELECT * FROM branch";
    $run = mysqli_query($connection, $sql);
    
    while($details = mysqli_fetch_assoc($run)){?>
        <option value="<?php echo $details['branch_name']?>"><?php echo $details['branch_name']?></option>
    <?php }
}

//fetching tasks for admin
function tasks_for_admin(){
    global $connection;
    $dept = $_SESSION['department'];
    $admin_id = $_SESSION['admin-id'];

    $sql = "SELECT * FROM report AS r JOIN employee AS e ON R.employee_id = e. employee_id WHERE e.department = $dept order by time_uploaded DESC";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);
        if($rows > 0){
            while($details = mysqli_fetch_array($run)){
                $department_number = $details['department'];
                $sql2 = "SELECT * FROM department WHERE department_number = $department_number";
                $run2 = mysqli_query($connection, $sql2);
                $rows2 = mysqli_num_rows($run2);
            ?>
            <div id="row">
                <div id="name"><p><button class="btn btn-sm mb-1"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-minus"></i></button><?php echo $details['fname'].' '. $details['lname']?></p></div>
                <div id="working-hours"><p>From: <?php echo $details['time_in']?></p></div>
                <div id="working-hours"><p>To: <?php echo $details['timeout']?></p></div>
                <div id="working-hours"><p>Last Login: <?php $dateTime = new DateTime($details['last_login']); $timeOnly = $dateTime->format('H:i:s'); echo $timeOnly?></p></div>
                <div id="working-hours"><p><?php echo $details['place_of_work']?></p></div>
                <div id="remarks"><?php echo $details['remarks']?>
                    <?php
                    if($details['picture'] != null){
                    ?>
                    <p id="picture">
                        <img src="<?php echo '../uploads/img/'.$details['picture']?>" alt="picture">
                    </p>
                    <?php 
                    }
                    else{?>
                        <p>No image uploaded</p>
                        <?php
                    }
                    ?>
                    <p id="download-link">
                        <?php if (!empty($details['file'])) : ?>
                            <a href="data:application/octet-stream;base64,<?php echo base64_encode($details['file']); ?>" download=<?php echo $details['fname']."_".date('d-m-Y', strtotime($details['date'])).".pdf"?>>Download File attached</a>
                        <?php else : ?>
                            <p>No file attached</p>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <?php }
        }
        else{?>
            <div id="row">No task...</div>
      <?php }
}

//present employees in detail
function present_today2(){
    global $connection;
    $dept = $_SESSION['department'];
    $sql = "SELECT * FROM report AS r JOIN employee AS e ON R.employee_id = e. employee_id WHERE date = CURDATE() AND e.department = $dept order by time_uploaded ASC";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);?>
            <tr>
                <th>Student Name</th>
                <th>Student Department</th>
                <th>Time in</th>
                <th>Time Out</th>
                <th>Phone Number</th>
            </tr>
<?php
        if($rows > 0){
            while($details = mysqli_fetch_assoc($run)){?>
                <tr>
                    <td><?php echo $details['fname'].' '.$details['lname']?></td>
                    <td><?php echo $details['department']?></td>
                    <td><?php echo $details['time_in']?></td>
                    <td><?php echo $details['timeout']?></td>
                    <td><?php echo $details['phone']?></td>
                </tr>
            <?php }
        }
        else{?>
            <tr><td>No student was present today</td></tr>
      <?php }
}

//fetching admins
function fetch_admins(){
    global $connection;
    $sql = "SELECT * FROM admin";
    $run = mysqli_query($connection, $sql);?>
    <tr>
        <th>Admin Name</th>
        <th>Admin Email</th>
        <th>Department</th>
        <th>Actions</th>
    </tr>

    <?php while($details = mysqli_fetch_assoc($run)){
        $number = $details['department'];
        $sql2 = "SELECT * FROM department WHERE department_number = $number";
        $run2 = mysqli_query($connection, $sql2);
        $details2 = mysqli_fetch_assoc($run2);
        ?>
         <tr>
            <td><?php echo $details['username']?></td>
            <td><?php echo $details['email']?></td>
            <td><?php echo $details2['department_name']?></td>
            <td><button class="btn btn-sm btn-danger" value="<?php echo $details['id']?>">Delete</button></td>
        </tr>
<?php }
}

function message_notification(){
    global $connection;
    $department = $_SESSION['department'];
    $sql = "SELECT * FROM message WHERE admin_read = 'No' AND department = $department";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);
    if($rows > 0){?>
        <a href="messages.php">New message(s)</a>
        <?php
    }
    else{?>
        <p>No new messages</p>
        <?php
    }
}
?>