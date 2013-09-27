<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121adminemoticonsdelete.php                                  **
 **  Date modified:     07/07/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Allow admins to delete emoticon packs                           **
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
require_once("php121makesmiliesjs.php");

$smilie_pak = $_POST[pak];
if (isadmin($sess_username)) {
?>

<html>
<head>
<title>Matrmonial shaadi  - <?php echo _DELETE_EMOTICONS; ?></title>
</head>
<body>

<?php
echo $opentable;
if ($smilie_pak == "") {
	//get unique list of paks in db
	$sql = "select distinct pack from " . $php121_prefix . "_smilies";
	$result = mysql_query($sql, $php121db);
	while ($row = mysql_fetch_row($result)) {
		$packs[] = $row[0];
	}
?>

<p>
<form name="delpak" method="POST">
<table border="0">
<tr><td>
<font style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px">
PAK <?php echo _FILE; ?>:</font>
</td><td>

<?php
echo "<select name='pak'><option value=''>" . _SELECT_PAK . "</option>";
while (list($key,$value) = @each($packs)) {
	if (!empty($value)) {
		echo "<option value='$value'>" . $value . "</option>";
	}
}
echo "</select><br></td></tr>";
echo _TABLE_BLANK_ROW;
?>

<tr><td colspan="2">
<center>
<input style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px" type="submit" value="<?php echo _DELETE_PAK; ?>">
</center>
</td></tr>
</table>
</form>
<a href="<?php echo $siteurl; ?>php121admin.php"><?php echo _CANCEL; ?></a>

<?php 
} else {
	$sql = "delete from " . $php121_prefix . "_smilies where pack='" . makedbsafe($smilie_pak) . "'";
	mysql_query($sql, $php121db);
	echo _PAK_DELETED . "<p>" . _GO_BACK . " <a href=" . $siteurl . "php121admin.php>" . _ADMIN_OPTIONS . "</a>";
	makesmiliesjs();
}

echo $closetable;
} else { echo _ACCESS_DENIED; die; }

?>

</body>
</html>
