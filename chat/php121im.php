<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121im.php	                                                **
 **  Date modified:     09/07/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Main PHP121 Window allowing users to start chat sessions	**
 **                     AKA Contact List						**
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
if(isset($_COOKIE['php121un'])){
	setcookie("php121un","");	
}
if(isset($_COOKIE['php121pw'])){
	setcookie("php121pw","");	
}
if($_REQUEST['from']=="admin"){
	setcookie("php121un",$_REQUEST['uname'],time+3600,"/");	
	setcookie("php121pw",$_REQUEST['upass'],time+3600,"/");	
}else{
	$_COOKIE['php121un']=$_REQUEST['uname'];
	$_COOKIE['php121pw']=$_REQUEST['upass'];
}


require_once("php121.php");
$choice = $_POST['choice'];
$userlist = "";
$url = basename($PHP_SELF);

?>

<html>
<head>
<title>Matrmonial shaadi  - <?php echo _INSTANT_MESSENGER; ?></title>
<script type="text/javascript">
	<!--
	var newwindow;

	function poptastic(url,name) {
		newwindow=window.open(url,name,'height=550, width=750, left=40, top=40, toolbar=no, menubar=no, directories=no, location=no, scrollbars=no, status=no, resizable=yes, fullscreen=no');
		if (window.focus) { newwindow.focus() }
	}

	function popoptions() {
		newwindow=window.open('php121options.php','options','height=550, width=400, left=60, top=60, toolbar=no, menubar=no, directories=no, location=no, scrollbars=yes, status=no, resizable=yes, fullscreen=no');
		if (window.focus) { newwindow.focus() }
	}

        function popadmin() {
		newwindow=window.open('php121admin.php','admin','height=550, width=400, left=60, top=60, toolbar=no, menubar=no, directories=no, location=no, scrollbars=yes, status=no, resizable=yes, fullscreen=no');
		if (window.focus) { newwindow.focus() }
        }

        var receiveReq = getXmlHttpRequestObject();
        var lastUpdate = 0;
        var mTimer;
        //Function for initializating the page.
        function startChat() {
                //Start Receiving Messages.
                getChatText();
        }
        //Gets the browser specific XmlHttpRequest Object
        function getXmlHttpRequestObject() {
                if (window.XMLHttpRequest) {
                        return new XMLHttpRequest();
                } else if(window.ActiveXObject) {
                        return new ActiveXObject("Microsoft.XMLHTTP");
                } else {
			alert("<?php echo _NO_AJAX; ?>");
                }
        }

        //Gets the current messages from the server
        function getChatText() {
                if (receiveReq.readyState == 4 || receiveReq.readyState == 0) {
			var dtNow = new Date();
			var unixtimeps = dtNow.getTime();
                        receiveReq.open("GET", 'php121im-refresh.php?' + unixtimeps, true);
                        receiveReq.onreadystatechange = handleReceiveChat;
                        receiveReq.send(null);
			var theDate = new Date();
			var myHour = theDate.getHours();
			var myMinute = theDate.getMinutes();
			var mySecond = theDate.getSeconds();
			if (myHour < 10 && myHour >= 0) { myHour = "0" + myHour; }
			if (myMinute < 10 && myMinute >= 0) { myMinute = "0" + myMinute; }
			if (mySecond < 10 && mySecond >= 0) { mySecond = "0" + mySecond; }
			var div_time = document.getElementById('div_time');
			div_time.innerHTML = "<a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"php121im.php\"><?php echo _UPDATED;?></a>: " + myHour + ':' + myMinute + ':' + mySecond;
                }
        }
        
                        //Function for handling the return of chat text
                        function handleReceiveChat() {
                                if (receiveReq.readyState == 4) {
                                        var xmldoc = receiveReq.responseXML;
					var message_nodes = xmldoc.getElementsByTagName("message");
					if (message_nodes[0]) {
						var update = message_nodes[0].getElementsByTagName("update");
						var request = message_nodes[0].getElementsByTagName("request");
						if (request[0].firstChild.nodeValue == 1) {
							setTimeout('refresh();',2000);
						}
						if (update[0].firstChild.nodeValue == 1 && request[0].firstChild.nodeValue == 0) {
						window.location = "<?php echo $siteurl; ?>php121im.php";
						} 
                                	}
					mTimer = setTimeout('getChatText();',5000); //Get new data in 5 seconds
				}
                        }

			function refresh() {
				window.location = "<?php echo $siteurl; ?>php121im.php";
			}

	//-->
