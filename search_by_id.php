<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
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

function searchByIdValidate() {
	f1 = document.thisForm;
	if (isNull(f1.userid,"Matrimony ID")) { return false; }
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
	<table width="780" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td>
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:12px 0px 0px 4px;  float:left;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<div class="titlebg">
					  <h1 class="title">Search By ID</h1>
					</div>
				</td>
				<td align="right" class="title">					
					<? if ($config[userinfo]) { ?>					
						<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
					<? } else { ?>						
						<a href="index.php" class="lout">Home</a></strong>&nbsp; |&nbsp; <a href="member_login.php?mode=member" class="idclr">Login</a>
					<? } ?>
				</td>
			  </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			  <tr>
					    <td width="400" colspan="2" valign="top">
						<!--<h1 class="title">Member Login</h1>
						<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
						<div style="float:left; padding:10px 0px 0px 0px;">
						<table border="0" width="550" align="left" cellspacing="0" cellpadding="0" style="background:url(images/vpro_menu.jpg) top center no-repeat; height:22px; width:550px">						  
						 
						  <tr>
						  	<td valign="top"  style="border:#b68e55 solid 1px;">
								<table border="0" width="500" cellpadding="5"   cellspacing="1">																			
									
						 			<form name="thisForm" action="view_member_profile.php" method="get" onSubmit="return searchByIdValidate();">										
						 			<tr>
									 	<td colspan="2" align="left">&nbsp;</td>
									 </tr>
									 <tr bgcolor="#FFFFFF">
										<td colspan="2">
										Use this option to view the profile of member whose Matrimony Id is known to you. To search our database use  <a href="search.php" class="lout">Search</a>  Profiles option.
										</td>					
									 </tr>
                                     <tr bgcolor="#FFFFFF" align="left">
										<td align="right">Enter the Matrimony Id <font color="#FF0000">&nbsp;</font> </td>
										<td><input type="text" name="userid" class="txtbox" maxlength="255"></td>					
									 </tr>									 									 
									 <tr bgcolor="#FFFFFF">  									
									 	<td colspan="2" align="center">
										<input type="submit" value="Submit" class="button">
										<input type="reset" value="Reset" class="button">
										</td>
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
  	<? 
		  		include("includes/fotter.php") ?>
  </td>
  </tr>
</table>
<div>
</body>
</html>
