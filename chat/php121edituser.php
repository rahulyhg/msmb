<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121edituser.php                                              **
 **  Date modified:     03/07/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     User edit account function					**
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

?>

<html>
<head>
<title>Matrmonial shaadi  - <?php echo _EDIT_ACCOUNT; ?></title>
</head>
<body>

<?php
global $db_usertable, $dbf_uid, $dbf_uname, $dbf_upassword, $dbf_passwordtype, $dbf_uemail;
global $dbf_user_chatting, $dbf_smilies, $dbf_level, $dbf_showrequest, $dbf_beep_newmsg, $dbf_focus_newmsg;
global $dbf_uname_len, $dbf_upassword_len, $dbf_uemail_len, $dbf_timezone, $dbf_timestamp, $dbf_language;

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
$showrequest = makedbsafe($_POST[showrequest]);
$beep_newmsg = makedbsafe($_POST[beep_newmsg]);
$focus_newmsg = makedbsafe($_POST[focus_newmsg]);
$timezone = makedbsafe($_POST[timezone]);
$user_timestamp = makedbsafe($_POST[user_timestamp]);
$language = strtolower(makedbsafe($_POST[language]));

if ($integration == "phpbb") {
	$sql = "select $dbf_language,$dbf_timezone from $db_usertable where $dbf_uname = '$sess_username'";
	$row = mysql_fetch_row(mysql_query($sql));
	$language = strtolower($row[0]);
	$timezone = $row[1];
}

$auto_email_transcript = makedbsafe($_POST[auto_email_transcript]);
$lookup = $_POST[lookup];

if ($lookup == 1) {
	//do a check on the new info submitted
	$stop = edituserCheck($sess_username,$password, $confirm_password, $user_email);
	if ($stop != "") {
		echo $stop;
	} else {
		//ok, lets save
		if ($password == "") {
			//keep existing password
			mysql_query("UPDATE $db_usertable SET $dbf_uemail='$user_email', $dbf_smilies='$smilies', $dbf_showrequest='$showrequest', $dbf_beep_newmsg='$beep_newmsg', $dbf_focus_newmsg='$focus_newmsg', $dbf_timezone='$timezone',$dbf_timestamp='$user_timestamp',$dbf_language='$language',php121_cl_update_key='0',$dbf_auto_email_transcript='$auto_email_transcript' WHERE $dbf_uname='$sess_username'",$php121db);
		} else { 
			//update all
			if ($dbf_passwordtype == "md5"){
			mysql_query("UPDATE $db_usertable SET $dbf_uemail='$user_email', $dbf_upassword=md5('$password'), $dbf_smilies='$smilies', $dbf_showrequest='$showrequest', $dbf_beep_newmsg='$beep_newmsg', $dbf_focus_newmsg='$focus_newmsg', $dbf_timezone='$timezone',$dbf_timestamp='$user_timestamp',$dbf_language='$language',php121_cl_update_key='0',$dbf_auto_email_transcript='$auto_email_transcript' WHERE $dbf_uname='$sess_username'",$php121db);
			} else if ($dbf_passwordtype == "plaintext") {
				mysql_query("UPDATE $db_usertable SET $dbf_uemail='$user_email', $dbf_upassword='$password', $dbf_smilies='$smilies', $dbf_showrequest='$showrequest', $dbf_beep_newmsg='$beep_newmsg', $dbf_focus_newmsg='$focus_newmsg', $dbf_timezone='$timezone',$dbf_timestamp='$user_timestamp',$dbf_language='$language',php121_cl_update_key='0',$dbf_auto_email_transcript='$auto_email_transcript' WHERE $dbf_uname='$sess_username'",$php121db);
			} //end update all

		} //end if password

		echo _ACCOUNT_UPDATED . "<p><a href=\"javascript:window.close();\">" . _CLOSE . "</a>";
		echo $closetable;
		die;

	} //end save
}

echo _WELCOME . " " . $sess_username . ", " . _CAN_EDIT_YOUR_DETAILS_BELOW; 
if ($acctman == 1) { 
   echo "<br>" . _PASSWORD_CHANGE_LOGIN_AGAIN; 
}
echo "<form name=\"edituser\" method=\"POST\">";

$sql = "SELECT $dbf_uemail,$dbf_smilies,$dbf_showrequest,$dbf_beep_newmsg,$dbf_focus_newmsg,$dbf_timezone,$dbf_timestamp,$dbf_language,$dbf_auto_email_transcript from $db_usertable where $dbf_uname='" . $sess_username . "'";
$emailrow = mysql_fetch_row(mysql_query($sql, $php121db));
$user_email = $emailrow[0];
$smilies = $emailrow[1];
$showrequest = $emailrow[2];
$beep_newmsg = $emailrow[3];
$focus_newmsg = $emailrow[4];
$timezone = $emailrow[5];
$user_timestamp = $emailrow[6];
$language = $emailrow[7];
$auto_email_transcript = $emailrow[8];

