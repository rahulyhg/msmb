<?php
ob_start();
session_start();
include("includes/lib.php");
include("includes/paging.php");

if($_REQUEST['Mode']=="Login"){

	//$sql_chk="select * from tbl_franchisee where (franchisee_id='".$_REQUEST['txtFranchiseeID']."' or franchisee_email='".$_REQUEST['txtFranchiseeID']."') and franchisee_password='".$_REQUEST['txtPassword']."'";
	$sql_chk="select * from tbl_franchisee where (franchisee_id='".$_REQUEST['txtFranchiseeID']."' or franchisee_email='".$_REQUEST['txtFranchiseeID']."')";
	$res_chk=mysql_query($sql_chk);
	if(mysql_num_rows($res_chk)>0){	
	
		$obj=mysql_fetch_object($res_chk);
		
		if ($obj->franchisee_password == $_REQUEST['txtPassword']) {
		
			$sql_update="update tbl_franchisee set franchisee_login_status='Y' where auto_id=".$obj->auto_id;
			mysql_query($sql_update);
			echo mysql_error();
			$_SESSION['franchisee_email']=$obj->franchisee_email;
			$_SESSION['franchise_name']=$obj->franchisee_name;
			$_SESSION['franchisee_id']=$obj->auto_id;
			$_SESSION['franchisee_reg_id']=$obj->franchisee_id;
			$_SESSION['franchise_username']=$obj->franchisee_username;
			$_SESSION['franchise_password']=$obj->franchisee_password;
			header("Location:franchise_upgrade_member.php");
			die();
			
		} else {
			$_SESSION['_msg']="Invalid Password";
			header("Location:franchise_login.php");
	     	die();			
		}
			
	} else {
		$_SESSION['_msg']="Invalid Username";
		header("Location:franchise_login.php");
     	die();
	}				
}
if($_SESSION['franchisee_id']!="")
	$_SESSION['Msg']="Franchise already log-in";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/franchise.css" type="text/css" rel="stylesheet"/>
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

	function fnLogin(){
		if(isNull(document.franchisee_loginForm.txtFranchiseeID,"Franchise ID/Email address")){return false;}	
		if(isNull(document.franchisee_loginForm.txtPassword,"Password")){return false;}	
	}
