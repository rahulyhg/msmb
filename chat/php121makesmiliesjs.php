<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              php121makesmiliesjs.php                                         **
 **  Date modified:     07/06/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Makes smilies.js to allow smilies to appear to the sender of a  **
 **                     message as these appear with javascript, not php		**
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

if ($_GET['recreate']==1) {
	require_once("php121.php");
	makesmiliesjs();
}


function makesmiliesjs() {
	global $php121_prefix, $opentable, $closetable, $php121db;
	$sjsfn = "php121smilies.js";

	//delete an existing smilies.js file
	if (file_exists($sjsfn)) {
		unlink($sjsfn);
	}

	//create smilies.js file
	$sjs = fopen($sjsfn, 'w') or die("Can't make file $sjsfn, check file and directory permissions!");

	fwrite($sjs, "function dosmiles(msgtosend) {\n");

	$ssql = "Select * from " . $php121_prefix . "_smilies";
	$sresult = mysql_query($ssql, $php121db);

	while($temp = mysql_fetch_array($sresult, MYSQL_BOTH))
	{
		$ssresult[] = $temp;
	}
															    
	$smilies = $ssresult;
	if (count($smilies)) {
		usort($smilies, 'smiley_sort');
	}

	for ($i = 0; $i < count($smilies); $i++)
	{
		$code = $smilies[$i]['code'];
		fwrite($sjs, "msgtosend = msgtosend.replace(/".preg_quote($smilies[$i]['code'])."/g,\"<img src=\\\"php121smilies/".$smilies[$i]['pack']."/".$smilies[$i]['filename']."\\\">\");\n");
	}
	fwrite($sjs, "return msgtosend;}");

	fclose($sjs);

	if ($_GET['recreate']==1) {
		echo $opentable;
		echo "Javascript recreated OK!<p>";
		echo "<b><a style=\"BACKGROUND: none; COLOR: #000066; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none\" href=\"javascript:window.close()\">" . _CLOSE . "</a></b>";
		echo $closetable;
	}
}

function smiley_sort($a, $b)
{
        if ( strlen($a['code']) == strlen($b['code']) )
        {
                return 0;
        }
                                                                                                                            
        return ( strlen($a['code']) > strlen($b['code']) ) ? -1 : 1;
}


?>
