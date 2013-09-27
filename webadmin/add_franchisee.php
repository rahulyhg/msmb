<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
$linkid=db_connect();
$image_url="http://topmatrimonial.thecreativeit.com/images/logo.jpg";
$server_url="http://topmatrimonial.thecreativeit.com/";

if ($_REQUEST["mode"]=="save"){	

	$sql_chk="select * from tbl_franchisee where (franchisee_id='".$_REQUEST['txtFranchiseeID']."' or franchisee_username='".$_REQUEST['txtFranchiseeID']."' or franchisee_email='".$_REQUEST['txtEmailAddress']."')";
	$res_chk=mysql_query($sql_chk);
	if ( mysql_num_rows($res_chk) > 0 ) {
		$_SESSION['_msg']="Franchisee ID/ Email address already exists.. Please try to give alternative details..";
	} else {
	
		# inserting data's into chat table 
		$sql_insert="insert into php121_users(uname,upassword,uemail,php121_user_chatting,php121_smilies,php121_level,php121_showrequest,php121_beep_newmsg,php121_focus_newmsg,php121_auto_email_transcript,php121_banned,php121_timezone,php121_timestamp,php121_language)values";
		$sql_insert.=" ('".$_REQUEST['txtFranchiseeID']."','".$_REQUEST['txtPassword']."','".$_REQUEST['txtEmailAddress']."','0','1','1','0','1','1','0','0','0','1','English')";		
		mysql_query($sql_insert);
		echo mysql_error();
			
		$table = "tbl_franchisee";
		$insert_value =array("franchisee_id"=>$_REQUEST['txtFranchiseeID'],"franchisee_name"=>$_REQUEST['txtFranchiseeName'],"franchisee_username"=>$_REQUEST['txtFranchiseeID'],"franchisee_address"=>$_REQUEST['txtAddress'],"franchisee_phone"=>$_REQUEST['txtPhone'],"franchisee_email"=>$_REQUEST['txtEmailAddress'],"franchisee_password"=>$_REQUEST['txtPassword'],"franchisee_login_status"=>"N","created_date"=>date('Y-m-d'),"franchisee_status"=>"Y","credit_amount"=>$_REQUEST['txtCreditAmount'],"balance_credit_amount"=>$_REQUEST['txtCreditAmount'],"franchisee_address1"=>$_REQUEST['txtAddress1'],"country"=>$_REQUEST['country'],"state"=>$_REQUEST['state'],"city"=>$_REQUEST['city'],"last_credit_added"=>date("Y-m-d"));
		$status = DB_Insert($linkid, $table, $insert_value);
		
		#Start sending mail script here
			//$image_url = $config["siteurl"]."images/logo.jpg";			
			$mailmsg ="";
			$mailmsg .= "<style>td { font-family:verdana; font-size:11px; }</style>";
			$mailmsg .= "<table cellspacing='1' cellpadding='5' border='0'  width='400px' bgColor='#999999'>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td colspan='2' align='left'><img src=".$image_url." border=\"0\"></td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td colspan='2' align='left'><b>Account Information</b></td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td colspan=2>Dear ".$_REQUEST['txtFranchiseeName']."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td colspan='2'>Your Account Details are</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td>Login Name</td><td>".$_REQUEST['txtFranchiseeID']."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td>Login Password</td><td>".$_REQUEST['txtPassword']."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td colspan='2'>With Regards, <br>Matrimonial Clone - Top Maa Shakti Marriage Bureau Software</td>\n</tr>\n";
			$mailmsg .="</table>";
				
			$strFrom = "info@thecreativeit.com";																	
			$strTo= $_REQUEST['txtEmailAddress'];					
			$strSubject = "Your Matrimonial Clone - Top Maa Shakti Marriage Bureau Software Franchise Account details";
			$strContent = $mailmsg;
			send_mail($strTo,$strFrom,$strSubject,$strContent); 				
			//$_SESSION['_msg']="Your Account Info has been sent to ".$strTo.". Please check your email in a few minutes";
		
		#end  sending mail script here
		
		
		
		
		$_SESSION['_msg']="Franchise details stored successfully and a mail is also sent ";		
	}		

header("Location:add_franchisee.php");	
die();
	
}

