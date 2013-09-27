<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121emoticons.php                                             **
 **  Date modified:     23/03/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Display all emoticons and allow selected emoticon to be passed  **
 **                     back to the chat window						**
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

?>

<html>
<head>
<title>Matrmonial shaadi  - <?php echo _EMOTICONS; ?></title>
</head>
<body>

<?php
echo $opentable;
$maxcol = 5;
$currow = 1;

$paksql = "select distinct pack from " . $php121_prefix . "_smilies order by pack asc";
$pakquery = mysql_query($paksql, $php121db);

while ($pakrow = mysql_fetch_row($pakquery)) {
	$pak = $pakrow[0];
	echo "<table border=0>";
	echo "<tr><td colspan=" . $maxcol . "><center><b><font style=\"FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px\">" . _EMOTICON_PACK . ": $pak</font></b></center></td></tr>";

	$sql = "select distinct filename,description from " . $php121_prefix . "_smilies where pack='$pak' order by filename asc";
	$query = mysql_query($sql, $php121db);
	$id = 1;
	$totalemoticons = mysql_num_rows($query);

	while ($id <= $totalemoticons) {
		$curcol = 1;
		echo "<tr>";

		while(($curcol <= $maxcol) && ($id <= $totalemoticons)){
			$row = mysql_fetch_row($query);
			$codesql = "select code from " . $php121_prefix . "_smilies where filename='$row[0]' and description='$row[1]'";
			$codequery = mysql_query($codesql, $php121db);
			$coderow = mysql_fetch_row($codequery);
			$code = $coderow[0];

			echo "<td>";
			echo "<a href=\"#\" onclick=\"javascript:opener.document.forms['frmmain'].txt_message.value+=' $code '\"><img border=0 src=\"php121smilies/" . $pak . "/" . $row[0] . "\" alt=\"$row[1]\"></a>";
			echo "</td>";
			$curcol++;
			$id++;
		}

		echo "</tr>";
	}

	echo "</table>";
	echo "<p>";
}
?>

<p>
<a href="javascript:window.close();"><?php echo _CLOSE; ?></a>
<BR>
</font>

<?php echo $closetable; ?>

</body>
</html>
