<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              php121sendinvite.php                                            **
 **  Date modified:     07/07/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Invite user to exising chat                                     **
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

$uname = $sess_username;
$to_user = makedbsafe($_POST['users']);
$roomid = (int) makedbsafe($_GET['roomid']);
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

if (in_array($to_user, $myblocks) && $to_user != "") {
        //numpty
        echo $opentable;
        echo "<b>" . _ERROR . _USER_IS_BLOCKED . "<p><a href=\"javascript:window.close();\">" . _CLOSE . "</a>";
        echo $closetable;
	die();
} else if ($blocked == 1) {
        //user has blocked us
        echo $opentable;
        echo "<b>" . _ERROR . _YOU_ARE_BLOCKED . "<p><a href=\"javascript:window.close();\">" . _CLOSE . "</a>";
        echo $closetable;
	die();
} else {
	if ($to_user) {
		//an invite has just been sent
		//find out if theres already a request sent, if not, send it
		$sqla = "select r_id,r_time,r_result from " . $php121_prefix . "_requests where r_to='$to_user' and r_from='$uid' and r_time>$now-20";
		$resulta = mysql_query($sqla, $php121db);
		$numrows = mysql_num_rows($resulta);
		$rowa = mysql_fetch_row($resulta);
		$r_id = $rowa[0];
		if ($numrows == 0) {
			$sql = "insert into " . $php121_prefix . "_requests (r_id, roomid, r_to, r_from, r_time, r_result, r_update_time, r_type) values('','$roomid','$to_user','$uid','$now','0','$now','2')";
			$result = mysql_query($sql, $php121db);
			$sql = "select r_id from " . $php121_prefix . "_requests where r_to='$to_user' and r_from='$uid' and r_time='$now'";
			$result = mysql_query($sql, $php121db);
			$row = mysql_fetch_row($result);
			$r_id = $row[0];
		} else {
			//request already sent, but we are still trying, so update the time of request update
			$sql = "update " . $php121_prefix . "_requests set r_update_time='$now' where r_to='$to_user' and r_from='$uid' and r_id='$r_id'";
			$result = mysql_query($sql, $php121db);
		}
		//see if we've been accepted and that the receipiant is already in room
		$sql3 = "select roomid from " . $php121_prefix . "_rooms where roomid='$r_id'";
		$result3 = mysql_query($sql3, $php121db);
		$row3 = mysql_num_rows($result3);
		if ($row3 > 0 && $rowa[2] == 1) {
			//accepted
			die ("user should now be in room");
		}
																    
		//see if we've been waiting too long or been rejected
		if ($numrows != 0 && (time() - $rowa[1] > 60 ) && $rowa[2] == 0 ) {
			//delete request and stop refreshing
			$sql = "delete from " . $php121_prefix . "_requests where r_to='$to_user' and r_from='$uid'";
			$result = mysql_query($sql, $php121db);
			Header("Location: php121im-timeout.php");
		} else if ($rowa[2] == 2 ) {
			$sql = "delete from " . $php121_prefix . "_requests where r_to='$to_user' and r_from='$uid'";
			$result = mysql_query($sql, $php121db);
			Header("Location: php121im-na.php");
		} else {
			echo $opentable;
			echo "Request sent.<p>";
			echo "<b><a style=\"BACKGROUND: none; COLOR: #000066; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none\" href=\"javascript:window.close()\">" . _CLOSE . "</a></b>";
			echo $closetable;
			die();
		}
	}
}

$currentchatters = "";


//people currently in the room
$sql = "select uname from " . $php121_prefix . "_rooms where roomid='$roomid' and timedout='0'";
$result = mysql_query($sql, $php121db);
while ($row = mysql_fetch_row($result)) {
	$currentchatters[] = strtolower($row[0]);
}

$userslist = "";
$userssql = "select $dbf_uname,$dbf_user_chatting,$dbf_uid,$dbf_level from $db_usertable where $now-$dbf_user_chatting<90";
$usersresult = mysql_query($userssql, $php121db);
$count = 0;

while ($row = mysql_fetch_row($usersresult)) {
	if (strtolower($row[0]) != $sess_username && !in_array(strtolower($row[0]), $currentchatters)) {
		$userslist .= "<option name=\"users\" value=\"$row[2]\">$row[0]</option>";
		$count++;
	}
}

echo $opentable;

if ($count > 0) {
	echo _INVITE_SELECT;
	echo "<center><table border=\"0\" cellspacing=\"10\"><tr><td valign=\"top\"><form method=\"POST\">
		<select name=\"users\">";
	echo $userslist;
	echo "</td><td valign=\"top\"><input type=\"submit\" name=\"invite\" value=\"Invite\">";
	echo "</select></form></table></center>";
	echo "<b><a style=\"BACKGROUND: none; COLOR: #000066; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none\" href=\"javascript:window.close()\">" . _CLOSE . "</a></b>";
} else {
	echo _ERROR . " " . _INVITE_ALL_HERE . "<P>";
	echo "<b><a style=\"BACKGROUND: none; COLOR: #000066; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none\" href=\"javascript:window.close()\">" . _CLOSE . "</a></b>";
}

echo $closetable;

?>
