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
			<div style="padding:10px 0px 0px 0px;  float:left;">
			<table width="573" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td valign="top">
					<table width="100%">
						<tr>
							<td>
							<div class="titlebg">
							  <h1 class="title">FAQs</h1>
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
				<td>
					
					<table width="100%" border="0" cellspacing="1" cellpadding="10" style="border:#8f830d solid 1px; margin-top:10px;">
						<tr bgcolor="#ffffff">
											<td bgcolor="#e12f25" colspan="3"><b style="color:#FFFFFF;">Comparison of Membership </b></td>
					  </tr>
					  <tr>
					  <td bgcolor="#f4ebb4" style="padding-left:25px;"><b>Matrimony ID/Membership Schemes/Payment Options</b></td>
					  <td bgcolor="#e1d6bc" style="padding-left:25px;"><b>Profile Features</b></td>
					  <td bgcolor="#d8ddc8" style="padding-left:25px;"><b>Services</b></td>
					  </tr>
										<tr bgcolor="#ffffff">
											<td width="37%" valign="top" bgcolor="#fff9d4">
												<table width="100%" border="0" cellspacing="10" cellpadding="0" bgcolor="#fff9d4">
													<!--<tr>
														<td><b class="tbl_title">Matrimony ID/Membership Schemes/Payment Options</b></td>
													</tr> -->
														<tr>
														<td><a href="faq.php#matrimony" class="faq">Matrimony Id & Password</a></td>
													</tr>
														<tr>
														<td><a href="faq.php#membership"  class="faq">Membership</a><br>
																
														<ul class="tbl_faq">
																<li>&nbsp; &nbsp; &nbsp;<a href="faq.php#" class="faq_inner">Gold</a> <br></li>
																<li>&nbsp; &nbsp; &nbsp;<a href="faq.php#" class="faq_inner">Silver</a> <br></li>
																<li>&nbsp; &nbsp; &nbsp;<a href="faq.php#" class="faq_inner">Platinum</a> <br></li>
																<li>&nbsp; &nbsp; &nbsp;<a href="faq.php#" class="faq_inner">Free</a> <br></li></ul></td>
														
													</tr>
													<tr>
														<td><a href="faq.php#payment"  class="faq">Payment Options</a><ul class="tbl_faq1"><li><a href="faq.php#" class="faq_inner">Easy Payment</a> Post/Courier/Personal Visit</li></ul></td>
													</tr>
												</table>
							
										  </td>
											
											
											
											
											<td width="35%" lass="iclr2" valign="top" bgcolor="#efe7d4">
												<table width="100%" border="0" cellspacing="10" cellpadding="0" bgcolor="#efe7d4">
														<!--<tr>
															<td><b class="tbl_title">Profile Features</b></td>
														</tr> -->
														
														<tr>
															<td><a href="faq.php#" class="faq">Profile</a>
																<ul class="tbl_faq1">
																	<li><a href="#" class="faq_inner">Register Profile</a></li>
																	<li><a href="#" class="faq_inner">Modify Profile</a></li>
																	<li><a href="#" class="faq_inner">Delete Profile</a></li>
																</ul>
															
															</td>
														</tr>														
														<tr>
															<td><a href="faq.php#" class="faq">Search/View Profile by ID</a></td>
														</tr>
														
														<tr>
															<td><a href="faq.php#" class="faq">Bookmark/Ignore</a></td>
														</tr>
														
														<tr>
															<td><a href="faq.php#" class="faq">Contact Profiles</a>
																	<ul class="tbl_faq1">
																	 <li><a href="faq.php#" class="faq_inner"> Express Interest</a></li>
																	 <li><a href="faq.php#" class="faq_inner"> Inbox</a></li>
																	 </ul>
															</td>
														</tr>
														
												</table>
											
										  </td>
											
											
											
											<td width="37%" bgcolor="#e5e9d9" valign="top">
												<table width="100%" border="0" cellspacing="10" cellpadding="0">
														<!--<tr>
															<td><b class="tbl_title">Services</b></td>
														</tr> -->
														
														<tr>
															<td><a href="faq.php#photo" class="faq">Photo, Horoscope & Video</a></td>
														</tr>
														<tr>
															<td><a href="faq.php#" class="faq">Partner Preference</a></td>
														</tr>
														<tr>
															<td><a href="faq.php#" class="faq">Replies and Responses</a></td>
														</tr>
														<tr>
															<td><a href="faq.php#" class="faq">My Matches</a></td>
														</tr>
														
												</table>
											
										  </td>
										
										
										</tr>
			
						</table>
						
											
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
<!--			  <tr>
				<td style="border:1px solid #f4ebb4;"><div style="color:#333333; font-size:16px; background-color:#fff9d4; padding:10px;"><b><a name="matrimony">&nbsp;&nbsp;Matrimony Id and Password</a></b></div><br>
					<div style="padding-left:10px;"><b style="font-size:14px;">What is Matrimony ID?</b> <br>
					A Matrimony ID is a unique combination of an alphabet and a six or seven digit number (for example: A123456). To identify you uniquely, a Matrimony ID is assigned to you when you register with us. This Matrimony ID is to be referred in all correspondence with Bharatmatrimony.com. </div>
					<div style="float:right; padding-right:10px;"><a href="faq.php" class="back">Back to Top</a>&nbsp;<img src="images/top.gif" width="9" height="7"></div>
					<br><br>
