<?php
$df_id = $_POST['df_id'];
	include('includes/dbc.php');
	$sql = "DELETE FROM defects WHERE df_id=$df_id";
	if($con->query($sql) === TRUE)
	{
        $edit_msg = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> Defect entry has been deleted.</div>';
        echo $edit_msg;
	}
	else
	{
        $edit_msg = '<div class="alert alert-danger mx-5 px-1"> <strong>Not deleted!</strong> Please try again. </div>';
        echo $edit_msg;
	}
?>