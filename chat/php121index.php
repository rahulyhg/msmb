<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)							**
 **  File:		php121index.php							**
 **  Date modified:	23/03/06							**
 **  Copyright:		(C) 2005 Paul Synnott						**
 **  Email:		support@php121.com						**
 **  Web:		http://www.php121.com						**
 **  File function:	html page with link to PHP121 popup window			**
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
?>

<html>
<head>
<title>Matrmonial shaadi  Standalone</title>
</head>

<body>

<script type="text/javascript">
<!--
var newwindow;

function poptastic(url) {
	newwindow=window.open(url,'name','height=500, width=240, left=20, top=20, toolbar=no, menubar=no, directories=no, location=no, scrollbars=yes, status=no, resizable=yes, fullscreen=no');
	newwindow.focus();
}

poptastic('php121im.php');
//-->
</script>

<font style="FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px">
<b>PHP121 Instant Messenger (Standalone)</b><p>
This is a demonstration page to show how you can load PHP121 from your website.  Check the source code of this page.<p>
JavaScript and popups are required for this messenger to work.  Please check your browser settings if you have problems.
<P>
<a href="javascript:poptastic('php121im.php');">Instant Messenger</a><br>
<iframe src="php121status.php" width="320" height="120" frameborder="0"></iframe>
</font>

</body>
</html>
