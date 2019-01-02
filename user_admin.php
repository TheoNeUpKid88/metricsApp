<?php
	include("includes/check_session.inc");
	if ($role == 'User' ) {
		header('Location: login.php');
	}
if(isset($_POST['edit_user'])) {
		$uname = $_POST['user'];
		$edit = $_POST['edit_status'];
		include('includes/dbc.php');
		$sql1 = "SELECT * FROM users WHERE username = '$uname'";
		$result = mysqli_query($con, $sql1);
		$count = mysqli_num_rows($result);
		// if (!mysqli_query($con,$sql1))
		//    {
		//    print_r(mysqli_error_list($con));
		//    }
		if($count == 1)
		{
			if ($edit == 'Disable')
				{
					$changestat = "UPDATE users SET active = 'Disable' WHERE username = '$uname'";
					$stat_result = mysqli_query($con,$changestat);
					$msg = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> User has been disabled successfully. </div>';
				}
			elseif ($edit == 'Active')
				{
					$changestat = "UPDATE users SET active = 'Active' WHERE username = '$uname'";
					$stat_result = mysqli_query($con,$changestat);
					$msg = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> User has been activated successfully. </div>';
				}
			elseif ($edit == 'Reset') {
					$resetpwd = "UPDATE users SET password = 'Welcome01' WHERE username = '$uname'";
					$reset_result = mysqli_query($con,$resetpwd);
					$msg = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> Password has been reset successfully. </div>';
					}
					}
		else {
				$msg = '<div class="alert alert-danger mx-5 px-1"> <strong>Not Submitted!</strong> Please try again. </div>';
				}
	}
	if(isset($_POST['add_user'])) {
		$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		$uname = trim($_POST['uname']);
		$type = trim($_POST['type']);
		include('includes/dbc.php');
		$sql2 = "INSERT INTO users (username, password, first_name, last_name, user_type) VALUES ('$uname', 'Welcome01', '$fname', '$lname', '$type')";
		$usr_add = $con->query($sql2);
		// if (!mysqli_query($con,$sql2))
		//   {
		//   print_r(mysqli_error_list($con));
		//   }
		if($usr_add === TRUE)
		{
			$msg2 = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> New user has been added.</div>';
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
		User Management
	</title>
</head>

<body>
	<div id="page-container">
		<div id="content-wrap">
			<header class="jumbotron mt-4">
				<div class="container">
					<div class="display-4 mb-4">User Management
						<!-- <img src="images/Logo2.png" alt="logo"> -->
					</div>
				</div>
			</header>
			<div class="container">
				<?php include("includes/nav.inc"); ?>
				<h1 class="my-3 text-center">Add or Edit a User</h1>
				<div class="all_forms">
					<form method="POST">
						<?php if (isset($msg)) {echo $msg."<br>";}?>
						<legend>Existing User Management</legend>
						<div class="form-row mb-4">
							<div class="form-group col-md-3">
								<label class="control-label">User</label>
								<select class="form-control" name="user">
									<?php
									include('includes/dbc.php');
									$query = "SELECT first_name, last_name, username FROM users ORDER BY last_name";
									$result = mysqli_query($con,$query);
									while ($rows = mysqli_fetch_array($result)) {
								echo '<option value="'.$rows['user_id'].'">'.$rows['first_name']." ".$rows['last_name'].'</option>';
								}
								?>
								</select>
							</div>
							<div class="col-md-1"></div>
							<div class="form-group col-md-3">
								<label class="control-label">Action</label>
								<select class="form-control" name="edit_status">
									<option value="Active">Activate</option>
									<option value="Disable">Deactivate</option>
									<option value="Reset">Reset Password</option>
								</select>
							</div>
						</div>
						<div class="clearfix">
							<div class="subButton btn-group float-right mt-2">
								<button type="submit" class="btn btn-primary" value="Submit" name="edit_user">Update</button>
							</div>
						</div>
					</form>
					<form method="POST">
						<?php if (isset($msg2)) {echo $msg2."<br>";}?>
						<legend>Add a New User</legend>
						<div class="form-row mb-4">
							<div class="form-group col-md-2">
								<label class="control-label">First Name</label>
								<div class="input-group">
									<input class="form-control" type="text" name="fname">
								</div>
							</div>
							<div class="col-md-1"></div>
							<div class="form-group col-md-3">
								<label class="control-label">Last Name</label>
								<div class="input-group">
									<input class="form-control" type="text" name="lname">
								</div>
							</div>
							<div class="col-md-1"></div>
							<div class="form-group col-md-2">
								<label class="control-label">Username</label>
								<div class="input-group">
									<input class="form-control" type="text" name="uname">
								</div>
							</div>
							<div class="col-md-1"></div>
							<div class="form-group col-md-2">
								<label class="control-label">User Type</label>
								<select class="form-control" name="type">
									<option value="Manager">Manager</option>
									<option value="Superuser">Superuser</option>
									<option value="User">User</option>
								</select>
							</div>
						</div>
						<div class="clearfix">
							<div class="subButton btn-group float-right mt-2">
								<button type="submit" class="btn btn-primary" value="Submit" name="add_user">Add</button>
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