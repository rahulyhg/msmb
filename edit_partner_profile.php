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
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/my_profile.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" src="includes/validate.js"></script>
<script language="JavaScript" src="includes/functions.js"></script> 
<SCRIPT language=JavaScript src="includes/photoslider.js" type=text/javascript></SCRIPT>
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
<body class="homeinbody" onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg','images/inner_menu_home_ovr.jpg','images/inner_menu_search_ovr.jpg','images/inner_menu_payment_ovr.jpg','images/inner_menu_matrimony_ovr.jpg','images/inner_menu_profile_ovr.jpg')">
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
			<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" style=" border-bottom:1px solid #849c34;">
			  <tr>
				<td style="padding-top:10px;">
					<table width="754" border="0" cellspacing="0" cellpadding="0" class="editpartner" align="center">
					  <tr>
						<td width="345" height="27">&nbsp;</td>
						<td width="119" valign="top" ><a href="my_profile.php" class="epro"><strong>My Profile</strong></a></td>
						<td width="120" align="left" valign="top"><a href="my_profile.php" class="epro">&nbsp;<strong>Edit My Profile</strong></a></td>
						<td width="168" align="center" style="padding:0px 0px 35px 0px;"><strong class="protxt">Edit Partner Preference&nbsp;&nbsp;&nbsp;</strong></td>
					  </tr>
					</table>
				</td>
			  </tr>
			  <tr>
				<td style="padding-top:10px;" align="center" class="mainbdr">
					<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg">
					  <tr>
						<td width="161" align="left" style="padding:5px 5px 9px 47px;" height="16"><h3 class="topic">Profile Details</h3></td><td width="254">&nbsp;</td>
						<td width="314" colspan="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td class="tbdrlft" align="center">
							<table width="22%" border="0" cellspacing="0" cellpadding="0">
								  <tr><td colspan="3">
										<script>
											if (linkornot==0)
												document.write('<a href="javascript:transport()"" >')
												document.write('<img src="'+photos[0]+'" name="photoslider" style="filter:revealTrans(duration=1,transition=2); border:#333333 1px solid;" border=0>')
											if (linkornot==0)
												document.write('</a>')
										</script>
										</td>
									</tr>
								  <tr>
								  <td align="right" class="btxt" height="30"><a href="#" onClick="backward();return false"><img src="images/arrow_left.jpg" border="0"/></a></td>
								  <td><a href="#" onClick="backward();return false" class="moreid"><div id="imgNum">1</div></a></td>
								  <td align="left"><a href="#" onClick="forward();return false"><img src="images/arrow_right.jpg" border="0"/></a></td></tr>
							  </table>						
						  </td>
						<td bgcolor="#f3fae6" align="center">
							<table width="254" border="0" cellspacing="0" cellpadding="5">
							  <tr>
								<td class="intxt" width="124" align="left">Member ID</td>
								<td width="25" class="intxt">:</td>
								<td class="intxt" width="105" align="left"><a href="#" class="moreid">M10003</a></td>
							  </tr>
							  <tr>
								<td class="intxt"align="left">Profile Created on</td>
								<td class="intxt">:</td>
								<td class="intxt" align="left">12-Sep 2007</td>
							  </tr>
							  <tr>
								<td class="intxt" align="left">Package Expire</td>
								<td class="intxt">:</td>
								<td class="intxt" align="left">27 Nov 2008</td>
							  </tr>
							  <tr>
								<td class="intxt" align="left">Last Login</td>
								<td class="intxt">:</td>
								<td class="intxt" align="left">22 Nov 2007</td>
							  </tr>
							</table>
						</td>
						<td class="tbdrrgt" align="center">
							<table width="254" border="0" cellspacing="0" cellpadding="5">
							  <tr>
								<td class="intxt" width="124" align="left">Name</td>
								<td class="intxt" width="25">:</td>
								<td class="intxt" width="105" align="left">P. Murali</td>
							  </tr>
							  <tr>
								<td class="intxt"align="left">Membership</td>
								<td class="intxt">:</td>
								<td class="intxt" align="left">Silver</td>
							  </tr>
							  <tr>
								<td class="intxt" align="left">Login ID</td>
								<td class="intxt">:</td>
								<td class="intxt" align="left">Murali</td>
							  </tr>
							  <tr>
								<td class="intxt" align="left">Password</td>
								<td class="intxt">:</td>
								<td class="intxt" align="left">123456</td>
							  </tr>
							</table>
						</td>
					  </tr>
					  <tr>
						<td colspan="3" valign="bottom"><img src="images/topic_bg_bottom.jpg" border="0"/></td>
					  </tr>
					</table>
				</td>
			  </tr>
			  <tr>
				<td style="padding-top:10px;" align="center" class="mainbdr">
					<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
					  <tr>
						<td width="161" align="left" style="padding:5px 5px 9px 47px;" height="16"><h3 class="topic">Primary  Information</h3></td><td width="254">&nbsp;</td>
						<td width="314">&nbsp;</td>
					  </tr>
					  <tr>
						<td align="center" colspan="2">
							<table width="22%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td class="tbdrlft" bgcolor="#f3fae6" align="center">
										<table width="90%" border="0" cellspacing="0" cellpadding="5">
										  <tr>
											<td class="intxt" width="124" align="left">Member ID</td>
											<td width="25" class="intxt">:</td>
											<td class="intxt" width="105" align="left">M10003</td>
										  </tr>
										  <tr>
											<td class="intxt"align="left">Profile Created on</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left">12-Sep 2007</td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Package Expire</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left">27 Nov 2008</td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Last Login</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left">22 Nov 2007</td>
										  </tr>
										</table>
									</td>
									<td class="tbdrrgt" align="center">
										<table width="90%" border="0" cellspacing="0" cellpadding="5">
										  <tr>
											<td class="intxt" width="124" align="left">Name</td>
											<td class="intxt" width="25">:</td>
											<td class="intxt" width="105" align="left">P. Murali</td>
										  </tr>
										  <tr>
											<td class="intxt"align="left">Membership</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left">Silver</td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Login ID</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left">Murali</td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Password</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left">123456</td>
										  </tr>
										</table>
									</td>
								  </tr>
								  <tr>
									<td colspan="2" valign="bottom"><img src="images/topic_bg_bottom.jpg" border="0"/></td>
								  </tr>
								  <tr><td colspan="2">&nbsp;</td></tr>								  
								</table>
						  </td>	
					  </tr>
					</table>
				</td>
 			  </tr>
			  <tr>
				<td style="padding-top:10px;" align="center" class="mainbdr">
					<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
					  <tr>
						<td width="161" align="left" style="padding:5px 5px 9px 47px;" height="16"><h3 class="topic">Primary  Information</h3></td><td width="254">&nbsp;</td>
						<td width="314">&nbsp;</td>
					  </tr>
					  <tr>
						<td align="center" colspan="2">
							<table width="22%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td class="tbdrlft" bgcolor="#f3fae6" align="center">
										<table width="90%" border="0" cellspacing="0" cellpadding="5">
										  <tr>
											<td class="intxt" width="124" align="left">Member ID</td>
											<td width="25" class="intxt">:</td>
											<td class="intxt" width="105" align="left">M10003</td>
										  </tr>
										  <tr>
											<td class="intxt"align="left">Profile Created on</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left">12-Sep 2007</td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Package Expire</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left">27 Nov 2008</td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Last Login</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left">22 Nov 2007</td>
										  </tr>
										</table>
									</td>
									<td class="tbdrrgt" align="center">
										<table width="90%" border="0" cellspacing="0" cellpadding="5">
										  <tr>
											<td class="intxt" width="124" align="left">Name</td>
											<td class="intxt" width="25">:</td>
											<td class="intxt" width="105" align="left">P. Murali</td>
										  </tr>
										  <tr>
											<td class="intxt"align="left">Membership</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left">Silver</td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Login ID</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left">Murali</td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Password</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left">123456</td>
										  </tr>
										</table>
									</td>
								  </tr>
								  <tr>
									<td colspan="2" valign="bottom"><img src="images/topic_bg_bottom.jpg" border="0"/></td>
								  </tr>
								  <tr><td colspan="2">&nbsp;</td></tr>								  
								</table>
						  </td>	
					  </tr>
					</table>
				</td>
 			  </tr>
			  </table>
		</td>
	</tr>
    <? include("includes/fotter.php") ?>
</table>
<div>
</body>
</html>
