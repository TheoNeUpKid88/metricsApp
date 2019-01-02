<?php
	include("includes/check_session.inc");
	if ($role == 'User' ) {
		header('Location: login.php');
	}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<?php include("includes/head.inc"); ?>
	<?php include("includes/js.inc"); ?>
	<title>
		Ticket Management
	</title>
</head>

<body>
	<div id="page-container">
		<div id="content-wrap">
			<header class="jumbotron mt-4">
				<div class="container">
					<div class="display-4 mb-4">Project Management
						<!-- <img src="images/Logo2.png" alt="logo"> -->
					</div>
				</div>
			</header>
			<div class="container">
				<?php include("includes/nav.inc"); ?>
				<h1 class="my-3 text-center">Upload Project CSV</h1>
				<div class="all_forms">
					<form class="form-horizontal" action="" method="post" name="uploadCSV" enctype="multipart/form-data">
						<div class="input-row">
							<label class="col-md-4 control-label">Choose CSV File</label> <input type="file" name="file" id="file" accept=".csv">
							<button type="submit" id="submit" name="import" class="btn-submit">Import</button>
							<br />

						</div>
				</div>
				<div id="labelError"></div>
				</form>
				<?php include("includes/to_top.inc"); ?>

			</div>
			</div>
				<?php include("includes/footer.inc"); ?>
								</div>
</body>

</html>