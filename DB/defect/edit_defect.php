<?php
	$df_id=$_POST['df_id'];
	$day_date=$_POST['day_date'];

	include('../../includes/dbc.php');
	$sql = "SELECT * WHERE df_id=".$df_id;
	$result = mysqli_query($con,$sql);
	if($result == true)
	{
        $edit_msg = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> Defect entry has been updated.</div>';
	echo $edit_msg;
	}
	else
	{
        $edit_msg = '<div class="alert alert-danger mx-5 px-1"> <strong>Not updated!</strong> Please try again. </div>';
	//echo $edit_msg;
	echo $df_id;
	echo $day_date;
	
	}
	//header('Location:../../defects.php');
?>