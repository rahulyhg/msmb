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

if($_REQUEST['mode']=="del"){
	if($_REQUEST['ChkS']<>""){
		for($i=0;$i<count($_REQUEST['ChkS']);$i++){					
				$sql="delete from tbl_franchisee where auto_id=".$_REQUEST['ChkS'][$i];				
				mysql_query($sql);
				fnDelete($_REQUEST['ChkS'][$i]);
				echo mysql_error();			
				$_SESSION['_msg']="Deleted Successfully"; 								
	  	}
		header("location:view_franchisee.php");
		die();
	}
}	

if($_REQUEST['Mode']=="Activate"){
	if($_REQUEST['ChkS']<>""){
		for($i=0;$i<count($_REQUEST['ChkS']);$i++){
			$sql="update tbl_franchisee set franchisee_status='Y' where auto_id =".$_REQUEST['ChkS'][$i];
			mysql_query($sql);
			echo mysql_error();
			fnActive($_REQUEST['ChkS'][$i]);
									
			
		}
		$_SESSION['_msg']="Franchisee Account(s) Activated successfully";
	}	
	header("location:view_franchisee.php");
	die();
	
}

if($_REQUEST['Mode']=="DeActivate"){
	if($_REQUEST['ChkS']<>""){
		for($i=0;$i<count($_REQUEST['ChkS']);$i++){
			$sql="update tbl_franchisee set franchisee_status='N' where auto_id =".$_REQUEST['ChkS'][$i];
			mysql_query($sql);
			fnDeActive($_REQUEST['ChkS'][$i]);
			echo mysql_error();						
		}
		$_SESSION['_msg']="Franchisee Account(s) De-Activated successfully";
	}	
	header("location:view_franchisee.php");
	die();
	
}

