<!DOCTYPE html>
<?php $title = 'Reports';?>
<html lang="en">
    <?php include 'includes/header.php';?>
<body>
    <div id="content">
        <h4>Reports</h4>
        <div id="initials" class="col-md-7">
            <div class="form-group">
                <label for="from">Student</label>
                <select name="employee" id="employee" class="form-control">
                    <?php employee()?>
                </select>
            </div>
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
        <table id="unapproved" class="col-md-8 display nowrap mx-3">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Place of Work</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <style>
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
        </style>
    </div>
    <script src="main.js"></script>
    <script>
        $(window).ready(function(){
            $('#generate').on('click', function(){
                if($('#from, #to') != '' && $('#employee').children('option:selected') != ''){
                    var from = $('#from').val();
                    var to = $('#to').val();
                    var employee_id = $('#employee').children('option:selected').val();
                    $.ajax({
                        type: "post",
                        url: "server/reports.php",
                        data: {from: from, to: to, employee_id: employee_id},
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
            doc.text("Name:"+$('#employee').children('option:selected').val(), 14, 10);
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

            doc.save($('#employee').children('option:selected').text()+" report_form_"+ $("#from").val() + "_to_" + $("#to").val());
        }


        new DataTable('#unapproved', {
            autoFill: true
        });
    </script>
</body>
<?php include 'includes/footer.php' ?>
</html>