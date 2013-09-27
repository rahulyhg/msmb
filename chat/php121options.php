<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121options.php                                               **
 **  Date modified:     30/06/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     User options menu                                               **
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
if ($acctman == 0 || $php121_config[user_can_delete_account] == 0) {
	Header("Location: php121edituser.php");
}
?>

<html>
<head>
<title>Matrmonial shaadi  - <?php echo _ACCOUNT_OPTIONS; ?></title>
</head>
<body>

<?php
echo $opentable;
echo "<a href=\"php121edituser.php\">" . _EDIT_ACCOUNT . "</a><br>";
if($php121_config[user_can_delete_account] == '1') {
	echo "<a href=\"php121deluser.php\">" . _DELETE_ACCOUNT . "</a><br>";
}
?>

<p>
<a href="javascript:window.close();"><?php echo _CANCEL; ?></a>
<br>
</font>

<?php echo $closetable; ?>
</body>
</html>
