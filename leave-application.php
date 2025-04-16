<?php
session_start();
include('includes/config.php');
date_default_timezone_set('Asia/Kolkata');
include('includes/checklogin.php');
check_login();
$user_id = $_SESSION['id'];



// code for Leave Application
if (isset($_POST['leave_application_submmit'])) {
    $leave_from = $_POST['leave_from'];
    $leave_to = $_POST['leave_to'];
    $status = 'Pending'; // default status
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");

    $sql = "INSERT INTO leave_application (user_id, leave_from, leave_to, status, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("isssss", $user_id, $leave_from, $leave_to, $status, $created_at, $updated_at);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['msg'] = "Leave application submitted successfully.";
        } else {
            $_SESSION['msg'] = "Failed to submit leave application. Please try again.";
        }
        $stmt->close();
    } else {
        $_SESSION['msg'] = "Database error: Unable to prepare statement.";
    }
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
    <title>Leave Application</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">>
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
    <script type="text/javascript">
        function valid() {
            if (document.changepwd.newpassword.value != document.changepwd.cpassword.value) {
                alert("Password and Re-Type Password Field do not match  !!");
                document.changepwd.cpassword.focus();
                return false;
            }
            return true;
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
                        <h2 class="page-title">Leave Application </h2>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="panel panel-default">
                                    <div class="panel-heading"> Leave Application</div>
                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal" name="leave_application" id="change-pwd" onSubmit="return valid();">
                                            <?php if (isset($_POST['leave_application_submmit'])) { ?>
                                                <p style="color: red"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                                            <?php } ?>
                                            <div class="hr-dashed"></div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">From </label>
                                                        <div class="col-sm-8">
                                                            <input type="date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" name="leave_from" id="leave_from" class="form-control" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">To</label>
                                                        <div class="col-sm-8">
                                                            <input type="date" min="<?php echo date("Y-m-d"); ?>" class="form-control" name="leave_to" id="leave_to" value="<?php echo date("Y-m-d"); ?>" required="required">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 text-right">
                                                    <input type="submit" name="leave_application_submmit" Value="Apply" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="panel panel-default">
                                    <div class="panel-heading"> My Leave Applications</div>
                                    <div class="panel-body">
                                        <table class="table" id="zctb" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Sl.</th>
                                                    <th scope="col">From</th>
                                                    <th scope="col">To</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Applied At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM leave_application WHERE user_id = ? ORDER BY created_at DESC";
                                                if ($stmt = $mysqli->prepare($sql)) {
                                                    $stmt->bind_param("i", $user_id);
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    $cnt = 1;
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . htmlentities($cnt) . "</td>";
                                                        echo "<td>" . htmlentities($row['leave_from']) . "</td>";
                                                        echo "<td>" . htmlentities($row['leave_to']) . "</td>";
                                                        echo "<td>" . htmlentities($row['status']) . "</td>";
                                                        echo "<td>" . htmlentities($row['created_at']) . "</td>";
                                                        echo "</tr>";
                                                        $cnt++;
                                                    }
                                                    $stmt->close();
                                                } else {
                                                    echo "<tr><td colspan='5'>No applications found.</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
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