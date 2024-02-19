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
        form{
            margin: 20px auto;
            width: 50%;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }
        form #timeEntryForm{
            width: 100%;
            display: flex;
            flex-direction: column;
        }
        form #timeEntryForm input, form #timeEntryForm select, form #timeEntryForm textarea, form #timeEntryForm button{
            margin-bottom: 20px;
        }
        form #submit{
            margin-left: 75%;
            background: rgb(0, 0, 69);
            color: #fff;
            margin-top: 20px;
        }
        .tox .tox-promotion, .tox:not([dir=rtl]) .tox-statusbar__branding{
            display: none !important;
        }
        table {
            width: 100%;
            border: 1.5px solid black;
        }
        table th{
            border: 1.5px solid black;
        }
        table td{
            border: 1px solid;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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
            form{
                width: 100%;
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
    <div id="outer">
        <h4>Fill what you did today</h4>
        <form action="server/report.php" method="post" enctype="multipart/form-data">
            <div id="timeEntryForm">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date">
                <label for="timeIn">Time In:</label>
                <input type="time" name="timein" class="form-control" id="timeIn">
                <label for="placeofwork">Place of Work:</label>
                <select name="placeOfWork" id="placeOfWork" class="form-control">
                    <option value="0">--place of work--</option>
                    <?php branch_selection();?>
                </select>
                <label for="remarks">Remarks:</label>
                <textarea id="remarks" name="remarks" class="remarks form-control" rows="13"></textarea>
                <label for="picture" class="mt-2">Picture (optional)</label>
                <input type="file" id="picture" name="picture" accept=".png, .jpg, .jpeg">
                <label for="file" class="mt-2">PDF/Excel file (Optional)</label>
                <input type="file" id="file" name="file" accept=".pdf, .xls, .xlsx">
                <button  id="entry-button" class="btn w-25 btn-secondary mt-2">Preview</button>
            </div>
        
            <table id="timeSheet">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Place of Work</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <button class="btn w-25" name="submit" id="submit" type="submit">Submit</button>
        </form>
    </div>
    <script src="admin/libraries/jquery-3.6.0.min.js"></script>
    <script>
        //adding editing features to remarks
        tinymce.init({
                selector: '.remarks'
            });

            // function getLocation() {
            //     if (navigator.geolocation) {
            //         navigator.geolocation.getCurrentPosition(showPosition, showError);
            //     } else {
            //         console.error("Geolocation is not supported by this browser.");
            //     }
            // }

            // function showPosition(position) {
            //     var latitude = position.coords.latitude;
            //     var longitude = position.coords.longitude;

            //     console.log("Your location: Latitude " + latitude + ", Longitude " + longitude);
            // }

            // function showError(error) {
            //     switch (error.code) {
            //         case error.PERMISSION_DENIED:
            //             console.error("User denied the request for Geolocation.");
            //             break;
            //         case error.POSITION_UNAVAILABLE:
            //             console.error("Location information is unavailable.");
            //             break;
            //         case error.TIMEOUT:
            //             console.error("The request to get user location timed out.");
            //             break;
            //         case error.UNKNOWN_ERROR:
            //             console.error("An unknown error occurred.");
            //             break;
            //     }
            // }
            // getLocation();

        //prevent preview button from submitting form
        $('form #entry-button').on('click', function(e){
            e.preventDefault();
        })

        //disabling timout button
        $('form #timeOut').prop('disabled', true);

        // Add javascript below


        $('#entry-button').click(function(){
            const date = $('#date').val();
            const place = $('#placeOfWork').val();
            const timein = $('#timeIn').val();
            const remarks = tinyMCE.activeEditor.getContent({format : 'text'});

            var add = ("<tr><td>"+date+"</td><td>"+timein+"</td><td>"+place+"</td><td>"+remarks+"</td><td><i class='fa-solid fa-trash'></i></td></tr>");
            $('#timeSheet tbody').append(add);

            //deleting a row
            $('tbody .fa-trash').on('click', function(){
                $(this).parent().parent().remove();
            })
        })

        //report validation
        $('#submit').on('click', function(e){
            if($('#date').val() == 0){
                e.preventDefault();
                $('#date').css('border', '1px solid red');
                $('#date').on('change', function(){
                    if($('#date').val() != ''){
                        $('#date').css('border', '1px solid green');
                    }
                })
            }
            else if($('#timeIn').val() == 0){
                e.preventDefault();
                $('#timeIn').css('border', '1px solid red');
                $('#timeIn').on('change', function(){
                    if($('#timeIn').val() != ''){
                        $('#timeIn').css('border', '1px solid green');
                    }
                })
            }
            else if($('#placeOfWork').children('option:selected').val() == '0'){
                e.preventDefault();
                $('#placeOfWork').css('border', '1px solid red');
                $('#placeOfWork').on('change', function(){
                    if($('#placeOfWork').children('option:selected').val() != '0'){
                        $('#placeOfWork').css('border', '1px solid green');
                    }
                })
            }
            else if(tinyMCE.activeEditor.getContent({format : 'text'}) == ''){
                e.preventDefault();
                alert('Remarks empty!');
            }
        })

        //toggling menu in small screens
        $('#mini-menu').on('click', function () {
            if ($('#options').hasClass('toggleMenu')) {
                $('#options').removeClass('toggleMenu');
            }
            else {
                $('#options').addClass('toggleMenu');
            }
        })
    </script>
</body>
</html>