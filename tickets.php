<?php
	include("includes/check_session.inc");
	if(isset($_POST['submit_ttl'])) {
		$tix_date = $_POST['entry_date'];
		$tix_date_new = strtotime($tix_date);
		$date_to_srv = date("Y-m-d", $tix_date_new);
		$tix_num = $_POST['tix_num'];
		$tix_tspent = $_POST['tix_tspent'];
		$tix_ttype = $_POST['tix_ttype'];
		$tix_logtype = $_POST['tix_logtype'];
		$tix_rnd = $_POST['round'];
		include('includes/dbc.php');
		$sql = "INSERT INTO time_log (tk_id, user_id, tl_date, tl_time, t_type, l_type, round) VALUES ('$tix_num','$user_id','$date_to_srv','$tix_tspent','$tix_ttype', '$tix_logtype','$tix_rnd')";
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
		My Ticket Timelog
	</title>
</head>

<body>
	<div id="page-container">
		<div id="content-wrap">
			<header class="jumbotron mt-4"><div class="container logo_div">
					<div class="display-1 mb-4">
						<img src="images/logo_metrix-sm.png" alt="logo">
						<div class="logo_text">
						My Ticket Timelog
						</div>
					</div>
				</div>
			</header>
			<div class="container">
				<?php include("includes/nav.inc"); ?>
				<h1 class="my-5 text-center">Report Your Ticket Hours</h1>
				<div class="all_forms">
					<form method="POST">
						<?php if (isset($msg)) {echo $msg."<br>";}?>
						<legend>Select Your Ticket</legend>
						<div class="form-row mb-4">
						<?php require("includes/datepicker.inc"); ?>
							<div class="col-md-1"></div>

							<div class="form-group col-md-5">
								<label class="control-label">Ticket</label>
								<select class="form-control" name="tix_num">
									<?php
									include('includes/dbc.php');
									$query = "SELECT * FROM tickets ORDER BY tk_number";
									$result = mysqli_query($con,$query);
									while ($rows = mysqli_fetch_array($result))
									{
									echo '<option value="'.$rows['tk_id'].'">'.$rows['tk_number']." - ".$rows['tk_title'].'</option>';
									}
								?>
								</select>
							</div>
							<div class="col-md-1"></div>
							<?php require("includes/round.inc"); ?>
						</div>
						<div class="form-row mb-4">
							<div class="col-md-5">
								<legend>Enter Time Worked</legend>
								<div class="form-row">
									<div class="form-group col-md-5">
										<label class="control-label">Time Spent</label>
										<div>
											<select class="form-control" name="tix_tspent">
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
										<select class="form-control" name="tix_ttype">
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
										<select class="form-control" name="tix_logtype">
											<option value="Meeting">Meeting</option>
											<option value="Testing">Testing</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix">
							<div class="subButton btn-group float-right mt-2">
								<button type="submit" class="btn btn-primary" value="Submit" name="submit_ttl">Submit</button>
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
							<th>Department</th>
							<th>Ticket</th>
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
									$query = "SELECT tl.tl_date, tix.tk_number, tix.tk_title, tix.tk_dept, tl.l_type, tl.tl_time, tl.tk_id, tl.round, tl.t_type, 
												tix.tk_id
												FROM time_log as tl
												LEFT JOIN tickets tix ON tix.tk_id = tl.tk_id
												WHERE tix.tk_number IS NOT NULL
												AND tl.user_id = $user_id
												AND tl.tl_date BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -0 DAY) AND DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -6 DAY)
												ORDER BY tl.tl_date, tix.tk_dept";
									$result = mysqli_query($con,$query);
									if($result == false){
										$error_message = mysqli_error();
										echo "<p>There has been a query error: $error_message</p>";
									}
									if(mysqli_num_rows($result)==0) {
										echo "There are no new entries.";
									}
									while($row=mysqli_fetch_assoc($result)) {
										$tk_id = $row['tk_id'];
										$convert_day = $row['tl_date'];
										$day_date = strftime("%A",strtotime($convert_day));
										echo '<tr><td class="text-center">'.$day_date.'</td>';
										echo '<td class="text-center">'.$row['tk_dept'].'</td>';
										echo '<td class="text-center">'.$row['tk_number']." - ".$row['tk_title'].'</td>';
										echo '<td class="text-center">'.$row['round'].'</td>';
										echo '<td class="text-center border-left">'.$row['l_type'].'</td>';
										echo '<td class="text-center">'.$row['t_type'].'</td>';
										echo '<td class="text-center">'.$row['tl_time'].'</td>';
										echo '<td  class="border-left" align="center"><div>
										<a class="btn btn-primary delbtn" href="DB/delete_row.php?id='. $tk_id .'&table=time_log&id_name=tk_id">
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