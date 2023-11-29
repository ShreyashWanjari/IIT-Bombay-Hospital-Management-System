<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Admin->value;

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
	exit;
}

?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

<head>
	<?php
	$pageName = 'Patient Search';
	include('../include/new-header.php');
	?>

</head>

<body>
	<!-- Layout wrapper -->
	<div class="layout-wrapper layout-content-navbar">
		<div class="layout-container">
			<!-- Menu -->

			<?php include('./include/nav.php'); ?>

			<!-- / Menu -->

			<!-- Layout container -->
			<div class="layout-page">
				<!-- Navbar -->

				<?php include('../include/navbar.php'); ?>

				<!-- / Navbar -->

				<!-- Content wrapper -->
				<div class="content-wrapper">
					<!-- Content -->
					<div class="container-xxl flex-grow-1 container-p-y">
						<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?php echo UserTypeAsString[$userType]; ?> /</span> <?php echo $pageName; ?></h4>

						<div class="row">


							<?php include_once("../templates/patient-search.php") ?>


							<div class="content-backdrop fade"></div>
						</div>
						<!-- Content wrapper -->
					</div>
					<!-- / Layout page -->
				</div>

				<!-- Overlay -->
				<div class="layout-overlay layout-menu-toggle"></div>
			</div>
			<!-- Main JS -->

			<?php include('../include/links.php'); ?>

			<?php include_once("../include/body_scripts.php") ?>
			<script>
				jQuery(document).ready(function() {
					Main.init();
					FormElements.init();
				});
			</script>


</body>



</html>