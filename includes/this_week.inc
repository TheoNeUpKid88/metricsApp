<h2 class="mb-4 text-center">This Week<br><?php
	date_default_timezone_set('America/New_York');
	$monday = date('F jS', strtotime('monday this week'));
	$sunday = date('F jS, Y', strtotime('sunday this week'));
	echo $monday." - ".$sunday;
?>
</h2>