function fnActive($arg){
	$res_chk=mysql_query("select * from tbl_franchisee where auto_id=".$arg);
	if(mysql_num_rows($res_chk)>0){
		$obj=mysql_fetch_object($res_chk);		
	}
	$sql_update="update php121_users set php121_banned='0' where uemail='".$obj->franchisee_email."' and uname='".$obj->franchisee_username."'";
	mysql_query($sql_update);
	echo mysql_error();					
}
function fnDeActive($arg){
	$res_chk=mysql_query("select * from tbl_franchisee where auto_id=".$arg);
	if(mysql_num_rows($res_chk)>0){
		$obj=mysql_fetch_object($res_chk);		
	}
	$sql_update="update php121_users set php121_banned='1' where uemail='".$obj->franchisee_email."' and uname='".$obj->franchisee_username."'";
	mysql_query($sql_update);
	echo mysql_error();
}
function fnDelete($arg){
	$res_chk=mysql_query("select * from tbl_franchisee where auto_id=".$arg);
	if(mysql_num_rows($res_chk)>0){
		$obj=mysql_fetch_object($res_chk);		
	}
	$sql_update="delete from php121_users where uemail='".$obj->franchisee_email."' and uname='".$obj->franchisee_username."'";
	mysql_query($sql_update);
	echo mysql_error();
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
function fnDelete(){
	if(notChecked(document.thisForm.elements["ChkS[]"],"franchise to delete")) {return;}
	if(confirm("Are you sure to delete the selected frnchise(s)?")){
		document.thisForm.action="view_franchisee.php?mode=del";
		document.thisForm.submit();
	} else {
		return false;
	}
}

function searchFranchise() {
	f1 = document.thisForm;
	f1.action = "view_franchisee.php";
	f1.submit();
}

function fnActivate(){
	if(notChecked(document.thisForm.elements["ChkS[]"],"Franchise to Activate")) {return;}
	document.thisForm.action="view_franchisee.php?Mode=Activate";
	document.thisForm.submit();
}
function fnDeActivate(){
	
	if(notChecked(document.thisForm.elements["ChkS[]"],"Franchise to De-Activate")) {return;}
	document.thisForm.action="view_franchisee.php?Mode=DeActivate";
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
						<td class="subtitle">Manage Franchise</td>
						<td align="right"><a href="add_franchisee.php">Add Franchise</a></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
					<form name="thisForm" method="post" action="view_franchisee.php">
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr>
							<td align="center">
								<table cellpadding="2" cellspacing="2">
									<tr>
										<td>Sort By Country</td><td>Sort By State</td><td>Sort By City</td><td>Sory By Status</td>
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
											<select name="status" class="cmbbox">
												<option value="">--Select--</option>
												<option value="Y">Activate</option>
												<option value="N">Deactivate</option>
											</select>
											<script language="javascript">
												document.thisForm.status.value = "<?=GetVar("status")?>";
											</script>
										</td>										
									</tr>									
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td><input type="button" value="Search" class="butten" onClick="searchFranchise();"></td>
									</tr>
								</table>							
						</td>
					</tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" align="center" cellspacing="0" border="0" width="420">
						<tr><td>
						<?
						$qstring .= "country=" . GetVar("country") . "&state=" . GetVar("state") . "&city=" . GetVar("city") . "&status=" . GetVar("status") . "&";
						$sql = "select * from tbl_franchisee where 1=1 ";
						if (GetVar("country")) {
							$sql .= "and country = '" . GetVar("country") . "' ";
						}
						if (GetVar("state")) {
							$sql .= "and state = '" . GetVar("state") . "' ";
						}
						if (GetVar("city")) {
							$sql .= "and city = '" . GetVar("city") . "' ";
						}
						if (GetVar("status")) {							
							$sql .= "and franchisee_status = '" . GetVar("status") . "' ";
						}
						
						$sql .= "order by credit_amount asc";
						
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
							<tr class="tblHead">
								<td align="center"><b>Select</b></td>
								<td align="center"><b>S.No</b></td>
								<td><b>Franchisee Name</b></td>								
								<td><b>Franchisee Email</b></td>
								<td><b>Credit Amount Paid </b></td>
								<td><b>Active Status</b></td>			
								<td><b>Payment Report</b></td>
								<td><b>Advance</b></td>								
							
 							</tr>
						<?
							if ($page!=1){
								$rCnt = ($limit*($page-1)+1);
							} else {
								$rCnt=1;
							}
						?>
						<?	while($rs=mysql_fetch_object($res)){ ?>
								<tr class="tblContent">
									<td  align="center"><input type='checkbox' name="ChkS[]" value='<? echo $rs->auto_id?>'></td>
									<td align="center"><? echo $rCnt ?></td>
									<td><a href="add_franchisee.php?ID=<? echo $rs->auto_id;?>"><? echo $rs->franchisee_name."   [".$rs->franchisee_id."]";?></a></td>									
									<td><? echo $rs->franchisee_email;?></td>
									<td><? echo $rs->credit_amount;?></td>
									<td>
									<? if($rs->franchisee_status=="N"){?>
										<img src="images/cross.gif" border="0">	
									<? }else{?>
									<img src="images/tick.gif" border="0">
									<? }?>
									</td>		
									<td><a href="view_franchise_payment_report.php?franchise_auto_id=<? echo $rs->auto_id;?>&franchise_id=<? echo $rs->franchisee_id;?>">Payment Report</a></td>														
									<td><? echo $rs->balance_credit_amount?></td>
 								</tr>
						<?
							$rCnt++;
						}	?>		
							<tr><td colspan="8" align="center" bgcolor="#FFFFFF">							
							<input type="button" name="btns" value="Activate" onClick="fnActivate();" class="butten"> &nbsp; 
							<input type="button" name="btnClick" class="butten" value="Delete" onClick="fnDelete()"> &nbsp; 
							<input type="button" name="btns" value="De-Activate" onClick="fnDeActivate();" class="butten">
							</td></tr>												
							</table>
							<?getpageNumbers($pager->numPages,$page,"view_franchisee.php?$qstring");?>
						<?
							mysql_free_result($res);
						}else{
							echo "<br><br><center>No Franchise details Found.</center>";
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