<?php 
    include('includes/dbc.php');
    $query = "SELECT SUM(tc_cont_gram)+SUM(tc_func)+SUM(tc_non_func) as tc_total, 
	user_id, tc_date
	FROM `tc_creation`
	WHERE 1=1
	AND tc_date BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -0 DAY)
	AND DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) -6 DAY)
	AND user_id=$user_id
	GROUP By tc_date
	Order By tc_date";
    $result = mysqli_query($con,$query);
    $o_data = array();
    while($row = mysqli_fetch_array($result)) {
        $output_data = array(
			"tc_total" => $row['tc_total']
        );
        $o_data[]=$output_data;
		}
		
		echo json_encode($o_data);
		
?>