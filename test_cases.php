<?php
	include("includes/check_session.inc");
		if(isset($_POST['submit_tc'])) {
		$tc_date = $_POST['tc_date'];
		$tc_date_new = strtotime($tc_date);
		$date_to_srv = date("Y-m-d", $tc_date_new);
		$tc_pr = $_POST['tc_pr'];
		$tc_cg = $_POST['tc_cg'];
		$tc_func = $_POST['tc_func'];
		$tc_nonf = $_POST['tc_nonf'];
		$tc_time = $_POST['tc_time'];
		$tc_source = $_POST['tc_source'];
		include('includes/dbc.php');
		$sql = "INSERT INTO tc_creation (user_id, pr_id, tc_cont_gram, tc_func, tc_non_func, timeframe, tcs_id, tc_date) VALUES ('$user_id','$tc_pr','$tc_cg','$tc_func','$tc_nonf','$tc_time','$tc_source','$date_to_srv')";
		if($con->query($sql) === TRUE)
		{
			$msg = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> Test Case entry has been added.</div>';
			
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
		My Test Cases
	</title>
</head>

<body>
	<div id="page-container">
		<div id="content-wrap">
			<header class="jumbotron mt-4">
				<div class="container">
					<div class="display-4 mb-4">My Test Cases
						<!-- <img src="images/Logo2.png" alt="logo"> -->
					</div>
				</div>
			</header>
			<div class="container">
				<?php include("includes/nav.inc"); ?>
				<h1 class="my-3 text-center">Report Your Test Cases</h1>
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
									<input class="form-control" type="text" name="tc_date">
								</div>
							</div>
							<div class="col-md-1"></div>

							<div class="form-group col-md-6">
								<label class="control-label">Project Name</label>
								<select class="form-control" name="tc_pr">
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
						</div>
						<legend>Enter Number of Test Cases</legend>
						<div class="form-row mb-4">
							<div class="form-group col-md-2">
								<label class="control-label">Content/Grammar</label>
								<div class="input-group">
									<input class="form-control" type="number" min="0" name="tc_cg" value="0">
								</div>
							</div>
							<div class="col-md-2"></div>
							<div class="form-group col-md-2">
								<label class="control-label">Functional</label>
								<div class="input-group">
									<input class="form-control" type="number" min="0" name="tc_func" value="0">
								</div>
							</div>
							<div class="col-md-2"></div>
							<div class="form-group col-md-4">
								<label class="control-label">Non-Functional</label>
								<div class="input-group">
									<input class="form-control col-md-6" type="number" min="0" name="tc_nonf" value="0">
								</div>
							</div>
						</div>
						<legend>Enter Test Case Details</legend>
						<div class="form-row mb-4">
							<div class="form-group col-md-5">
								<label class="control-label h5 mb-3">Time of Test Case Creation</label>
								<div class="input-group">
									<label class="control-label pr-3">Pre-Delivery</label>
									<input class="form-control" type="radio" name="tc_time" value="Pre-delivery">
									<label class="control-label pr-3">Post Delivery</label>
									<input class="form-control" type="radio" name="tc_time" value="Post Delivery">
								</div>
							</div>
							<div class="col-md-1"></div>
							<div class="form-group col-md-5">
								<label class="control-label h5 mb-3">Test Case Source</label>
								<div class="input-group">
									<label class="control-label pr-3">Requirements</label>
									<input class="form-control" type="radio" name="tc_source" value="1">
									<label class="control-label pr-3">New Functionality</label>
									<input class="form-control" type="radio" name="tc_source" value="2">
								</div>
							</div>
						</div>
						<div class="clearfix">
							<div class="subButton btn-group float-right mt-2">
								<button type="submit" class="btn btn-primary" value="Submit" name="submit_tc">Submit</button>
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
								<th>Creation</th>
								<th>Source</th>
								<th>Content/Grammar</th>
								<th>Functional</th>
								<th>Non-Functional</th>
							</tr>
						</thead>
						<tbody>
							<?php
									include('includes/dbc.php');
									$query = "SELECT tcc.tc_date,
									p.pr_name,
									SUM(tcc.tc_cont_gram) as cg,
									SUM(tcc.tc_func) as func,
									SUM(tcc.tc_non_func) as nonf,
									s.tcs_type,
									tcc.timeframe
							  FROM tc_creation tcc
							  LEFT JOIN projects p ON p.pr_id = tcc.pr_id
							  LEFT JOIN tc_source s ON s.tcs_id = tcc.tcs_id
							  WHERE user_id = $user_id
							  AND tcc.tc_date BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) - 0 DAY)
							  AND DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) - 6 DAY)
							  GROUP BY tcc.tc_date, p.pr_name
							  ORDER BY tcc.tc_date, p.pr_name, s.tcs_type";
									$result = mysqli_query($con,$query);
									if($result == false){
										$error_message = mysqli_error();
										echo "<p>There has been a query error: $error_message</p>";
									}
									if(mysqli_num_rows($result)==0) {
										echo "No analysts are here.";
									}
									while($row=mysqli_fetch_assoc($result)) {
										$convert_day = $row['tc_date'];
										$day_date = strftime("%A",strtotime($convert_day));
										echo '<tr><td>'.$day_date.'</td>';
										echo '<td>'.$row['pr_name'].'</td>';
										echo '<td>'.$row['timeframe'].'</td>';
										echo '<td>'.$row['tcs_type'].'</td>';
										echo '<td class="text-center">'.$row['cg'].'</td>';
										echo '<td class="text-center">'.$row['func'].'</td>';
										echo '<td class="text-center">'.$row['nonf'].'</td></tr>';
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