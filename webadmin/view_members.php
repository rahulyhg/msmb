<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging1.php");
include("includes/menu.php");
$linkid = db_connect();
$print = GetVar("print");
//Checking the Members as for Paid or Free Members
if (GetVar("membership_type")) {
} else {
	$_POST['membership_type'] = 1;
}
//Checking For the Admin
if (GetVar("membership_type") == 2) {
	isAdmin("paid_member_report_status");
} else {
	isAdmin("free_member_report_status");	
}
//Delete Mode Starts Here
if($_REQUEST['mode']=="del"){
	if($_REQUEST['ChkS']<>""){
	
		for($i=0;$i<count($_REQUEST['ChkS']);$i++){													
			$user = GetSingleRecord("tbl_interests","id",$_REQUEST['ChkS'][$i]);	
			$resPhoto = Execute("select * from tbl_photo where userid='" . $user[id] . "'");
			if (mysql_num_rows($resPhoto)>0) {
				while ($userphoto = mysql_fetch_array($resPhoto)) {
					if ($userphoto[photo]) {
						removeFile("../userimages/" . $userphoto[photo]);
					}
					if ($userphoto[thumbnail]) {
						removeFile("../userimages/" . $userphoto[thumbnail]);
					}			
				}
				$res = Execute("delete from tbl_photo where userid='" . $user[id] . "'");		
			}
			
			//remove interest if any
			$userinterest = GetSingleRecord("tbl_interests","userid",$user[id]);	
			if ($userinterest) {
				Execute("delete from tbl_interests where userid = '" .$user[id] . "'");		
			}
			
			//remove horoscope if any
			if ($user[horoscope]) { removeFile("../horoscope/" . $user[horoscope]); }
			
			$delRes = Execute("delete from tbl_bookmark where userid = '" .$_REQUEST['ChkS'][$i] . "' or bookmarked_id = '" . $_REQUEST['ChkS'][$i] . "'");
			$delRes = Execute("delete from tbl_contact_view where userid = '" .$_REQUEST['ChkS'][$i] . "' or profile_id = '" . $_REQUEST['ChkS'][$i] . "'");
			$delRes = Execute("delete from tbl_express_interest where sender = '" .$_REQUEST['ChkS'][$i] . "' or recipient = '" . $_REQUEST['ChkS'][$i] . "'");
			$delRes = Execute("delete from tbl_match_profile where userid = '" .$_REQUEST['ChkS'][$i] . "' or matchid = '" . $_REQUEST['ChkS'][$i] . "'");
			$delRes = Execute("delete from tbl_con_rem_newsletter where id_fk = '" .$_REQUEST['ChkS'][$i]. "'");
			$delRes = Execute("delete from tbl_member_profile_upgrade where member_auto_id = '" .$_REQUEST['ChkS'][$i]. "'");
			//remove profile if any
			$sql = Execute("delete from tbl_register where id='" .$_REQUEST['ChkS'][$i] . "'");											
			$_SESSION['_msg']="Deleted Successfully"; 
	  	}
		header("location:view_members.php?membership_type=".$_REQUEST['membership_type']."&page=".$_REQUEST['page']);
		die();
	}
}
//Delete Mode Ends Here

//print_r($_REQUEST);
//die();

