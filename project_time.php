<?php
	include("includes/check_session.inc");
	if(isset($_POST['submit_pr_time'])) {
		$pr_name = $_POST['pr_name'];
		$pr_date = $_POST['pr_date'];
		$pr_date_new = strtotime($pr_date);
		$pr_date_to_srv = date("Y-m-d", $pr_date_new);
		$pr_time = $_POST['pr_time'];
		$pr_ttype = $_POST['pr_ttype'];
		$pr_ltype = $_POST['pr_ltype'];
		$pr_rnd = $_POST['pr_rnd'];
		include('includes/dbc.php');
		$sql = "INSERT INTO time_log (pr_id, user_id, tl_date, tl_time, t_type, l_type, round) VALUES ('$pr_name','$user_id','$pr_date_to_srv','$pr_time','$pr_ttype', '$pr_ltype','$pr_rnd')";
		if($con->query($sql) === TRUE)
		{
			$msg = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> Time entry has been added.</div>';
		}
		else
		{
			$msg = '<div class="alert alert-danger mx-5 px-1"> <strong>Not Submitted!</strong> Please try again. </div>';
		}
	}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<?php include("includes/head.inc"); ?>
	<?php include("includes/js.inc"); ?>
	<title>
		My Project Time Log
	</title>
</head>

