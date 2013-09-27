<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging1.php");
include("includes/menu.php");
$linkid = db_connect();

$action =  GetVar("action");
$action1 =  GetVar("action1");
$pass = GetVar("pass");
$print = GetVar("print");

if (!$pass) { $pass = 0; }

if (GetVar("membership_type") == 2) {
	isAdmin("paid_member_report_status");
} else {
	isAdmin("free_member_report_status");
}

if ($action == "login") {
	if (GetVar("username") == 'test' && GetVar("password") == 'test') {
		//$pass = "1";
		header("location: member_sales_report.php?pass=1");
		die();
	} else {
		$pass = "0";
		$_SESSION['Msg'] = 'Invalid username and password';
	}
}

if (GetVar("registration_date1")) {
	$dateDiff = GetToFromDateDifference(GetVar("registration_date1"),GetVar("registration_date"));	
	if (!$dateDiff) {
		$_SESSION['Msg'] = "To date should not be greater than From date";
		unset($action);
	}
}

$qstring = "action=" . GetVar("action") . "&action1=" . GetVar("action1") . "&domain=" . GetVar("domain") . "&religion=" . GetVar("religion") . "&caste=" . GetVar("caste");
$qstring .= "&gender=" . GetVar("gender") . "&country=" . GetVar("country") . "&education=" . GetVar("education") . "&occupation=" . GetVar("occupation") . "&membership_type=" . GetVar("package_name");
$qstring .= "&state=" . GetVar("state") . "&city=" . GetVar("city") . "&name=" . GetVar("name") . "&username=" . GetVar("username");
$qstring .= "&registration_date=" . GetVar("registration_date") . "&registration_date1=" . GetVar("registration_date1");
$qstring .= "&deleteProfile=" . GetVar("deleteProfile") . "&Payment_Type=".GetVar("Payment_Type"); 

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
function freeMembers() {	
	f1 = document.thisForm;	
	f1.action1.value = "view";
	f1.membership_type.value = 1;	
	//document.thisForm.action = "member_sales_report.php?action=search&action1=view&membership_type=1";
	f1.submit();	
}

function paidMembers() {	
	f1 = document.thisForm;
	f1.action1.value = "view";
	f1.membership_type.value = 2;
	//f1.action = "member_sales_report.php?action=search&action1=view&membership_type=2";
	f1.submit();
}

function searchMem() {
	f1 = document.thisForm;
	if (notSelected(f1.domain,"domain")) { 
	} else {
		if (f1.registration_date1.value != "") {
			if (isNull(f1.registration_date,"Registration From date")) { 
				return false;
			} else {
				f1.submit();
			}
		} else {
			if (f1.registration_date.value != "") {
				if (isNull(f1.registration_date1,"Registration To date")) { 
					return false;
				} else {
					f1.submit();
				}
			} else {	
				f1.submit();
			}	
		}	
	}
}

function fnLogin () {	
	f1 = document.thisForm;
	if (isNull(f1.username,"Username")) {} else {
		if (isNull(f1.password,"password")) {} else {
			f1.submit();
		}
	}
}

function openPrint() {
	window.open("<?= $_SERVER["PHP_SELF"]; ?>?<?=$qstring?>&print=true&pass=1&membership_type=<?=GetVar("membership_type")?>","","width=600,height=600,menubar=yes,resizable=yes, scrollbars=yes");
}

</script>
<? 
	$qstring .= "&print=" . GetVar("print") . "&pass=" . GetVar("pass") . "&";
