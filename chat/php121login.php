<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121login.php                                                 **
 **  Date modified:     30/06/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Login screen.  Cookie check.                                    **
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

global $db_usertable, $dbf_uid, $dbf_uname, $dbf_upassword, $dbf_passwordtype, $dbf_uemail;
global $dbf_user_chatting, $dbf_smilies, $dbf_level, $dbf_showrequest;
global $dbf_uname_len, $dbf_upassword_len, $dbf_uemail_len;
global $dbf_upassword_input_max_length, $integration;

require_once("php121db.php");

session_start();

if ($integration == "none") {
        if (isset($_COOKIE['php121un']) && isset($_COOKIE['php121pw'])) {
                $logindataun = $_COOKIE['php121un'];
                $logindatapw = $_COOKIE['php121pw'];
                if (!empty($logindataun) && !empty($logindatapw)) {
                        //we have a cookie - use it to login, overriding any sessions
                        $_SESSION[sess_username] = $logindataun;
                        $_SESSION[sess_password] = $logindatapw;
                }
        }

        $sess_username = $_SESSION[sess_username];
        $sess_password = $_SESSION[sess_password];

        //end if integration = none

} else if ($integration == "phpnuke") {
        global $user, $cookie, $db, $anonymous, $sitekey;
        require_once("mainfile.php");
        cookiedecode($user);
        $sess_username = $cookie[1];
        //end if integration is phpnuke
}


$sess_username = makedbsafe($sess_username);
$sess_password = makedbsafe($sess_password);

$sql = "Select $dbf_uname from $db_usertable";
$result = mysql_query($sql);
$numusers = mysql_num_rows($result);
$row = mysql_fetch_row(mysql_query("SELECT $dbf_banned from $db_usertable WHERE $dbf_uname='$sess_username'", $php121db));
$bannedstatus = $row[0];

if ($bannedstatus > 0) {
        echo _YOU_ARE_BANNED;
        die();
}

if ($sess_username != "") {
        require_once("php121checksession.php");
} else {
	if ($integration == "phpnuke") {
		echo $opentable;
		echo "<br>" . _PLEASE . " " . _LOGIN . " to PHPNuke first!";
		echo $closetable;
		die;
	}
} 

if ($_GET[op] == "logout") {
	$sql = "update $db_usertable set $dbf_user_chatting='0' where $dbf_uname='$sess_username'";
	$result = mysql_query($sql);
	$controlUpdateKey = rand(1, 99999999999);
	$sqlupd = "update " . $php121_prefix . "_control set CL_LastModified='$now', CL_UpdateKey='$controlUpdateKey' where id='1'";
	$result = mysql_query($sqlupd);
        session_destroy();
        setcookie('php121un',FALSE);
        setcookie('php121pw',FALSE);
		 setcookie('php121un',"");
        setcookie('php121pw',"");
        Header("Location: php121login.php");
}

$sql = "Select $dbf_uname from $db_usertable";
$result = mysql_query($sql);
$numusers = mysql_num_rows($result);

function userLookup($username, $password) {
	global $php121db, $password;
	global $db_usertable, $dbf_uid, $dbf_uname, $dbf_upassword, $dbf_passwordtype, $dbf_uemail;
	global $dbf_user_chatting, $dbf_smilies, $dbf_level, $dbf_showrequest;
	global $dbf_upassword_len;

        $stop = "";
        if (mysql_num_rows(mysql_query("SELECT $dbf_uname FROM $db_usertable WHERE $dbf_uname='$username'",$php121db)) == 0) $stop .= _USERNAME_NOT_FOUND . "<br>";
        if ($stop == ""){
                $row = mysql_fetch_row(mysql_query("SELECT $dbf_upassword from $db_usertable WHERE $dbf_uname='$username'", $php121db));
		if ($dbf_passwordtype == "md5") {
			if ($row[0] != substr(md5($password), 0, $dbf_upassword_len)) $stop .= _INCORRECT_PASSWORD . "<br>";
		} else if ($dbf_passwordtype == "plaintext") {
			if ($row[0] != substr($password, 0, $dbf_upassword_len)) $stop .= _INCORRECT_PASSWORD . "<br>";
		}
        }

        return($stop);
}

