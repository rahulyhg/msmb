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

if($_REQUEST['Mode']=="upgrade"){
	if($_REQUEST['Chks']!=""){		
		for($iC=0;$iC<count($_REQUEST['Chks']);$iC++){
			$sql="select * from horo_pay where id='".$_REQUEST['Chks'][$iC]."'";
			$res=mysql_query($sql);
			if(mysql_num_rows($res)>0){
				$obj=mysql_fetch_object($res);
				
				 
				
				
				
				$sql_update="update horo_pay set status='Approved' where id='".$obj->id."'";
				mysql_query($sql_update);
				echo mysql_error();	
				
				
		
				
				
		
				
			}
		}		
	}
$_SESSION['_msg']="Membership profile has been upgraded successfully";
header("Location:Astro_Product_Payment.php");
die();	
}

?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript">
function fnApprove(){
	if(notChecked(document.thisForm.elements["Chks[]"],"Members to Approve")) {return;}
	document.thisForm.action="Astro_Product_Payment.php?Mode=upgrade";
	document.thisForm.submit();
}

function fnGetlink(Fname){
		window.open(Fname,'','width=600,height=250,scrollbars=yes,status=no,toolbar=no,top=30,left=240');
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
					  <!--DWLayoutTable-->
					<tr>
						<td width="247" height="22" valign="top" class="subtitle">Astro - Payment</td>
						<td width="17">&nbsp;</td>
				        <td width="646" align="right" valign="top"><a href="../astrohoro/updreply.php">Astro Product Download</a> |<a href="Astro_Product_Payment.php">Astro Product Payment</a> | <a href="Astro_Payment.php">Astro Request</a> | <a href="Compare_Horoscope.php">Astro Match </a>| <a href="Create_Horoscope.php">Generate Horoscope</a></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" align="center" cellspacing="0" border="0" width="520">
						<tr><td>
							<form name="thisForm" method="post">
							<table align="center" cellpadding="1" cellspacing="1" border="0" width="750" class="tblBorder">
							  <!--DWLayoutTable-->
							<tr class="tblHead">
								<td width='40' height="15" align="center"><b>Select</b></td>
								<td width="30" align="center"><b>S.No</b></td>
								<td width="140"><b>Member Regn.ID</b></td>								
								<td width="122"><b>Member Name</b></td>
								<td width="121"><b>Package type </b></td>
								<td width="127"><b>Payment Mode</b></td>
								<td width="148" valign="top"><b>Payment Status</b></td>	
								</tr>
							<?							
							#$sql="select a.*,b.* from tbl_member_profile_upgrade a,tbl_register b where b.username=a.member_id and a.member_auto_id=b.id order by a.auto_id asc"; 
							$sql="select * from horo_pay ";
							#$sql="select b.id,b.username,b.name,b.membership_type,a.payment_mode,c.package_name,c.package_id as org_package_id from tbl_member_profile_upgrade a,tbl_register b, tbl_packages c where b.username=a.member_id and a.member_auto_id=b.id and c.package_id=a.package_id order by a.auto_id asc";
							$res=mysql_query($sql);
							$no=mysql_num_rows($res);
							echo mysql_error();
							if(mysql_num_rows($res)>0){
																							
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
								$rCnt=1;		
								
								if ($page!=1){
									$rCnt = ($limit*($page-1)+1);
								} else {
									$rCnt=1;
								}								
								
							  while($rs=mysql_fetch_object($res)){		
						   ?>
                           
                           
                           
                           
                           
                           
								<tr bgcolor="#FFFFFF">
									<td height="22"><input type="checkbox" name="Chks[]" value="<? echo $rs->id?>"></td>
									<td><? echo $rCnt;?></td>
									<td><a href="javascript:void(0);" onClick="fnGetlink('view_upgrade_details.php?mem_autoid=<? echo $rs->auto_id;?>')"><? echo $rs->username;?></a></td>
									<td><? echo $rs->username;?></td>
									<td><? echo $rs->package;?></td>
									<td><? echo $rs->mode;?></td>
									<td valign="top">
									  <?	
									if($rs->status=="pending"){
										echo "<font color=\"#FF0000\">Not Approved</font>";
									}else{
										echo "<font color=\"#008000\">Approved</font>";
									}		
									?>									</td>
									<? if($rs->franchise_auto_id!="" && $rs->franchise_id!=""){ 
										$sql_in="select franchisee_name from tbl_franchisee where auto_id=".$rs->franchise_auto_id." and franchisee_id='".$rs->franchise_id."'";
										$res_in=mysql_query($sql_in);
										if(mysql_num_rows($res_in)>0){
											$obj_fr=mysql_fetch_object($res_in);
										}
									?>
									<? }else{?>
									<? }?>
								</tr>								
						   <? 
						   		$rCnt++;
							 }//while loop ending here
							?>
								<tr bgcolor="#FFFFFF"><td height="24" colspan="7" align="center" valign="top"><input type="button" name="btnc" value="Approve & Upgrade" class="butten" onClick="fnApprove();"> </td>
								  </tr>
							<? 
							}else{ ?>
								<tr bgcolor="#FFFFFF"><td height="15" colspan="7" align="center" valign="top"><strong>No Upgrade Member deails found..</strong></td>
								  </tr>
								
							<? }?>
							</table>																					
						</form>				
							<? getpageNumbers($pager->numPages,$page,"Astro_Product_Payment.php");?>				
						</td></tr>
						<tr><td>Note <font color="#FF0000">*</font> - Click the member registration number to view the Payment details </td></tr>
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