<?php
	require("includes/check_session.inc");
	require("postSQL/submit_defect.inc");
		
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
							<div class="form-group col-md-3">
								<label class="control-label">Date</label>
								<div class="input-group"  data-provide="datepicker">
									
									<input class="form-control" id="datepicker" type="text" name="df_date">
								</div>
							</div>
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
								<input class="form-control" type="number" name="df_rnd" min="1" max="20" value="1">
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
											<input class="form-control" type="number" min="0" name="cg_cri" value="0">
										</div>
									</div>

									<div class="form-group col-md-4">
										<label class="control-label">Major</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="cg_maj" value="0">
										</div>
									</div>

									<div class="form-group col-md-4">
										<label class="control-label">Minor</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="cg_min" value="0">
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
											<input class="form-control" type="number" min="0" name="f_cri" value="0">
										</div>
									</div>

									<div class="form-group col-md-4">
										<label class="control-label">Major</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="f_maj" value="0">
										</div>
									</div>

									<div class="form-group col-md-4">
										<label class="control-label">Minor</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="f_min" value="0">
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
											<input class="form-control" type="number" min="0" name="nf_cri" value="0">
										</div>
									</div>

									<div class="form-group col-md-4">
										<label class="control-label">Major</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="nf_maj" value="0">
										</div>
									</div>

									<div class="form-group col-md-4">
										<label class="control-label">Minor</label>
										<div class="input-group">
											<input class="form-control" type="number" min="0" name="nf_min" value="0">
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
									<input class="form-control" type="radio" name="df_source" value="1">
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
<script>
	$('#grid_table').jsGrid({
		width: "100%",
		height: "400px",

		
		
		
		fields: [
			{
				name: "Project Name",
				type: "text",
				width: 150
			}
		]
		
	});


</script>
<!-- EDIT TABLE DROP DOWN 
<div class="btn-group dropdown">
<button type="button" class="btn dropdown-toggle btn-sm" data-toggle="dropdown">
Manage
</button>
<div class="dropdown-menu">
<a class="dropdown-item editbtn">
	<i class="fa fa-reply fa-fw"></i>Edit</a>
	<a class="dropdown-item cancelbtn" href="javascript:history.go(0)">
	<i class="fa fa-reply fa-fw"></i>Cancel</a>
	<a class="dropdown-item savebtn">
	<i class="fa fa-check text-success fa-fw"></i>Save</a>
<div class="dropdown-divider"></div>

<a class="dropdown-item" href="DB/delete_row.php?id='. $df_id .'&table=defects&id_name=df_id">
	<i class="fa fa-times text-danger fa-fw"></i>Delete</a>
</div>
</div>
</div> -->