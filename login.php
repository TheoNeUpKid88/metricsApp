<?php
session_start();
if(isset($_POST['Submit_Login'])) {
$uname = trim($_POST['uname']);
$pwd = md5(trim($_POST['psw']));
include('includes/dbc.php');
$sql = "SELECT * FROM users WHERE username = '$uname' AND password = '$pwd'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$_SESSION['user'] = $row['username'];
$_SESSION['role'] = $row['user_type'];
$_SESSION['fname'] = $row['first_name'];
$_SESSION['lname'] = $row['last_name'];
$_SESSION['user_id'] = $row['user_id'];
$_SESSION['logged_in'] = true;
$count = mysqli_num_rows($result);
if($count == 1)
{
if ($row['active']=='Disable')
{
   $msg = '<div class="alert alert-danger card-alert"> <strong>Your account has been disabled.</strong> Please see QI Management for access. </div>';
}
elseif ($row['user_type']=='Superuser')
{
header('Location: index.php');
}
elseif ($row['user_type']=='Manager')
{
header('Location: index.php');
}
elseif ($row['user_type']=='User')
{
header('Location: index.php');
}
$t_sql = "UPDATE users SET is_loggedin = 1 WHERE username = '$uname'";
$t_sql2 = "UPDATE users SET last_login=CURRENT_TIMESTAMP WHERE username = '$uname'";
$t_result = mysqli_query($con,$t_sql);
$t_result2 = mysqli_query($con,$t_sql2);
}
else {
   $msg = '<div class="alert alert-danger card-alert"> <strong>Invalid Credentials!</strong> Please try again. </div>';
}
}
?>
<!DOCTYPE HTML>
<html>

<head>
   <?php include("includes/head.inc"); ?>
   <?php include("includes/js.inc"); ?>
   <title>
      QI Metrics Login
   </title>
</head>

<body>
   <header class="jumbotron mt-4">
      <div class="container">
         <div class="display-4">QMETRIX Login
            <!-- <img src="images/Logo2.png" alt="logo"> -->
         </div>
      </div>
   </header>
   <div class="container">
      <div class="d-flex justify-content-center h-100">
         <div class="card">
            <div class="card-header">
               <h3>Sign In</h3>
            </div>
            <div class="card-body">
               <form method="POST">
                  <div class="input-group form-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                     </div>
                     <input type="text" class="form-control" placeholder="Username" name="uname">

                  </div>
                  <div class="input-group form-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                     </div>
                     <input type="password" class="form-control" placeholder="Password" name="psw">
                  </div>
                  <div class="row align-items-center">
                  </div>
                  <div class="form-group">
                     <input type="submit" value="Login" class="btn float-right login_btn" name="Submit_Login">
                  </div>
                  <?php if (isset($msg)) {echo $msg."<br>";}?>
               </form>
            </div>
            <div class="card-footer">
               <div class="d-flex justify-content-center">
                  <a href="password_reset.php" class="link_font">Forgot your password?</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>

</html>