<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["Send"])){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'shreyashwanjari5162@gmail.com'; // Enter your Gmail email here
    $mail->Password = 'onxtdlskyrabqlhs'; // Enter your Gmail password here
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('shreyashwanjari5162@gmail.com', 'Your Name'); // Enter your name here

    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);

    $mail->Subject = $_POST["subject"];
    $mail->Body = $_POST["message"];

    if($mail->send()){
        echo '<script>alert("Sent Successfully");</script>';
    } else {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>

