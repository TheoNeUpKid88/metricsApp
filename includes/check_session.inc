<?php
	session_start();
	$user = $_SESSION['user'];
	$role = $_SESSION['role'];
	$login = $_SESSION['logged_in'];
	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];
	$user_id = $_SESSION['user_id'];
	if ($login != true) {
		header('Location: login.php');
	}
	$referer = $_SERVER['HTTP_REFERER'];
	if(isset($_SESSION['MSG'])){
   	  //echo $_SESSION['MSG'];
	//unset($_SESSION["message"]);
   	}
?>