<?php
	$df_id=$_GET['id'];
	
	include('../../includes/dbc.php');
	$sql = "DELETE FROM defects WHERE df_id=".$df_id;
	$result = mysqli_query($con,$sql);
	if($result == true)
	{
        $del_msg = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> Defect entry has been deleted.</div>';
	echo $del_msg;
	}
	else
	{
        $del_msg = '<div class="alert alert-danger mx-5 px-1"> <strong>Not deleted!</strong> Please try again. </div>';
	echo $del_msg;
	}
	header('Location:../../defects.php');
?>