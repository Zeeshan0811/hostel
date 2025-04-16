<?php
include('includes/config.php');

$hall_id = $_POST['hall_id'];
$block_id = $_POST['block_id'];

// Example filtered queries, adjust as per your logic
// Filter based on hall_id and block_id for each stat

// Total Rooms
$stmt = $mysqli->prepare("SELECT count(*) FROM rooms WHERE hall_id = ? AND block_id = ?");
$stmt->bind_param("ii", $hall_id, $block_id);
$stmt->execute();
$stmt->bind_result($totalRooms);
$stmt->fetch();
$stmt->close();

// Total Seats
$stmt = $mysqli->prepare("SELECT SUM(seater) FROM rooms WHERE hall_id = ? AND block_id = ?");
$stmt->bind_param("ii", $hall_id, $block_id);
$stmt->execute();
$stmt->bind_result($totalSeats);
$stmt->fetch();
$stmt->close();

// Allocated Seats
$stmt = $mysqli->prepare("SELECT SUM(seater) FROM registration WHERE hall_id = ? AND block_id = ?");
$stmt->bind_param("ii", $hall_id, $block_id);
$stmt->execute();
$stmt->bind_result($allocatedSeats);
$stmt->fetch();
$stmt->close();

// On Leave Students

$today = date('Y-m-d');

$stmt = $mysqli->prepare("
    SELECT COUNT(*) 
    FROM leave_application la
    JOIN userregistration ur ON la.user_id = ur.id
    JOIN registration r ON ur.regNo = r.regno
    WHERE la.status = 'Approved'
      AND ? BETWEEN la.leave_from AND la.leave_to
      AND r.hall_id = ?
      AND r.block_id = ?
");

$stmt->bind_param("sii", $today, $hall_id, $block_id);
$stmt->execute();
$stmt->bind_result($onLeaveStudents);
$stmt->fetch();
$stmt->close();

?>

<!-- Send back the updated dashboard cards -->
<div class="row">
    <div class="col-md-2">
        <div class="panel panel-default">
            <div class="panel-body bk-primary text-light">
                <div class="stat-panel text-center">
                    <div class="stat-panel-number h1 "><?php echo $totalRooms ?: 0; ?></div>
                    <div class="stat-panel-title text-uppercase">Total Rooms</div>
                </div>
            </div>
            <a href="manage-students.php" class="block-anchor panel-footer">Full Detail
                <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>

    <div class="col-md-2">
        <div class="panel panel-default">
            <div class="panel-body bk-primary text-light">
                <div class="stat-panel text-center">
                    <div class="stat-panel-number h1 "><?php echo $totalSeats ?: 0; ?></div>
                    <div class="stat-panel-title text-uppercase">Total Seats</div>
                </div>
            </div>

            <a href="manage-students.php" class="block-anchor panel-footer">Full Detail
                <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>

    <div class="col-md-2">
        <div class="panel panel-default">
            <div class="panel-body bk-primary text-light">
                <div class="stat-panel text-center">
                    <div class="stat-panel-number h1 "><?php echo $allocatedSeats ?: 0; ?></div>
                    <div class="stat-panel-title text-uppercase">Allocated Seats</div>
                </div>
            </div>
            <a href="manage-students.php" class="block-anchor panel-footer">Full Detail
                <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>

    <div class="col-md-2">
        <div class="panel panel-default">
            <div class="panel-body bk-success text-light">
                <div class="stat-panel text-center">
                    <div class="stat-panel-number h1 "><?php echo ($totalSeats - $allocatedSeats)  ?: 0; ?></div>
                    <div class="stat-panel-title text-uppercase">Unallocated Seats</div>
                </div>
            </div>
            <a href="manage-rooms.php" class="block-anchor panel-footer text-center">See
                All &nbsp; <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    <div class="col-md-2">
        <div class="panel panel-default">
            <div class="panel-body bk-success text-light">
                <div class="stat-panel text-center">
                    <div class="stat-panel-number h1 "><?php echo $onLeaveStudents  ?: 0; ?></div>
                    <div class="stat-panel-title text-uppercase">On Leave Students</div>
                </div>
            </div>
            <a href="leave_applications.php" class="block-anchor panel-footer text-center">See
                All &nbsp; <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
</div>