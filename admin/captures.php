<!DOCTYPE html>
<?php $title = 'Schedule Meeting';?>
<html lang="en">
    <?php include 'includes/header.php';?>
<body>
    <style>
        #content{
            overflow-x: hidden;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 7% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        #unapproved{
            max-height: 70vh;
            overflow-y: auto;
        }
        @media only screen and (max-width: 750px){
            .modal-content {
                width: 85%;
                margin: 15% auto;
            }
        }
    </style>
    <div id="content">
        <h4>Meetings</h4>
        <button class="btn btn-sm btn-info mb-3" id="new-meeting" onclick="openModal()">New Meeting</button>
        <table id="unapproved" class="col-md-12" style="overflow-x: auto;">
            <thead>
                <tr>
                    <th>Date Scheduled</th>
                    <th>Time</th>
                    <th>Link Used</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_id = $_SESSION['admin-id'];
                $sql = "SELECT * FROM meetings WHERE user_id = $user_id";
                $run = mysqli_query($connection, $sql);
                $rows = mysqli_num_rows($run);
                if($rows > 0){
                    while($fetch = mysqli_fetch_assoc($run)){
                        ?>
                        <tr>
                        <td><?php echo $fetch['date']?></td>
                        <td><?php echo $fetch['time']?></td>
                        <td><?php echo $fetch['link']?></td>
                        <td><?php echo $fetch['note']?></td>
                        <td><button value="<?php echo $fetch['id']?>" class="btn btn-sm btn-danger delete">Delete</button></td>
                        </tr>
                        <?php
                    }
                }?>
            </tbody>
        </table>
    </div>
    <!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>New Meeting</h2>
        <form action="server/meetings.php" method="post">
            <div class="form-group mb-2">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group mb-2">
                <label for="time">Time:</label>
                <input type="time" class="form-control" id="time" name="time" required>
            </div>
            <div class="form-group mb-2">
                <label for="link">Link:</label>
                <input type="text" class="form-control" id="link" name="link" required>
            </div>
            <div class="form-group mb-2">
                <label for="note">Note:</label>
                <textarea name="note" class="form-control" id="note" cols="30" rows="3" style="resize: none;"></textarea>
            </div>
            <div class="form-group mb-2">
                <button class="btn btn-info" type="submit" name="save">Save & Share</button>
            </div>
        </form>
    </div>

</div>
    <script src="main.js"></script>
    <script>
        // JavaScript to handle modal functionality
    function openModal() {
        document.getElementById('myModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

    // Close the modal if the user clicks outside of it
    window.onclick = function (event) {
        var modal = document.getElementById('myModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }

    $(document).ready(function(){
        $('.delete').on('click', function(){
            var meeting_id = $(this).val();
            if(confirm('Are you sure?')){
                $.ajax({
                    type: "post",
                    url: "server/delete-meeting.php",
                    data: {meeting_id: meeting_id},
                    dataType: "text",
                    success: function (response) {
                        console.log(response);
                        if(response == '1'){
                            location.reload();
                        }
                        else if(response == '0'){
                            alert('Something went wrong!');
                        }
                    }
                });
            }
        })
    })
    </script>
</body>
</html>