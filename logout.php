<?php
	session_start();
	$user = $_SESSION['user'];
	$login = $_SESSION['logged_in'];
	include('includes/dbc.php');
	$logout_sql = "UPDATE users SET is_loggedin = 0 WHERE username = '$user'";
	$logout_result = mysqli_query($con,$logout_sql);
	session_destroy();
	header("Location:login.php");
?>