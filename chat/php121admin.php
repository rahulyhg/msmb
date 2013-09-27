<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121admin.php  		                                **
 **  Date modified:     22/03/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Admin menu			                                **
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
if (isadmin($sess_username)) {
?>

<html>
<head>
<title>Matrmonial shaadi  - <?php echo _ADMIN_OPTIONS; ?></title>
</head>
<body>

<?php
echo $opentable;
echo "<b>" . _CONFIGURATION . "</b><br>
<a href=\"php121ac.php\">" . _EDIT_SYSTEM_CONFIG . "</a><br>
<p>
<b>" . _USER_ADMIN . "</b><br>
<a href=\"php121adminadduser.php\">" . _ADD_USER . "</a><br>
<a href=\"php121adminedituser.php\">" . _EDIT_USER . "</a><br>";

if ($acctman == 1) {
	echo "<a href=\"php121admindeluser.php\">" . _DELETE_USER . "</a><br>";
}

echo "<p>
<b>" . _EMOTICONS . "</b><br>
<a href=\"php121adminemoticonsadd.php\">" . _ADD_EMOTICONS . "</a><br>
<a href=\"php121adminemoticonsdelete.php\">" . _DELETE_EMOTICONS . "</a><br>
<p>
<a href=\"javascript:window.close();\">" . _CANCEL . "</a>
<br>
</font>";

echo $closetable;
} else { echo _ACCESS_DENIED; die; }
?>

</body>
</html>
