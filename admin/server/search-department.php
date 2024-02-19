<?php
include '../db-connection/connection.php';

if(!empty($_GET['word'])){
    $word = $_GET['word'];
    $sql = "SELECT * FROM department WHERE department_name LIKE '$word%'";
    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);

    if($rows > 0){?>
        <tr>
                <th>Branch Number</th>
                <th>Branch Name</th>
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
    else{?>
        <tr>
            <th>Branch Number</th>
            <th>Branch Name</th>
            <th>Actions</th>
        </tr>
        <tr><td>No record found!</td></tr>
    <?php }
}