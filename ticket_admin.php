<?php
	include("includes/check_session.inc");
	if ($role == 'User' ) {
		header('Location: login.php');
	}
if(isset($_POST['edit_ticket'])) {
		$edit_tkt = $_POST['edit_tk'];
		$edit_tknum = trim($_POST['edit_num']);
		$edit_tkdesc = trim($_POST['edit_desc']);
		$edit_tkdpt = $_POST['edit_dpt'];
		include('includes/dbc.php');
		$sql1 = "SELECT * FROM tickets WHERE tk_id = '$edit_tkt'";
		$result = mysqli_query($con, $sql1);
		$count = mysqli_num_rows($result);
		// if (!mysqli_query($con,$sql1))
		//    {
		//    print_r(mysqli_error_list($con));
		//    }echo $edit_tk;
		if($count == 1)
			{
				$edit = "UPDATE tickets SET tk_number = '$edit_tknum', tk_title = '$edit_tkdesc', tk_dept = '$edit_tkdpt'  WHERE tk_id = '$edit_tkt'";
				$edit_result = mysqli_query($con,$edit);
				$msg = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> Ticket has been updated successfully. </div>';
			}
			
		elseif (!mysqli_query($con,$sql1))
		{
		print_r(mysqli_error_list($con));
		}
		else {
				$msg = '<div class="alert alert-danger mx-5 px-1"> <strong>Not Submitted!</strong> Please try again. </div>';

				}
		}
	if(isset($_POST['add_ticket'])) {
		$add_tknum = trim($_POST['add_num']);
		$add_tkdesc = trim($_POST['add_desc']);
		$add_tkdpt = $_POST['add_dpt'];
		include('includes/dbc.php');
		$sql2 = "INSERT INTO tickets (tk_number, tk_title, tk_dept) VALUES ('$add_tknum','$add_tkdesc','$add_tkdpt')";
		// if (!mysqli_query($con,$sql2))
		//   {
		//   print_r(mysqli_error_list($con));
		//   }
		if($con->query($sql2) === TRUE)
		{
			$msg2 = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> New ticket has been added.</div>';
		}
		else
		{
			$msg2 = '<div class="alert alert-danger mx-5 px-1"> <strong>Not Submitted!</strong> Please try again. </div>';
		}
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
		<div class="container logo_div">
					<div class="display-1 mb-4">
						<img src="images/logo_metrix-sm.png" alt="logo">
						<div class="logo_text">
						Ticket Management
						</div>
					</div>
				</div>
		</header>
		<div class="container">
			<?php include("includes/nav.inc"); ?>
			<h1 class="my-5 text-center">Add or Edit a Ticket</h1>
			<div class="all_forms">
				<form method="POST">
					<?php if (isset($msg2)) {echo $msg2."<br>";}?>
					<legend>Add a New Ticket</legend>
					<div class="form-row mb-4">
						<div class="form-group col-md-2">
							<label class="control-label">Ticket Number</label>
							<div class="input-group">
								<input class="form-control" type="text" name="add_num" required>
							</div>
						</div>
						<div class="col-md-1"></div>
						<div class="form-group col-md-5">
							<label class="control-label">Ticket Title</label>
							<div class="input-group">
								<input class="form-control" type="text" name="add_desc" required>
							</div>
						</div>
						<div class="col-md-1"></div>
						<div class="form-group col-md-2">
							<label class="control-label">Department</label>
							<select class="form-control" name="add_dpt">
								<option value="Applications">Applications</option>
								<option value="Telephony">Telephony</option>
								<option value="Training">Training</option>
							</select>
						</div>
					</div>
					<div class="clearfix">
						<div class="subButton btn-group float-right mt-2">
							<button type="submit" class="btn btn-primary" value="Submit" name="add_ticket">Add</button>
						</div>
					</div>
				</form>
				<form method="POST">
					<?php if (isset($msg)) {echo $msg."<br>";}?>
					<legend>Edit an Existing Ticket</legend>
					<div class="form-row mb-4">
						<div class="form-group col-md-6">
							<label class="control-label">Ticket</label>
							<select class="form-control" name="tix_num">
								<?php
									include('includes/dbc.php');
									$query = "SELECT * FROM tickets ORDER BY tk_number";
									$result = mysqli_query($con,$query);
									while ($rows = mysqli_fetch_array($result))
									{
									echo '<option value="'.$rows['tk_id'].'">'.$rows['tk_number']." - ".$rows['tk_title'].'</option>';
									}
									global $tk_id;
									 $tk_id = $row['tk_id'];
									 global $tk_title;
									$title = $row['tk_title'];
								?>
							</select>
						</div>
					</div>
					<?php echo $tk_id; ?>
					<div class="form-row">
						<div class="form-group col-md-2">
							<label class="control-label">Ticket Number</label>
							<div class="input-group">
								<input class="form-control" type="text" name="edit_num" value="<?php echo $tk_id; ?>" required>
							</div>
						</div>
						<div class="col-md-1"></div>
						<div class="form-group col-md-4">
							<label class="control-label">Ticket Title</label>
							<div class="input-group">
								<input class="form-control" type="text" name="edit_desc" required>
							</div>
						</div>
						<div class="col-md-1"></div>
						<div class="form-group col-md-2">
							<label class="control-label">Department</label>
							<select class="form-control" name="edit_dpt">
								<option value="Applications">Applications</option>
								<option value="Telephony">Telephony</option>
								<option value="Training">Training</option>
							</select>
						</div>
					</div>
					<div class="clearfix">
						<div class="subButton btn-group float-right mt-2">
							<button type="submit" class="btn btn-primary" value="Submit" name="edit_ticket">Update</button>
						</div>
					</div>
				</form>
			</div>
			<?php include("includes/to_top.inc"); ?>
		</div>
		</div>
				<?php include("includes/footer.inc"); ?>
								</div>
	</body>
</html>