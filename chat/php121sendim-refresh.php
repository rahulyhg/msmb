<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121sendim-refresh.php                                        **
 **  Date modified:     27/03/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Send IM Request and keep checking for a response                **
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

//find out if theres already a request sent, if not, send it
$sqla = "select r_id,r_time,r_result from " . $php121_prefix . "_requests where r_to='$to_user' and r_from='$uid' and r_result<>3";
//$sqla = "select r_id,r_time,r_result from " . $php121_prefix . "_requests where r_to='$to_user' and r_from='$uid' and r_time>$now-20";
$resulta = mysql_query($sqla, $php121db);
$numrows = mysql_num_rows($resulta);
$rowa = mysql_fetch_row($resulta);
$r_id = $rowa[0];
if ($numrows == 0) {
	$sql = "insert into " . $php121_prefix . "_requests (r_id, roomid, r_to, r_from, r_time, r_result, r_update_time, r_type) values('','','$to_user','$uid','$now','0','$now','1')";
	$result = mysql_query($sql, $php121db);
	$sql = "select r_id from " . $php121_prefix . "_requests where r_to='$to_user' and r_from='$uid' and r_time='$now'";
	$result = mysql_query($sql, $php121db);
	$row = mysql_fetch_row($result);
	$r_id = $row[0];
	$sql = "update " . $php121_prefix . "_requests set roomid='$r_id' where r_id='$r_id'";
	$result = mysql_query($sql, $php121db);
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
	$url = "Location: php121chat.php?id=" . $r_id . "&type=1";
	Header($url);
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
	echo "<html>
<head>
<meta http-equiv=\"refresh\" content=\"5\">
<title>" . _SEND_IM . "</title>
<link href=\"../includes/Style.css\" rel=\"stylesheet\" type=\"text/css\">
</head>
<body>
<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">";
	$sql = "select $dbf_uname from $db_usertable where $dbf_uid='$to_user'";
	$result = mysql_query($sql, $php121db);
	$row = mysql_fetch_row($result);
	echo $opentable;
	//echo "Request ID: ".$r_id."<p>";
	echo _REQUEST_SENT_TO . " " . $row[0] . " " . _WAITING . "<br><br>
	<form action=\"php121cancelim.php\" method=\"POST\">
	<input type=\"hidden\" name=\"to\" value=\"$to_user\">
	<input type=\"submit\" name=\"cancel\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\" value=\"" . _CANCEL . "\" class=\"butten\"></form>";
	echo $closetable;
	echo "</font></body></html>";
}
?>
