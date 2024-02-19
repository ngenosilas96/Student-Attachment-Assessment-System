<?php
include '../db-connection/connection.php';

if(isset($_GET['word']) && isset($_GET['search_by'])){
    $word = $_GET['word'];
    $search = $_GET['search_by'];

    if($search == 'name'){
        $sql = "SELECT * FROM employee WHERE (fname LIKE '%$word%' OR lname LIKE '%$word%') AND (approval ='Approved')";
        $run = mysqli_query($connection, $sql);
        $rows = mysqli_num_rows($run);

        if($rows > 0){?>
            <tr>
                <th>Employee Name</th>
                <th>Employee Department</th>
                <th>Phone Number</th>
                <th>Under Leave</th>
                <th>Actions</th>
            </tr>
    <?php 
        while($details = mysqli_fetch_assoc($run)){?>
                <tr>
                    <td><?php echo $details['fname'].' '.$details['lname']?></td>
                    <td><?php echo $details['department']?></td>
                    <td><?php echo $details['phone']?></td>
                    <td><?php echo $details['under_leave']?></td>
                    <td><button class="btn btn-sm btn-danger delete" value="<?php echo $details['employee_id']?>" onclick="return confirm('Are you sure?')">Delete</button><?php if($details['under_leave'] == 'No'){?><button value="<?php echo $details['employee_id']?>" class="btn btn-sm btn-warning leave">Under Leave</button><?php }?></td>
                </tr>
     <?php   }
        }
        else{?>
            <tr>
                <th>Employee Name</th>
                <th>Employee Department</th>
                <th>Phone Number</th>
                <th>Under Leave</th>
                <th>Actions</th>
            </tr>
            <tr><td>No record</td></tr>
     <?php }
    }
    else if($search == 'department'){
        $sql = "SELECT * FROM employee WHERE department LIKE '%$word%' AND approval = 'Approved'";
        $run = mysqli_query($connection, $sql);
        $rows = mysqli_num_rows($run);

        if($rows > 0){?>
            <tr>
                <th>Employee Name</th>
                <th>Employee Department</th>
                <th>Phone Number</th>
                <th>Under Leave</th>
                <th>Actions</th>
            </tr>
    <?php 
        while($details = mysqli_fetch_assoc($run)){?>
            <tr>
                <td><?php echo $details['fname'].' '.$details['lname']?></td>
                <td><?php echo $details['department']?></td>
                <td><?php echo $details['phone']?></td>
                <td><?php echo $details['under_leave']?></td>
                <td><button class="btn btn-sm btn-danger delete" value="<?php echo $details['employee_id']?>" onclick="return confirm('Are you sure?')">Delete</button><?php if($details['under_leave'] == 'No'){?><button value="<?php echo $details['employee_id']?>" class="btn btn-sm btn-warning leave">Under Leave</button><?php }?></td>
            </tr>
      <?php  }
    }
    else{?>
        <tr>
                <th>Employee Name</th>
                <th>Employee Department</th>
                <th>Phone Number</th>
                <th>Under Leave</th>
                <th>Actions</th>
            </tr>
            <tr><td>No record</td></tr>
   <?php }
    }
}
?>