if($_REQUEST['mode']=="update"){
	
	
	$sql_chk="select * from tbl_franchisee where ( franchisee_id='".$_REQUEST['txtFranchiseeID']."' or franchisee_username='".$_REQUEST['txtFranchiseeID']."' or franchisee_email='".$_REQUEST['txtEmailAddress']."') and auto_id<>".$_REQUEST['franchisee_id'];
	$res_chk=mysql_query($sql_chk);
	if(mysql_num_rows($res_chk)>0){
		$_SESSION['_msg']="Franchise ID/ Email address already exists. Please try to give alternative details..";
	}else{
				
		$credit_amount = $_REQUEST['txtCreditAmount'] + $_REQUEST['txtAddCreditAmount'];		
		$sql_update = "update tbl_franchisee set franchisee_username='".$_REQUEST['txtFranchiseeID']."',franchisee_name='".$_REQUEST['txtFranchiseeName']."',franchisee_address='".$_REQUEST['txtAddress']."',franchisee_phone='".$_REQUEST['txtPhone']."',franchisee_email='".$_REQUEST['txtEmailAddress']."',franchisee_password='".$_REQUEST['txtPassword']."',credit_amount='".$credit_amount."',balance_credit_amount = balance_credit_amount+".$_REQUEST['txtAddCreditAmount'].",franchisee_address1 = '" . $_REQUEST['txtAddress1'] . "',country = '" .  $_REQUEST['country'] . "',state = '" .  $_REQUEST['state'] . "',city = '" .  $_REQUEST['city'] . "'";
		//echo $sql_update;
		//die();
		if ($_REQUEST['txtAddCreditAmount']) {
			$date1 =  date("Y-m-d");
			$sql_update .= ",last_credit_added = '$date1'";
		}
		$sql_update .= " where auto_id=".$_REQUEST['franchisee_id'];		
		mysql_query($sql_update);
		echo mysql_error();		
		
		$sql_update="update php121_users set uname='".$_REQUEST['txtFranchiseeID']."',upassword='".$_REQUEST['txtPassword']."' where uemail='".$_REQUEST['txtEmailAddress']."'";
		mysql_query($sql_update);
		echo mysql_error();				
	}		
	header("Location:view_franchisee.php");
	die();
}


   if($_REQUEST['ID']!=""){
   	$res=mysql_query("select * from tbl_franchisee where auto_id=".$_REQUEST['ID']);
	$no=mysql_num_rows($res);
	if($no>0){
		$obj=mysql_fetch_object($res);
	}
   }

?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/functions.js"></script>
<script language="JavaScript">
function fnValidate(){ 	

	if(isNull(document.thisForm.txtFranchiseeName,"Franchise name")){return false;}	
	if(isNull(document.thisForm.txtFranchiseeID,"Franchise ID")){return false;}	
	if(isLen(document.thisForm.txtFranchiseeID,6,"Franchise ID")){return false;}
	//if(isNull(document.thisForm.txtUserName,"Franchise User name")){return false;}		
	if(isNull(document.thisForm.txtPassword,"Franchise Password")){return false;}
	if(isLen(document.thisForm.txtPassword,6,"Franchise Password")){return false;}
	if(isNull(document.thisForm.txtEmailAddress,"Franchise email address")){return false;}
	if(notEmail(document.thisForm.txtEmailAddress,"Franchise email address")){return false;}
	if(isNull(document.thisForm.country,"country")){return false;}
	if(isNull(document.thisForm.state,"state")){return false;}
	if(isNull(document.thisForm.city,"city")){return false;}	
	if(isNull(document.thisForm.txtAddress,"Franchise Address")){return false;}	
	if(isNull(document.thisForm.txtPhone,"Contact phone")){return false;}
	if(isNull(document.thisForm.txtCreditAmount,"Credit Amount")){return false;}
	//if(fnChkNum2(document.thisForm.txtAddCreditAmount,"Credit Amount")){return false;}
	
}

