<?php
session_start();
include '../db-connection/connection.php';

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $sql = "SELECT * FROM report AS r JOIN employee AS e ON R.employee_id = e. employee_id WHERE (fname LIKE '%$search%' OR lname LIKE '%$search%') AND date = CURDATE() order by time_uploaded ASC";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);?>
            <tr>
                <th>Employee Name</th>
                <th>Employee Department</th>
                <th>Time in</th>
                <th>Time Out</th>
                <th>Phone Number</th>
            </tr>
<?php
        if($rows > 0){
            foreach($run as $key => $details){?>
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
            <tr><td>No employee was today</td></tr>
      <?php }
}