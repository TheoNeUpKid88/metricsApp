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
		My Project Status
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
						My Project Status
						</div>
					</div>
				</div>
			</header>
			<div class="container">
				<?php require("includes/nav.inc"); ?>
				<h1 class="my-5 text-center">Report Your Project Status</h1>
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
				<div class="row my-4">
					<div class="col"><hr style="margin-top: 50px; margin-bottom: 50px; border-top: 4px solid #beb28b;"></div>
					<div class="col-auto" style="margin-top: 13px; margin-bottom: 13px;"><?php include("includes/this_week.inc"); ?></div>
					<div class="col"><hr style="margin-top: 50px; margin-bottom: 50px; border-top: 4px solid #beb28b;"></div>
				</div>
					<table id="tableone" class="table table-striped table-responsive-md" >
						<thead class="text-center">
						<tr>
							<th>Day</th>
							<th>Project Name</th>
							<th>Status</th>
							<th class="border-left"></th>
						</tr>
								</thead>
								<tbody>
						<?php
									include('includes/dbc.php');
									$query = "SELECT ps.pr_id,
									p.pr_name,
									ps.pr_status,
									ps.st_date
									FROM pr_status ps
									LEFT JOIN projects p ON p.pr_id = ps.pr_id
									INNER JOIN (SELECT pr_id, MAX(st_id) as max_st_id FROM pr_status GROUP BY pr_id) 
									recentdate ON ps.pr_id = recentdate.pr_id
									AND ps.st_id = recentdate.max_st_id
									AND p.pr_lead = $user_id
									ORDER BY ps.pr_id ASC";
									$result = mysqli_query($con,$query);
									if($result == false){
										$error_message = mysqli_error();
										echo "<p>There has been a query error: $error_message</p>";
									}
									if(mysqli_num_rows($result)==0) {
										echo "There are no new entries.";
									}
									while($row=mysqli_fetch_assoc($result)) {
										$st_id = $row['st_id'];
										$convert_day = $row['st_date'];
										$day_date = strftime("%A",strtotime($convert_day));
										echo '<tr><td class="text-center">'.$day_date.'</td>';
										echo '<td class="text-center">'.$row['pr_name'].'</td>';
										echo '<td class="text-center">'.$row['pr_status'].'</td>';
										echo '<td  class="border-left" align="center"><div>
										<a class="btn btn-primary delbtn" href="DB/delete_row.php?id='. $st_id .'&table=pr_status&id_name=st_id">
										<i class="fa fa-times text-danger fa-fw"></i>Delete</a></div></td></tr>';
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