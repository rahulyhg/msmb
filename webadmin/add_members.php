<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
include("config.php");
$linkid=db_connect();
isAdmin("edit_regn_member_status");
$id = GetVar("id");
$action = GetVar("action");
$action1 = GetVar("action1");

$mode = GetVar("mode");
$membership_type = GetVar("membership_type");
$user = GetSingleRecord("tbl_register","id",$id);
if ($action == "deleteimage") {
	//remove photo
	$photoid = GetVar("photoid");
	$resPhoto = Execute("select * from tbl_photo where id = '" . $photoid . "' and userid='" . $user['id'] . "'");
	if (mysql_num_rows($resPhoto)>0) {
		$userphoto = mysql_fetch_array($resPhoto);
		if ($userphoto[photo]) {
			removeFile("userimages/" . $userphoto[photo]);
		}
		if ($userphoto[thumbnail]) {
			removeFile("userimages/" . $userphoto[thumbnail]);
		}
		$res = Execute("delete from tbl_photo where id = '" . $photoid . "'");		
		$msg = "Photo deleted successfully";
	}
	$_SESSION['_msg'] = $msg;
	header("Location: editprofile.php?action1=$action1");
	die();
	
} else if ($action == "update") {		
	
	if (!$mode) {
	
		if ($_REQUEST['email']) {
		
			if ($_REQUEST['email'] != $user[email]) {
			
				$mail = GetSingleRecord("tbl_register","email",$_REQUEST['email']);
				
				if ($mail) {
					$_SESSION['_msg'] = "Email address already exist";
					?>
					<script language="javascript">
						location.href = "add_members.php?id=<?=$id?>&mode=<?=GetVar("mode")?>&membership_type=<?=GetVar("$membership_type")?>";
					</script>
					<?
					//header("Location: add_members.php?id=$id");
					die();
				}
			}	
		}	
		
		if ($_REQUEST['income']) {
			$_REQUEST['income'] = str_replace(",","",$_REQUEST['income']);	
		}	
		
		if ($_REQUEST['caste'] && !$_REQUEST['nocaste']) {
			$_REQUEST['nocaste'] = '0';		
		}
		
		$_REQUEST['date_of_birth']	= $_REQUEST['mydateY']."-".$_REQUEST['mydateM']."-".$_REQUEST['mydateD'];
		
		if ($_REQUEST['franchisees_autoid']) {
			$_REQUEST['franchisees_id'] = GetSingleField("franchisee_id","tbl_franchisee","auto_id",$_REQUEST['franchisees_autoid']);
		}
		
		if (!is_dir("horoscope")) {
			mkdir("horoscope");
			chmod("horoscope",0777);
		}
		
				
		if ($HTTP_POST_FILES['horoscope1']['name'] != "") {		
			if ($user[horoscope]) { removeFile("../horoscope/" . $user[horoscope]); }			
			$_REQUEST['horoscope'] = post_img($HTTP_POST_FILES['horoscope1']['name'], $HTTP_POST_FILES['horoscope1']['tmp_name'],"../horoscope");
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
		
		if ($_REQUEST['nationality'] && $_REQUEST['nationality'] != 'Others') {
			$_REQUEST['nationality_1'] = '';
		} else if ($_REQUEST['nationality_1']) {
			$_REQUEST['nationality'] = '';
		}
		
	if ($_REQUEST['countryCode'] && $_REQUEST['areaCode'] && $_REQUEST['phoneNumber']) {
		$_REQUEST['phoneNumber'] = $_REQUEST['countryCode'] . "-" . $_REQUEST['areaCode'] . "-" . $_REQUEST['phoneNumber'];	
	}
		
	} else if ($mode == 'hobbies') {
	
		ProcessInterests($_REQUEST,$user[id]);	
		
	} else {		
	
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
		
	if (!$_REQUEST['verifiedStatus']) { $_REQUEST['verifiedBy'] = "";	$_REQUEST['verifiedStatus'] = 0;}
	
	if (!$_REQUEST['featuredProfile']) { $_REQUEST['featuredProfile'] = 0;}	
			
	$sql = DTMLUpdateRecord($user[id],"tbl_register",$_REQUEST);		 			
	$res = Execute($sql);
	$msg = "Updated successfully";
	
	$res_count = Execute("select count(*) from tbl_register where verifiedBy = '" . $_SESSION['user_id'] . "'");
	
	if (mysql_num_rows($res_count) > 0) {
		$rs_count = mysql_fetch_array($res_count);
	}
	
	$res_edit = Execute("update tbl_admin set profile_edited = '" . $rs_count[0] . "' where Id = '" . $_SESSION['user_id'] . "'");
		
	$_SESSION['_msg'] = $msg;
	?>
		<script language="javascript">
			location.href = "view_members.php?membership_type=<?=$membership_type?>&page=<?=$_REQUEST['page']?>";
		</script>
	<?		
	//header("Location:view_members.php?membership_type=$membership_type");
	die();
	
}

$user = GetSingleRecord("tbl_register","id",$id);

?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript" type="text/javascript" src="includes/functions.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>	
<script language="javascript">
	function ViewCheckedBy(obj) {
		if(obj.checked) 
			document.getElementById("ChkForm").style.display = "block";
		else 
			document.getElementById("ChkForm").style.display = "none";	
	}
	
	function funchange(mode,id) {
		if(mode!=0) {
			window.location.href = "rem_newsletter.php?con_rem_id="+mode+"&membership_type="+<?=$_REQUEST['membership_type']?>+"&mem_id="+id;
		}
		else {
			window.location.href = "rem_con_newsletter.php?con_rem_id="+mode+"&membership_type="+<?=$_REQUEST['membership_type']?>+"&mem_id="+id;
		}
	}
</script>
</head>
<body>
<!--		Start : Main Table		-->
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%" align="center">
<tr><td width="100%" height="20" colspan="3" align="center"><img src="images/spacer.gif" border="0" height="20"></td></tr>
<tr>
	<td width="20" height="100%"><img src="images/spacer.gif" border="0" width="20"></td>
	<td width="100%" height="100%" valign="top">
		<table cellpadding="0" cellspacing="0" border="1" width="100%" height="100%" class="tmain" bordercolor="#000000" style="border:thin;">
		<tr>
			<td>
				<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
				
				<!-- Start : Header  -->
				<tr><td><script language="JavaScript">fnHeader();</script></td></tr>
				<!-- End : Header  -->
				
				<!-- Start : Menu -->
				<tr><td><script language="JavaScript">fnMenu();</script></td></tr>
				<!-- End : Menu -->
				
				<!-- Start : Title -->
				<tr class="titlebg"><td>
					<table cellpadding="0" cellspacing="0" border="0" width="98%" height="22" align="center">
					<tr>
						<td class="title">Welcome <font class="session"><? echo $_SESSION['_user']?></font></td>
						<td align="right" class="session"><? echo $_SESSION['_msg'];?><? $_SESSION['_msg'] = "";?></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Title -->
				
				<tr><td><img src="images/spacer.gif" border="0" width="1" height="1"></td></tr>
				
				<!-- Start : Sub Title -->
				<tr class="subtitlebg"><td>
					<table cellpadding="0" cellspacing="0" border="0" width="98%" height="22" align="center">
					<tr>
						<td class="subtitle">Manage Members</td>
						<td align="right">
						<a href="view_members.php?membership_type=1">Free Members</a>&nbsp;&nbsp;			
						<a href="view_members.php?membership_type=2">Paid Members</a>&nbsp;&nbsp;
						</td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->			
						
					
					<table cellpadding="0" cellspacing="1" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="10"></td></tr>
					<tr><!--<td align="center" >
							<table border=0 cellpadding=1 cellspacing=5 width=100% height=25 bgcolor='#FFFFFF'>
							<tr class='menubg' height='25'>
							<td align=center style="background-color:#ccc90f"><A href="rem_con_newsletter.php?id=<?=$_REQUEST["id"]?>&con_rem_id=4"  title='Deleted' class='menu1'>Deleted</A></td>
							<td align=center  style="background-color:#ffcc00"><A href='rem_con_newsletter.php?id=<?=$_REQUEST["id"]?>&con_rem_id=8' title='Photo Approval' class='menu1'>Photo Approval</A></td>
							<td align=center style="background-color:#ff9933"><A href='rem_con_newsletter.php?id=<?=$_REQUEST["id"]?>&con_rem_id=9' title='De Activated' class='menu1'>De Activated</A></td>				
							<td align=center  style="background-color:#ff6600"><A href='rem_con_newsletter.php?id=<?=$_REQUEST["id"]?>&con_rem_id=7' title='Payment Not Received' class='menu1'>Payment Not Received</A></td>
							<td align=center  style="background-color:#ff6600"><A href='rem_con_newsletter.php?id=<?=$_REQUEST["id"]?>&con_rem_id=6' title='Payment Ok' class='menu1'>Payment Ok</A></td>
							 </tr>
							 <tr class='menubg' height='25'>
							<td align=center style="background-color:#ff0066"><A href='rem_con_newsletter.php?id=<?=$_REQUEST["id"]?>&con_rem_id=10' title='Expired Member' class='menu1'>Expired Member</A></td>									
							<td align=center style="background-color:#6600cc"><A href="rem_con_newsletter.php?id=<?=$_REQUEST["id"]?>&con_rem_id=2" title='Expired Member' class='menu1'>Horoscope Request</A></td>
							<td align=center><A href='rem_con_newsletter.php?id=<?=$_REQUEST["id"]?>&con_rem_id=7' title='Phone No Not Correct' class='menu1'>Phone No Not Correct</A></td>
							<td align=center style="background-color:#6666ff"><A href='rem_con_newsletter.php?id=<?=$_REQUEST["id"]?>&con_rem_id=3' title='Incomplete On Hold' class='menu1'>Incomplete On Hold</A></td>				
							<td align=center style="background-color:#333399"><A href='rem_con_newsletter.php?id=<?=$_REQUEST["id"]?>&con_rem_id=1' title='Photo Request' class='menu1'>Photo Request</A></td>
							<td align=center style="background-color:#1b1464"><A href='rem_con_newsletter.php?id=<?=$_REQUEST["id"]?>&con_rem_id=5' title='Activate' class='menu1'>Activate</A></td>									
							 </tr>
							 </table>-->
							<!--<form name="thisForm_con_rem" method="post" id="thisForm_con_rem" >		
					        <input type="button" value="Deleted" onClick="funchange('4')" class="butten_rem" style="background-color:#ccc90f">
							<input type="button" value="Photo Approval" onClick="funchange('8')" class="butten_rem" style="background-color:#ffcc00">
							<input type="button" value="De Activated" onClick="funchange('9')" class="butten_rem" style="background-color:#ff9933">
							<input type="button" value="Payment Not Received" onClick="funchange('7')" class="butten_rem" style="background-color:#ff6600">
							<input type="button" value="Expired Member" onClick="funchange('10')" class="butten_rem" style="background-color:#ff0066"><br><br>
							<input type="button" value="Phone No Not Correct" onClick="funchange('7')" class="butten_rem" style="background-color:#cc0099">
							<input type="button" value="Incomplete On Hold" onClick="funchange('3')" class="butten_rem" style="background-color:#6666ff">
							<input type="button" value="Horoscope Request" onClick="funchange('2')" class="butten_rem" style="background-color:#6600cc">
							<input type="button" value="Photo Request" onClick="funchange('1')" class="butten_rem" style="background-color:#333399">
							<input type="button" value="Activate" onClick="funchange('5')" class="butten_rem" style="background-color:#1b1464">
							</form>--></td></tr>		
					
					</table>
					<form name="thisForm" method="post" enctype="multipart/form-data">
					  <input type="hidden" name="action" value="update">
					<input type="hidden" name="id" value="<?=$id?>">
					<input type="hidden" name="mode" value="<?=$mode?>">
					<input type="hidden" name="membership_type" value="<?=GetVar("membership_type")?>">		
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">	
					<tr><td align="center" valign="top">
						<table border=0 cellpadding=1 cellspacing=5 width=100% height=25 bgcolor='#FFFFFF'>
							<tr class='menubg' height='25'>
							<td align=center style="background-color:#ccc90f"><A  style="cursor:pointer" onClick="return funchange('4','<?=$id?>');" title='Deleted' class='menu1'>Deleted</A></td>
							<td align=center  style="background-color:#ffcc00"><A style="cursor:pointer" onClick="return funchange('8','<?=$id?>');" title='Photo Approval' class='menu1'>Photo Approval</A></td>
							<td align=center style="background-color:#ff9933"><A  style="cursor:pointer"onClick="return funchange('9','<?=$id?>');" title='De Activated' class='menu1'>De Activated</A></td>				
							<td align=center  style="background-color:#ff6600"><A style="cursor:pointer" onClick="return funchange('7','<?=$id?>');" title='Payment Not Received' class='menu1'>Payment Not Received</A></td>
							<td align=center  style="background-color:#ff6600"><A  style="cursor:pointer" onClick="return funchange('6','<?=$id?>');" title='Payment Ok' class='menu1'>Payment Ok</A></td>
							<td align=center owspan="2" width="75"><A onClick="return funchange('11','<?=$id?>');"  style="cursor:pointer"  title='Phone No Not Correct' class='menu1'>Phone No Not Correct</A></td>
							 </tr>
							 <tr class='menubg' height='25'>
							<td align=center style="background-color:#ff0066"><A style="cursor:pointer" onClick="return funchange('10','<?=$id?>');"  title='Expired Member' class='menu1'>Expired Member</A></td>									
							<td align=center style="background-color:#6600cc"><A style="cursor:pointer" onClick="return funchange('2','<?=$id?>');" title='Horoscope Request' class='menu1'>Horoscope Request</A></td>
							<td align=center style="background-color:#6666ff"><A style="cursor:pointer" onClick="return funchange('3','<?=$id?>');" title='Incomplete On Hold' class='menu1'>Incomplete On Hold</A></td>				
							<td align=center style="background-color:#333399"><A style="cursor:pointer" onClick="return funchange('1','<?=$id?>');" title='Photo Request' class='menu1'>Photo Request</A></td>
							<td align=center style="background-color:#1b1464"><A style="cursor:pointer" onClick="return funchange('5','<?=$id?>');" title='Activate' class='menu1'>Activate</A></td>
							<td align=center owspan="2" width="75" style="background-color:#666600"><A onClick="return funchange('0','<?=$id?>');"  style="cursor:pointer"  title='Customized Mail' class='menu1'>Customized Mail</A></td>
							 </tr>
						</table>
						<br />
						<input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
						<table cellpadding="0" cellspacing="0" border="0" width="520">
						<tr><td>
							<table cellpadding="10" cellspacing="1" border="0" width="700" class="tblBorder">
							<tr class="tblHead"><td align="center"><b>
								<?
									echo "Update Members";								
								?>
							</b></td></tr>
							<tr class="tblContent"><td>
								<table cellpadding="5" cellspacing="1" border="0" width="700" class="tblBorder">																	
									<?
									if (!$mode) { 
										include("common/basicdetails.php");
										include("common/occupationdetails.php");
										include("common/physicaldetails.php");
									?>
									<tr class="tblContent">
										<td colspan="2"><a href="add_members.php?id=<?=$id?>&mode=hobbies&membership_type=<?=GetVar("membership_type")?>"><b>Click here</b></a> to Edit Hobbies</td>										
									</tr>
									<tr class="tblContent">
										<td colspan="2"><a href="add_members.php?id=<?=$id?>&mode=lookingfor&membership_type=<?=GetVar("membership_type")?>"><b>Click here</b></a> to Edit Partner Preference</td>										
									</tr>
									<?	
									} else if($mode == 'hobbies') {																			
									    include("common/hobbiesdetails.php");										
										?>
										<tr class="tblContent">
											<td colspan="2" align="center"><a href="javascript:history.back()"><b>Back</b></a></td>
										</tr>
										<?
									} else if ($mode == 'lookingfor') {								
										include("common/partnerdetails.php");
										?>
										<tr class="tblContent">
											<td colspan="2" align="center"><a href="javascript:history.back()"><b>Back</b></a></td>
										</tr>
										<?
									}	
									?>	 
									<tr class="tblContent">
										<td>Registration Date</td>
										<td><?=strftime("%d/%m/%Y  %I:%M %p",strtotime($user[registration_date]));?></td>
									</tr>
									<tr class="tblContent">
										<td>Login Date</td>
										<td><?=strftime("%d/%m/%Y  %I:%M %p",strtotime($user[lastLogin]));?></td>
									</tr>										
									<tr class="tblContent">
										<td>Checked by</td>
										<td>							
											<input type="hidden" name="verifiedBy" class="txtbox" value="<?=$_SESSION['user_id']?>" readonly>
											<?=$_SESSION['username']?>
											<input type="hidden" name="verifiedStatus" value="1">
										</td>										
									</tr>
									<tr class="tblContent">
										<td>&nbsp;</td>
										<td><input type="checkbox" name="featuredProfile" value="1" lass="radio" <? if ($user[featuredProfile]) { ?>checked<? } ?>>featured profile</td>										
									</tr>
									<tr class="tblContent">
										<td>Profile Hide</td>
										<td><input type="radio" name="hideProfile" class="radio" value="0" checked>&nbsp;No&nbsp;&nbsp;&nbsp;<input type="radio" name="hideProfile" class="radio" value="1" <? if ($user[hideProfile] == 1) { ?>checked<? } ?>>&nbsp;Yes</td>	
									</tr>
									<tr class="tblContent">
										<td>Profile Deleted</td>
										<td><input type="radio" name="deleteProfile" class="radio" value="0" checked>&nbsp;No&nbsp;&nbsp;&nbsp;<input type="radio" name="deleteProfile" class="radio" value="1" <? if ($user[deleteProfile] == 1) { ?>checked<? } ?>>&nbsp;Yes</td>	
									</tr>										
									<tr class="tblContent">
										<td align="center" height="30" colspan="2">
											<input type="submit" value="Verify & Update" class="butten" style="width:190px;">
										</td>
									</tr>
								</table>
							</td></tr>
							</table>
						</td></tr>
						</table>
				 	</td></tr>
					<tr><td height="10"></td></tr>
			 		</table>
		 		</form>
				<script language="javascript">
					//f1 = document.thisForm.verifiedStatus;
					//ViewCheckedBy(f1);
				</script>
				<!-- End : Table Of Contents -->
		 		</td></tr>
	 			</table>
				<br>
			</td>
		</tr>
		</table>
	</td>
	<td width="20" height="100%"><img src="images/spacer.gif" border="0" width="20"></td>
</tr>
<tr><td width="100%" height="20" colspan="3" align="center"><img src="images/spacer.gif" border="0" height="20"></td></tr>
</table>
<!--		End : Main Table		-->
</body>
</html>
