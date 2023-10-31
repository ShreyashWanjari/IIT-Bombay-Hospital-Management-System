<?php
session_start();
error_reporting(0);
include('../include/config.php');
if (strlen($_SESSION['id'] == 0)) {
	header('location:logout.php');
} else {
	//Code for Update the Content

	if (isset($_POST['submit'])) {

		$pagetitle = $_POST['pagetitle'];
		$pagedes = $con->real_escape_string($_POST['pagedes']);
		$query = mysqli_query($con, "update tblpage set PageTitle='$pagetitle',PageDescription='$pagedes' where  PageType='aboutus'");
		if ($query) {

			echo '<script>alert("About Us has been updated.")</script>';
		} else {
			echo '<script>alert("Something Went Wrong. Please try again.")</script>';
		}
	}

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Admin | About Us </title>

		<?php include_once("../include/head_links.php");
		echo generate_head_links(); ?>
		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script type="text/javascript">
			bkLib.onDomLoaded(nicEditors.allTextAreas);
		</script>
	</head>

	<body>
		<div id="app">
			<?php include('include/sidebar.php'); ?>
			<div class="app-content">


				<?php include('include/header.php'); ?>
				<!-- end: TOP NAVBAR -->
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin | Update the About us Content</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin </span>
									</li>
									<li class="active">
										<span>Update the About us Content</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">


							<div class="row">
								<div class="col-md-12">


									<form class="forms-sample" method="post">
										<?php

										$ret = mysqli_query($con, "select * from  tblpage where PageType='aboutus'");
										$cnt = 1;
										while ($row = mysqli_fetch_array($ret)) {

										?>
											<div class="form-group">
												<label for="exampleInputUsername1">Page Title</label>
												<input id="pagetitle" name="pagetitle" type="text" class="form-control" required="true" value="<?php echo $row['PageTitle']; ?>">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Page Description</label>
												<textarea class="form-control" name="pagedes" id="pagedes" rows="12"><?php echo $row['PageDescription']; ?></textarea>
											</div>

										<?php } ?>
										<button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
									</form>
								</div>
							</div>
						</div>

						<!-- end: BASIC EXAMPLE -->
						<!-- end: SELECT BOXES -->

					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
			<?php include('include/footer.php'); ?>
			<!-- end: FOOTER -->

			<!-- start: SETTINGS -->
			<?php include('include/setting.php'); ?>

			<!-- end: SETTINGS -->
		</div>
		<?php include_once("../include/body_scripts.php") ?>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>

	</html>
<?php } ?>