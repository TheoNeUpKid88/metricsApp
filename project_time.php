<?php
	include("includes/check_session.inc");
	if(isset($_POST['submit_pr_time'])) {
		$pr_name = $_POST['pr_name'];
		$pr_date = $_POST['entry_date'];
		$pr_date_new = strtotime($pr_date);
		$pr_date_to_srv = date("Y-m-d", $pr_date_new);
		$pr_time = $_POST['pr_time'];
		$pr_ttype = $_POST['pr_ttype'];
		$pr_ltype = $_POST['pr_ltype'];
		$pr_rnd = $_POST['round'];
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
		My Project Timelog
	</title>
</head>

<body>
	<div id="page-container">
		<div id="content-wrap">
			<header class="jumbotron mt-4">
			<div class="container logo_div">
					<div class="display-1 mb-4">
						<img src="images/logo_metrix-sm.png" alt="logo">
						<div class="logo_text">
						My Project Timelog
						</div>
					</div>
				</div>
			</header>
			<div class="container">
				<?php include("includes/nav.inc"); ?>
				<h1 class="my-5 text-center">Report Your Project Hours</h1>
				<div class="all_forms">
					<form method="POST">
						<?php if (isset($msg)) {echo $msg."<br>";}?>
						<legend>Select Your Project</legend>
						<div class="form-row mb-4">
						<?php require("includes/datepicker.inc"); ?>
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
							<?php require("includes/round.inc"); ?>
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
								<legend>Enter Log Type</legend>
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
				</div>
				<div class="row my-4">
					<div class="col"><hr style="margin-top: 50px; margin-bottom: 50px; border-top: 4px solid #beb28b;"></div>
					<div class="col-auto" style="margin-top: 13px; margin-bottom: 13px;"><?php include("includes/this_week.inc"); ?></div>
					<div class="col"><hr style="margin-top: 50px; margin-bottom: 50px; border-top: 4px solid #beb28b;"></div>
				</div>
				<div class="container-fluid">
					<div class="row">

					<table class="table table-striped table-responsive-md">
						<thead class="text-center">
						<tr>
							<th>Day</th>
							<th>Project Name</th>
							<th>Lead</th>
							<th>Round</th>
							<th class="border-left">Log Type</th>
							<th>Time Type</th>
							<th>Time Spent</th>
							<th class="border-left"></th>
						</tr>
								</thead>
								<tbody>
						<?php
						include('includes/dbc.php');
						$query = "SELECT tl.tl_date, p.pr_name, u.first_name,tl.round,tl.l_type,tl.t_type,tl.tl_time, p.pr_id
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
										echo "There are no new entries.";
									}
									while($row=mysqli_fetch_assoc($result)) {
										$pr_id=$row['pr_id'];
										$convert_day = $row['tl_date'];
										$day_date = strftime("%A",strtotime($convert_day));
										echo '<tr><td class="text-center">'.$day_date.'</td>';
										echo '<td class="text-center">'.$row['pr_name'].'</td>';
										echo '<td class="text-center">'.$row['first_name'].'</td>';
										echo '<td class="text-center">'.$row['round'].'</td>';
										echo '<td class="text-center border-left">'.$row['l_type'].'</td>';
										echo '<td class="text-center">'.$row['t_type'].'</td>';
										echo '<td class="text-center">'.$row['tl_time'].'</td>';
										echo '<td  class="border-left" align="center"><div>
										<a class="btn btn-primary delbtn" href="DB/delete_row.php?id='. $pr_id .'&table=time_log&id_name=pr_id">
										<i class="fa fa-times text-danger fa-fw"></i>Delete</a></div></td></tr>';
									}
					?>
					</tbody>
					</table>
								</div>
								</div>
				<?php include("includes/to_top.inc"); ?>
			
			</div>
				<?php include("includes/footer.inc"); ?>
								</div>
</body>

</html>