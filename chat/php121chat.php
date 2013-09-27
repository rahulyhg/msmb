<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              php121chat.php                                                  **
 **  Date modified:     11/07/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     The chat window                                                 **
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
//if choice is set, then we are the recipient of the request and must create the room
if ($_POST['choice']) { $choice = $_POST['choice']; } else { $choice = $_GET['choice']; }
//id is the request id (r_id)
if ($_POST['id']) { $r_id = makedbsafe($_POST['id']); } else { $r_id = makedbsafe($_GET['id']); }
$type = $_GET['type'];


//set required variables
$now = time();


if ($type==2) {
	//invite
	$sql = "select r_from,r_to from " . $php121_prefix . "_requests where roomid='$r_id'";
} else {
	//normal request
	$sql = "select r_from,r_to from " . $php121_prefix . "_requests where r_id='$r_id'";
}

$result = mysql_query($sql, $php121db);
$allowedin = 0;
while (($requestrow = mysql_fetch_row($result)) && $allowedin == 0) {
	if ($sess_uid == $requestrow[0] || $sess_uid == $requestrow[1]) {
		$allowedin = 1;
	}
}

if ($allowedin == 0) {
	echo $opentable;
	echo _ERROR . _ACCESS_DENIED;
	echo "<p><b><a style=\"BACKGROUND: none; COLOR: #000066; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none\" href=\"javascript:window.close()\">" . _CLOSE . "</a></b>";
	echo $closetable;
	die;
}

if ($choice == "yes") {
	//we are the recipient (to)
	$us = "to";
	$to_username = $sess_username;
	$to_userid = $sess_uid;
        $from_userid = $requestrow[0];
	$sql = "select $dbf_uname from $db_usertable where $dbf_uid='$from_userid'";
	$result = mysql_query($sql, $php121db);
	$row = mysql_fetch_row($result);
        $from_username = $row[0];
} else {
	//we are the requestor (from)
	$us = "from";
        $from_username = $sess_username;
        $from_userid = $sess_uid;
        $to_userid = $requestrow[1];
        $sql = "select $dbf_uname from $db_usertable where $dbf_uid='$to_userid'";
        $result = mysql_query($sql, $php121db);
        $row = mysql_fetch_row($result);
        $to_username = $row[0];
}

//determine if we need to initialise the chat or simply just join, or even just do nothing
$sql = "select lastping,timedout from " . $php121_prefix . "_rooms where roomid = '$r_id' and uname = '$sess_username'";
$result = mysql_query($sql, $php121db);
$row = mysql_fetch_row($result);
if (mysql_num_rows($result) == 0) {
	//create chat session
	$sql = "insert into " . $php121_prefix . "_rooms (roomid, uname, joined, lastping, timedout) values('$r_id','$sess_username','$now','$now','0')";
	$result = mysql_query($sql, $php121db);
														    
	//let requester know they've been accepted
	if ($us == "to") {
		if ($type==2) {
			//invite
			$sql = "update " . $php121_prefix . "_requests set r_result='1' where roomid='$r_id'";
		} else {
			//normal request
			$sql = "update " . $php121_prefix . "_requests set r_result='1' where r_id='$r_id'";
		}
		$result = mysql_query($sql, $php121db);
	}
}
														    
