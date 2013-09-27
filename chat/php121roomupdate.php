<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              php121roomupdate.php                                            **
 **  Date modified:     05/07/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Room AJAX				                        **
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

//Send some headers to keep the user's browser from caching the response.
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

require('php121.php');
$now = time();
$r_id = (int) $_GET['r_id'];
$us = $_GET['us'];
$type = $_GET['type'];
$echoxml = 0;
//Check to see if a message was sent.
if(isset($_POST['message']) && $_POST['message'] != '') {
$search = array ('@<script[^>]*?>.*?</script>@si', // Strip out javascript
                 '@<[\/\!]*?[^<>]*?>@si',          // Strip out HTML tags
                 '@([\r\n])[\s]+@',                // Strip out white space
                 '@&(quot|#34);@i',                // Replace HTML entities
                 '@&(amp|#38);@i',
                 '@&(lt|#60);@i',
                 '@&(gt|#62);@i',
                 '@&(nbsp|#160);@i',
                 '@&(iexcl|#161);@i',
                 '@&(cent|#162);@i',
                 '@&(pound|#163);@i',
                 '@&(copy|#169);@i',
                 '@&#(\d+);@e');                    // evaluate as php
$replace = array (' ',
                 ' ',
                 '\1',
                 '"',
                 '&',
                 '<',
                 '>',
                 ' ',
                 chr(161),
                 chr(162),
                 chr(163),
                 chr(169),
                 'chr(\1)');
$msg = addslashes(preg_replace($search, $replace, $_POST['message']));
        $sql = "INSERT INTO " . $php121_prefix . "_messages (msgid, roomid, username, timestamp, servernotice, message) values ('','" . (int) $_GET['r_id'] . "','" . makedbsafe($_GET['name']) . "','$now','0','$msg')";
	$result = mysql_query($sql, $php121db);
}

if ($us == "from") {
	//set the request as accepted and user has entered (3)
        if ($type==2) {
                //invite
                $sql = "update " . $php121_prefix . "_requests set r_result='3' where roomid='$r_id'";
        } else {
                //normal request
                $sql = "update " . $php121_prefix . "_requests set r_result='3' where r_id='$r_id'";
        }
        $result = mysql_query($sql, $php121db);
}

//update our lastping to keep us alive
$sql = "update " . $php121_prefix . "_rooms set lastping = '$now' where roomid = '$r_id' and uname = '$sess_username'";
$result = mysql_query($sql, $php121db);

//check for timeouts (this is only used if all contact lists have been closed)
$sql = "select roomid, uname from " . $php121_prefix . "_rooms where lastping < $now - 20 and lastping>0 and timedout = '0'";
$result = mysql_query($sql, $php121db);
while ($timedoutrow = mysql_fetch_row($result)) {
	$msg = $timedoutrow[1] . " " . _LEFT_CHAT;
	$sql = "insert into " . $php121_prefix . "_messages (msgid, roomid, username, timestamp, servernotice, message) values ('','" . $timedoutrow[0] . "','" . $timedoutrow[1] . "','$now','2','$msg')";
	$result2 = mysql_query($sql, $php121db);
	$sql = "update " . $php121_prefix . "_rooms set timedout = '1' where roomid='$timedoutrow[0]' and uname='$timedoutrow[1]'";
	$result2 = mysql_query($sql, $php121db);
}

//if we had timedout from the chat then show a join message
$sql = "select lastping,timedout from " . $php121_prefix . "_rooms where roomid = '$r_id' and uname = '$sess_username'";
$result = mysql_query($sql, $php121db);
$row = mysql_fetch_row($result);
if ($row[1] > 0) {
        $message = $sess_username . " " . _REJOIN_CHAT;
        $sql = "insert into " . $php121_prefix . "_messages (msgid, roomid, username, timestamp, servernotice, message) values('','$r_id','$sess_username','$now','3','$message')";
        $result = mysql_query($sql, $php121db);

        $sql = "update " . $php121_prefix . "_rooms set lastping='$now',timedout='0' where roomid='$r_id' and uname='$sess_username'";
        $result = mysql_query($sql, $php121db);

        //get list of names in room
        $sql = "select uname from " . $php121_prefix . "_rooms where roomid='$r_id'";
        $result = mysql_query($sql, $php121db);
        while ($chatmemberrow = mysql_fetch_row($result)) {
                //force cl update
                $sql = "update $db_usertable set php121_cl_update_key='0' where $dbf_uname='$chatmemberrow[0]'";
                $result2 = mysql_query($sql, $php121db);
        }
}

