<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              php121im-refresh.php                                            **
 **  Date modified:     07/07/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     AJAX							        **
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

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");
require("php121.php");

$now = time();

//set timed-out logins to 0
$sql = "update $db_usertable set $dbf_user_chatting='0' where $now-$dbf_user_chatting>60";
$result = mysql_query($sql, $php121db);
if (mysql_affected_rows() > 0) {
        $controlUpdateKey = rand(1, 99999999999);
        $sqlupd = "update " . $php121_prefix . "_control set CL_LastModified='$now', CL_UpdateKey='$controlUpdateKey' where id='1'";
        $result = mysql_query($sqlupd);
}


//get the time of the last change
$sql = "select CL_LastModified,CL_UpdateKey from " . $php121_prefix . "_control where id='1'";
$row = mysql_fetch_row(mysql_query($sql, $php121db));
$lastModified = $row[0];
$controlUpdateKey = $row[1];

//get our last update
$sql = "select $dbf_user_chatting,php121_cl_update_key from $db_usertable where $dbf_uid='$sess_uid'";
$row = mysql_fetch_row(mysql_query($sql, $php121db));
$lastUpdated = $row[0];
$ourUpdateKey = $row[1];

//get the oldest chat request
$sql = "select r_from, r_time, r_id from " . $php121_prefix . "_requests where r_to='$uid' and r_result='0' and $now-r_update_time<20 order by r_id asc limit 1";
$result = mysql_query($sql, $php121db);
$gotrequest = mysql_num_rows($result);

if ($lastUpdated < $lastModified || $ourUpdateKey != $controlUpdateKey || $gotrequest) {

	//Create the XML response.
	$xml = '<?xml version="1.0" ?><root>';
	$xml .= '<message id="1">';
	$xml .= '<update>1</update>';
	if ($gotrequest) {
		$xml .= '<request>1</request>';
	} else {
		$xml .= '<request>0</request>';
	}
	$xml .= '</message>';
	$xml .= '</root>';
} else {
	$xml = '<?xml version="1.0" ?><root></root>';
} 
echo $xml;

$sql = "update $db_usertable set $dbf_user_chatting  = '$now', php121_cl_update_key = '$controlUpdateKey' where $dbf_uid='$sess_uid'";
$row = mysql_query($sql, $php121db);

//PHPNuke - Keep nuke session alive
if ($integration == "phpnuke") {
	global $prefix;
	$sql = "update " . $prefix . "_session set time = '$now' where $dbf_uname = '$sess_username'";
	mysql_query($sql, $php121db);
}

//phpBB - Keep session alive
if ($integration == "phpbb") {
	$sql = "update " . $db_usertable . " set user_session_time = '$now' where $dbf_uname = '$sess_username'";
	mysql_query($sql, $php121db);
}


//check for timeouts
$sql = "select roomid, uname from " . $php121_prefix . "_rooms where lastping < $now - 20 and lastping>0 and timedout = '0'";
$result = mysql_query($sql, $php121db);
$timedoutrow = mysql_fetch_row($result);
$msg = $timedoutrow[1] . " " . _LEFT_CHAT;

if ($timedoutrow[1]) {
	$sql = "insert into " . $php121_prefix . "_messages (msgid, roomid, username, timestamp, servernotice, message) values ('','" . $timedoutrow[0] . "','" . $timedoutrow[1] . "','$now','2','$msg')";
	$result3 = mysql_query($sql, $php121db);
	$sql = "update " . $php121_prefix . "_rooms set timedout = '1' where roomid='$timedoutrow[0]' and uname='$timedoutrow[1]'";
	$result3 = mysql_query($sql, $php121db);
        //force a CL update for all users in affected room
        //get list of users in affected room
        $sql = "select uname from " . $php121_prefix . "_rooms where roomid='$timedoutrow[0]'";
        $result2 = mysql_query($sql, $php121db);
        while ($resultrow = mysql_fetch_row($result2)) {
                //force a CL update
                $sql = "update $db_usertable set php121_cl_update_key='0' where $dbf_uname='$resultrow[0]'";
                $result3 = mysql_query($sql, $php121db);
        }
}

//check for recent chat list updates
$sql = "select roomid, uname from " . $php121_prefix . "_rooms where lastping < $now - 120 and lastping>0 and timedout = '1' order by lastping desc";
$result = mysql_query($sql, $php121db);
while ($timedoutrow = mysql_fetch_row($result)) {
        //force a CL update for all users in affected room
        //get list of users in affected room
        $sql = "select uname from " . $php121_prefix . "_rooms where roomid=$timedoutrow[0]";
        $result2 = mysql_query($sql, $php121db);
        while ($resultrow = mysql_fetch_row($result2)) {
                $sql = "update " . $php121_prefix . "_rooms set timedout = '2' where roomid='$timedoutrow[0]' and uname='$timedoutrow[1]'";
                $result3 = mysql_query($sql, $php121db);
                                                                                                                            
                //force a CL update
                $sql = "update $db_usertable set php121_cl_update_key='0' where $dbf_uname='$resultrow[0]'";
                $result3 = mysql_query($sql, $php121db);
        }
}
?>
