 <!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
</head>
<body>
    <form class="" action="send.php" method="post">
        <br>
        Email <input type="text " name="email" value=""> <br>
        Subject <input type="text" name="subject" value=""> <br>
        Message <input type="text " name="message" value=""> <br>

        <button type="submit" name="send">Send</button>
    </form>
</body>
</html> 
 -->




 <!-- --------------------------------v2--------------------- -->

 

<!-- ----------final---------------------- -->

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        form {
            width: 80%;
            max-width: 400px;
            background-color: #f4f4f4;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 10px 10px 20px #c9c9c9, 
                        -10px -10px 20px #ffffff;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #d1d1d1;
            border-radius: 5px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form class="" action="send.php" method="post" enctype="multipart/form-data">
        <br>
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email" value=""><br><br>

        <label for="subject">Subject</label><br>
        <input type="text" id="subject" name="subject" value="This is a subject"><br><br>

        <label for="message">Message</label><br>
        <input type="text" id="message" name="message" value="this is the main body of the email :]"><br><br>

        <label for="file">Choose a file to upload:</label><br>
        <input type="file" id="file" name="file" oninput="fileUploaded()"><br><br>

        

        <div id="uploadStatus"></div>

        <button type="submit" name="send">Send</button>
    </form>

    <script>
        function fileUploaded() {
            const fileInput = document.getElementById('file');
            const uploadStatus = document.getElementById('uploadStatus');
            uploadStatus.innerText = `${fileInput.files[0].name} is uploaded`;
        }
    </script>
</body>
</html> -->






<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{

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
		<title>Doctor  |  IIT Bombay Mail</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
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
        <style>
        /* body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            padding:200px;
        } */
.left{
    background-color:#f0f0f0;
}
        form {
            width: 100%;
            max-width: 4000px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            /* box-shadow: -2px -2px 4px gray, 
                        2px 2px 4px gray; */
        }

        /* .right {

            float: right;
            width: 80%;
            max-width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
        } */

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #d1d1d1;
            border-radius: 5px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            /* border: none; */
            border-radius: 5px;
            /* background-color: #1AA7EC; */
            color: white;
            font-size: 16px;
            cursor: pointer;
        }


        #file {
        border: 7px dashed #bbb;
        border-radius: 5px;
        padding: 45px;
        text-align: center;
        font-family: Arial;
        color: #bbb;
        cursor: pointer;
    }

    #file.dragover {
        border-color: #000;
    }









    </style>

	</head>
	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
			<div class="app-content">
				
						<?php include('include/header.php');?>
						
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container" >
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Doctor | IIT Bombay Mail</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>User</span>
									</li>
									<li class="active">
										<span>Mail</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						     <!-- start: BASIC EXAMPLE -->
							 
                             <div style="display: flex;">
    <div class="left" style="padding: 40px;">
        <form class="" action="send.php" method="post" enctype="multipart/form-data">

            <br>
            
            <label for="email" style="color: black;">Email</label><br>
            <input type="text" id="email" name="email" value=""><br><br>

            <label for="subject" style="color: black;">Subject</label><br>
            <input type="text" id="subject" name="subject" value="IIT Bombay Hospital"><br><br>

            <label for="message" style="color: black;">Message</label><br>
            <input type="text" id="message" name="message" value="<div style='font-family: Arial, sans-serif; font-size: 14px;'>
           
           <br>
           <h2>IIT Bombay Hospital Management</h2>
               
       <h2>Medical Certificate for Sick Leave Granted</h2>
   
   <p>From doctor : <?php echo $doctorName; ?>,</p>
   
   <p>I hope this message finds you well.</p>
   
   <p>This email is to confirm that Attached student, has been under my care at the IIT Bombay Medical Center. After a thorough examination, it has been determined that they are currently unfit to attend work/study due to [state the medical condition or reason for leave]. Therefore, I am issuing this medical certificate as a confirmation of their need for a sick leave from [start date] to [end date].</p>
   
   <p>Please find the attached pink slip (medical certificate) for your reference and records. Should you require any further information or clarification, please do not hesitate to contact me.</p>
   
   <p>Wishing you a speedy recovery.</p>
   
   <p>Thank you for your attention to this matter.</p>
   
   <p>Sincerely,</p>
   
   <p><?php echo $doctorName; ?>
       <br>
       M.B.B.S / M.D<br>
       IIT Bombay Medical Center<br>
       [Contact Information]</p>
   
           </div>"  >
            
            <br><br>

            <label for="file" style="color: black;">Choose a file to upload:</label><br>
            <input type="file" id="file" name="file"><br><br>

            <button type="submit" name="send" style="border-radius: 4px; border-color: #1AA7EC; color: black;">Send</button>
        </form>
    </div>

    <div class="right" style="padding: 40px;">
        <div class="container-mail" style="font-family: Arial, sans-serif; font-size: 14px;">
        <br>
        <h2>IIT Bombay Hospital Mail Format</h2>
            
    <h2>Subject: Medical Certificate for Sick Leave</h2>

<p>From doctor : <?php echo $doctorName; ?>,</p>

<p>I hope this message finds you well.</p>

<p>This email is to confirm that Attached student, has been under my care at the IIT Bombay Medical Center. After a thorough examination, it has been determined that they are currently unfit to attend work/study due to [state the medical condition or reason for leave]. Therefore, I am issuing this medical certificate as a confirmation of their need for a sick leave from [start date] to [end date].</p>

<p>Please find the attached pink slip (medical certificate) for your reference and records. Should you require any further information or clarification, please do not hesitate to contact me.</p>

<p>Wishing you a speedy recovery.</p>

<p>Thank you for your attention to this matter.</p>

<p>Sincerely,</p>

<p><?php echo $doctorName; ?>
    <br>
    M.B.B.S / M.D<br>
    IIT Bombay Medical Center<br>
    [Contact Information]</p>

        </div>
    </div>
</div>

                            


						
					
						<!-- end: SELECT BOXES -->
						
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
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

