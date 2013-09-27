<?php
ob_start();
session_start();
include("includes/lib.php");

$action = GetVar("action");
$mode = GetVar("mode");
$mode1 = base64_decode(GetVar("mode1"));
$user_id = GetVar("userid");

# check login user
if (!$user_id) {	
	if (!$config[userinfo]) { header("Location: member_login.php"); die(); }
}	

if ($user_id) {

	$user = GetSingleRecord("tbl_register","username",$user_id);	
	if ($user) {
		extract($user,EXTR_REFS);
	}	
} else {

	$user = GetSingleRecord("tbl_register","username",$config[userinfo][username]);	
	if ($user) {	
		extract($user,EXTR_REFS);
	}	
}
 
if (!$user) {

	$_SESSION['msg'] = "Please enter valid Matrimony ID";
	header("Location: error.php?id=25");
	die();
}

if ($action == "delete") {

	# remove photos if any
	$resPhoto = Execute("select * from tbl_photo where userid='" . $id . "'");
	
	if (mysql_num_rows($resPhoto)>0) {
		while ($userphoto = mysql_fetch_array($resPhoto)) {
			if ($userphoto[photo]) {
				removeFile("userimages/" . $userphoto[photo]);
			}
			if ($userphoto[thumbnail]) {
				removeFile("userthumbnail/" . $userphoto[thumbnail]);
			}			
		}
		$res = Execute("delete from tbl_photo where userid='" . $id . "'");		
	}
	
	# remove interest if any
	$userinterest = GetSingleRecord("tbl_interests","userid",$id);	
	if ($userinterest) {
		$res = Execute("delete from tbl_interests where userid = '" .$id . "'");		
	}
	
	# remove horoscope if any
	if ($horoscope) { removeFile("horoscope/" . $horoscope); }
	
	# remove profile if any
	$sql = Execute("delete from tbl_register where id = '" . $id . "'");
	
	# remove express interest
	$sql = Execute("delete from tbl_express_interest where sender = '" . $id . "' or recipient = '" . $id . "'");
	
	$_SESSION['msg'] = "Profile deleted successfully";
	header("Location: error.php?id=5");
	die();
}
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
<!--<SCRIPT language=JavaScript src="includes/photoslider.js" type=text/javascript></SCRIPT>-->
<? require_once("includes/photoslider.php"); ?>
<?
//require("includes/photoslider.php");
?>
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
    <td align="right"><? fnBannerImage('  ','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>  
  <tr>
    <td colspan="2" valign="top">
			<table width="754" border="0" align="center" cellspacing="0" cellpadding="0" style=" border-bottom:1px solid #849c34;">
				<? if ($id == $config[userinfo][id]) {?>
			  <tr>
				<td style="padding-top:10px;">
					<table width="754" border="0" cellspacing="0" cellpadding="0" class="topbg" align="center">
					  <tr>
						<td width="348" height="27">&nbsp;</td>
						
						<td width="119" align="center" style="padding-bottom:35px;"><strong class="protxt">My Profile</strong></td>
						<td width="119" valign="top"><a href="edit_my_profile.php" class="epro"><strong>Edit My Profile</strong></a></td>
						<td valign="top"><a href="edit_my_profile.php?action1=lookingfor" class="epart"><strong> Edit Partner Preference</strong></a></td>
						
						
						<!--<td width="119" align="center" style="padding-bottom:35px;"><strong class="protxt">View Profile</strong></td>
						<td width="200">&nbsp;</td><td>&nbsp;</td>-->
						
					  </tr>
					  <!--tr>
						<td colspan="4" height="20" align="center" valign="top"><font class="protxt"><a href="#" class="proink">Basic Details</a>|<a href="#" class="proink">Occupation / Family details</a>|<a href="#" class="proink">Physical Details</a>|<a href="#" class="proink">Interest / Hobbies details</a>|<a href="#" class="proink"> Expectation / Looking for</a></font></td>
					  </tr-->
					</table>
				</td>
			  </tr>
			  <? } else  {?>
			  <tr>
				<td style="padding-top:10px;">&nbsp;
				
				</td>
			  </tr>	
			 
			  <? } ?>
			  
			  <? //if ($id != $config[userinfo][id]) {
			  	 //}
			  ?>
			  <tr>
						<? if ($id != $config[userinfo][id]) { ?>
						<td class="membertopbg">
							<strong class="memprotxt"><b>Member Info</b></strong>
						</td><? } ?>
			</tr>
			  <tr>
				<td style="padding-top:10px;"  align="center" class="mainbdr">
					<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg">
					 <tr>
						<td width="161" align="left" style="padding:4px 5px 9px 47px;" height="16"><h3 class="topic">Profile Details</h3></td><td width="254">&nbsp;</td>
						<? if ($id != $config[userinfo][id]) { ?>
			  	 		 	<td width="314" valign="top" align="right" style="padding-right:30px;"><img src="images/forward_profile.gif">&nbsp;&nbsp;<a href="forward_profile.php?id=<?=$user[id]?>&mode=forward" class="print">Forward Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/print.gif">&nbsp;&nbsp;<a href="#" class="print">Print</a></td>
				 		<? } ?>
					  </tr>
					  <tr>
						<td class="tbdrlft1" align="center">
						<table width="22%" border="0" cellspacing="0" cellpadding="0">
								  <tr><td colspan="3" align="center">										
										<?
												//$resPhoto = Execute("select * from tbl_photo where userid = '".$id."' and approve = '1'");
												if ($id == $config[userinfo][id]) {
													$resPhoto = Execute("select * from tbl_photo where userid = '".$id."'");
												} else {
													$resPhoto = Execute("select * from tbl_photo where userid = '".$id."' and approve = '1' ");
												}
												$i = 0;
												
												if (mysql_num_rows($resPhoto) > 0) {
													while ($memPhoto = mysql_fetch_array($resPhoto)) { 																								 								
														if ($photo_password && $id != $config[userinfo][id]) { ?>	
														<script>															
															photos["<?=$i?>"] = "images/protectedphoto.gif"; 
														</script>																			
													<?  
															break;
														} else { ?>
																<script>							
																	photos["<?=$i?>"] = "usernormal/<?=$memPhoto[photo]?>";
																</script>																			
															<?																														
															$i++;
														}		
													} 
												} else {
													
														$resPhoto1 = Execute("select * from tbl_photo where userid = '".$user[id]."' and approve = 0");
														if (mysql_num_rows($resPhoto1) > 0) { ?>																		
															<script>
																photos["<?=$i?>"] = "images/pendpicture.png";
															</script>
													 <? } else { ?>											
															<script>
																photos["<?=$i?>"] = "images/addphoto.gif";
															</script>																		
														<!--<a href="add_photo.php" class="pagenum">Add Photo</a>-->
													 <? } ?>	
											
											<?	} ?>										
										<script>
											if (linkornot==0)
												document.write("<a href=\"javascript:PhotoManager('<?=$user[id]?>')\">")
												if (photos[0] == 'images/addphoto.gif') {	
													document.write('<a href="add_photo.php"><img src="'+photos[0]+'" name="photoslider" style="filter:revealTrans(duration=1,transition=2); border:#333333 1px solid;" border=0 width=150 height=160></a>')
													document.write('<br>&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_photo.php" class="pagenum">Add Photo</a>')
												} else {
													document.write('<img src="'+photos[0]+'" id="photoslider" name="photoslider" style="filter:revealTrans(duration=1,transition=2); border:#333333 1px solid;" border=0 width=150 height=160>')
												}	
											if (linkornot==0)
												document.write('</a>')
										</script>
										</td>
									</tr>
								<? if (mysql_num_rows($resPhoto) > 1) {?>	
								  <tr>
								  <td align="right" class="btxt" height="30"><a href="#" onClick="backward();return false"><img src="images/arrow_left.jpg" border="0"/></a></td>
								  <td><a href="#" onClick="backward();return false" class="moreid"><div id="imgNum">1</div></a></td>
								  <td align="left"><a href="#" onClick="forward();return false"><img src="images/arrow_right.jpg" border="0"/></a></td></tr>
								<? } ?>  
							  </table>	
						
						
						</td>
						<td bgcolor="#f3fae6" align="center">
							<table idth="260" border="0" cellspacing="0" cellpadding="5" tyle="padding-right:15px;">
							  <tr>
					<td class="intxt" width="124" align="left">Member ID</td>
								<td width="25" class="intxt">:</td>
								<td class="intxt" width="105" align="left">
									<? if ($id == $config[userinfo][id]) { ?>								
								<a href="edit_my_profile.php" class="moreid"><?=$username?></a>
								<? } else  { echo $username; } ?>								</td>
							  </tr>
							  <tr>
								<td class="intxt"align="left">Profile Created on</td>
								<td class="intxt">:</td>
								<td class="intxt" align="left"><?=strftime("%d %b %Y",strtotime($registration_date));?></td>
							  </tr>
							  <? if ($id == $config[userinfo][id]) { ?>
							  <tr>
								<td class="intxt" align="left">Package Expire</td>
								<td class="intxt">:</td>
								<td class="intxt" align="left"><?=GetPackageExpiryDate($config[userinfo][id])?></td>
							  </tr>
							  <? } ?>
							</table>
						</td>
						<td class="tbdrrgt" align="center">
						
							<table width="254" border="0" cellspacing="0" cellpadding="5" style="padding-right:5px;">
								<tr>
									<td class="intxt" width="124" align="left">Name</td>
									<td class="intxt" width="25">:</td>
									<td class="intxt" width="105" align="left"><?=$name?></td>
								</tr>
								<tr>
									<td class="intxt"align="left">Membership</td>
									<td class="intxt">:</td>
									<td class="intxt" align="left"><?=preg_replace('/package/','',GetSingleField("package_name","tbl_packages","package_id",$membership_type));?></td>
								</tr>
								<tr>
                                  <td class="intxt" align="left">Last Login</td>
								  <td class="intxt">:</td>
								  <td class="intxt" align="left"><?=strftime("%d %b %Y",strtotime($lastLogin));?></td>
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
					  <?
					  	
							if (!$height) { $height = "Not Specified"; }
							if (!$bloodGroup) { $bloodGroup = "Not Specified"; }
							if (!$bodyType) { $bodyType = "Not Specified"; }
							if (!$physicalStatus) { $physicalStatus = "Not Specified"; }
							if (!$language) { $language = "Not Specified"; }
							if (!$complexion) { $complexion = "Not Specified"; }
							
					  	 /* $primary_information = array(
						  		"username" => "Member ID",
								"name" => "Name",
								"date of birth"
								"age"  => "Age",
								
								"gender"  => "Gender",
								"maritalStatus" => "Martial Status",
								
								"" => "Profile Created on",
								"" => "",
								"" => "",
								
						  );*/
					  ?>
					  <tr>
						<td align="center" colspan="3">
							<table width="22%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td class="tbdrlft" bgcolor="#f3fae6" align="center">
										<table width="90%" border="0" cellspacing="0" cellpadding="5">
										  <!--<tr>
											<td class="intxt" width="124" align="left">Member ID</td>
											<td width="25" class="intxt">:</td>
											<td class="intxt" width="105" align="left"><?=$username?></td>
										  </tr>
										  <tr>
											<td class="intxt" width="124" align="left">Name</td>
											<td class="intxt" width="25">:</td>
											<td class="intxt" width="105" align="left"><?=$name?></td>
										  </tr>
										  <tr>-->
											<td class="intxt" width="124" align="left">Age</td>
											<td class="intxt" width="25">:</td>
											<?
												$year = substr($date_of_birth, 0, 4);
												$month = substr($date_of_birth, 5, 2);
												$date = substr($date_of_birth, 8, 2);
											?>
											<td class="intxt" width="105" align="left"><?=DOB2Age($year,$date,$month)?></td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Gender</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left">												
												<?
													if ($gender = 'M') {													
														$gender_1 = 'Male';
													} else 	{
														$gender_1 = 'Female';;
													}
													echo $gender_1;
												?>
											</td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Martial Status</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=$maritalStatus;?></td>
										  </tr>		
										  <tr>
											<td class="intxt"align="left">Height</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=$height?></td>
										  </tr>
										   <tr>
											<td class="intxt"align="left">Blood Group</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=$bloodGroup?></td>
										  </tr>		
										  <tr>
											<td class="intxt"align="left">Body Type</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=$bodyType?></td>
										  </tr>						  										  									  
										</table>
									</td>
									<td class="tbdrrgt" align="center">
										<table width="90%" border="0" cellspacing="0" cellpadding="5">										  		
										<!--  <tr>
											<td class="intxt"align="left">Profile Created on</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=strftime("%d %b %Y",strtotime($registration_date));?></td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Package Expire</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=GetPackageExpiryDate($config[userinfo][id])?></td>
										  </tr>	
										  <tr>										  
											<td class="intxt"align="left">Membership</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=ereg_replace('package','',GetSingleField("package_name","tbl_packages","package_id",$membership_type));?></td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Last Login</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=strftime("%d %b %Y",strtotime($lastLogin));?></td>
										  </tr>	
										  <tr>
											<td class="intxt" align="left">Login ID</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=$username?></td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Password</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=$password?></td>
										  </tr>-->
										   <tr>
											<td class="intxt"align="left">Phycial Status</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=$physicalStatus?></td>
										  </tr>
										  <!--<tr>
											<td class="intxt"align="left">Blood Group</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=$bloodGroup?></td>
										  </tr>-->
										  <tr>
											<td class="intxt"align="left">Complexion</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=$complexion?></td>
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
								<td width="161" align="left" style="padding:5px 5px 9px 35px;" height="16"><h3 class="topic">Community  Information</h3></td><td width="254">&nbsp;</td>
								<td width="314">&nbsp;</td>
							  </tr>
							  <tr>
								<td align="center" colspan="2">
								<?
												if ($religion) {
													$religion = GetSingleField("religion","tbl_religion_master","id",$religion);
													$caste = GetSingleField("caste","tbl_caste_master","id",$caste);
												} else { $religion = "Not Specified"; }														
												if (!$caste) { $caste = "Not Specified"; }
												if (!$subcaste) { $subcaste = "Not Specified"; }
												if (!$gothram) { $gothram = "Not Specified"; }
												if (!trim($star)) { $star = "Not Specified"; }
												if (!$eatingHabits) { $eatingHabits = "Not Specified"; }
												if (!$smoking) { $smoking = "Not Specified"; }	
												if (!$drink) { $drink = "Not Specified"; }											
									?>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tr>
										<td class="tbdrlft" bgcolor="#f3fae6" align="center">
											<table width="90%" border="0" cellspacing="0" cellpadding="5">
											  <tr>
												<td class="intxt" width="124" align="left">Religion</td>
												<td width="25" class="intxt">:</td>
												<td class="intxt" width="105" align="left"><?=$religion?></td>
											  </tr>
											  <tr>
												<td class="intxt"align="left">Caste</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$caste?></td>
											  </tr>											  
											  <tr>
												<td class="intxt" align="left">Star</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$star?></td>
											  </tr>
											  <tr>
												<td class="intxt" align="left">Eating Habits</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$eatingHabits?></td>
											  </tr>
											  <tr>
												<td class="intxt" align="left">Drinking Habits</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$drink?></td>
											  </tr>
											</table>
										</td>
										<td class="tbdrrgt" align="center">
											<table width="90%" border="0" cellspacing="0" cellpadding="5">											  
											  <tr>
												<td class="intxt"align="left">Sub Caste</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$subcaste?></td>
											  </tr>
											  <tr>
												<td class="intxt" align="left">Gothram</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$gothram?></td>
											  </tr>
											  <tr>
												<td class="intxt" align="left">Smoking Habits</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$smoking?></td>
											  </tr>											  
											</table>
										</td>
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
					  <tr>
					<td style="padding-top:10px;" align="center" class="mainbdr">
						<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
						  <tr>
							<td width="161" align="left" style="padding:5px 5px 9px 72px;" height="16"><h3 class="topic">Location</h3></td><td width="254">&nbsp;</td>
							<td width="314">&nbsp;</td>
						  </tr>
						  <?
									if (!$citizenship) { $citizenship = "Not Specified"; }
									if (!$countryLivingIn) { $countryLivingIn = "Not Specified"; }
									if ($residingCountry) {
										$residingCountry = GetSingleField("country","tbl_country_master","id",$residingCountry);
									} else {
										if ($residingCountry_1) {
											$residingCountry = $residingCountry_1;
										} else {
											$residingCountry = "Not Specified";
										}
									}
									
									if ($residingState) {
										$residingState = GetSingleField("state","tbl_state_master","id",$residingState);
									} else {
										if ($residingState_1) {
											$residingState = $residingState_1;
										} else {
											$residingState = "Not Specified";
										}
									}
									
									if ($residingCity) {
										$residingCity = GetSingleField("city","tbl_city_master","id",$residingCity);
									} else {
										if ($residingCity_1) {
											$residingCity = $residingCity_1;
										} else {
											$residingCity = "Not Specified";
										}
									}																																							
									
									if (!$nationality) { $nationality = "Not Specified"; }		
									
									if ($country) {
										$country = GetSingleField("country","tbl_country_master","id",$country);
									} else {
										if ($country_1) {
											$country = $country_1;
										} else {
											$country = "Not Specified";
										}
									}
									
									if ($state) {
										$state = GetSingleField("state","tbl_state_master","id",$state);
									} else {
										if ($state_1) {
											$state = $state_1;
										} else {
											$state = "Not Specified";
										}
									}
									
									if ($city) {
										$city = GetSingleField("city","tbl_city_master","id",$city);
									} else {
										if ($state_1) {
											$city = $city_1;
										} else {
											$city = "Not Specified";
										}
									}							
								?>
						  <tr>
							<td align="center" colspan="3">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tr>
										<td class="tbdrlft" bgcolor="#f3fae6" align="center">
											<table width="90%" border="0" cellspacing="0" cellpadding="5">
											  <tr>
												<td class="intxt" width="124" align="left">Citizenship</td>
												<td width="25" class="intxt">:</td>
												<td class="intxt" width="105" align="left"><?=$citizenship?></td>
											  </tr>
											  <tr>
												<td class="intxt"align="left">Residing State</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$residingState?></td>
											  </tr>
											  <tr>
												<td class="intxt" align="left">Country</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$country?></td>
											  </tr>
											  <tr>
												<td class="intxt" align="left">City</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$city?></td>
											  </tr>											  
											</table>
										</td>
										<td class="tbdrrgt" align="center">
											<table width="90%" border="0" cellspacing="0" cellpadding="5">
											  <tr>
												<td class="intxt" width="124" align="left">Country Living in</td>
												<td class="intxt" width="25">:</td>
												<td class="intxt" width="105" align="left"><?=$residingCountry?></td>
											  </tr>
											  <tr>
												<td class="intxt"align="left">Residing City</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$residingCity?></td>
											  </tr>
											  <tr>
												<td class="intxt" align="left">State</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$state?></td>
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
					   <?
							if (!$education) { $education = "Not Specified"; }
							if (!$educationDetail) { $educationDetail = "Not Specified"; }
							if (!$occupation) { $occupation = "Not Specified"; }
							if (!$educationDetail) { $educationDetail = "Not Specified"; }
							if (!$income) { $income = "Not Specified"; }
							if ($education) {
								$education = GetSingleField("education","tbl_education_master","id",$education);
							} else { $education = "Not Specified"; }
							if ($occupation) {
								$occupation = GetSingleField("occupation","tbl_occupation_master","id",$occupation);
							} else { $occupation = "Not Specified"; }	
							if (!$occupationDetail) { $occupationDetail = "Not Specified"; }																															
																
						?>
					  <tr>
						<td style="padding-top:10px;" align="center" class="mainbdr">
							<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg3">
							  <tr>
								<td width="220" align="left" style="padding:5px 0px 9px 40px;" height="16"><h3 class="topic">Education & Profession Information</h3></td><td width="245">&nbsp;</td>
							  </tr>
							  <tr>
									<td align="center" colspan="2">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
												  <tr>
													<td class="tbdrlft" bgcolor="#f3fae6" align="center" valign="top">
														<table width="90%" border="0" cellspacing="0" cellpadding="5">
														  <tr>
															<td class="intxt" width="124" align="left">Education</td>
															<td width="25" class="intxt">:</td>
															<td class="intxt" width="105" align="left"><?=$education?></td>
														  </tr>
														  <tr>
															<td class="intxt"align="left">Occupation</td>
															<td class="intxt">:</td>
															<td class="intxt" align="left"><?=$occupation?></td>
														  </tr>
														  <tr>
															<td class="intxt" align="left">Annual Income</td>
															<td class="intxt">:</td>
															<td class="intxt" align="left"><?=$income?></td>
														  </tr>
														 </table>
													</td>
													<td class="tbdrrgt" align="center">
														<table width="90%" border="0" cellspacing="0" cellpadding="5">
														  <tr>
															<td class="intxt" width="126" align="left">Education in Detail</td>
															<td class="intxt" width="12">:</td>
															<td class="intxt" width="155" align="left"><?=$educationDetail?></td>
														  </tr>
														  <tr>
															<td class="intxt"align="left">Occupation in Detail</td>
															<td class="intxt">:</td>
															<td class="intxt" align="left"><?=$occupationDetail?></td>
														  </tr>
														  <!--tr>
															<td class="intxt" align="left">Working Place</td>
															<td class="intxt">:</td>
															<td class="intxt" align="left">Coimbatore</td>
														  </tr-->
														</table>
													</td>
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
					  <tr>
						<td style="padding-top:10px;" align="center" class="mainbdr" colspan="2">
							<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
							  <tr>
								<td width="161" align="left"  colspan="2" style="padding:5px 5px 9px 70px;" height="16"><h3 class="topic">About Me</h3></td><td width="254">&nbsp;</td>
								<td width="314">&nbsp;</td>
							  </tr>
							  <?	if (!$personality) { $personality = "Not Specified"; } ?>
							  <tr>
								<td align="center">
									<table width="22%" border="0" cellspacing="0" cellpadding="0">
										  <tr>
											<td class="tbdr" bgcolor="#f3fae6" align="center">
												<table width="90%" border="0" cellspacing="0" cellpadding="5">
												  <tr>
													<td  colspan="3" class="intxt" idth="124" align="left" valign="top"><p align="justify">  <?=$personality?></p></td>
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
							<td width="161" align="left" style="padding:5px 5px 9px 65px;" height="16"><h3 class="topic">Family Details</h3></td><td width="254">&nbsp;</td>
							<td width="314">&nbsp;</td>
						  </tr>
						  <?
									if (!$fatherName) { $fatherName = "Not Specified"; }
									if (!$motherName) { $motherName = "Not Specified"; }
									if (!$familyValue) { $familyValue = "Not Specified"; }
									if (!$familyType) { $familyType = "Not Specified"; }
									if (!$familyStatus) { $familyStatus = "Not Specified"; }
									if (!$fatherProfessions) { $fatherProfessions = "Not Specified"; }
									if (!$motherProfession) { $motherProfession = "Not Specified"; }
									if (!$familyOrigin) { $familyOrigin = "Not Specified"; }
									$totalBrothers = $marriedBrothers + $unMarriedBrothers;
									$totalSisters = $marriedSister + $unMarriedSister;
									if (!$totalBrothers) { $totalBrothers = "0"; }
									if (!$totalSisters) { $totalSisters = "0"; }
									if (!$marriedBrothers) { $marriedBrothers = "0"; }
									if (!$unMarriedBrothers) { $unMarriedBrothers = "0"; }
									if (!$marriedSister) { $marriedSister = "0"; }
									if (!$unMarriedSister) { $unMarriedSister = "0"; }																		
									if (!$familyOrigin) { $familyOrigin = "Not Specified"; }
								?>
						  <tr>
							<td align="center">
								<table width="22%" border="0" cellspacing="0" cellpadding="0">
									  <tr>
										<td class="tbdrlft" bgcolor="#f3fae6" align="center" valign="top">
											<table width="90%" border="0" cellspacing="0" cellpadding="5">
											  <tr>
												<td class="intxt" width="124" align="left">Family Values</td>
												<td width="25" class="intxt">:</td>
												<td class="intxt" width="105" align="left"><?=$familyValue?></td>
											  </tr>
											  <tr>
												<td class="intxt"align="left">Family Status</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$familyStatus?></td>
											  </tr>
											  <tr>
												<td class="intxt"align="left">Father's Name</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$fatherName?></td>
											  </tr>
											  <tr>
												<td class="intxt"align="left">Father's Occupation</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$fatherProfessions?></td>
											  </tr>
											  <tr>
												<td class="intxt" align="left">Total Brother(s)</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$totalBrothers?></td>
											  </tr>
											   <tr>
												<td class="intxt" align="left">&nbsp;&nbsp;&nbsp;&nbsp;Married</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$marriedBrothers?></td>
											  </tr>
											  <tr>
												<td class="intxt" align="left">&nbsp;&nbsp;&nbsp;&nbsp;Unmarried</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$unMarriedBrothers?></td>
											  </tr>
											 </table>
										</td>
										<td class="tbdrrgt" align="center">
											<table width="90%" border="0" cellspacing="0" cellpadding="5">
											  <tr>
												<td class="intxt" width="124" align="left">Family Type</td>
												<td class="intxt" width="25">:</td>
												<td class="intxt" width="105" align="left"><?=$familyType?></td>
											  </tr>
											  <tr>
												<td class="intxt" align="left">Ancestral Origin</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$familyOrigin?></td>
											  </tr>
											  <tr>
												<td class="intxt"align="left">Mother's Name</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$motherName?></td>
											  </tr>
											  <tr>
												<td class="intxt"align="left">Mother's Occupation</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$motherProfession?></td>
											  </tr>
											  <!--<tr>
												<td class="intxt" align="left">Smoking Habits</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$smoking?></td>
											  </tr>
											  <tr>-->
												<td class="intxt" align="left">Total Sister(s)</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$totalSisters?></td>
											  </tr
											  ><tr>
												<td class="intxt" align="left">&nbsp;&nbsp;&nbsp;&nbsp;Married</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$marriedSister?></td>
											  </tr>
											  <tr>
												<td class="intxt" align="left">&nbsp;&nbsp;&nbsp;&nbsp;Unmarried</td>
												<td class="intxt">:</td>
												<td class="intxt" align="left"><?=$unMarriedSister?></td>
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
					  <tr>
						<td style="padding-top:10px;" align="center" class="mainbdr">
							<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
						  <tr>
							<td width="161" align="left" style="padding:5px 5px 9px 47px;" height="16"><h3 class="topic">Hobbies & Interests</h3></td><td width="254">&nbsp;</td>
							<td width="314">&nbsp;</td>
						  </tr>
						  <tr>
							<td align="center" colspan="3">
							<table width="22%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td class="tbdr" bgcolor="#f3fae6" align="center">
										<table width="95%" border="0" cellspacing="0" cellpadding="5">
										<?
												$res1 = Execute("select * from tbl_interests where userid = '$id'"); 
												if (mysql_num_rows($res1) > 0) {														
												} else { ?>
										  <tr>
											<td class="intxt" width="124" colspan="3" align="center">Not Specified</td>
											 </tr>
										  <? } 
										if($config["label_interest"]){  
										  foreach ($config["label_interest"] as $key => $value) {
											//echo ("select * from tbl_interests where userid = '$id' and type = '$key'");
											unset($userintersts);
											$userintersts = array();						
											$number = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25");
											$res = Execute("select * from tbl_interests where userid = '$id' and type = '$key'");
											if (mysql_num_rows($res)>0) {																								
												while ($usrinterest = mysql_fetch_array($res)){
													foreach ($config["menu_$key"] as $key1 => $value1) {
														if ($key1 == $usrinterest[interest]) {															
															array_push($userintersts,$value1);															
														}
													}														
													if (in_array($usrinterest[interest], $number)) {	
													} else {														
														array_push($userintersts,$usrinterest[interest]);		
													}	
												}
										
												 ?>
										  <tr>
											<td class="intxt"align="left"><?=$value?> </td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><? echo implode(", ",$userintersts);?></td>
										  </tr>
										  <?	}
										}	
										}	
										
										?>	
										  
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
						<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg4">
						  <tr>
						  	<td>
								<table  border="0" cellspacing="0" cellpadding="0" align="right">
								  <tr>
									<td width="146" align="center" valign="top"><div  id="1"><a href="javascript:void(0);" class="ppref" onClick="javascript:showdetails(1,3);"><strong>Partner Preference</strong></a></div></td>
									<td width="146" align="center" valign="top"><div  id="2"><a href="javascript:void(0);" class="partnerpref" onClick="javascript:showdetails(2,3);"><strong>Religious Preference</strong></a></div></td>
									<td width="146" align="center" valign="top"><div  id="3"><a href="javascript:void(0);" class="partnerpref" onClick="javascript:showdetails(3,3);"><strong>Education Preference</strong></a></div></td>
									<td width="16" align="center" height="34">&nbsp;</td>
								   </tr>
								</table>
							</td>
						  </tr>
						  <?
						  			if ($partnerReligion) {
										
										$partner_religion = array();
										$partner_religions =  explode(",",$partnerReligion);
										for ($i = 0; $i < count($partner_religions); $i++) {
											if ($partner_religions[$i] == "0") {
												array_push($partner_religion,"Any");
												break;
											} else {
												$religion1 = GetSingleField("religion","tbl_religion_master","id",$partner_religions[$i]);
												array_push($partner_religion,$religion1);
											}	
										}
										$partnerReligion = implode(",",$partner_religion);
									} else {
										$partnerReligion = "Not Specified";
									}
										
									if ($partnerSevvaiDosham) {
										if ($partnerSevvaiDosham == 3) { $partnerSevvaiDosham = "Doesn't matter"; }
										if ($partnerSevvaiDosham == 1) { $partnerSevvaiDosham = "Yes"; }
										if ($partnerSevvaiDosham == 2) { $partnerSevvaiDosham = "No"; }
									} else {
										$partnerSevvaiDosham = "Not Specified";
									}
									
									if ($partnerCaste) {
										$partner_caste = array();
										$partner_caste1 =  explode(",",$partnerCaste);
										for ($i = 0; $i < count($partner_caste1); $i++) {														
											if ($partner_caste1[$i] == "0") {
												array_push($partner_caste,"Any");
												break;
											} else {
												$caste1 = GetSingleField("caste","tbl_caste_master","id",$partner_caste1[$i]);
												array_push($partner_caste,$caste1);
											}	
										}
										$partnerCaste = implode(",",$partner_caste);
									} else {
										$partnerCaste = "Not Specified";
									}											
									
									if (!$partnerEatingHabits) { $partnerEatingHabits = "Not Specified"; }
									
									if ($partnerMaritalStatus) {
										$partner_MaritalStatus = array();
										$partner_MaritalStatus1 = explode(",",$partnerMaritalStatus);
										for ($i = 0; $i < count($partner_MaritalStatus1); $i++)	{
											if ($partner_MaritalStatus1[$i] == "unspec") { 
												array_push($partner_MaritalStatus,"Any");
												break;												
											} else {
												array_push($partner_MaritalStatus,$partner_MaritalStatus1[$i]);
											}
										}
										$partnerMaritalStatus = implode(",",$partner_MaritalStatus);										
									}
									
									if ($partnerPhysicalStatus == "unspec") {
										$partnerPhysicalStatus = "Doesn't matter";
									}
									
									if ($partnerEducation) {
									
										$partner_Education = array();									
										$partner_Educations = explode(",",$partnerEducation);
										for ($i = 0; $i < count($partner_Educations); $i++)	{
											if ($partner_Educations[$i] == "0") { 
												array_push($partner_Education,"Any");
												break;
											} else {
												$education1 = GetSingleField("education","tbl_education_master","id",$partner_Educations[$i]);
												array_push($partner_Education,$education1);															
											}
										}
										$partnerEducation = implode(",",$partner_Education);
									} else { $partnerEducation = "Not Specified";  }
									
									if ($partnerCitizenship) {
									
										$partnerCitizenship = explode(",",$partnerCitizenship);
										for ($i = 0; $i < count($partnerCitizenship); $i++)	{
											if ($partnerCitizenship[$i] == "unspec") { $partnerCitizenship[$i] = "Any"; break; }
										}
										$partnerCitizenship = implode(",",$partnerCitizenship);
									} else { $partnerCitizenship = "Not Specified";  }
									
									if ($partnerCountryLiving) {
									
										$partner_CountryLiving = array();
										$partner_CountryLivings = explode(",",$partnerCountryLiving);
										for ($i = 0; $i < count($partner_CountryLivings); $i++)	{
											if ($partner_CountryLivings[$i] == "0") { 
												array_push($partner_CountryLiving,"Any");
												break;
											} else {
												
												$partner_CountryLivings[$i] = GetSingleField("country","tbl_country_master","id",$partner_CountryLivings[$i]);
												array_push($partner_CountryLiving,$partner_CountryLivings[$i]);
											}
											
										}										
										$partnerCountryLiving = implode(",",$partner_CountryLiving);
										
									} else { $partnerCountryLiving = "Not Specified";  }							
									
									
									if ($partnerResidingState) {
									
										$partner_ResidingState = array();
										$partner_ResidingStates = explode(",",$partnerResidingState);
										
										for ($i = 0; $i < count($partner_ResidingStates); $i++)	{
											if ($partner_ResidingStates[$i] == "0") { 
												array_push($partner_ResidingState,"Any");
											} else {
												$partner_ResidingStates[$i] = GetSingleField("state","tbl_state_master","id",$partner_ResidingStates[$i]);
												array_push($partner_ResidingState,$partner_ResidingStates[$i]);
											}
										}
										$partnerResidingState = implode(",",$partner_ResidingState);
									} else { $partnerResidingState = "Not Specified";  }							
									
									if ($partnerResidingCity) {

										$partner_ResidingCity = array();
										$partner_ResidingCities = explode(",",$partnerResidingCity);
										
										for ($i = 0; $i < count($partner_ResidingCities); $i++)	{
											if ($partner_ResidingCities[$i] == "0") { 
												array_push($partner_ResidingCity,"Any");
											} else {
												$partner_ResidingCities[$i] = GetSingleField("city","tbl_city_master","id",$partner_ResidingCities[$i]);
												array_push($partner_ResidingCity,$partner_ResidingCities[$i]);
											}
										}
										$partnerResidingCity = implode(",",$partner_ResidingCity);											
									} else { $partnerResidingCity = "Not Specified";  }
								
								?>
						  <tr>
							<td align="center">
									<table width="22%" border="0" cellspacing="0" cellpadding="0">
										  <tr>
											<td class="tbdr" bgcolor="#f3fae6" align="center">
												<div id="service1" style="display:block">
													<table width="95%" border="0" cellspacing="0" cellpadding="5">
													  <tr>
														<td class="intxt" width="124" align="left">Age</td>
														<td width="25" class="intxt">:</td>
														<td class="intxt" idth="105" align="left">
														<? if($ageFrom!="")	{	?>
														From <?=$ageFrom?> to <?=$ageTo?>
														<? } else { echo "Not Specified";	} ?>
														</td>
													  </tr>
													 
													  <tr>
														<td class="intxt" align="left">Height</td>
														<td class="intxt">:</td>
														<td class="intxt" align="left">
														<? if($partnerHeightFrom!="")	{	?>
														<?=$partnerHeightFrom?>ft to <?=$partnerHeightTo?>ft
														<? } else { echo "Not Specified";	} ?>
														</td>
													  </tr>
													   <tr>
														<td class="intxt" align="left">Looking for </td>
														<td class="intxt">:</td>
														<td class="intxt" align="left">
														<? if($partnerMaritalStatus!="") { ?>
														<?=$partnerMaritalStatus?>
														<?	} else echo "Not Specified"; ?>
														</td>
													  </tr>
													   <tr>
														<td class="intxt"align="left">Physical Status </td>
														<td class="intxt">:</td>
														<td class="intxt" align="left">
														<? if($partnerPhysicalStatus!="") { ?>
														<?=$partnerPhysicalStatus?>
														<?	} else echo "Not Specified"; ?>
														</td>
													  </tr>
													  <tr>
														<td class="intxt"align="left">Mother Tongue  </td>
														<td class="intxt">:</td>
														<td class="intxt" align="left">
														<? if($partnerMotherTongue!="") { ?>
														<?=$partnerMotherTongue?>
														<?	} else echo "Not Specified"; ?>
														</td>
													  </tr>
													   <tr>
														<td class="intxt"align="left">About My Partner</td>
														<td class="intxt">:</td>
														<td class="intxt" align="left">
														<? if($aboutLifePartner!="") { ?>
														<?=$aboutLifePartner?>
														<?	} else echo "Not Specified"; ?>
														</td>
													  </tr>
													 </table>	
												</div>
												<div id="service2" style="display:none">
													<table width="95%" border="0" cellspacing="0" cellpadding="5">
													 
													  <tr>
														<td class="intxt"align="left">Religion</td>
														<td class="intxt">:</td>
														<td class="intxt" align="left"><? if($partnerReligion==0) { echo "Not Specified"; } else  { echo GetSingleField("religion","tbl_religion_master","id",$partnerReligion); }?></td>
													  </tr>
													  <tr>
														<td class="intxt" align="left">Manglik</td>
														<td class="intxt">:</td>
														<td class="intxt" align="left">
														<? 
															if ($partnerSevvaiDosham == 3)
															  echo "Doesn't matter"; 
															elseif ($partnerSevvaiDosham == 1)
															  echo "Yes";
															else 
															  echo "No";
														?>
														 </td>
													  </tr>
													  <tr>
														<td class="intxt" align="left">Caste/Division</td>
														<td class="intxt">:</td>
														<td class="intxt" align="left"><? if($partnerCaste==0) { echo "Not Specified"; } else  { echo $partnerCaste; }?> </td>
													  </tr>
													  <tr>
														<td class="intxt" width="124" align="left">Eating Habits</td>
														<td width="25" class="intxt">:</td>
														<td class="intxt" idth="105" align="left"><?=$partnerEatingHabits?></td>
													  </tr>
													 </table>	
												</div>
												<div id="service3" style="display:none">
													<table width="95%" border="0" cellspacing="0" cellpadding="5">
													  <tr>
														<td class="intxt" width="124" align="left">Education</td>
														<td width="25" class="intxt">:</td>
														<td class="intxt" idth="105" align="left"><?=$partnerEducation?></td>
													  </tr>
													   <tr>
														<td class="intxt" width="124" align="left">Citizenship</td>
														<td width="25" class="intxt">:</td>
														<td class="intxt" idth="105" align="left"><?=$partnerCitizenship?></td>
													  </tr>
													   <tr>
														<td class="intxt" width="124" align="left">Country of Residence</td>
														<td width="25" class="intxt">:</td>
														<td class="intxt" idth="105" align="left"><?=$partnerCountryLiving?></td>
													  </tr>
													   <tr>
														<td class="intxt" width="124" align="left">Residing State</td>
														<td width="25" class="intxt">:</td>
														<td class="intxt" idth="105" align="left"><?=$partnerResidingState?></td>
													  </tr>
													   <tr>
														<td class="intxt" width="124" align="left">Residing City</td>
														<td width="25" class="intxt">:</td>
														<td class="intxt" idth="105" align="left"><?=$partnerResidingCity?></td>
													  </tr>
													  
													  
													 
													 </table>	
												</div>
									</td>
								 </tr>
								  <tr>
									<td colspan="2" valign="bottom"><img src="images/topic_bg_bottom.jpg" border="0"/></td>
								  </tr>
								  <tr><td colspan="2">&nbsp;</td></tr>
								  <tr><td align="center"><a href="support.php" class="more">Report Abuse</a></td></tr>
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
<script type="text/JavaScript">

function showdetails(a,b)
		{									
	 var i;
			for(i=1; i<=b;i++)
				{
				if(a==i){
					if(i==1)
					document.getElementById('1').innerHTML="<div><a href='javascript:void(0);' class='ppref' onClick='javascript:showdetails(1,3);'><strong>Partner Preference</strong></a></div>";
					else if(i==2)
					document.getElementById('2').innerHTML="<div ><a href='javascript:void(0);' class='ppref' onClick='javascript:showdetails(2,3);'><strong>Religious Preference</strong></a></div>";
					else if(i==3)
					document.getElementById('3').innerHTML="<div><a href='javascript:void(0);' class='ppref' onClick='javascript:showdetails(3,3);'><strong>Education Preference</strong></a></div>";
					document.getElementById("service"+i).style.display="block";
				}
				else {	
					if(i==1)
					document.getElementById('1').innerHTML="<div id='1'><a href='javascript:void(0);' class='partnerpref' onClick='javascript:showdetails(1,3);'><strong>Partner Preference</strong></a></div>";
					if(i==2)
					document.getElementById('2').innerHTML="<div id='2'><a href='javascript:void(0);' class='partnerpref' onClick='javascript:showdetails(2,3);'><strong>Religious Preference</strong></a></div>";
					if(i==3)
					document.getElementById('3').innerHTML="<div id='3'><a href='javascript:void(0);' class='partnerpref' onClick='javascript:showdetails(3,3);'><strong>Education Preference</strong></a></div>";
					document.getElementById("service"+i).style.display="none";
				}
				} 
		}
</script>
</div>
</body>
</html>
