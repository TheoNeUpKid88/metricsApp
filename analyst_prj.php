<?php
	require("includes/check_session.inc");
	//include("DB/reports/analyst_prj.inc");
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
			<div class="container logo_div">
					<div class="display-1 mb-4">
						<img src="images/logo_metrix-sm.png" alt="logo">
						<div class="logo_text">
						My Projects
						</div>
					</div>
				</div>
			</header>
			<div class="container">
				<?php require("includes/nav.inc"); ?>
				<h1 class="my-5 text-center">Create Your Project Reports </h1>
				<div class="all_forms">
					<form method="POST">
						<?php if (isset($msg)) {echo $msg."<br>";}?>
						<legend>Select Your Project</legend>
						<div class="form-row mb-4">
							<div class="form-group col-md-5">
								<label class="control-label">Project Name</label>
								<select class="form-control" name="mypr_name">
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
							<div class="col-md-2">
								<label>Current Status</label>
								<?php
									$selected = $_POST['mypr_name'];
									include('includes/dbc.php');
									$query = "SELECT ps.pr_id,
									p.pr_name,
									ps.pr_status,
									MAX(ps.st_date)
									FROM pr_status ps
									LEFT JOIN projects p ON p.pr_id = ps.pr_id
									WHERE ps.st_date IN (SELECT MAX(ps.st_date) FROM `pr_status` Group By ps.pr_id)
									AND p.pr_lead=$user_id
									AND p.pr_id = $selected";
									$result = mysqli_query($con,$query);
									while ($rows = mysqli_fetch_array($result))
									{
									echo $rows['pr_status'];
									}
								?>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-2">
								<label>Current Round</label>
							</div>
								</div>
							<div class="clearfix">
							<div class="subButton btn-group float-right mt-2">
								<button type="submit" class="btn btn-primary" value="Submit" name="submit_defect">Create</button>
							</div>
						</div>
						<div> 
							<?php
									$selected = $_POST['mypr_name'];
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
										
									}
									echo $selected;
							?>
						</div>

					</form>
				</div>
					<!-- <div id="test-content">

					</div> -->

				<h1 class="my-4 text-center">Your Project Reports</h1>
				<div class="all_forms">
				<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Defects by Type
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
		<div class="card-body">
			<canvas id="myChart" height="150" style="background-color: #EDEADF;"></canvas>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Defect Resolutions by Type 
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
			<canvas id="myChart" height="150" style="background-color: #EDEADF;"></canvas>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Executed Test Cases - Failure Rate per Round
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
		<div class="card-body">
			<canvas id="myChart" height="150" style="background-color: #EDEADF;"></canvas>
      </div>
    </div>
	</div>
	<div class="card">
    <div class="card-header" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Test Cases - Written vs Executed
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
		<div class="card-body">
			<canvas id="myChart" height="150" style="background-color: #EDEADF;"></canvas>
      </div>
    </div>
	</div>
	<div class="card">
    <div class="card-header" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Time Spent per Project Task
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
		<div class="card-body">
			<canvas id="myChart" height="150" style="background-color: #EDEADF;"></canvas>
      </div>
    </div>
  </div>
</div>
				</div> 
				
		
					<?php include("includes/to_top.inc"); ?>
			</div>
		</div>
		<?php include("includes/footer.inc"); ?>
	</div>
</body>

</html>