//if we had timedout from the chat (lastping over 20 seconds ago) then show a join message
if ($row[0] < $now-20) {
	if ($row[1] > 0) {
		//rejoin message
		$message = $sess_username . " " . _REJOIN_CHAT;
	} else {
		//we just joined, this is not a rejoin
		$message = $sess_username . " " . _JOINED_CHAT;
	}
	
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

?>
<html>
<head>
<title>Chat Window</title>
<script src="php121playsound.js" language="JavaScript" type="text/javascript"></script>
<link href="../includes/Style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript">

	function setCaretToEnd (control) {
		if (control.createTextRange) {
			var range = control.createTextRange();
			range.collapse(false);
			range.select();
		}
		else if (control.setSelectionRange) {
			control.focus();
			var length = control.value.length;
			control.setSelectionRange(length, length);
		}
	} 

	var sendReq = getXmlHttpRequestObject();
	var receiveReq = getXmlHttpRequestObject();
	var lastMessage = 0;
	var mTimer;
	//Function for initializating the page.
	function startChat() {
		showCounter();
		//Set the focus to the Message Box.
		document.getElementById('txt_message').focus();
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
			receiveReq.open("GET", 'php121roomupdate.php?us=<?php echo $us; ?>&type=<?php echo $type; ?>&r_id=<?php echo $r_id; ?>&last=' + lastMessage + 'unique=' + unixtimeps, true);
			receiveReq.onreadystatechange = handleReceiveChat;
			receiveReq.send(null);
		}
	}
	//Add a message to the chat server.
	function sendChatText() {
		var msgtosend = document.getElementById('txt_message').value.substr(0,1000);
		msgtosend = msgtosend.replace(/<\S[^><]*>/g, "");
		msgtosend = dosmiles(msgtosend);
		if(msgtosend == '') {
			document.getElementById('txt_message').value = '';
			alert("<?php echo _NO_MESSAGE; ?>");
			return;
		}
		if (sendReq.readyState == 4 || sendReq.readyState == 0) {
			document.getElementById('div_chat').innerHTML += "<font color=\"red\"><?php echo $sess_username;?></font><font color=\"black\" font>&gt;&nbsp;</font>" + msgtosend + "<br>";
			sendReq.open("POST", 'php121roomupdate.php?r_id=<?php echo $r_id; ?>&name=<?php echo $sess_username; ?>&last=' + lastMessage, true);
			sendReq.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			sendReq.onreadystatechange = handleSendChat;
			var param = 'message=' + document.getElementById('txt_message').value.substr(0,1000);
			param += '&name=<?php echo $sess_username; ?>';
			param += '&r_id=<?php echo $r_id; ?>';
			sendReq.send(param);
			document.getElementById('txt_message').value = '';
			showCounter();
			document.getElementById('div_chat').scrollTop = document.getElementById('div_chat').scrollHeight;
		}
	}

	//When our message has been sent, update our page.
	function handleSendChat() {
		//Clear out the existing timer so we don't have
		//multiple timer instances running.
		clearInterval(mTimer);
		getChatText();
	}
	//Function for handling the return of chat text
	function handleReceiveChat() {
		var newmsg=0;
		if (receiveReq.readyState == 4) {
			var chat_div = document.getElementById('div_chat');
			var xmldoc = receiveReq.responseXML;
			var message_nodes = xmldoc.getElementsByTagName("message");
			var n_messages = message_nodes.length
			for (i = 0; i < n_messages; i++) {
				newmsg=1;
				var user_node = message_nodes[i].getElementsByTagName("user");
				var notice_node = message_nodes[i].getElementsByTagName("notice");
				var text_node = message_nodes[i].getElementsByTagName("text");
				var time_node = message_nodes[i].getElementsByTagName("time");
				var userlist_node = message_nodes[i].getElementsByTagName("userlist");
				<?php
				if ($timestamp == 1) {
					$timediff = $timezone - $server_timezone; ?>
					var theDate = new Date(time_node[0].firstChild.nodeValue*1000);
					var myHour = theDate.getHours();
					var myMinute = theDate.getMinutes();
					var mySecond = theDate.getSeconds();
					if (myHour < 10 && myHour >= 0) { myHour = "0" + myHour; }
					if (myMinute < 10 && myMinute >= 0) { myMinute = "0" + myMinute; }
					if (mySecond < 10 && mySecond >= 0) { mySecond = "0" + mySecond; }
					chat_div.innerHTML += '<font color="black">' + myHour + ':' + myMinute + ':' + mySecond + '</font>&nbsp;&nbsp;';
				<?php } ?>
				if (notice_node[0].firstChild.nodeValue == 1) {
					//join
					chat_div.innerHTML += '<font color="green">' + text_node[0].firstChild.nodeValue + '</font><br />';
				} else if (notice_node[0].firstChild.nodeValue == 2) {
					//part
					chat_div.innerHTML += '<font color="purple">' + text_node[0].firstChild.nodeValue + '</font><br />';
				} else if (notice_node[0].firstChild.nodeValue == 3) {
					//rejoin
					chat_div.innerHTML += '<font color="green">' + text_node[0].firstChild.nodeValue + '</font><br />';
				} else {
					//normal chat
					if (user_node[0].firstChild.nodeValue == "<?php echo $sess_username;?>") {
						chat_div.innerHTML += '<font color="red">' + user_node[0].firstChild.nodeValue + '</font>:&nbsp;';
						chat_div.innerHTML += text_node[0].firstChild.nodeValue + '<br />';
					} else if (user_node[0].firstChild.nodeValue != "<?php echo $sess_username;?>") {
						chat_div.innerHTML += '<font color="blue">' + user_node[0].firstChild.nodeValue + '</font>:&nbsp;';
                                                chat_div.innerHTML += text_node[0].firstChild.nodeValue + '<br />';
					}
				}
				chat_div.scrollTop = chat_div.scrollHeight;
				lastMessage = (message_nodes[i].getAttribute('id'));
				<?php                                   
				//show people currently in the room
				$sql = "select uname from " . $php121_prefix . "_rooms where roomid='$r_id' and timedout='0'";
				$result = mysql_query($sql, $php121db);
				while ($row = mysql_fetch_row($result)) {
					$userlist .= $row[0] . ", ";
				}       
				$userlist = substr($userlist,0,strlen($userlist)-2);
				?>
				var users_div = document.getElementById('div_users');
				var userlist = userlist_node[0].firstChild.nodeValue;
				userlist = userlist.replace(/,/g,'<hr>');
				userlist = userlist.replace(/\*\*\*IMG\*\*\*/g,'&nbsp;<img src="php121inchat.png">&nbsp;&nbsp;');
				users_div.innerHTML = userlist;
			}
			if (newmsg == 1) {
				//if the user wants the window focused on a new message, do it
				<?php if ($focus_newmsg == 1) { ?>
					window.focus();
				<?php } ?>

				<?php if ($beep_newmsg == 1) { ?>
					playsound("php121beep.wav");
				<?php } ?>
				setTimeout('document.frmmain.txt_message.focus(); setCaretToEnd(document.getElementById(\'txt_message\'));',10);
			}
			mTimer = setTimeout('getChatText();',2000); //Refresh our chat in 2 seconds
		}
	}
	//This functions handles when the user presses enter.  Instead of submitting the form, we
	//send a new message to the server and return false.
	function blockSubmit() {
		sendChatText();
		return false;
	}

	function showCounter() {
		txt_length = document.getElementById('txt_message').value.length;
		chars_left = 1000 - txt_length; 
		if (chars_left <= 0) { chars_left = "<font color=\"red\"><b>0</b></font>"; }
		document.getElementById('counter').innerHTML = chars_left + " <?php echo _CHARS_LEFT ;?>";
	}

	function clearChat() {
		document.getElementById('div_chat').innerHTML = '';
		document.getElementById('div_chat').scrollTop = 0;
	}