echo "<table border=\"0\">";

if ($acctman == 1) {
	echo "<table border=\"0\" bgcolor=\"#B7D26B\"><tr><td><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _EMAIL . ":</font></td><td>
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

echo "</td></tr>";
echo "<tr><td>
<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _AUTO_ACCEPT_CHAT_REQUESTS . ":</font></td><td>";

if ($showrequest == 0) {
	echo "<input type=\"radio\" name=\"showrequest\" value=\"0\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"showrequest\" value=\"1\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
} else {
	echo "<input type=\"radio\" name=\"showrequest\" value=\"0\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"showrequest\" value=\"1\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
}

echo "</td></tr>";
echo "<tr><td>
<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _BEEP_ON_NEW_MESSAGE . ":</font></td><td>";

if ($beep_newmsg == 1) {
	echo "<input type=\"radio\" name=\"beep_newmsg\" value=\"1\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"beep_newmsg\" value=\"0\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
} else {
	echo "<input type=\"radio\" name=\"beep_newmsg\" value=\"1\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"beep_newmsg\" value=\"0\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
}

echo "</td></tr>";
echo "<tr><td>
<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _BRING_WINDOW_TO_FRONT . ":</font></td><td>";

if ($focus_newmsg == 1) {
	echo "<input type=\"radio\" name=\"focus_newmsg\" value=\"1\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"focus_newmsg\" value=\"0\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
} else {
	echo "<input type=\"radio\" name=\"focus_newmsg\" value=\"1\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"focus_newmsg\" value=\"0\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
}

echo "</td></tr>";

if ($integration != "phpbb") {
echo "<tr><td>
<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _TIMEZONE . ":</font></td><td>";

echo "<select name='timezone' style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">";
	for ($i = -12; $i < 13; $i++) {
		if ($i == 0) {
			$dummy = "GMT";
		} else {
			if (ereg("-", $i)) {
				$dummy = "GMT $i " . _HOURS;
			} else {
				$dummy = "GMT +$i " . _HOURS;
			}
		}
		if ($timezone == $i) {
			echo "<option name=\"timezone\" value=\"$i\" selected>$dummy</option>";
		} else {
			echo "<option name=\"timezone\" value=\"$i\">$dummy</option>";
		}
	}
echo "</select>";

echo "</td></tr>";
}

echo "<tr><td>
<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _SHOW_TIMESTAMPS . ":</font></td><td>";

if ($user_timestamp == 1) {
	echo "<input type=\"radio\" name=\"user_timestamp\" value=\"1\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"user_timestamp\" value=\"0\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
} else {
	echo "<input type=\"radio\" name=\"user_timestamp\" value=\"1\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"user_timestamp\" value=\"0\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
}

echo "</td></tr>";

if ($integration != "phpbb") {
echo "<tr><td>
<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _LANGUAGE . ":</font></td><td>";
echo "<select name='language' style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">";

$dir = getcwd() . "/php121language";

if (!is_dir($dir)) { die("Cant get a list of language files!"); }

if ($root = opendir($dir)) {
	while ($file = readdir($root)) {
		if ($file == "." || $file == "..") { continue; }
		$lang = strtoupper(substr($file,5,1)) . substr($file,6,strlen($file) - 10);
		if (strtolower($language) == strtolower($lang)) {
	           	echo "<option name=\"language\" value=\"$lang\" selected>$lang</option>";
		} else {
			echo "<option name=\"language\" value=\"$lang\">$lang</option>";
		}
	}
}
echo "</td></tr>";
}

echo "<tr><td>
<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _AUTO_EMAIL_TRANSCRIPT. ":</font></td><td>";
                                                                                                                            
if ($auto_email_transcript == 1) {
        echo "<input type=\"radio\" name=\"auto_email_transcript\" value=\"1\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"auto_email_transcript\" value=\"0\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
} else {
        echo "<input type=\"radio\" name=\"auto_email_transcript\" value=\"1\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"auto_email_transcript\" value=\"0\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
}

echo "</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">&nbsp;<br>
<input type=\"submit\" value=\"" . _SAVE_CHANGES . "\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">
<input type=\"hidden\" name=\"lookup\" value=\"1\">
<input type=\"hidden\" name=\"currentpass\" value=\"$row[1]\">
<input type=\"hidden\" name=\"username\" value=\"$username\">";

if ($acctman == 0) {
	echo "<input type=\"hidden\" name=\"email\" value=\"$user_email\">";
}

echo "</td></tr></table></form>";

if ($acctman == 0 || $php121_config[user_can_delete_account] == 0) {
	echo "<a href=\"javascript:window.close();\">" . _CANCEL . "</a>";
} else {
	echo "<a href=\"php121options.php\">" . _CANCEL . "</a>";
}
echo $closetable;
die;

?>

</font>

<?php echo $closetable; ?>

</body>
</html>
