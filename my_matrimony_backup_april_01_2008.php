<?php
ob_start();
session_start();
include("includes/lib.php");
include_once("includes/matchprofile.php");
isMember();

$action = GetVar("action");

/*$sql="select a.*,b.package_name,DATE_FORMAT(a.registration_date,'%d.%m.%Y')as registration_date,DATE_FORMAT(a.lastLogin,'%d.%m.%Y')as lastLogin  from tbl_register a,tbl_packages b where a.membership_type=b.package_id and a.id=".$_SESSION['id'];
$res=mysql_query($sql);
if(mysql_num_rows($res)>0){
	$obj=mysql_fetch_object($res);
}
*/

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/my_matrimony.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" src="includes/validate.js"></script>
<script language="JavaScript" src="includes/functions.js"></script>
<!--<SCRIPT language=JavaScript src="includes/photoslider.js" type=text/javascript></SCRIPT>-->
<? require_once("includes/photoslider.php"); ?>
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
<body class="homeinbody" onLoad="MM_preloadImages('images/inner_title_bg.jpg','images/dsn_title.gif')">
<div class="menuleftimg">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
    <td align="right"><? fnBannerImage('my_matrimony','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>   
  <tr>
    <td colspan="2" valign="top">
		<? include("includes/side_menu.php"); ?>
		<div style="margin:12px 0px 0px 9px;  float:left;">
			<table width="580" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td>
					<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td>
					<div class="titlebg">
					  <h1 class="title">My matrimony</h1>
					</div>
					</td>
					<td align="right" class="title">					
						<strong style="color:#E76C08; font-size:13px;">Welcome <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
					</td></tr></table>
				</td>
			  </tr>
			  <tr>
				<td style="padding-top:5px;">
					<table width="100%" border="0" cellspacing="1" cellpadding="5" bgcolor="#c0ba84">
					  <tr>
						<td width="10%" rowspan="6" bgcolor="#FFFFFF">
							<table width="22%" border="0" cellspacing="0" cellpadding="0">
								  <tr><td colspan="3">										
										<?
												$partnerPref_notcompleted = isPartnerPreferenceNotCompleted($config[userinfo][id]);	
												
												$resPhoto = Execute("select * from tbl_photo where userid = '".$config[userinfo][id]."'");												
												$i = 0;
												
												$user_photo_no = mysql_num_rows($resPhoto);
																								
												if (mysql_num_rows($resPhoto) > 0) {
												
													while ($memPhoto = mysql_fetch_array($resPhoto)) { ?>
													
														<script>				
															photos["<?=$i?>"] = "usernormal/<?=$memPhoto[photo]?>";
														</script>																			
														
														<?																														
														$i++;
																
													} 
													
												} else {
												
													
														$resPhoto1 = Execute("select * from tbl_photo where userid = '".$_SESSION['id']."' and approve = 0");
														if (mysql_num_rows($resPhoto1) > 0) { ?>																		
															<script>
																photos["<?=$i?>"] = "images/pendpicture.png";
															</script>
													 <? } else { ?>											
															<script>
																photos["<?=$i?>"] = "images/addphoto.gif";
															</script>																		
														<!--<a href="add_photo.php" class="pagenum">Add Photo</a>-->
													 <? } 
												
												} ?>										
										<script>
											if (linkornot==0)
												document.write("<a href=\"javascript:PhotoManager('<?=$_SESSION['id']?>')\">")
												if (photos[0] == 'images/addphoto.gif') {	
													document.write('<a href="add_photo.php"><img src="'+photos[0]+'" name="photoslider" style="filter:revealTrans(duration=1,transition=2); border:#333333 1px solid;" border=0 width=150 height=160></a>')
													document.write('<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_photo.php" class="idclr">Add Photo</a>')
												} else {
													document.write('<img src="'+photos[0]+'" name="photoslider" style="filter:revealTrans(duration=1,transition=2); border:#333333 1px solid;" border=0 width=150 height=160>')
												}	
											if (linkornot==0)
												document.write('</a>')
										</script>
										</td>
									</tr>
									<? if (mysql_num_rows($resPhoto) > 1) { ?>
								  <tr>
								  <td align="right" class="btxt" height="30"><a href="#" onClick="backward();return false"><img src="images/arrow_left.jpg" border="0"/></a>&nbsp;</td>
								  <td width="5%"><a href="#" onClick="backward();return false" class="moreid"><div id="imgNum">1</div></a></td>
								  <td align="left">&nbsp;<a href="#" onClick="forward();return false"><img src="images/arrow_right.jpg" border="0"/></a></td></tr>
								  <? } ?>
							  </table>	
						</td>
						<td  rowspan="6" bgcolor="#FFFFFF" valign="top">
							<table width="220" border="0" cellspacing="5" cellpadding="0"  class="btxt">
							  <tr><td height="20" colspan="3"><strong style="color:#ff8101;"><? echo $config[userinfo][name];?></strong></td></tr>
							  <tr><td height="20" width="51%">ID No</td><td width="7%">:</td><td width="42%"><a href="my_profile.php" class="idclr"><? echo $config[userinfo][username];?></a></td></tr>
							  <tr><td height="20">Member Status</td><td>:</td><td><?=ereg_replace('package','',GetSingleField('package_name','tbl_packages','package_id',$config[userinfo][membership_type]));?></td></tr>							  
							  <tr><td height="20">Profile Created by</td><td>:</td><td><? echo $config[userinfo][registerby];?></td></tr>
							  <tr><td height="20">Profile Created on</td><td>:</td><td><? echo strftime("%d %b %Y",strtotime($config[userinfo][registration_date]));?></td></tr>
							  <tr><td height="20">Last Login</td><td>:</td><td><? echo strftime("%d %b %Y",strtotime($config[userinfo][lastLogin]));?></td></tr>							 
							</table>
						</td>												
						<? if ($user_photo_no <= 0) { ?>
							<td  bgcolor="#FFFFFF"><img src="images/icon_add.gif" align="absmiddle" border="0"/>&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_photo.php" class="orng"><span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;Add Photos] body=[You can upload upto 3 photos]">Add Photos</span></a></td></tr>
						<? } else { ?>	
							<td  bgcolor="#FFFFFF"><img src="images/icon_add.gif" align="absmiddle" border="0"/>&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_photo.php" class="orng"><span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;Change Photos] body=[Change your photos]">Change Photos</span></a></td></tr>
						<? } ?>						 					  
						</tr>
					  <? if ($config[userinfo][horoscope]) { ?>
					  <tr><td bgcolor="#FFFFFF"><img src="images/icon_add_hor.gif" align="absmiddle" border="0"/>&nbsp;&nbsp;<a href="add_horoscope.php" class="orng"><span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;Change Horoscope] body=[Change your horoscope]">View Horoscope</span></a></td></tr>					  
					  <? } else { ?>
					  <tr><td bgcolor="#FFFFFF"><img src="images/icon_add_hor.gif" align="absmiddle" border="0"/>&nbsp;&nbsp;<a href="add_horoscope.php" class="orng"><span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;Add Horoscope] body=[Generate your Horoscope FREE in 9 different indian languages and also Match your Horoscope with any another member using -Horoscope Match]">Add Horoscope</span></a></td></tr>
					  <? } ?>
					  					  
					  <tr><td bgcolor="#FFFFFF"><img src="images/icon_phon.gif" align="absmiddle" border="0"/>&nbsp;&nbsp;<a href="edit_my_profile.php?action1=occupation&cursor=phone" class="orng"><span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;Phone Number] body=[Change your Phone Number]">Change Phone No</span></a></td></tr>
					  <tr><td bgcolor="#FFFFFF" width="200"><img src="images/icon_search.gif" align="absmiddle" border="0"/>&nbsp;&nbsp;<a href="edit_my_profile.php?action1=lookingfor" class="orng">
					  <? if ($partnerPref_notcompleted) { ?>					    
					  		<span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;Partner Preference] body=[Set your partner preference and Get your match with photos.]">
					  		Set Partner Preference
							</span>
					  <? } else { ?>
						  	<span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;Partner Preference] body=[Edit your Partner preference]">
							Edit Partner Preference	
							</span>
					  <? }  ?>		
					  	
					  </a>
					  </td></tr>
					  <tr><td bgcolor="#FFFFFF">					  
					  <img src="images/icon_login.gif" align="absmiddle" border="0"/>&nbsp;&nbsp;<a href="member_change_password.php" class="orng">&nbsp;
					  <span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;Change Password] body=[Change Your Password]">Change Password</span>
					  </a></td></tr>
					  <tr><td bgcolor="#FFFFFF">
					  <img src="images/icon_account.gif" align="absmiddle" border="0"/>&nbsp;&nbsp;<a href="myaccount.php" class="orng">
					  <span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;My Account] body=[Details of your Membership]">My Account</span>
					  </a></td></tr>
					</table>
				</td>
			  </tr>
			  <? 
								$arr_physical = array(
									"height",
									"bodyType",
									"physicalStatus",
									"eatingHabits",
									"smoking",
									"drink",
									"bloodGroup",
									"languageKnown",
									"personality",								
								);
															
								$phycial_notcompleted = true;
								for ($i = 0; $i < count($arr_physical); $i++) {
									if (GetSingleField($arr_physical[$i],"tbl_register","id",$config["userinfo"][id])) {
										unset($phycial_notcompleted);
										break;
									}
								}
								
								$hobbies_completed = GetSingleRecord("tbl_interests","userid",$config["userinfo"][id]);
								$photo_uploaded = GetSingleRecord("tbl_photo","userid",$config["userinfo"][id]);															
														
								
								# count	of interest received							 
								$sql = "select * from tbl_express_interest where recipient = '" . $config["userinfo"][id]  . "' and accept = 0 and reject = 0 ";
								$exp_res = Execute($sql);
								$interest_received1 = mysql_num_rows($exp_res);
								$sql = "select * from tbl_express_interest where recipient = '" . $config["userinfo"][id]  . "' and accept = 1 ";
								$exp_res = Execute($sql);
								$no_of_accept = mysql_num_rows($exp_res);
								$sql = "select * from tbl_express_interest where recipient = '" . $config["userinfo"][id]  . "' and reject = 1 ";
								$exp_res = Execute($sql);
								$no_of_reject = mysql_num_rows($exp_res);
								$interest_received = $interest_received1 + $no_of_accept + $no_of_reject;
								
								# count	of interest sent							 
								$sql = "select * from tbl_express_interest where sender = '" . $config["userinfo"][id]  . "' and accept = 0 and reject = 0 ";
								$exp_res = Execute($sql);
								$interest_sent1 = mysql_num_rows($exp_res);
								$sql = "select * from tbl_express_interest where sender = '" . $config["userinfo"][id]  . "' and accept = 1 ";
								$exp_res = Execute($sql);
								$no_of_accept1 = mysql_num_rows($exp_res);
								$sql = "select * from tbl_express_interest where sender = '" . $config["userinfo"][id]  . "' and reject = 1 ";
								$exp_res = Execute($sql);
								$no_of_reject1 = mysql_num_rows($exp_res);
								$interest_sent = $interest_sent1 + $no_of_accept1 + $no_of_reject1;
								
							?>	
			  <tr>
			  	<td style="padding-top:2px;">
					<table width="100%" border="0" cellspacing="1" cellpadding="4" bgcolor="#c0ba84">
						<tr bgcolor="#ede596" class="btxt"><td>
							<? if ($_SESSION['package_id']) { ?>
									<a href="upgrade_membership.php" class="idclr">Click here</a>  to become a <?=ereg_replace('package','',GetSingleField('package_name','tbl_packages','package_id',$config[userinfo][membership_type]));?> member.	
							<? } else if ($config[userinfo][membership_type] == 1) { ?>
									<a href="upgrade_membership.php" class="idclr">Click here</a>  to become a paid member.
							<? } else { ?>
									<a href="upgrade_membership.php" class="idclr">Click here</a>  to upgrade your membership.
							<? } ?>
						</td></tr>
					</table>
				</td>
			  </tr>
			  <tr>
			  	<td style="padding-top:10px;">
					<table width="580" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td class="mmachbg" align="left" style="padding:0px 0px 0px 55px;"><h2 class="subtitle">My Matches</h2></td>
					  </tr>
					  <tr>
						<td class="mtxt" style="padding:10px 0px 10px 0px;">
							<table width="20%" align="center" border="0" cellspacing="0" cellpadding="3">
							  <tr>
			 					<td>
								 <?
								 
								# Insert Match Profiles
								PartnerMatch :: InsertMatch($config[userinfo][id]); 								
								
								# Get Match Profiles
								$id = PartnerMatch :: GetPartnerMatch($config[userinfo][id]);								
								
								
								//$resQry = "select *,tbl_register.id as RegId from tbl_register LEFT JOIN tbl_photo ON tbl_register.id = tbl_photo.userid where tbl_register.hideProfile = '0' and tbl_register.deleteProfile = '0' and tbl_register.id in($id) ";
								//$resQry ="select *,tbl_register.id as RegId from tbl_register INNER JOIN tbl_photo ON tbl_register.id = tbl_photo.userid where tbl_register.enable = '1' and tbl_register.verifiedStatus = '1' and tbl_register.featuredProfile = '1' and tbl_photo.thumbnail !='' and tbl_photo.approve = 1 ";
								//$resQry .= " and tbl_register.id != '" . $config[userinfo][id] . "' ";
								//$resQry .= "group by tbl_photo.userid limit 0,5";
								$resQry = "select * from tbl_register where hideProfile = '0' and deleteProfile = '0' and id in($id) limit 0,5";									
								$res = Execute($resQry);								
								
								if (mysql_num_rows($res) > 0) {
									$numImages = mysql_num_rows($res);
								 ?>
								<div>
									<table border="0" cellpadding="0" cellspacing="2" width="500" align="left" tyle="border:#00FF00 1px solid;">
										<tr>
											<td align="left" valign="top">
												<div  style="DISPLAY: block; POSITION: relative; overflow:hidden; padding-top:0px; padding-bottom:0px; height:110px; width:400;" align="left">
													<div id="conveyor" style="position:relative;" align="left">
														<table align="left" border="0" cellpadding="0" cellspacing="0">
															<tr>
																				<? 
																$total_width = 0;												
																while($feature_profile = mysql_fetch_array($res)) {						 												
																	
																	$resImage = Execute("select * from tbl_photo where userid='" .$feature_profile[id]. "' and approve = 1");
																	$rsImage = mysql_fetch_array($resImage);
																?>
															
																	<td align="center" width="100" style="padding:3px" align="left" valign="top">
																			<? if ($feature_profile[photo_password]) {?>
																			<img src="images/protectedphoto.gif" hspace="5" style="cursor:pointer" width="60" height="60" onclick="window.location.href='view_member_profile.php?userid=<? echo $feature_profile[username]; ?>'">
																														
																			<? } else { 
																			if ($rsImage[approve] && $rsImage[photo]) {
																			?>
																			<img id="user<?=$feature_profile[id]?>" name="user<?=$feature_profile[id]?>" rc="userthumbnail/<?=$rsImage[thumbnail]?>" src="userthumbnail/<?=$rsImage[photo]?>" hspace="5" style="cursor:pointer" width="75" height="75" onclick="window.location.href='view_member_profile.php?userid=<? echo $feature_profile[username]; ?>'" title="<? echo $feature_profile[username]; ?>">																																		
																			<?
																				} else { 
																					if (GetSingleRecord("tbl_photo","userid",$feature_profile[id])) {																	
																					?>
																						<img id="user<?=$feature_profile[id]?>" name="user<?=$feature_profile[id]?>" rc="userthumbnail/<?=$feature_profile[thumbnail]?>" src="images/pendpicture.png" hspace="5" style="cursor:pointer" width="75" height="75" onclick="window.location.href='view_member_profile.php?userid=<? echo $feature_profile[username]; ?>'" title="<? echo $feature_profile[username]; ?>">																		
																					<?	
																					} else { ?>
																						<img id="user<?=$feature_profile[id]?>" name="user<?=$feature_profile[id]?>" rc="userthumbnail/<?=$feature_profile[thumbnail]?>" src="images/nopicture.png" hspace="5" style="cursor:pointer" width="75" height="75" onclick="window.location.href='view_member_profile.php?userid=<? echo $feature_profile[username]; ?>'" title="<? echo $feature_profile[username]; ?>">																		
																					<?
																					}
																				}	
																			} 
																			$mem_dob = explode("-",$feature_profile[date_of_birth]);
																			$mem_dob_year = $mem_dob[0];
																			$mem_dob_date = $mem_dob[2];
																			$mem_dob_month = $mem_dob[1];
																			
																			?>																			
																			<a href="view_member_profile.php?userid=<?=$feature_profile[username]?>" class="idclr"><?=$feature_profile[username]?></a><br><strong style="color:#ff8101;"><?=$feature_profile[name] . " (" . DOB2Age($mem_dob_year,$mem_dob_date,$mem_dob_month) . " )";?></strong>
																		</td>
																<? 
																	}																				 
																?>			
															</tr>															
														</table>
													</div>
												</div>
											</td>
										</tr>
									</table>
								</div>				
							<? } else { ?>					
									<div>
										<table border="0" cellpadding="0" cellspacing="2" width="500" align="left">
											<tr>						
												<td align="left">
													<div style="DISPLAY: block; POSITION: relative; overflow:hidden; padding-top:0px; padding-bottom:0px; height:90px; width:400;" align="left">
														<div id="conveyor" style="position:relative;" align="left">
															<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" style="background:url(images/film.jpg) repeat-x left top; height:90px;" width="300">
																	<tr>
																		<td  width="500" align="center">
																			<? if ($partnerPref_notcompleted) { ?>
																				<a href='edit_my_profile.php?action1=lookingfor' class='idclr'>Click here</a> to set your partner preference and find matches
																			<? } else { ?>
																			No matches found.
																			<? 														
																				echo " <a href='edit_my_profile.php?action1=lookingfor' class='idclr'>Click here</a> to edit your partner preference, get your matches";														
																			?>
																			<? } ?>	
																		</td>
																	</tr>
															</table>
														</div>
												   </div>
											 </td>						 
										 </tr>										
									</table>
								</div>								
							<? } ?>
										
								</td>
							  </tr>						 		
							</table>
						</td>
					  </tr>
					  <tr>
						<td class="morebg" align="right" style="padding-right:30px;"><a href="partner_match.php" class="moreid"><? if (mysql_num_rows($res) > 0) echo "more >>"; ?></a></td>
					  </tr>
					  <tr>
					  	<td style="padding-top:10px;">
							<table width="580" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td class="mmachbg" align="left" style="padding:0px 0px 0px 55px;"><h2 class="subtitle">My Bookmark</h2></td>
							  </tr>
							  <tr>
								<td class="mtxt" style="padding:10px 0px 10px 0px;">
									<table width="20%" align="center" border="0" cellspacing="0" cellpadding="3">
									  <tr>
										<td>
					  		<?			
								$id = GetBookMarkedProfiles($config[userinfo][id]);
								
								//$resQry ="select *,tbl_register.id as RegId from tbl_register LEFT JOIN tbl_photo ON tbl_register.id = tbl_photo.userid where tbl_register.hideProfile = '0' and tbl_register.deleteProfile = '0' and tbl_register.id in($id) ";
								//$resQry ="select *,tbl_register.id as RegId from tbl_register INNER JOIN tbl_photo ON tbl_register.id = tbl_photo.userid where tbl_register.enable = '1' and tbl_register.verifiedStatus = '1' and tbl_register.featuredProfile = '1' and tbl_photo.thumbnail !='' and tbl_photo.approve = 1 ";
								//$resQry .= " and tbl_register.id != '" . $config[userinfo][id] . "'";
								//$resQry .= "group by tbl_photo.userid limit 0,5";
								//$res = Execute($resQry);
								$resQry = "select * from tbl_register where hideProfile = '0' and deleteProfile = '0' and id in($id) limit 0,5";									
								$res = Execute($resQry);
								//echo $resQry;
								//die();
								//echo "num of images =>" . mysql_num_rows($res); 
								if (mysql_num_rows($res) > 0) {
								$numImages = mysql_num_rows($res);
								 ?>
								<div>
									<table border="0" cellpadding="0" cellspacing="2" width="500" align="left" tyle="border:#00FF00 1px solid;">
										<tr>
											<td align="left" valign="top">
												<div  style="DISPLAY: block; POSITION: relative; overflow:hidden; padding-top:0px; padding-bottom:0px; height:110px; width:400;" align="left">
													<div id="conveyor" style="position:relative;" align="left">
														<table align="left" border="0" cellpadding="0" cellspacing="0">
															<tr>
															<? 
																$total_width = 0;
																while($bookmarked_profile = mysql_fetch_array($res)) {						 
																
																	$resImage = Execute("select * from tbl_photo where userid='" .$bookmarked_profile[id]. "' and approve = 1");
																	$rsImage = mysql_fetch_array($resImage);
																?>
																	<td align="center" width="100" style="padding:3px" align="left">
																		<? if ($bookmarked_profile[photo_password]) {?>
																			<img src="images/protectedphoto.gif" hspace="5" style="cursor:pointer" width="60" height="60" onclick="window.location.href='view_member_profile.php?userid=<? echo $bookmarked_profile[username]; ?>'" title="<? echo $bookmarked_profile[username]; ?>">
																		<? } else { 
																				if ($rsImage[approve] && $rsImage[photo]) {
																				?>
																					<img id="user<?=$bookmarked_profile[id]?>" name="user<?=$bookmarked_profile[id]?>" rc="userthumbnail/<?=$rsImage[thumbnail]?>" src="userthumbnail/<?=$rsImage[photo]?>" hspace="5" style="cursor:pointer" width="75" height="75" onclick="window.location.href='view_member_profile.php?userid=<? echo $bookmarked_profile[username]; ?>'" title="<? echo $bookmarked_profile[username]; ?>">																
																						
																				<?
																				} else { 
																					if (GetSingleRecord("tbl_photo","userid",$feature_profile[id])) {																	
																					?>
																						<img id="user<?=$bookmarked_profile[id]?>" name="user<?=$bookmarked_profile[id]?>" rc="userthumbnail/<?=$bookmarked_profile[thumbnail]?>" src="images/pendpicture.png" hspace="5" style="cursor:pointer" width="75" height="75" onclick="window.location.href='view_member_profile.php?userid=<? echo $bookmarked_profile[username]; ?>'" title="<? echo $bookmarked_profile[username]; ?>">
																					<?	
																					} else { ?>
																						<img id="user<?=$bookmarked_profile[id]?>" name="user<?=$bookmarked_profile[id]?>" rc="userthumbnail/<?=$bookmarked_profile[thumbnail]?>" src="images/nopicture.png" hspace="5" style="cursor:pointer" width="75" height="75" onclick="window.location.href='view_member_profile.php?userid=<? echo $bookmarked_profile[username]; ?>'" title="<? echo $bookmarked_profile[username]; ?>">			
																					<?
																					}
																				}	
																			} 
																			$mem_dob = explode("-",$bookmarked_profile[date_of_birth]);
																			$mem_dob_year = $mem_dob[0];
																			$mem_dob_date = $mem_dob[2];
																			$mem_dob_month = $mem_dob[1];
																			?>
																			<a href="view_member_profile.php?userid=<?=$bookmarked_profile[username]?>" class="idclr"><?=$bookmarked_profile[username]?></a><br><strong style="color:#ff8101;"><?=$bookmarked_profile[name] . " (" . DOB2Age($mem_dob_year,$mem_dob_date,$mem_dob_month) . ")"?></strong>
																	</td>	
																<? 
																}																				 
																?>								
															</tr>															
														</table>
													</div>
												</div>
											</td>
										</tr>
									</table>
								</div>					
							<? } else { ?>					
									<div>
									<table border="0" cellpadding="0" cellspacing="2" width="500" align="left">
									<tr>						
										<td align="left">
										<div style="DISPLAY: block; POSITION: relative; overflow:hidden; padding-top:0px; padding-bottom:0px; height:90px; width:400;" align="left">
											<div id="conveyor" style="position:relative;" align="left">
											<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" style="background:url(images/film.jpg) repeat-x left top; height:90px;" width="300">											
											<tr>
												<td  width="500" align="center">
													No bookmarks found.
													<? 														
													   	echo " <a href='search.php' class='idclr'>Click here</a> to search profiles";														
													?>	
												</td>
											</tr>
											</table>
											</div>
											</div>
											</td>						 
										 </tr>										
									</table>
									</div>								
							<? }  ?>	
							</td>
							  </tr>						 		
							</table>
						</td>
					  </tr>					 
					  <tr>
						<td class="morebg" align="right" style="padding-right:30px;"><a href="view_bookmark.php" class="moreid"><? if (mysql_num_rows($res) > 0) echo "more >>"; ?></a></td>
					  </tr>
					  <tr>
						<td style="padding-top:10px;">
							<table width="580" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td width="556" align="left" class="recsent" style="padding:0px 0px 0px 25px;"><div style="padding:0px 58px 0px 0px; float:right;" align="left"><h2 class="subtitle"><a href="express_interest.php?action=sent"  class="orng2" >Express Interest Sent</a></h2></div><h2 class="subtitle" align="left"><a href="express_interest.php?action=received " class="orng2">Express Interest Received</a></h2></td>
							  </tr>
							  <tr>
							  	<td class="rtxt">
									<table width="551" align="center" border="0" cellspacing="0" cellpadding="0" style="padding-left:20px;">
									  <tr>
										<td width="227" rowspan="3">
											<table width="99%" border="0" cellspacing="5" cellpadding="0">
											  <tr>
											    <td class="expressbg"><img src="images/icon_waiting.gif" border="0" hspace="10"/>&nbsp;&nbsp;<a href="express_interest.php?action=received&action1=1"  class="orng1">Pending(<?=$interest_received1?>)</a></td>
											  </tr>
											  <tr><td class="expressbg"><img src="images/icon_regt.gif" border="0" hspace="10"/>&nbsp;&nbsp;<a href="express_interest.php?action=received&action1=2"  class="orng1">Accept(<?=$no_of_accept?>)</a></td></tr>
											  <tr><td class="expressbg"><img src="images/icon_accpt.gif" border="0" hspace="10"/>&nbsp;&nbsp;<a href="express_interest.php?action=received&action1=3" class="orng1">Declined(<?=$no_of_reject?>)</a></td></tr>
											</table>
										</td>
										<td width="101" rowspan="3" align="center"><img src="images/mid_dsn.gif" border="0"/></td>
										<td width="223" rowspan="3">
											<table width="99%" border="0" cellspacing="5" cellpadding="0">
											  <tr><td class="expressbg"><img src="images/icon_waiting.gif" border="0" hspace="10"/>&nbsp;&nbsp;<a href="express_interest.php?action=sent&action1=1" class="orng1">Pending(<?=$interest_sent1?>)</a></td></tr>
											  <tr><td class="expressbg"><img src="images/icon_regt.gif" border="0" hspace="10"/>&nbsp;&nbsp;<a href="express_interest.php?action=sent&action1=2" class="orng1">Accept(<?=$no_of_accept1?>)</a></td></tr>
											  <tr><td class="expressbg"><img src="images/icon_accpt.gif" border="0" hspace="10"/>&nbsp;&nbsp;<a href="express_interest.php?action=sent&action1=3" class="orng1">Declined(<?=$no_of_reject1?>)</a></td></tr>
											</table>
										</td>
									  </tr>
								  </table>
								</td>
							  </tr>
						  </table>
						</td> 						
					  </tr>
					  <tr>
						<td style="padding-top:10px;">
							<table width="580" border="0" cellspacing="0" cellpadding="0">
							 <tr>
								<td class="mmachbg" align="left" style="padding:0px 0px 0px 30px;"><h2 class="subtitle">Membership Details</h2></td>
							 </tr>
							 <tr>
							 	<td class="mtxt" style="border-bottom:1px solid #CCCCCC;">
									<table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
									  <tr>
										<td width="35%"><br>
											<font color="#da9501">Membership type :</font>
											<font style="font-family:Arial; font-size:12px;">
											<b class="member"><?=ereg_replace('package','',GetSingleField('package_name','tbl_packages','package_id',$config[userinfo][membership_type]));?></b><br>
											<br><font color="#da9501">Package Expiry :</font> <?=GetPackageExpiryDate($config[userinfo][id])?><br><br>
											<font color="#da9501">Package Validity :</font> <? echo GetPackageExpiryDays($config[userinfo][id]) . ' days';?><br><br>
											<? if ($config[userinfo][membership_type] == 1) { ?>
											<font color="#da9501">Membership starts -  </font><strong> Now Free</strong><br><br>
											<? } ?>
										  <a href="upgrade_membership.php" class="idclr">Upgrade Now!!</a><br><br></font><br><br>
										</td>
										<td width="7%">&nbsp;</td>
										<td valign="top" width="58%" class="benifitbg" style="padding-left:10px;">
											<p><b>Benefits you get on memberships</b><br><br></p>
											<p>1- Get Partner Contact details</p>
											<p>2- Feature Profile</p>
											<p>3- SMS alert for Daily match and Express interest</p>
											<p>4- Profile Highlighting & Top place in search</p>
										</td>
									  </tr>
									</table>
								</td>
							 </tr>
							 <tr><td>&nbsp;</td></tr>
							 <tr><td align="center"><a href="support.php" class="more">Report Abuse</a></td></tr>
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
		  		include("includes/fotter.php") ?>
  </td>
  </tr>
</table>
<div>
<script src="includes/boxover.js"></script>
</body>
</html>
