<?php
	require("includes/check_session.inc");
	if(isset($_POST['submit_prld_status'])) {
		$status_date = $_POST['entry_date'];
		$status_date_new = strtotime($status_date);
		$date_to_srv = date("Y-m-d", $status_date_new);
		$prld_name = $_POST['prld_name'];
		$prld_status = $_POST['prld_status'];
		include('includes/dbc.php');
		$sql = "INSERT INTO pr_status (st_date, pr_id, pr_status) VALUES ('$date_to_srv','$prld_name','$prld_status')";
		if($con->query($sql) === TRUE)
		{
			$msg = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> Project Status has been updated.</div>';
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
	<?php require("includes/head.inc"); 
		require("includes/js.inc"); 
		?>
	<title>
		Project Status
	</title>
</head>

<body>
	<div id="page-container">
		<div id="content-wrap">
			<header class="jumbotron mt-4">
				<div class="container">
					<div class="display-4 mb-4">Project Status
						<!-- <img src="images/Logo2.png" alt="logo"> -->
					</div>
				</div>
			</header>
			<div class="container">
				<?php require("includes/nav.inc"); ?>
				<h1 class="my-3 text-center">Report Your Project Status</h1>
				<div class="all_forms">
					<form method="POST">
						<?php if (isset($msg)) {echo $msg."<br>";}?>
						<legend>Select Your Project</legend>
						<div class="form-row mb-4">
							<?php require("includes/datepicker.inc"); ?>
							<div class="col-md-1"></div>

							<div class="form-group col-md-5">
								<label class="control-label">Project Name</label>
								<select class="form-control" name="prld_name">
									<?php
									include('includes/dbc.php');
									$query = "SELECT  p.pr_lead,
									u.username,
									p.pr_id,
									p.pr_name
									FROM projects p
									JOIN users u ON u.user_id = p.pr_lead
									WHERE p.pr_lead = $user_id
									AND p.pr_lead = u.user_id
									ORDER BY p.pr_name";
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
								<label class="control-label">Status</label>
								<select class="form-control" name="prld_status">
											<option value="New">New</option>
											<option value="Req. Received">Req. Received</option>
											<option value="In Testing">In Testing</option>
											<option value="Closed">Closed</option>
											<option value="Deactivated">Deactivated</option>
										</select>
							</div>
						</div>
						
						<div class="clearfix">
							<div class="subButton btn-group float-right mt-2">
								<button type="submit" class="btn btn-primary" value="Submit" name="submit_prld_status">Submit</button>
							</div>
						</div>

					</form>
				</div>
				<section>
					<?php include("includes/this_week.inc"); ?>
					<?php if (isset($edit_msg)) {echo $edit_msg."<br>";}?>
					<div class="table-responsive">
						<div id="grid-table">
							<h3> Header</h3>

						</div>
					</div>
					<?php include("includes/to_top.inc"); ?>
			</div>
		</div>
		<?php include("includes/footer.inc"); ?>
	</div>
</body>

</html>