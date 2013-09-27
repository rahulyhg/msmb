<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
$linkid = db_connect();

$arg="sent_express_interest";
isAdmin($arg);

$message = GetSingleRecord("tbl_express_interest_message","id",1);	
if ($_REQUEST['Mode'] == "Save"){	
	$upsql = "update tbl_express_interest_message set message = '".$_REQUEST['Message']."' where id = '1'";
	mysql_query($upsql);
	//echo mysql_error();
	//if (mysql_affected_rows() == 1){		
		$_SESSION['Msg'] = "Express Interest Message Changed Successfully";
	//}
	header("Location:update_express_interest.php");
	die();
}
$message = GetSingleRecord("tbl_express_interest_message","id",1);
?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript">
function fnValidate(){
  	if(isNull(document.thisForm.Message," Express Interest Message")) return false;	
}
</script>
</head>
<body>
<!--Start : Main Table-->
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%" align="center">
<tr><td width="100%" height="20" colspan="3" align="center"><img src="images/spacer.gif" border="0" height="20"></td></tr>
<tr>
	<td width="20" height="100%"><img src="images/spacer.gif" border="0" width="20"></td>
	<td width="100%" height="100%" valign="top">
		<table cellpadding="0" cellspacing="0" border="1" width="100%" height="100%" class="tmain" bordercolor="#000000" style="border:thin;">
		<tr>
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
						<td align="right" class="session"><? echo $_SESSION['Msg'];$_SESSION['Msg']=''?></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Title -->
				<tr><td><img src="images/spacer.gif" border="0" width="1" height="1"></td></tr>
				<!-- Start : Sub Title -->
				<tr class="subtitlebg"><td>
					<table cellpadding="0" cellspacing="0" border="0" width="98%" height="22" align="center">
					<tr>
						<td class="subtitle">Update Express Interest Message</td>
						<td align="right">&nbsp;</td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<form name="thisForm" method="post" action="update_express_interest.php?Mode=Save" onSubmit="return fnValidate();">
							<table cellpadding="10" cellspacing="1" border="0" width="400" class="tblBorder" align="center">
								<tr class="tblHead"><td align="center"><b>Update Express Interest Message</b></td></tr>
								<tr class="tblContent"><td>
									<table cellpadding="5" cellspacing="1" border="0" width="600" class="tblBorder">
									<tr bgcolor="#FFFFFF">
										<td valign="top" width="250">Default Express interest message: <font class="session">*</font></td>
										<td>
											<textarea name="Message" class="txtarea" style="width:300px;"><?=$message[message]?></textarea>											
										</td>
									</tr>									
									<tr bgcolor="#FFFFFF">
										<td>&nbsp;</td>
										<td><input type="submit" value="Update" class="butten" style="width:125px;"></td>
									</tr>
									</table>
								</td></tr>
								<tr class="tblContent"><td>Fields marked with <font class="session">* </font> are Mandatory.</td></tr>
							</table>
						
						</form>
					</td></tr>
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