<?php
ob_start();
session_start();
include("includes/functions.php");
include("includes/menu.php");
isAdmin($arg);
?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>
</head>
<body>
<!--Start : Main Table-->
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%" align="center">
<tr><td width="100%" height="20" colspan="3" align="center"><img src="images/spacer.gif" border="0" height="20"></td></tr>
<tr>
	<td width="20" height="100%"><img src="images/spacer.gif" border="0" width="20"></td>
	<td width="100%" height="100%" valign="top">
		<table cellpadding="0" cellspacing="0" border="1" width="100%" height="100%" class="tmain" bordercolor="#000000" style="border:thin;">
		<tr><font ></font>
			<td>
				<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
				
				<!-- Start : Header  -->
				<tr><td><script language="JavaScript">fnHeader();</script></td></tr>
				<!-- End : Header  -->
				
				<!-- Start : Menu -->
				<tr><td><script language="JavaScript">fnMenu();</script></td></tr>
				<!-- End : Menu -->
				
				<!-- Start : Title -->
				<tr class="titlebg"><td>
					<table cellpadding="0" cellspacing="0" border="0" width="98%" height="22" align="center">
					<tr>
						<td class="title">Welcome <font class="session"><?=$_SESSION["_user"]?></font></td>
		 			</tr>
					</table>
				</td></tr>
				<!-- End : Title -->
				
				<tr><td><img src="images/spacer.gif" border="0" width="1" height="1"></td></tr>
				
				<!-- Start : Sub Title -->
				<tr class="subtitlebg"><td>
					<table cellpadding="0" cellspacing="0" border="0" width="98%" height="22" align="center">
					<tr>
						<td class="subtitle">Admin Home</td>
				 	</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				<tr><td align="center"><br/><strong><font color="#FF0000"><? echo $_SESSION['_msg'];?></font></strong> <? $_SESSION['_msg']="";?></td></tr>
				
		 		<tr><td width="100%" height="100%" valign="top" class="contentbg" style="padding-top:50px;">
				
				<!-- Start : Table Of Contents -->
				<table cellpadding="3" cellspacing="1" border="0" bgcolor="#CCCCCC" align="center">

					<tr bgcolor="#FFFFFF"><td valign="top">
					<?
						//$data="password";
						//$newstring=chunk_split(base64_encode($data));
						//echo $newstring; 
					?>
					<table cellpadding="2" cellspacing="1" border="0">				
						<tr><td valign="top" align="right"><img src="images/boxarrow.gif" border="0" vspace="8"></td><td>&nbsp;<a href="javascript:poptastic('../chat/php121im.php?uname=<? echo $_SESSION['username'];?>&upass=<? echo $_SESSION['userpass'];?>&from=admin');">Chat with Franchisees</a></td></tr>
						<tr><td valign="top" align="right"><img src="images/boxarrow.gif" border="0" vspace="8"></td><td>&nbsp;<a href="view_members.php"> Manage Members registration</a></td></tr>
						<tr><td valign="top" align="right"><img src="images/boxarrow.gif" border="0" vspace="8"></td><td>&nbsp;<a href="view_packages.php">Manage Packages</a></td></tr>					
						<tr><td valign="top" align="right"><img src="images/boxarrow.gif" border="0" vspace="8"></td><td>&nbsp;<a href="view_successful_stories.php">Manage Successful stories</a></td></tr>
						<tr><td valign="top" align="right"><img src="images/boxarrow.gif" border="0" vspace="8"></td><td>&nbsp;<a href="view_wedding_category.php">Manage Wedding Category</a></td></tr>
 					    <tr><td valign="top" align="right"><img src="images/boxarrow.gif" border="0" vspace="8"></td><td>&nbsp;<a href="view_wedding_directory.php">Manage Wedding Directory</a></td></tr>

						<tr><td valign="top" align="right"><img src="images/boxarrow.gif" border="0" vspace="8"></td><td>&nbsp;<a href="view_franchisee.php">Manage Franchise</a></td></tr>
 						<tr><td valign="top" align="right"><img src="images/boxarrow.gif" border="0" vspace="8"></td><td>&nbsp;<a href="change_password.php">Change Password</a></td></tr>
						<tr><td valign="top" align="right"><img src="images/boxarrow.gif" border="0" vspace="8"></td><td>&nbsp;<a href="logout.php">Logout</a></td></tr>
 						</table>	
					</td>
						<!--<td>
						<table cellpadding="2" cellspacing="1" border="0">							
							<tr><td valign="top" align="right"><img src="images/boxarrow.gif" border="0" vspace="8"></td><td>&nbsp;<a href="add_email.php">Contact Email</a></td></tr>
							<tr><td valign="top" align="right"><img src="images/boxarrow.gif" border="0" vspace="8"></td><td>&nbsp;<a href="change_password.php">Change Password</a></td></tr>
							<tr><td valign="top" align="right"><img src="images/boxarrow.gif" border="0" vspace="8"></td><td>&nbsp;<a href="logout.php">Logout</a></td></tr>
						</table>	
						</td>-->
					</tr>
				</table>
				<!-- End : Table Of Contents -->
				</td></tr>
				</table>
				<br>
			</td>
		</tr>
		</table>
	</td>
	<td width="20" height="100%"><img src="images/spacer.gif" border="0" width="20"></td>
</tr>
<tr><td width="100%" height="20" colspan="3" align="center"><img src="images/spacer.gif" border="0" height="20"></td></tr>
</table>
<!--		End : Main Table		-->
</body>
</html>
