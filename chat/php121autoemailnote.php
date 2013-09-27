<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:              php121autoemailnote.php						**
 **  Date modified:     05/07/06							**
 **  Copyright:         (C) 2005 Paul Synnott						**
 **  Email:             support@php121.com						**
 **  Web:               http://www.php121.com						**
 **  File function:     Provides important information about the auto email transcript	**
 **  			feature								**
 *****************************************************************************************/

/*****************************************************************************************
 **    This file is part of PHP121.							**
 **											**
 **    PHP121 is free software; you can redistribute it and/or modify			**
 **    it under the terms of the GNU General Public License as published by		**
 **    the Free Software Foundation; either version 2 of the License, or		**
 **    (at your option) any later version.						**
 **											**
 **    PHP121 is distributed in the hope that it will be useful,			**
 **    but WITHOUT ANY WARRANTY; without even the implied warranty of			**
 **    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the			**
 **    GNU General Public License for more details.					**
 **											**
 **    You should have received a copy of the GNU General Public License		**
 **    along with PHP121; if not, write to the Free Software				**
 **    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA	**
 *****************************************************************************************/

require_once("php121.php");
if (isadmin($sess_username)) {
?>

<html>
<head>
<title>Matrmonial shaadi </title>
</head>
<body>
<?php

echo $opentable;
?>
<?php 
echo _AUTO_EMAIL_NOTE;
echo "<p><b><a style=\"BACKGROUND: none; COLOR: #000066; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none\" href=\"javascript:window.close()\">" . _CLOSE . "</a></b>";
echo $closetable;
} else { echo _ACCESS_DENIED; die; }
?>
</font>
</body>
</html>
