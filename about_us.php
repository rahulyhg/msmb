<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
if ($action == "login") {	
	MemberLogin($_POST);
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
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
    <td align="right"><img src="images/top_banner.jpg"/></td>
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
			<div style="padding:10px 0px 0px 0px;  float:left;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<table width="100%">
						<tr>
							<td>
							<div class="titlebg">
							  <h1 class="title">About Us</h1>
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
					</table>
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				 <form name="thisForm" method="post" onSubmit="return validate(this);">
							<input type="hidden" name="action" value="login">
					    <td width="592" rowspan="4" valign="top">
						<!--<h1 class="title">Member Login</h1>
						<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
						<div style="text-align:justify; float:right;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
							<td valign="top">1.</td>
							<td style="padding-left:10px;"><b style="color:#dd1815">Maa Shakti Marriage Bureau</b> is an online matrimonial portal dedicated to matchmaking service for prospective bride and grooms with experience of over five years with exhilarating and incredible success.</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
							<td valign="top">2.</td>
							<td style="padding-left:10px;"><b style="color:#dd1815">Maa Shakti Marriage Bureau</b> functions with all new technology and communication and services arranging information between the would be life partners for everlasting bliss later. Maa Shakti Marriage Bureau provides valuable opportunities to understanding each other for potential life partners and their families. Maa Shakti Marriage Bureau builds unbreakable wedlock between spouses in credibly.</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
							<td valign="top">3.</td>
							<td style="padding-left:10px;"><b style="color:#dd1815">Maa Shakti Marriage Bureau</b> delivers services and solutions with warmth and sprit to the customers you can absolutely rely on spirit to the Maa Shakti Marriage Bureau with confidence for perfect match making . Our endeavor is fulfilling the needs of singles in search of prospective spouse </td>
							</tr>
							
							
							<tr><td colspan="2"><div style="float:left;">
							
							<p>We at <b style="color:#dd1815"> Maa Shakti Marriage Bureau</b> are most trusted and credible processionals in selection you right life partner by expanding the horizon of opportunities for the singles who are serious about finding most suitable spouse our high quality team of professionals aspire for fulfillment of life through perfect match making </p>
							<p>Profiles of every member are closely scrutinized and no abuse can be made at all your identity and privacy is fully protected from the moment you enter <b style="color:#dd1815">Maa Shakti Marriage Bureau</b></p>
							<p>Customer services at <b style="color:#dd1815">Maa Shakti Marriage Bureau</b> are unparallel as it provides   database of potential life partners by screening out irrelevant and inappropriate contents. At Maa Shakti Marriage Bureau data base is constantly updated so as not to waste time in confirming details of prospective brides and grooms.</p>
							<p><b style="color:#dd1815">Maa Shakti Marriage Bureau</b> is the only avenue where your dreams come true and ensures safety on your payments and credit cards.</p>
								<div align="center"><img src="images/about.jpg"></div>
						</div>
						</td></tr></table>
						</div>
						<div style="float:left; padding:10px 0px 0px 10px;"></div>
						
					 </td>
					</form>
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