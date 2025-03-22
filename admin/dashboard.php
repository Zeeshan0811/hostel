<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

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

	<title>DashBoard</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">


</head>

<body>
	<?php include("includes/header.php"); ?>

	<div class="ts-main-content">
		<?php include("includes/sidebar.php"); ?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title" style="margin-top:4%">Dashboard</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Filter</div>
									<div class="panel-body">
										<div class="col-md-4">
											<div class="form-group">
												<Select name="hall_id" id="hall_id" class="form-control" required>
													<option value="">Select Hall</option>
													<?php
													$query = "SELECT * FROM halls";
													$stmt2 = $mysqli->prepare($query);
													$stmt2->execute();
													$res = $stmt2->get_result();
													while ($halls = $res->fetch_object()) {
													?>
														<option value="<?php echo $halls->id; ?>"><?php echo $halls->hall_name; ?></option>
													<?php } ?>
												</Select>
											</div>
										</div>

										<div class="col-md-4">
											<Select name="block_id" id="block_id" class="form-control" required>
												<option value="">Select Block</option>
												<?php
												$query = "SELECT * FROM blocks";
												$stmt2 = $mysqli->prepare($query);
												$stmt2->execute();
												$res = $stmt2->get_result();
												while ($blocks = $res->fetch_object()) {
												?>
													<option value="<?php echo $blocks->id; ?>"><?php echo $blocks->block_name . " (" . $blocks->block_type . ")"; ?></option>
												<?php } ?>
											</Select>
										</div>

									</div>
								</div>
							</div>

							<div class="col-md-12">
								<div id="dashboard-data">
									<!-- Your dashboard cards (Total Rooms, Total Seats, etc.) will go here -->
								</div>
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

	<script>
		window.onload = function() {

			// Line chart from swirlData for dashReport
			var ctx = document.getElementById("dashReport").getContext("2d");
			window.myLine = new Chart(ctx).Line(swirlData, {
				responsive: true,
				scaleShowVerticalLines: false,
				scaleBeginAtZero: true,
				multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
			});

			// Pie Chart from doughutData
			var doctx = document.getElementById("chart-area3").getContext("2d");
			window.myDoughnut = new Chart(doctx).Pie(doughnutData, {
				responsive: true
			});

			// Dougnut Chart from doughnutData
			var doctx = document.getElementById("chart-area4").getContext("2d");
			window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {
				responsive: true
			});

		}
	</script>


	<script>
		$(document).ready(function() {
			$('#hall_id, #block_id').on('change', function() {
				var hall_id = $('#hall_id').val();
				var block_id = $('#block_id').val();

				console.log(hall_id, block_id);

				if (hall_id && block_id) {
					$.ajax({
						url: 'fetch_dashboard_data.php',
						type: 'POST',
						data: {
							hall_id: hall_id,
							block_id: block_id
						},
						success: function(response) {
							$('#dashboard-data').html(response);
						},
						error: function() {
							alert('Something went wrong. Please try again.');
						}
					});
				}
			});
		});
	</script>


</body>

</html>