<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging1.php");
include("includes/menu.php");
$linkid = db_connect();

$arg = "caste_report_status";
isAdmin($arg);


if ($_REQUEST['mode'] == "del") {
	if($_REQUEST['ChkS']<>""){
		for($i=0;$i<count($_REQUEST['ChkS']);$i++){			
			$sql_chk="select * from tbl_caste_master where id = '" . $_REQUEST['ChkS'][$i] . "'";
			$res_chk=mysql_query($sql_chk);
			if(mysql_num_rows($res_chk)>0){	
				$sql="delete from tbl_caste_master where id = '" . $_REQUEST['ChkS'][$i] . "'";
				mysql_query($sql);
				echo mysql_error();			
				$_SESSION['_msg']="Deleted Successfully"; 		
			}			
	  	}

		header("location:view_caste.php");
		die();
	}
}	

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
function fnDelete() {
	if(notChecked(document.thisForm.elements["ChkS[]"],"caste to delete")) {return;}
	if(confirm("Are you sure to delete the selected caste(s)?")){
		document.thisForm.action="view_caste.php?mode=del";
		document.thisForm.submit();
	} else {
		return false;
	}
}
function sortCaste() {
	f1 = document.thisForm;
	if (notSelected(f1.domain,"domain")) { 
	} else {
		document.thisForm.submit();
	}	
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
						<td class="subtitle">Manage Caste</td>
						<td align="right"><a href="add_caste.php">Add Caste</a></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
					<form name="thisForm" method="get">	
						<table cellpadding="0" align="center" cellspacing="0" border="0" width="420">							
						<tr>
							<td align="center">
								<table><tr><td>
								Sort By Domain&nbsp;
									<select name="domain" class="cmbbox" onChange="selReligion1()">
										<option value="" selected>-Select A Domain-</option>	
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
								</td></tr>
								<tr><td>
								Sort By Religion&nbsp;
									<select name="religion" class="cmbbox">
										<option value="">-Select Religion-</option>										
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
									<? if (GetVar("domain")) { ?>
										<script language="javascript" type="text/javascript">
											selReligion1();
										</script>											
									<? } ?>	
									<? if (GetVar("religion")) { ?>
										<script language="javascript" type="text/javascript">											
											document.thisForm.religion.value = "<?=GetVar("religion");?>";
										</script>
									<? } ?>	
								</td>
								<td><input type="button" value=" Go " class="butten" onClick="sortCaste();"></td>	
								</tr>								
								</table>
							</td>
						</tr>
						<tr><td>
						<?
						$qstring = "domain=" . GetVar("domain") . "&religion=" . GetVar("religion") . "&";
						if (GetVar("domain") && GetVar("religion")) {
							$sql = "select * from tbl_caste_master where religionid = '" . GetVar("religion") . "' order by religionid asc";
						} else if (GetVar("domain")) {
							$sql = "select * from tbl_caste_master where religionid in (select id from tbl_religion_master where domain = '" . GetVar("domain") . "') order by religionid asc";							
						} else {
							$sql = "select * from tbl_caste_master order by religionid asc";
						}	
						$res = mysql_query($sql);	
						echo mysql_error();
						$no = mysql_num_rows($res);
							//pager starts Here
						if ($_REQUEST['page']=="")
							$page =1;
						else
							$page=$_REQUEST['page'];
							$total	=	$no;
							$limit	=	50;
							$pager	=	Pager::getPagerData($total, $limit, $page);
							$offset	=	$pager->offset;
							$limit	=	$pager->limit;
							$page	= 	$pager->page;
						//pager ends Here
						$res = mysql_query($sql." limit  $offset, $limit"); 
						if ($no > 0) {
							$rCnt=1;	
						?>
							<table cellpadding="5" cellspacing="1" border="0" width="550" class="tblBorder">
							
							<tr class="tblHead">
								<td widht='30' align="center"><b>Select</b></td>
								<td width="30" align="center"><b>S.No</b></td>
								<td width="250"><b>Domain</b></td>
								<td width="250"><b>Religion</b></td>								
								<td width="250"><b>Caste</b></td>
 							</tr>
						<?
							if ($page!=1){
								$rCnt = ($limit*($page-1)+1);
							} else {
								$rCnt=1;
							}
							while($rs=mysql_fetch_object($res)){ 
								$religion = GetSingleRecord("tbl_religion_master","id",$rs->religionid);
								$domain = GetSingleField("domain","tbl_domain_master","id",$religion[domain]);
									   
								 ?>
						
								<tr class="tblContent">
									<td width="30" align="center"><input type='checkbox' name="ChkS[]" value='<? echo $rs->id?>'></td>
									<td align="center" width="30"><? echo $rCnt ?></td>
									<td width="250"><?=$domain?></td>
									<td width="250"><?=$religion[religion]?></td>
									<td width="250"><a href="add_caste.php?id=<? echo $rs->id;?>"><? echo $rs->caste;?></a></td>									
 								</tr>
						<?
								$rCnt++;
							}	?>		
							<tr><td colspan="5" align="center" bgcolor="#FFFFFF"><input type="button" name="btnClick" class="butten" value="Delete" onClick="fnDelete()"></td></tr>					
							
							</table>
							<table width="600">
								<tr><td width="600">
							<? getpageNumbers($pager->numPages,$page,"view_caste.php?$qstring");?>
								</td></tr>
							</table>	
						<?
							mysql_free_result($res);
						}else{
							echo "<br><br><center>No Caste(s) details Found.</center>";
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