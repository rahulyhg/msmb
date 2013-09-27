<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121checksession.php                                          **
 **  Date modified:     23/06/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Check user is logged in properly     				**
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

global $cookie, $user;

session_start();
if ($_GET[op] == "logout") {
        session_destroy();
        session_start();
        setcookie('php121un',FALSE);
        setcookie('php121pw',FALSE);
}
if ($integration == "none") {
	$stop = checksession();
} else if ($integration == "phpnuke") {
	require_once("mainfile.php");
	cookiedecode($user);
	if (!is_user($user) || $sess_username == "") {
		$stop = "1";
	}

	$sess_username = makedbsafe($sess_username);
	$sess_password = makedbsafe($sess_password);

	$sql = "SELECT $dbf_uid, $dbf_smilies, $dbf_timezone, $dbf_timestamp from $db_usertable WHERE $dbf_uname='$sess_username'";
	$row = mysql_fetch_row(mysql_query($sql, $php121db));
        $uid = $row[0];
        $usersmilies = $row[1];
        $usertimezone = $row[2];
        $usertimestamp = $row[3];
} else if ($integration == "phpbb") {
	if( $userdata['session_logged_in'] ) { 
		$sess_username = $userdata['username'];
		$sess_password = $userdata['password'];
		$sql = "SELECT $dbf_uid, $dbf_smilies, $dbf_timezone, $dbf_timestamp from $db_usertable WHERE $dbf_uname='$sess_username'";
		$row = mysql_fetch_row(mysql_query($sql, $php121db));
		$uid = $row[0];
		$usersmilies = $row[1];
		$usertimezone = $row[2];
		$usertimestamp = $row[3];
	} else { 
		echo('Please login to phpBB first.'); 
		die();
	}
}

$url = basename($PHP_SELF);

if ($stop != "") {
	session_destroy();
	session_start();
	setcookie('php121un',FALSE);
	setcookie('php121pw',FALSE);
        Header("Location: php121login.php?url=$url");
}

function checksession() {
	global $php121db, $sess_username, $sess_password, $uid, $usersmilies, $usertimezone, $usertimestamp;
	global $db_usertable, $dbf_uid, $dbf_uname, $dbf_upassword, $dbf_passwordtype, $dbf_uemail;
	global $dbf_user_chatting, $dbf_smilies, $dbf_level, $dbf_showrequest, $dbf_timezone, $dbf_timestamp;

        $stop = "";
	$sql = "SELECT $dbf_uname FROM $db_usertable WHERE $dbf_uname='$sess_username'";
        if (mysql_num_rows(mysql_query($sql, $php121db)) == 0) $stop .= "1";

	$sess_username = makedbsafe($sess_username);
	$sess_password = makedbsafe($sess_password);

        if ($stop == ""){
		$sql = "SELECT $dbf_upassword,$dbf_uid,$dbf_smilies,$dbf_timezone,$dbf_timestamp from $db_usertable WHERE $dbf_uname='$sess_username'";
                $row = mysql_fetch_row(mysql_query($sql, $php121db));
		if (!$row) { die(mysql_error()); }
                if (substr($row[0], 0, 9) != $sess_password) $stop .= "1";
		$uid = $row[1];
		$usersmilies = $row[2];
		$usertimezone = $row[3];
		$usertimestamp = $row[4];
        }

        return($stop);
}

?>
