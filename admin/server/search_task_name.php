<?php
session_start();
include '../db-connection/connection.php';

if(isset($_POST['text'])){
    $text = $_POST['text'];

        // $sql = "SELECT * FROM report WHERE date LIKE '$text'";
        $sql = "SELECT * FROM report AS r JOIN employee AS e ON R.employee_id = e. employee_id WHERE e. fname LIKE '$text%' OR e. lname LIKE '$text%'";
        $run = mysqli_query($connection, $sql);
        $rows = mysqli_fetch_assoc($run);

        if($rows > 0){
   
            foreach ($run as $key => $details) {?>
                <div id="row">
                <div id="name"><p><button class="btn btn-sm mb-1"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-minus"></i></button><?php echo $details['fname'].' '. $details['lname']?></p></div>
                <div id="working-hours"><p>From: <?php echo $details['time_in']?></p></div>
                <div id="working-hours"><p>To: <?php echo $details['timeout']?></p></div>
                <div id="working-hours"><p><?php echo $details['place_of_work']?></p></div>
                <div id="remarks"><?php echo $details['remarks']?>
                    <p id="picture">
                        <img src="<?php echo '../uploads/img/'.$details['picture']?>" alt="picture">
                    </p>
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
            <div id="row">No such employee</div
       <?php }
}
?>