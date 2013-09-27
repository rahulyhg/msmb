<?php
@ob_start();
@session_start();
include("includes/lib.php");
include_once("includes/matchprofile.php");

# check login user
isMember();

$action = GetVar("action");
$action1 = GetVar("action1");
$user = GetSingleRecord("tbl_register","id",$config[userinfo][id]);

//echo $config[userinfo][id]."---";

$country_cmb = GetCountry1();

if ($action == "deleteimage") {

	//remove photo
	$photoid = GetVar("id");
	$resPhoto = Execute("select * from tbl_photo where id = '" . $photoid . "' and userid='" . $user['id'] . "'");
	if (mysql_num_rows($resPhoto)>0) {
		$userphoto = mysql_fetch_array($resPhoto);
		if ($userphoto[photo]) {
			removeFile("userimages/" . $userphoto[photo]);
			removeFile("userthumbnail/" . $userphoto[photo]);
			removeFile("usernormal/" . $userphoto[photo]);
			removeFile("userenlarge/" . $userphoto[photo]);
		}				
		
		$res = Execute("delete from tbl_photo where id = '" . $photoid . "'");		
		$msg = "Photo deleted successfully";
	}
	$_SESSION['msg'] = $msg;
	header("Location: thanks.php?id=6");
	die();
	
} else if ($action == "delete") {	

	//remove photos if any
	$resPhoto = Execute("select * from tbl_photo where userid='" . $user['id'] . "'");
	
	if (mysql_num_rows($resPhoto)>0) {
	
		while ($userphoto = mysql_fetch_array($resPhoto)) {
		
			if ($userphoto[photo]) {
				removeFile("userimages/" . $userphoto[photo]);
				removeFile("userthumbnail/" . $userphoto[photo]);
				removeFile("usernormal/" . $userphoto[photo]);
				removeFile("userenlarge/" . $userphoto[photo]);
			}
							
		}
		
		$res = Execute("delete from tbl_photo where userid='" . $user['id'] . "'");		
	}
	
	//remove interest if any
	$userinterest = GetSingleRecord("tbl_interests","userid",$user['id']);	
	if ($userinterest) {
		Execute("delete from tbl_interests where userid = '" .$user['id'] . "'");		
	}
	
	//remove horoscope if any
	if ($user[horoscope]) { removeFile("horoscope/" . $user[horoscope]); }
	
	//remove profile if any
	$sql = Execute("delete from tbl_register where id='" . $user['id'] . "'");
	
	/*$impfields = array (
		"id",
		"uniqueID",
		"registration_date",
		"username",
		"password",
		"email",
		"domain",
		"enable",
		"membership_type",
		"package_expiry_date",
		"lastLogin",
	);		
	$tablefields = split(",",GetFieldList("tbl_register"));	
	foreach ($impfields as $field) {
		if (in_array($field,$tablefields)) {
		} else {
			
		}	
	}
	*/
	
	session_destroy();
	header("Location: index.php");
	die();
	
} else if ($action == "update") {
	
	
	if ($_REQUEST['mydateM']) {
		$_REQUEST['date_of_birth'] = $_REQUEST['mydateY'] . '-' . $_REQUEST['mydateM'] . '-' . $_REQUEST['mydateD'];
	}
	
	if ($_REQUEST['country'] && $_REQUEST['country'] != 'Others') {
		$_REQUEST['country_1'] = '';
	} else if ($_REQUEST['country_1']) {
		$_REQUEST['country'] = '';
	}
	
	if ($_REQUEST['state'] && $_REQUEST['state'] != 'Others') {
		$_REQUEST['state_1'] = '';
	} else if ($_REQUEST['state_1']) {
		$_REQUEST['state'] = '';
	}
	
	if ($_REQUEST['city'] && $_REQUEST['city'] != 'Others') {
		$_REQUEST['city_1'] = '';
	} else if ($_REQUEST['city_1']) {
		$_REQUEST['city'] = '';
	}
	
	if ($_REQUEST['residingCountry'] && $_REQUEST['residingCountry'] != 'Others') {
		$_REQUEST['residingCountry_1'] = '';
	} else if ($_REQUEST['residingCountry_1']) {
		$_REQUEST['residingCountry'] = '';
	}
	
	if ($_REQUEST['residingState'] && $_REQUEST['residingState'] != 'Others') {
		$_REQUEST['residingState_1'] = '';
	} else if ($_REQUEST['residingState_1']) {
		$_REQUEST['residingState'] = '';
	}
	
	if ($_REQUEST['residingCity'] && $_REQUEST['residingCity'] != 'Others') {
		$_REQUEST['residingCity_1'] = '';
	} else if ($_REQUEST['residingCity_1']) {
		$_REQUEST['residingCity'] = '';
	}
	
	if ($_REQUEST['citizenship'] && $_REQUEST['citizenship'] != 'Others') {
		$_REQUEST['citizenship_1'] = '';
	} else if ($_REQUEST['citizenship_1']) {
		$_REQUEST['citizenship'] = '';
	}
	
	if ($_REQUEST['caste'] && !$_REQUEST['nocaste']) {
		$_REQUEST['nocaste'] = '0';		
	}
	
	//echo $_REQUEST['nationality'] .','. $_REQUEST['nationality_1'];
	//die();
	
	if ($_REQUEST['nationality'] && $_REQUEST['nationality'] != 'Others') {
		$_REQUEST['nationality_1'] = '';
	} else if ($_REQUEST['nationality_1']) {		
		$_REQUEST['nationality'] = '';
	}
	
			
	if ($_REQUEST['email']) {
		if ($_REQUEST['email'] != $user[email]) {
			$mail = GetSingleRecord("tbl_register","email",$_REQUEST['email']);
			if ($mail) {
				$_SESSION['msg'] = "Email address already exist";
				header("Location: error.php?id=26");
				die();
			}
		}	
	}		
			
	if ($_REQUEST['income']) {
		$_REQUEST['income'] = str_replace(",","",$_REQUEST['income']);	
	}	
	
	if ($_REQUEST['franchisees_autoid']) {
		$_REQUEST['franchisees_id'] = GetSingleField("franchisee_id","tbl_franchisee","auto_id",$_REQUEST['franchisees_autoid']);
	}
	
	if (!is_dir("horoscope")) {
		mkdir("horoscope");
		chmod("horoscope",0777);
	}
	
			
	if ($HTTP_POST_FILES['horoscope1']['name'] != "") {		
		if ($user[horoscope]) { removeFile("horoscope/" . $user[horoscope]); }			
		$_REQUEST['horoscope'] = post_img($HTTP_POST_FILES['horoscope1']['name'], $HTTP_POST_FILES['horoscope1']['tmp_name'],"horoscope");
	}
		
	if ($_REQUEST['countryCode'] && $_REQUEST['areaCode'] && $_REQUEST['phoneNumber']) {
		$_REQUEST['phoneNumber'] = $_REQUEST['countryCode'] . "-" . $_REQUEST['areaCode'] . "-" . $_REQUEST['phoneNumber'];	
	}
	
	if ($action1 == "hobbies") {
		ProcessInterests($_REQUEST,$_SESSION['id_user']);
	}	
		
	if ($action1 == "lookingfor") {

	
		if ($_REQUEST['partnerDomain']) {
			$_REQUEST['partnerDomain'] = implode(",",$_REQUEST['partnerDomain']);
		} else {
			$_REQUEST['partnerDomain'] = '';
		}
		
		if ($_REQUEST['partnerMaritalStatus']) {	
			$_REQUEST['partnerMaritalStatus'] = implode(",",$_REQUEST['partnerMaritalStatus']);
		} else {
			$_REQUEST['partnerMaritalStatus'] = '';
		}
		
		if ($_REQUEST['partnerEducation']) {		
			$_REQUEST['partnerEducation'] = implode(",",$_REQUEST['partnerEducation']);
		} else {
			$_REQUEST['partnerEducation'] = '';
		}
		
		if ($_REQUEST['partnerCitizenship']) {	
			$_REQUEST['partnerCitizenship'] = implode(",",$_REQUEST['partnerCitizenship']);
		} else {
			$_REQUEST['partnerCitizenship'] = '';
		}
		
		if ($_REQUEST['partnerCountryLiving']) {	
			$_REQUEST['partnerCountryLiving'] = implode(",",$_REQUEST['partnerCountryLiving']);
		} else {
			$_REQUEST['partnerCountryLiving'] = '';
		}
		
		if ($_REQUEST['partnerResidingState']) {
			$_REQUEST['partnerResidingState'] = implode(",",$_REQUEST['partnerResidingState']);
		} else {
			$_REQUEST['partnerResidingState'] = '';
		}
		
		if ($_REQUEST['partnerResidingCity']) {
			$_REQUEST['partnerResidingCity'] = implode(",",$_REQUEST['partnerResidingCity']);
		} else {
			$_REQUEST['partnerResidingCity'] = '';
		}
		
		if ($_REQUEST['partnerReligion']) {	
			$_REQUEST['partnerReligion'] = implode(",",$_REQUEST['partnerReligion']);
		} else {
			$_REQUEST['partnerReligion'] = '';
		}
		if ($_REQUEST['partnerCaste']) {	
			$_REQUEST['partnerCaste'] = implode(",",$_REQUEST['partnerCaste']);
		} else {
			$_REQUEST['partnerCaste'] = '';
		}	
	}
	//$sql_del = "delete from tbl_match_profile where userid = '" . $config[userinfo][id] . "'";
	//$res_del =  Execute($sql_del);
	$sql = DTMLUpdateRecord($config[userinfo][id],"tbl_register",$_REQUEST);


	$res = Execute($sql);
	$msg = "Profile Updated successfully";
	
	if (!is_dir("userimages")) {
		mkdir("userimages");
		chmod("userimages",0777);
	}
	
	if ($HTTP_POST_FILES['photo1']['name'] != "") {			
		$photo1 = post_img($HTTP_POST_FILES['photo1']['name'], $HTTP_POST_FILES['photo1']['tmp_name'],"userimages");
		$sql = "insert into tbl_photo(userid,photo) values('" . $_SESSION['id_user'] . "','$photo1')";
		$imgRes = Execute($sql);
	}
	
	if ($HTTP_POST_FILES['photo2']['name'] != "") {			
		$photo2 = post_img($HTTP_POST_FILES['photo2']['name'], $HTTP_POST_FILES['photo2']['tmp_name'],"userimages");
		$sql = "insert into tbl_photo(userid,photo) values('" . $_SESSION['id_user'] . "','$photo2')";
		$imgRes = Execute($sql);
	}
	
	if ($HTTP_POST_FILES['photo3']['name'] != "") {			
		$photo3 = post_img($HTTP_POST_FILES['photo3']['name'], $HTTP_POST_FILES['photo3']['tmp_name'],"userimages");
		$sql = "insert into tbl_photo(userid,photo) values('" . $_SESSION['id_user'] . "','$photo3')";
		$imgRes = Execute($sql);
	}
	
	PartnerMatch :: InsertMatch($config[userinfo][id]);
	
	$_SESSION['msg'] = $msg;
	header("Location: thanks.php?id=7");
	die();
}

