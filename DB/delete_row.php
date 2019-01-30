<?php
	$df_id=$_GET['id'];
	$table=$_GET['table'];
	$id_name=$_GET['id_name'];
	include('../includes/dbc.php');
	$sql = "DELETE FROM $table WHERE $id_name=".$df_id;
	$result = mysqli_query($con,$sql);
	if($result == true)
	{
	session_start();
	$_SESSION['MSG'] = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> Defect entry has been deleted.</div>';
	header('Location:'.$_SERVER['HTTP_REFERER']);
	}
	else
	{
        $del_msg = '<div class="alert alert-danger mx-5 px-1"> <strong>Not deleted!</strong> Please try again. </div>';
	echo $del_msg;
	}
	
?>
