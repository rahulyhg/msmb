<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require '../class.phpmailer.php';

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	$body             = "Hi sushant mail test 12:44 PM";
	
        $mail->SMTPDebug = 2;
	$mail->IsSMTP();                           // tell the class to use SMTP
	//$mail->SMTPAuth   = true;                  // enable SMTP authentication
	//$mail->Port       = 25;                    // set the SMTP server port
	$mail->Host       = "relay-hosting.secureserver.net"; // SMTP server
	$mail->IsSendmail();  // tell the class to use Sendmail

	$mail->AddReplyTo("info@maashaktimarriage.com","First Last");

        $to = "ceb.sushant@gmail.com";

	$mail->AddAddress($to);

	$mail->Subject  = "First PHPMailer Message Suuhant 22 -7 2012";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	if($mail->Send()) {
            echo 'Message has been sent.';
        } else {
            echo 'Message has failed to sent.';
        }
	
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>