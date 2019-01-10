<?php
if(isset($_POST['edit_defect'])) {
        $df_id = $_POST['df_id'];
		$df_date = $_POST['df_date'];
		$df_date_new = strtotime($df_date);
		$date_to_srv = date("Y-m-d", $df_date_new);
		$df_pr = $_POST['df_pr'];
		$df_rnd = $_POST['df_rnd'];
		$cg_cri = $_POST['cg_cri'];
		$cg_maj = $_POST['cg_maj'];
		$cg_min = $_POST['cg_min'];
		$f_cri = $_POST['f_cri'];
		$f_maj = $_POST['f_maj'];
		$f_min = $_POST['f_min'];
		$nf_cri = $_POST['nf_cri'];
		$nf_maj = $_POST['nf_maj'];
		$nf_min = $_POST['nf_min'];
		$df_source = $_POST['df_source'];
		include('includes/dbc.php');
		$sql = "INSERT INTO defects (user_id, pr_id, df_round, cg_critical, cg_major, cg_minor, func_critical, func_major, func_minor, nonf_critical, nonf_major, nonf_minor, tcs_id, df_date) VALUES ('$user_id','$df_pr','$df_rnd','$cg_cri', '$cg_maj','$cg_min','$f_cri', '$f_maj','$f_min','$nf_cri', '$nf_maj','$nf_min','$df_source','$date_to_srv' WHERE df_id='$df_id')";
		if($con->query($sql) === TRUE)
		{
			$edit_msg = '<div class="alert alert-success mx-5 px-1"> <strong>Success!</strong> Defect entry has been updated.</div>';
		}
		else
		{
			$edit_msg = '<div class="alert alert-danger mx-5 px-1"> <strong>Not updated!</strong> Please try again. </div>';
		}
	}
?>