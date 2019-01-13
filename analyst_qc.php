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
				<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
	  <canvas id="myChart" height="150" style="background-color: #EDEADF;"></canvas>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday","Sunday"],
        datasets: [{
            label: 'Test Cases Written',
            data: [<?php echo $tc_total;?>],
            backgroundColor: 'rgba(165,26,77, 0.2)',
            borderColor: 'rgba(165,26,77,1)',
            borderWidth: 1
		},
		{
            label: 'Test Cases Executed',
            data: [<?php echo $tce_total;?>],
            backgroundColor: 'rgba(0,140,192, 0.2)',
            borderColor: 'rgba(0,140,192)',
            borderWidth: 1
		},
		{
            label: 'Defects Found',
            data: [<?php echo $df_total;?>],
            backgroundColor: 'rgba(0,121,38, 0.2)',
            borderColor: 'rgba(0,121,38,1)',
            borderWidth: 1
		},
	]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>

      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Collapsible Group Item #2
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Collapsible Group Item #3
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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