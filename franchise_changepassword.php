<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
isFranchise();

if ($action == "change") {

	$res = Execute("select * from tbl_franchisee where auto_id = '" . $_SESSION['franchisee_id'] . "' and franchisee_password = '" . GetVar("oldpassword") . "'");
	if (mysql_num_rows($res) > 0) {
		$res1 = Execute("update tbl_franchisee set franchisee_password = '" . GetVar("newpassword") . "' where auto_id = '" . $_SESSION['franchisee_id'] . "'");
		$res2 = Execute("update php121_users set upassword = '" . GetVar("newpassword") . "' where uname = '" . $_SESSION['franchise_username'] . "'");
		$_SESSION['msg'] = 'Password changed successfully';
		?>
			<script language="javascript">
				location.href = 'franchise_changepassword.php';
			</script>
		<?		
		die();
	} else {
		$_SESSION['msg'] = 'Invalid Old Password';
		?>		
			<script language="javascript">
				location.href = 'franchise_changepassword.php';
			</script>
		<?
		die();					
	}	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" rel="stylesheet" type="text/css"/>
<link href="includes/payment.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" src="includes/validate.js"></script>
<script language="JavaScript" src="includes/functions.js"></script>	
<script type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

	var newwindow="";
	function poptastic(url){
	newwindow=window.open(url,'name','height=500,width=280,left=20,top=20,toolbar=no,menubar=no,directories=no,location=no,scrollbars=yes,status=no,resizable=yes,fullscreen=no');
	if (window.focus) {newwindow.focus()}
	}
	
	function passwordValidate() {	
		  f1 = document.thisForm; 
		  if (isNull(f1.oldpassword,"old password")) { return false;}
		  if (isLen(f1.oldpassword,6,"old Password")){ return false;}
		  if (isNull(f1.newpassword,"new password")) { return false;}
		  if (isLen(f1.newpassword,6,"new Password")){ return false;}
		  if (f1.oldpassword.value == f1.newpassword.value) {  	 
			 alert("Old password and new password should not be same");
			 return false;
		  }
		  if (isNull(f1.confirmpassword,"confirm password")) { return false;}
		  if (f1.confirmpassword.value != f1.newpassword.value) {
			 alert("New password and Confirm password should be same");
			 return false; 
		  }
		}


	

//-->
</script>
</head>
<body class="homeinbody" onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
<div class="menuleftimg">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
    <td align="right"><? fnBannerImage('  ','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>  
  <tr>
    <td colspan="2" valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td valign="top">
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:12px 0px 0px 0px; float:left;">
			<table width="573" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td valign="top">
					<table width="100%" align="left" cellpadding="0" cellspacing="0" border="0">
						<tr>
						<td>
					<div class="titlebg"><h1 class="title">Change Password</h1>
					</div>
					<!--</td>
					<td align="right" class="title" style="padding-right:85px;">					
						 <? if ($config[userinfo]) { ?>					
					<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
					<? } ?>					
					</td>-->
					</tr></table>
				</td>				
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
					    <td rowspan="4" valign="top">
						<!--<h1 class="title">Member Login</h1>
						<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
						<div style="float:left; padding:10px 0px 0px 10px;">
						<table border="0" width="100%" align="center" cellspacing="0" cellpadding="0" class="regall">						  
						 
						  <tr>
						  	<td valign="top" style="padding-top:35px;">
								<table border="0" cellpadding="0" width="100%" cellspacing="0"  class="reghbtm">								
						 			
									 <form name="thisForm" method="post" onSubmit="return passwordValidate();">
										<input type="hidden" name="action" value="change">
									<tr>
									 	<td colspan="2" align="right" style="padding-right:100px"><b class="clr"><?=$_SESSION['msg']?><? $_SESSION['msg'] = ""; ?> </b></td>
									 </tr>	
									 <tr>
										<td width="300" height="30" style="padding-left:30px;">Enter the old password <font color="#FF0000">&nbsp;</font> </td>
									    <td width="400" height="30"><input type="password" name="oldpassword" class="txtbox" maxlength="255"></td>					
									 </tr>
                                     <tr>
										<td height="30" style="padding-left:30px;">Enter the new password <font color="#FF0000">&nbsp;</font> </td>
										<td height="30"><input type="password" name="newpassword" class="txtbox" maxlength="255"></td>					
									 </tr>
									 <tr>
										<td height="30" style="padding-left:30px;"> Enter the confirm password <font color="#FF0000">&nbsp;</font> </td>
										<td height="30"><input type="password" name="confirmpassword" class="txtbox" maxlength="255"></td>					
									 </tr>									 
									 <tr>  									
									 	 <td height="40"></td><td><input type="submit" value="Submit" class="button"></td>
									 </tr>
								  </form>	                          
									 								
								</table>			
							 </td>								 
						  </tr>							  		  
						</table>
						</div>		
						
					 </td>
					
			  </tr>
			 
			  <tr>
				<td>
					
				</td>
			  </tr>
			</table>
		</div>
		</td>
	  </tr>
	</table>
	</td>
  </tr>
  <tr>
  <td colspan="2">
  	<? include("includes/fotter.php") ?>
  </td>
  </tr>
</table>
<div>
</body>
</html>