?>
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
							if (GetVar("membership_type") > 1) {
								$type = "Paid";
							} else {
								$type = "Free";
							}
						?>	
						<td class="subtitle">Sales report of <?=$type?> Members</td>
						<td align="right">
							<?=$_SESSION['Msg'];?><? $_SESSION['Msg'] = ""; ?>
						<!--<a href="view_members.php?deleteProfile=1&membership_type=<?=GetVar("membership_type")?>">View Deleted Profile(<?=$type?> Members)</a>&nbsp;&nbsp;-->
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
						
						<table cellpadding="0" align="center" cellspacing="0" border="0" width="420">							
						<? if (!$pass) { ?>
							<tr>
								<td>	
									<input type="hidden" name="action" value="login">							
									<table align="center" cellpadding="5" cellspacing="1" border="0" width="300" class="tblBorder">
										<tr class="tblContent">										
											<td align="center" width="30">Username</td>
											<td><input type="text" name="username" class="txtbox"></td>
										</tr>
										<tr class="tblContent">										
											<td align="center" width="30">Password</td>
											<td><input type="password" name="password" class="txtbox"></td>
										</tr>
										<tr class="tblContent">
											<td align="center" colspan="2"><input type="button" value="Submit" class="butten" onClick="fnLogin();"></td>
										</tr>
									</table>
								</td>
							</tr>	
						<? } else { ?>
						<input type="hidden" name="action" value="search">
						<input type="hidden" name="action1">
						<input type="hidden" name="pass" value="<?=$pass?>">
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
										<? } ?>
									</td>
									<td>
										<select name="religion" class="cmbbox" nChange="SelectCaste();" onChange="FillCaste3();">
											<option value="">-Select Religion-</option>										
										</select>										
									</td>
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
										<? } ?>
									</td>
									<td>
										<select name="state" class="cmbbox" onChange="selCity2()">
											<option value="">-Select state-</option>										
										</select>
										<select name="country_vs_state" style="display:none">
											<? GetState();	?>
										</select>
										<select name="country_vs_state1" style="display:none">
											<? GetCountryVsState();	?>
										</select>										
									</td>
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
										<? } ?>
										
									</td>
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
										<? } ?>
									</td>
								</tr>
								<tr>
									<td>Sort By Occupation</td><td>Search by Name</td><td>Search by ID</td><td>Membership type</td>
								</tr>
								<tr>						
									<td>
										<select name="occupation" class="cmbbox">
											<option value="">--Select--</option>
											<?=GetOccupation(); ?>
										</select>
										<? if (GetVar("occupation")) { ?>
											<script language="javascript">
												document.thisForm.occupation.value = "<?=GetVar("occupation")?>";	
											</script>
										<? } ?>
									</td>
									<td><input type="text" name="name" class="txtbox" value="<?=GetVar("name");?>"></td>
									<td><input type="text" name="username" class="txtbox" value="<?=GetVar("username");?>"></td>
									<td>
										<select name="membership_type" class="cmbbox">
											<option value="">--Select--</option>
											<option value="1">Free Members</option>
											<option value="2">Paid Members</option>
										</select>
										<? if (GetVar("membership_type")) { ?>
											<script language="javascript">
												document.thisForm.membership_type.value = "<?=GetVar("membership_type")?>"; 
											</script>
										<? } ?>
									</td>
								</tr>
								<tr>
									<td>Registration From Date</td><td>Registration To Date</td>
									<td>Search by Package</td><td>Search by Payment Type</td>
								</tr>
								<tr>
									<td>
									<input name="registration_date" type="text" onClick="fnShowCalendar(document.thisForm.registration_date)" maxlength="10" style="cursor:pointer;" class="datebox" readonly="true">
									<img src="images/cal.gif"  onClick="fnShowCalendar(document.thisForm.registration_date);" align="absmiddle" border="0" style="cursor:pointer;">
									<?  if (GetVar("registration_date")) {?>
										<script language="javascript">
											document.thisForm.registration_date.value="<?=GetVar("registration_date")?>";
										</script>
									<? } ?>
									</td>
									<td>
									<input name="registration_date1" type="text" onClick="fnShowCalendar(document.thisForm.registration_date1)" maxlength="10" style="cursor:pointer;" class="datebox" readonly="true">
									<img src="images/cal.gif"  onClick="fnShowCalendar(document.thisForm.registration_date1);" align="absmiddle" border="0" style="cursor:pointer;">
									<?  if (GetVar("registration_date1")) {?>
										<script language="javascript">
											document.thisForm.registration_date1.value="<?=GetVar("registration_date1")?>";
										</script>
									<? } ?>
									</td>					
									<td>
										<select name="package_id" class="cmbbox">
											<option value="">--Select--</option>
											<?=GetPackage();?>
										</select>
										<? if (GetVar("package_id")) { ?>
											<script language="javascript">
												document.thisForm.package_id.value = "<?=$_REQUEST['package_id']?>";	
											</script>
										<? } ?>
									</td>
									<td>
										<select name="Payment_Type" class="cmbbox">
											<option value="">--Select--</option>
											<? $res=mysql_query("select payment_mode from tbl_member_profile_upgrade group by payment_mode");
												while($rs=mysql_fetch_object($res)){ ?>
													<option value="<?=$rs->payment_mode?>"><?=$rs->payment_mode?></option>
												<? } ?>
										</select>
										<? if(GetVar("Payment_Type")) { ?>
											<script language="javascript">
												document.thisForm.Payment_Type.value = "<?=GetVar("Payment_Type")?>"; 
											</script>
										<? } ?>
									</td>									
								</tr>								
								
								
								
								<tr>
									<td colspan="4" align="right">
									<input type="button" value="Search" class="butten" onClick="searchMem();">
									</td>
								</tr>					
								</table>
							</td>
						</tr>
						<? } ?>
						<tr><td>&nbsp;</td></tr>
						<tr><td>
						<?	
												
						if ($action == 'search') {
						
							$sql = "select a.* from tbl_register a ";
							
							if ($_REQUEST['Payment_Type']!="") 
								$sql .= " ,tbl_member_profile_upgrade b ";
							$sql.=" where 1 = 1  ";
							if ($_REQUEST['Payment_Type']!="") 
								$sql .= "and b.member_id=username and membership_type>1 ";
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
							
							if (GetVar("package_id")) {
								$sql .= "and membership_type = '" . $_REQUEST['package_id'] . "' ";
							}
							if (GetVar("Payment_Type")) {
								$sql .= "and b.payment_mode = '" . GetVar("Payment_Type") . "' ";
								
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
							
							if (trim(GetVar("username"))) {
								$sql .= "and username = '" . GetVar("username") . "' ";
							}
							
							if (GetVar("deleteProfile")) {							
								$sql .= "and deleteProfile = '1' ";
							}						 
							
							if (GetVar("registration_date") && GetVar("registration_date1")) {
								$sql .= "and SUBSTRING(registration_date,1,10) >= '" . convertdate2(GetVar("registration_date")) . "' and  SUBSTRING(registration_date,1,10) <= '" . convertdate2(GetVar("registration_date1")) . "'";
							}
							
							$sql1 = $sql;
							//echo $sql;

							//die();
							if ($action1 != "view") {
								if (GetVar("membership_type")) {														
									if (GetVar("membership_type") > 1) {
										$sql1 .= "and membership_type > 1 ";
										if($_REQUEST['Payment_Type']!="")
											$sql1 .= "group by id order by b.created_date desc	";
										$res1 = Execute($sql1);
										$no_of_paid =  mysql_num_rows($res1);
									} else {	 
										$sql1 .= "and membership_type = 1 ";
										$res1 = Execute($sql1);
										$no_of_free =  mysql_num_rows($res1);
									}										
								} else {
									$sql2 = $sql1;
									$sql3 = $sql1;

									$sql2 .= "and membership_type > 1 ";
									if($_REQUEST['Payment_Type']!="")
										$sql2 .= "group by id order by b.created_date desc";
									$res1 = Execute($sql2);
									$no_of_paid =  mysql_num_rows($res1);
									
									$sql3 .= "and membership_type = 1 ";
									$res2 = Execute($sql3);
									$no_of_free =  mysql_num_rows($res2);								
								}								
								echo "<br><br><center>";
								if ($no_of_free && $no_of_paid) { ?>
									No of Free Members => <a href="javascript:freeMembers()"><?=$no_of_free?></a>
									&nbsp;&nbsp;No of Paid Memebers => <a href="javascript:paidMembers()"><?=$no_of_paid?></a>
								<?	
								} else if ($no_of_free)	{ ?>
									No of Free Members => <a href="javascript:freeMembers()"><?=$no_of_free?></a>
								<?	
								} else if ($no_of_paid) { ?>
									No of Paid Members => <a href="javascript:paidMembers()"><?=$no_of_paid?></a>
								<?	
								}
								echo "</center>";
							} else {
							
								if (GetVar("membership_type")) {
															
									if (GetVar("membership_type") > 1) {
										$sql .= "and membership_type > 1 ";
									} else {	 
										$sql .= "and membership_type = 1 ";
									}	
								}
								if($_REQUEST['Payment_Type']!="")
									$sql.=" group by id	";
								$sql.=" order by ";
								if($_REQUEST['Payment_Type']!="")
									$sql .= " b.payment_mode,b.created_date,";
								$sql .= " enable,verifiedStatus,userHasPhoto,userPhotoApprove,lastLogin asc ";
								$res = Execute($sql);
								echo mysql_error();
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
								 
								//echo $sql;
								//die(); 
								 
								if ($no > 0) {
									$rCnt = 1;
									$_SESSION['hidQuery']=$sql;
								?>
									<table cellpadding="5" cellspacing="1" border="0" width="700" class="tblBorder">					
									<tr class="tblHead">									
										<td width="30" align="center"><b>S.No</b></td>
										<td width="150"><b>Member Id</b></td>								
										<td width="300"><b>Name</b></td>
										<td width="100"><b>Registered Date</b></td>
										<td><b>Activation Status</b></td>
										<td width="100"><b>Verify Status</b></td>
									<?	if (GetVar("membership_type") > 1) { ?>
										<td width="100"><b>Package</b></td>
										<td width="100"><b>Payment Amount</b></td>
										<td width="100"><b>Upgraded By</b></td>
										<td width="100"><b>Payment Type</b></td>
									<?  } ?>
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
									
									while($rs=mysql_fetch_object($res)){ ?>
										<tr class="tblContent">										
											<td align="center" width="30"><? echo $rCnt ?></td>
											<td><a href="add_members.php?id=<? echo $rs->id;?>&membership_type=<?=GetVar("membership_type")?>"><? echo $rs->username;?></a></td>																		
											<td><? echo $rs->name . " [<a href='mailto: ".$rs->email."'>" .$rs->email . "</a>]";?></td>
											<td><? echo strftime("%d %b %Y",strtotime($rs->registration_date));?></td>
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
										<?	if (GetVar("membership_type") > 1) {
											 	$res_amt=mysql_query("select * from tbl_member_profile_upgrade where member_id='".$rs->username."' and package_id='".$rs->membership_type."' order by auto_id desc limit 0,1");
												$rs_amt=mysql_fetch_object($res_amt);
												$package_amount=$rs_amt->package_amount;
											   $total_amt=$total_amt + $package_amount; ?>
											<td><?=GetSingleField("package_name","tbl_packages","package_id",$rs->membership_type);?></td>
											<td align="center"><?=$package_amount?></td>
											<td>
											<?
												$package_res =  Execute("select * from tbl_member_profile_upgrade where member_id = '" . $rs->username . "' order by auto_id desc limit 0,1");//and payment_status = '1' 
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
											<td><?=GetVar("Payment_Type")?></td><!--$package_rs[payment_mode]-->
										<?	}	?>
											<? if (GetVar("deleteProfile")) { ?>
											<td>
												<input type="button" class="butten" value="View Reason" onClick="javascript:location.href='delete_reason.php?id=<?=$rs->id;?>'">
											</td>	
											<? } ?>
										</tr>
								<?
										$rCnt++;
									}	?>
									<?	if (GetVar("membership_type") > 1) { ?>
									<tr><td colspan="7" align="right" bgcolor="#FFFFFF">Total Amount</td>
										<td olspan="3" align="center" bgcolor="#FFFFFF"><?=$total_amt;?></td>
										<td colspan="2" bgcolor="#FFFFFF"></td>
									</tr>
									<? } ?>	
									<tr><td colspan="10" align="center" bgcolor="#FFFFFF">
									<?	if (GetVar("membership_type") > 1) { ?>
										<a href="exportxls.php?Report=1"><input value="Export To Excel" class="butten"></a>
									<?  } else { ?>
										<a href="exportxls.php?Report=2"><input value="Export To Excel" class="butten"></a>
									<?  } ?>
									<? if (!$print) { ?>
										<input type="button" value="Show Printable List" class="butten" onClick="openPrint()">
									<? } else { ?>
									
										<input type="button" value="Print" class="butten" onClick="javascript:window.print();">
										<input type="button" value="Close" class="butten" onClick="javascript:window.close();">																												
									<? } ?>
									</td></tr>
									</table>
									<?
									getpageNumbers($pager->numPages,$page,"member_sales_report.php?$qstring"); 
									mysql_free_result($res);
								} else {
									echo "<br><br><center>No members details Found.</center>";
								}
							} // end of action1	
						}  // end of action 	
						?>						
						</td></tr>
						<? } ?>
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