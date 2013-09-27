<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121db.php                                                    **
 **  Date modified:     30/06/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Create MySQL Database connection and setup some variables       **
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

$php121ver = "v2.2";
$opentable = "<font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">
<table border=\"1\" width=\"100%\" height=\"100%\" cellpadding=\"5\" style=\"border-collapse: collapse\" bordercolor=\"#000000\"><tr height=\"*\"><td valign=\"top\" bgcolor=\"#B7D26B\"><center><font style=\"FONT-FAMILY: Verdana,Helvetica; COLOR: #000000; FONT-SIZE: 14px; FONT-WEIGHT: bold\"><img border=\"0\" src=\"php121logosm.gif\" align=\"left\">$customtitle</font><br><font style=\"FONT-FAMILY: Verdana,Helvetica; COLOR: #000000; FONT-SIZE: 12px; FONT-WEIGHT: bold\"><b>$title</b><p></font><font style=\"FONT-FAMILY: Verdana,Helvetica; color: #000000; font-size: 12px\"><center><br><br>";

if ($php121dir) {
	if (file_exists($php121dir . "php121config.php")) {
		require_once($php121dir . "php121config.php");
	} else {
		die ("PHP121 configuration file does not exist!  Please read the <a target=\"_blank\" href=\"../docs/php121manual.htm\">MANUAL</a> for installation instructions.");
	}
} else {
	if (file_exists("php121config.php")) {
		require_once("php121config.php");
	} else {
		die ("PHP121 configuration file does not exist!  Please read the <a target=\"_blank\" href=\"../docs/php121manual.htm\">MANUAL</a> for installation instructions.");
	}
}
global $dbhost, $dbuname, $dbpass, $dbname, $title, $customtitle;

$phpver = phpversion();
if ($phpver < '4.1.0') {
        $_GET = $HTTP_GET_VARS;
        $_POST = $HTTP_POST_VARS;
        $_SERVER = $HTTP_SERVER_VARS;
}

$phpver = explode(".", $phpver);
$phpver = "$phpver[0]$phpver[1]";
if ($phpver >= 41) {
        $PHP_SELF = $_SERVER['PHP_SELF'];
}

if (!ini_get("register_globals")) {
        import_request_variables('GPC');
}

$php121db = mysql_connect($dbhost, $dbuname, $dbpass);
if (!$php121db) {
        die("ERROR: Can't connect to the database.  If you just installed PHP121, then edit your php121config.php file and check your database settings.  Otherwise, your database server could be down.");
}

mysql_select_db($dbname, $php121db);

//      **** DO NOT CHANGE THE LINES BELOW !! ****
//      THIS IS A FREE PROGRAM - THE LEAST YOU CAN DO IS KEEP THIS LINK TO ME!  Thanks :)
//      ONLY SUPPORTERS OF PHP121 (People who have donated) MAY CHANGE THESE LINES!!!
//      TO DONATE, GO TO http://www.php121.com/donate.php - THANKYOU!
//$closetable = "</center></font></center></td></tr><tr height=\"20\"><td bgcolor=\"#DFEFF5\" valign=\"top\"><font style=\"color: #000000; font-size: 9px\"><center>Powered by <a target=\"_blank\" style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"http://www.matrimonialclone.com\"><U>AES</U></a>";

if ($integration == "phpnuke") {
	//$closetable .= "<br>(PHPNuke Integration)";
}

if ($integration == "phpbb") {
	//$closetable .= "<br>(phpBB Integration)";
}

//$closetable .= "</center></font></td></tr></table></font>";

//read configuration from php121_config table
$php121_config = array();
$sql = "SELECT * FROM php121_config";
if(!($result = mysql_query($sql))) {
        die("Could not obtain configuration data from database.  If running PHP121 for the first time, did you import the SQL file to your database first?  Please read the README (for first time installs) or UPDATE file (for upgrades) in the docs directory for instructions.");
}

while ($row = mysql_fetch_row($result)) {
        $php121_config[$row[0]] = $row[1];
}

if ($php121_config[server_timezone] == "" || $php121_config[server_timezone] == NULL) {
	$php121_config[server_timezone] = "0";
}

if ($php121_config[default_language] == "" || $php121_config[default_language] == NULL) {
	$php121_config[default_language] = "English";
}

if ($php121_config[auto_email_transcript] == "" || $php121_config[auto_email_transcript] == NULL) {
        $php121_config[auto_email_transcript] = "0";
}

if ($php121_config[user_can_create_account] == "" || $php121_config[user_can_create_account] == NULL) {
        $php121_config[user_can_create_account] = "0";
}

if ($php121_config[user_can_delete_account] == "" || $php121_config[user_can_delete_account] == NULL) {
        $php121_config[user_can_delete_account] = "0";
}

require_once("php121language.php");


function makedbsafe($query) {
        if (get_magic_quotes_gpc()) {
                $query = stripslashes($query);
        }
        $query = mysql_real_escape_string($query);
        return $query;
}

?>
