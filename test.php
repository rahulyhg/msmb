<?php

include('includes/htmlMimeMail.php');
$user['uniqueID'] = 143;
$user[name] = 'sushantTest';
$user[email] = 'ceb.sushant@gmail.com';

$strLink = $config["siteurl"] . "activate_member.php?id=" . $user[uniqueID];
$mailmsg = "";
$mailmsg .= "<style>td { font-family:verdana; font-size:11px; }</style>";
$mailmsg .= "Dear " . trim($user[name]) . ",<br><br>";
$mailmsg .= "<table cellpadding='3'>";
$mailmsg .= "<tr><td colspan='2'><font color='#ff9900'><b>Thank you</b></font> for your interest in Maa Shakti Marriage Bureau.</td></tr>";
$mailmsg .= "<tr><td colspan='2'>I personally wanted to welcome you to the <a target='_blank' herf='http://maashaktimarriage.com'>Maa Shakti Marriage Bureau</a>. Below you will find link to activate your account.</td></tr>";
$mailmsg .= "<tr><td colspan='2'><a href='" . $strLink . "' target='_blank'>Click Here</a> To Activate your Membership</td></tr>";
$mailmsg .= "<tr><td colspan='2'>We strongly recommend that you make your profile as attractive as possible so that it receives maximum response. Set Partner Preference  - Get Your my match immediately.</td></tr>";
$mailmsg .= "<tr><td colspan='2'><br><a target='_blank' href='http://maashaktimarriage.com/member_login.php'>Add your photographs</a> - Get 15 times more responses </td></tr>";
$mailmsg .= "<tr><td colspan='2'><br><a target='_blank' href='http://maashaktimarriage.com/member_login.php'>Add your horoscope</a> - Free in 9 Indian languages or upload scanned Horoscope</td></tr>";
$mailmsg .= "<tr><td colspan='2'><br><a target='_blank' href='http://maashaktimarriage.com/member_login.php'>Edit the profile</a> - when you required. </td></tr>";
$mailmsg .= "<tr><td colspan='2'><br><a target='_blank' href='http://maashaktimarriage.com/member_login.php'>Change your password</a> - regularly to protect your posted data.</td></tr>";
$mailmsg .= "<tr><td colspan='2'>We wish you all the best in your partner search. </td></tr>";
$mailmsg .= "<tr><td colspan='2'>Thanks,</td></tr><tr><td>Regards,</td></tr><tr><td> maashaktimarriage.com</td></tr></table>";
$strTo = $user[email];
$strFrom = "info@maashaktimarriage.com";
$strSubject = "Welcome to Maa Shakti Marriage Bureau";
$strContent = $mailmsg;
$mail  = new htmlMimeMail();
$mail->setSMTPParams('smtpout.asia.secureserver.net','80', null, null, 'info@maashaktimarriage.com','sainath');
$mail->setSubject($strSubject);
$mail->setFrom($strFrom);
$mail->setHtml($strContent);
if($mail->send($strTo, 'smtp')) {
    echo "mail send sucessfully";
} else {
    echo "mail send failed";
}
?>