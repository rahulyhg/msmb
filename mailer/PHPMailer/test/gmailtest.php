<?php
require '../class.phpmailer.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 2; // 1 tells it to display SMTP errors and messages, 0 turns off all errors and messages, 2 prints messages only.
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
$mail->Host = "smtp.gmail.com";
$mail->Port = 25;

$mail->Username = "ceb.sushant@gmail.com";
$mail->Password = "Nishant1234";

$mail->From = "info@maashaktimarriage.com";
$mail->FromName = "Name of sender HERE";
$mail->AddAddress("sushant.prasad@live.com", "Name of recipient HERE");
//$mail->AddReplyTo("Email Address HERE", "Name HERE"); // Adds a "Reply-to" address. Un-comment this to use it.
$mail->Subject = "Put Subject of message HERE";
$mail->Body = "Put body of message HERE.";

if ($mail->Send() == true) {
    echo "The message has been sent";
} else {
    echo "The email message has NOT been sent for some reason. Please try again later.";
    echo "Mailer error: " . $mail->ErrorInfo;
}
?>