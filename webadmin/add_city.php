<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
$linkid=db_connect();
$arg="package_status";
isAdmin($arg);

$id = GetVar('id');
$action = GetVar('action');

if ($action == "save") {
	$res = Execute("select id from tbl_state_master where country = '" . GetVar('country') . "' and id = '" . GetVar('state') . "'");
	if (mysql_num_rows($res) > 0) {						
		
		$stateid = mysql_fetch_array($res);
		$stateid = $stateid[0];		
		$city = GetSingleRecord("tbl_city_master","stateid",$stateid);
		
		if ($city) {
		
			$rescity = Execute("select * from tbl_city_master where city = '".GetVar('city')."' and stateid = '$stateid'");
			$no_city = mysql_num_rows($rescity);
			if ($no_city > 0) {	
						
				$country = GetSingleField("country","tbl_country_master","id",GetVar('country'));
				$state = GetSingleField("state","tbl_state_master","id",GetVar('state'));
				$_SESSION['_msg'] = "city already exist in the country $country and state $state";
			} else {
			
				$_POST['stateid'] = $stateid;
				$sql = DTMLCreateRecord("tbl_city_master",$_POST);
				$res = Execute($sql);
				$_SESSION['_msg'] = "Added Successfully";
				header("Location: add_city.php");
				die();
			}				
		} else {
		
			$_POST['stateid'] = $stateid;
			$sql = DTMLCreateRecord("tbl_city_master",$_POST);	
			$res = Execute($sql);
			$_SESSION['_msg'] = "Added Successfully";
			header("Location: add_city.php");
			die();
		} 
	} else {
	
		$country = GetSingleField("country","tbl_country_master","id",GetVar('country'));			
		$_SESSION['_msg'] = "State doesn't exist in the country $country";
		header("Location: add_city.php");
		die();
	}	
} else if ($action == "update") {	

	$res = Execute("select id from tbl_state_master where country = '" . GetVar('country') . "' and id = '" . GetVar('state') . "'");
	if (mysql_num_rows($res) > 0) {
	
		$stateid = mysql_fetch_array($res);
		$stateid = $stateid[0];
		$rescity = Execute("select * from tbl_city_master where stateid = '$stateid' and city = '" . GetVar("city") . "' and id != '$id'");
		if (mysql_num_rows($rescity) > 0 ) {
		
			$country = GetSingleField("country","tbl_country_master","id",GetVar('country'));
			$state = GetSingleField("state","tbl_state_master","id",GetVar('state'));
			$_SESSION['_msg'] = "city already exist in the country $country and state $state";
		} else {
		
			$_POST['stateid'] = $stateid;
			$sql = DTMLUpdateRecord($id,"tbl_city_master",$_POST);
			$res = Execute($sql);
			$_SESSION['_msg'] = "Updated Successfully";
			header("Location: add_city.php?id=$id");
			die();
		}
	} else {	
		
		$country = GetSingleField("country","tbl_country_master","id",GetVar('country'));
		$_SESSION['_msg'] = "Regligion doesn't exist in the country $country";
		header("Location: add_city.php?id=$id");
		die();
	}
}

if ($id) { $city = GetSingleRecord("tbl_city_master","id",$id); }
if ($city) { $state =  GetSingleRecord("tbl_state_master","id",$city[stateid]); }

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
	if (notSelected(f1.country,"country")) { return false; }
	if (notSelected(f1.state,"state")) { return false; }
	if (isNull(f1.city,"city")) { return false; }
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
						<td class="subtitle">Manage City</td>
						<td align="right"><a href="view_city.php">View City</a></td>
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
				<form name="thisForm" method="post" onSubmit="return fnValidate(this);" action="add_city.php">
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
									echo "Update City";
								} else {
									echo "Add City";
								}
								?>
							</b></td></tr>
							<tr class="tblContent"><td>
								<table cellpadding="5" cellspacing="1" border="0" width="500" class="tblBorder">								
									<tr class="tblContent">
										<td>Select Country <font color="#FF0000">*</font></td>
										<td>
											<select name="country" class="cmbbox" onChange="selState3()">												
												<option value="">Select</option>
												<?	$rescountry = Execute("select * from tbl_country_master order by id");
													if (mysql_num_rows($rescountry) > 0) {
														while ($country = mysql_fetch_array($rescountry)) {									
													?>
													<option value="<?=$country[id]?>"><?=$country[country]?></option>
												<?  	}
													} ?>
											</select>
											<script language="javascript">
												document.thisForm.country.value = "<?=$state[country]?>";
											</script>
										</td>
									</tr>
									<tr class="tblContent">
										<td>Select state <font color="#FF0000">*</font></td>
										<td>
											<select name="state" class="cmbbox">
												<option value="">Select</option>
											</select>
											<select name="country_vs_state" style="display:none">
												<?
													$resstate = Execute("select * from tbl_state_master order by id");
													if (mysql_num_rows($resstate) > 0) { 
														while ($stateMaster = mysql_fetch_array($resstate)) {
														?>
														<option value="<?=$stateMaster[id]?>"><?=$stateMaster[country]?></option>
													<?  }
													 }	?>
											</select>
											<select name="country_vs_state1" style="display:none">
												<?
													$resstate = Execute("select * from tbl_state_master order by id");
													if (mysql_num_rows($resstate) > 0) { 
														while ($stateMaster = mysql_fetch_array($resstate)) {
														?>
														<option value="<?=$stateMaster[id]?>"><?=$stateMaster[state]?></option>
													<?  }
													 }	?>
											</select>
											<? if (GetVar("country")) { ?>
												<script language="javascript" type="text/javascript">
													selState2();
												</script>
											<? } ?>	
											<? if (GetVar("state")) { ?>
												<script language="javascript" type="text/javascript">											
													document.thisForm.state.value = "<?=GetVar("state");?>";
												</script>
											<? } ?>	
										<!--<input type="text" name="state" class="txtbox" value="<?=$state[state]?>">-->
										</td>	
									</tr>	
									<tr class="tblContent">
										<td>Enter city <font color="#FF0000">*</font></td>
										<td><input type="text" class="txtbox" name="city" value="<?=$city[city]?>" maxlength="100"></td>
									</tr>								
									<tr class="tblContent">
										<td align="center" height="30" colspan="2">
											<input type="submit" value="Save" class="butten">
										</td>
									</tr>									
									<script language="javascript">
										selState2();										
										document.thisForm.state.value = "<?=$state[id]?>";
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