$pagename = "edit_my_profile.php";

# Get user information
$user = GetSingleRecord("tbl_register","id",$config[userinfo][id]);
extract($user,EXTR_REFS);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/my_profile.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" src="includes/validate.js"></script>
<!--SCRIPT language=JavaScript src="includes/photoslider.js" type=text/javascript></SCRIPT-->
<?
require("includes/photoslider.php");
?>
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

function confirm1() {
	var delMesg = "Are you confirm to delete your profile";
	if (confirm(delMesg)) {
		location.href = "editprofile.php?action=delete";
	}
}
//-->
</script>
</head>
<body class="homeinbody">
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
					<table width="754" border="0" cellspacing="0" cellpadding="0" <? if ($action1 == 'lookingfor') { ?> class="editpartner" <? } else { ?> class="editpro" <? } ?> align="center">
					  <tr>
						<td width="348" height="27">&nbsp;</td>
						<td width="119" valign="top" ><a href="my_profile.php" class="epro"><strong>My Profile</strong></a></td>						
						<? if ($action1 != 'lookingfor') { ?>
						<td width="119"align="center" style="padding-bottom:7px;">&nbsp;<strong class="protxt">Edit My Profile</strong></td>
						<td valign="top"><a href="edit_my_profile.php?action1=lookingfor" class="epart"><strong> Edit Partner Preference</strong></a></td>
						<? } else { ?>	
						<td width="120" align="left" valign="top"><a href="edit_my_profile.php" class="epro">&nbsp;<strong>Edit My Profile</strong></a></td>
						<td width="168" align="center" style="padding-bottom:7px;" tyle="padding:0px 0px 35px 0px;"><strong class="protxt">Edit Partner Preference&nbsp;&nbsp;&nbsp;</strong></td>					
						<? } ?>
					 </tr>
					  <tr>
						<td colspan="4" height="20" align="center" valign="top"><font class="protxt"><a href="edit_my_profile.php?action1=basic" class="proink">Basic Details</a>|<a href="edit_my_profile.php?action1=occupation" class="proink">Occupation / Family details</a>|<a href="edit_my_profile.php?action1=physical" class="proink">Physical Details</a>|<a href="edit_my_profile.php?action1=hobbies" class="proink">Interest / Hobbies details</a>|<a href="edit_my_profile.php?action1=lookingfor" class="proink"> Expectation / Looking for</a></font></td>
					  </tr>
					</table>
				</td>
			  </tr>
			  <tr>
				<td style="padding-top:10px;" align="center" class="mainbdr">
					<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" <? if ($action1 == 'basic' or !$action1) { ?>  class="topictitlebg" <? } ?>>
					<? if ($action1 == 'basic' or !$action1) { ?>	
					  <tr>
						<td width="161" align="left" style="padding:5px 5px 9px 47px;" height="16"><h3 class="topic">Profile Details</h3></td><td width="254">&nbsp;</td>
						<td width="314" colspan="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td class="tbdrlft" align="center">
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
													if ($id == $config[userinfo][id]) { 
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
												<?	} else { ?>
													<script>
														photos["<?=$i?>"] = "images/nopicture.png";
													</script>																	
												<?	}
												} ?>										
										<script>
											if (linkornot==0)
												document.write("<a href=\"javascript:PhotoManager('<?=$user[id]?>')\">")
												if (photos[0] == 'images/addphoto.gif') {	
													document.write('<a href="add_photo.php"><img src="'+photos[0]+'" name="photoslider" style="filter:revealTrans(duration=1,transition=2); border:#333333 1px solid;" border=0 width=150 height=160></a>')
													document.write('<br><a href="add_photo.php" class="pagenum">Add Photo</a>')
												} else {
													document.write('<img src="'+photos[0]+'" name="photoslider" style="filter:revealTrans(duration=1,transition=2); border:#333333 1px solid;" border=0 width=150 height=160>')
												}	
											if (linkornot==0)
												document.write('</a>')
										</script>
										</td>
									</tr>
								<? if (mysql_num_rows($resPhoto) > 0) {?>	
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
								<td class="intxt" width="105" align="left"><a href="my_profile.php" class="moreid"><?=$username?></a></td>
							  </tr>
							  <tr>
								<td class="intxt"align="left">Profile Created on</td>
								<td class="intxt">:</td>
								<td class="intxt" align="left"><?=strftime("%d %b %Y",strtotime($registration_date))?></td>
							  </tr>
							  <tr>
								<td class="intxt" align="left">Package Expire</td>
								<td class="intxt">:</td>
								<td class="intxt" align="left"><?=strftime("%d %b %Y",strtotime($package_expiry_date))?></td>
							  </tr>
							  <tr>
								<td class="intxt" align="left">Last Login</td>
								<td class="intxt">:</td>
								<td class="intxt" align="left"><?=strftime("%d %b %Y",strtotime($lastLogin))?></td>
							  </tr>
							</table>
						</td>
						<td class="tbdrrgt" align="center">
							<table width="254" border="0" cellspacing="0" cellpadding="5">
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
								<td class="intxt" align="left">Login ID</td>
								<td class="intxt">:</td>
								<td class="intxt" align="left"><?=$username?></td>
							  </tr>							  
							</table>
						</td>
					  </tr>
					  <tr>
						<td colspan="3" valign="bottom"><img src="images/topic_bg_bottom.jpg" border="0"/></td>
					  </tr>
					  <? } ?>
					</table>
				</td>
			  </tr>
			  <tr>
				<td style="padding-top:10px;" align="center" class="mainbdr">
				<?  if ($action1 == "basic" || $action1 == "" ) {	?>						
					<form name="thisForm" action="edit_my_profile.php" method="post" onSubmit="return fnRegister();">
					<input type="hidden" name="action" value="update">
					<input type="hidden" name="action1" value="<?=$action1?>">					
				  <? include("common/basicdetails1.php") ?>		  
					</form>
				</td>
 			  </tr>			  
			  <?  } else if ($action1 == "occupation") {	?>
					<form name="thisForm" action="edit_my_profile.php" method="post" onSubmit="return fnRegister1()" enctype="multipart/form-data">
						<input type="hidden" name="action" value="update">
						<input type="hidden" name="action1" value="<?=$action1?>">
							<?	include("common/occupationdetails1.php"); ?>
							<? if (GetVar('cursor') == 'phone' && $phoneNumber) { ?>
								<script language="javascript">									
									document.thisForm.phoneNumber.focus();
								</script>
							<? } else if (GetVar('cursor') == 'phone' && $mobileNumber) { ?>
								<script language="javascript">									
									document.thisForm.mobileNumber.focus();
								</script>
							<? } ?>
					</form>		
			  <?  } else if ($action1 == "physical") {	?>
					<form name="thisForm" action="edit_my_profile.php" method="post" onSubmit="return fnRegister3();">
						<input type="hidden" name="action" value="update">
						<input type="hidden" name="action1" value="<?=$action1?>">											
							<?	include("common/physicaldetails1.php"); ?>							
					</form>	
			 <?   } else if ($action1 == "hobbies") {	?>
					<form name="thisForm" action="edit_my_profile.php"  method="post">
						<input type="hidden" name="action" value="update">
						<input type="hidden" name="action1" value="<?=$action1?>">
							<?	include("common/hobbiesdetails1.php"); ?>					
					</form>			
				<?
					if ($action1 == "hobbies") {	
						$res = Execute("select * from tbl_interests where userid='" . $_SESSION['id_user'] . "'");
						if (mysql_num_rows($res)>0) {
							while ($rs = mysql_fetch_array($res)) {				
								?>
								<script language="javascript">
									SelHobbies('<?=$rs['interest']?>','<?=$rs['type']?>');
								</script>
								<?		
							}		
						}
					}										
			   } else if ($action1 == "lookingfor") {	?>
						<form name="thisForm" action="edit_my_profile.php" method="post">
							<input type="hidden" name="action" value="update">
							<input type="hidden" name="action1" value="<?=$action1?>">
							<?	include("common/partnerdetails1.php"); ?>
						</form>		
		   <?  }  ?>
		   <? if ($action1 == 'basic' or !$action1) { ?>
			 <!-- <tr>
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
											<td class="intxt" width="105" align="left"><?=$username?></td>
										  </tr>
										  <tr>
											<td class="intxt"align="left">Profile Created on</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=strftime("%d %b %Y",strtotime($registration_date))?></td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Package Expire</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=strftime("%d %b %Y",strtotime($package_expiry_date))?></td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Last Login</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=strftime("%d %b %Y",strtotime($lastLogin))?></td>
										  </tr>
										</table>
									</td>
									<td class="tbdrrgt" align="center">
										<table width="90%" border="0" cellspacing="0" cellpadding="5">
										  <tr>
											<td class="intxt" width="124" align="left">Name</td>
											<td class="intxt" width="25">:</td>
											<td class="intxt" width="105" align="left"><?=$name?></td>
										  </tr>
										  <tr>
											<td class="intxt"align="left">Membership</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=ereg_replace('package','',GetSingleField("package_name","tbl_packages","package_id",$membership_type));?></td>
										  </tr>
										  <tr>
											<td class="intxt" align="left">Login ID</td>
											<td class="intxt">:</td>
											<td class="intxt" align="left"><?=$username?></td>
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
 			  </tr>-->
			  <? } ?>
			  </table>
		</td>
	</tr>	
	<? include("includes/fotter.php") ?>
</table>
</div>
</body>
</html>
