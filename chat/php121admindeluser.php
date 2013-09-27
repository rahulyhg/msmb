<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121admindeluser.php                                          **
 **  Date modified:     10/07/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:	Allow admins to delete users					**
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
global $dbf_uname_len, $dbf_upassword_len, $dbf_uemail_len;

if (isadmin($sess_username) && $acctman == 1) {
?>

<html>
<head>
<title>Matrmonial shaadi  - <?php echo _DELETE_USER;?></title>
</head>

<body>

<?php
echo $opentable;
$username = makedbsafe($_POST[username]);
$submit = $_POST[check];
$confirmdel = $_POST[confirmdel];

if ($submit == 1 or $confirmdel) {
	$query = mysql_query("SELECT $dbf_uname, $dbf_level from $db_usertable where $dbf_uname = '$username'", $php121db);
	$result = mysql_num_rows($query);
	$row = mysql_fetch_row($query);
	if ($row[1] > (isadmin($sess_username) + 1)) {
		//are we trying to edit a user with more power than us?
		echo _ERROR . " " . _DELETE_USER_DENIED . "<p>";
		$username = "";
	}
	if ($result == 0) {
		echo _ERROR . " " . _USER_NOT_EXIST . "<p>";
		$username = "";
	}	
	if ($confirmdel == _YES) {
		//ok, delete account
		mysql_query("DELETE from $db_usertable where $dbf_uname='$username'", $php121db);
		mysql_query("COMMIT");
		echo "<font color=\"green\">" . _USER_DELETED . "</font><p>";
		$username = "";
	} else if ($confirmdel == _NO) {
		//user selected "no" for confirm del
		echo "<font color=\"red\">" . _DELETE_CANCELLED . "</font><p>";
		$username = "";
	} else if ($username != "") {
		//display confirmation
		echo _ARE_YOU_SURE . " " . _DELETE_THIS_USER . ": <b>" . $username . "</b> ?";
		echo "<form name=\"confirmdelform\" method=\"POST\">
			<input type=\"submit\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\" name=\"confirmdel\" value=\"" . _YES . "\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\" name=\"confirmdel\" value=\"" . _NO . "\"><input type=\"hidden\" name=\"username\" value=\"$username\"><input type=\"hidden\" name=\"email\" value=\"$email\"><input type=\"hidden\" name=\"password\" value=\"$password\"></form>";
		die;
	//end confirmdel
	}
//end submit=1
}
?>

<table border="0">
<form name="deluser" method="POST">
<tr><td>
<font style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px"><?php echo _USER; ?>:</font>
</td><td>
<input type="text" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px" name="username" size="20" maxlength="<?php echo $dbf_uname_len; ?>" value="<?php echo $username; ?>">
</td></tr>
<tr><td colspan="2" align="center">
<input type="submit" value="<?php echo _DELETE_USER; ?>" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px">
<input type="hidden" name="check" value="1">
<p>
<font style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px"><a href="php121admin.php"><?php echo _CANCEL; ?></a></font>
</td></tr>
</form>
</table>
</font>

<?php
echo $closetable; 
} else { echo _ACCESS_DENIED; die; }
?>
</body>
</html>
