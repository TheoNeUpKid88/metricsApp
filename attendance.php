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
		$sql = "SELECT * FROM attendance WHERE 1=1 AND attd_date = '$date_to_srv' AND user_id = $attd_user";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result);
		$attd_id = $row['attd_id'];
		$count = mysqli_num_rows($result);
		if($count >= 1)
		{
			$sql1 = "UPDATE attendance SET attd_cat_id = '$attd_category' WHERE attd_id = '$attd_id'";
				if($con->query($sql1) === TRUE)
				{
					$msg = '<div class="alert alert-success"> <strong>Success!</strong> Attendance entry has been updated.</div>';
				}
				else
				{
					$msg = '<div class="alert alert-danger"> <strong>Not Updated!</strong> Please try again. </div>';
				}	
		}
		else {
			$sql2 = "INSERT INTO attendance (attd_date, attd_cat_id, user_id) VALUES ('$date_to_srv','$attd_category','$attd_user')";
				if($con->query($sql2) === TRUE)
				{
					$msg = '<div class="alert alert-success"> <strong>Success!</strong> Attendance entry has been added.</div>';
				}
				else
				{
					$msg = '<div class="alert alert-danger"> <strong>Not Submitted!</strong> Please try again. </div>';
				} 
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
		<div class="container logo_div">
					<div class="display-1 mb-4">
						<img src="images/logo_metrix-sm.png" alt="logo">
						<div class="logo_text">
						Weekly Attendance
						</div>
					</div>
				</div>
		</header>
		<div class="container">
			<?php include("includes/nav.inc"); ?>
			<h1 class="my-5 text-center">Report QI Attendance</h1>
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
									$query = "SELECT first_name, last_name, user_id FROM users WHERE NOT last_name='Rodriquez' ORDER BY user_id";
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
								<option value="1">On Time</option>
								<option value="2">Tardy</option>
								<option value="3">Excused</option>
								<option value="4">Unexcused</option>
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
			<div class="row my-4">
					<div class="col"><hr style="margin-top: 50px; margin-bottom: 50px; border-top: 4px solid #beb28b;"></div>
					<div class="col-auto" style="margin-top: 13px; margin-bottom: 13px;"><?php include("includes/this_week.inc"); ?></div>
					<div class="col"><hr style="margin-top: 50px; margin-bottom: 50px; border-top: 4px solid #beb28b;"></div>
				</div>

			<table id="tableone" class="table table-striped table-responsive-md">
			<thead class="text-center">
				<tr>
					<th>Analyst</th>
					<th>Monday</th>
					<th>Tuesday</th>
					<th>Wednesday</th>
					<th>Thursday</th>
					<th>Friday</th>
				</tr>
				</thead>
				<tbody>
				<?php
					include('includes/dbc.php');
					$query = "SELECT u.first_name, u.last_name,
					CASE WHEN (GROUP_CONCAT(CASE WHEN weekday(a.attd_date) = 0 THEN atc.a_category_type END)) IS NULL THEN '' ELSE (GROUP_CONCAT(CASE WHEN weekday(a.attd_date) = 0 THEN atc.a_category_type END)) END as Monday,
					CASE WHEN (GROUP_CONCAT(CASE WHEN weekday(a.attd_date) = 1 THEN atc.a_category_type END)) IS NULL THEN '' ELSE (GROUP_CONCAT(CASE WHEN weekday(a.attd_date) = 1 THEN atc.a_category_type END)) END as Tuesday,
					CASE WHEN (GROUP_CONCAT(CASE WHEN weekday(a.attd_date) = 2 THEN atc.a_category_type END)) IS NULL THEN '' ELSE (GROUP_CONCAT(CASE WHEN weekday(a.attd_date) = 2 THEN atc.a_category_type END)) END as Wednesday,
					CASE WHEN (GROUP_CONCAT(CASE WHEN weekday(a.attd_date) = 3 THEN atc.a_category_type END)) IS NULL THEN '' ELSE (GROUP_CONCAT(CASE WHEN weekday(a.attd_date) = 3 THEN atc.a_category_type END)) END as Thursday,
					CASE WHEN (GROUP_CONCAT(CASE WHEN weekday(a.attd_date) = 4 THEN atc.a_category_type END)) IS NULL THEN '' ELSE (GROUP_CONCAT(CASE WHEN weekday(a.attd_date) = 4 THEN atc.a_category_type END)) END as Friday
					FROM attendance a
					LEFT JOIN attd_category atc ON atc.attd_cat_id = a.attd_cat_id
					LEFT JOIN users u ON u.user_id = a.user_id
					WHERE 1=1
					AND attd_date BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) - 0 DAY) AND DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) - 4 DAY)
					GROUP BY u.user_id";
					$result = mysqli_query($con,$query);
					if($result == false){
						$error_message = mysqli_error();
						echo "<p>There has been a query error: $error_message</p>";
					}
					if(mysqli_num_rows($result)==0) {
						echo "No analysts are here.";
					}
					while($row=mysqli_fetch_assoc($result)) {
                        echo '<tr><td class="text-center">'.$row['first_name']." ".$row['last_name'].'</td>';
                        echo '<td class="text-center">'.$row['Monday'].'</td>';
                        echo '<td class="text-center">'.$row['Tuesday'].'</td>';
                        echo '<td class="text-center">'.$row['Wednesday'].'</td>';
                        echo '<td class="text-center">'.$row['Thursday'].'</td>';
                        echo '<td class="text-center">'.$row['Friday'].'</td></tr>';
					}
				?>
				</tbody>
			</table>
		<?php include("includes/to_top.inc"); ?>
	</div>
	</div>
				<?php include("includes/footer.inc"); ?>
								</div>
</body>
</html>

<td><span style="font-family:Arial, Helvetica, sans-serif;<?php if($variable<0)echo "color:red"?>"><?php echo $variable; ?></span></td>
