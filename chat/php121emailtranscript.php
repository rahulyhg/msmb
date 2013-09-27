<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              php121emailtranscript.php                                       **
 **  Date modified:     29/06/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Email the chat room log to the user				**
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
$roomid = (int) makedbsafe($_GET['roomid']);
$now = time();
$uid = $sess_uid;

$sql = "select $dbf_uemail from $db_usertable where $dbf_uid = '$uid'";
$query = mysql_query($sql,$php121db);
$row = mysql_fetch_row($query);

echo $opentable;

if ($_POST['emailtranscript'] != "") {
	//email the transcript
	$pstranscript = "";
	$sql = "SELECT username, servernotice, message FROM " . $php121_prefix . "_messages WHERE roomid = '$roomid' order by msgid asc";
	$transcriptquery = mysql_query($sql, $php121db);

	while ( $transcriptrow = mysql_fetch_row($transcriptquery) ) {
		if ($transcriptrow[1] == 0) {
			$pstranscript .= $transcriptrow[0] . ": ";
		}
		$pstranscript .= $transcriptrow[2] . "\n";
	}
	$from = "Matrimonial Clone - Top Matrimonial Website Software <$webmaster>";
	$mailto = $row[0];
	$pssubject = $uname . ", here is your " . $customtitle . " chat transcript.";
	mail($mailto, $pssubject , $pstranscript, "From: $from\nX-Mailer: PHP/" . phpversion());
	echo _TRANSCRIPT_EMAILED;

	echo "<br><br><b><a style=\"BACKGROUND: none; COLOR: #000066; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none\" href=\"javascript:window.close()\">" . _CLOSE . "</a></b>";
	echo $closetable;

	die();

}

echo _EMAIL_TRANSCRIPT_CONFIRM;
echo "<center><form method=\"POST\">";
echo "<b>$row[0]</b><br><br>";

//see if the admin has forced all participants of the chat to receive a transscript
if ($php121_config[auto_email_transcript]) {
	echo "<b><font style=\"BACKGROUND: none; COLOR: #000000; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none\">" . _ADMIN_FORCING_EMAIL_TRANSCRIPTS . "</font></b><br>";
	$dupe_email_warning = 1;
}


//see if we are receiving transcripts automatically anyway
$sql = "select $dbf_auto_email_transcript from $db_usertable WHERE $dbf_uid = '$uid'";
$query = mysql_query($sql,$php121db);
$row = mysql_fetch_row($query);
if ($row[0] == '1') {
		echo "<b><font style=\"BACKGROUND: none; COLOR: #000000; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none\">" . _AUTO_EMAIL_TRANSCRIPTS . "</font></b><br>";
	$dupe_email_warning = 1;
}

if ($dupe_email_warning == 1) {
	echo "<b><font style=\"BACKGROUND: none; COLOR: #000000; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none\">" . _DUPE_EMAIL_WARNING . "</font></b><br>";
}

echo "<input type=\"submit\" name=\"emailtranscript\" value=\"OK\" style=\"color : #FFFFFF; font-family:Verdana;	font-size:11px;height: 20px;	border: 1px #FFFFFF solid;background-color:#666666;cursor:hand;text-align:center;vertical-align: top;font-weight:bold;\">";
echo "</form></center>";

echo "<br><b><a style=\"BACKGROUND: none; COLOR: #000066; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none\" href=\"javascript:window.close()\">" . _CLOSE . "</a></b>";

echo $closetable;

?>
