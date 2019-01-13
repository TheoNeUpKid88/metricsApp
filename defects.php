<?php
	require("includes/check_session.inc");

if(isset($_POST['submit_defect'])) {
		$df_date = $_POST['entry_date'];
		$df_date_new = strtotime($df_date);
		$date_to_srv = date("Y-m-d", $df_date_new);
		$df_pr = $_POST['df_pr'];
		$df_rnd = $_POST['df_rnd'];
		$cg_cri = $_POST['cg_cri'];
		$cg_maj = $_POST['cg_maj'];
		$cg_min = $_POST['cg_min'];
		$f_cri = $_POST['f_cri'];
		$f_maj = $_POST['f_maj'];
		$f_min = $_POST['f_min'];
		$nf_cri = $_POST['nf_cri'];
		$nf_maj = $_POST['nf_maj'];
		$nf_min = $_POST['nf_min'];
		$df_source = $_POST['df_source'];
		include('includes/dbc.php');
		$sql = "INSERT INTO defects (user_id, pr_id, df_round, cg_critical, cg_major, cg_minor, func_critical, func_major, func_minor, nonf_critical, nonf_major, nonf_minor, tcs_id, df_date) VALUES ('$user_id','$df_pr','$df_rnd','$cg_cri', '$cg_maj','$cg_min','$f_cri', '$f_maj','$f_min','$nf_cri', '$nf_maj','$nf_min','$df_source','$date_to_srv')";
		if($con->query($sql) === TRUE)
		{
			$msg = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> Defect entry has been added.</div>';
		}
		else
		{
			$msg = '<div class="alert alert-danger mx-5 px-1"> <strong>Not Submitted!</strong> Please try again. </div>';
		}
	}
	if (isset($_SESSION['del_msg'])) {
		echo $_SESSION['del_msg'];
		unset($_SESSION['del_msg']);
	   }	
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<?php require("includes/head.inc"); 
		require("includes/js.inc"); 
		?>
	<title>
		My Defects
	</title>
</head>

