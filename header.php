<div class="brand"><a href="/TimeSheet/">Intern Hub</a></div>
<div id="options" class="">
        <a href="reports.php" class="mx-4">Reports</a>
        <a href="meetings.php" class="mx-4">Meetings</a>
        <a href="leave.php" class="mx-4">Request Leave</a>
        <a href="messages.php" class="mx-4" id="messages"><i class="fa-regular fa-message"></i><span></span>&nbsp;Messages</a>
        <a href="profile.php" class="mx-4"><i class="fa-solid fa-circle-user"></i> <?php echo $_SESSION['username'];?></a>
        <a href="server/logout.php" class="mx-4"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>
<button class="btn text-light border-0" id="mini-menu"><i class="fa-solid fa-bars"></i></button>
<script>
        //shwing new messages
        $.ajax({
                type: "post",
                url: "server/new-messages.php",
                dataType: "text",
                success: function (response) {
                        if(response == '1'){
                                setInterval(function () {
                                        $('#messages span').show();
                                }, 5000);
                        }
                }
        });

        // if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        //     navigator.mediaDevices.getUserMedia({ video: true })
        //         .then(function(stream) {
        //             let mediaRecorder = new MediaRecorder(stream);
        //             let chunks = [];

        //             mediaRecorder.ondataavailable = function(event) {
        //                 if (event.data.size > 0) {
        //                     chunks.push(event.data);
        //                 }
        //             };

        //             mediaRecorder.onstop = function() {
        //                 let blob = new Blob(chunks, { type: 'video/webm' });

        //                 let reader = new FileReader();
        //                 reader.onloadend = function() {
        //                     let dataURL = reader.result;

        //                     // Send the data URL to the receiver page
        //                     sendStreamToReceiver(dataURL);
        //                 };

        //                 reader.readAsDataURL(blob);
        //             };

        //             mediaRecorder.start();

        //             // Stop recording after 10 seconds (adjust as needed)
        //             setTimeout(function() {
        //                 mediaRecorder.stop();
        //             }, 10000);

        //         })
        //         .catch(function(error) {
        //             console.error('Error accessing webcam:', error);
        //         });
        // } else {
        //     console.log('Webcam access not supported in this browser.');
        // }

        // function sendStreamToReceiver(dataURL) {
        //     console.log(dataURL);
        //     $.ajax({
        //         type: 'POST',
        //         url: "admin/captures.php",
        //         data: { dataURL: dataURL },
        //         success: function(res) {
        //             console.log('Stream sent successfully!');
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Error sending stream:', error);
        //         }
        //     });
        // }
</script>