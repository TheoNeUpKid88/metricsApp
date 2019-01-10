<?php
if(isset($_POST['reset_pwd'])) {
$uname = trim($_POST['uname']);
$pwd = md5($_POST['pwd']);
$npwd = md5($_POST['newpwd']);
$npwd1 = md5($_POST['newpwd_1']);
include('includes/dbc.php');
$sql = "SELECT * FROM users WHERE username = '$uname' AND password = '$pwd'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$_SESSION['user'] = $row['username'];
$count = mysqli_num_rows($result);
if($count == 1)
{
if ($npwd==$npwd1)
{
$changepwd = "UPDATE users SET password = '$npwd1' WHERE username = '$uname'";
$npwd_result = mysqli_query($con,$changepwd);
header('Location: login.php');
}
else {
  $msg = '<div class="alert alert-danger card-alert"> <strong>Passwords do not match!</strong> Please try again. </div>';
}
}
else {
  $msg = '<div class="alert alert-danger card-alert"> <strong>Invalid Credentials!</strong> Please try again. </div>';
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("includes/head.inc"); ?>
  <?php include("includes/js.inc"); ?>
  <title>Password Reset</title>
</head>

<body>
  <header class="jumbotron mt-4">
    <div class="container">
      <div class="display-4">Reset My Password
        <!-- <img src="images/Logo2.png" alt="logo"> -->
      </div>
    </div>
  </header>
  <div class="container">
    <div class="d-flex justify-content-center h-100">
      <div class="card login_card ">
        <div class="card-header login_card-header">
          <h3>Enter Your New Credentials</h3>
        </div>

        <div class="card-body">
          <form method="POST">

            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" class="form-control mr-3" name="uname" placeholder="Username">

            </div>
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" class="form-control mr-3" name="pwd" placeholder="Current Password">
            </div>
            <div class="input-group form-group pass_show">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" class="form-control mr-3" name="newpwd" placeholder="New Password">
            </div>
            <div class="input-group form-group pass_show">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" class="form-control mr-3" name="newpwd_1" placeholder="Confirm Password">
            </div>
            <div class="row align-items-center">
            </div>
            <div class="form-group">
              <input type="submit" value="Reset" class="btn float-right login_btn" name="reset_pwd">
            </div>
            <?php if (isset($msg)) {echo $msg."<br>";}?>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>