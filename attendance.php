<?php
	include("includes/check_session.inc");
	if ($role == 'User') {
		header('Location: login.php');
	}
	if(isset($_POST['submit_attd'])) {
		$attd_date = $_POST['entry_date'];
		$attd_date_new = strtotime($attd_date);
		$date_to_srv = date("Y-m-d", $attd_date_new);
		$attd_category = $_POST['category'];
		$attd_user = $_POST['analyst'];
		include('includes/dbc.php');
		$sql = "INSERT INTO attendance (attd_date, attd_category, user_id) VALUES ('$date_to_srv','$attd_category','$attd_user')";
		if($con->query($sql) === TRUE)
		{
			$msg = '<div class="alert alert-success"> <strong>Success!</strong> Attendance entry has been added.</div>';
		}
		else
		{
			$msg = '<div class="alert alert-danger"> <strong>Not Submitted!</strong> Please try again. </div>';
		}
	}
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<?php include("includes/head.inc"); ?>
		<?php include("includes/js.inc"); ?>
		<title>
		Attendance Tracker
		</title>
	</head>
	<body>
	<div id="page-container">
		<div id="content-wrap">
		<header class="jumbotron mt-4">
			<div class="container">
				<div class="display-4 mb-4">QI Weekly Attendance
					<!-- <img src="images/Logo2.png" alt="logo"> -->
				</div>
			</div>
		</header>
		<div class="container">
			<?php include("includes/nav.inc"); ?>
			<h1 class="my-3 text-center"><?php include("includes/this_week.inc"); ?></h1>
			<div class="all_forms">
				<form method="POST">
					<?php if (isset($msg)) {echo $msg."<br>";}?>
					<legend>Enter Attendance Status</legend>
					<div class="form-row">
					<?php require("includes/datepicker.inc"); ?>
						<div class="col-md-1"></div>
						
						<div class="form-group col-md-4">
							<label class="control-label">Analyst</label>
							<select class="form-control" name="analyst">
								<?php
									include('includes/dbc.php');
									$query = "SELECT first_name, last_name, user_id FROM users WHERE NOT last_name='Rodriquez' ORDER BY last_name";
									$result = mysqli_query($con,$query);
									while ($rows = mysqli_fetch_array($result))
									{
									echo '<option value="'.$rows['user_id'].'">'.$rows['first_name']." ".$rows['last_name'].'</option>';
									}
								?>
							</select>
						</div>
						<div class="col-md-1"></div>
						<div class="form-group col-md-2">
							<label class="control-label">Category</label>
							<select class="form-control" name="category">
								<option value="Excused">Excused</option>
								<option value="On Time">On Time</option>
								<option value="Tardy">Tardy</option>
								<option value="Unexcused">Unexcused</option>
							</select>
						</div>
					</div>
					<div class="clearfix">
						<div class="subButton btn-group float-right mt-2">
							<button type="submit" class="btn btn-primary" value="Submit" name="submit_attd">Submit</button>
						</div>
					</div>
				</form>
			</div>
			<?php include("includes/this_week.inc"); ?>
			<h2>Attendance for the Week</h2>
			<table class="table table-striped table-responsive-md">
				<tr><th>Analyst</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th></tr>
				<?php
					include('includes/dbc.php');
					$query = "SELECT u.user_id, u.first_name, u.last_name,
					  case when dayofweek(attd_date) = 1 then a.attd_category else Null end Sunday,
					  case when dayofweek(attd_date) = 2 then a.attd_category else Null end Monday,
					  case when dayofweek(attd_date) = 3 then a.attd_category else Null end Tuesday,
					  case when dayofweek(attd_date) = 4 then a.attd_category else Null end Wednesday,
					  case when dayofweek(attd_date) = 5 then a.attd_category else Null end Thursday,
					  case when dayofweek(attd_date) = 6 then a.attd_category else Null end Friday,
					  case when dayofweek(attd_date) = 7 then a.attd_category else Null end Saturday
					FROM users u JOIN attendance a ON u.user_id = a.user_id WHERE YEARWEEK(`attd_date`, 1) = YEARWEEK(CURDATE(), 1)
					group by user_id";
					$result = mysqli_query($con,$query);
					if($result == false){
						$error_message = mysqli_error();
						echo "<p>There has been a query error: $error_message</p>";
					}
					if(mysqli_num_rows($result)==0) {
						echo "No analysts are here.";
					}
					while($row=mysqli_fetch_assoc($result)) {
                        echo '<tr><td>'.$row['first_name']." ".$row['last_name'].'</td>';
                        echo '<td>'.$row['Monday'].'</td>';
                        echo '<td>'.$row['Tuesday'].'</td>';
                        echo '<td>'.$row['Wednesday'].'</td>';
                        echo '<td>'.$row['Thursday'].'</td>';
                        echo '<td>'.$row['Friday'].'</td></tr>';
					}
				?>
			</table>
		</section>
		<?php include("includes/to_top.inc"); ?>
	</div>
	</div>
				<?php include("includes/footer.inc"); ?>
								</div>
</body>
</html>