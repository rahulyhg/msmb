<?php
ob_start();
session_start();
include("includes/lib.php");
$action1 = GetVar("action1");

//Checking for member login.
if ($action1 == "login") {	

	MemberLogin($_POST);
	
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/login.css" type="text/css" rel="stylesheet"/>
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

function validate(f1) {	
	if (isNull(f1.username, "User Id / Email Address")) { return false; }
	var str = f1.username.value;
	var email=0;
	str = str.split('@');
	var str;
	len = str.length;
	if (len > 1) { email = 1; }
	if (email == 1)	{
		if (notEmail(f1.username,"Email Address")) { return false; }	
	}
	if (isNull(f1.password, "Password")) { return false; }
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
		<td colspan="2" valign="top">
			<table width="98%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
			  	<td valign="top"><? include("includes/side_menu.php"); ?></td>		
			  </tr>				  
			</table>
		</td>
		<td valign="top">
			<div style="padding:12px 38px 0px 0px;  float:right;">
			<table border="0" cellspacing="0" cellpadding="0">
			<? if ($_SESSION['_msg']) {?>					
			<? } ?>
			  <tr>
				<td>
					<table border="0" width="560" cellspacing="0" cellpadding="0" style="padding-top:5px;" class="loginbg">
					  <tr>
						<td width="223" style="padding:40px 0px 30px 10px;">
							
							<table border="0" cellspacing="0" align="right"  cellpadding="0">
								<tr>
									<td colspan="2"><div style="float:left; color:#ba3501; font-weight:bold;"><? if($_SESSION['_msg']!=""){?> <font class="idclr">
									<? //=$_SESSION['_msg']; $_SESSION['_msg']="";?></font>&nbsp;&nbsp;<? }?></div></td>
								</tr>
								<tr>
								  <td height="25" colspan="2"><h5 class="mlogin">If you're a registered member, login below</h5><h5 class="mlogin" style="padding-left:85px;">Member Login</h5></td>
							    </tr>
								<!--<tr>
								  <td height="25" colspan="2" style="padding-left:85px;"><h5 class="mlogin">Member Login</h5></td>
							    </tr>-->
								<form name="thisForm" action="member_login.php" method="post" onSubmit="return validate(this);">								
								<input type="hidden" name="action1" value="login">								
								<input type="hidden" name="action" value="<?=GetVar("action")?>">
								<input type="hidden" name="mode" value="<?=GetVar("mode")?>">
								<input type="hidden" name="packid" value="<?=GetVar("packid")?>">
								<input type="hidden" name="id" value="<?=GetVar("id")?>">								
								<input type="hidden" name="link1" value="<?=GetVar("link1")?>">								
								<tr>
								  <td width="83" class="inlog"><strong>ID / E-mail</strong>&nbsp;</td>
								  <td width="161" height="30" class="select"><input type="text" name="username" class="loginbox"></td></tr>
								<tr>
								  <td class="select"><strong>Password</strong></td>
								  <td height="35" class="inlog"><input type="password" name="password" class="loginbox"></td></tr>
								 <tr>
								   <td height="35" colspan="2"><img src="images/login_bull.jpg" border="0" align="absmiddle" />&nbsp;&nbsp;&nbsp;<a href="member_forgot_password.php" class="forgot">Forgot Password?</a>&nbsp;<input name="Submit" type="submit" value="Login" class="button"></td>
							     </tr>
								 <tr>
								   <td  height="20" colspan="2"><img src="images/login_bull.jpg" border="0" align="absmiddle"/>&nbsp;&nbsp;&nbsp;<a href="register.php<? if($_REQUEST['package_id']!=""){ echo "?package_id=".$_REQUEST['package_id']; } ?>" class="forgot">New user?</a>&nbsp;</td>
							      </tr>
								</form> 
							</table>						
						</td>
					   <td valign="top" align="left">
								<div  style="padding:8px 0px 0px 0px;">
								<table  border="0" cellspacing="0" cellpadding="0" class="upgnow" height="222">
									<tr>
									<td valign="top" width="466" style="padding:0px 0px 20px 10px;">
										<h4 class="htitle"><b>Not a member?</b> <a href="register.php<? if($_REQUEST['package_id']!=""){ echo "?package_id=".$_REQUEST['package_id']; } ?>" class="forgot">Join Now !</a><br><br></h4> 
										<p class="benfits"><img src="images/img_btn_left.jpg" align="absmiddle">&nbsp;&nbsp;Contact profiles</p>
										<p class="benfits"><img src="images/img_btn_left.jpg" align="absmiddle">&nbsp;&nbsp;Upload your photos</p>
										<p class="benfits"><img src="images/img_btn_left.jpg" align="absmiddle">&nbsp;&nbsp;Get Express Interest</p>
										<p class="benfits"><img src="images/img_btn_left.jpg" align="absmiddle">&nbsp;&nbsp;View profile - Free</p>
										<p class="benfits"><img src="images/img_btn_left.jpg" align="absmiddle">&nbsp;&nbsp;Forward profile</p>
										<p class="benfits"><img src="images/img_btn_left.jpg" align="absmiddle">&nbsp;&nbsp;Get match alerts</p>
<!--										<p class="benfits"><img src="images/member_bull.jpg" hspace="5" border="0" align="absmiddle"/><a href="register.php" class="member" style="cursor:pointer">Register Free</a></font><br><br></p>										  
-->									<p class="benfits" align="left" style="font-family:Arial; font-size:14px; padding-left:10px; color:#ae1212;"><strong>Upgrade Membership</strong><br></p>
									</td>
								  </tr>
								</table>
								</div>
						 </td>
					  </tr>
					  <tr><td align="center" colspan="2"><div style="float:left"><? fnBannerImage1('member_login','bottem')  ?></div><div style="float:right;"><? fnBannerImage1('member_login','bottem')  ?></div></td></tr>
					 </table>
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
  	<? 
		  		//include("includes/community_search.php");
		  		include("includes/fotter.php") ?>
  </td>
  </tr>
</table>
<div>
</body>
</html>

<?
if($_SESSION['_msg']!="")
{ ?>
	<script language="javascript">
		alert("Invalid UserName or Password");
	</script>
<?	$_SESSION['_msg']="";
} 
?>