</td>
			  </tr>
			  <tr><td height="25">&nbsp;</td></tr>
			  <tr>
				  	<td style="border:1px solid #e1d6bc;">
						<div style="color:#333333; font-size:14px; background-color:#e1d6bc; padding:10px;"><a name="membership"><b>What is the difference between Free membership and Paid (Classic Super / Classic Plus / Classic) membership?</b></a></div>
						<div style="padding-left:10px;"><br>Free members can only send an automated message to another member through use the "Express Interest" option to. They can also respond to messages from Classic Super / Classic Plus / Classic members.
						<br><br>Classic Super / Classic Plus / Classic members are paid members who have several privileged features, such as personalized contact with any member across the 15 portals, free classified in leading publications, double verified phone numbers, profile highlighting, etc., depending on their type of membership.</div>
						<div style="float:right; padding-right:10px;"><a href="faq.php" class="back">Back to Top</a>&nbsp;<img src="images/top.gif" width="9" height="7"></div><br>
					<br></td>
			   </tr>
-->			   <tr><td height="2"></td></tr>
			   <tr>
			   		<td><div style="color:#e12f25; font-size:16px;">&nbsp;&nbsp;<b><a name="payment">Payment Options</a></b></div><br>
						<div style="padding-left:10px;"><b>What are the rates for your paid services?</b><br>
						Please find the rates below:</div>
</td>
				</tr>
			 <tr><td height="10"></td></tr>
			  <tr>
				<td>
					<table width="573" border="0" cellspacing="0" cellpadding="4" style="border:#8f830d solid 1px; margin-top:5px; osition:absolute;">
					
					  <tr>
						<td width="81%" class="iclr2"><strong>Choose Your membership</strong></td>
					    <td rowspan="2" valign="top" align="right" class="regfree"><div><a href="register.php"><img src="images/spacer.gif" width="100" height="100" border="0"/></a></div></td>
					  </tr>
					  <tr>
					  	<td bgcolor="#f2f5eb">
									<table width="98%" border="0" cellspacing="2" cellpadding="4" style="margin-left:5px;">
						<? $sql="select * from tbl_packages where  package_id<>1";
						$res=mysql_query($sql);	
						echo mysql_error();
						$no=mysql_num_rows($res);
						     if($no>0) { 
							 		while($rs=mysql_fetch_object($res)){ ?>
						
							  <tr>
								<td class="iclr5"><? echo $rs->package_name;?> </td>
								<td align="center" class="iclr"><strong>Rs.<? echo number_format($rs->package_price,0);?></strong></td>
								<td align="center" class="iclr"><strong><? echo $rs->valid_period;?> Months Membership</strong></td>
							  </tr>
							 <? }  }
							  ?>
							  <tr>
							  	<td>
								<? if ($config[userinfo]) { ?>	
									<a href="upgrade_membership.php?package_id=5"><img src="images/platinum_pack.jpg" border="0"/></a>
								<? } else { ?>
									<a href="register.php?package_id=5"><img src="images/platinum_pack.jpg" border="0"/></a>
								<? } ?>	
								</td>
								<td>
								<? if ($config[userinfo]) { ?>
									<a href="upgrade_membership.php?package_id=2"><img src="images/gold_pack.jpg" border="0"/></a>
								<? } else { ?>	
									<a href="register.php?package_id="><img src="images/gold_pack.jpg" border="0"/></a>
								<? } ?>	
								</td>
								<td>
								<? if ($config[userinfo]) { ?>
									<a href="upgrade_membership.php?package_id=3"><img src="images/silver_pack.jpg" border="0"/></a>
								<? } else { ?>		
									<a href="register.php?package_id=2"><img src="images/silver_pack.jpg" border="0"/></a>
								<? } ?>	
								</td>
							  </tr>
							</table>							
							</td>
			          </tr>
					 
					 </table>
				</td>
			  </tr>
<!--			  <tr><td height="25">&nbsp;</td></tr>
			   <tr><td style="border:1px solid #d8ddc8;"><div style="background-color:#d8ddc8; padding:10px;"><a name="photo"><b>Photo, Horoscope and Video</b></a></div>
						<br><div style="padding-left:10px;"><b>How do I add a photo to my profile?</b> 						
						<ul class="tbl_faq1">
							<li>Login using your "Matrimony / Email ID" and "Password"</li>			
							<li>Click on the "Upload Photo" link under the space reserved for your Photo.</li>	
							<li>You will be taken to the Add Photo Page</li>	
							<li>Click on the "Upload Photo" link</li>	
							<li>Click the 'Browse' button and select the digital photo (in JPG /GIF format) you wish to add to your profile. </li>	
							<li>Click on "Add Photo" to add the photo to your profile. </li>	
							<li>The photo will be added as your Main Photo. You now have the option of adding up to 3 photos to your profile. You can also manage your photos and decide which should be your main photo.</li>	
						</ul></div>
 
</td></tr>
-->			</table>
		</div>
		</td>
	  </tr>
	</table>
	</td>
  </tr>
  <tr>
  <td colspan="2">
  	<? 
		
		include("includes/fotter.php");
	?>
  </td>
  </tr>
</table>
<div>
</body>
</html>
