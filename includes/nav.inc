<div class="clearfix mt-1 mb-2">
	<div style="float: right; color: #beb28b; font-size: 18px;"><i class="far fa-user" style="color: #fec400;"></i> You are logged in as <?php include("includes/fullname.inc"); ?> </div>
</div>
<nav class="navbar navbar-expand-sm navbar-dark mb-4">
	<div class="navbar-nav">
		<li class="nav-item active">
			<a class="nav-link" href="index.php" ><i class="fas fa-home" style="padding-right: 1em;"></i></a>
		</li>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item dropdown" id="user">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
						Timelog
					</a>
					<div class="dropdown-menu m-0">
						<a class="dropdown-item" href="project_time.php">Projects</a>
						<a class="dropdown-item" href="tickets.php">Tickets</a>
					</div>
				</li>
			</ul>
		</div>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item dropdown" id="user-2">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
						Leads
					</a>
					<div class="dropdown-menu m-0">
						<a class="dropdown-item" href="lead_status.php">Project Status</a>
						<a class="dropdown-item" href="lead_defects.php">Defect Resolution</a>
					</div>
				</li>
			</ul>
		</div>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item dropdown" id="user-3">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
						QC
					</a>
					<div class="dropdown-menu m-0">
						<a class="dropdown-item" href="test_cases.php">Test Cases</a>
						<a class="dropdown-item" href="execution.php">Execution</a>
						<a class="dropdown-item" href="defects.php">Defects</a>
					</div>
				</li>
			</ul>
		</div>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item dropdown" id="user-4">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
						Reports
					</a>
					<div class="dropdown-menu m-0">
						<a class="dropdown-item" href="#">My Projects</a>
						<a class="dropdown-item" href="#">My QC</a>
					</div>
				</li>
			</ul>
		</div>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item dropdown" id="superuser">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
						Admin
					</a>
					<div class="dropdown-menu m-0">
						<a class="dropdown-item" href="attendance.php">Attendance</a>
						<a class="dropdown-item" href="project_admin.php">Project Management</a>
						<a class="dropdown-item" href="ticket_admin.php">Ticket Management</a>
						<a class="dropdown-item" href="user_admin.php">User Management</a>
					</div>
				</li>
			</ul>
		</div>
		<li class="nav-item">
			<a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
		</li>
	</div>
</nav>
