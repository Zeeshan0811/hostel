<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Code for adding a hall
if (isset($_POST['submit_hall'])) {
    $hall_name = $_POST['hall_name'];

    // Insert into the halls table
    $query = "INSERT INTO halls (hall_name) VALUES (?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $hall_name);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Hall has been added successfully');</script>";
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
    <title>Add Hall</title>
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
</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="page-title">Add Hall</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">Add Hall Details</div>
                            <div class="panel-body">
                                <form method="post" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Hall Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="hall_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2 text-right">
                                            <input class="btn btn-primary" type="submit" name="submit_hall" value="Add Hall">
                                        </div>
                                    </div>
                                </form>
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