<?php
	include('../../includes/dbc.php');
	$query_tc = "SELECT SUM(tc_cont_gram)+SUM(tc_func)+SUM(tc_non_func) as tc_total, 
	user_id, tc_date
	FROM `tc_creation`
	WHERE 1=1
	AND tc_date BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -0 DAY)
	AND DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -6 DAY)
	AND user_id=$user_id
	GROUP By tc_date
	Order By tc_date";
    $result_tc = mysqli_query($con,$query_tc);
	//$o_data = array();
	$tc_total = '';
    while($row = mysqli_fetch_array($result_tc)) {
		$tc_total = $tc_total.$row['tc_total'].',';
	}
		$tc_total = trim($tc_total,",");

		$query_df = "SELECT SUM(cg_critical)+SUM(cg_major)+SUM(cg_minor)+SUM(func_critical)+SUM(func_major)+SUM(func_minor)+SUM(nonf_critical)+SUM(nonf_major)+SUM(nonf_minor) as df_total,
		user_id
		FROM `defects`
		WHERE 1=1
		AND df_date BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -0 DAY)
		AND DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -6 DAY)
		AND user_id=$user_id
		GROUP By df_date
		Order By df_date";
		 $result_df = mysqli_query($con,$query_df);
		 //$o_data = array();
		 $df_total = '';
		 while($row = mysqli_fetch_array($result_df)) {
			 $df_total = $df_total.$row['df_total'].',';
		 }
			 $df_total = trim($df_total,",");

			 $query_tce = "SELECT SUM(cont_gram_pass)+SUM(cont_gram_fail)+SUM(func_pass)+SUM(func_fail)+SUM(non_func_pass)+SUM(non_func_fail) as tce_total,
			 user_id
			 FROM `tc_execution`
			 WHERE 1=1
			 AND exec_date BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -0 DAY) AND DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -6 DAY)
			 AND user_id=$user_id
			 GROUP BY exec_date
			 Order By exec_date";
			  $result_tce = mysqli_query($con,$query_tce);
			  //$o_data = array();
			  $tce_total = '';
			  while($row = mysqli_fetch_array($result_tce)) {
				  $tce_total = $tce_total.$row['tce_total'].',';
			  }
				  $tce_total = trim($tce_total,",");
?>