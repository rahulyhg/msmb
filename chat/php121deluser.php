<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121deluser.php                                               **
 **  Date modified:     30/06/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     User delete account function					**
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

if ($acctman == 0  || $php121_config[user_can_delete_account] == 0) {
	die (_ACCESS_DENIED);
}
?>

<html>
<head>
<title>Matrmonial shaadi  - <?php echo _DELETE_ACCOUNT; ?></title>
</head>
<body>

<?php
global $db_usertable, $dbf_uid, $dbf_uname, $dbf_upassword, $dbf_passwordtype, $dbf_uemail;
global $dbf_user_chatting, $dbf_smilies, $dbf_level, $dbf_showrequest;
global $dbf_uname_len, $dbf_upassword_len, $dbf_uemail_len;

echo $opentable;
$username = makedbsafe($_POST[username]);
$password = makedbsafe($_POST[password]);
$submit = $_POST[check];
$confirmdel = $_POST[confirmdel];

if ($submit == 1 || $confirmdel){

	$stop = userCheck($username, $password);

	if ($stop != "") {
		//there was an entry error
		echo $stop;
	} else {

		if ($confirmdel == _YES) {
			//ok, delete account
			mysql_query("DELETE from $db_usertable where $dbf_uname='$username'", $php121db);
			mysql_query("COMMIT");
			echo _ACCOUNT_DELETED . "<p>";
			echo "<a href=\"javascript:window.close()\">" . _CLOSE . "</a>";
			die;
		} else if ($confirmdel == _NO) {
			//user selected "no" for confirm del
			echo _DELETE_CANCELLED . "<p>";
			echo _GO_BACK . " <a href=\"php121options.php\">" . _ACCOUNT_OPTIONS . "</a>";
			die;
		} else {
			//display confirmation
			echo _ARE_YOU_SURE . " " . _DELETE_YOUR_ACCOUNT;
			echo "<form name=\"confirmdelform\" method=\"POST\">
				<input type=\"submit\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\" name=\"confirmdel\" value=\"" . _YES . "\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\" name=\"confirmdel\" value=\"" . _NO . "\"><input type=\"hidden\" name=\"username\" value=\"$username\"><input type=\"hidden\" name=\"email\" value=\"$email\"><input type=\"hidden\" name=\"password\" value=\"$password\"></form>";
			die;
		} //end confirmdel

	} //end if stop=null 

} //end submit=1

echo _REENTER_U_AND_P . "<p>";
?>

<table border="0">
<form name="deluser" method="POST">
<tr><td>
<font style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px">
<?php echo _USERNAME; ?>:
</font>
</td><td>
<input type="text" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px" name="username" size="20" maxlength="<?php echo $dbf_uname_len; ?>" value="<?php echo $username; ?>">
</td></tr>
<tr><td>
<font style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px">
<?php echo _PASSWORD; ?>:</font></td><td><input type="password" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px" name="password" size="10" maxlength="10" value="<?php echo $password; ?>">
</td></tr>
<tr><td colspan="2" align="center">
<input type="submit" value="<?php echo _DELETE_ACCOUNT; ?>" style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px">
<input type="hidden" name="check" value="1">
<p>
<font style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px"><a href="php121options.php"><?php echo _CANCEL; ?></a></font>
</td></tr>
</form>
</table>
</font>

<?php echo $closetable; ?>

</body>
</html>
