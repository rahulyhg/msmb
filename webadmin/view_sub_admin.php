<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging.php");
include("includes/menu.php");
$linkid = db_connect();
$arg="package_status";
isAdmin($arg);
if($_REQUEST['mode']=="del"){
	if($_REQUEST['ChkS']<>""){
		for($i=0;$i<count($_REQUEST['ChkS']);$i++){					
				$sql="delete from tbl_admin where Id=".$_REQUEST['ChkS'][$i];				
				mysql_query($sql);			
				echo mysql_error();			
				$_SESSION['_msg']="Sub-Administrator details deleted successfully"; 								
	  	}

		header("location:view_sub_admin.php");
		die();
	}
}	

if($_REQUEST['Mode']=="Activate"){
	if($_REQUEST['ChkS']<>""){
		for($i=0;$i<count($_REQUEST['ChkS']);$i++){
			$sql="update tbl_admin set activation_status='Y' where Id =".$_REQUEST['ChkS'][$i];
			mysql_query($sql);
			echo mysql_error();												
		}
		$_SESSION['_msg']="Sub-Admin Account(s) Activated successfully";
	}	
	header("location:view_sub_admin.php");
	die();
	
}

if($_REQUEST['Mode']=="DeActivate"){
	if($_REQUEST['ChkS']<>""){
		for($i=0;$i<count($_REQUEST['ChkS']);$i++){
			$sql="update tbl_admin set activation_status='N' where Id =".$_REQUEST['ChkS'][$i];
			mysql_query($sql);
			echo mysql_error();						
		}
		$_SESSION['_msg']="Sub-Admin Account(s) De-Activated successfully";
	}	
	header("location:view_sub_admin.php");
	die();
	
}

