<?php
session_start();

include 'connection.php';

$id = $_SESSION['id'];

if (isset($_POST['from']) && isset($_POST['to'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));

    $from = new DateTime($from);
    $to = new DateTime($to);

    // Use a prepared statement to avoid SQL injection
    $sql = "SELECT * FROM report WHERE employee_id = ? ORDER BY date";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    while ($fetch = mysqli_fetch_assoc($result)) {
        $report_date = new DateTime($fetch['date']);
        if ($report_date <= $to && $report_date >= $from) { ?>
            <tr>
                <td><?php echo date('d-m-Y', strtotime($fetch['date'])) ?></td>
                <td><?php echo $fetch['time_in'] ?></td>
                <td><?php echo $fetch['timeout'] ?></td>
                <td><?php echo $fetch['place_of_work'] ?></td>
                <td><?php echo $fetch['remarks'] ?></td>
            </tr>
        <?php }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
}
?>