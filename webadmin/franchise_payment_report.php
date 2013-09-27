<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging.php");
include("includes/menu.php");
$linkid = db_connect();
$arg="franchise_account_status";
isAdmin($arg);

$sql_in="select * from tbl_franchisee where auto_id='".$_REQUEST['franchise_auto_id']."' and franchisee_id='".$_REQUEST['franchise_id']."'";
$res_in=mysql_query($sql_in);
if(mysql_num_rows($res_in)>0){
	$obj_in=mysql_fetch_object($res_in);
	$initial_franchise_credit_amount=$obj_in->credit_amount;
}

?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript">var linkPath="";</script>
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
						<td class="subtitle">Franchise Payment Report</td>
						<td align="right"><a href="view_franchisee.php">&laquo;Back</a></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" align="center" cellspacing="0" border="0" width="720">
						<tr><td>
							<table align="center" cellpadding="5" cellspacing="1" border="0" width="750" class="tblBorder">							
							
							<tr class="tblHead">
								<td align="center"><b>S.No</b></td>
								<td><b>Member Name <br>[Member ID]</b></td>								
								<td><b>Date of Upgrade</b></td>																
								<td><b>Package Type</b></td>								
								<td><b>Package Amount(INR)</b></td>			
								<td><strong>Commission earned(INR)</strong></td>
 							</tr>
							<?
							if($_REQUEST['franchise_auto_id']!="" && $_REQUEST['franchise_id']!=""){	
								$sql = "select a.*,b.*, c.package_name,c.valid_period,c.package_price,DATE_FORMAT(b.date_of_birth,'%D %M, %Y')as date_of_birth,DATE_FORMAT(a.created_date,'%D %M, %Y')as created_date from tbl_member_profile_upgrade a, tbl_register b,tbl_packages c where a.franchise_auto_id='".$_REQUEST['franchise_auto_id']."' and a.franchise_id='".$_REQUEST['franchise_id']."' and a.member_auto_id=b.id and b.username=a.member_id and c.package_id=a.package_id ";
								if (GetVar("created_from_date")) {
									$sql .= "and a.created_date >= '" . GetVar("created_from_date") . "' ";
								}
								if (GetVar("created_to_date")) {
									$sql .= "and a.created_date1 <= '" . GetVar("created_to_date") . "' ";
								}	
								$sql .= "order by a.auto_id,a.member_auto_id asc";
								$res=mysql_query($sql);
								if(mysql_num_rows($res)>0){								
									$rCnt =1;	
									$total_upgrade_amount=0;
									while($obj=mysql_fetch_object($res)){								
							?>
							<tr class="tblContent">
								<td><? echo $rCnt;?></td>
								<td><? echo $obj->name;?> [<? echo $obj->member_id;?>]</td>								
								<td><? echo $obj->created_date;?></td>
								<td><? echo $obj->package_name;?></td>
								<td>Rs.<? echo number_format($obj->package_price,2);;?></td>
								<td>Rs.<? echo $obj->franchise_commission_amount;?></td>
								<?
									$commission_earned=$commission_earned+$obj->franchise_commission_amount;
								?>
							</tr>
							
							<? 
							$total_upgrade_amount=$total_upgrade_amount+$obj->package_price;
							$rCnt++;
							}//while loop ending							
							?>
							
							<tr class="tblContent"><td colspan="5" align="right"><strong>Net Commission Earned</strong></td><td>Rs.<? echo number_format($commission_earned,2);?></td></tr>
							<tr class="tblContent"><td colspan="5" align="right"><strong>Net Credit Amount</strong></td>							
							<? if($initial_franchise_credit_amount<=0){?>
							<td><font color="#FF0000">Rs.<? echo $initial_franchise_credit_amount;?></font></td>
							<? }else{?>
							<td>Rs.<? echo $initial_franchise_credit_amount;?></td>
							<? }?>
							</tr>

							<?
							}else{
							?>
							<tr class="tblContent"><td colspan="5" align="center">No Upgrade details found..</td></tr>
							<?
							}	//if record checking ending
							 }	//if querystring checking ending
							?>
							
							</table>											
						</td></tr>
						<tr><td align="right"><br/> <input type="button" name="btns" class="butten" value="Print" onClick="window.print();"></td></tr>
						</table>
					</td></tr>
					</table>
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