<body>
	<div id="page-container">
		<div id="content-wrap">
			<header class="jumbotron mt-4">
				<div class="container">
					<div class="display-4 mb-4">My Project Time Log
						<!-- <img src="images/Logo2.png" alt="logo"> -->
					</div>
				</div>
			</header>
			<div class="container">
				<?php include("includes/nav.inc"); ?>
				<h1 class="my-3 text-center">Report Your Project Hours</h1>
				<div class="all_forms">
					<form method="POST">
						<?php if (isset($msg)) {echo $msg."<br>";}?>
						<legend>Select Your Project</legend>
						<div class="form-row mb-4">
							<div class="form-group col-md-3">
								<label class="control-label">Date</label>
								<div class="input-group date" data-provide="datepicker">
									<span class="input-group-prepend">
										<button class="btn btn-outline-secondary btn" type="button">
											<i class="far fa-calendar-alt"></i>
										</button></span>
									<input class="form-control" type="text" name="pr_date" required>
								</div>
							</div>
							<div class="col-md-1"></div>

							<div class="form-group col-md-5">
								<label class="control-label">Project Name</label>
								<select class="form-control" name="pr_name">
									<?php
									include('includes/dbc.php');
									$query = "SELECT * FROM projects ORDER BY pr_name";
									$result = mysqli_query($con,$query);
									while ($rows = mysqli_fetch_array($result))
									{
									echo '<option value="'.$rows['pr_id'].'">'.$rows['pr_name'].'</option>';
									}
								?>
								</select>
							</div>
							<div class="col-md-1"></div>
							<div class=" form-group col-md-2">
								<label class="control-label">Round</label>
								<input class="form-control" type="number" name="pr_rnd" min="1" max="20" required>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-5">
								<legend>Enter Time Worked</legend>
								<div class="form-row">
									<div class="form-group col-md-5">
										<label class="control-label">Time Spent</label>
										<div>
											<select class="form-control" name="pr_time">
												<option value="0:15">0:15</option>
												<option value="0:30">0:30</option>
												<option value="0:45">0:45</option>
												<option value="1:00">1:00</option>
												<option value="1:15">1:15</option>
												<option value="1:30">1:30</option>
												<option value="1:45">1:45</option>
												<option value="2:00">2:00</option>
												<option value="2:15">2:15</option>
												<option value="2:30">2:30</option>
												<option value="2:45">2:45</option>
												<option value="3:00">3:00</option>
												<option value="3:15">3:15</option>
												<option value="3:30">3:30</option>
												<option value="3:45">3:45</option>
												<option value="4:00">4:00</option>
												<option value="4:15">4:15</option>
												<option value="4:30">4:30</option>
												<option value="4:45">4:45</option>
												<option value="5:00">5:00</option>
												<option value="5:15">5:15</option>
												<option value="5:30">5:30</option>
												<option value="5:45">5:45</option>
												<option value="6:00">6:00</option>
												<option value="6:15">6:15</option>
												<option value="6:30">6:30</option>
												<option value="6:45">6:45</option>
												<option value="7:00">7:00</option>
												<option value="7:15">7:15</option>
												<option value="7:30">7:30</option>
												<option value="7:45">7:45</option>
												<option value="8:00">8:00</option>
												<option value="8:15">8:15</option>
												<option value="8:30">8:30</option>
												<option value="8:45">8:45</option>
												<option value="9:00">9:00</option>
												<option value="9:15">9:15</option>
												<option value="9:30">9:30</option>
												<option value="9:45">9:45</option>
												<option value="10:00">10:00</option>
												<option value="10:15">10:15</option>
												<option value="10:30">10:30</option>
												<option value="10:45">10:45</option>
												<option value="11:00">11:00</option>
												<option value="11:15">11:15</option>
												<option value="11:30">11:30</option>
												<option value="11:45">11:45</option>
												<option value="12:00">12:00</option>
											</select>
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="form-group col-md-5">
										<label class="control-label">Time Type</label>
										<select class="form-control" name="pr_ttype">
											<option value="Weekday">Weekday</option>
											<option value="After Hours">After Hours</option>
											<option value="Weekend">Weekend</option>
											<option value="Holiday">Holiday</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-2"></div>
							<div class="col-md-5">
								<legend>Current Ticket Status</legend>
								<div class="form-row">
									<div class="form-group col-md-5">
										<label class="control-label">Log Type</label>
										<select class="form-control" name="pr_ltype">
											<option value="Meeting">Meeting</option>
											<option value="Research">Research</option>
											<option value="Planning">Planning</option>
											<option value="Testing">Testing</option>
											<option value="Defect Entry">Defect Entry</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix">
							<div class="subButton btn-group float-right mt-2">
								<button type="submit" class="btn btn-primary" value="Submit" name="submit_pr_time">Submit</button>
							</div>
						</div>
					</form>
				</div>
				<section>
					<?php include("includes/this_week.inc"); ?>

					<table class="table table-striped table-responsive-md">
						<thead class="text-center">
						<tr>
							<th>Day</th>
							<th>Project Name</th>
							<th>Lead</th>
							<th>Round</th>
							<th>Log Type</th>
							<th>Time Type</th>
							<th>Time Spent</th>
						</tr>
								</thead>
								<tbody>
						<?php
						include('includes/dbc.php');
						$query = "SELECT tl.tl_date, p.pr_name, u.first_name,tl.round,tl.l_type,tl.t_type,tl.tl_time
									FROM time_log AS tl
									LEFT JOIN projects p ON p.pr_id = tl.pr_id
									JOIN users u ON u.user_id = p.pr_lead
									WHERE p.pr_id IS NOT NULL
									AND tl.user_id = $user_id
									AND tl.tl_date BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -0 DAY) AND DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -4 DAY)
									ORDER BY tl.tl_date";
									$result = mysqli_query($con,$query);
									if($result == false){
										$error_message = mysqli_error();
										echo "<p>There has been a query error: $error_message</p>";
									}
									if(mysqli_num_rows($result)==0) {
										echo "No analysts are here.";
									}
									while($row=mysqli_fetch_assoc($result)) {
										$convert_day = $row['tl_date'];
										$day_date = strftime("%A",strtotime($convert_day));
										echo '<tr><td>'.$day_date.'</td>';
										echo '<td>'.$row['pr_name'].'</td>';
										echo '<td>'.$row['first_name'].'</td>';
										echo '<td class="text-center">'.$row['round'].'</td>';
										echo '<td>'.$row['l_type'].'</td>';
										echo '<td>'.$row['t_type'].'</td>';
										echo '<td class="text-center">'.$row['tl_time'].'</td></tr>';
									}
					?>
					</tbody>
					</table>
				</section>
				<?php include("includes/to_top.inc"); ?>
			</div>
			</div>
				<?php include("includes/footer.inc"); ?>
								</div>
</body>

</html>