<body>
	<div id="page-container">
		<div id="content-wrap">
			<header class="jumbotron mt-4">
				<div class="container">
					<div class="display-4 mb-4">My Defects
						<!-- <img src="images/Logo2.png" alt="logo"> -->
					</div>
				</div>
			</header>
			<div class="container">
				<?php require("includes/nav.inc"); ?>
				<h1 class="my-3 text-center">Report Your Defects</h1>
				<div class="all_forms">
					<form method="POST">
						<?php if (isset($msg)) {echo $msg."<br>";}?>
						<legend>Select Your Project</legend>
						<div class="form-row mb-4">
						<?php require("includes/datepicker.inc"); ?>
							<div class="col-md-1"></div>

							<div class="form-group col-md-5">
								<label class="control-label">Project Name</label>
								<select class="form-control" name="df_pr">
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
								<input class="form-control" type="number" name="df_rnd" min="1" max="20" required>
							</div>
						</div>
						<legend>Enter Defects</legend>
						<div class="form-row mb-4">
							<div class="col-md-3">
								<h5>Content/Grammar</h5>
								<div class="form-row">
									<div class="form-group col-md-4">
										<label class="control-label">Critical</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="cg_cri" value="0" required>
										</div>
									</div>

									<div class="form-group col-md-4">
										<label class="control-label">Major</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="cg_maj" value="0" required>
										</div>
									</div>

									<div class="form-group col-md-4">
										<label class="control-label">Minor</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="cg_min" value="0" required>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-3">
								<h5>Functional</h5>
								<div class="form-row">
									<div class="form-group col-md-4">
										<label class="control-label">Critical</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="f_cri" value="0" required>
										</div>
									</div>

									<div class="form-group col-md-4">
										<label class="control-label">Major</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="f_maj" value="0" required>
										</div>
									</div>

									<div class="form-group col-md-4">
										<label class="control-label">Minor</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="f_min" value="0" required>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-3">
								<h5>Non-Functional</h5>
								<div class="form-row">
									<div class="form-group col-md-4">
										<label class="control-label">Critical</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="nf_cri" value="0" required>
										</div>
									</div>

									<div class="form-group col-md-4">
										<label class="control-label">Major</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="nf_maj" value="0" required>
										</div>
									</div>

									<div class="form-group col-md-4">
										<label class="control-label">Minor</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="nf_min" value="0" required>
										</div>
									</div>
									<div class="col-md-1"></div>
								</div>
							</div>
						</div>
						<legend>Enter Test Case Details</legend>
						<div class="form-row mb-4">
							<div class="form-group col-md-5">
								<label class="control-label h5 mb-3">Test Case Source</label>
								<div class="input-group">
									<label class="control-label pr-3">Requirements</label>
									<input class="form-control" type="radio" name="df_source" value="1" required>
									<label class="control-label pr-3">New Functionality</label>
									<input class="form-control" type="radio" name="df_source" value="2">
								</div>
							</div>
						</div>
						<div class="clearfix">
							<div class="subButton btn-group float-right mt-2">
								<button type="submit" class="btn btn-primary" value="Submit" name="submit_defect">Submit</button>
							</div>
						</div>

					</form>
			</div>

				</div>
				<div class="container-fluid">
					<div class="row">
					<?php include("includes/this_week.inc"); ?>
					<?php if (isset($edit_msg)) {echo $edit_msg."<br>";}?>
					<table id="tableone" class="table table-striped table-responsive-md" >
						<thead class="text-center">
						<tr class="double_row">
							<th colspan="4"></th>
							<th class="border-left" colspan="3">Content/Grammar</th>
							<th class="border-left" colspan="3">Functional</th>
							<th class="border-left" colspan="3">Non-Functional</th>
							<th class="border-left" colspan="2"></th>
						</tr>
						<tr>
							<th>Day</th>
							<th>Project Name</th>
							<th>Source</th>
							<th>Round</th>
							<th class="border-left" >Critical</th>
							<th>Major</th>
							<th>Minor</th>
							<th class="border-left" >Critical</th>
							<th>Major</th>
							<th>Minor</th>
							<th class="border-left" >Critical</th>
							<th>Major</th>
							<th>Minor</th>
							<th class="border-left">Status</th>
						</tr>
								</thead>
								<tbody>
						<?php
									include('includes/dbc.php');
									$query = "SELECT d.df_id, d.df_date,
									p.pr_name,
									s.tcs_type,
									d.df_round,
									SUM(d.cg_critical) as ContentGrammarCritical,
									SUM(d.cg_major) as ContentGrammarMajor,
									SUM(d.cg_minor) as ContentGrammarMinor,
									SUM(d.func_critical) as functionalCritical,
									SUM(d.func_major) as functionalMajor,
									SUM(d.func_minor) as functionalMinor,
									SUM(d.nonf_critical) as NonfunctionalCritical,
									SUM(d.nonf_major) as NonfunctionalMajor,
									SUM(d.nonf_minor) as NonfunctionalMinor
									FROM `defects` d
									LEFT JOIN projects p ON p.pr_id = d.pr_id
									LEFT JOIN tc_source s ON s.tcs_id = d.tcs_id
									WHERE user_id=$user_id
									AND d.df_date BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -0 DAY)
									AND DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -6 DAY)
									Group By p.pr_name, d.df_date,d.df_round, d.tcs_id
									ORDER BY d.df_date, p.pr_name, d.tcs_id";
									$result = mysqli_query($con,$query);
									if($result == false){
										$error_message = mysqli_error();
										echo "<p>There has been a query error: $error_message</p>";
									}
									if(mysqli_num_rows($result)==0) {
										echo "No analysts are here.";
									}
									while($row=mysqli_fetch_assoc($result)) {
										$df_id = $row['df_id'];
										$convert_day = $row['df_date'];
										$day_date = strftime("%A",strtotime($convert_day));
										echo '<tr><td>'.$day_date.'</td>';
										echo '<td>'.$row['pr_name'].'</td>';
										echo '<td>'.$row['tcs_type'].'</td>';
										echo '<td class="text-center">'.$row['df_round'].'</td>';
										echo '<td class="border-left text-center" >'.$row['ContentGrammarCritical'].'</td>';
										echo '<td class="text-center">'.$row['ContentGrammarMajor'].'</td>';
										echo '<td class="text-center">'.$row['ContentGrammarMinor'].'</td>';
										echo '<td class="border-left text-center" >'.$row['functionalCritical'].'</td>';
										echo '<td class="text-center">'.$row['functionalMajor'].'</td>';
										echo '<td class="text-center">'.$row['functionalMinor'].'</td>';
										echo '<td class="border-left text-center" >'.$row['NonfunctionalCritical'].'</td>';
										echo '<td class="text-center">'.$row['NonfunctionalMajor'].'</td>';
										echo '<td class="text-center">'.$row['NonfunctionalMinor'].'</td>';
										echo '<td  class="border-left" contenteditable="false"><div class="ticket-actions col-md-2">
										<div class="btn-group dropdown">
										  <button type="button" class="btn dropdown-toggle btn-sm" data-toggle="dropdown">
											Manage
										  </button>
										  <div class="dropdown-menu">
											<a class="dropdown-item editbtn">
											  <i class="fa fa-reply fa-fw"></i>Edit</a>
											  <a class="dropdown-item cancelbtn" href="javascript:history.go(0)">
											  <i class="fa fa-reply fa-fw"></i>Cancel</a>
											  <a class="dropdown-item savebtn" href="DB/defect/delete_defect.php?id='. $df_id .'">
											  <i class="fa fa-check text-success fa-fw"></i>Save</a>
											<div class="dropdown-divider"></div>
											
											<a class="dropdown-item" href="DB/defect/delete_defect.php?id='. $df_id .'">
											  <i class="fa fa-times text-danger fa-fw"></i>Delete</a>
										  </div>
										</div>
									  </div></td></tr>';
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