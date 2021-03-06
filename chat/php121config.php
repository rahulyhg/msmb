<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121) 							**
 **  File:              php121config.php                                                **
 **  Date modified:     29/06/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     User configuration file (Standalone defaults)			**
 **  			---- EDIT YOUR SETTINGS BELOW THE GNU GPL NOTICE!!! ----	**
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

# dbhost:       SQL Database Hostname
//$dbhost = 	"localhost:9956";
$dbhost = 	"118.139.179.115";

# dbuname:      SQL Username
//$dbuname = 	"newlinda";
$dbuname = 	"maashakti";

# dbpass:       SQL Password
//$dbpass = 	"Rq0p1WeS@!";
$dbpass = 	"Sainath1@";

# dbname:       SQL Database Name
//$dbname = 	"newindia_db";
$dbname = 	"maashakti";

# $php121_prefix:      Your Database table's php121 prefix (Don't change this unless you know what you are doing)
$php121_prefix = "php121";

# $siteurl:	The URL to php121, including the trailing slash e.g. http://www.MYURL.com/php121/
$siteurl = 	"http://www.thecreativeit.com/demourl@/shaadi/";
//$siteurl = 	"http://topmatrimonial.thecreativeit.com/chat/";


# $customtitle:	The title you want to appear at the top of every screen
$customtitle = 	"thecreatieit.com";

# $webmaster:	The email address where your users can contact you
$webmaster = 	"info@thecreativeit.com";

# $integration: Is PHP121 integrated into another application?
# Possible options:  none, phpnuke, phpbb
# Warning!  This changes the behaviour of PHP121 a lot!  Be sure you know what you are doing!
# This setting affects how PHP121 looks at sessions.  You also have to change the database
# options in the "Extra Database Options" section below!
$integration =	"none";

# $acctman: Should PHP121 handle creating new user accounts / deleting accounts etc?
# Usually you only want this if $integration is set to none!
# Warning!  This changes the behaviour of PHP121 a lot!  Be sure you know what you are doing!
# 0 = off; 1 = on.
$acctman = 1;

/*****************************************************************************************
** 				Extra Database Options 					**
** DO NOT CHANGE THESE unless you are wanting to use your existing user database	**
** If you want to use your existing user database (with existing usernames and		**
** passwords, you MUST first alter your database to include the extra PHP121 fields.	**
** To do this, do the following:							**
**											**
**  1.  EDIT sql/alter_existing_usertable.sql and change the name of the table on the 	**
**	first line to be the name of your existing users table.				**
**											**
**  2.  EXECUTE sql/alter_existing_usertable.sql within your existing database		**
**	(You can do this easily with PHPMyAdmin if your host has it, or simply 'source' **
**	it on the mysql console after selecting the appropriate database ('use'))	**
**											**
**  3.	CHANGE the options below to match your user table configuration.		**
**											**
******************************************************************************************/


# db_usertable:				name of the existing user table (e.g. php121_users)
$db_usertable			=	"php121_users";

# dbf_uid:				name of the user id field (e.g. uid)
#					(must be an integer field)
$dbf_uid			=	"uid";

# dbf_uname:				name of the username field (e.g. uname)
$dbf_uname			=	"uname";

# dbf_upassword:			name of the password field (e.g. upassword)
$dbf_upassword			=	"upassword";

# dbf_passwordtype:			password type, either md5 or plaintext
$dbf_passwordtype		=	"plaintext";

# dbf_uemail:				name of the email field (e.g. uemail)
$dbf_uemail			=	"uemail";

# dbf_user_chatting:			name of the php121 user_chatting field	(e.g. php121_user_chatting)
$dbf_user_chatting		=	"php121_user_chatting";

# dbf_smilies:				name of the php121 smilies field (e.g. php121_smilies)
$dbf_smilies			=	"php121_smilies";

# dbf_level:				name of the php121 level field (e.g. php121_level)
$dbf_level			=	"php121_level";

# dbf_showrequest:			name of the php121 showrequest field (e.g. php121_showrequest)
$dbf_showrequest		=	"php121_showrequest";

# dbf_uname_len:			the length of the username field
$dbf_uname_len			=	25;

# dbf_upassword_len:			the length of the password field
$dbf_upassword_len		=	40;

# dbf_uemail_len:			the length of the email field
$dbf_uemail_len			=	255;

# dbf_upassword_input_min_length:	the minimum password length allowed
$dbf_upassword_input_min_length	=	6;

# dbf_upassword_input_max_length:	the maximum password length allowed
$dbf_upassword_input_max_length	=	10;

# dbf_beep_newmsg:			name of the php121 beep on new msg field (e.g. php121_beep_newmsg)
$dbf_beep_newmsg		=	"php121_beep_newmsg";

# dbf_focus_newmsg:                     name of the php121 focus on new msg field (e.g. php121_focus_newmsg)
$dbf_focus_newmsg		=	"php121_focus_newmsg";

# dbf_banned:				name of the php121 user banned field (e.g. php121_banned)
$dbf_banned			=	"php121_banned";

# dbf_timezone:				name of the php121 user timezone field (e.g. php121_timezone)
$dbf_timezone			=	"php121_timezone";

# dbf_timestamp:			name of the php121 user timestamp field (e.g. php121_timestamp)
$dbf_timestamp			=	"php121_timestamp";

# dbf_language:				name of the php121 user language field	(e.g. php121_language)
$dbf_language			=	"php121_language";

# dbf_auto_email_transcript:            name of the php121 auto_email_transcript field  (e.g. php121_auto_email_transcript)
$dbf_auto_email_transcript	=       "php121_auto_email_transcript";

?>
