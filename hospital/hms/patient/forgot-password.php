<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include("../include/config.php");
//Checking Details for reset password
if (isset($_POST['submit'])) {
	$name = $_POST['fullname'];
	$email = $_POST['email'];
	$query = mysqli_execute_query($con, "select id from users where fullName=? and email=?", [$name, $email]); #Done2
	$row = mysqli_num_rows($query);
	if ($row > 0) {

		$_SESSION['name'] = $name;
		$_SESSION['email'] = $email;
		header('location:reset-password.php');
	} else {
		echo "<script>alert('Invalid details. Please try with valid details');</script>";
		echo "<script>window.location.href ='forgot-password.php'</script>";
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Patient Password Recovery</title>

	<?php include_once("../include/head_links.php");
	echo generate_head_links("3", true); ?>
</head>

<body class="login">
	<div class="row">
		<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="logo margin-top-30">
				<a href="../index.php">
					<h2>IITB HMS | Patient Password Recovery</h2>
				</a>
			</div>

			<div class="box-login">
				<form class="form-login" method="post">
					<fieldset>
						<legend>
							Patient Password Recovery
						</legend>
						<p>
							Please enter your Email and password to recover your password.<br />

						</p>

						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="text" class="form-control" name="fullname" placeholder="Registred Full Name">
								<i class="fa fa-lock"></i>
							</span>
						</div>

						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" name="email" placeholder="Registred Email">
								<i class="fa fa-user"></i> </span>
						</div>

						<div class="form-actions">

							<button type="submit" class="btn btn-primary pull-right" name="submit">
								Reset <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
						<div class="new-account">
							Already have an account?
							<a href="user-login.php">
								Log-in
							</a>
						</div>
					</fieldset>
				</form>

				<div class="copyright">
					&copy; <span class="text-bold text-uppercase">IITB Hospital Management System</span>
				</div>

			</div>

		</div>
	</div>

	<?php include_once("../include/login_body_scripts.php"); ?>

	<script>
		jQuery(document).ready(function() {
			Main.init();
			Login.init();
		});
	</script>

</body>
<!-- end: BODY -->

</html>