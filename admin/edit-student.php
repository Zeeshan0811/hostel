<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Fetch student data for editing
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM registration WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
}

// Update student data
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $roomno = $_POST['room'];
    $seater = $_POST['seater'];
    $feespm = $_POST['fpm'];
    $foodstatus = $_POST['foodstatus'];
    $stayfrom = $_POST['stayf'];
    $duration = $_POST['duration'];
    $course = $_POST['course'];
    $regno = $_POST['regno'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $contactno = $_POST['contact'];
    $emailid = $_POST['email'];
    $emcntno = $_POST['econtact'];
    $gurname = $_POST['gname'];
    $gurrelation = $_POST['grelation'];
    $gurcntno = $_POST['gcontact'];
    $caddress = $_POST['address'];
    $ccity = $_POST['city'];
    $cstate = $_POST['state'];
    $cpincode = $_POST['pincode'];
    $paddress = $_POST['paddress'];
    $pcity = $_POST['pcity'];
    $pstate = $_POST['pstate'];
    $ppincode = $_POST['ppincode'];

    $query = "UPDATE registration SET roomno=?, seater=?, feespm=?, foodstatus=?, stayfrom=?, duration=?, course=?, regno=?, firstName=?, middleName=?, lastName=?, gender=?, contactno=?, emailid=?, egycontactno=?, guardianName=?, guardianRelation=?, guardianContactno=?, corresAddress=?, corresCIty=?, corresState=?, corresPincode=?, pmntAddress=?, pmntCity=?, pmnatetState=?, pmntPincode=? WHERE id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('iiiisisissssisississsisssii', $roomno, $seater, $feespm, $foodstatus, $stayfrom, $duration, $course, $regno, $fname, $mname, $lname, $gender, $contactno, $emailid, $emcntno, $gurname, $gurrelation, $gurcntno, $caddress, $ccity, $cstate, $cpincode, $paddress, $pcity, $pstate, $ppincode, $id);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Student Successfully Updated');</script>";
    echo "<script>window.location.href = 'manage-students.php';</script>";
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">
        <title>Edit Course</title>
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
</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Edit Student Registration</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Edit Student Info</div>
                                    <div class="panel-body">
                                        <form method="post" action="" class="form-horizontal">
                                            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

                                            <!-- Room Related Info -->
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">
                                                    <h4 style="color: green" align="left">Room Related info </h4>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Room no. </label>
                                                <div class="col-sm-8">
                                                    <select name="room" id="room" class="form-control"
                                                        onChange="getSeater(this.value);" onBlur="checkAvailability()"
                                                        required>
                                                        <option value="">Select Room</option>
                                                        <?php
                                                        $query = "SELECT * FROM rooms";
                                                        $stmt2 = $mysqli->prepare($query);
                                                        $stmt2->execute();
                                                        $res = $stmt2->get_result();
                                                        while ($row = $res->fetch_object()) {
                                                            $selected = ($row->room_no == $student['roomno']) ? 'selected' : '';
                                                            echo "<option value='$row->room_no' $selected>$row->room_no</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <span id="room-availability-status" style="font-size:12px;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Seater</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="seater" id="seater" class="form-control"
                                                        value="<?php echo $student['seater']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Fees Per Month</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="fpm" id="fpm" class="form-control"
                                                        value="<?php echo $student['feespm']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Food Status</label>
                                                <div class="col-sm-8">
                                                    <input type="radio" value="0" name="foodstatus" <?php echo ($student['foodstatus'] == 0) ? 'checked' : ''; ?>> Without Food
                                                    <input type="radio" value="1" name="foodstatus" <?php echo ($student['foodstatus'] == 1) ? 'checked' : ''; ?>> With Food (Rs
                                                    200.00 Per Month Extra)
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Stay From</label>
                                                <div class="col-sm-8">
                                                    <input type="date" name="stayf" id="stayf" class="form-control"
                                                        value="<?php echo $student['stayfrom']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Duration</label>
                                                <div class="col-sm-8">
                                                    <select name="duration" id="duration" class="form-control">
                                                        <option value="">Select Duration in Month</option>
                                                        <?php
                                                        for ($i = 1; $i <= 12; $i++) {
                                                            $selected = ($i == $student['duration']) ? 'selected' : '';
                                                            echo "<option value='$i' $selected>$i</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Personal Info -->
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">
                                                    <h4 style="color: green" align="left">Personal info </h4>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Course </label>
                                                <div class="col-sm-8">
                                                    <select name="course" id="course" class="form-control" required>
                                                        <option value="">Select Course</option>
                                                        <?php
                                                        $query = "SELECT * FROM courses";
                                                        $stmt2 = $mysqli->prepare($query);
                                                        $stmt2->execute();
                                                        $res = $stmt2->get_result();
                                                        while ($row = $res->fetch_object()) {
                                                            $selected = ($row->course_fn == $student['course']) ? 'selected' : '';
                                                            echo "<option value='$row->course_fn' $selected>$row->course_fn &nbsp;&nbsp;($row->course_sn)</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Registration No : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="regno" id="regno" class="form-control"
                                                        value="<?php echo $student['regno']; ?>" required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">First Name : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="fname" id="fname" class="form-control"
                                                        value="<?php echo $student['firstName']; ?>"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Middle Name : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="mname" id="mname" class="form-control"
                                                        value="<?php echo $student['middleName']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Last Name : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="lname" id="lname" class="form-control"
                                                        value="<?php echo $student['lastName']; ?>" required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Gender : </label>
                                                <div class="col-sm-8">
                                                    <select name="gender" class="form-control" required="required">
                                                        <option value="">Select Gender</option>
                                                        <option value="male" <?php echo ($student['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                                        <option value="female" <?php echo ($student['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                                                        <option value="others" <?php echo ($student['gender'] == 'others') ? 'selected' : ''; ?>>Others</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Contact No : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="contact" id="contact" class="form-control"
                                                        value="<?php echo $student['contactno']; ?>"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Email id : </label>
                                                <div class="col-sm-8">
                                                    <input type="email" name="email" id="email" class="form-control"
                                                        value="<?php echo $student['emailid']; ?>" required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Emergency Contact: </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="econtact" id="econtact"
                                                        class="form-control"
                                                        value="<?php echo $student['egycontactno']; ?>"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Guardian Name : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="gname" id="gname" class="form-control"
                                                        value="<?php echo $student['guardianName']; ?>"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Guardian Relation : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="grelation" id="grelation"
                                                        class="form-control"
                                                        value="<?php echo $student['guardianRelation']; ?>"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Guardian Contact no : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="gcontact" id="gcontact"
                                                        class="form-control"
                                                        value="<?php echo $student['guardianContactno']; ?>"
                                                        required="required">
                                                </div>
                                            </div>

                                            <!-- Correspondense Address -->
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">
                                                    <h4 style="color: green" align="left">Correspondense Address </h4>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Address : </label>
                                                <div class="col-sm-8">
                                                    <textarea rows="5" name="address" id="address" class="form-control"
                                                        required="required"><?php echo $student['corresAddress']; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">City : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="city" id="city" class="form-control"
                                                        value="<?php echo $student['corresCIty']; ?>"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">State </label>
                                                <div class="col-sm-8">
                                                    <select name="state" id="state" class="form-control" required>
                                                        <option value="">Select State</option>
                                                        <?php
                                                        $query = "SELECT * FROM states";
                                                        $stmt2 = $mysqli->prepare($query);
                                                        $stmt2->execute();
                                                        $res = $stmt2->get_result();
                                                        while ($row = $res->fetch_object()) {
                                                            $selected = ($row->State == $student['corresState']) ? 'selected' : '';
                                                            echo "<option value='$row->State' $selected>$row->State</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Pincode : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="pincode" id="pincode" class="form-control"
                                                        value="<?php echo $student['corresPincode']; ?>"
                                                        required="required">
                                                </div>
                                            </div>

                                            <!-- Permanent Address -->
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">
                                                    <h4 style="color: green" align="left">Permanent Address </h4>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-5 control-label">Permanent Address same as
                                                    Correspondense address : </label>
                                                <div class="col-sm-4">
                                                    <input type="checkbox" name="adcheck" value="1"
                                                        onclick="copyAddress()" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Address : </label>
                                                <div class="col-sm-8">
                                                    <textarea rows="5" name="paddress" id="paddress"
                                                        class="form-control"
                                                        required="required"><?php echo $student['pmntAddress']; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">City : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="pcity" id="pcity" class="form-control"
                                                        value="<?php echo $student['pmntCity']; ?>" required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">State </label>
                                                <div class="col-sm-8">
                                                    <select name="pstate" id="pstate" class="form-control" required>
                                                        <option value="">Select State</option>
                                                        <?php
                                                        $query = "SELECT * FROM states";
                                                        $stmt2 = $mysqli->prepare($query);
                                                        $stmt2->execute();
                                                        $res = $stmt2->get_result();
                                                        while ($row = $res->fetch_object()) {
                                                            $selected = ($row->State == $student['pmnatetState']) ? 'selected' : '';
                                                            echo "<option value='$row->State' $selected>$row->State</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Pincode : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="ppincode" id="ppincode"
                                                        class="form-control"
                                                        value="<?php echo $student['pmntPincode']; ?>"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-sm-offset-4">
                                                <button class="btn btn-default" type="submit">Cancel</button>
                                                <input type="submit" name="update" Value="Update"
                                                    class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Include the same scripts as in the registration form -->
</body>
<script type="text/javascript">
    function copyAddress() {
        if ($('input[name="adcheck"]').prop('checked')) {
            $('#paddress').val($('#address').val());
            $('#pcity').val($('#city').val());
            $('#pstate').val($('#state').val());
            $('#ppincode').val($('#pincode').val());
        }
    }
</script>

</html>