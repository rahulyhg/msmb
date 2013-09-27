<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging1.php");
include("includes/menu.php");

$linkid = db_connect();

$arg="franchise_account_status";
isAdmin($arg);

$action = GetVar("action");
$pass = GetVar("pass");
$print = GetVar("print");

if (!$pass) { $pass = 0; }

if ($action == "login") {
	if (GetVar("username") == 'test' && GetVar("password") == 'test') {
		//$pass = "1";
		header("location: franchises_sales_report.php?pass=1");
		die();
	} else {
		$pass = "0";
		$_SESSION['Msg'] = 'Invalid username and password';
	}
}

$qstring = "action=" . GetVar("action") . "&country=" . GetVar("country") . "&state=" . GetVar("state") . "&city=" . GetVar("city");
$qstring .= "&created_date1=" . GetVar("created_date1") . "&created_date1=" . GetVar("created_date1") . "&";

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
function searchFranchise() {
	f1 = document.thisForm;
	f1.submit();	
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
	window.open("<?= $_SERVER["PHP_SELF"]; ?>?<?=$qstring?>&print=true&pass=1","","width=600,height=600,menubar=yes,resizable=yes, scrollbars=yes");
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
						<td class="subtitle">Franchise sales report</td>
						<!--<td align="right"><a href="add_franchisee.php">Add Franchise</a></td>-->
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
						<? if (!$print) { ?>
						<tr>
							<td align="center">
								<table cellpadding="2" cellspacing="2">
									<tr>
										<td>Sort By Country</td><td>Sort By State</td><td>Sort By City</td>
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
									</tr>
									<tr>
										<td>A/C Created From Date</td><td>A/C Created To Date</td>
									</tr>
									<tr>
										<td>
										<input name="created_date" type="text" onClick="fnShowCalendar(document.thisForm.created_date)" maxlength="10" style="cursor:pointer;" class="datebox" readonly="true">
										<img src="images/cal.gif"  onClick="fnShowCalendar(document.thisForm.created_date);" align="absmiddle" border="0" style="cursor:pointer;">
										<?  if (GetVar("created_date")) {?>
											<script language="javascript">
												document.thisForm.created_date.value="<?=GetVar("created_date")?>";
											</script>
										<? } ?>
										</td>
										<td>
										<input name="created_date1" type="text" onClick="fnShowCalendar(document.thisForm.created_date1)" maxlength="10" style="cursor:pointer;" class="datebox" readonly="true">
										<img src="images/cal.gif"  onClick="fnShowCalendar(document.thisForm.created_date1);" align="absmiddle" border="0" style="cursor:pointer;">
										<?  if (GetVar("created_date1")) {?>
											<script language="javascript">
												document.thisForm.created_date1.value="<?=GetVar("created_date1")?>";
											</script>
										<? } ?>
										</td>
										<td colspan="2" align="right">
										<input type="button" value="Search" class="butten" onClick="searchFranchise();">
										</td>
									</tr>
								</table>
							</td>
						</tr>
						</table>
						</td>
					</tr>
					<? } ?>
					<? if ($action == "search") { ?>	
					<tr><td align="center" valign="top">
						<table cellpadding="0" align="center" cellspacing="0" border="0" width="420">
						<tr><td>
						<?						
						$sql = "select * from tbl_franchisee where auto_id in (select franchise_auto_id from tbl_member_profile_upgrade where 1=1 ";
						
						if (GetVar("created_date")) {
							$sql .= "and created_date >= '" . convertdate2(GetVar("created_date")) . "' ";
						}
						if (GetVar("created_date1")) {
							$sql .= "and created_date <= '" . convertdate2(GetVar("created_date1")) . "' ";
						}						
						
						$sql .= "group by franchise_auto_id)";
						
						if (GetVar("country")) {
							$sql .= " and country = '" . GetVar("country") . "'";
						}
						
						if (GetVar("state")) {
							$sql .= " and state = '" . GetVar("state") . "'";
						}
						
						if (GetVar("city")) {
							$sql .= " and city = '" . GetVar("city") . "'";
						}
						
						$sql .= " order by credit_amount asc";					
						
						$res=mysql_query($sql);	
						echo mysql_error();
						$no=mysql_num_rows($res);
							//pager starts Here
						if($_REQUEST['page']=="")
							$page =1;
						else
							$page=$_REQUEST['page'];
							$total	=	$no;
							$limit	=	10;
							$pager	=	Pager::getPagerData($total, $limit, $page);
							$offset	=	$pager->offset;
							$limit	=	$pager->limit;
							$page	= 	$pager->page;
						//pager ends Here
						$res=mysql_query($sql." limit  $offset, $limit"); 
						if($no>0){
							$rCnt=1;	
						?>
							<table cellpadding="5" cellspacing="1" border="0" width="790" class="tblBorder">
							<form name="thisForm" method="post">
							<tr class="tblHead">								
								<td align="center"><b>S.No</b></td>
								<td><b>Franchisee Name</b></td>								
								<td><b>Franchisee Email</b></td>
								<td><b>Credit Amount Paid </b></td>
								<td><b>Balance Amount</b></td>
								<td><b>Active Status</b></td>			
								<td><b>Payment Report</b></td>								
 							</tr>
						<?
							if ($page!=1){
								$rCnt = ($limit*($page-1)+1);
							} else {
								$rCnt=1;
							}
							while($rs=mysql_fetch_object($res)){ ?>
								<tr class="tblContent">									
									<td align="center"><? echo $rCnt ?></td>
									<td><? echo $rs->franchisee_name;?>[<?=$rs->franchisee_id;?>]</td>									
									<td><? echo $rs->franchisee_email;?></td>
									<td><? echo $rs->credit_amount;?></td>
									<td><? echo $rs->balance_credit_amount;?></td>
									<td>
									<? if($rs->franchisee_status=="N"){?>
										<img src="images/cross.gif" border="0">	
									<? }else{?>
										<img src="images/tick.gif" border="0">
									<? }?>
									</td>		
									<td>
										<a href="view_franchise_payment_report.php?back=1&franchise_auto_id=<? echo $rs->auto_id;?>&franchise_id=<? echo $rs->franchisee_id;?>&created_from_date=<?=convertdate2(GetVar("created_date"))?>&created_to_date=<?=convertdate2(GetVar("created_date1"))?>">Payment Report</a>
									</td>									
 								</tr>
						<?
								$rCnt++;
							}	?>
								<tr><td colspan="7" align="center" bgcolor="#FFFFFF">
									<? if (!$print) { ?>
										<input type="button" value="Show Printable List" class="butten" onClick="openPrint()">
									<? } else { ?>
									
										<input type="button" value="Print" class="butten" onClick="javascript:window.print();">
										<input type="button" value="Close" class="butten" onClick="javascript:window.close();">																												
									<? } ?>
								</td></tr>							
							</form>
							</table>
							<? getpageNumbers($pager->numPages,$page,"franchises_sales_report.php?$qstring&"); ?>
						<?
							mysql_free_result($res);
						}else{
							echo "<br><br><center>No Franchise details Found.</center>";
						}
						?>
						</td></tr>
						<? } ?>
						</table>
					</td></tr>
					<? } ?>
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