//-->
</script>
</head>
<body class="homeinbody" onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
<div class="menuleftimg">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
    <td align="right"><? fnBannerImage(' ','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>  
  <tr>
    <td colspan="2" valign="top">
	<table width="780" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td valign="top">
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:12px 0px 0px 2px; float:left;" >
			<table width="573" border="0" align="left" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<div class="titlebg"><h1 class="title">Franchise Login</h1></div>
				</td>
				<td align="right" class="title" style="padding-right:10px;">
				  <? if ($config[userinfo]) { ?>					
					<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
				  <? } else { ?>						
					<a href="index.php" class="lout">Home</a></strong>&nbsp; |&nbsp; <a href="member_login.php?mode=member" class="idclr">Login</a>
				  <? } ?>		
				</td>
			  </tr>
			  <tr>
				<td height="5" colspan="2" ></td>
			  </tr>
			  <? if($_SESSION['franchisee_id']=="") { ?>
			  <tr>
				<td height="40"  style="border:1px #e2e9b0 solid; padding:5px;" colspan="2" bgcolor="#f9ffcc">If you have own Internet Centre, here is a good opportunity to convert your existing traffic into huge profits. Maa Shakti Marriage Bureau is an Franchise scheme where gaining huge profits and also you could be a part of the most trusted Maa Shakti Marriage Bureau. </td>
			  </tr>
			  <tr>
				<td height="5" colspan="2"></td>
			  </tr>
			  <? if ($_SESSION['_msg']) {?>
			  <tr>
				<td align="right" colspan="2"><div style="float:right; color:#ba3501; font-weight:bold; padding-right:20px;"><?=$_SESSION['_msg']?><? $_SESSION['_msg']="";?></div></td>
			  </tr>
			 <? } ?>	
			  <tr>
					<form name="franchisee_loginForm" action="franchise_login.php?Mode=Login" method="post" onSubmit="return fnLogin();">
						<input type="hidden" name="action" value="login">
				<td valign="top" colspan="2">
					<table border="0" width="572" cellspacing="0" cellpadding="0" style="padding-top:5px;" class="loginbg">
						<tr>
							<td valign="top" width="230" style="padding:40px 0px 0px 10px;">
								<table border="0" cellspacing="0" align="left"  cellpadding="0">
									<tr>
										<td  height="25" colspan="2" ><h5 class="mlogin">You are an already Franchise? Login below</h5></td>
									</tr>
									<tr>
									<td colspan="2" height="20" style="padding-left:85px;"><h5 class="mlogin">Franchise Login</h5></td>
								</tr>
								<tr>
								  <td width="83" class="inlog"><strong>ID / E-mail</strong>&nbsp;</td>
								  <td width="161" height="30" class="select"><input type="text" name="txtFranchiseeID" class="loginbox"></td>
								</tr>
								<tr>
								  <td class="select"><strong>Password</strong></td>
								  <td height="35" class="inlog"><input type="password" name="txtPassword" class="loginbox"></td></tr>
								 <tr>
								   <td colspan="2" height="40" ><img src="images/login_bull_g.jpg" border="0" align="absmiddle"/>&nbsp;&nbsp;<a href="franchise_forgot_password.php" class="forgot">Forgot Password ?</a>&nbsp;&nbsp;&nbsp;<input name="Submit" type="submit" value="Login" class="button"></td>
							      </tr>
								 
								 <!--<tr>
								   <td  height="20" colspan="2"><img src="images/login_bull.jpg" border="0" align="absmiddle" hspace="5"/><a href="register.php" class="forgot">New user ?</a>&nbsp;</td>
							      </tr>-->	
								</table>
						</td>
							<td>
								<table  border="0" align="right" width="100%"  class="upgnow"   cellspacing="0" cellpadding="0"  height="222">
									<tr>
									<td valign="top" style="padding:0px 0px 20px 10px;">
											<h4 class="htitle">Benefits you get on Franchise<br><br></h4> 
											<p class="benfits"><img src="images/img_btn_left.jpg" align="absmiddle">&nbsp;&nbsp;Simple work</p>
											<p class="benfits"><img src="images/img_btn_left.jpg" align="absmiddle">&nbsp;&nbsp;Get more profit</p>
											<p class="benfits"><img src="images/img_btn_left.jpg" align="absmiddle">&nbsp;&nbsp;Online account maintenance</p>
											<p class="benfits"><img src="images/img_btn_left.jpg" align="absmiddle">&nbsp;&nbsp;Get more visitors to your center<br></p>
											<div style="height:30px; padding-top:5px;"> 
												<div style="height:30px;"><strong>Do you want to join Franchise scheme?</strong></div>
												<div style="padding-left:60px;"><input type="button" onClick="javascript: location.href='support.php?from=franchise';" value="Sign-up here" class="franbutton"></div>
											</div>
								</td>
									</tr>
								</table>
						</td>
<!--							<td valign="top" align="left">
								<div  style="padding:8px 0px 0px 0px; border:#00CC33 1px solid; width:244px;">
								<table  border="0"  cellspacing="0" width="380" cellpadding="0" class="upgnow" height="222">
									<tr>
									<td valign="top" idth="380" style="padding:0px 0px 20px 10px;">
											<h4 class="htitle">Benefits you get on Franchise<br><br></h4> 
											<p class="benfits"><img src="images/img_btn_left.jpg" align="absmiddle">&nbsp;&nbsp;Simple work</p>
											<p class="benfits"><img src="images/img_btn_left.jpg" align="absmiddle">&nbsp;&nbsp;Get more profit</p>
											<p class="benfits"><img src="images/img_btn_left.jpg" align="absmiddle">&nbsp;&nbsp;Online account maintenance</p>
											<p class="benfits"><img src="images/img_btn_left.jpg" align="absmiddle">&nbsp;&nbsp;Get more visitors to your center<br></p>
											<div style="height:30px; padding-top:5px;"> 
												<div style="height:30px;"><strong>Do you want to join Franchise scheme?</strong></div>
												<div style="padding-left:60px;"><input type="button" onClick="javascript: location.href='support.php?from=franchise';" value="Sign-up here" class="franbutton"></div>
											</div>
								</td>
								  </tr>
								</table>
								</div>
						 </td>-->	
						</tr>
					</table>
			    </td>
				</form>
			  </tr>
			  <? } else {?>
			  <tr>
			  <td valign="top">
			  <?=$_SESSION['Msg']?>
			  <? $_SESSION['Msg']="";?><br><br>
			  <input type="button" onClick="javascript: location.href='franchise_account.php';" width="150" value="Franchise Account" class="franbutton">
			  </td>
			  </tr>
			 <? } ?>
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
		  		include("includes/fotter.php") ?>
  </td>
  </tr>
</table>
<div>
</body>
</html>
