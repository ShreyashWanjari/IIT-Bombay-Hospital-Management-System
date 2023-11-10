<?php
require_once("include/config.php");
if (!empty($_POST["email"])) {
	$email = $_POST["email"];

	$result = mysqli_execute_query($con, "SELECT id FROM users WHERE email=?", [$email]); #Done
	$count = mysqli_num_rows($result);
	if ($count > 0) {
		echo "<span style='color:red'>Email already exists.</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	} else {

		echo "<span style='color:green'>Email available for registration.</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
	}
}
