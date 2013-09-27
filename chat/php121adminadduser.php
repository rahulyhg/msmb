<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121adminadduser.php                                        	**
 **  Date modified:     05/07/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Allow admins to add a new user                                  **
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
<title>Matrmonial shaadi  - <?php echo _ADD_USER; ?></title>
</head>

<body>
<?php

function newuserCheck($username, $password, $confirm_password, $user_email) {
        global $php121db, $password, $confirmpassword;
        global $db_usertable, $dbf_uid, $dbf_uname, $dbf_upassword, $dbf_passwordtype, $dbf_uemail;
        global $dbf_user_chatting, $dbf_smilies, $dbf_level, $dbf_showrequest;
        global $dbf_upassword_input_min_length;
                                                                                                                            
        $stop = "";
	if ((!$username) || ($username == "") || (ereg("[^\. a-zA-Z0-9_\-]", $username))) $stop .= "<font color=\"FF0000\">" . _INVALID_USERNAME . "</font><br>";
        if (eregi("^((root)|(adm)|(linux)|(webmaster)|(admin)|(god)|(administrator)|(administrador)|(nobody)|(anonymous)|(anonimo)|(anónimo)|(operator))$", $username)) $stop .= "<font color=\"FF0000\">" . _INVALID_USERNAME . "</font><br>";
        if (mysql_num_rows(mysql_query("SELECT $dbf_uname FROM $db_usertable WHERE $dbf_uname='$username'", $php121db)) > 0) $stop .= "<font color=\"FF0000\">" . _USERNAME_IN_USE . "</font><br>";
        if ((!$user_email) || ($user_email=="") || (!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$", $user_email))) $stop .= "<font color=\"FF0000\">" . _INVALID_EMAIL . "</font><br>";
        if (strrpos($user_email, ' ') > 0) $stop .= "<font color=\"FF0000\">" . _EMAIL_NO_SPACES . "</font><br>";
        if (mysql_num_rows(mysql_query("SELECT $dbf_uemail FROM $db_usertable WHERE $dbf_uemail='$user_email'", $php121db))
> 0) $stop .= "<font color=\"FF0000\">" . _EMAIL_REGGED . "</font><br>";
        if (strlen($password) < $dbf_upassword_input_min_length) $stop .= "<font color=\"FF0000\">" . _PASSWORD_TOO_SHORT .
"</font><br>";
        if ($password != $confirmpassword) { $stop .= "<font color=\"FF0000\">" . _PASSWORDS_MISMATCH . "</font><br>"; $password = ""; $confirmpassword = ""; }
                                                                                                                            
        return($stop);
}

echo $opentable;

$username = makedbsafe($_POST[username]);
$password = makedbsafe($_POST[password]);
$confirmpassword = makedbsafe($_POST[confirmpassword]);
$user_email = makedbsafe($_POST[email]);
$timezone = makedbsafe($_POST[timezone]);
$userlevel = makedbsafe($_POST[userlevel]);
$submit = $_POST[check];
                                                                                                                            
if ($submit == 1) {
        $numusers = mysql_num_rows(mysql_query("select $dbf_uid from $db_usertable"));
        $stop = newuserCheck($username, $password, $confirmpassword, $user_email);
        if ($stop == "") {
		if ($dbf_passwordtype == "md5") {	
			if (isadmin($sess_username) == 2) {
                                //save the userlevel too
				mysql_query("INSERT into $db_usertable (`$dbf_uname`,`$dbf_upassword`,`$dbf_uemail`,`$dbf_smilies`, `$dbf_level`, `$dbf_timezone`, `$dbf_language`) VALUES ( '$username', md5('$password'), '$user_email', '1', '$userlevel', '$timezone', '$language')", $php121db);
			} else {
				mysql_query("INSERT into $db_usertable (`$dbf_uname`,`$dbf_upassword`,`$dbf_uemail`,`$dbf_smilies`, `$dbf_level`, `$dbf_timezone`, `$dbf_language`) VALUES ( '$username', md5('$password'), '$user_email', '1', '1', '$timezone', '$language')", $php121db);
			}
		} else if ($dbf_passwordtype == "plaintext") {
			if (isadmin($sess_username) == 2) {
                                //save the userlevel too
				mysql_query("INSERT into $db_usertable (`$dbf_uname`,`$dbf_upassword`,`$dbf_uemail`,`$dbf_smilies`, `$dbf_level`, `$dbf_timezone`, `$dbf_language`) VALUES ( '$username', '$password', '$user_email', '1', '$userlevel', '$timezone', '$language')", $php121db);
                        } else {
				mysql_query("INSERT into $db_usertable (`$dbf_uname`,`$dbf_upassword`,`$dbf_uemail`,`$dbf_smilies`, `$dbf_level`, `$dbf_timezone`, `$dbf_language`) VALUES ( '$username', '$password', '$user_email', '1', '1', '$timezone', '$language')", $php121db);
			}
		}
                echo "<font color=\"green\">" . _USER_ADDED . "</font><p>";
		$username = "";
		$password = "";
		$confirmpassword = "";
		$user_email = "";
		$timezone = "";
		$userlevel = "";
        } else {
                echo "<font color=\"FF0000\"><b>" . _ERROR . "</b>$stop</font>";
        }//end if stop
}//end submit
?>

<form name="newuser" method="POST">
<?php echo _USERNAME; ?>:<br><input type="text" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px" name="username" size="20" maxlength="<?php echo $db_uname_len; ?>" value="<?php echo $username; ?>">
<p>
                                                                                                                            
<?php echo _EMAIL; ?>:<br><input type="text" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px" name="email" size="20"
maxlength="<?php echo $db_uemail_len; ?>" value="<?php echo $user_email; ?>">
<p>
                                                                                                                            
<?php echo _PASSWORD; ?>:<br><font style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 10px">(<?php echo _BETWEEN . " " . $dbf_upassword_input_min_length . " " . _AND . " " . $dbf_upassword_input_max_length . _CHARACTERS; ?>)</font><br><input type="password" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px" name="password" size="10" maxlength="<?php echo $dbf_upassword_input_max_length; ?>" value="<?php echo $password; ?>">
<p>
                                                                                                                            
<?php echo _CONFIRM_PASSWORD; ?>:<br><input type="password" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px" name="confirmpassword" size="10" maxlength="<?php echo $dbf_upassword_input_max_length; ?>" value="<?php echo $confirmpassword; ?>"><p>
                                                                                                                            
<?php echo _TIMEZONE; ?>:<br>
<?php
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
                                                                                                                            
echo "<p><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _LANGUAGE . ":</font><br>";
echo "<select name='language' style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">";
$dir=getcwd() . "/php121language";
                                                                                                                            
if (!is_dir($dir)) { die ("Cant get a list of language files!"); }
if ($root = opendir($dir)) {
        while ($file = readdir($root)) {
                if($file == "." || $file == "..") { continue; }
                $lang = strtoupper(substr($file, 5, 1)) . substr($file, 6, strlen($file) - 10);
                if ($php121_config[default_language] == $lang) {
                        echo "<option name=\"language\" value=\"$lang\" selected>$lang</option>";
                } else {
                        echo "<option name=\"language\" value=\"$lang\">$lang</option>";
                }
        }
}
echo "</select>";

//if we have owner level access, allow us to change userlevels
//(isadmin returns 1 less than the actual level)
if (isadmin($sess_username) == 2 && $integration == "none") {
        echo "<p><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _USER_LEVEL . ":</font><br><select name=\"userlevel\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">";
        echo "<option value='1' selected>" . _USER . "</option>";
        echo "<option value='2'>" . _PADMIN . "</option>";
        echo "<option value='3'>" . _OWNER . "</option>";
        echo "</select>";
}

?>
                                                                                                                            
<p>
<input type="submit" value="<?php echo _ADD_USER; ?>" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px">
<input type="hidden" name="check" value="1">
</form>

<?php 
echo "<p><b><a style=\"BACKGROUND: none; COLOR: #000066; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none\" href=\"javascript:window.close()\">" . _CLOSE . "</a></b>";
echo $closetable; ?>
</body>
</html>
<?php } ?>
