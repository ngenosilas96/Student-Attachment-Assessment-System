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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.6.0/css/autoFill.dataTables.min.css">
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
        .tox .tox-promotion, .tox:not([dir=rtl]) .tox-statusbar__branding{
            display: none !important;
        }
        table {
            width: 100%;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        #initials{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }
        #initials .form-group{
            display: flex;
            flex-direction: column;
        }
        #pdf{
            float: right;
            margin-bottom: 10px;
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
            #unapproved{
                overflow-x: scroll !important;
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
    <div id="outer" class="px-3">
        <h4>Generate Reports</h4>
        <div id="initials" class="col-md-5">
            <div class="form-group">
                <label for="from">From</label>
                <input type="date" id="from" class="form-control">
            </div>
            <div class="form-group">
                <label for="to">To</label>
                <input type="date" id="to" class="form-control">
            </div>
            <div class="form-group">
                <label for="">&nbsp;</label>
                <button class="btn btn-sm btn-success form-control" id="generate">Generate</button>
            </div>
        </div>
        <button class="btn btn-sm btn-danger" id="pdf" onclick="toPdf()">Export PDF</button>
        <table id="unapproved" class="w-100 display nowrap mx-3">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Place of Work</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <script src="admin/libraries/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.6.0/js/dataTables.autoFill.min.js"></script>
    <script>
        //adding editing features to remarks
        tinymce.init({
                selector: '.remarks'
            });

            $('#generate').on('click', function(){
                if($('#from, #to') != ''){
                    var from = $('#from').val();
                    var to = $('#to').val();
                    $.ajax({
                        type: "post",
                        url: "server/reports.php",
                        data: {from: from, to: to},
                        dataType: "html",
                        success: function (response) {
                            $('#unapproved tbody').html(response);
                        }
                    });
                }
                else{
                    alert('"From" and "To" dates are required!');
                }
            })

            function toPdf() {
                var doc = new jsPDF();

                var currentDate = new Date();
                var formattedDate = currentDate.getFullYear() + '-' + addLeadingZero((currentDate.getMonth() + 1)) + '-' + addLeadingZero(currentDate.getDate());

                // Function to add leading zero to single-digit numbers
                function addLeadingZero(number) {
                    return (number < 10 ? '0' : '') + number;
                }
                // Add header
                doc.setFontSize(12);
                doc.setFont("helvetica", "bold");
                doc.text('Tasks Report', 14, 6);
                doc.text($("#from").val() + " to " + $("#to").val(), 14, 18);

                // Add footer
                var pageCount = doc.internal.getNumberOfPages();
                for (var i = 1; i <= pageCount; i++) {
                    doc.setPage(i);
                    doc.setFont("helvetica", "normal");
                    doc.text("Page " + i + " of " + pageCount, 20, doc.internal.pageSize.height - 10);
                    doc.setFontSize(10);
                    doc.setFont("helvetica", "italic");
                    doc.text('© TimeSheet', 50, doc.internal.pageSize.height - 10);
                    doc.text('Exported on: '+currentDate, 80, doc.internal.pageSize.height - 10);
                }


                // Export table to PDF
                doc.autoTable({
                    html: '#unapproved',
                    theme: 'grid',
                    margin: { top: 20 },
                    headStyles: { fillColor: [0, 51, 102], textColor: 255, fontSize: 12 },
                    bodyStyles: { textColor: 0, fontSize: 10 },
                    didDrawPage: function (data) {
                        // Add additional styling or content on each page if needed
                    }
                });

                doc.save("Report_for_"+ $("#from").val() + "_to_" + $("#to").val());
            }

            //toggling menu in small screens
        $('#mini-menu').on('click', function () {
            if ($('#options').hasClass('toggleMenu')) {
                $('#options').removeClass('toggleMenu');
            }
            else {
                $('#options').addClass('toggleMenu');
            }
        })

        new DataTable('#unapproved', {
            autoFill: true,
            scrollX: true, // Enable horizontal scrolling
            responsive: true, // Enable responsive design
        });
    </script>
</body>
</html>