if($_REQUEST['Mode']=="UpdatePermission"){

	$sql_update="";
	$ar_permission = array();
	if($_REQUEST['txtHidAdminID']!=""){
		for($i=0;$i<count($_REQUEST['txtHidAdminID']);$i++){									
			
				$sql_update="update tbl_admin set ";
				if($_REQUEST['ChkSales_'.$_REQUEST['txtHidAdminID'][$i]]!=""){
					$sql_update.=" sales_report_status='Y',";				
					array_push($ar_permission,"Sales Report : Allowed");
				}else{
					$sql_update.=" sales_report_status='N',";
					array_push($ar_permission,"Sales Report : Not Allowed");				
				}
				
							
				if($_REQUEST['ChkPackage_'.$_REQUEST['txtHidAdminID'][$i]]!=""){
					$sql_update.=" package_status='Y',";
					array_push($ar_permission,"Package : Allowed");
				}else{
					$sql_update.=" package_status='N',";
					array_push($ar_permission,"Package : Not Allowed");
				}	
				
				if($_REQUEST['ChkPaidMember_'.$_REQUEST['txtHidAdminID'][$i]]!=""){
					$sql_update.=" paid_member_report_status='Y',";
					array_push($ar_permission,"Paid Member Report : Allowed");
				}else{
					$sql_update.=" paid_member_report_status='N',";
					array_push($ar_permission,"Paid Member Report : Not Allowed");
				}
				
				if($_REQUEST['ChkFreeMember_'.$_REQUEST['txtHidAdminID'][$i]]!=""){
					$sql_update.=" free_member_report_status='Y',";
					array_push($ar_permission,"Free Member Report : Allowed");
				}else{
					$sql_update.=" free_member_report_status='N',";
					array_push($ar_permission,"Free Member Report : Not Allowed");
				}
							
				if($_REQUEST['ChkFranchise_'.$_REQUEST['txtHidAdminID'][$i]]!=""){
					$sql_update.=" franchise_account_status='Y',";
					array_push($ar_permission,"Franchisee Account : Allowed");
				}else{
					$sql_update.=" franchise_account_status='N',";
					array_push($ar_permission,"Franchisee Account : Not Allowed");
				}
				
				if($_REQUEST['ChkAdvertisement_'.$_REQUEST['txtHidAdminID'][$i]]!=""){
					$sql_update.=" advertisement_status='Y',";
					array_push($ar_permission,"Advertisement : Allowed");
				}else{
					$sql_update.=" advertisement_status='N',";
					array_push($ar_permission,"Advertisement : Not Allowed");
				}
				
				if($_REQUEST['ChkNewsletter_'.$_REQUEST['txtHidAdminID'][$i]]!=""){
					$sql_update.=" newsletter_status='Y',";
					array_push($ar_permission,"Newsletter : Allowed");
				}else{
					$sql_update.=" newsletter_status='N',";
					array_push($ar_permission,"Newsletter : Not Allowed");
				}	
				
				if($_REQUEST['ChkSuccess_'.$_REQUEST['txtHidAdminID'][$i]]!=""){
					$sql_update.=" successful_stories_status='Y',";
					array_push($ar_permission,"Sucessful Stories : Allowed");
				}else{
					$sql_update.=" successful_stories_status='N',";
					array_push($ar_permission,"Sucessful Stories : Not Allowed");
				}	
				
				if($_REQUEST['ChkEditMember_'.$_REQUEST['txtHidAdminID'][$i]]!=""){
					$sql_update.=" edit_regn_member_status='Y',";
					array_push($ar_permission,"Edit Register Member : Allowed");
				}else{
					$sql_update.=" edit_regn_member_status='N',";
					array_push($ar_permission,"Edit Register Member : Not Allowed");
				}
				
				if($_REQUEST['ChkReligion_'.$_REQUEST['txtHidAdminID'][$i]]!=""){
					$sql_update.=" religion_report_status='Y',";
					array_push($ar_permission,"Edit Register Member : Allowed");
				}else{
					$sql_update.=" religion_report_status='N',";
					array_push($ar_permission,"Edit Register Member : Not Allowed");
				}
				
				if($_REQUEST['ChkCaste_'.$_REQUEST['txtHidAdminID'][$i]]!=""){
					$sql_update.=" caste_report_status='Y',";
					array_push($ar_permission,"Caste Report : Allowed");
				}else{
					$sql_update.=" caste_report_status='N',";
					array_push($ar_permission,"Caste Report : Not Allowed");
				}

				if($_REQUEST['ChkRequestMember_'.$_REQUEST['txtHidAdminID'][$i]]!=""){
					$sql_update.=" RequestMember_status='Y',";
					array_push($ar_permission,"View Request Member : Allowed");
				}else{
					$sql_update.=" RequestMember_status='N',";
					array_push($ar_permission,"View Request Member : Not Allowed");
				}
				
				if($_REQUEST['ChkWedding_'.$_REQUEST['txtHidAdminID'][$i]]!=""){
					$sql_update.=" wedding_directory_status='Y',";
					array_push($ar_permission,"Wedding Directory : Allowed");
				}else{
					$sql_update.=" wedding_directory_status='N',";
					array_push($ar_permission,"Wedding Directory : Not Allowed");
				}
				
				if($_REQUEST['ChkInterest_'.$_REQUEST['txtHidAdminID'][$i]]!=""){
					$sql_update.=" sent_express_interest='Y',";
					array_push($ar_permission,"Send Express Interest : Allowed");
				}else{
					$sql_update.=" sent_express_interest='N',";
					array_push($ar_permission,"Send Express Interest : Not Allowed");
				}
			
			$sql_update.=" activation_status='".$_REQUEST['txtHidActive'][$i]."' where Id='".$_REQUEST['txtHidAdminID'][$i]."'";			
			
			$admin_users = GetSingleRecord("tbl_admin","id",$_REQUEST['txtHidAdminID'][$i]);
			
			# send mail to admin
			$mailmsg ="";
			$mailmsg .= "<style>td { font-family:verdana; font-size:11px; }</style>";
			$mailmsg .= "<table cellspacing='1' cellpadding='5' border='0'  width='400px' bgColor='#999999'>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td colspan='2'>Dear " . $admin_users[email] . "</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td colspan='2' align='left'><b>You are permitted to view/Update the following sections</b></td>\n</tr>\n";
			
			foreach($ar_permission as $key => $value) {
				$mailmsg .= "<tr bgColor='#ffffff'>\n<td colspan='2' style='padding-left:20px;'>$value</td>\n</tr>\n";
			}
			
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td colspan='2'>With Regards, <br>Matrimonial Clone - Top Maa Shakti Marriage Bureau Software.com </td>\n</tr>\n";
			$mailmsg .="</table>";
				
			$strFrom = "info@thecreativeit.com";																	
			$strTo = $admin_users[admin_loginname];					
			$strSubject = "Matrimonial Clone - Top Maa Shakti Marriage Bureau Software Admin Permissions";
			$strContent = $mailmsg;
			send_mail($strTo,$strFrom,$strSubject,$strContent); 						
			
			mysql_query($sql_update);
			echo mysql_error();
		}
	 }	
	$_SESSION['_msg']="Sub-Admin Account(s) altered successfully";
	
	header("location:view_sub_admin.php");
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
function fnDelete(){
	if(notChecked(document.thisForm.elements["ChkS[]"],"Sub-Admin to delete")) {return;}
	if(confirm("Are you sure to delete the selected Sub-Admin(s)?")){
		document.thisForm.action="view_sub_admin.php?mode=del";
		document.thisForm.submit();
	} else {
		return false;
	}
}

function fnActivate(){
	if(notChecked(document.thisForm.elements["ChkS[]"],"Sub-Admin to Activate")) {return;}
	document.thisForm.action="view_sub_admin.php?Mode=Activate";
	document.thisForm.submit();
}
function fnDeActivate(){
	if(notChecked(document.thisForm.elements["ChkS[]"],"Sub-Admin to De-Activate")) {return;}
	document.thisForm.action="view_sub_admin.php?Mode=DeActivate";
	document.thisForm.submit();
}
function fnUpdatePermissions(){
	if(confirm("Are you sure!, would you like to re-arrange the permissions?")==true){
		 document.thisForm.action="view_sub_admin.php?Mode=UpdatePermission";
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
						<td class="subtitle">Manage Sub-Admins</td>
						<td align="right"><a href="add_sub_admin.php">Add Sub-Admins</a></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" align="center" cellspacing="0" border="0" width="620">
						<tr><td>
						<?
						$sql="select * from tbl_admin  where Id<>1 order by Id asc";
						$res=mysql_query($sql);	
						echo mysql_error();
						$no=mysql_num_rows($res);
							//pager starts Here
						if($_REQUEST['page']=="")
							$page =1;
						else
							$page=$_REQUEST['page'];
							$total	=	$no;
							$limit	=	20;
							$pager	=	Pager::getPagerData($total, $limit, $page);
							$offset	=	$pager->offset;
							$limit	=	$pager->limit;
							$page	= 	$pager->page;
						//pager ends Here
						$res=mysql_query($sql." limit  $offset, $limit"); 
						if($no>0){
							$rCnt=1;	
						?>
							<table cellpadding="5" cellspacing="1" border="0" width="650" class="tblBorder">
							<form name="thisForm" method="post">
							<tr class="tblHead">
								<td align="center"><b>Select</b></td>
								<td><b>S.No</b></td>
								<td><b>Login Name</b></td>
								<td><b>Manage Religion</b></td>	
								<td><b>Manage Caste</b></td>								
								<td><b>Sales Report Status</b></td>								
								<td><b>Package Decision</b></td>
								<td><b>Paid member Report</b></td>
								<td><b>Free member Report</b></td>
								<td><b>Franchise Account</b></td>
								<td><b>Manage Advertisement</b></td>
								<td><b>Sending Newsletters</b></td>
								<td><b>Successful Stories</b></td>
								<td><b>Wedding Directory</b></td>
								<td><b>Express Interest Message</b></td>
								<td><b>Edit Registered Member profile</b></td>								
								<td><b>Upgrade Request Member</b></td>																
								<td><b>Active Status</b></td>
								<td><b>No of Profiles Updated</b></td>								
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
									<td align="center"><input type='checkbox' name="ChkS[]" value='<? echo $rs->Id?>'></td>
									<td><? echo $rCnt ?></td>
									<td><a href="add_sub_admin.php?ID=<? echo $rs->Id;?>"><? echo $rs->admin_loginname;?></a></td>								
									<td><input type="checkbox" name="ChkReligion_<? echo $rs->Id; ?>" value="Y" <? if($rs->religion_report_status=='Y'){ echo "checked=checked";} ?>></td>
									<td><input type="checkbox" name="ChkCaste_<? echo $rs->Id; ?>" value="Y" <? if($rs->caste_report_status=='Y'){ echo "checked=checked";} ?>></td>
									<td><input type="checkbox" name="ChkSales_<? echo $rs->Id; ?>" value="Y" <? if($rs->sales_report_status=='Y'){ echo "checked=checked";} ?>></td>
									<td><input type="checkbox" name="ChkPackage_<? echo $rs->Id; ?>" value="Y" <? if($rs->package_status=='Y'){ echo "checked=checked";} ?>></td>
									<td><input type="checkbox" name="ChkPaidMember_<? echo $rs->Id; ?>" value="Y" <? if($rs->paid_member_report_status=='Y'){ echo "checked=checked";} ?>></td>
									<td><input type="checkbox" name="ChkFreeMember_<? echo $rs->Id; ?>" value="Y" <? if($rs->free_member_report_status=='Y'){ echo "checked=checked";} ?>></td>
									<td><input type="checkbox" name="ChkFranchise_<? echo $rs->Id; ?>" value="Y" <? if($rs->franchise_account_status=='Y'){ echo "checked=checked";} ?>></td>
									<td><input type="checkbox" name="ChkAdvertisement_<? echo $rs->Id; ?>" value="Y" <? if($rs->advertisement_status=='Y'){ echo "checked=checked";} ?>></td>
									<td><input type="checkbox" name="ChkNewsletter_<? echo $rs->Id; ?>" value="Y" <? if($rs->newsletter_status=='Y'){ echo "checked=checked";} ?>></td>
									<td><input type="checkbox" name="ChkSuccess_<? echo $rs->Id; ?>" value="Y" <? if($rs->successful_stories_status=='Y'){ echo "checked=checked";} ?>></td>
									<td><input type="checkbox" name="ChkWedding_<? echo $rs->Id; ?>" value="Y" <? if($rs->wedding_directory_status=='Y'){ echo "checked=checked";} ?>></td>
									<td><input type="checkbox" name="ChkInterest_<? echo $rs->Id; ?>" value="Y" <? if($rs->sent_express_interest=='Y'){ echo "checked=checked";} ?>></td>
									<td><input type="checkbox" name="ChkEditMember_<? echo $rs->Id; ?>" value="Y" <? if($rs->edit_regn_member_status=='Y'){ echo "checked=checked";} ?>></td>									
									<td><input type="checkbox" name="ChkRequestMember_<? echo $rs->Id; ?>" value="Y" <? if($rs->RequestMember_status=='Y'){ echo "checked=checked";} ?>></td>																		
									
									<td>
									<? if($rs->activation_status=="N"){?>
										<img src="images/cross.gif" border="0">	
									<? }else{?>
										<img src="images/tick.gif" border="0">
									<? }?>
										<input type="hidden"  class="txtbox" style="width:20px;" name="txtHidAdminID[]" value="<? echo $rs->Id;?>">
										<input type="hidden"  class="txtbox" style="width:20px;" name="txtHidActive[]" value="<? echo $rs->activation_status;?>">
									</td>
									<td><?=$rs->profile_edited?></td>
									
 								</tr>
						<?
							$rCnt++;
						}	?>		
							<tr><td colspan="20" align="center" bgcolor="#FFFFFF"><input type="hidden" name="txtHidCount" value="<? echo $rCnt-1;?>">
							<input type="button" name="btnst" class="butten" value="Update Permissions" onClick="fnUpdatePermissions();"> &nbsp; <input type="button" name="btnClick" class="butten" value="Delete" onClick="fnDelete()"> &nbsp; <input type="button" name="btns" value="Activate" onClick="fnActivate();" class="butten"> &nbsp; <input type="button" name="btns" value="De-Activate" onClick="fnDeActivate();" class="butten">
							</td></tr>					
							
							</table>
							<?getpageNumbers($pager->numPages,$page,"view_sub_admin.php");?>
						<?
							mysql_free_result($res);
						}else{
							echo "<br><br><center>No Sub Administrator details Found.</center>";
						}
						?>
						</form>
						</td></tr>
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