<?php
ob_start();
session_start();
include("includes/lib.php");

$action = GetVar("action");
$action = GetVar("action");
$mode = GetVar("mode");
$mode1 = base64_decode(GetVar("mode1"));
$userid = GetVar("userid");

# check login user
if (!$userid) {

	$_SESSION['msg'] = "Please enter valid Matrimony ID";
	header("Location: error.php?id=25");
	die();
}	

if ($userid) {
	$user = GetSingleRecord("tbl_register","username",$userid);	
	if ($user) {
		extract($user,EXTR_REFS);
	}	
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
	header("Location: thanks.php?id=5");
	die();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/my_profile_member.css" type="text/css" rel="stylesheet"/>
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
function MM_swapImgRestore() { //v3.0
	  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
	}
	
	function MM_preloadImages() { //v3.0
	  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
		var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
		if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
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
    <td align="right"><? fnBannerImage(' ','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>  
  <tr>
    <td colspan="2" valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td>
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:10px 0px 0px 0px; width:573px; float:right;" >
			<table idth="573" width="400" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
					<td>
					<div class="titlebg">
					  <h1 class="title">Member Info </h1>
					</div>
					</td>
			  	</tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  
			  <tr>
					    <td idth="592" width="400" rowspan="4" valign="top">
						<!--<h1 class="title">Member Login</h1>
						<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
						<? if ($_SESSION['_msg']) {?>
							<table width="90%"><tr><td colspan="3" align="center"><div style="float:center; padding-top:23px;"><? if($_SESSION['_msg']!=""){?> <font class=""><?=$_SESSION['_msg']; $_SESSION['_msg']="";?></font>&nbsp;&nbsp;<? }?></div></td></tr></table>
						<? } ?>	
						<div style="float:left; padding:10px 0px 0px 10px;">						
						<form name="thisForm"  method="post" enctype="multipart/form-data" onSubmit="return fnForward()">	
						
						<table border="0" width="90%" align="center" cellspacing="1" cellpadding="0" bgcolor="#c0ba84">
						 <tr bgcolor="#FFFFFF"><td>
							<table idth="500" width="400" border="0" align="center" cellspacing="0" cellpadding="0" class="probg">
									
									<tr><td>
											<table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg">
											 <tr>
												<td width="161" align="left" style="padding:5px 5px 9px 47px;" height="16"><h3 class="topic">Profile Details</h3></td><td width="254">&nbsp;</td>
												<? if ($id != $config[userinfo][id]) { ?>
													<td width="314" valign="top" align="right" style="padding-right:10px;"><img src="images/forward_profile.gif">&nbsp;&nbsp;<a href="forward_profile.php?id=<?=$user[id]?>&mode=forward" class="print">Forward Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/print.gif">&nbsp;&nbsp;<a href="#" class="print">Print</a></td>
												<? } ?>
											  </tr>
											  <tr>
												<td class="tbdrlft" align="center">
												<table width="25%" border="0" cellspacing="0" cellpadding="0">
														  <tr><td colspan="3">										
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
																	//document.write("<a href=\"javascript:PhotoManager('<?=$user[id]?>')\">")
																	if (photos[0] == 'images/addphoto.gif') {	
																		document.write('<a href="add_photo.php"><img src="'+photos[0]+'" name="photoslider" style="filter:revealTrans(duration=1,transition=2); border:#333333 1px solid;" border=0 width=100 height=127></a>')
																		document.write('<a href="add_photo.php" class="pagenum">Add Photo</a>')
																	} else {
																		document.write('<img src="'+photos[0]+'" name="photoslider" style="filter:revealTrans(duration=1,transition=2); border:#333333 1px solid;" border=0 width=100 height=127>')
																	}	
																if (linkornot==0)
																	document.write('</a>')
															</script>
															</td>
														</tr>
													<? if (mysql_num_rows($resPhoto) > 1) { ?>	
													  <tr>
													  <td align="right" class="btxt" height="30"><a href="#" onClick="backward();return false"><img src="images/arrow_left.jpg" border="0"/></a></td>
													  <td><a href="#" onClick="backward();return false" class="moreid"><div id="imgNum">1</div></a></td>
													  <td align="left"><a href="#" onClick="forward();return false"><img src="images/arrow_right.jpg" border="0"/></a></td></tr> 
													<? } ?>
													 </table>				
												</td>
												<td bgcolor="#f3fae6" align="center">
													<table width="254" border="0" cellspacing="0" cellpadding="5">
													  <tr>
														<td class="intxt" width="124" align="left">Member ID</td>
														<td width="25" class="intxt">:</td>
														<td class="intxt" width="105" align="left">
															<? if ($id == $config[userinfo][id]) { ?>								
														<a href="edit_my_profile.php" class="moreid"><?=$username?></a>
														<? } else  { echo $username; } ?>
														</td>
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
													  <tr>
														<td class="intxt" align="left">Last Login</td>
														<td class="intxt">:</td>
														<td class="intxt" align="left"><?=strftime("%d %b %Y",strtotime($lastLogin));?></td>
													  </tr>
													</table>
												</td>
												<td class="tbdrrgt" align="center"  >
													<table width="254" border="0" cellspacing="0" cellpadding="5">												
														<tr>
															<td  align="left"  style="padding-left:40px" height="20"><img src="images/phone.gif" align="absmiddle" border="0"/>&nbsp;&nbsp;<a href="javascript:openContact('phone','<?=base64_encode($id)?>')" ref="member_verify.php?action=cantact&id=<?=$id?>"  class="horoscope" arget="_blank">View Phone Number</a></td>
														</tr>
														<tr>
														<? if ($horoscope) { ?>
															<td  align="left" height="20" style="padding-left:40px" ><img src="images/horoscope.gif" align="absmiddle" border="0"/>&nbsp;&nbsp;<a href="member_verify.php?action=<?=base64_encode("horoscope")?>&id=<?=base64_encode($id)?>" class="horoscope" target="_blank">View Horoscope</a></td></tr>
														<? } ?>
														<tr><td  align="left" height="20" style="padding-left:40px" ><img src="images/bookmark.gif" align="absmiddle" border="0"/>&nbsp;&nbsp;<a href="forward_profile.php?mode=bookmark&id=<?=$id?>" class="horoscope">Book Mark</a></td></tr>
														<tr><td  align="left" height="20" style="padding-left:40px" ><img src="images/similar.gif" align="absmiddle" border="0"/>&nbsp;&nbsp;<a href="search.php?action=search&age=<?=$age?>&caste=<?=$caste?>&education=<?=$education?>"  class="horoscope">Similar Profiles</a></td></tr>
													</table>													
													
												</td>
											  </tr>
											  <tr>
												<td colspan="3" valign="bottom"><img src="images/topic_bg_bottom.jpg" border="0"/></td>
											  </tr>
											   <tr><td colspan="3">&nbsp;</td></tr>		
											</table>
									</td></tr>
									<tr><td >
									
									<table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
									  <tr>
										<td width="161" align="left" style="padding:5px 5px 9px 47px;" height="16"><h3 class="topic">Primary  Information</h3></td><td width="254">&nbsp;</td>
										<td width="314">&nbsp;</td>
									  </tr>
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
														  </tr>-->
														  <tr>
															<td class="intxt" width="124" align="left">Name</td>
															<td class="intxt" width="25">:</td>
															<td class="intxt" width="105" align="left"><?=$name?></td>
														  </tr>
														  <tr>
															<td class="intxt" width="124" align="left">Age</td>
															<td class="intxt" width="25">:</td>
															<td class="intxt" width="105" align="left"><?=$age?></td>
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
														</table>
													</td>
													<?
														if (!$height) { $height = "--"; }
														if (!$bloodGroup) { $bloodGroup = "--"; }
														if (!$bodyType) { $bodyType = "--"; }
														if (!$physicalStatus) { $physicalStatus = "--"; }
														if (!$language) { $language = "--"; }
													?>
													<td class="tbdrrgt" align="center">
														<table width="90%" border="0" cellspacing="0" cellpadding="5">										  		
														  <tr>
															<td class="intxt"align="left">Height</td>
															<td class="intxt">:</td>
															<td class="intxt" align="left"><?=$height?></td>
														  </tr>
														   <!--<tr>
															<td class="intxt"align="left">Blood Group</td>
															<td class="intxt">:</td>
															<td class="intxt" align="left"><?=$bloodGroup?></td>
														  </tr>-->
														   <tr>
															<td class="intxt"align="left">Phycial Status</td>
															<td class="intxt">:</td>
															<td class="intxt" align="left"><?=$physicalStatus?></td>
														  </tr>
														   <tr>
															<td class="intxt"align="left">Blood Group</td>
															<td class="intxt">:</td>
															<td class="intxt" align="left"><?=$language?></td>
														  </tr>
														   <tr>
															<td class="intxt"align="left">Body Type</td>
															<td class="intxt">:</td>
															<td class="intxt" align="left"><?=$bodyType?></td>
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
									  
								</td></tr>
								<tr><td>
								
										<table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
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
																} else { $religion = "--"; }														
																if (!$caste) { $caste = "--"; }
																if (!$subcaste) { $subcaste = "--"; }
																if (!$gothram) { $gothram = "--"; }
																if (!trim($star)) { $star = "--"; }
																if (!$eatingHabits) { $eatingHabits = "--"; }
																if (!$smoking) { $smoking = "--"; }	
																if (!$drink) { $drink = "--"; }											
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
								
								</td></tr>
								<tr><td>
								
										<table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
										  <tr>
											<td width="161" align="left" style="padding:5px 5px 9px 72px;" height="16"><h3 class="topic">Location</h3></td><td width="254">&nbsp;</td>
											<td width="314">&nbsp;</td>
										  </tr>
										  <?
													if (!$citizenship) { $citizenship = "--"; }
													if (!$countryLivingIn) { $countryLivingIn = "--"; }
													if (!$residingState) { $residingState = "--"; }
													if (!$residingCity) { $residingCity = "--"; }
													if (!$nationality) { $nationality = "--"; }		
													if (!$district) { $district = "--"; }	
													if (!$state) { $state = "--"; }
													if (!$city) { $city = "--"; }							
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
																<td class="intxt" align="left"><?=GetSingleField("state","tbl_state_master","id",$residingState)?></td>
															  </tr>
															  <tr>
																<td class="intxt" align="left">Nationality</td>
																<td class="intxt">:</td>
																<td class="intxt" align="left"><?=$nationality?></td>
															  </tr>
															  <tr>
																<td class="intxt" align="left">State</td>
																<td class="intxt">:</td>
																<td class="intxt" align="left"><?=GetSingleField("state","tbl_state_master","id",$state)?></td>
															  </tr>
															</table>
														</td>
														<td class="tbdrrgt" align="center">
															<table width="90%" border="0" cellspacing="0" cellpadding="5">
															  <tr>
																<td class="intxt" width="124" align="left">Country Living in</td>
																<td class="intxt" width="25">:</td>
																<td class="intxt" width="105" align="left"><?=$countryLivingIn?></td>
															  </tr>
															  <tr>
																<td class="intxt"align="left">Residing City</td>
																<td class="intxt">:</td>
																<td class="intxt" align="left"><?=GetSingleField("city","tbl_city_master","id",$city)?></td>
															  </tr>
															  <tr>
																<td class="intxt" align="left">District</td>
																<td class="intxt">:</td>
																<td class="intxt" align="left"><?=$district?></td>
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
								
								</td></tr>
								<?
									if (!$education) { $education = "--"; }
									if (!$educationDetail) { $educationDetail = "--"; }
									if (!$occupation) { $occupation = "--"; }
									if (!$educationDetail) { $educationDetail = "--"; }
									if (!$income) { $income = "--"; }
									if ($education) {
										$education = GetSingleField("education","tbl_education_master","id",$education);
									} else { $education = "--"; }
									if ($occupation) {
										$occupation = GetSingleField("occupation","tbl_occupation_master","id",$occupation);
									} else { $occupation = "--"; }	
									if (!$occupationDetail) { $occupationDetail = "--"; }																															
																		
								?>
								<tr><td>
	
												<table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg3">
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
								
								</td></tr>
								<tr><td>
								
										<table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
										  <tr>
											<td width="161" align="left"  colspan="2" style="padding:5px 5px 9px 70px;" height="16"><h3 class="topic">About Me</h3></td><td width="254">&nbsp;</td>
											<td width="314">&nbsp;</td>
										  </tr>
										  <?	if (!$personality) { $personality = "--"; } ?>
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
								
								</td></tr>
								<tr><td>
										
										<table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
											  <tr>
												<td width="161" align="left" style="padding:5px 5px 9px 65px;" height="16"><h3 class="topic">Family Details</h3></td><td width="254">&nbsp;</td>
												<td width="314">&nbsp;</td>
											  </tr>
											  <?	
														if (!$familyValue) { $familyValue = "--"; }
														if (!$familyType) { $familyType = "--"; }
														if (!$familyStatus) { $familyStatus = "--"; }
														if (!$fatherProfessions) { $fatherProfessions = "--"; }
														if (!$motherProfession) { $motherProfession = "--"; }
														if (!$familyOrigin) { $familyOrigin = "--"; }
														$totalBrothers = $marriedBrothers + $unMarriedBrothers;
														$totalSisters = $marriedSister + $unMarriedSister;
														if (!$totalBrothers) { $totalBrothers = "--"; }
														if (!$totalSisters) { $totalSisters = "--"; }
														if (!$marriedBrothers) { $marriedBrothers = "--"; }
														if (!$unMarriedBrothers) { $unMarriedBrothers = "--"; }
														if (!$marriedSister) { $marriedSister = "--"; }
														if (!$unMarriedSister) { $unMarriedSister = "--"; }																		
														if (!$familyOrigin) { $familyOrigin = "--"; }
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
																	<td class="intxt" align="left">Ancestral Origin</td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><?=$familyOrigin?></td>
																  </tr>
																  <tr>
																	<td class="intxt" align="left">Total Brother(s)</td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><?=$totalBrothers?></td>
																  </tr>
																   <tr>
																	<td class="intxt" align="left">Married</td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><?=$marriedBrothers?></td>
																  </tr>
																  <tr>
																	<td class="intxt" align="left">Unmarried</td>
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
																	<td class="intxt"align="left">Mother's Occupation</td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><?=$motherProfession?></td>
																  </tr>
																  <!--<tr>
																	<td class="intxt" align="left">Smoking Habits</td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><?=$smoking?></td>
																  </tr>-->
																  <tr>
																	<td class="intxt" align="left">Total Sister(s)</td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><?=$totalSisters?></td>
																  </tr
																  ><tr>
																	<td class="intxt" align="left">Married</td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><?=$marriedSister?></td>
																  </tr>
																  <tr>
																	<td class="intxt" align="left">Unmarried</td>
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
					
								</td></tr>
								<?
								$res1 = Execute("select * from tbl_interests where userid = '$id'"); 
								if (mysql_num_rows($res1) > 0) {	?>													
								
								<tr><td>
									
									<table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
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
															
													   foreach ($label_interest as $key => $value) {
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
															} ?>
													  <tr>
														<td class="intxt"align="left"><?=$value?> </td>
														<td class="intxt">:</td>
														<td class="intxt" align="left"><? echo implode(", ",$userintersts);?></td>
													  </tr>
													  <?	}
													}	?>	
													  
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
								
								</td></tr>
							<?	} ?>
								<tr><td>
									
									<table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg4">
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
												if ($partnerMaritalStatus) {
													$partnerMaritalStatus = explode(",",$partnerMaritalStatus);
													for ($i = 0; $i < count($partnerMaritalStatus); $i++)	{
														if ($partnerMaritalStatus[$i] == "unspec") { $partnerMaritalStatus[$i] = "Any"; }
													}
													$partnerMaritalStatus = implode(",",$partnerMaritalStatus);
													
												}									
												if ($partnerPhysicalStatus == "unspec") {
													$partnerPhysicalStatus = "Doesn't matter";
												}
												if ($partnerEducation) {									
													$partnerEducation = explode(",",$partnerEducation);
													for ($i = 0; $i < count($partnerEducation); $i++)	{
														if ($partnerEducation[$i] == "0") { 
															$partnerEducation[$i] = "Any";
														} else {
															$partnerEducation[$i] = GetSingleField("education","tbl_education_master","id",$partnerEducation[$i]);
														}
													}
													$partnerEducation = implode(",",$partnerEducation);
												} else { $partnerEducation = "-";  }
												if ($partnerCitizenship) {
													$partnerCitizenship = explode(",",$partnerCitizenship);
													for ($i = 0; $i < count($partnerCitizenship); $i++)	{
														if ($partnerCitizenship[$i] == "unspec") { $partnerCitizenship[$i] = "Any"; }
													}
													$partnerCitizenship = implode(",",$partnerCitizenship);
												} else { $partnerCitizenship = "-";  }
												if ($partnerCountryLiving) {
													$partnerCountryLiving = explode(",",$partnerCountryLiving);
													for ($i = 0; $i < count($partnerCountryLiving); $i++)	{
														if ($partnerCountryLiving[$i] == "unspec") { $partnerCountryLiving[$i] = "Any"; }
													}										
													$partnerCountryLiving = implode(",",$partnerCountryLiving);
												} else { $partnerCountryLiving = "-";  }
												if ($partnerResidingState) {
													$partnerResidingState = explode(",",$partnerResidingState);
													for ($i = 0; $i < count($partnerResidingState); $i++)	{
														if ($partnerResidingState[$i] == "unspec") { $partnerResidingState[$i] = "Any"; }
													}
													$partnerResidingState = implode(",",$partnerResidingState);
												} else { $partnerResidingState = "-";  }
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
																	<td class="intxt" idth="105" align="left">From <?=$ageFrom?> to <?=$ageTo?></td>
																  </tr>
																 
																  <tr>
																	<td class="intxt" align="left">Height</td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><?=$partnerHeightFrom?>ft to <?=$partnerHeightTo?>ft</td>
																  </tr>
																   <tr>
																	<td class="intxt" align="left">Looking for </td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><?=$partnerMaritalStatus?></td>
																  </tr>
																   <tr>
																	<td class="intxt"align="left">Physical Status </td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><?=$partnerPhysicalStatus?></td>
																  </tr>
																  <tr>
																	<td class="intxt"align="left">Mother Tongue  </td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><?=$partnerMotherTongue?></td>
																  </tr>
																   <tr>
																	<td class="intxt"align="left">About My Partner</td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><?=$aboutLifePartner?></td>
																  </tr>
																 </table>	
															</div>
															<div id="service2" style="display:none">
																<table width="95%" border="0" cellspacing="0" cellpadding="5">
																 
																  <tr>
																	<td class="intxt"align="left">Religion</td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><? if($partnerReligion==0) { echo "--"; } else  { echo GetSingleField("religion","tbl_religion_master","id",$partnerReligion); }?></td>
																  </tr>
																  <tr>
																	<td class="intxt" align="left">Manglik</td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><? 
																	if ($partnerSevvaiDosham == 3)
																	  echo "Doesn't matter"; 
																	 elseif($partnerSevvaiDosham == 1)
																	   echo "Yes";
																	  else 
																	  echo "No";  ?>
																	 </td>
																  </tr>
																  <tr>
																	<td class="intxt" align="left">Caste/Division</td>
																	<td class="intxt">:</td>
																	<td class="intxt" align="left"><? if($partnerCaste==0) { echo "--"; } else  { echo $partnerCaste; }?> </td>
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
																	<td class="intxt" idth="105" align="left"><?=GetSingleField("state","tbl_state_master","id",$partnerResidingState)?></td>
																  </tr>
																   <tr>
																	<td class="intxt" width="124" align="left">Residing City</td>
																	<td width="25" class="intxt">:</td>
																	<td class="intxt" idth="105" align="left"><?=GetSingleField("city","tbl_city_master","id",$partnerResidingCity)?></td>
																  </tr>
																  
																  
																 
																 </table>	
															</div>
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
								
								
								</td></tr>
								
								
							</table>
							</td></tr></table>
							
						</form>	
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
