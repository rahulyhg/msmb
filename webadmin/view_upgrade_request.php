<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging.php");
include("includes/menu.php");
$linkid = db_connect();

$arg="RequestMember_status";
isAdmin($arg);

if($_REQUEST['Mode']=="upgrade"){
	if($_REQUEST['Chks']!=""){		
		for($iC=0;$iC<count($_REQUEST['Chks']);$iC++){
			$sql="select * from tbl_member_profile_upgrade where auto_id='".$_REQUEST['Chks'][$iC]."'";
			$res=mysql_query($sql);
			if(mysql_num_rows($res)>0){
				$obj=mysql_fetch_object($res);
				
				
				 $sql1="select * from tbl_register where id=".$obj->member_auto_id;
				$res1=mysql_query($sql1);
				if(mysql_num_rows($res1)>0){
				$obj1=mysql_fetch_object($res1);
				$old_phone_allowed=$obj1->phone_allowed;
				$old_address_allowed=$obj1->address_allowed;
				$send_mobile=$obj1->mobileNumber;	
				$send_username=$obj1->name;											
				}
				
				
				
				 $taddress_allowed=$obj->address_allowed + $old_address_allowed;
				 $tphone_allowed=$obj->phone_allowed + 	$old_phone_allowed;
				 $sql_update="update tbl_register set package_expiry_date='".$obj->package_expiry_date."',membership_type='".$obj->package_id."',phone_allowed='".$tphone_allowed."',address_allowed='".$taddress_allowed."' where id=".$obj->member_auto_id;
				 mysql_query($sql_update);
				echo mysql_error();					
				
				$sql_update="update tbl_member_profile_upgrade set payment_status='1' where auto_id='".$obj->auto_id."'";
				mysql_query($sql_update);
				echo mysql_error();	
				
				$res_pack=mysql_query("select package_name from tbl_packages where package_id=".$obj->package_id);
				$obj_pack=mysql_fetch_object($res_pack);
							
		
				$membership_name=$obj_pack->package_name;
				$membership_duration=$obj->package_duration_time." Month(s)";
				$expiry_date=$obj->package_expiry_date;
				$member_email=$obj1->email;
		
				
				
		$mailmsg ="";
		$mailmsg .= "<style>td { font-family:verdana; font-size:11px; }</style>";
		$mailmsg .= "<table cellspacing='0' cellpadding='5' border='0'  width='80%'  style='border:#000000 1px solid;'  >\n";
		$mailmsg .= "<tr>\n<td colspan='3' align='center' bgColor='#FFFFFF'><font color='#000000'><b>Upgrade Report</b></font></td>\n</tr>\n";
		$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>MemberShip Name</b></td> <td>:</td> <td>".$membership_name."</td>\n</tr>\n";
		$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Membership duration </b></td> <td>:</td> <td>".$membership_duration."</td>\n</tr>\n";
		$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Valid upto </b></td> <td>:</td> <td>".$expiry_date."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td colspan=\"2\"><strong>With Regards,</strong> <br> Matrimonial Clone - Top Maa Shakti Marriage Bureau Software.</td>\n</tr>\n";
		$mailmsg .= "</table>";			
		$strFrom="info@thecreativeit.com";
		$strTo=$member_email;						
		$strSubject = "Package Upgrade details from Matrimonial Clone - Top Maa Shakti Marriage Bureau Software";		
		$strContent = $mailmsg;		
		send_mail($strTo,$strFrom,$strSubject,$strContent);	
			
			
			$sms_subject=$send_mobile;			
	if($sms_subject!=""){		
$headers1 = "From: sms@http://bestmatrimonial.thecreativeit.com\n";
$sms_email1="sms@http://bestmatrimonial.thecreativeit.com";
 $sms_email2="cretivedesignforyou@gmail.com";
$sms_message1="Dear ".$send_username.", your profile has been upgraded successfully on Maa Shakti Marriage Bureau.";
$mail_sms1=@mail($sms_email1,$sms_subject,$sms_message1,$headers1);
$mail_sms1=@mail($sms_email2,$sms_subject,$sms_message1,$headers1);
}		
$sms_subject="";			
				
			}
		}		
	}
$_SESSION['_msg']="Membership profile has been upgraded successfully";
header("Location:view_upgrade_request.php");
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
	document.thisForm.action="view_upgrade_request.php?Mode=upgrade";
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
					<tr>
						<td class="subtitle">Manage Upgrade Membership </td>
						<td align="right"><a href="#"></a></td>
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
							<tr class="tblHead">
								<td width='30' align="center"><b>Select</b></td>
								<td width="30" align="center"><b>S.No</b></td>
								<td><b>Member Regn.ID</b></td>								
								<td><b>Member Name</b></td>
								<td><b>Package type </b></td>
								<td><b>Payment Mode</b></td>
								<td><b>Payment Status</b></td>	
								<td><b>Upgraded By</b></td>
								<td><b>Status</b></td>																
 							</tr>
							<?							
							#$sql="select a.*,b.* from tbl_member_profile_upgrade a,tbl_register b where b.username=a.member_id and a.member_auto_id=b.id order by a.auto_id asc"; 
							$sql="select a.*,b.*,c.package_name,c.package_id as org_package_id from tbl_member_profile_upgrade a,tbl_register b, tbl_packages c where b.username=a.member_id and a.member_auto_id=b.id and c.package_id=a.package_id order by a.auto_id desc";
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
									<td><input type="checkbox" name="Chks[]" value="<? echo $rs->auto_id?>"></td>
									<td><? echo $rCnt;?></td>
									<td><a href="javascript:void(0);" onClick="fnGetlink('view_upgrade_details.php?mem_autoid=<? echo $rs->auto_id;?>')"><? echo $rs->member_id;?></a></td>
									<td><? echo $rs->name;?></td>
									<td><? echo $rs->package_name;?></td>
									<td><? echo $rs->payment_mode;?></td>
									<td>
									<?	
									if($rs->payment_status==0){
										echo "<font color=\"#FF0000\">Not Approved</font>";
									}else{
										echo "<font color=\"#008000\">Approved</font>";
									}		
									?>	
									</td><td>
									<? if($rs->franchise_auto_id!="" && $rs->franchise_id!=""){ 
										$sql_in="select franchisee_id from tbl_franchisee where auto_id=".$rs->franchise_auto_id." and franchisee_id='".$rs->franchise_id."'";
										$res_in=mysql_query($sql_in);
										if(mysql_num_rows($res_in)>0){
											$obj_fr=mysql_fetch_object($res_in);
										}
									?>
										[Franchise]-<? echo $obj_fr->franchisee_id;?>
									<? }else{?>
										Self
									<? }?>
									</td>
									<td>
										<?  $res_chk=mysql_query("select * from tbl_member_profile_upgrade where member_id='".$rs->member_id."'");
											$nos=mysql_num_rows($res_chk);
											if($nos>1) {
												echo "Renewal";
											} else {
												echo "New Upgrade";
											}
										?>
									</td>
								</tr>								
						   <? 
						   		$rCnt++;
							 }//while loop ending here
							?>
								<tr bgcolor="#FFFFFF"><td colspan="10" align="center"><input type="button" name="btnc" value="Approve & Upgrade" class="butten" onClick="fnApprove();"> </td></tr>
							<? 
							}else{ ?>
								<tr bgcolor="#FFFFFF"><td colspan="10" align="center"><strong>No Upgrade Member deails found..</strong></td></tr>
							<? }?>
								
							</table>																					
						</form>				
							<? getpageNumbers($pager->numPages,$page,"view_upgrade_request.php");?>				
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