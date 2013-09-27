<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121adminedituser.php                                        	**
 **  Date modified:     05/07/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Allow admins to edit user info                                  **
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

require_once("php121.php");

global $php121db;
global $db_usertable, $dbf_uid, $dbf_uname, $dbf_upassword, $dbf_passwordtype, $dbf_uemail;
global $dbf_user_chatting, $dbf_smilies, $dbf_level, $dbf_showrequest;
global $dbf_uname_len, $dbf_upassword_len, $dbf_uemail_len, $dbf_banned;

if (isadmin($sess_username)) {
?>

<html>
<head>
<title>Matrmonial shaadi  - <?php echo _EDIT_USER; ?></title>
</head>

<body>
<?php

function edituserCheck($username, $password, $confirm_password, $user_email) {
	global $php121db, $password, $confirmpassword, $currentpass;
        $stop = "";
	if ((!$username) || ($username == "") || (ereg("[^\. a-zA-Z0-9_\-]", $username))) $stop .= "<font color=\"FF0000\">" . _INVALID_USERNAME . "</font><br>";
        if ((!$user_email) || ($user_email == "") || (!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$", $user_email))) $stop .= "<font color=\"FF0000\">" . _INVALID_EMAIL . "</font><br>";
        if (strrpos($user_email,' ') > 0) $stop .= "<font color=\"FF0000\">" . _EMAIL_NO_SPACES . "</font><br>";

        if ($password != "" || $confirmpassword != "") {
		//password attemping to be changed
        	if (strlen($password) < 6) $stop .= "<font color=\"FF0000\">" . _PASSWORD_LENGTH . "</font><br>";
	        if ($password != $confirmpassword) { $stop .= "<font color=\"FF0000\">" . _PASSWORDS_MISMATCH . "</font><br>"; $password = ""; $confirmpassword = ""; }
        }
        return($stop);
}

echo $opentable;
$username = makedbsafe($_POST[username]);
$password = makedbsafe($_POST[password]);
$confirmpassword = makedbsafe($_POST[confirmpassword]);
$user_email = makedbsafe($_POST[email]);
$currentpass = makedbsafe($_POST[currentpass]);
$smilies = makedbsafe($_POST[emoticons]);
$level = makedbsafe($_POST[userlevel]);
$banned = makedbsafe($_POST[banned]);
$lookup = $_POST[lookup];
$getuser = $_POST[getuser];

//has a username been entered?  if not, get one
if ($getuser) {
	$query = mysql_query("SELECT $dbf_uname,$dbf_level from $db_usertable where $dbf_uname='$username'", $php121db);
	$result = mysql_num_rows($query);
	$row = mysql_fetch_row($query);
	if ($result == 0) { 
		echo "<font color=\"red\">" . _USER_NOT_EXIST . "</font><p>";
		$getuser = 0;
		//echo _GO_BACK . " <a href=\"php121admin.php\">" . _ADMIN_OPTIONS."</a>";
		//echo $closetable;
		//die;
	}
	if ($row[1] > (isadmin($sess_username) + 1)) {
		//are we trying to edit a user with more power than us?
		echo "<font color=\"red\">" . _EDIT_USER_DENIED . "</font><p>";
		$getuser = 0;
	//	echo _GO_BACK . " <a href=\"php121admin.php\">" . _ADMIN_OPTIONS . "</a>";
        //        echo $closetable;
        //        die;
	}
} 
if (!$getuser && !$lookup) {
?>
	<table border="0">
	<form name="edituser" method="POST">
	<tr><td>
	<font style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px"><?php echo _USER; ?>:</font>
	</td><td>
	<input type="text" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px" name="username" size="20" maxlength="<?php echo $dbf_uname_len; ?>" value="<?php echo $username; ?>">
	</td></tr>
	<tr><td colspan="2" align="center">
	<input type="submit" value="<?php echo _EDIT_USER; ?>" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px">
	<input type="hidden" name="getuser" value="1">
	<p>
	<font style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px"><a href="php121admin.php"><?php echo _CANCEL; ?></a></font>
	</td></tr>
	</form>
	</table>
<?php
	echo $closetable;
	die;
} 

if ($lookup == 1) {
	//do a check on the new info submitted
	$stop = edituserCheck($username, $password, $confirm_password, $user_email);
	if ($stop != "") {
		echo $stop;
	} else {
		//ok, lets save
		if ($password == "") {
			//keep existing password
			if (isadmin($sess_username) == 2) {
				//save the userlevel too
				mysql_query("UPDATE $db_usertable SET $dbf_uemail = '$user_email', $dbf_smilies = '$smilies', $dbf_level = '$level', $dbf_banned = '$banned' WHERE $dbf_uname = '$username'", $php121db);
			} else {
				mysql_query("UPDATE $db_usertable SET $dbf_uemail='$user_email', $dbf_smilies='$smilies', $dbf_banned='$banned' WHERE $dbf_uname='$username'", $php121db);
			}
		} else {
			//update all
			if (isadmin($sess_username) == 2) {
				//including the userlevel
				if ($dbf_passwordtype == "md5") {
					mysql_query("UPDATE $db_usertable SET $dbf_uemail='$user_email', $dbf_upassword=md5('$password'), $dbf_smilies='$smilies', $dbf_level='$level', $dbf_banned='$banned' WHERE $dbf_uname='$username'", $php121db);
				} else if ($dbf_passwordtype == "plaintext") {
					mysql_query("UPDATE $db_usertable SET $dbf_uemail='$user_email', $dbf_upassword='$password', $dbf_smilies='$smilies', $dbf_level='$level', $dbf_banned='$banned' WHERE $dbf_uname='$username'", $php121db);
				}
			} else {
				if ($dbf_passwordtype == "md5") {
					mysql_query("UPDATE $db_usertable SET $dbf_uemail='$user_email', $dbf_upassword=md5('$password'), $dbf_smilies='$smilies', $dbf_banned='$banned' WHERE $dbf_uname='$username'", $php121db);
				} else if ($dbf_passwordtype == "plaintext") {
					mysql_query("UPDATE $db_usertable SET $dbf_uemail='$user_email', $dbf_upassword=$password, $dbf_smilies='$smilies', $dbf_banned='$banned' WHERE $dbf_uname='$username'", $php121db);
				}
			}
		}
		echo "<font color=\"green\">" . _USER_UPDATED . "</font><p>";
		echo _GO_BACK . " <a href=\"php121adminedituser.php\">" . _EDIT_USER . "</a>";
		echo $closetable;
		die;
	} 
} 

echo _EDIT_USER . ": <b>" . $username . "</b><br>";
echo "<form name=\"edituser\" method=\"POST\">";
$sql = "SELECT $dbf_uemail,$dbf_smilies,$dbf_level,$dbf_banned from $db_usertable where $dbf_uname='$username'";
$emailrow = mysql_fetch_row(mysql_query($sql, $php121db));
$user_email = $emailrow[0];
$smilies = $emailrow[1];
$level = $emailrow[2];
$banned = $emailrow[3];
echo "<table border=\"0\">";
if ($acctman == 1) {
	echo "<tr><td><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _EMAIL . ":</font></td><td>
	<input type=\"text\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\" name=\"email\" size=\"20\" maxlength=\"$dbf_uemail_len\" value=\"$user_email\">";
	echo "</td></tr><tr><td>
	<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _PASSWORD . ":</font><br>
	<font style=\"FONT-SIZE: 10px\">" . _PASSWORD_LENGTH_INFO . "<br>" . _LEAVE_BLANK_KEEP_EXISTING . "</font></td><td><input type=\"password\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\" name=\"password\" size=\"10\" maxlength=\"10\">
	</td></tr><tr><td>
	<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _CONFIRM_PASSWORD . ":</font><br>
	<font style=\"FONT-SIZE: 10px\">(" . _IF_CHANGING_PASSWORD . ")</font></td><td><input type=\"password\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\" name=\"confirmpassword\" size=\"10\" maxlength=\"10\">
</td></tr>";
} 

echo "<tr><td>
<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _EMOTICONS . ":</font></td><td>";

if ($smilies == 1) {
	echo "<input type=\"radio\" name=\"emoticons\" value=\"1\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _PON . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"emoticons\" value=\"0\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _OFF . "</font></option>";
} else {
	echo "<input type=\"radio\" name=\"emoticons\" value=\"1\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _PON . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"emoticons\" value=\"0\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _OFF . "</font></option>";
}

echo "</td></tr><tr><td>
<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _BAN_THIS_USER . ":</font></td><td>";
if ($banned == 1) {
	echo "<input type=\"radio\" name=\"banned\" value=\"1\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"banned\" value=\"0\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
} else {
	echo "<input type=\"radio\" name=\"banned\" value=\"1\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"banned\" value=\"0\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
}

//if we have owner level access, allow us to change userlevels 
//(isadmin returns 1 less than the actual level)
if (isadmin($sess_username) == 2 && $integration == "none") {
	echo "</td></tr><tr><td>";
	echo "<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _USER_LEVEL . ":</font></td><td><select name=\"userlevel\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">";
	if ($level == 1) {
		echo "<option value='1' selected>" . _USER . "</option>";
	} else {
		echo "<option value='1'>" . _USER . "</option>";
	}

	if ($level == 2) {
		echo "<option value='2' selected>" . _PADMIN . "</option>";
	} else {
		echo "<option value='2'>" . _PADMIN . "</option>";
	}

	if ($level == 3) {
		echo "<option value='3' selected>" . _OWNER . "</option>>";
	} else {
		echo "<option value='3'>" . _OWNER . "</option>";
	}
	echo "</select>";
}
echo "</td></tr>";
echo _TABLE_BLANK_ROW;
echo "<tr><td colspan=\"2\" align=\"center\">
<input type=\"submit\" value=\""._SAVE_CHANGES."\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">
<input type=\"hidden\" name=\"lookup\" value=\"1\">
<input type=\"hidden\" name=\"currentpass\" value=\"$row[1]\">
<input type=\"hidden\" name=\"username\" value=\"$username\">";
if ($acctman == 0) {
	echo "<input type=\"hidden\" name=\"email\" value=\"$user_email\">";
}
echo "</td></tr></table>
</form>";
echo "<a href=\"php121admin.php\">" . _CANCEL . "</a>";
echo $closetable;
die;
?>

</font>
<?php echo $closetable;
} else { echo _ACCESS_DENIED; die; }
?>
</body>
</html>
