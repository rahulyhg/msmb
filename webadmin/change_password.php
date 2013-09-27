<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
$linkid = db_connect();

$arg="";
isAdmin($arg);

if ($_REQUEST['Mode'] == "Save"){

	$sql="Select * from tbl_admin where admin_loginname='".$_SESSION['_user']."' and admin_password ='".$_REQUEST['txtOldPassword']."'";
	$res=mysql_query($sql);
	echo mysql_error();
	$row=mysql_fetch_object($res);
	$upsql = "update tbl_admin set admin_password ='".$_REQUEST['txtNewPassword']."' where admin_password='".$_REQUEST['txtOldPassword']."'";
	mysql_query($upsql);
	echo mysql_error();
	if (mysql_affected_rows() == 1){
		$_SESSION['_user']=$_SESSION['_user'];
		$_SESSION['_pass']=strtolower($_REQUEST['txtNewPassword']);
		$_SESSION['Msg'] = "Your Password has been Changed Successfully";
	}else{
		$_SESSION['Msg']="Old Password does not match";
	}
	header("Location:change_password.php");
	die();
}
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
  	if(isNull(document.thisForm.txtOldPassword,"old password")) return false;
	if(fnChkAlphaNum(document.thisForm.txtOldPassword,"old password")) return false;
	if(isNull(document.thisForm.txtNewPassword,"new password")) return false;
    if(isLen(document.thisForm.txtNewPassword,6,"New password")) return false;
	if(Trim(document.thisForm.txtOldPassword.value)==Trim(document.thisForm.txtNewPassword.value))
	{
		alert("Both old and new password are same");
		document.thisForm.txtNewPassword.value="";
		document.thisForm.txtNewPassword.focus();
		return false;
	}	
	if(fnChkAlphaNum(document.thisForm.txtNewPassword,"New password")) return false;
	if(isNull(document.thisForm.txtConfirmPassword,"confirm password")) return false;
  	if(isNotSame(document.thisForm.txtNewPassword,document.thisForm.txtConfirmPassword,"new password","confirm password")) return false;
 	if(isSame(document.thisForm.txtNewPassword,document.thisForm.txtOldPassword,"new password","old password")) return false;
}
</script>
</head>
<body onLoad="javascript:document.thisForm.txtOldPassword.focus();">
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
						<td class="subtitle">Change Password</td>
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
						<form name="thisForm" method="post" action="change_password.php?Mode=Save" onSubmit="return fnValidate();">
							<table cellpadding="10" cellspacing="1" border="0" width="400" class="tblBorder" align="center">
								<tr class="tblHead"><td align="center"><b>Change Password</b></td></tr>
								<tr class="tblContent"><td>
									<table cellpadding="5" cellspacing="1" border="0" width="400" class="tblBorder">
									<tr bgcolor="#FFFFFF">
										<td>Old Password <font class="session">*</font></td>
										<td><input type=password name="txtOldPassword" maxlength=15 size=25  class="txtbox" id="Old password"></td>
									</tr>
									<tr bgcolor="#FFFFFF">
										<td>New Password <font class="session">*</font></td>
										<td><input type=password name="txtNewPassword" maxlength=15 size=25 class="txtbox" id="New password"></td>
									</tr>
									<tr bgcolor="#FFFFFF">
										<td>Confirm Password <font class="session">*</font></td>
										<td><input type=password name="txtConfirmPassword" maxlength=15 size=25 class="txtbox" id="Confirm password"></td>
									</tr>
									<tr bgcolor="#FFFFFF">
										<td>&nbsp;</td>
										<td><input type="submit" value="Change Password" class="butten" style="width:125px;"></td>
									</tr>
									</table>
								</td></tr>
								<tr class="tblContent"><td>Fields marked with <font class="session">* </font> are Mandatory.</td></tr>
							</table>
						<script language="JavaScript">document.thisForm.txtOldPassword.focus();</script>
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