</script>

<?php
if (file_exists("php121smilies.js")) {
	echo "<script language=\"JavaScript\" type=\"text/javascript\" src=\"php121smilies.js\"></script>";
} else {
	require_once("php121makesmiliesjs.php");
	makesmiliesjs();
}
?>

</head>

<body onLoad="javascript:startChat();">
<div id="div_sound" style="height: 0px; width: 0px; position:absolute; top:-1000px;"></div>
<div id="icon" style="position: absolute; top:5px; left: 5px; height: 60px; width: 60px;">
<img border="0" src="../images/logo.jpg" align="left">
</div>

<div id="options" style="position: absolute; top:5px; left: 65px; height: 20px; width: 500px;">
<font style="COLOR: #000066; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none">
[<a style="BACKGROUND: none; COLOR: #000066; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none" href="#" ONCLICK="javascript:window.open('php121sendinvite.php?roomid=<?php echo $r_id; ?>','invite','width=400,height=200,left=60,top=60,toolbar=no,menubar=no,directories=no,location=no,scrollbars=yes,status=no,resizable=yes,fullscreen=no')"><?php echo _INVITE_THIS_CHAT; ?></a>]&nbsp;&nbsp;[<a style="BACKGROUND: none; COLOR: #000066; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none" href="#" ONCLICK="javascript:window.open('php121emailtranscript.php?roomid=<?php echo $r_id; ?>','emailtranscript','width=400,height=400,left=60,top=60,toolbar=no,menubar=no,directories=no,location=no,scrollbars=yes,status=no,resizable=yes,fullscreen=no')"><?php echo _EMAIL_TRANSCRIPT; ?></a>]&nbsp;&nbsp;[<a style="BACKGROUND: none; COLOR: #000066; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none" href="#" ONCLICK="javascript:clearChat();"><?php echo _CLEAR_CHAT; ?></a>]
</font>
</div>
</p>
<br>
<div id="div_chat" style="height: 390px; width: 580px; position: absolute; top: 60px; left: 5px; overflow: auto; padding-top: 5px; background-color: #FFFFFF; border: 1px solid #ffbcb; font-family:verdana; font-size:12px;">
</div>
<div id="div_users" style="height: 390px; width: 155px; position: absolute; top: 60px; left: 584px; overflow: auto; padding-top: 5px; background-color: #FFFFFF; border: 1px solid #ffb700; font-family:verdana; font-size:12px;">
</div>
<div id="counter" style="height: 20px; width: 200px; position: absolute; top: 500px; left: 590px; overflow: none; COLOR: #000000; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none;">
</div>
<table border="0" class="tblContent" height="450">
<tr height="405">&nbsp;<td>
</td></tr>
<tr><td> <br/>
<form id="frmmain" name="frmmain" onSubmit="return blockSubmit();">
	<textarea onKeyPress="if (event.keyCode == 13) {return blockSubmit();}" onKeyUp="showCounter();" cols="70" rows="3" name="txt_message" id="txt_message" maxlength="500" class="txtarea" style="FONT-SIZE: 12px; FONT-FAMILY: Arial; TEXT-DECORATION: none; width: 560px; overflow: auto;"></textarea> 
<a style="BACKGROUND: none; COLOR: #000066; FONT-SIZE: 12px; FONT-FAMILY: Arial; TEXT-DECORATION: none" href="#" ONCLICK="javascript:window.open('php121emoticons.php','emoticons','width=600,height=500,left=60,top=60,toolbar=no,menubar=no,directories=no,location=no,scrollbars=yes,status=no,resizable=yes,fullscreen=no')"><img src="php121emoticons.gif" border=0 style="position: absolute; left: 590px; top: 460px;"></a>
	<input type="button" name="btn_send_chat" id="btn_send_chat" value="<?php echo _SEND; ?>" onClick="javascript:sendChatText();" style="position: absolute; left: 610px; top: 460px;"/ class="butten">
</form>

</td></tr>
</table>
</body>
</html>
