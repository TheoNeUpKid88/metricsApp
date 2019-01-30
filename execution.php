<?php
	include("includes/check_session.inc");
		if(isset($_POST['submit_exec'])) {
		$exec_date = $_POST['entry_date'];
		$exec_date_new = strtotime($exec_date);
		$date_to_srv = date("Y-m-d", $exec_date_new);
		$exec_pr = $_POST['exec_pr'];
		$exec_rnd = $_POST['round'];
		$cg_p = $_POST['cg_p'];
		$cg_f = $_POST['cg_f'];
		$func_p = $_POST['func_p'];
		$func_f = $_POST['func_f'];
		$nonf_p = $_POST['nonf_p'];
		$nonf_f = $_POST['nonf_f'];
		$exec_source = $_POST['exec_source'];
		include('includes/dbc.php');
		$sql = "INSERT INTO tc_execution (user_id, pr_id, round, cont_gram_pass, cont_gram_fail, func_pass, func_fail, non_func_pass, non_func_fail, tcs_id, exec_date) VALUES ('$user_id','$exec_pr','$exec_rnd','$cg_p', '$cg_f','$func_p','$func_f','$nonf_p','$nonf_f','$exec_source','$date_to_srv')";
		if($con->query($sql) === TRUE)
		{
			$msg = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> Test Execution entry has been added.</div>';
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
		My Testing Progress
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
						My Testing Progress
						</div>
					</div>
</div>
	</header>
	<div class="container">
		<?php include("includes/nav.inc"); ?>
		<h1 class="my-5 text-center">Report Your Test Case Execution</h1>
		<div class="all_forms">
			<form method="POST">
				<?php if (isset($msg)) {echo $msg."<br>";}?>
				<legend>Select Your Project</legend>
				<div class="form-row mb-4">
				<?php require("includes/datepicker.inc"); ?>
					<div class="col-md-1"></div>

					<div class="form-group col-md-5">
						<label class="control-label">Project Name</label>
						<select class="form-control" name="exec_pr">
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
				<legend>Enter Test Case Outcome</legend>
				<div class="form-row mb-4">
					<div class="col-md-3">
						<h5>Content/Grammar</h5>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label class="control-label">Pass</label>
								<div class="input-group">
									<input class="form-control" type="number" min="0" name="cg_p" value="0" required>
								</div>
							</div>

							<div class="form-group col-md-4">
								<label class="control-label">Fail</label>
								<div class="input-group">
									<input class="form-control" type="number" min="0" name="cg_f" value="0" required>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-3">
						<h5>Functional</h5>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label class="control-label">Pass</label>
								<div class="input-group">
									<input class="form-control" type="number" min="0" name="func_p" value="0" required>
								</div>
							</div>

							<div class="form-group col-md-4">
								<label class="control-label">Fail</label>
								<div class="input-group">
									<input class="form-control" type="number" min="0" name="func_f" value="0" required>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-3">
						<h5>Non-Functional</h5>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label class="control-label">Pass</label>
								<div class="input-group">
									<input class="form-control" type="number" min="0" name="nonf_p" value="0" required>
								</div>
							</div>

							<div class="form-group col-md-4">
								<label class="control-label">Fail</label>
								<div class="input-group">
									<input class="form-control" type="number" min="0" name="nonf_f" value="0" required>
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
							<input class="form-control" type="radio" name="exec_source" value="1" required>
							<label class="control-label pr-3">New Functionality</label>
							<input class="form-control" type="radio" name="exec_source" value="2">
						</div>
					</div>
				</div>
				<div class="clearfix">
					<div class="subButton btn-group float-right mt-2">
						<button type="submit" class="btn btn-primary" value="Submit" name="submit_exec">Submit</button>
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
			<table class="table table-responsive-md" id="dtBasicExample">
				<thead class="text-center">
					<tr class="double_row">
						<th colspan="4"></th>
						<th class="border-left" colspan="2">Content/Grammar</th>
						<th class="border-left" colspan="2">Functional</th>
						<th class="border-left" colspan="2">Non-Functional</th>
						<th class="border-left"></th>
					</tr>
					<tr>
						<th>Day</th>
						<th>Project Name</th>
						<th>Source</th>
						<th>Round</th>
						<th class="border-left" >Pass</th>
						<th>Fail</th>
						<th class="border-left" >Pass</th>
						<th>Fail</th>
						<th class="border-left" >Pass</th>
						<th>Fail</th>
						<th class="border-left"></th>
					</tr>
				</thead>
				<tbody>
					<?php
									include('includes/dbc.php');
									$query = "SELECT t.exec_date,t.tcs_id,p.pr_name,t.round,s.tcs_type,t.tce_id,
									SUM(t.cont_gram_pass) as contentGramarPass,
									SUM(t.cont_gram_fail) as contentGramarFail,
									SUM(t.func_pass) as functionalPass,
									SUM(t.func_fail) as functionalFail,
									SUM(t.non_func_pass) as NonfunctionalPass,
									SUM(t.non_func_fail) as NonfunctionalFail
									FROM `tc_execution` t
									LEFT JOIN projects p ON p.pr_id = t.pr_id
									LEFT JOIN tc_source s ON s.tcs_id = t.tcs_id
									WHERE t.user_id=$user_id
									AND t.exec_date BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -0 DAY)
									AND DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -6 DAY)
									Group By p.pr_name, t.exec_date,t.round,t.tcs_id
									ORDER BY t.exec_date, p.pr_name, t.tcs_id";
									$result = mysqli_query($con,$query);
									if($result == false){
										$error_message = mysqli_error();
										echo "<p>There has been a query error: $error_message</p>";
									}
									if(mysqli_num_rows($result)==0) {
										echo "There are no new entries.";
									}
									while($row=mysqli_fetch_assoc($result)) {
										$tce_id = $row['tce_id'];
										$convert_day = $row['exec_date'];
										$day_date = strftime("%A",strtotime($convert_day));
										echo '<tr><td>'.$day_date.'</td>';
										echo '<td>'.$row['pr_name'].'</td>';
										echo '<td>'.$row['tcs_type'].'</td>';
										echo '<td class="text-center">'.$row['round'].'</td>';
										echo '<td class="border-left text-center" >'.$row['contentGramarPass'].'</td>';
										echo '<td class="text-center">'.$row['contentGramarFail'].'</td>';
										echo '<td class="border-left text-center" >'.$row['functionalPass'].'</td>';
										echo '<td class="text-center">'.$row['functionalFail'].'</td>';
										echo '<td class="border-left text-center" >'.$row['NonfunctionalPass'].'</td>';
										echo '<td class="text-center">'.$row['NonfunctionalFail'].'</td>';
										echo '<td  class="border-left" align="center"><div>
										<a class="btn btn-primary delbtn" href="DB/delete_row.php?id='. $tce_id .'&table=tc_execution&id_name=tce_id">
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