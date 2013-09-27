<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121resetpass.php                                             **
 **  Date modified:     23/03/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Reset password if email check is ok                             **
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
<title>Matrmonial shaadi  - <?php echo _RESET_PASSWORD; ?></title>
</head>
<body>

<?php
global $db_usertable, $dbf_uid, $dbf_uname, $dbf_upassword, $dbf_passwordtype, $dbf_uemail;
global $dbf_user_chatting, $dbf_smilies, $dbf_level, $dbf_showrequest;

$username = makedbsafe($_GET[user]);
$code = makedbsafe($_GET[code]);
$newpass = makedbsafe($_POST[newpass]);
$password = makedbsafe($_POST[password]);
$confirmpassword = makedbsafe($_POST[confirmpassword]);
echo $opentable;
if ($username == "" || $code == "") {
	die ("<font color=\"FF0000\">" . _INCOMPLETE_URL . "</font>");
}
?>

<script type=\"text/javascript\">
<!--
var newwindow;
function poptastic(url) {
	newwindow=window.open(url,'name','height=400,width=200,left=20,top=20,toolbar=no,menubar=no,directories=no,location=no,scrollbars=no,status=no,resizable=yes,fullscreen=no');
	if (window.focus) { newwindow.focus() }
}
//-->
</SCRIPT>

<?php
function userLookup($username) {
        global $php121db, $code;
	global $db_usertable, $dbf_uid, $dbf_uname, $dbf_upassword, $dbf_passwordtype, $dbf_uemail;
	global $dbf_user_chatting, $dbf_smilies, $dbf_level, $dbf_showrequest;

        $stop = "";
	$query = mysql_query("SELECT $dbf_upassword FROM $db_usertable WHERE $dbf_uname='$username'", $php121db);
	if (mysql_num_rows($query) == 0) {
		$stop .= "<font color=\"FF0000\">" . _USERNAME_NOT_FOUND . "</font><br>";
	} else {
		//check code
		$row = mysql_fetch_row($query);
		if (substr($row[0], 0, 9) == $code) {
			//correct code
			echo _RESET_PASS_ENTER_PASS_BELOW . "<br>";
			echo "<form name=\"changepass\" method=\"POST\" action=\"php121resetpass.php?user=$username&code=$code\">" . _NEW_PASSWORD . ":  <input type=\"password\" name=\"password\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\" size=\"20\" maxlength=\"10\"><p>" . _CONFIRM_PASSWORD . ":   <input type=\"password\" name=\"confirmpassword\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\" size=\"20\" maxlength=\"10\"><p><input type=\"submit\" name=\"submitnewpass\" value=\"" . _CHANGE_PASSWORD . "\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\"><input type=\"hidden\" name=\"newpass\" value=\"1\"></form>";
		} else {
			$stop .= "<font color=\"FF0000\">" . _INCORRECT_CODE . "</font><br>";
		}
	}
        return($stop);
}

if ($newpass <> 1) {
	$stop = userLookup($username);
	if ($stop != "") {
		echo _ERROR . " " . $stop;
	}
} else if ($stop == "") {
	//new pass entered and no errors with the URL
	//check that the new password is ok
	if (strlen($password) < 6) $stop .= "<font color=\"FF0000\">" . _PASSWORD_TOO_SHORT . "</font><br>";
	if ($password != $confirmpassword) { $stop .= "<font color=\"FF0000\">" . _PASSWORDS_MISMATCH . "</font><br>"; $password = ""; $confirmpassword = ""; }
        if ($stop != "") {
                echo _ERROR . " " . $stop;
		userLookup($username);
		die;
        }
	//if we got this far, we're ok.  put new password in database

	$password = ($dbf_passwordtype == "md5") ? md5($password) : $password;
	mysql_query("UPDATE $db_usertable SET $dbf_upassword='$password' WHERE $dbf_uname='$username'", $php121db);

	$url = $siteurl . "php121login.php";
	echo _PASSWORD_CHANGED . " " . _YOU_CAN_NOW . " " . _GO_BACK . " <a href=\"$url\">login</a>";
}
?>

<P>
<a href="php121login.php"><?php echo _CANCEL; ?></a>
</font>
<?php echo $closetable; ?>
</body>
</html>
