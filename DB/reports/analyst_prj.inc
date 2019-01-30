<?php 
include('../../includes/dbc.php');
	$query_timeSpent = "SELECT l.pr_id,
       l.user_id,
       l.l_type,
       l.tl_date,
       TIME_FORMAT(SUM(l.tl_time), '%H:%i:%s') as "l.tl_time"
        FROM time_log l
        WHERE l.user_id = 6
        AND l.pr_id IS NOT NULL
        GROUP BY l.pr_id, l.l_type
        ORDER BY l.user_id, l.pr_id";
    $result_timeSpent = mysqli_query($con,$query_timeSpent);
	$time_spent = '';
    while($row = mysqli_fetch_array($result_timeSpent)) {
		$time_spent = $time_spent.$row['l.tl_time'].',';
	}
		$time_spent = trim($time_spent,",");
?>