</SCRIPT>
</head>
<body onload = "javascript:startChat();">
<font style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px">

<?php
global $db_usertable, $dbf_uid, $dbf_uname, $dbf_upassword, $dbf_passwordtype, $dbf_uemail;
global $dbf_user_chatting, $dbf_smilies, $dbf_level, $dbf_showrequest;
global $usertimestamp, $dbf_timezone, $dbf_timestamp, $php121_config, $usertimezone;

if ($sess_username == "") {
	echo _PLEASE_LOGIN;
}

//calculate time difference between user and server
$timediff = $usertimezone - $php121_config['server_timezone'];
$now = time();

//get some user details
$sql = "SELECT $dbf_uid,$dbf_level,$dbf_showrequest,$dbf_user_chatting FROM $db_usertable WHERE $dbf_uname='$sess_username'";
$result = mysql_query($sql, $php121db);
$row = mysql_fetch_row($result);
$uid = $row[0];
$userlevel = isadmin($sess_username);
$showrequest = $row[2];

//will our presence cause the contact list to require an update?
if ($row[3] == 0) {
	//we just caused an update
	$controlUpdateKey = rand(1, 99999999999);
	$sqlupd = "update " . $php121_prefix . "_control set CL_LastModified='$now', CL_UpdateKey='$controlUpdateKey' where id='1'";
	$resultupd = mysql_query($sqlupd, $php121db);
}

//update our online status for everyone to see
$sqlupd = "update $db_usertable set $dbf_user_chatting = '$now' where $dbf_uid = '" . $uid . "'";
$resultupd = mysql_query($sqlupd, $php121db);

//did we block or unblock someone?
$blockop = $_GET['blockop'];
$blockuser = $_GET['blockuser'];

if ($blockop == "block" && $blockuser > 0) {
	$sql = "delete from " . $php121_prefix . "_blocks where b_user='$uid' and b_block='$blockuser'";
	mysql_query($sql, $php121db);
	$sql = "insert into " . $php121_prefix . "_blocks (b_user,b_block) values ('$uid','$blockuser')";
	mysql_query($sql, $php121db);
} else if ($blockop == "unblock" && $blockuser > 0) {
	$sql = "delete from " . $php121_prefix . "_blocks where b_user='$uid' and b_block='$blockuser'";
	mysql_query($sql, $php121db);
}

//remove junk requests
//$sql = "delete from " . $php121_prefix . "_requests where $now-r_update_time>20";
//mysql_query($sql, $php121db);

//get the oldest chat request
$sql = "select r_from, r_time, r_id, roomid, r_type from " . $php121_prefix . "_requests where r_to='$uid' and r_result='0' and $now-r_update_time<20 order by r_id asc limit 1";
$result = mysql_query($sql, $php121db);
$gotrequest = mysql_num_rows($result);
$row = mysql_fetch_row($result);

if ($gotrequest) {
	//get the username of the requestor (we should really use a JOIN here!)
	$sql = "select $dbf_uname from $db_usertable where $dbf_uid = '$row[0]'";
	$result = mysql_query($sql, $php121db);
	$rowz = mysql_fetch_row($result);
	$from_username = $rowz[0];
}

//check if we accepted or rejected a request before the refresh
if ($choice == "no") {
	//update request to be rejected
	$sql2 = "update " . $php121_prefix . "_requests set r_result='2' where r_to='$uid' and r_from='$row[0]'";
	mysql_query($sql2, $php121db);
} 

