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
	<table width="780" border="0" cellspacing="0"  cellpadding="0">
	  <tr>
		<td valign="top">
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top" >
			<div style="padding:12px 0px 0px 5px;   float:left;">
			<table width="584" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td>
					<div class="titlebg"><h1 class="title">Payment</h1></div>
				</td>
				<td align="right" class="title">					
					 <? if ($config[userinfo]) { ?>					
					<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
					<? } else { ?>						
						<a href="index.php" class="lout">Home</a></strong>&nbsp; |&nbsp; <a href="member_login.php?mode=member" class="idclr">Login</a>
					<? } ?>	
				</td>
			  </tr>
			  <tr><td colspan="2" height="10"></td></tr>
			  <tr><td colspan="2">Maa Shakti Marriage Bureau provides multiple privileged services to its member's convenience. Just choose and pay by any of the following the Membership which speeds up the process of searching for contacting the desired partner while making it an unforgettable experience.</td></tr>
			  <tr>
				<td colspan="2">
						<table width="584" border="0" cellspacing="2" cellpadding="4" style="border:#8f830d solid 1px; margin-top:5px;">					
						<?
								$res = Execute("select * from tbl_packages order by package_id desc");
								
								if (mysql_num_rows($res) > 0) { 
										
										$usrfields = array(
											"package_name" => "Membership",
											"valid_period"    => "Duration",
											"package_price"	  => "Amount", 																					 
											"contact_details_other_member" => "View Contact Details of other members",											
											"double_verified_phones" => "Doubled Verified phone numbers",
											"special_highlight" => "Special Highlighting",											
											"feature_profile" => "Feature profile",
											"verified_phone" => "Verified phone numbers",																						
											"top_pacement" => "Top pacement",
											"profile_highlighting" => "Profile highlighting",
											"protect_photo_horoscope" => "Protect photo/horoscope",
											"add_photo" => "Add photo",
											"add_horoscope" => "Add Horoscope",
											"express_intrest" => "Express Interest",
											"privacy_settings" => "Privacy Settings",											
											"daily_match_watch" => "Daily Match Watch",
											"book_mark_profile" => "Bookmark Profiles",
											"hide_delete_profile" => "Hide and delete Profiles",
											"sms_daily_match" => "SMS for Daily match and Express interest Alerts",											
																						
										);
										foreach ($usrfields as $key => $value) {								
											
											 if ($key =="valid_period") {
												?>
													<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td width="12%" align="center" class="iclr">
															<? if (mysql_result($res,$i,$key) == "0") 
																	echo "No";
															else
																	echo mysql_result($res,$i,$key)."months";?>
															</td>
														<?
															}
														?>														
													</tr>
													
										<?	} else if ($key == 'package_name') { ?>
										
												<tr bgcolor="#ffffff">
														<td width="45%" class="iclr2"><strong><?=$value?></strong></td>												
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
															if (mysql_result($res,$i,$key) == "Free package") { ?>	
															<td align="center" class="iclr">															
																<? echo str_replace('package','Membership',mysql_result($res,$i,$key));  } 												
															else { ?>
																<td width="19%" align="center" class="iclr4">																
																<? 	echo str_replace('package','Membership',mysql_result($res,$i,$key)); 
																}
																?>
															</td>
														<?
															}
														?>		
												</tr>
											<? } else	if ($key =="package_price") { ?>
													<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td width="12%" align="center" class="iclr">
															<? 
																if (mysql_result($res,$i,$key)) 
																	echo number_format(mysql_result($res,$i,$key),0);
																else 
																	echo '--';	
															?>
															</td>
														<?
															}
														?>														
													</tr>													
										  <? } else if ($key == 'double_verified_phones') {	?>
												<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"> <? if (mysql_result($res,$i,$key) == "1") {
																echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>																
										<?	} else if ($key == 'special_highlight') {	?>
												<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"><? if (mysql_result($res,$i,$key) == "1") {																						echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>
													<?	} else if ($key == 'profile_highlight') {	?>
												<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"> <? if (mysql_result($res,$i,$key) == "1") {
																echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>																
										<?	} else if ($key == 'daily_match_watch') {	?>
												<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"><? if (mysql_result($res,$i,$key) == "1") {																						echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>
													<?	} else if ($key == 'book_mark_profile') {	?>
												<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"> <? if (mysql_result($res,$i,$key) == "1") {
																echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>																
										<?	} else if ($key == 'hide_delete_profile') {	?>
												<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"><? if (mysql_result($res,$i,$key) == "1") {																						echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>
													<?	} else if ($key == 'sms_daily_match') {	?>
												<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"> <? if (mysql_result($res,$i,$key) == "1") {
																echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>																
										<?	} else if ($key == "express_intrest") {
												?>
													<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"> <? if (mysql_result($res,$i,$key) == "1") {
																echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>
												<?
											} else if ($key == "add_horoscope") {
												?>
												<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"><? if (mysql_result($res,$i,$key) == "1") {
																echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>
										<?	} else if ($key == 'verified_phone') {	?>
												<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"> <? if (mysql_result($res,$i,$key) == "1") {
																echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>
										<?	} else if ($key == 'contact_details_other_member') {	?>
												<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"> 
															<? if (mysql_result($res,$i,$key) == "0") 
																	echo "No";
															else
																	echo mysql_result($res,$i,$key);?>
															</td>
														<?
															}
														?>														
													</tr>		
										<?	} else if ($key == 'contact_members') {	?>
												<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"> <? if (mysql_result($res,$i,$key) == "1") {
																echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>																
										<?	} else if ($key == 'feature_profile') {	?>
												<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"><? if (mysql_result($res,$i,$key) == "1") {																						echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>
										<?	} else if ($key == 'profile_highlighting') {	?>
												<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"><? if (mysql_result($res,$i,$key) == "1") {																						echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>
										<? } else if ($key == "top_pacement") {
												?>
													<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"><? if (mysql_result($res,$i,$key) == "1") {																						echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>
													<? } else if ($key == "protect_photo_horoscope") {
												?>
													<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"><? if (mysql_result($res,$i,$key) == "1") {																						echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>
													<? } else if ($key == "add_photo") {
												?>
													<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"><? if (mysql_result($res,$i,$key) == "1") {																						echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>
														<? } else if ($key == "add_horoscope") {
												?>
													<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"><? if (mysql_result($res,$i,$key) == "1") {																						echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>
													<? } else if ($key == "express_intrest") {
												?>
													<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"><? if (mysql_result($res,$i,$key) == "1") {																						echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>
														<? } else if ($key == "express_intrest") {
												?>
													<tr bgcolor="#ffffff">
														<td class="iclr"><?=$value?></td>
														<? 
														for ($i = 0; $i < mysql_num_rows($res); $i++) {
														 ?>	
															<td align="center" class="iclr"><? if (mysql_result($res,$i,$key) == "1") {																						echo "<img src='images/icon_tic.gif' border='0'>";
															} else {
																echo "<img src='images/icon_into.gif' border='0'>";
															} ?>
															</td>
														<?
															}
														?>														
													</tr>
										<? } else { ?>
												<tr bgcolor="#ffffff">
													<td class="iclr"><?=$value?></td>
													<? 
													for ($i = 0; $i < mysql_num_rows($res); $i++) {
													 ?>	
														<td align="center" class="iclr">
														<? if ($key == 'privacy_settings') { ?>	
															<? if (mysql_result($res,$i,$key) == "1") {
																	echo "<img src='images/icon_tic.gif' border='0'>";
																} else {
																	echo "<img src='images/icon_into.gif' border='0'>";
																}
															 } ?>
														</td>
													<?
													}
													?>														
												</tr>
										<? }														
									}									
								} 
							?>
						</table>
				</td>
			  </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			  <tr>
				<td colspan="2"><div class="titlebg"><h1 class="title">Payment Options</h1></div></td>
			  </tr>
			  <tr>
				<td colspan="2">
					<table width="584" border="0" cellspacing="0" cellpadding="4" style="border:#8f830d solid 1px; margin-top:5px; osition:absolute;">
					
					  <tr>
						<td  class="iclr2"><strong>Choose Your membership</strong></td>
					    <td rowspan="2" valign="top" align="right" class="regfree"><div><a href="register.php"><img src="images/spacer.gif" width="85" height="100" border="0"/></a></div></td>
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
								<td class="iclr5"><? echo str_replace('package','membership',$rs->package_name);?> </td>
								<td align="center" class="iclr"><strong>Rs.<? echo number_format($rs->package_price,0);?></strong></td>
								<td align="center" class="iclr"><strong><? echo $rs->valid_period;?> Months Membership</strong></td>
							  </tr>
							 <? }
							 }
							 ?>
							  <tr>
							    <td align="center">
								<? if ($config[userinfo]) { ?>
									<a href="upgrade_membership.php?package_id=2"><img src="images/gold_pack.jpg" border="0"/></a>
								<? } else { ?>	
									<a href="member_login.php?package_id=2&link1=package&packid=2"><img src="images/gold_pack.jpg" border="0"/></a>
								<? } ?>	
								</td>
								<td align="center">
								<? if ($config[userinfo]) { ?>
									<a href="upgrade_membership.php?package_id=3"><img src="images/silver_pack.jpg" border="0"/></a>
								<? } else { ?>		
									<a href="member_login.php?package_id=3&link1=package&packid=2"><img src="images/silver_pack.jpg" border="0"/></a>
								<? } ?>	
								</td>
							  	<td align="center">
								<? if ($config[userinfo]) { ?>	
									<a href="upgrade_membership.php?package_id=5"><img src="images/platinum_pack.jpg" border="0"/></a>
								<? } else { ?>
									<a href="member_login.php?package_id=5&link1=package&packid=2"><img src="images/platinum_pack.jpg" border="0"/></a>
								<? } ?>	
								</td>
							  </tr>
							</table>							
							</td>
			          </tr>
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
		include("includes/fotter.php");
	?>
  </td>
  </tr>
</table>
<div>
</body>
</html>
