<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
$linkid=db_connect();
$arg="caste_report_status";
isAdmin($arg);

$id = GetVar('id');
$action = GetVar('action');

if ($action == "save") {

	$res = Execute("select id from tbl_religion_master where domain = '" . GetVar('domain') . "' and id = '" . GetVar('religion') . "'");
	
	if (mysql_num_rows($res) > 0) {	
					
		//$_SESSION['_msg'] = "Sorry religion " . GetVar('religion') . " already exist in the domain ". GetVar('domain');
		$religionid = mysql_fetch_array($res);
		$religionid = $religionid[0];		
		$caste = GetSingleRecord("tbl_caste_master","religionid",$religionid);
		if ($caste) {
			$resCaste = Execute("select * from tbl_caste_master where caste = '".GetVar('caste')."' and religionid='$religionid'");
			$no_caste = mysql_num_rows($resCaste);
			if ($no_caste > 0) {				
				$domain = GetSingleField("domain","tbl_domain_master","id",GetVar('domain'));
				$_SESSION['_msg'] = "Caste already exist in the domain $domain and religion " . GetVar('religion');
			} else {
				$_POST['religionid'] = $religionid;
				$sql = DTMLCreateRecord("tbl_caste_master",$_POST);	
				$res = Execute($sql);
				$_SESSION['_msg'] = "Added Successfully";
				header("Location: add_caste.php");
				die();
			}				
		} else {
			$_POST['religionid'] = $religionid;
			$sql = DTMLCreateRecord("tbl_caste_master",$_POST);	
			$res = Execute($sql);
			$_SESSION['_msg'] = "Added Successfully";
			header("Location: add_caste.php");
			die();
		} 
	} else {
		$domain = GetSingleField("domain","tbl_domain_master","id",GetVar('domain'));			
		$_SESSION['_msg'] = "Regligion doesn't exist in the domain $domain";
		header("Location: add_caste.php");
		die();
	}	
} else if ($action == "update") {	
	$res = Execute("select id from tbl_religion_master where domain = '" . GetVar('domain') . "' and id = '" . GetVar('religion') . "'");
	if (mysql_num_rows($res) > 0) {
		$religionid = mysql_fetch_array($res);
		$religionid = $religionid[0];
		$resCaste = Execute("select * from tbl_caste_master where religionid = '$religionid' and caste = '" . GetVar("caste") . "' and id != '$id'");
		if (mysql_num_rows($resCaste) > 0 ) {
			$domain = GetSingleField("domain","tbl_domain_master","id",GetVar('domain'));
			$_SESSION['_msg'] = "Caste already exist in the domain $domain and religion " . GetVar('religion');
		} else {
			$_POST['religionid'] = $religionid;
			$sql = DTMLUpdateRecord($id,"tbl_caste_master",$_POST);
			$res = Execute($sql);
			$_SESSION['_msg'] = "Updated Successfully";
			header("Location: add_caste.php?id=$id");
			die();
		}
	} else {		
		$domain = GetSingleField("domain","tbl_domain_master","id",GetVar('domain'));
		$_SESSION['_msg'] = "Regligion doesn't exist in the domain $domain";
		header("Location: add_caste.php?id=$id");
		die();
	}
}

if ($id) { $caste = GetSingleRecord("tbl_caste_master","id",$id); }
if ($caste) { $religion =  GetSingleRecord("tbl_religion_master","id",$caste[religionid]); }

?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/functions.js"></script>
<!-- START : Included Script and Styles for Text Editor -->	
<link href="includes/rte.css" rel="stylesheet" type="text/css">
<!-- END : Included Script and Styles for Text Editor -->
<script language="JavaScript">
function fnValidate(f1) {
	if (notSelected(f1.domain,"Domain")) { return false; }
	if (notSelected(f1.religion,"Religion")) { return false; }
	if (isNull(f1.caste,"Caste")) { return false; }
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
						<td class="subtitle">Manage Caste</td>
						<td align="right"><a href="view_caste.php">View Caste</a></td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
				<?
					if ($id) {
						$secMode="update";						
					} else {
						$secMode="save";
					}
				?>
				<form name="thisForm" method="post" onSubmit="return fnValidate(this);" action="add_caste.php">
				<input type="hidden" name="id" value="<? echo($id);?>">					
				<input type="hidden" name="action" value="<? echo $secMode?>">
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="520">
						<tr><td>
							<table cellpadding="10" cellspacing="1" border="0" width="500" class="tblBorder">
							<tr class="tblHead"><td align="center"><b>
								<?
								if ($id) {
									echo "Update Caste";
								} else {
									echo "Add Caste";
								}
								?>
							</b></td></tr>
							<tr class="tblContent"><td>
								<table cellpadding="5" cellspacing="1" border="0" width="500" class="tblBorder">								
									<tr class="tblContent">
										<td>Select Domain <font color="#FF0000">*</font></td>
										<td>
											<select name="domain" class="cmbbox" onChange="selReligion()">												
												<option value="">Select</option>
												<?	$resDomain = Execute("select * from tbl_domain_master order by id");
													if (mysql_num_rows($resDomain) > 0) {
														while ($domain = mysql_fetch_array($resDomain)) {									
													?>
													<option value="<?=$domain[id]?>"><?=$domain[domain]?></option>
												<?  	}
													} ?>
											</select>
											<script language="javascript">
												document.thisForm.domain.value = "<?=$religion[domain]?>";
											</script>
										</td>
									</tr>
									<tr class="tblContent">
										<td>Select Religion <font color="#FF0000">*</font></td>
										<td>
											<select name="religion" class="cmbbox">
												<option value="">Select</option>												
											</select>
										<!--<input type="text" name="religion" class="txtbox" value="<?=$religion[religion]?>">-->
										</td>	
									</tr>	
									<tr class="tblContent">
										<td>Enter Caste <font color="#FF0000">*</font></td>
										<td><input type="text" class="txtbox" name="caste" value="<?=$caste[caste]?>"></td>
									</tr>								
									<tr class="tblContent">
										<td align="center" height="30" colspan="2">
											<input type="submit" value="Save" class="butten">
										</td>
									</tr>
									<select name="region_vs_caste" style="visibility:hidden">
										<?
											$res = Execute("select * from tbl_religion_master order by id");
											if (mysql_num_rows($res) > 0) {
												while($region1 = mysql_fetch_array($res)) { ?>
													<option value="<?=$region1[religion]?>"><?=$region1[domain]?></option>														
										<?		}
											}
										?>
									</select>
									<select name="domain_vs_religion" style="display:none">
									<?
										$resReligion = Execute("select * from tbl_religion_master order by id");
										if (mysql_num_rows($resReligion) > 0) { 
											while ($ReligionMaster = mysql_fetch_array($resReligion)) {
											?>
											<option value="<?=$ReligionMaster[id]?>"><?=$ReligionMaster[domain]?></option>
										<?  }
										 }	?>
									</select>
									<select name="domain_vs_religion1" style="display:none">
										<?
											$resReligion = Execute("select * from tbl_religion_master order by id");
											if (mysql_num_rows($resReligion) > 0) { 
												while ($ReligionMaster = mysql_fetch_array($resReligion)) {
												?>
												<option value="<?=$ReligionMaster[id]?>"><?=$ReligionMaster[religion]?></option>
											<?  }
											 }	?>
									</select>
									<script language="javascript">
										selReligion();										
										document.thisForm.religion.value = "<?=$religion[id]?>";
									</script>
								</table>
							</td></tr>
							</table>
						</td></tr>
						</table>
				 	</td></tr>
					<tr><td height="10"></td></tr>
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