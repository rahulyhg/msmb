<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121sendim.php                                                **
 **  Date modified:     06/07/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Check for dead requests before sending the request              **
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

global $db_usertable, $dbf_uid, $dbf_uname, $dbf_upassword, $dbf_passwordtype, $dbf_uemail;
global $dbf_user_chatting, $dbf_smilies, $dbf_level, $dbf_showrequest, $php121_prefix;

$uname = $sess_username;
$to_user = makedbsafe($_GET['to']);
$now = time();
$uid = $sess_uid;

//get user ids I have blocked
$sql = "select b_block from " . $php121_prefix . "_blocks where b_user='$uid'";
$result = mysql_query($sql, $php121db);
$myblocks = "";
while ($row = mysql_fetch_row($result)) {
	$myblocks[] = $row[0];
}
if ($myblocks == "") {
	$myblocks[] = "";
}

//are we being blocked by the to_user?
$sql = "select b_id from " . $php121_prefix . "_blocks where b_block='$uid' and b_user='$to_user'";
$result = mysql_query($sql, $php121db);
$row = mysql_num_rows($result);
if ($row > 0) {
	$blocked = 1;
}

if ($uid == $to_user) {
        //numpty
	echo $opentable;
        echo "<b>" . _ERROR . _CANT_IM_SELF . "!</b><p><a href=\"javascript:window.close();\">" . _CLOSE . "</a>";
	echo $closetable;
} else if (in_array($to_user, $myblocks)) {
	//numpty
	echo $opentable;
	echo "<b>" . _ERROR . _USER_IS_BLOCKED . "<p><a href=\"javascript:window.close();\">" . _CLOSE . "</a>";
	echo $closetable;
} else if ($blocked == 1) {
	//user has blocked us
	echo $opentable;
	echo "<b>" . _ERROR . _YOU_ARE_BLOCKED . "<p><a href=\"javascript:window.close();\">" . _CLOSE . "</a>";
	echo $closetable;
} else {
        //delete failed requests from this user to the receiptient
        $sqla = "delete from " . $php121_prefix . "_requests where r_to='$to_user' and r_from='$uid' and (r_result=0 or r_result='2')";
        mysql_query($sqla, $php121db);
	Header("Location: php121sendim-refresh.php?to=".$to_user);
}
?>