$username = makedbsafe($_POST[username]);
$password = makedbsafe($_POST[password]);
$submit = $_POST[check];
$url = $_GET[url];

if ($submit == 1) { //just submitted, so do the lookup
        $stop = userLookup($username, $password);
        if ($stop == "") {
                $row = mysql_fetch_row(mysql_query("SELECT $dbf_uemail,$dbf_upassword from $db_usertable WHERE $dbf_uname='$username'", $php121db));
        }
}

if ($submit == 1 && $stop == "") {
	$_SESSION[sess_username] = $username;
	$_SESSION[sess_password] = substr($row[1], 0, 9);
	setcookie('php121un', $username, time() + 2592000);
	setcookie('php121pw', substr($row[1], 0, 9), time() + 2592000);

	if ($url == "") {
		Header("Location: php121im.php");
	} else {
		Header("Location: $url");
	}
}
?>

<html>
<head>
<title>Matrmonial shaadi  - <?php echo _PLEASE_LOGIN_OR_REGISTER; ?></title>
<link href="../includes/Style.css" rel="stylesheet" type="text/css">
</head>
<body >
<font style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px">
<table border="0" width="100%" height="100%"  cellpadding="0" class="chatbg">
<tr><td height="30">&nbsp;</td></tr>
<tr>
	<td valign="top" style="padding-top:45px;" ><center>
	<p><font style="color: #a80326; font-size: 12px;">

<b><?php
if ($stop != "") {
	echo "<font color=\"FF0000\"><b>" . _ERROR . "</b>".$stop."</font><p>";
}

$numuserssql = "select $dbf_uid from $db_usertable";
$numusers = mysql_num_rows(mysql_query($numuserssql));

if ($integration=="phpbb" or $integration=="phpnuke") {
	$numusers--;
}
echo _PLEASE_LOGIN . "<p>";
?></b>

<form name="userlogin" method="POST">
<font color="#000000"><b><?php echo _USERNAME; ?>: </b></font> <br><input type="text" style="FONT-FAMILY:Arial;  FONT-SIZE: 12px" name="username" size="20" maxlength="<?php echo $dbf_uname_len; ?>" value="<?php echo $username; ?>" class="txtbox1">
<p>
<font color="#000000"><b><?php echo _PASSWORD; ?>:</b></font>  <br><input type="password" style="FONT-FAMILY:Arial;  FONT-SIZE: 12px" name="password" size="20" maxlength="<?php echo $dbf_upassword_input_max_length; ?>" value="<?php echo $password; ?>" class="txtbox1">
<p>
<input type="submit" value="<?php echo _LOGIN; ?>" style="FONT-FAMILY:Arial; font-weight:bold; FONT-SIZE: 12px" class="button">
<input type="hidden" name="check" value="1">
</form>
<p>

<?php
//echo $numusers . " " . _REGISTERED_USERS;
echo "<p>";
if ($acctman == 1) {
	if ($php121_config[user_can_create_account] == '1') {
		//echo "<a href=\"php121newuser.php\">" . _CREATE_NEW_ACCOUNT ."</a><p>";
	}
	//echo "<a href=\"php121recoveruser.php\"><font style=\"FONT-SIZE: 10px\">" . _LOST_LOGIN ."</font></a>";
}
// ************************************************
// ************************************************
// DO NOT CHANGE ANYTHING BELOW THIS LINE!!!!!!!!!!
// ************************************************
// ************************************************
?>

<br>
</center>
</font>
</td>
</tr>
<!--<tr height="20"><td bgcolor="#DFEFF5" valign="top">
<font style="color: #000000; font-size: 9px"><center>Powered by <a target="_blank" style="TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px" href="http://bestmatrimonial.thecreativeit.com"><U>AES</U></a></center></font>
</td></tr>-->
</table>
</body>
</html>
