<?php
	require("includes/check_session.inc");
	if(isset($_POST['submit_prld_res'])) {
		$status_date = $_POST['entry_date'];
		$status_date_new = strtotime($status_date);
		$date_to_srv = date("Y-m-d", $status_date_new);
		$prld_df_name = $_POST['prld_df_name'];
		$prld_rnd = $_POST['prld_rnd'];
		$cg_prld_passqi = $_POST['cg_prld_passqi'];
		$cg_prld_pAsIs = $_POST['cg_prld_pAsIs'];
		$cg_prld_wad = $_POST['cg_prld_wad'];
		$cg_prld_def = $_POST['cg_prld_def'];
		$f_prld_passqi = $_POST['f_prld_passqi'];
		$f_prld_pAsIs = $_POST['f_prld_pAsIs'];
		$f_prld_wad = $_POST['f_prld_wad'];
		$f_prld_def = $_POST['f_prld_def'];
		$nf_prld_passqi = $_POST['nf_prld_passqi'];
		$nf_prld_pAsIs = $_POST['nf_prld_pAsIs'];
		$nf_prld_wad = $_POST['nf_prld_wad'];
		$nf_prld_def = $_POST['nf_prld_def'];
		include('includes/dbc.php');
		$sql = "INSERT INTO def_resolutions (user_id, date, pr_id, round, cg_passqi, cg_passqiai, cg_wadesigned, cg_deferred, func_passqi, func_passqiai, func_wadesigned, func_deferred, nonf_passqi, nonf_passqiai, nonf_wadesigned, nonf_deferred) 
		VALUES ('$user_id','$date_to_srv','$prld_df_name','$prld_rnd', '$cg_prld_passqi','$cg_prld_pAsIs','$cg_prld_wad','$cg_prld_def','$f_prld_passqi','$f_prld_pAsIs','$f_prld_wad','$f_prld_def','$nf_prld_passqi','$nf_prld_pAsIs','$nf_prld_wad','$nf_prld_def')";
		if($con->query($sql) === TRUE)
		{
			$msg = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> Defect resolutions have been added.</div>';
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
		Defect Resolutions
	</title>
</head>

<body>
	<div id="page-container">
		<div id="content-wrap">
			<header class="jumbotron mt-4">
				<div class="container">
					<div class="display-4 mb-4">Defect Resolutions
						<!-- <img src="images/Logo2.png" alt="logo"> -->
					</div>
				</div>
			</header>
			<div class="container">
				<?php require("includes/nav.inc"); ?>
				<h1 class="my-3 text-center">Report Your Defect Resolutions</h1>
				<div class="all_forms">
					<form method="POST">
						<?php if (isset($msg)) {echo $msg."<br>";}?>
						<legend>Select Your Project</legend>
						<div class="form-row mb-4">
							<?php require("includes/datepicker.inc"); ?>
							<div class="col-md-1"></div>

							<div class="form-group col-md-5">
								<label class="control-label">Project Name</label>
								<select class="form-control" name="prld_df_name">
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
								<label class="control-label">Round</label>
								<input class="form-control" type="number" name="prld_rnd" min="1" max="20" required>
							</div>
						</div>
						<legend>Enter Defects</legend>
						<div class="form-row mb-4">
							<div class="col-md-12">
								<h5>Content/Grammar</h5>
								<div class="form-row">
									<div class="form-group col-md-2">
										<label class="control-label">Pass QI</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="cg_prld_passqi" value="0" required>
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="form-group col-md-2">
										<label class="control-label">Pass QI As Is</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="cg_prld_pAsIs" value="0" required>
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="form-group col-md-2">
										<label class="control-label">Works As Designed</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="cg_prld_wad" value="0" required>
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="form-group col-md-2">
										<label class="control-label">Deferred</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="cg_prld_def" value="0" required>
										</div>
									</div>
				
							</div>
							</div>
							</div>
							<div class="form-row mb-4">
								<div class="col-md-12">
									<h5>Functional</h5>
									<div class="form-row">
										<div class="form-group col-md-2">
											<label class="control-label">Pass QI</label>
											<div class="input-group">
												<input class="form-control" type="number" min="0" name="f_prld_passqi" value="0" required>
											</div>
										</div>
										<div class="col-md-1"></div>
										<div class="form-group col-md-2">
											<label class="control-label">Pass QI As Is</label>
											<div class="input-group">
												<input class="form-control" type="number" min="0" name="f_prld_pAsIs" value="0" required>
											</div>
										</div>
										<div class="col-md-1"></div>
										<div class="form-group col-md-2">
											<label class="control-label">Works As Designed</label>
											<div class="input-group">
												<input class="form-control" type="number" min="0" name="f_prld_wad" value="0" required>
											</div>
										</div>
										<div class="col-md-1"></div>
										<div class="form-group col-md-2">
											<label class="control-label">Deferred</label>
											<div class="input-group">
												<input class="form-control" type="number" min="0" name="f_prld_def" value="0" required>
											</div>
										</div>

									</div>
								</div>
							</div>
						
						<div class="form-row mb-4">
							<div class="col-md-12">
								<h5>Non-Functional</h5>
								<div class="form-row">
									<div class="form-group col-md-2">
										<label class="control-label">Pass QI</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="nf_prld_passqi" value="0" required>
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="form-group col-md-2">
										<label class="control-label">Pass QI As Is</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="nf_prld_pAsIs" value="0" required>
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="form-group col-md-2">
										<label class="control-label">Works As Designed</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="nf_prld_wad" value="0" required>
										</div>
									</div>
									<div class="col-md-1"></div>
									<div class="form-group col-md-2">
										<label class="control-label">Deferred</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="nf_prld_def" value="0" required>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="clearfix">
							<div class="subButton btn-group float-right mt-2">
								<button type="submit" class="btn btn-primary" value="Submit" name="submit_prld_res">Submit</button>
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