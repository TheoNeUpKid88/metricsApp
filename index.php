<?php
	include("includes/check_session.inc");
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<?php include("includes/head.inc"); ?>
		<?php include("includes/js.inc"); ?>
		<title>
			QI Metrics Home
		</title>
	</head>
	<body>
	<div id="page-container">
		<div id="content-wrap">
		<header class="jumbotron mt-4">
			<div class="container">
			<div class="display-4 mb-4">Welcome To QMETRIX
				<!-- <img src="images/Logo2.png" alt="logo"> -->
		    </div>
		</div>
		</header>
		<div class="container">
		<?php include("includes/nav.inc"); ?>
		<h2>Welcome <?php include("includes/fullname.inc"); ?>!</h2>
		<section>
			<h1>My Metrics</h1>
			Display Number of Projects in QI 
	    </section>
	    <section>
	    	<h1>Department Metrics</h1>
			Display Number of Tickets in QI
		</section>
		<?php include("includes/to_top.inc"); ?>
		
</div>
</div>
	<?php include("includes/footer.inc"); ?>
</div>
</body>
</html>