function fnHidePhone(){
	if((document.thisForm.rdPhone[0].checked)==true){
		document.getElementById("trLimited").style.visibility="visible";
	}else{
		document.getElementById("trLimited").style.visibility="hidden";
	}
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
						<td class="subtitle">Manage Franchise</td>
						<td align="right"><a href="view_franchisee.php">View Franchises</a></td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
				<?
					if($_REQUEST['ID']==""){
						$secMode="save";
					}else{
						$secMode="update";
					}
				?>
				<form name="thisForm" method="post" onSubmit="return fnValidate();" action="add_franchisee.php?mode=<? echo $secMode?>&franchisee_id=<? echo $_REQUEST['ID'];?>">				
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="520">
						<tr><td>
							<table cellpadding="10" cellspacing="1" border="0" width="500" class="tblBorder">
							<tr class="tblHead"><td align="center"><b>
								<?
								if ($_REQUEST["ID"]!=""){
									echo "Update Franchise";
								} else {
									echo "Add Franchise";
								}
								?>
							</b></td></tr>
							<tr class="tblContent"><td>
								<table cellpadding="5" cellspacing="1" border="0" width="500" class="tblBorder">								
									<tr class="tblContent">
										<td>Franchise Name <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtFranchiseeName" class="txtbox" maxlength="255" value="<? echo $obj->franchisee_name;?>"></td>
									</tr>
									<tr class="tblContent">
										<td>Franchise Id <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtFranchiseeID" class="txtbox" maxlength="10" value="<? echo $obj->franchisee_id;?>"></td>
									</tr>
									<?php /*?><tr class="tblContent">
										<td>Franchise Username(Login Name) <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtUserName" class="txtbox" maxlength="10" value="<? echo $obj->franchisee_username;?>"></td>
									</tr><?php */?>
									
									<tr class="tblContent">
										<td>Franchise Password <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtPassword" class="txtbox" maxlength="10" value="<? echo $obj->franchisee_password;?>"></td>
									</tr>
									<tr class="tblContent">
										<td>Franchise Email address <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtEmailAddress" class="txtbox" maxlength="255" value="<? echo $obj->franchisee_email;?>" <? if($_REQUEST['ID']!=""){ echo "readonly";}?>></td>
									</tr>									
									<tr class="tblContent">
										<td>Country <font color="#FF0000">*</font></td>
										<td>											
											<select class="cmbbox" name="country" onChange="selState2()">
												<option value="">Select</option>										
												<?	GetCountry(); ?>																										
											</select>								
											<? if ($obj->country) {?>
											<script language="javascript">
												document.thisForm.country.value = "<?=$obj->country?>";
											</script>
											<? } ?>												
										</td>
									</tr>									
									<tr class="tblContent">
										<td>State <font color="#FF0000">*</font></td>
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
									</tr>
									<tr class="tblContent">
										<td>City <font color="#FF0000">*</font></td>
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
											<? if ($obj->country) { ?>									
												<script language="javascript" type="text/javascript">													
													selState2();													
												</script>
											<? } ?>
											<? if ($obj->state) { ?>
												<script language="javascript">
													document.thisForm.state.value = "<?=$obj->state;?>";
													selCity2();													
												</script>	
											<? } ?>										
											<? if ($obj->city) { ?>
												<script language="javascript">
													document.thisForm.city.value = "<?=$obj->city;?>";
												</script>	
											<? } ?>												
										</td>
									</tr>																											
									<tr class="tblContent">
										<td valign="top">Franchise Address <font color="#FF0000">*</font></td>
										<td><textarea name="txtAddress" class="txtarea"><? echo $obj->franchisee_address;?></textarea></td>
									</tr>
									<tr class="tblContent">
										<td valign="top">Franchise Address1 </td>
										<td><textarea name="txtAddress1" class="txtarea"><? echo $obj->franchisee_address1;?></textarea></td>
									</tr>									
									<tr class="tblContent">
										<td>Contact Phone number <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtPhone" class="txtbox" value="<? echo $obj->franchisee_phone;?>"></td>
									</tr>			
									
									<tr class="tblContent">
										<td>Franchise Credit Amount(Rs) <font color="#FF0000">*</font></td>
										<td valign="top">
										<input type="text" name="txtCreditAmount" class="txtbox" maxlength="20" value="<? echo $obj->credit_amount;?>">
										<input type="hidden" name="txtHidCreditAmount" class="txtbox" maxlength="20" value="<? echo $obj->credit_amount;?>">
										</td>
									</tr>
									<? if ($obj->last_credit_added && $obj->last_credit_added != '0000-00-00') { ?>
									<tr class="tblContent">
										<td>Last Credit Added</td>
										<td valign="top"><?=strftime("%d-%b-%Y",strtotime($obj->last_credit_added))?></td>
									</tr>
									<? } ?>
									<? if($_REQUEST['ID']!=""){?>					
									<tr class="tblContent">
										<td>Add Credit Amount(Rs)</td>
										<td valign="top">
										<input type="text" name="txtAddCreditAmount" class="txtbox" maxlength="20">
										<input type="hidden" name="txtHidAddCreditAmount" class="txtbox" maxlength="20">
										</td>
									</tr>																															
									<? }?>
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
<?
function convertdate($date)
{
	$lastdt=explode("/",$date);
	$lastdate=$lastdt[2]."-".$lastdt[1]."-".$lastdt[0];
	return $lastdate;
}
?>