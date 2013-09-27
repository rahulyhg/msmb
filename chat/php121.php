<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121.php                                                      **
 **  Date modified:     23/06/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Core functions and session check				**
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

if(get_magic_quotes_runtime())
{
    // Deactivate
    set_magic_quotes_runtime(false);
    //set_magic_quotes_runtime(0); // Disable magic_quotes_runtime
}

//error_reporting(0);

global $integration;
require_once("php121db.php");

global $php121db, $db_usertable, $dbf_uid, $dbf_uname, $dbf_upassword, $dbf_passwordtype, $dbf_uemail;
global $dbf_user_chatting, $dbf_smilies, $dbf_level, $dbf_showrequest, $dbf_banned, $php121_config;

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
} else if ($integration == "phpbb") {
	define('IN_PHPBB', true); 
	$phpbb_root_path = '../'; 
	include($phpbb_root_path . 'extension.inc'); 
	require_once($phpbb_root_path . 'common.'.$phpEx); 

	// 
	// Start session management 
	// 
	$userdata = session_pagestart($user_ip, PAGE_INDEX); 
	init_userprefs($userdata); 
	// 
	// End session management 
	//
	$sess_username = $userdata['username'];
	$sess_password= $userdata['password'];

}

$sess_username = makedbsafe($sess_username);
$sess_password = makedbsafe($sess_password);

$sql = "Select $dbf_uname from $db_usertable";
$result = mysql_query($sql);
$numusers = mysql_num_rows($result);
$row = mysql_fetch_row(mysql_query("SELECT $dbf_banned,$dbf_uid,$dbf_focus_newmsg,$dbf_beep_newmsg,$dbf_timestamp,$dbf_timezone from $db_usertable WHERE $dbf_uname='$sess_username'", $php121db));
$bannedstatus = $row[0];
$sess_uid = $row[1];
$focus_newmsg = $row[2];
$beep_newmsg = $row[3];
$timestamp = $row[4];
$timezone = $row[5];

$server_timezone = $php121_config['server_timezone'];

if ($bannedstatus > 0) {
	echo _YOU_ARE_BANNED;
	die();
}

if ($sess_username != "") {
	require_once("php121checksession.php");
} else {
	header("Location: php121login.php");
	die;
}

function userCheck($username, $password) {
        global $php121db, $password, $db_usertable, $dbf_uname, $dbf_upassword;
	$username = makedbsafe($username);
	$password = makedbsafe($password);

        $stop = "";
        if (mysql_num_rows(mysql_query("SELECT $dbf_uname FROM $db_usertable WHERE $dbf_uname='$username'", $php121db)) == 0) $stop .= "<font color=\"FF0000\">" . _USERNAME_NOT_FOUND . "</font><br>";
        if ($stop == "") {
                $row = mysql_fetch_row(mysql_query("SELECT $dbf_upassword from $db_usertable WHERE $dbf_uname='$username'", $php121db));
                if ($row[0] != md5($password)) $stop .= "<font color=\"FF0000\">" . _INCORRECT_PASSWORD . "</font><br>";
        }
        return($stop);
}

function userLookup($username, $password) {
        global $php121db, $password, $db_usertable, $dbf_uname, $dbf_upassword;
	$username = makedbsafe($username);
	$password = makedbsafe($password);

        $stop = "";
        if (mysql_num_rows(mysql_query("SELECT $dbf_uname FROM $db_usertable WHERE $dbf_uname='$username'", $php121db)) == 0) $stop .= _USERNAME_NOT_FOUND . "<br>";
        if ($stop == "") {
                $row = mysql_fetch_row(mysql_query("SELECT $dbf_upassword from $db_usertable WHERE $dbf_uname='$username'", $php121db));
                if ($row[0] != md5($password)) $stop .= _INCORRECT_PASSWORD . "<br>";
        }
        return($stop);
}

function isadmin($username) {
	global $integration;
	$username = makedbsafe($username);
	if ($integration == "none") {
		global $php121db, $db_usertable, $dbf_uname, $dbf_level;
		$row = mysql_fetch_row(mysql_query("SELECT $dbf_level from $db_usertable WHERE $dbf_uname='$username'", $php121db));
		return $row[0] - 1;
	} else if ($integration == "phpnuke") {
		global $admin;
		return(is_admin($admin));
	} else if ($integration == "phpbb") {
		global $php121db, $db_usertable, $dbf_uname, $dbf_level;	
		$row = mysql_fetch_row(mysql_query("SELECT $dbf_level from $db_usertable WHERE $dbf_uname='$username'", $php121db));
                return $row[0];
	}
}

?>
