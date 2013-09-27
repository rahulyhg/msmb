<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121language.php                                              **
 **  Date modified:     03/07/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:	Import the correct language file                                **
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

require_once("php121db.php");

global $db_usertable, $dbf_uname, $dbf_language, $php121_config, $integration;

session_start();

if ($integration == "none") {
                                                                                                                            
        if (isset($_COOKIE['php121un']) && isset($_COOKIE['php121pw'])) {
                $logindataun = $_COOKIE['php121un'];
                $logindatapw = $_COOKIE['php121pw'];
                if (!empty($logindataun) && !empty($logindatapw)) {
                        //we have a cookie - use it to login, overriding any sessions
                        $_SESSION[sess_username] = $logindataun;
                        $_SESSION[sess_password] = $logindatapw;
                }
        }

        $sess_username = $_SESSION[sess_username];
        $sess_password = $_SESSION[sess_password];

        //end if integration = none

} else if ($integration == "phpnuke") {
        global $user, $cookie, $db, $anonymous, $sitekey;
        require_once("mainfile.php");
        cookiedecode($user);
        $sess_username = $cookie[1];
        //end if integration is phpnuke
} else if ($integration == "phpbb") {
        define('IN_PHPBB', true);
        $phpbb_root_path = '../';
        include($phpbb_root_path . 'extension.inc');
        require_once($phpbb_root_path . 'common.'.$phpEx);
        $userdata = session_pagestart($user_ip, PAGE_INDEX);
        init_userprefs($userdata);
        $sess_username = $userdata['username'];

}

// are we logged in?
if ($sess_username != "") {
	$sess_username = makedbsafe($sess_username);
	$sess_password = makedbsafe($sess_password);
	// get our language preference
	$sql = "select $dbf_language from $db_usertable where $dbf_uname='$sess_username'";
	$row = mysql_fetch_row(mysql_query($sql));
	if ($row[0] != "") {
		$langfile = "php121language/lang-" . strtolower($row[0]) . ".php";
	} else {
		if ($php121_config['default_language'] != "") {
			// use the default language file
			$langfile = "php121language/lang-" . strtolower($php121_config['default_language']) . ".php";
		} else {
			// argh!  problems!  just use english!
			$langfile = "php121language/lang-english.php";
		}
	}
} else if ($php121_config['default_language']) {
	// use the default language file
	$langfile = "php121language/lang-" . strtolower($php121_config['default_language']) . ".php";
} else {
	//just use english if there is a major problem
	$langfile = "php121language/lang-english.php";
}

if (file_exists($langfile)) {
	require_once($langfile);
} else {
	//an integration is using a language php121 doesn't have, so use English until the user selects their language
	require_once("php121language/lang-english.php");
}

?>
