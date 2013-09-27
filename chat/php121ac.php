<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121ac.php							**
 **  Date modified:     03/07/06							**
 **  Copyright:         (C) 2005 Paul Synnott						**
 **  Email:             support@php121.com						**
 **  Web:               http://www.php121.com						**
 **  File function:     Allow admins to edit PHP121 configuration			**
 *****************************************************************************************/

/*****************************************************************************************
 **    This file is part of PHP121.							**
 **											**
 **    PHP121 is free software; you can redistribute it and/or modify			**
 **    it under the terms of the GNU General Public License as published by		**
 **    the Free Software Foundation; either version 2 of the License, or		**
 **    (at your option) any later version.						**
 **											**
 **    PHP121 is distributed in the hope that it will be useful,			**
 **    but WITHOUT ANY WARRANTY; without even the implied warranty of			**
 **    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the			**
 **    GNU General Public License for more details.					**
 **											**
 **    You should have received a copy of the GNU General Public License		**
 **    along with PHP121; if not, write to the Free Software				**
 **    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA	**
 *****************************************************************************************/

require_once("php121.php");
global $php121db, $php121_config;
if (isadmin($sess_username)) {
?>

<html>
<head>
<title>Matrmonial shaadi  - <?php echo _TITLE_EDIT_CONFIGURATION; ?></title>
<script type="text/javascript">
        <!--
        var newwindow;
                                                                                                                            
        function poptastic(url,name) {
                newwindow=window.open(url,name,'height=400, width=400, left=80, top=80, toolbar=no, menubar=no, directories=no, location=no, scrollbars=no, status=no, resizable=yes, fullscreen=no');
                if (window.focus) { newwindow.focus() }
        }
        //-->
</SCRIPT>
</head>

<body>
<?php

echo $opentable;
$save = $_POST[save];
$server_timezone = makedbsafe($_POST[server_timezone]);
$language = makedbsafe($_POST[language]);
$auto_email_transcript = makedbsafe($_POST[auto_email_transcript]);
$user_can_create_account = makedbsafe($_POST[user_can_create_account]);
$user_can_delete_account = makedbsafe($_POST[user_can_delete_account]);

if ($save == 1) {
	if ($acctman == 1) {
		mysql_query("UPDATE php121_config SET config_value='$language' where config_name='default_language'", $php121db);
		mysql_query("UPDATE php121_config SET config_value='$user_can_create_account' where config_name='user_can_create_account'", $php121db);
		mysql_query("UPDATE php121_config SET config_value='$user_can_delete_account' where config_name='user_can_delete_account'", $php121db);
	}
	mysql_query("UPDATE php121_config SET config_value='$auto_email_transcript' where config_name='auto_email_transcript'", $php121db);
	mysql_query("UPDATE php121_config SET config_value='$server_timezone' where config_name='server_timezone'", $php121db);
	//force all user's clients to get the new settings instantly
	mysql_query("UPDATE $db_usertable SET php121_cl_update_key='0'");
	echo _CONFIGURATION_UPDATED . "<p>" . _GO_BACK . " <a href=\"php121admin.php\">" . _ADMIN_OPTIONS . "</a>";
	echo $closetable;
	die;
}

echo _EDIT_CONFIGURATION . " " . _BELOW . ":<br>";
echo "<form name=\"editconfig\" method=\"POST\">
	<table border=\"0\">
	<tr><td>
	<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _SYSTEM_CLOCK_TIMEZONE . ":</font>
	</td><td>
	<select name='server_timezone' style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">";

for ($i = -12; $i < 13; $i++) {
	if ($i == 0) {
		$dummy = "GMT";
	} else {
		if (ereg("-", $i)) {
			$dummy = "GMT $i " . _HOURS;
		} else {
			$dummy = "GMT +$i " . _HOURS;
		}
	}

	if ($php121_config[server_timezone] == $i) {
		echo "<option name=\"server_timezone\" value=\"$i\" selected>$dummy</option>";
	} else {
		echo "<option name=\"server_timezone\" value=\"$i\">$dummy</option>";
	}
}

echo "</select></td></tr>";

echo "<tr><td>
        <font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _FORCE_AUTO_EMAIL_TRANSCRIPT . " <a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"javascript:poptastic('php121autoemailnote.php','autoemailnote');\">" . _IMPORTANT_NOTE . "</a>:</font></td><td>";

if ($php121_config[auto_email_transcript] == 1) {
        echo "<input type=\"radio\" name=\"auto_email_transcript\" value=\"1\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _PON . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"auto_email_transcript\" value=\"0\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _OFF . "</font></option>";
} else {
        echo "<input type=\"radio\" name=\"auto_email_transcript\" value=\"1\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _PON . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"auto_email_transcript\" value=\"0\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _OFF . "</font></option>";
}

if ($acctman==1) {
	echo "<tr><td>
		<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _DEFAULT_LANGUAGE . ":</font></td><td>
		<select name='language' style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">";

	$dir = getcwd() . "/php121language";

	if (!is_dir($dir)) { die("Cant get a list of language files!"); }

	if ($root = opendir($dir)) {
		while ($file = readdir($root)) {
			if ($file == "." || $file == "..") { continue; }
			$lang = strtoupper(substr($file,5,1)) . substr($file,6,strlen($file) - 10);
			if ($php121_config[default_language] == $lang) {
				echo "<option name=\"language\" value=\"$lang\" selected>$lang</option>";
			} else {
				echo "<option name=\"language\" value=\"$lang\">$lang</option>";
			}
		}
	}

	echo "</td></tr>";
	echo "<tr><td>
		<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _USER_CAN_CREATE_ACCOUNT . ":</font></td><td>";

	if ($php121_config[user_can_create_account] == 1) {
		echo "<input type=\"radio\" name=\"user_can_create_account\" value=\"1\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"user_can_create_account\" value=\"0\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
	} else {
		echo "<input type=\"radio\" name=\"user_can_create_account\" value=\"1\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"user_can_create_account\" value=\"0\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
	}

	echo "<tr><td>
		<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _USER_CAN_DELETE_ACCOUNT . ":</font></td><td>";
																    
	if ($php121_config[user_can_delete_account] == 1) {
		echo "<input type=\"radio\" name=\"user_can_delete_account\" value=\"1\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"user_can_delete_account\" value=\"0\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
	} else {
		echo "<input type=\"radio\" name=\"user_can_delete_account\" value=\"1\"><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _YES . "</font>&nbsp;&nbsp;<input type=\"radio\" name=\"user_can_delete_account\" value=\"0\" checked><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _NO . "</font></option>";
	}
}


echo "</td></tr>";


echo _TABLE_BLANK_ROW;
echo "</td></tr><tr><td colspan=\"2\" align=\"center\">
	<input type=\"submit\" value=\"" . _SAVE_CHANGES . "\" style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">
	<input type=\"hidden\" name=\"save\" value=\"1\">
	</td></tr></table>
	</form>";
echo "<a href=\"php121admin.php\">" . _CANCEL . "</a>";
echo $closetable;
die;
?>

</font>
<?php echo $closetable;
} else { echo _ACCESS_DENIED; die; }
?>
</body>
</html>
