<?php
	require("includes/check_session.inc");
	include('includes/dbc.php');
	$query_tce = "SELECT SUM(cont_gram_pass)+SUM(cont_gram_fail)+SUM(func_pass)+SUM(func_fail)+SUM(non_func_pass)+SUM(non_func_fail) as tce_total,
			 user_id
			 FROM `tc_execution`
			 WHERE 1=1
			 AND exec_date BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -0 DAY) AND DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -6 DAY)
			 AND user_id=$user_id
			 GROUP BY exec_date
			 Order By exec_date";
			  $result_tce = mysqli_query($con,$query_tce);
			  //$o_data = array();
			  $tce_total = '';
			  while($row = mysqli_fetch_array($result_tce)) {
				  $tce_total = $tce_total.$row['tce_total'].',';
			  }
				  $tce_total = trim($tce_total,",");
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<?php require("includes/head.inc"); 
		require("includes/js.inc"); 
		?>
	<title>
		My QC Metrics
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
						My QC
						</div>
					</div>
				</div>
			</header>
			<div class="container">
				<?php require("includes/nav.inc"); ?>
				<h1 class="my-5 text-center">My Metrics This Month</h1>
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
          Defects by Severity
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
          Executed Test Cases
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
          Time Spent - Projects vs Tickets
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
          Test Cases by Type
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
          Total Time Spent per Task
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