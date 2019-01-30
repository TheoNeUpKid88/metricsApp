<?php
	require("includes/check_session.inc");
	if(isset($_POST['submit_prld_res'])) {
		$status_date = $_POST['entry_date'];
		$status_date_new = strtotime($status_date);
		$date_to_srv = date("Y-m-d", $status_date_new);
		$prld_df_name = $_POST['prld_df_name'];
		$prld_rnd = $_POST['round'];
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
			<div class="container logo_div">
					<div class="display-1 mb-4">
						<img src="images/logo_metrix-sm.png" alt="logo">
						<div class="logo_text">
						Defect Resolutions
						</div>
					</div>
				</div>
			</header>
			<div class="container">
				<?php require("includes/nav.inc"); ?>
				<h1 class="my-5 text-center">Report Your Defect Resolutions</h1>
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
								<div>
									<select class="form-control" name="round">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
									</select>
								</div>
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
				</div>

				<div class="row my-4">
					<div class="col"><hr style="margin-top: 50px; margin-bottom: 50px; border-top: 4px solid #beb28b;"></div>
					<div class="col-auto" style="margin-top: 13px; margin-bottom: 13px;"><?php include("includes/this_week.inc"); ?></div>
					<div class="col"><hr style="margin-top: 50px; margin-bottom: 50px; border-top: 4px solid #beb28b;"></div>
				</div>
				
				<div class="container-fluid">
					<div class="row">
					<?php echo $del_msg;?>
					<table id="tableone" class="table table-striped table-responsive-md" >
						<thead class="text-center">
						<tr class="double_row">
							<th colspan="3"></th>
							<th class="border-left" colspan="4">Content/Grammar</th>
							<th class="border-left" colspan="4">Functional</th>
							<th class="border-left" colspan="4">Non-Functional</th>
							<th class="border-left"></th>
						</tr>
						<tr>
							<th>Day</th>
							<th>Project Name</th>
							<th>Round</th>
							<th class="border-left" >Pass QI</th>
							<th>Pass QI As Is</th>
							<th>Works As Designed</th>
							<th>Deferred</th>
							<th class="border-left" >Pass QI</th>
							<th>Pass QI As Is</th>
							<th>Works As Designed</th>
							<th>Deferred</th>
							<th class="border-left" >Pass QI</th>
							<th>Pass QI As Is</th>
							<th>Works As Designed</th>
							<th>Deferred</th>
							<th class="border-left"></th>
						</tr>
								</thead>
								<tbody>
						<?php
									include('includes/dbc.php');
									$query = "SELECT r.pr_id, r.date, r.def_id,
									r.user_id, r.round, p.pr_name,
									SUM(r.cg_passqi) as cg_passqi,
									SUM(r.cg_passqiai) as cg_passqiai,
									SUM(r.cg_wadesigned) as cg_wadesigned,
									SUM(r.cg_deferred) as cg_deferred,
									SUM(r.func_passqi) as f_passqi,
									SUM(r.func_passqiai) as f_passqiai,
									SUM(r.func_wadesigned) as f_wadesigned,
									SUM(r.func_deferred) as f_deferred,
									SUM(r.nonf_passqi) as nf_passqi,
									SUM(r.nonf_passqiai) as nf_passqiai,
									SUM(r.nonf_wadesigned) as nf_wadesigned,
									SUM(r.nonf_deferred) as nf_deferred
							 FROM def_resolutions r
							 LEFT JOIN projects p ON p.pr_id = r.pr_id
							 WHERE r.user_id = $user_id
							 AND r.date BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) - 0 DAY) 
							 AND DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) - 6 DAY)
							 GROUP BY r.pr_id;";
									$result = mysqli_query($con,$query);
									if($result == false){
										$error_message = mysqli_error();
										echo "<p>There has been a query error: $error_message</p>";
									}
									if(mysqli_num_rows($result)==0) {
										echo "There are no new entries.";
									}
									while($row=mysqli_fetch_assoc($result)) {
										$def_id = $row['def_id'];
										$convert_day = $row['date'];
										$day_date = strftime("%A",strtotime($convert_day));
										echo '<tr><td class="text-center">'.$day_date.'</td>';
										echo '<td class="text-center">'.$row['pr_name'].'</td>';
										echo '<td class="text-center" id="rnd">'.$row['round'].'</td>';
										echo '<td class="border-left text-center">'.$row['cg_passqi'].'</td>';
										echo '<td class="text-center">'.$row['cg_passqiai'].'</td>';
										echo '<td class="text-center">'.$row['cg_wadesigned'].'</td>';
										echo '<td class="text-center">'.$row['cg_deferred'].'</td>';
										echo '<td class="border-left text-center">'.$row['f_passqi'].'</td>';
										echo '<td class="text-center">'.$row['f_passqiai'].'</td>';
										echo '<td class="text-center">'.$row['f_wadesigned'].'</td>';
										echo '<td class="text-center">'.$row['f_deferred'].'</td>';
										echo '<td class="border-left text-center">'.$row['nf_passqi'].'</td>';
										echo '<td class="text-center">'.$row['nf_passqiai'].'</td>';
										echo '<td class="text-center">'.$row['nf_wadesigned'].'</td>';
										echo '<td class="text-center">'.$row['nf_deferred'].'</td>';
										echo '<td  class="border-left" align="center"><div>
										<a class="btn btn-primary delbtn" href="DB/delete_row.php?id='. $def_id .'&table=def_resolutions&id_name=def_id">
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