//show people currently in the room
$sql = "select uname from " . $php121_prefix . "_rooms where roomid='$r_id' and timedout='0' order by uname asc";
$result = mysql_query($sql, $php121db);
while ($row = mysql_fetch_row($result)) {
        $userlist .= "***IMG***" . $row[0] . ",";
}

//Create the XML response.
$xml = '<?xml version="1.0" ?><root>';

$justjoined = 0;
if (isset($_GET['last']) && $_GET['last'] > 0) {
	$last = (int) $_GET['last'];
} else {
	$justjoined = 1;
	//just get the last 20 messages
	//get id of the most Resent message
	$sql = "select msgid FROM " . $php121_prefix . "_messages WHERE roomid = '" . (int) $_GET['r_id'] . "' order by msgid desc";
	$row = mysql_fetch_row(mysql_query($sql, $php121db));
	$last = $row[0] - 20;
	if ($last < 0) {
		$last = 0;
	}
}

$sql = "SELECT msgid, roomid, username, timestamp, servernotice, message FROM " . $php121_prefix . "_messages WHERE roomid = '" . (int) $_GET['r_id'] . "' AND msgid > $last order by msgid asc";
$message_query = mysql_query($sql, $php121db);

if ($justjoined == 1) {
	//show any old messages - including ours
	//Loop through each message and create an XML message node for each.
	while($message_array = mysql_fetch_array($message_query)) {
		$xml .= '<message id="' . $message_array['msgid'] . '">';
		$xml .= '<user>' . htmlspecialchars($message_array['username']) . '</user>';
		$xml .= '<notice>' . $message_array['servernotice'] . '</notice>';
		if ($usersmilies == 1) {
			$xml .= '<text>' . htmlspecialchars(stripslashes(smilies($message_array['message']))) . '</text>';
		} else {
			$xml .= '<text>' . htmlspecialchars(stripslashes($message_array['message'])) . '</text>';
		}
		$xml .= '<time>' . $message_array['timestamp'] . '</time>';
		$xml .= '<userlist>' . $userlist . '</userlist>';
		$xml .= '</message>';
	}
	$xml .= '</root>';
	echo $xml;
} else {
	//just send back other people's messages as we have finished loading any existing history
	while($message_array = mysql_fetch_array($message_query)) {
		if (($message_array['username'] != $sess_username) || $message_array['servernotice']>0 ) {
			$echoxml = 1;
			$xml .= '<message id="' . $message_array['msgid'] . '">';
			$xml .= '<user>' . htmlspecialchars($message_array['username']) . '</user>';
			$xml .= '<notice>' . $message_array['servernotice'] . '</notice>';
			if ($usersmilies == 1) {
				$xml .= '<text>' . htmlspecialchars(stripslashes(smilies($message_array['message']))) . '</text>';
			} else {
				$xml .= '<text>' . htmlspecialchars(stripslashes($message_array['message'])) . '</text>';
			}
			$xml .= '<time>' . $message_array['timestamp'] . '</time>';
			$xml .= '<userlist>' . $userlist . '</userlist>';
			$xml .= '</message>';
		}
	}
	if ($echoxml == 1) {
		$xml .= '</root>';
		echo $xml;
	} else {
		echo "<root></root>";
	}
}

function smilies($message) {
        global $siteurl, $php121_prefix, $php121db;
        $ssql = "Select * from " . $php121_prefix . "_smilies";
        $sresult = mysql_query($ssql, $php121db);
        while($temp = mysql_fetch_array($sresult, MYSQL_BOTH))
        {
                $ssresult[] = $temp;
        }
                                                                                                                            
        $smilies = $ssresult;
        if (count($smilies)) {
                usort($smilies, 'smiley_sort');
        }
                for ($i = 0; $i < count($smilies); $i++)
                {
                        $orig[] = "/(?<=.\W|\W.|^\W)" . preg_quote($smilies[$i]['code']) . "(?=.\W|\W.|\W$)/";
                        $repl[] = '<img src="'. $siteurl . 'php121smilies/' . $smilies[$i]['pack'] . '/' . $smilies[$i]['filename'] . '" title="' . $smilies[$i]['description'] . '" border="0" />';
                }
                                                                                                                            
        if (count($orig))
        {
                $message = preg_replace($orig, $repl, ' ' . $message . ' ');
                $message = substr($message, 1, -1);
        }
                                                                                                                            
        return $message;
}

function smiley_sort($a, $b)
{
        if ( strlen($a['code']) == strlen($b['code']) )
        {
                return 0;
        }
                                                                                                                            
        return ( strlen($a['code']) > strlen($b['code']) ) ? -1 : 1;
}

?>