//ActivateMode Ends Here
if($_REQUEST['Mode']=="Activate"){
	
	if($_REQUEST['ChkS']<>""){
		for($i=0;$i<count($_REQUEST['ChkS']);$i++){
			$sql="update tbl_register set enable = '1' where id = '".$_REQUEST['ChkS'][$i]."'";
			//echo $sql;
			mysql_query($sql);
			echo mysql_error();				
		}
		$_SESSION['_msg']="Member(s) Activated successfully";
	}	
	header("location:view_members.php?membership_type=".$_REQUEST['membership_type']."&page=".$_REQUEST['page']);
	die();	
}
//Activate Mode Ends Here
//Deactivate Mode Starts Here
if($_REQUEST['Mode']=="DeActivate"){
	if($_REQUEST['ChkS']<>""){
		for($i=0;$i<count($_REQUEST['ChkS']);$i++){
			$sql="update tbl_register set enable = '0' where id = ".$_REQUEST['ChkS'][$i];
			mysql_query($sql);			
			echo mysql_error();						
		}
		$_SESSION['_msg']="Member(s) De-Activated successfully";
	}	
	header("location:view_members.php?membership_type=".$_REQUEST['membership_type']."&page=".$_REQUEST['page']);
	die();	
}
//Deactivate Mode Ends Here
//Getting The Values from the table
$qstring = "domain=" . GetVar("domain") . "&religion=" . GetVar("religion") . "&caste=" . GetVar("caste");
$qstring .= "&gender=" . GetVar("gender") . "&country=" . GetVar("country") . "&education=" . GetVar("education") . "&occupation=" . GetVar("occupation");
$qstring .= "&state=" . GetVar("state") . "&city=" . GetVar("city") . "&name=" . GetVar("name") . "&username=" . GetVar("username");
$qstring .= "&status=" . GetVar("status");
$qstring .= "&deleteProfile=" . GetVar("deleteProfile") . "&print=" . GetVar("print") . "&membership_type=".GetVar("membership_type") ."&";
?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/functions.js"></script>
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript">
//Function for Delete The Members
function fnDelete(page) {
	if(notChecked(document.thisForm.elements["ChkS[]"],"members to delete")) {return;}
	if(confirm("Are you sure to delete the selected Member(s)?")){
		document.thisForm.action="view_members.php?mode=del&page="+page+"&membership_type=<?=$_REQUEST['membership_type']?>";
		document.thisForm.submit();
	} else {
		return false;
	}
}
//Function for Activate The Members
function fnActivate(page) {
	if(notChecked(document.thisForm.elements["ChkS[]"],"Members to Activate")) {return;}
	document.thisForm.action="view_members.php?Mode=Activate&page="+page+"&membership_type=<?=$_REQUEST['membership_type']?>";
	document.thisForm.submit();
}
//Function for Deactivate The Members
function fnDeActivate(page) {
	if(notChecked(document.thisForm.elements["ChkS[]"],"Members to De-Activate")) {return;}
	document.thisForm.action="view_members.php?Mode=DeActivate&page="+page+"&membership_type=<?=$_REQUEST['membership_type']?>";
	document.thisForm.submit();
}
//Function for View the Photos
function ManagePhoto(id,mem_type) {	
	location.href = "photo.php?id=" + id +"&member_type=" + mem_type ;
	//window.open("photo.php?id= " + id,'','width=800,height=600,scrollbars=yes,status=no,toolbar=no,top=0,left=0');
}
//Function for Searching the Members
function searchMem() {
	f1 = document.thisForm;
	if (notSelected(f1.domain,"domain")) { 
	} else {
		document.thisForm.submit();
	}
}
//Function for Opening the PopupWindow for printing the Members
function openPrint() {
	window.open("<?= $_SERVER["PHP_SELF"]; ?>?<?=$qstring?>&print=true","","width=600,height=600,menubar=yes,resizable=yes, scrollbars=yes");
}
//Function for Sending the Mail For the Members
function funchange(mode) {
	if(notChecked(document.thisForm.elements["ChkS[]"],"Members to Confirmation and Reminder")) {return false;}
	if(mode!=0) {
		document.thisForm.action="rem_newsletter.php?con_rem_id="+mode+"&membership_type=<?=$_REQUEST['membership_type']?>";
	}
	else {
		document.thisForm.action="rem_con_newsletter.php?con_rem_id="+mode+"&membership_type=<?=$_REQUEST['membership_type']?>";
	}
	document.thisForm.submit();
}
</script>
</head>
<body topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">
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
				<? if (!$print) { ?>
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
						<td class="title">Welcome <font class="session"><? echo $_SESSION['_user']; ?></font></td>
						<td align="right" class="session"><? echo $_SESSION['_msg']; ?><? $_SESSION['_msg'] = "";?></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Title -->
				
				<tr><td><img src="images/spacer.gif" border="0" width="1" height="1"></td></tr>
				<!-- Start : Sub Title -->
				<tr class="subtitlebg"><td>
					<table cellpadding="0" cellspacing="0" border="0" width="98%" height="22" align="center">
					<tr>
						<?
							//Checking for the Member Type
							if (GetVar("membership_type") > 1) {
								$type = "Paid";
							} else {
								$type = "Free";
							}
						?>	
						<td class="subtitle">Manage <?=$type?> Members</td>
						<td align="right">
											
						<a href="view_members.php?deleteProfile=1&membership_type=<?=GetVar("membership_type")?>">View Deleted Profile(<?=$type?> Members)</a>&nbsp;&nbsp;
						<!--<a href="view_members.php?membership_type=1">Free Members</a>&nbsp;&nbsp;			
						<a href="view_members.php?membership_type=2">Paid Members</a>&nbsp;&nbsp;						
						<a href="#">View Upgrade Request members</a>&nbsp;-->
						</td>
					</tr>
					</table>
				</td></tr>
				<? } ?>
				<!-- End : Sub Title -->
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
					<form name="thisForm" method="post">						
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					
					<tr><td align="center" valign="top">
					<!-- Buttons For Sending Mail -->
					<table border=0 cellpadding=1 cellspacing=5 width=100% height=25 bgcolor='#FFFFFF'>
							<tr class='menubg' height='25'>
							<td align=center style="background-color:#ccc90f"><A  style="cursor:pointer" onClick="return funchange('4')" title='Deleted' class='menu1'>Deleted</A></td>
							<td align=center  style="background-color:#ffcc00"><A style="cursor:pointer" onClick="return funchange('8')" title='Photo Approval' class='menu1'>Photo Approval</A></td>
							<td align=center style="background-color:#ff9933"><A  style="cursor:pointer"onClick="return funchange('9')" title='De Activated' class='menu1'>De Activated</A></td>				
							<td align=center  style="background-color:#ff6600"><A style="cursor:pointer" onClick="return funchange('7')" title='Payment Not Received' class='menu1'>Payment Not Received</A></td>
							<td align=center  style="background-color:#ff6600"><A  style="cursor:pointer" onClick="return funchange('6')" title='Payment Ok' class='menu1'>Payment Ok</A></td>
							<td align=center owspan="2" width="75"><A onClick="return funchange('11')"  style="cursor:pointer"  title='Phone No Not Correct' class='menu1'>Phone No Not Correct</A></td>

							 </tr>
							 <tr class='menubg' height='25'>
							<td align=center style="background-color:#ff0066"><A style="cursor:pointer" onClick="return funchange('10')"  title='Expired Member' class='menu1'>Expired Member</A></td>									
							<td align=center style="background-color:#6600cc"><A style="cursor:pointer" onClick="return funchange('2')" title='Horoscope Request' class='menu1'>Horoscope Request</A></td>
							<td align=center style="background-color:#6666ff"><A style="cursor:pointer" onClick="return funchange('3')" title='Incomplete On Hold' class='menu1'>Incomplete On Hold</A></td>				
							<td align=center style="background-color:#333399"><A style="cursor:pointer" onClick="return funchange('1')" title='Photo Request' class='menu1'>Photo Request</A></td>
							<td align=center style="background-color:#1b1464"><A style="cursor:pointer" onClick="return funchange('5')" title='Activate' class='menu1'>Activate</A></td>
							<td align=center owspan="2" width="75" style="background-color:#666600"><A onClick="return funchange('0')"  style="cursor:pointer"  title='Customized Mail' class='menu1'>Customized Mail</A></td>
							 </tr>
							 </table>
						<!-- Search Options -->
						<table cellpadding="0" align="center" cellspacing="0" border="0" width="420">							
						<? if (!$print) { ?>
						<tr>
							<td align="center">
								<table cellpadding="2" cellspacing="2">
									<tr>
										<td>Sort By Domain</td><td>Sort By Religion</td><td>Sort By Caste</td>
										<td>Sort By Gender</td>
									</tr>	
									<tr>									
										<td>
										<select name="domain" class="cmbbox" nChange="selReligion()" onChange="FillReligionsCaste1('<?=GetVar("religion")?>','<?=GetVar("caste")?>')">
											<option value="" selected>-Select A Domain-</option>
											<option value="0">All</option>		
											<?	$resDomain = Execute("select * from tbl_domain_master order by id");
												if (mysql_num_rows($resDomain) > 0) {
													while ($domain = mysql_fetch_array($resDomain)) {									
												?>
												<option value="<?=$domain[id]?>"><?=$domain[domain]?></option>
											<?  	}
												} ?>	
										</select>
										<? if (GetVar("domain")) { ?>
											<script language="javascript" type="text/javascript">
												document.thisForm.domain.value = "<?=GetVar("domain");?>";
											</script>
										<? } ?>									</td>
									<td>
										<select name="religion" class="cmbbox" nChange="SelectCaste();" onChange="FillCaste3();">
											<option value="">-Select Religion-</option>										
										</select>									</td>
									<td>
									<select name="caste" class="cmbbox">									
										<option value="">--Select--</option>									
									</select>
																		
									<? if (GetVar("domain")) { ?>
											<script language="javascript">
												FillReligionsCaste1('<?=GetVar("religion")?>','<?=GetVar("caste")?>');											</script>											
									<?   } else if (GetVar("religion")) { ?>
										<script language="javascript">
											FillReligionsCaste1('<?=GetVar("religion")?>','<?=GetVar("caste")?>');
										</script>
									<? } ?>
									<? if (GetVar("religion")) { ?>
											<script language="javascript" type="text/javascript">											
												document.thisForm.religion.value = "<?=GetVar("religion");?>";
											</script>
										<? } ?>	
									<? if (GetVar("caste")) { ?>
										<script language="javascript">
											document.thisForm.caste.value = "<?=GetVar("caste")?>";											
										</script>			
									<? 	} ?>
										</td>																
									<td>
											<select name="gender" class="cmbbox">
												<option value="">--Select--</option>
												<option value="M">Male</option>
												<option value="F">Female</option>
											</select>
											<? if (GetVar("gender")) { ?>
												<script language="javascript">
													document.thisForm.gender.value = "<?=GetVar("gender")?>";											
												</script>			
											<? 	} ?>
											
									</td>																	
								</tr>										
								<tr>
									<td>Sort By Country</td><td>Sort By State</td><td>Sort By City</td><td>Sort By Education</td>
								</tr>
								<tr>
									<td>
										<select class="cmbbox" name="country" onChange="selState2()">
											<option value="">Select</option>										
											<?	GetCountry(); ?>											
										</select>
										<? if (GetVar("country")) { ?>
											<script language="javascript">
												document.thisForm.country.value = "<?=GetVar("country")?>";	
											</script>
										<? } ?>									</td>
									<td>
										<select name="state" class="cmbbox" onChange="selCity2()">
											<option value="">-Select state-</option>										
										</select>
										<select name="country_vs_state" style="display:none">
											<? GetState();	?>
										</select>
										<select name="country_vs_state1" style="display:none">
											<? GetCountryVsState();	?>
										</select>									</td>
									<td>
										<select name="city" class="cmbbox">
											<option value="">-Select city-</option>										
										</select>
										<select name="state_vs_city" style="display:none">
											<? GetCity();	?>
										</select>
										<select name="state_vs_city1" style="display:none">
											<? GetStateVsCity();	?>
										</select>
										<? if (GetVar("country")) { ?>									
											<script language="javascript" type="text/javascript">
												selState2();													
											</script>
										<? } ?>
										<? if (GetVar("state")) { ?>
											<script language="javascript">
												document.thisForm.state.value = "<?=GetVar("state");?>";
												selCity2();													
											</script>	
										<? } ?>										
										<? if (GetVar("city")) { ?>
											<script language="javascript">
												document.thisForm.city.value = "<?=GetVar("city")?>";
											</script>
										<? } ?>									</td>
									<td>
											<select name="education" class="cmbbox">
											<option value="">--Select--</option>
											<?
												$res = Execute("select * from tbl_education_master");
												if (mysql_num_rows($res) > 0) {
													while ($education = mysql_fetch_array($res)) { ?>
														<option value="<?=$education[id]?>"><?=$education[education]?></option>	
												<?	}
												}
											?>
										</select>
										<? if (GetVar("education")) { ?>
											<script language="javascript">
												document.thisForm.education.value = "<?=GetVar("education")?>";	
											</script>
										<? } ?>									</td>
								</tr>
								<tr>
									<td>Sort By Occupation</td><td>Search by Name</td><td>Search by ID</td>
									<td>Sort By Status</td>
								</tr>
								<tr>						
									<td>
										<select name="occupation" class="cmbbox">
											<option value="">-Select Occupation-</option>
											<?=GetOccupation(); ?>
										</select>
										<? if (GetVar("occupation")) { ?>
											<script language="javascript">
												document.thisForm.occupation.value = "<?=GetVar("occupation")?>";	
											</script>
										<? } ?>									</td>
									<td><input type="text" name="name" class="txtbox" value="<?=GetVar("name");?>"></td>
									<td><input type="text" name="username" class="txtbox" value="<?=GetVar("username");?>"></td>									
									<td>
										<select name="status" class="cmbbox">
											<option value="">--Select--</option>
											<option value="1">Activate</option>
											<option value="2">Deactivate</option>
										</select>
										<script language="javascript">
											document.thisForm.status.value = "<?=GetVar("status")?>";
										</script>									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td><input name="button" type="button" class="butten" onClick="searchMem();" value="Search"></td>
								</tr>						
								</table>
							</td>
						</tr>
						<? } ?>
						<tr><td>&nbsp;</td></tr>
						<tr><td>
						<?							
						//Query For Fetching The Members
						$sql = "select *,NOW() as curdate,(NOW() - INTERVAL 7 DAY) as reg_date from tbl_register where 1 = 1 ";
						
						if (GetVar("domain") && GetVar("domain") != 0) {							 
							$sql .= "and domain = '" . GetVar("domain") . "' ";
						}
						
						if (GetVar("religion")) {
							$sql .= "and religion = '" . GetVar("religion") . "' ";
						}
						
						if (GetVar("caste")) {
							$sql .= "and caste = '" . GetVar("caste") . "' ";							
						}
						
						if (GetVar("gender")) {
							$sql .= "and gender = '" . GetVar("gender") . "' ";
						}
						
						if (GetVar("country")) {
							$sql .= "and country = '" . GetVar("country") . "' ";
						}
						
						if (GetVar("education")) {
							$sql .= "and education = '" . GetVar("education") . "' ";
						}
						
						if (GetVar("occupation")) {
							$sql .= "and occupation = '" . GetVar("occupation") . "' ";
						}
						
						if (GetVar("state")) {
							$sql .= "and state = '" . GetVar("state") . "' ";
						}
						
						if (GetVar("city")) {
							$sql .= "and city = '" . GetVar("city") . "' ";
						}
						
						if (GetVar("name")) {
							$sql .= "and name like '%" . GetVar("name") . "%' ";
						}
						
						if (GetVar("username")) {
							$sql .= "and username = '" . GetVar("username") . "' ";
						}
						
						if (GetVar("membership_type")) {
						
							if (GetVar("membership_type") > 1) {
								$sql .= "and membership_type > 1 ";
							} else {	 
								$sql .= "and membership_type = 1 ";
							}	
						}	
						
						if (GetVar("status")) {
							if (GetVar("status") == 1) 
								$sql .= "and enable = '1' ";
							else
								$sql .= "and enable = '0' ";	
						}
						
						if (GetVar("deleteProfile")) {							
							$sql .= "and deleteProfile = '1' ";
						}					

						$sql .= " order by registration_date desc";

						$res = mysql_query($sql) or die(mysql_error());	

						$no = mysql_num_rows($res);
							//pager starts Here
						if ($_REQUEST['page'] == "")
							$page = 1;
						else
							$page = $_REQUEST['page'];
							$total	=	$no;
							$limit	=	50;
							$pager	=	Pager::getPagerData($total, $limit, $page);
							$offset	=	$pager->offset;
							$limit	=	$pager->limit;
							$page	= 	$pager->page;
						//pager ends Here
						$res = mysql_query($sql." limit  $offset, $limit"); 
						if ($no > 0) {
							$rCnt = 1;	
						?>
							<!--  Member Display -->
							<table width="100%">
								<tr><td align="right">as on <?=date("d.m.Y")?> – <?=$no?> members</td></tr>
							</table>
							<table cellpadding="5" cellspacing="1" border="0" width="850" class="tblBorder">					
							<tr class="tblHead">
								<? if (!$print) { ?>
								<td widht='30' align="center"><b>Select</b></td>
								<? } ?>
								<td width="30" align="center"><b>S.No</b></td>
								<td width="150"><b>Member Id</b></td>								
								<td width="300"><b>Name</b></td>
								<td width="100"><b>Registered Date</b></td>
								<td width="100"><b>Expiry Date</b></td>
								<td><b>Activation Status</b></td>
								<td width="100"><b>Verify Status</b></td>
								<td><b>Member Photo</b></td>
								<td width="100"><b>Login Status</b></td>
								<? if (!$print) { ?>
								<td><b>Member Photos</b></td>									
								<? } ?>
								<? if (GetVar("membership_type") > 1) { ?>
									<td><b>Package</b></td>
									<td><b>Upgrade by</b></td>
									<td><b>Payment Type</b></td>
								<? } ?>
							<?	if (GetVar("deleteProfile")) {	?>
								<td><b>Reason</b></td>
							<?  }  ?>						
 							</tr>
						<?
							if ($page!=1) {
								$rCnt = ($limit*($page-1)+1);
							} else {
								$rCnt=1;
							}
							
							while($rs=mysql_fetch_object($res)){ 
								$res_login=mysql_query("select lastLogin from tbl_register where id=".$rs->id." and curdate() < `package_expiry_date` order by enable,verifiedStatus,userHasPhoto,userPhotoApprove,lastLogin asc ");
								$rows=mysql_num_rows($res_login);
								if($rows>0)
									$result="<font color='green'>Active</font>";
								else
									$result="<font color='red'>InActive</font>";
								if($rs->package_expiry_date<$rs->curdate)
									$dates="Expiry";
								else
									$dates="";
								$registration_date=strftime("%d %b %Y",strtotime($rs->registration_date));
								$reg_date=strftime("%d %b %Y",strtotime($rs->reg_date));
								?>
								<tr class="tblContent">
								<? if (!$print) { ?>
									<td width="30" align="center"><input type='checkbox' name="ChkS[]" value='<? echo $rs->id?>'></td>
								<? } ?>	
									<td align="center" width="30"><? echo $rCnt ?></td>
									<td><a href="add_members.php?id=<? echo $rs->id;?>&membership_type=<?=GetVar("membership_type")?>&page=<?=$page?>"><? echo $rs->username;?></a></td>																		
									<td><? echo $rs->name;
									if(strtotime($reg_date)<=strtotime($registration_date)){
										echo "<img src=\"images/AnimatedNew.gif\" border=\"0\">";
									}
									echo " <br>[<a href='mailto: ".$rs->email."'>" .$rs->email . "</a>]";?></td>
									<td>
										<?  echo $registration_date; ?>
										</td>
									<td><? echo "<font color='red'>".$dates."</font><br>".strftime("%d %b %Y",strtotime($rs->package_expiry_date));?></td>
									<td>
									<? if ($rs->enable == "0") {?>
										<img src="images/cross.gif" border="0">	
									<? } else {?>
									<img src="images/tick.gif" border="0">
									<? }?>
									</td>
									<td>
									<? if ($rs->verifiedStatus == "0") {?>
										<img src="images/cross.gif" border="0">	
									<? } else {?>
									<img src="images/tick.gif" border="0"><br>
									(<?=GetSingleField("admin_loginname","tbl_admin","Id",$rs->verifiedBy)?>)
									<? } ?>										
									</td>
									<td>
										<?
											//$photoActivate = GetPhotoActivationStatus($rs->id);
											$userPhoto = GetSingleRecord("tbl_photo","userid",$rs->id);
											if ($userPhoto) { ?>
												<img src="images/tick.gif" border="0">	
										<?	} else { ?>
												<img src="images/cross.gif" border="0">	
										<?	}  ?>
									</td>
									<td><? echo $result."<br>".strftime("%d %b %Y",strtotime($rs->lastLogin));?></td>
									<? if (!$print) { ?>
									<td width="300">
									<!--<input type=button class=butten value=approve onClick="ManagePhoto('<?=$rs->id?>')">-->
									<? 
										$resUserImage = Execute("select * from tbl_photo where userid = '" . $rs->id . "'");
										$no = mysql_num_rows($resUserImage);
										if ($no > 0) { 
											$rsUserImage = Execute("select * from tbl_photo where userid = '" . $rs->id . "' and approve = 0");
											$waiting_approval = mysql_num_rows($rsUserImage);
											?>			
									<?		
										if ($waiting_approval > 0) { ?>
											<a onClick="ManagePhoto('<?=$rs->id?>','<?=GetVar("membership_type")?>')" class="session" style="cursor:pointer"><font olor=\"#FF0000\">pending approval(<?=$waiting_approval?>)</font></a>
									<?	} else { ?>
										 	<a onClick="ManagePhoto('<?=$rs->id?>','<?=GetVar("membership_type")?>')" class="session" style="cursor:pointer"><font olor=\"#FF0000\">Approved</font></a>
									<?	}
									} else { ?>									
										<a onClick="ManagePhoto('<?=$rs->id?>','<?=GetVar("membership_type")?>')" lass="session" style="cursor:pointer"><font olor=\"#FF0000\">No photo found</font></a>
								<?	}	
									?>
									</td>
									<? if (GetVar("membership_type") > 1) { ?>
									<td><?=GetSingleField("package_name","tbl_packages","package_id",$rs->membership_type)?></td>
									<td>
										<?
											$package_res =  Execute("select * from tbl_member_profile_upgrade where member_id = '" . $rs->username . "' order by created_date desc limit 0,1");//and payment_status = '1' 
											if (mysql_num_rows($package_res) > 0) {
												$package_rs = mysql_fetch_array($package_res);
												if ($package_rs[franchise_auto_id]) {
													echo 'FR('.GetSingleField("franchisee_name","tbl_franchisee","auto_id",$package_rs[franchise_auto_id]) . ')';
												} else {
													echo 'self';
												}
											}
										?>
									</td>
									<td><?=$package_rs[payment_mode]?></td>
								<? } ?>
									<? if (GetVar("deleteProfile")) { ?>
									<td>
										<input type="button" class="butten" value="View Reason" onClick="javascript:location.href='delete_reason.php?id=<?=$rs->id;?>'">
									</td>	
									<? }
									}
									 ?>
									
									
 								</tr>
						<?
							$rCnt++;
						}	?>		
							<tr>
							<td <? if (GetVar("membership_type") > 1) { ?> colspan="15" <? } else { ?> colspan="15" <? } ?> align="center" bgcolor="#FFFFFF">
							<? if (!$print) { ?>
						<?  if(GetVar(deleteProfile)!=1) { ?>							
							<input type="button" name="btns" value="Activate" onClick="fnActivate(<?=$page?>);" class="butten"> &nbsp; 
						<?  } ?>
							<input type="button" name="btnClick" class="butten" value="Delete" onClick="fnDelete(<?=$page?>)"> &nbsp; 
						<?  if(GetVar(deleteProfile)!=1) { ?>
							<input type="button" name="btns" value="De-Activate" onClick="fnDeActivate(<?=$page?>);" class="butten">
						<?  } ?>
							<!--
							<input type="button" value="Show Printable List" class="butten" onClick="openPrint()">-->
							<? } else { ?>
							<input type="button" value="Print" class="butten" onClick="javascript:window.print();">
							<input type="button" value="Close" class="butten" onClick="javascript:window.close();">
							<? } ?>							
							</td>
							</tr>												
							</table>
							<? getpageNumbers($pager->numPages,$page,"view_members.php?$qstring"); ?>
						<?
							mysql_free_result($res);
						}else{
							echo "<br><br><center>No members details Found.</center>";
						}
						?>						
						</td></tr>
						</table>
					</td></tr>
					</table>	
					</form>
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
<?
function convertdate($date)
	{
	$lastdt=explode("-",$date);
	$lastdate=$lastdt[2]."-".$lastdt[1]."-".$lastdt[0];
	return $lastdate;
	}
?>