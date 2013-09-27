<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
$linkid=db_connect();
$arg="religion_report_status";
isAdmin($arg);

$id = GetVar('id');
$action = GetVar('action');

if ($action == "save") {
	$res = Execute("select * from tbl_religion_master where domain = '" . GetVar('domain') . "' and religion = '" . GetVar('religion') . "'");
	if (mysql_num_rows($res) > 0) {			
		$domain = GetSingleField("domain","tbl_domain_master","id",GetVar('domain'));
		$_SESSION['_msg'] = "Sorry religion " . GetVar('religion') . " already exist in the domain $domain";
	} else {		
		$sql = DTMLCreateRecord("tbl_religion_master",$_POST);	
		$res = Execute($sql);
		$_SESSION['_msg'] = "Added Successfully";
		header("Location: add_religions.php");
		die();
	}	
} else if ($action == "update") {
	$res = Execute("select * from tbl_religion_master where domain = '" . GetVar('domain') . "' and religion = '" . GetVar('religion') . "' where id != '$id'");
	if (mysql_num_rows($res) > 0) {
		$domain = GetSingleField("domain","tbl_domain_master","id",GetVar('domain'));
		$_SESSION['_msg'] = "Sorry religion " . GetVar('religion') . " already exist in the domain $domain";
	} else {
		$sql = DTMLUpdateRecord($id,"tbl_religion_master",$_POST);
		$res = Execute($sql);
		$_SESSION['_msg'] = "Updated Successfully";
		header("Location: add_religions.php?id=$id");
		die();
	}
}

if($id) { $religion = GetSingleRecord("tbl_religion_master","id",$id); } ?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<!-- START : Included Script and Styles for Text Editor -->	
<link href="includes/rte.css" rel="stylesheet" type="text/css">
<!-- END : Included Script and Styles for Text Editor -->
<script language="JavaScript">
function fnValidate(f1) {
	if (notSelected(f1.domain,"Domain")) { return false; }
	if (isNull(f1.religion,"Religion")) { return false; }
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
						<td class="subtitle">Manage Religions</td>
						<td align="right"><a href="view_religions.php">View Religions</a></td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
				<?
					if ($id == "") {
						$secMode="save";
					} else {
						$secMode="update";
					}
				?>
				<form name="thisForm" method="post" onSubmit="return fnValidate(this);" action="add_religions.php">
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
									echo "Update Religion";
								} else {
									echo "Add Religion";
								}
								?>
							</b></td></tr>
							<tr class="tblContent"><td>
								<table cellpadding="5" cellspacing="1" border="0" width="500" class="tblBorder">								
									<tr class="tblContent">
										<td>Select Domain <font color="#FF0000">*</font></td>
										<td>
											<select name="domain" class="cmbbox">												
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
										<td>Enter Religion 	<font color="#FF0000">*</font></td>
										<td><input type="text" name="religion" class="txtbox" value="<?=$religion[religion]?>"></td>	
									</tr>								
									<tr class="tblContent">
										<td align="center" height="30" colspan="2">
											<input type="submit" value="Save" class="butten">
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