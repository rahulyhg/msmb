<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121recoveruser.php                                           **
 **  Date modified:     23/03/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Lost login function - do email check with link to reset password**
 *****************************************************************************************/

/*****************************************************************************************
 **    This file is part of PHP121.                                                     **
 **                                                                                     **
 **    PHP121 is free software; you can redistribute it and/or modify                   **
 **    it under the terms of the GNU General Public License as published by             **
 **    the Free Software Foundation; either version 2 of the License, or                **
 **    (at your option) any later version.                                              **
 **                                                                                     **
 **    PHP121 is distributed in the hope that it will be useful,                        **
 **    but WITHOUT ANY WARRANTY; without even the implied warranty of                   **
 **    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                    **
 **    GNU General Public License for more details.                                     **
 **                                                                                     **
 **    You should have received a copy of the GNU General Public License                **
 **    along with PHP121; if not, write to the Free Software                            **
 **    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA       **
 *****************************************************************************************/

require_once("php121db.php");

if ($acctman == 0) {
        die (_ACCESS_DENIED);
}
?>

<html>
<head>
<title>Matrmonial shaadi  - <?php echo _TITLE_LOST_LOGIN; ?></title>
</head>
<body>

<?php
echo $opentable;

function userRecover($username, $user_email) {
	global $php121db, $siteurl, $webmaster;
	global $db_usertable, $dbf_uid, $dbf_uname, $dbf_upassword, $dbf_passwordtype, $dbf_uemail;
	global $dbf_user_chatting, $dbf_smilies, $dbf_level, $dbf_showrequest;
	global $dbf_uname_len, $dbf_upassword_len, $dbf_uemail_len;
	
        $stop = "";
        if ($username == "" && $user_email == "") {
                $stop = "<font color=\"FF0000\">" . _ENTER_EITHER_U_OR_E . "</font><br>";
        } else {
		//something has been entered
                if ($username != "" && mysql_num_rows(mysql_query("SELECT $dbf_uname FROM $db_usertable WHERE $dbf_uname='$username'", $php121db)) == 0) {
                        $stop .= "<font color=\"FF0000\">" . _USERNAME_NOT_FOUND . "</font><br>";
                } else if (!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$", $user_email) && $user_email != "") {
                        $stop .= "<font color=\"FF0000\">" . _INVALID_EMAIL . "</font><br>";
                } else if ($user_email != "" && mysql_num_rows(mysql_query("SELECT $dbf_uemail FROM $db_usertable WHERE $dbf_uemail='$user_email'", $php121db)) == 0 ) {
                        $stop .= "<font color=\"FF0000\">" . _EMAIL_NOT_FOUND . "</font><br>";
                }
        }
        return($stop);
}

$username = makedbsafe($_POST[username]);
$password = makedbsafe($_POST[password]);
$confirmpassword = makedbsafe($_POST[confirmpassword]);
$user_email = makedbsafe($_POST[email]);
$currentpass = makedbsafe($_POST[currentpass]);
$submit = $_POST[check];
$lookup = $_POST[lookup];

if ($submit == 1){
	//just submitted, so do the lookup
	$stop = userRecover($username, $user_email);
	if ($stop != "") {
		echo $stop;
	} else {
		$message = _TO_RECOVER_PASSWORD . "\n\n";
		if ($username != "") {
			$row = mysql_fetch_row(mysql_query("SELECT $dbf_uemail,$dbf_upassword from $db_usertable WHERE $dbf_uname='$username'", $php121db));
			$message .= $siteurl . "php121resetpass.php?user=" . $username . "&code=" . substr($row[1], 0, 9) . "\n";
			$user_email = $row[0];
		} else {
			//email address entered
			$row = mysql_fetch_row(mysql_query("SELECT $dbf_uname,$dbf_upassword from $db_usertable WHERE $dbf_uemail='$user_email'", $php121db));
			$message .= $siteurl . "php121resetpass.php?user=" . $row[0] . "&code=" . substr($row[1], 0, 9) . "\n";
		}
		$subject="PHP121: " . _RESET_LOGIN_DETAILS;
		$from = "info@thecreativeit.com <$webmaster>";
		mail($user_email, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());
		echo _INSTRUCTIONS_MAILED . "<p>" . _GO_BACK . " <a href=\"php121login.php\">" . _LOGIN . "</a>";
		die;
	}
}

echo _ENTER_EITHER_U_OR_E . "<br>";
?>

<form name="userlookup" method="POST">
<?php echo _USERNAME; ?>:<br><input type="text" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px" name="username" size="20" maxlength="<?php echo $dbf_uname_len; ?>">

<p><u><?php echo _OR; ?></u><p>

<?php echo _EMAIL; ?>:<br><input type="text" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px" name="email" size="20" maxlength="<?php echo $dbf_uemail_len; ?>">
<p>

<input type="submit" value="<?php echo _RESET_PASSWORD; ?>" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px">
<input type="hidden" name="check" value="1">
</form>
<font style="FONT-SIZE: 10px">
<a href="php121login.php"><?php echo _CANCEL; ?></a>
</font>

<?php echo $closetable; ?>
</body>
</html>