//we have a request
if ($gotrequest > 0 && $choice != "no" && $showrequest == 1) {
	echo "<table border=\"1\" width=\"100%\" height=\"100%\" cellpadding=\"5\" style=\"border-collapse: collapse\" bordercolor=\"#FF0000\">";
        echo "<tr height=\"*\"><td valign=\"top\" bgcolor=\"#FFCCCC\"><center><font style=\"COLOR: #000000; FONT-SIZE: 14px; FONT-WEIGHT: bold\">" . _INCOMING_REQUEST . "</font><br><br>";
	echo "<font style=\"color: #000000; font-size: 10px\"> " . _REQUEST_FROM . " <b>$from_username</b>." . _ACCEPT_REQUEST . "<p>
	<form method=\"POST\" action=\"php121im.php\">";

	if ($row[4]==2) {
		//an invite - the room has been specified
		echo "<input type=\"hidden\" name=\"id\" value=\"$row[3]\">
		<input type=\"submit\" name=\"choice\" value=\"yes\" onClick=\"poptastic('php121chat.php?id=" . $row[3] . "&type=2&choice=yes','" . $row[3] . "')\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">";
	} else {
		//new request
		echo "<input type=\"hidden\" name=\"id\" value=\"$row[2]\">
		<input type=\"submit\" name=\"choice\" value=\"yes\" onClick=\"poptastic('php121chat.php?id=" . $row[2] . "&type=1&choice=yes','" . $row[2] . "')\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">";
	}
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"choice\" value=\"no\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\"></form></center></font>
	<script language=\"JavaScript\">
		<!--
		window.focus();
		//-->
	</script>
	</td></tr></table>
	";

} else if ($gotrequest > 0 && $choice != "no" && $showrequest == 0) {
	//user doesn't want the incoming request window shown - just go straight to chat
        echo "<table border=\"1\" width=\"100%\" height=\"100%\" cellpadding=\"5\" style=\"border-collapse: collapse\" bordercolor=\"#FF0000\">";
        echo "<tr height=\"*\"><td valign=\"top\" bgcolor=\"#FFCCCC\"><center><font style=\"COLOR: #000000; FONT-SIZE: 14px; FONT-WEIGHT: bold\">" . _INCOMING_REQUEST . "</font><br><br>";
	echo "<font style=\"color: #000000; font-size: 10px\">" . _REQUEST_FROM . " <b>$from_username</b>.<p>  " . _AUTO_OPEN_IM_ATTEMPT;
	echo "</font></td></tr></table>";

	if ($row[4]==2) {
                //an invite - the room has been specified
                echo "<script language=\"JavaScript\">poptastic('php121chat.php?id=" . $row[3] . "&type=2&choice=yes','" . $row[3] . "'); </script>";
        } else {
                //new request
                echo "<script language=\"JavaScript\">poptastic('php121chat.php?id=" . $row[2] . "&type=1&choice=yes','" . $row[2] . "'); </script>";
        }

} else {
	echo "<table border=\"1\" width=\"100%\"  height=\"100%\" cellpadding=\"5\" style=\"border-collapse: collapse\" bordercolor=\"#000000\">";
	echo "<tr><td valign=\"top\" class=\"chatbg\"><center><img border=\"0\" src=\"..\images\logo_chat.jpg\" width=\"168\" align=\"left\"></font><br>";

	$hour = date("H");
	$location = $_SERVER['PHP_SELF'];

//	echo "<font style=\"color: #000000; font-size: 10px\"><a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"$location\">" . _UPDATED . "</a>: " . date("g:i:s a", mktime($hour + $timediff, date("i"), date("s"), date("m"), date("d"), date("Y"))) . "</font><br>";
	//echo "<font style=\"color: #000000; font-size: 10px\"><a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"$location\">" . _UPDATED . "</a>: </font>";
        echo "<div id=\"div_time\" style=\"overflow: none; border: none; font-size:10px; color:#e68800\"><a style=\"TEXT-DECORATION: none; COLOR: #e68800; FONT-SIZE: 10px\" href=\"php121im.php\">" . _UPDATED . "</a>: 00:00:00</div>";
	echo "<br></center>";

	echo "<font style=\"color: #e68800; font-size: 10px\">" . _ONLINE_AS . ": <b>" . $sess_username . "</b><br>";
	
	//commented by AES 	
	//echo "[<a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"javascript:popoptions();\">" . _OPTIONS . "</a>]";

	if ($integration == "none") {
		echo "&nbsp;[<a style=\"TEXT-DECORATION: none; COLOR: #a80326; font-weight:bold; FONT-SIZE: 10px\" href=\"php121login.php?op=logout\" target=\"_parent\">" . _LOGOUT . "</a>]";
	}

	if ($userlevel > 0) {	
		#commented by AES 	
		//echo "&nbsp;[<a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"javascript:popadmin();\">" . _PADMIN . "</a>]";
	}

	echo "<br><hr>";
	
	echo "<B>" . _YOUR_CHATS . ":</b><br>";

	//rooms that we are / were in
	$sql = "select roomid from " . $php121_prefix . "_rooms where uname = '$sess_username'";
        $result = mysql_query($sql, $php121db);
        
	while ($row = mysql_fetch_row($result)) {
		$userlist = "";
		//how many people are in this room?
		$sql = "select count(*) from " . $php121_prefix . "_rooms where roomid='$row[0]'";
		$result2 = mysql_query($sql, $php121db);
		$numpeopleinroomrow = mysql_fetch_row($result2);
		$numpeopleinroom = $numpeopleinroomrow[0];

		//how many timeouts in this room?
                $sql = "select count(*) from " . $php121_prefix . "_rooms where roomid='$row[0]' and timedout>0";
                $result2 = mysql_query($sql, $php121db);
                $numtimedoutsrow = mysql_fetch_row($result2);
                $numtimedouts = $numtimedoutsrow[0];

		//now filter these results to find rooms that have at least 1 person in them (number of timedouts < num of people in room)
		if ($numtimedouts < $numpeopleinroom) {
			//some people are still in the room
			$sql = "select uname from " . $php121_prefix . "_rooms where roomid = '$row[0]' and uname<>'$sess_username'";
			$result2 = mysql_query($sql, $php121db);
			while ($row2 = mysql_fetch_row($result2)) {
				$userlist .= $row2[0] . ", ";
			}
			if (substr($userlist,strlen($userlist)-2,strlen($userlist)) == ", ") {
				$userlist = substr($userlist,0,strlen($userlist)-2);
			}

			//was this an invite or a new request?
			$sqltype = "select r_type from " . $php121_prefix . "_requests where roomid='$row[0]' and (r_to='$sess_uid' or r_from='$sess_uid')";
			$resulttype = mysql_query($sqltype, $php121db);
                        $rowtype = mysql_fetch_row($resulttype);

			if ($rowtype[0]==1) {
				//new chat
				//display
				if ($userlist == "") {
					echo "- <a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"javascript:poptastic('php121chat.php?id=$row[0]&type=1','$row[0]');\"><i>" . _JOINING . "</i></a><br>";
				} else {
					echo "- <a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"javascript:poptastic('php121chat.php?id=$row[0]&type=1','$row[0]');\">" . $userlist . "</a><br>";
				}

			} else {
				//invite
				//display
				if ($userlist == "") {
					echo "- <a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"javascript:poptastic('php121chat.php?id=$row[0]&type=2','$row[0]');\"><i>" . _JOINING . "</i></a><br>";
				} else {
					echo "- <a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"javascript:poptastic('php121chat.php?id=$row[0]&type=2','$row[0]');\">" . $userlist . "</a><br>";
				}

			}
		
		}
	}

	//echo "<hr><b>" . _Resent_CHATS . ":</b><br>";
	//Resent CHATS
	//select any chat sessions with us in them but not currently there

        //rooms that we are / were in
        $sql = "select roomid from " . $php121_prefix . "_rooms where uname = '$sess_username'";
        $result = mysql_query($sql, $php121db);
                                                                                                                            
                                                                                                                            
        while ($row = mysql_fetch_row($result)) {
		$userlist = "";
                //how many people are in this room?
                $sql = "select count(*) from " . $php121_prefix . "_rooms where roomid='$row[0]'";
                $result2 = mysql_query($sql, $php121db);
                $numpeopleinroomrow = mysql_fetch_row($result2);
                $numpeopleinroom = $numpeopleinroomrow[0];
                                                                                                                            
                //how many timeouts in this room?
                $sql = "select count(*) from " . $php121_prefix . "_rooms where roomid='$row[0]' and timedout>0";
                $result2 = mysql_query($sql, $php121db);
                $numtimedoutsrow = mysql_fetch_row($result2);
                $numtimedouts = $numtimedoutsrow[0];

		//get the time of the latest ping in the room
		$sql = "select lastping from " . $php121_prefix . "_rooms where roomid='$row[0]' order by lastping desc";
		$result2 = mysql_query($sql, $php121db);
		$mostResentpingrow = mysql_fetch_row($result2);
		$mostResentping = $mostResentpingrow[0];

		//was this an invite or a new request?
		$sqltype = "select r_type from " . $php121_prefix . "_requests where roomid='$row[0]' and (r_to='$sess_uid' or r_from='$sess_uid')";
		$resulttype = mysql_query($sqltype, $php121db);
		$rowtype = mysql_fetch_row($resulttype);
                                                                                                                            
                //now filter these results to find rooms that have nobody in them (number of timedouts = num of people in room)
                if ($numtimedouts == $numpeopleinroom && $mostResentping > $now - 120) {
                        $sql = "select uname from " . $php121_prefix . "_rooms where roomid = '$row[0]' and uname<>'$sess_username'";
                        $result2 = mysql_query($sql, $php121db);
                        while ($row2 = mysql_fetch_row($result2)) {
				$userlist .= $row2[0] . ", ";
                        }
			if (substr($userlist,strlen($userlist)-2,strlen($userlist)) == ", ") {
				$userlist = substr($userlist,0,strlen($userlist)-2);
			}

                        //display
			if ($rowtype[0]==1) {
				echo "- <i><a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"javascript:poptastic('php121chat.php?id=$row[0]&type=1','$row[0]');\">" . $userlist . "</a></i><br>";
			} else {
				echo "- <i><a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"javascript:poptastic('php121chat.php?id=$row[0]&type=2','$row[0]');\">" . $userlist . "</a></i><br>";
			}
                } else if ($numtimedouts == $numpeopleinroom && $mostResentping < $now - 119) {
			//DEAD CHAT

			//if global email setting set or anyone wants auto email, then build transcript and send it.
			//get number of people requesting auto emails in this room
			$pssql = "select " . $php121_prefix."_rooms.uname, " . $db_usertable . "." . $dbf_uemail . " from " . $php121_prefix."_rooms, " . $db_usertable . " where " . $php121_prefix."_rooms.roomid = '$row[0]' AND " . $db_usertable.".".$dbf_auto_email_transcript." = '1'";
			$psquery = mysql_query($pssql, $php121db);
			$numemails = mysql_num_rows($psquery);

                        if ($php121_config[auto_email_transcript]) {
                                $sql = "select " . $php121_prefix."_rooms.uname, " . $db_usertable . "." . $dbf_uemail . " from " . $php121_prefix."_rooms, " . $db_usertable . " where " . $php121_prefix."_rooms.roomid = '$row[0]' AND " . $php121_prefix."_rooms.uname = " . $db_usertable . "." . $dbf_uname;
                        } else {
                                //just send it to who wants it
                                $sql = "select " . $php121_prefix."_rooms.uname, " . $db_usertable . "." . $dbf_uemail . " from " . $php121_prefix."_rooms, " . $db_usertable . " where " . $php121_prefix."_rooms.roomid = '$row[0]' AND " . $db_usertable.".".$dbf_auto_email_transcript." = '1' AND " . $php121_prefix."_rooms.uname = " . $db_usertable . "." . $dbf_uname;
                        }

			$result2 = mysql_query($sql, $php121db);
			if ($php121_config[auto_email_transcript] || $numemails>0) {
				//build transcript
				$pstranscript = "";
				$pssql = "SELECT username, servernotice, message FROM " . $php121_prefix . "_messages WHERE roomid = '$row[0]' order by msgid asc";
				$transcriptquery = mysql_query($pssql, $php121db);

				while ( $transcriptrow = mysql_fetch_row($transcriptquery) ) {
					if ($transcriptrow[1] == 0) {
						$pstranscript .= $transcriptrow[0] . ": ";
					}
					$pstranscript .= $transcriptrow[2] . "\n";
				}
				
				while ($psrow = mysql_fetch_row($result2)) {
					//send email
					$from = "noreplymatrimonial.com <$webmaster>";
					$mailto = $psrow[1];
					$pssubject = $psrow[0] . ", " . _HERE_IS_YOUR_CHAT_TRANSCRIPT;
					mail($mailto, $pssubject , stripslashes($pstranscript), "From: $from\nX-Mailer: PHP/" . phpversion());
				}
			}


			//Keep names of people in this room in array
			$sql = "select uname from " . $php121_prefix . "_rooms where roomid = '$row[0]'";
			$psquery = mysql_query($sql, $php121db);
			$roomnames[] = "";
			while ($psrow = mysql_fetch_row($psquery)) {
				$roomnames[] = $psrow[0];
			}

			//delete room/messages
			$sql = "delete from " . $php121_prefix . "_messages where roomid = '$row[0]'";
			mysql_query($sql, $php121db);
			$sql = "delete from " . $php121_prefix . "_rooms where roomid = '$row[0]'";
			mysql_query($sql, $php121db);

			//update contact list for people who were in room

			foreach($roomnames as $value) {
				//force a CL update
				$sql = "update $db_usertable set php121_cl_update_key='0' where $dbf_uname='$value'";
				$result3 = mysql_query($sql, $php121db);
			}

		}
        }

	//Get user ids of people we are blocking and store in an array
	$blockids = "";
	$sqlblock = "select b_block from " . $php121_prefix . "_blocks where b_user='$uid'";
	$queryblock = mysql_query($sqlblock, $php121db);
	if (mysql_num_rows(mysql_query($sqlblock)) > 0) {
		while ($rowblock = mysql_fetch_row($queryblock)) {
			$blockids[] = $rowblock[0];
		}
	} else {
		$blockids[] = Null;
	}

	//select any users that are chatting and display as a long list
	$peopleonline = "";
	$numpeopleonline = 0;

	$userssql = "select $dbf_uname,$dbf_user_chatting,$dbf_uid,$dbf_level from $db_usertable where $now-$dbf_user_chatting<90 order by $dbf_uname asc";
	$usersresult = mysql_query($userssql, $php121db);
	while ($row = mysql_fetch_row($usersresult)) {
		$blockeduser = 0;
		$winid = $row[2] . date("U");
		if (in_array($row[2], $blockids)) {
			$peopleonline .= "<i>";
			$blockeduser = 1;
		}
		
		$psuserlevel = $row[3];

		if ($integration == "phpbb") {
			if ($row[3] > 0) {
				$psuserlevel = 3;
			} else {
				$psuserlevel = 1;
			}
		}

                if ($integration == "phpnuke") {
                        if ($row[3] > 1) {
                                $psuserlevel = 3;
                        } else {
                                $psuserlevel = 1;
                        }
                }

		if ($psuserlevel == 1) {
			$peopleonline .= "- <a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"#\" onClick=\"poptastic('php121sendim.php?to=$row[2]','$winid');\">" . $row[0] . "</a>"; 
		} else if ($psuserlevel == 2) {
			$peopleonline .= "- <a style=\"TEXT-DECORATION: none; COLOR: #339920; FONT-SIZE: 10px\" href=\"#\" onClick=\"poptastic('php121sendim.php?to=$row[2]','$winid');\">" . $row[0] . "</a>";
		} else if ($psuserlevel == 3) {
			$peopleonline .= "- <a style=\"TEXT-DECORATION: none; COLOR: #FF0000; FONT-SIZE: 10px\" href=\"#\" onClick=\"poptastic('php121sendim.php?to=$row[2]','$winid');\">" . $row[0] . "</a>";
		}
		if ($blockeduser == 1) {
			$peopleonline .= "</i>";
		}

		if ($row[2] != $uid) {
			if ($blockeduser == 1) {
				$peopleonline .= "&nbsp;[<a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"php121im.php?blockop=unblock&blockuser=$row[2]\">" . _UNBLOCK . "</a>]";
			} else {
				$peopleonline .= "&nbsp;[<a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"php121im.php?blockop=block&blockuser=$row[2]\">" . _BLOCK . "</a>]";
			}
		}

		$peopleonline .= "<br>";
		$numpeopleonline++; 
	}

	echo "<hr><b>" . _WHOS_ONLINE . " ($numpeopleonline):</b><br>";
	echo $peopleonline;
	echo "</font><br></td></tr>";
	echo $closetable;
}
?>

</font>
</body>
</html>
