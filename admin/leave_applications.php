<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Fetch all leave applications
$sql = "SELECT la.*, ur.firstName, ur.lastName 
        FROM leave_application la 
        LEFT JOIN userregistration ur ON la.user_id = ur.id 
        ORDER BY la.created_at DESC";

$result = $mysqli->query($sql);


// Handle status update
if (isset($_POST['update_status'])) {
    $application_id = $_POST['application_id'];
    $new_status = $_POST['status'];
    $updated_at = date("Y-m-d H:i:s");

    $stmt = $mysqli->prepare("UPDATE leave_application SET status = ?, updated_at = ? WHERE id = ?");
    $stmt->bind_param("ssi", $new_status, $updated_at, $application_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['msg'] = "Application status updated.";
    } else {
        $_SESSION['msg'] = "No changes made or update failed.";
    }
    $stmt->close();

    // Optional: Redirect to refresh table and avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title>Manage Students</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .badge-success {
            background-color: #28a745;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .badge-warning {
            background-color: #ffc107;
        }

        .badge-secondary {
            background-color: #6c757d;
        }
    </style>
    <script language="javascript" type="text/javascript">
        var popUpWin = 0;

        function popUpWindow(URLStr, left, top, width, height) {
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close();
            }
            popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 510 + ',height=' + 430 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
        }
    </script>

</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title" style="margin-top:4%">Leave Applications</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">Leave Applications</div>
                            <?php if (!empty($_SESSION['msg'])) { ?>
                                <p style="color: green"><?= htmlentities($_SESSION['msg']); ?></p>
                                <?php $_SESSION['msg'] = ""; ?>
                            <?php } ?>

                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Leave From</th>
                                            <th>Leave To</th>
                                            <th>Applied At</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?= $count++; ?></td>
                                                <td><?= htmlentities($row['firstName'] . ' ' . $row['lastName']); ?></td>
                                                <td><?= htmlentities($row['leave_from']); ?></td>
                                                <td><?= htmlentities($row['leave_to']); ?></td>
                                                <td><?= htmlentities(date("d-m-Y h:i A", strtotime($row['created_at']))); ?></td>
                                                <td>
                                                    <?php if ($row['status'] == 'Pending') { ?>
                                                        <form method="post" style="display:inline;">
                                                            <input type="hidden" name="application_id" value="<?= $row['id']; ?>">
                                                            <select name="status" class="form-control" style="display:inline;width:auto;">
                                                                <option value="Pending" selected>Pending</option>
                                                                <option value="Approved">Approve</option>
                                                                <option value="Canceled">Cancel</option>
                                                            </select>
                                                            <button type="submit" name="update_status" class="btn btn-sm btn-success">Update</button>
                                                        </form>
                                                    <?php } else {
                                                        $status = $row['status'];
                                                        $badgeClass = 'badge-secondary';

                                                        if ($status == 'Approved') {
                                                            $badgeClass = 'badge-success';
                                                        } elseif ($status == 'Canceled') {
                                                            $badgeClass = 'badge-danger';
                                                        } elseif ($status == 'Pending') {
                                                            $badgeClass = 'badge-warning';
                                                        }
                                                    ?>
                                                        <span class="badge <?= $badgeClass; ?>"><?= htmlentities($status); ?></span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>


                    </div>
                </div>



            </div>
        </div>
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>

</body>

</html>