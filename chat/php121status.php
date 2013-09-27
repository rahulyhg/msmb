<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121status.php						**
 **  Date modified:     05/07/06                                                        **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Show PHP121 status on any page					**
 **  			To use, paste the ** lines below into your main webpage		**
 **			WARNING!!!! - You need to edit the path to php121db.php on the 	**
 **			first line of code below if it is not in the same directory as 	**
 **			THIS FILE!!!!			 				**
			
			Paste the line below into your HTML main webpage
			** Remember to change the path if required!! ** 			
			<iframe src="php121status.php" width="320" height="120" frameborder="0"></iframe>
			
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
?>
<script type="text/javascript">
        <!--
        var newwindow;
        function poptastic(url) {
		newwindow=window.open(url,'name','height=500, width=240, left=20, top=20, toolbar=no, menubar=no, directories=no, location=no, scrollbars=yes, status=no, resizable=yes, fullscreen=no');
		newwindow.focus();
	}
	//-->
</script>

<?php
$openbutton = "
<table border=\"1\" width=\"300\" height=\"25\" cellpadding=\"5\" style=\"border-collapse: collapse\" bordercolor=\"#000000\">
	<tr>
		<td valign=\"MIDDLE\" bgcolor=\"#B7D26B\">
			<center><img border=\"0\" src=\"php121logosm.gif\" align=\"left\"></center>
		</td>
		<td valign=\"top\" bgcolor=\"#B7D26B\">
			<center>
			<font style=\"FONT-FAMILY: Verdana,Helvetica; color: #000000; font-size: 12px\">";

//DO NOT REMOVE THE LINK TO MY WEBSITE
//THIS IS FREE SOFTWARE - THE LEAST YOU CAN DO IS KEEP THIS LINK BACK TO ME
//REMOVING THIS LINE IS A VIOLATION OF THIS APPLICATION'S LICENSE

$closebutton = "
			</font>
			<!--<font style=\"color: #000000; font-size: 8px\">
				<br><br>
				<a target=\"_blank\" style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 10px\" href=\"http://bestmatrimonial.thecreativeit.com\">(Powered by AES)</a>
			</font>-->
			</center>
		</td>
	</tr>
</table>";

echo $openbutton;
$now = time();
$numpeopleonline = 0;
                                                                                                                            
$userssql = "select $dbf_uname from $db_usertable where $now-$dbf_user_chatting<90";
$usersresult = mysql_query($userssql, $php121db);
while ($row = mysql_fetch_row($usersresult)) {
	$numpeopleonline++;
}

echo _HPBUTTON_CHAT_NOW . "<font style=\"TEXT-DECORATION: none; COLOR: #000000; FONT-SIZE: 18px\"><b>" . $numpeopleonline . "</b></font>";
echo "<br><a style=\"TEXT-DECORATION: none; COLOR: #000066; FONT-SIZE: 14px\" href=\"javascript:poptastic('php121im.php')\"><b><u>" . _HPBUTTON_OPEN_MESSENGER . "</u></b></a>";

echo $closebutton;
?>
