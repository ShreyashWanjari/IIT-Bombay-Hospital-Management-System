

<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['id'] == 0)) {
	header('location:logout.php');
} else {

	?>




<?php
session_start();
// Establish a database connection
$con = mysqli_connect("localhost", "root", "", "hms");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$doctorName = "";
if (isset($_SESSION['id'])) {
    $query = mysqli_query($con, "select doctorName from doctors where id='" . $_SESSION['id'] . "'");
    while ($row = mysqli_fetch_array($query)) {
        $doctorName = $row['doctorName']; // storing the value in the variable
    }
}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Doctor | Dashboard</title>

		<link
			href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
			rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-3.css" id="skin_color" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
		<!-- <link rel="stylesheet" href="./style.css"> -->
		<style>
			.mainContainer {
				display: absolute;
				justify-content: left;
				background-color: #f0f0f0;
			}

			h1 {
				text-align: center;
				color: #333;

			}

			a {
				text-decoration: none;
				color: black;
			}

			form {

				max-width: 450px;
				margin: 0 auto;
				background-color: #fff;
				padding: 20px;
				border-radius: 4px;
				box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
			}

			label {
				display: block;
				margin-bottom: 10px;
				color: #333;
			}

			input[type="text"] {
				width: 100%;
				padding: 10px;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
				margin-bottom: 20px;
			}

			.button-container {
				display: flex;
				justify-content: space-between;
				margin-top: 20px;
			}

			.format-selector {
				margin-top: 10px;
				margin: 10px;
			}


			#pinkslip {
				display: block;
				margin: 100px auto;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
				background-image: url('pink_slip.png');
				/* Replace 'path_to_your_image.jpg' with the actual path to your image */
				background-size: cover;
				background-position: center;
				padding: 20px;
				max-width: 800px;

				background-repeat: no-repeat;

			}


			.certificate-title {
				font-size: 24px;
				font-weight: bold;
				text-align: center;
				margin-bottom: 20px;
			}

			.recipient-name {
				font-size: 20px;
				text-align: center;
				margin-bottom: 10px;
			}

			.achievement {
				font-size: 18px;
				text-align: center;
				margin-bottom: 30px;
			}

			.signature {
				display: flex;
				justify-content: center;
				margin-top: 20px;
			}

			.signature img {
				width: 200px;
				height: 100px;
				border: 1px solid #ccc;
				border-radius: 4px;
			}

			.date {
				text-align: right;
				font-style: italic;
				color: #888;
			}

			#signatureContainer {
				display: flex;
				flex-direction: column;
				align-items: center;
				margin-top: 10px;
				text-align: center;

			}

			#signatureCanvas {
				border: 1px solid #ccc;
				background: #fff;
				border-radius: 4px;
				margin: 10px auto;

				width: 450px;
			}

			#signatureInstructions {
				color: black;
				font-style: italic;
				margin-top: 10px;
			}

			#downloadButton {
				/* background-color: #0000ff; */
			}

			#downloadButton:hover {
				/* background-color: black; */
			}

			.left {
				float: left;
				padding: 20px;
			}

			.right {
				position: flex;
				left: 100px;
				/* Adjust this value according to your needs */



			}

			button {
				/* padding: 10px 20px;
				b-color: black;
				color: #fff;
				border: none;
				border-radius: 4px;
				cursor: pointer;
			    font-size: 16px; */
				/* transition: background-color 0.3s;  */
				border-radius: 4px;
				border-color:#1AA7EC;
                background-color:white;

			}

			button:hover {
				/* background-color: #0000ff; */
			}
		</style>
	</head>

	<body>
		<div id="app">
			<?php include('include/sidebar.php'); ?>
			<div class="app-content">

				<?php include('include/header.php'); ?>

				<!-- end: TOP NAVBAR -->
				<div class="main-content">
					<div class="wrap-content container" id="container" style="background-color:#d3d3d3;">
						<!-- start: PAGE TITLE -->
						<!-- <section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Doctor | Dashboard</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>User</span>
									</li>
									<li class="active">
										<span>Dashboard</span>
									</li>
								</ol>
							</div>
						</section> -->
						<!-- end: PAGE TITLE -->
						<div class="mainContainer">

							<div class="left">




								<form action="mail.php" method="post">
									<label for="recipientName">Student's Name:</label>
									<input type="text" id="recipientName" required>
									<label for="achievement">Reason:</label>
									<input type="text" id="achievement" required>
									<label for="studentroll">Student's Roll No:</label>
									<input type="text" id="studentroll" required>
									<label for="doctorname">Doctor's Name:</label>
									<input type="text" id="doctorname" value="<?php echo $doctorName; ?>">
									<div class="button-container">
										<button type="button" onclick="generateCertificate()">Generate Certificate</button>
										<div class="format-selector">
											<label for="format">Download Format:</label>
											<select id="format">
												<!-- <option value="pdf">PDF</option> -->
												<option value="png">PNG</option>
												<option value="jpeg">JPEG</option>
											</select>
										</div>
										<button id="downloadButton" type="button" onclick="downloadCertificate()">Download
											Certificate</button>
									</div>
								</form>





								<div id="signatureContainer">
									<canvas id="signatureCanvas" width="450" height="225"></canvas>
									<div id="signatureInstructions">Click and drag to draw your signature</div>
								</div>
							</div>



						</div>




						<canvas id="pinkslip" width="800" height="600"></canvas>



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




		<!-- start: MAIN JAVASCRIPTS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
		<!-- partial -->
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js'></script>
		<script src="./PinkSlip_Gen/script.js"></script>


		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<!-- <script src="./PinkSlip_Gen/script.js"></script> -->
		<script>
			jQuery(document).ready(function () {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>

	</html>
<?php } ?>