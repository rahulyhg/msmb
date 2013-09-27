<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/
//$path = '/lab/mailer';
//set_include_path(get_include_path() . PATH_SEPARATOR . $path);
//echo get_include_path();
require '../class.phpmailer.php';

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	$body             = file_get_contents('contents.html');
	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes

	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 465;                    // set the SMTP server port
	/*$mail->Host       = "smtpout.asia.secureserver.net"; // SMTP server
	$mail->Username   = "info@maashaktimarriage.com";     // SMTP server username
	$mail->Password   = "sainath";            // SMTP server password*/
	$mail->Host       = "smtp.gmail.com"; // SMTP server
	$mail->Username   = "prasadsonam86@gmail.com";     // SMTP server username
	$mail->Password   = "sainatha";            // SMTP server password
	$mail->SMTPDebug   = true;            // SMTP server password

	$mail->IsSendmail();  // tell the class to use Sendmail

	$mail->AddReplyTo("info@maashaktimarriage.com","First Last");

	$mail->From       = "info@maashaktimarriage.com";
	$mail->FromName   = "Maa Shakti";

	$to = "ceb.sushant@gmail.com";

	$mail->AddAddress($to);

	$mail->Subject  = "First PHPMailer Message";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	if($mail->Send()) {
            echo 'Message has been sent.';
        }
	
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>