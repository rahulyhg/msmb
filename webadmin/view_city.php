<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging1.php");
include("includes/menu.php");
$linkid = db_connect();

$arg="package_status";
isAdmin($arg);


if ($_REQUEST['mode'] == "del") {
	if($_REQUEST['ChkS']<>""){
		
		for($i=0;$i<count($_REQUEST['ChkS']);$i++){			
			$sql_chk="select * from tbl_city_master where id = '" . $_REQUEST['ChkS'][$i] . "'";
			$res_chk=mysql_query($sql_chk);
			if(mysql_num_rows($res_chk)>0){	
				$sql="delete from tbl_city_master where id = '" . $_REQUEST['ChkS'][$i] . "'";
				mysql_query($sql);
				echo mysql_error();			
				$_SESSION['_msg']="Deleted Successfully"; 		
			}			
	  	}
		
		header("location:view_city.php");
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
	if(notChecked(document.thisForm.elements["ChkS[]"],"city to delete")) {return;}
	if(confirm("Are you sure to delete the selected cities?")){
		document.thisForm.action="view_city.php?mode=del";
		document.thisForm.submit();
	} else {
		return false;
	}
}
function sortCity() {
	f1 = document.thisForm;
	if (notSelected(f1.country,"country")) { 
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
						<td class="subtitle">Manage City</td>
						<td align="right"><a href="add_city.php">Add City</a></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
					<form name="thisForm" method="post"> 
						<table cellpadding="0" align="center" cellspacing="0" border="0" width="420">							
						<tr>
							<td align="center">
								<table><tr><td>
								Sort By country&nbsp;
									<select name="country" class="cmbbox" onChange="selState3()">
										<option value="" selected>-Select A Country-</option>
										<?	$resCountry = Execute("select * from tbl_country_master order by id");
											if (mysql_num_rows($resCountry) > 0) {
												while ($country = mysql_fetch_array($resCountry)) {								
											?>
											<option value="<?=$country[id]?>"><?=$country[country]?></option>
										<?  	}
											} ?>	
									</select>
									<? if (GetVar("country")) { ?>
										<script language="javascript" type="text/javascript">
											document.thisForm.country.value = "<?=GetVar("country");?>";
										</script>
									<? } ?>
								</td></tr>
								<tr><td>
								Sort By state&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<select name="state" class="cmbbox">
										<option value="">-Select state-</option>										
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
											selState3();
										</script>
									<? } ?>	
									<? if (GetVar("state")) { ?>
										<script language="javascript" type="text/javascript">
											document.thisForm.state.value = "<?=GetVar("state");?>";
										</script>
									<? } ?>	
								</td>
								<td><input type="button" value=" Go " class="butten" onClick="sortCity();"></td>	
								</tr>								
								</table>
							</td>
						</tr>
						<tr><td>
						<?
						$qstring = "country=" . GetVar("country") . "&state=" . GetVar("state") . "&";
						if (GetVar("country") && GetVar("state")) {
							$sql = "select * from tbl_city_master where stateid = '" . GetVar("state") . "' order by stateid asc";
						} else if (GetVar("country")) {
							$sql = "select * from tbl_city_master where stateid in (select id from tbl_state_master where country = '" . GetVar("country") . "') order by stateid asc";							
						} else {
							$sql = "select * from tbl_city_master order by stateid asc";
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
								<td width="250"><b>Country</b></td>
								<td width="250"><b>State</b></td>								
								<td width="250"><b>City</b></td>
 							</tr>
						<?
							if ($page!=1){
								$rCnt = ($limit*($page-1)+1);
							} else {
								$rCnt=1;
							}
							while($rs=mysql_fetch_object($res)){ 
								$state = GetSingleRecord("tbl_state_master","id",$rs->stateid);
								$country = GetSingleField("country","tbl_country_master","id",$state[country]);
									   
								 ?>
						
								<tr class="tblContent">
									<td width="30" align="center"><input type='checkbox' name="ChkS[]" value='<? echo $rs->id?>'></td>
									<td align="center" width="30"><? echo $rCnt ?></td>
									<td width="250"><?=$country?></td>
									<td width="250"><?=$state[state]?></td>
									<td width="250"><a href="add_city.php?id=<? echo $rs->id;?>"><? echo $rs->city;?></a></td>									
 								</tr>
						<?
								$rCnt++;
							}	?>		
							<tr><td colspan="5" align="center" bgcolor="#FFFFFF"><input type="button" name="btnClick" class="butten" value="Delete" onClick="fnDelete()"></td></tr>					
							
							</table>
							<table width="600">
								<tr><td width="600">
							<? getpageNumbers($pager->numPages,$page,"view_city.php?$qstring");?>
								</td></tr>
							</table>	
						<?
							mysql_free_result($res);
						}else{
							echo "<br><br><center>No cities details Found.</center>";
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