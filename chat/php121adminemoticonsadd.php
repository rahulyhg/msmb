<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121adminemoticonsadd.php                                     **
 **  Date modified:     07/07/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Allow admins to add emoticon packs                              **
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

if (isadmin($sess_username)) {
$smilie_pak = $_POST[packname];
?>

<html>
<head>
<title>Matrmonial shaadi  - <?php echo _ADD_EMOTICONS; ?></title>
</head>
<body>

<?php
echo $opentable;
if ($smilie_pak == "") {
	echo _ADD_EMOTICON_INSTRUCTIONS;
?>
	<p>
	<form name="addpak" method="POST">
	<table border="0">
	<tr><td>
	<font style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px">
	PAK <?php echo _FILE; ?>:</font>
	<br>
	<font style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 10px">
	<?php echo _ADD_EMOTICON_SAMPLE; ?> :</font>
	</td><td>
	<input style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px" type="text" maxlength="50" size="20" name="packname">
	</td></tr>
	<tr><td colspan="2">
	<center>
	<input style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px" type="submit" value="<?php echo _ADD_PAK; ?>">
	</center>
	</td></tr>
	</table>
	</form>
	<a href="php121makesmiliesjs.php?recreate=1">Fix smilies</a><br>
	<a href="<?php echo $siteurl; ?>php121admin.php"><?php echo _CANCEL; ?></a>

<?php

} else {
	$delimeter = '=+:';
	$packname = makedbsafe(substr($smilie_pak,0,strpos($smilie_pak,"/")));
                $fcontents = @file('./php121smilies/' . $smilie_pak);
                if (empty($fcontents))
                {
			echo _ERROR . _CANT_READ_PAK . "<P>";
			echo _GO_BACK . " <a href=" . $siteurl . "php121admin.php>" . _ADMIN_OPTIONS . "</a>";
			die();
                }
		$sql = "delete from " . $php121_prefix . "_smilies where pack='$packname'";
		mysql_query($sql, $php121db);
                                                                                                                            
                for ($i = 0; $i < count($fcontents); $i++) {
                        $smile_data = explode($delimeter, trim(addslashes($fcontents[$i])));
                                                                                                                            
                        for ($j = 2; $j < count($smile_data); $j++) {
                                // Replace > and < with the proper html_entities for matching.
                                $smile_data[$j] = str_replace("<", "&lt;", $smile_data[$j]);
                                $smile_data[$j] = str_replace(">", "&gt;", $smile_data[$j]);
                                $k = $smile_data[$j];
				//check for duplicate code - if so, add the pack name to it
				$checksql = "select code from " . $php121_prefix . "_smilies where code='$smile_data[$j]'";
				$checkquery = mysql_query($checksql);
				$checknum = mysql_num_rows($checkquery);
				if ($checknum > 0) {
					$smile_data[$j] = $packname . ":" . $smile_data[$j];
				}
				$sql = "INSERT INTO " . $php121_prefix . "_smilies (code, filename, description, pack)
				VALUES('" . str_replace("\'", "''", $smile_data[$j]) . "', '" . str_replace("\'", "''", $smile_data[0]) . "', '" . str_replace("\'", "''", $smile_data[1]) . "', '$packname')";
				$result = mysql_query($sql, $php121db);
				if (!$result) {
					die(_SMILIES_UPDATE_ERROR);
				}
                        }
                }
		makesmiliesjs();
                echo _SMILIES_ADDED . "<p>" . _GO_BACK . " <a href=" . $siteurl . "php121admin.php>" . _ADMIN_OPTIONS . "</a>";
}

echo $closetable;
} else { echo _ACCESS_DENIED; die; }

?>
</body>
</html>
