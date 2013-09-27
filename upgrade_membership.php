<?php
ob_start();
session_start();
include("includes/lib.php");
isMember();
$action = GetVar("action");
if(!$_SESSION['upgrade_orderno']){
	$precent_date=getdate();
	$_SESSION['upgrade_orderno'] = "ord_".$precent_date[year].$precent_date[mon].$precent_date[mday].$precent_date[hours].$precent_date[minutes].$precent_date[seconds];	
}

if($_REQUEST['Mode']=="Save")
{
$package=$_REQUEST['rdPackage'];
$id=$_SESSION['id'];
	
	$sql_userid="select * from tbl_register where id='".$_REQUEST['txtHidMemberAutoid']."'";
	$res_userid=mysql_query($sql_userid);
	if(mysql_num_rows($res_userid)>0){
		$obj_userid=mysql_fetch_object($res_userid);
		$prev_expdate=$obj_userid->package_expiry_date;
		$prev_phone_allowed=$obj_userid->phone_allowed;
		$prev_address_allowed=$obj_userid->address_allowed;
	}

	$sql_duration="select (TO_DAYS('".$prev_expdate."')-to_days(CURRENT_DATE())) as difference";
		$res_duration=mysql_query($sql_duration);
		if(mysql_num_rows($res_duration)>0){
			$obj_duration=mysql_fetch_object($res_duration);						
		} 
		
		if($obj_duration->difference >0){
			$diff_duration=$obj_duration->difference;
		}else{
			$diff_duration=0;
		}
		
		$sql="select * from tbl_packages where package_id = '".$_REQUEST['rdPackage1']."'";
		$res=mysql_query($sql);
		if(mysql_num_rows($res)>0){
			$obj=mysql_fetch_object($res);
		}
		
		$total_days=$obj->valid_period*30;
		$package_duration=$total_days;
		$total_days=$total_days+$diff_duration;
		$amount=$obj->package_price;
		$total_phone_allowed=($obj->phone_number_allowed+$prev_phone_allowed);
		$total_address_allowed=($obj->address_allowed+$prev_address_allowed);		
		
		$sql_date="select date_add(CURRENT_DATE(), INTERVAL ".$total_days." DAY) as expdate";
		$res_date=mysql_query($sql_date);
		if(mysql_num_rows($res_date)>0){
			$obj_date=mysql_fetch_object($res_date);
		}
		
			
		$payment_type=str_replace("_"," ",$_REQUEST['rdPaymentType']);		
		$door_mode_payment=str_replace("_"," ",$_REQUEST['rdModePayment']);

	if (!$_REQUEST['txtDemandDate']) {
		$_REQUEST['txtDemandDate'] = '0000-00-00';
	}
	
	if (!$_REQUEST['txtMoneyDate']) {
		$_REQUEST['txtMoneyDate'] = '0000-00-00';
	}
	
	$sql_insert="insert into tbl_member_profile_upgrade(order_no,member_unique_id,member_auto_id,member_id,package_id,package_duration_time,package_expiry_date,payment_mode,cheque_number,bank_name,cheque_date,moneyorder_number,post_office_name,moneyorder_date,created_date,total_no_days,street_address,area,city,state,country,contact_person_name,contact_phone,best_time_contact,contact_email,door_mode_payment,phone_allowed,address_allowed,package_amount)";
	$sql_insert.="values('".$_SESSION['upgrade_orderno']."','".$_SESSION['member_unique_id']."','".$_SESSION['id']."','".$_SESSION['userid']."','".$package."','".$package_duration."','".$obj_date->expdate."','".$payment_type."','".$_REQUEST['txtDemandNumber']."','".$_REQUEST['txtBankName']."','".$_REQUEST['txtDemandDate']."',";
	$sql_insert.=" '".$_REQUEST['txtMoneyOrderNumber']."','".$_REQUEST['txtPostofficeName']."','".$_REQUEST['txtMoneyDate']."',NOW(),'".$total_days."','".$_REQUEST['txtStreet']."','".$_REQUEST['txtArea']."','".$_REQUEST['txtCity']."','".$_REQUEST['txtState']."','".$_REQUEST['cmbCountry']."','".$_REQUEST['txtContactName']."','".$_REQUEST['txtContactPhone']."','".$_REQUEST['txtTimeContact']."','".$_REQUEST['txtContactEmail']."','".$door_mode_payment."','".$total_phone_allowed."','".$total_address_allowed."',".$amount.")";
	
	$res2 = mysql_query($sql_insert);

	$select_usr="select username,name,mobileNumber from tbl_register where username='".$_SESSION['userid']."'";
$result_usr=mysql_query($select_usr,$link);
if($val=mysql_fetch_array($result_usr)){
 $h_username=$val[0];
$h_name=$val[1];
$h_mobile=$val[2];
					
					
	$sms_subject=$h_mobile;			
if($sms_subject!=""){		
$headers1 = "From: sms@thecreativeit.com.com\n";
$sms_email1="sms@thecreativeit.com.com";
$sms_message1="Your request for the account upgradation is posted successfully.After admin approval,your account will be activated.";
$sms_email2="cretivedesignforyou@gmail.com";
$mail_sms1=@mail($sms_email2,$sms_subject,$sms_message1,$headers1);
$mail_sms1=@mail($sms_email1,$sms_subject,$sms_message1,$headers1);
}	
	
	
	
	}
	
	
	
	
	if (mysql_error($res2)) {
		echo mysql_error();
		die();
	}	
	$insert_id=mysql_insert_id();		
	$_SESSION['msg']="Updated Successfully...";	
	if($_REQUEST['rdPaymentType']=="CCAvenue_Payment"){
		header("Location: member_checkout.php?member_id=".$insert_id);
		die();	
	}else{
		header("Location: upgrade_membership.php?rdPackage=".$package."&action=success");
		die();
	}
	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/my_matrimony.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" src="includes/validate.js"></script>
<script language="JavaScript" src="includes/functions.js"></script>		
<script type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

//-->
function fnProceedCheckout(){
	var strpaymenttype="";
	if(notChecked(document.thisForm.elements["rdPackage"],"Package type for Upgrade your Membership")){return false;}
	//alert(document.thisForm.rdPaymentType.length);
	for(ic=0;ic<=4;ic++){		
		if(document.thisForm.rdPaymentType[ic].checked==true)
		     strpaymenttype=document.thisForm.elements["rdPaymentType"][ic].value;
	}
	if(notChecked(document.thisForm.elements["rdPaymentType"],"any one Payment option for Upgrade your Membership")){return false;}
	if(strpaymenttype=="Money_order"){	
		if (isNull(document.thisForm.txtMoneyOrderNumber,"Money Order number")) { return false; }
		if (isNull(document.thisForm.txtPostofficeName,"Post office Name with Location ")) { return false; }
		if (isNull(document.thisForm.txtMoneyDate,"Date")) { return false; }
    }
   	if(strpaymenttype=="Demand_draft"){	
		if (isNull(document.thisForm.txtDemandNumber,"Demand Draft number")) { return false; }
		if (isNull(document.thisForm.txtBankName,"Bank Name with Location")) { return false; }
		if (isNull(document.thisForm.txtDemandDate,"Demand Date")) { return false; }
	}
	/*if(strpaymenttype=="Pay_at_post_office"){	
		if (isNull(document.thisForm.txtStreet,"Street Address")) { return false; }
		if (isNull(document.thisForm.txtArea,"Area")) { return false; }
		if (isNull(document.thisForm.txtCity,"City")) { return false; }
		if (isNull(document.thisForm.txtState,"State")) { return false; }
	}*/
	if(strpaymenttype=="Door_step_service"){	
		if (isNull(document.thisForm.txtStreet1,"Street Address")) { return false; }
		if (isNull(document.thisForm.txtArea1,"Area")) { return false; }
		if (isNull(document.thisForm.txtCity1,"City")) { return false; }
		if (isNull(document.thisForm.txtState1,"State")) { return false; }
		if (isNull(document.thisForm.txtContactName,"Contact Person Name")) { return false; }
		if (isNull(document.thisForm.txtContactPhone,"Contact Phone Number")) { return false; }
		if (isNull(document.thisForm.txtTimeContact,"Best Time of Contact")) { return false; }
		if (isNull(document.thisForm.txtContactEmail,"Email Address")) { return false; }
		if (notEmail(document.thisForm.txtContactEmail,"Email Address")) { return false; }
		if(notChecked(document.thisForm.elements["rdModePayment"],"Mode of Payment")){return false;}			
	}		
	document.thisForm.action="upgrade_membership.php?Mode=Save";
	document.thisForm.submit();
}
function fnclick(arg)
{
	document.thisForm.rdPackage1.value=arg;
}
function fnBack()
{
	document.thisForm.action="my_matrimony.php";
	document.thisForm.submit();
}
function fnDisable()
{
	var strpaymenttype="";
	for(i=0;i<=4;i++){			
		//alert(document.thisForm.rdPaymentType[i].value);
		if(document.thisForm.rdPaymentType[i].checked == true)
		    strpaymenttype=document.thisForm.rdPaymentType[i].value;
	}
	if(strpaymenttype=="Money_order"){
		document.thisForm.txtMoneyOrderNumber.disabled=false;
		document.thisForm.txtPostofficeName.disabled=false;
		document.thisForm.txtMoneyDate.disabled=false;

		document.thisForm.txtMemberID.disabled=true;
		document.thisForm.txtMemberName.disabled=true;
		
		document.thisForm.txtDemandNumber.disabled=true;
		document.thisForm.txtBankName.disabled=true;
		document.thisForm.txtDemandDate.disabled=true;
		/*document.thisForm.txtStreet.disabled=true;
		document.thisForm.txtArea.disabled=true;
		document.thisForm.txtCity.disabled=true;
		document.thisForm.txtState.disabled=true;*/
		document.thisForm.txtStreet1.disabled=true;
		document.thisForm.txtArea1.disabled=true;
		document.thisForm.txtCity1.disabled=true;
		document.thisForm.txtState1.disabled=true;
		document.thisForm.txtContactName.disabled=true;
		document.thisForm.txtContactPhone.disabled=true;
		document.thisForm.txtTimeContact.disabled=true;
		document.thisForm.txtContactEmail.disabled=true;
		document.thisForm.elements["rdModePayment"].disabled=true;
    }
   	if(strpaymenttype=="Demand_draft"){	
		document.thisForm.txtDemandNumber.disabled=false;
		document.thisForm.txtBankName.disabled=false;
		document.thisForm.txtDemandDate.disabled=false;

		document.thisForm.txtMemberID.disabled=true;
		document.thisForm.txtMemberName.disabled=true;
		
		document.thisForm.txtMoneyOrderNumber.disabled=true;
		document.thisForm.txtPostofficeName.disabled=true;
		document.thisForm.txtMoneyDate.disabled=true;
		/*document.thisForm.txtStreet.disabled=true;
		document.thisForm.txtArea.disabled=true;
		document.thisForm.txtCity.disabled=true;
		document.thisForm.txtState.disabled=true;*/
		document.thisForm.txtStreet1.disabled=true;
		document.thisForm.txtArea1.disabled=true;
		document.thisForm.txtCity1.disabled=true;
		document.thisForm.txtState1.disabled=true;
		document.thisForm.txtContactName.disabled=true;
		document.thisForm.txtContactPhone.disabled=true;
		document.thisForm.txtTimeContact.disabled=true;
		document.thisForm.txtContactEmail.disabled=true;
		document.thisForm.elements["rdModePayment"].disabled=true;
	}
	/*if(strpaymenttype=="Pay_at_post_office"){	
		document.thisForm.txtStreet.disabled=false;
		document.thisForm.txtArea.disabled=false;
		document.thisForm.txtCity.disabled=false;
		document.thisForm.txtState.disabled=false;
		
		document.thisForm.txtMemberID.disabled=false;
		document.thisForm.txtMemberName.disabled=false;
		
		document.thisForm.txtMoneyOrderNumber.disabled=true;
		document.thisForm.txtPostofficeName.disabled=true;
		document.thisForm.txtMoneyDate.disabled=true;
		document.thisForm.txtDemandNumber.disabled=true;
		document.thisForm.txtBankName.disabled=true;
		document.thisForm.txtDemandDate.disabled=true;
		document.thisForm.txtStreet1.disabled=true;
		document.thisForm.txtArea1.disabled=true;
		document.thisForm.txtCity1.disabled=true;
		document.thisForm.txtState1.disabled=true;
		document.thisForm.txtContactName.disabled=true;
		document.thisForm.txtContactPhone.disabled=true;
		document.thisForm.txtTimeContact.disabled=true;
		document.thisForm.txtContactEmail.disabled=true;
		document.thisForm.elements["rdModePayment"].disabled=true;
	}*/
	if(strpaymenttype=="Door_step_service"){	
		document.thisForm.txtStreet1.disabled=false;
		document.thisForm.txtArea1.disabled=false;
		document.thisForm.txtCity1.disabled=false;
		document.thisForm.txtState1.disabled=false;
		document.thisForm.txtContactName.disabled=false;
		document.thisForm.txtContactPhone.disabled=false;
		document.thisForm.txtTimeContact.disabled=false;
		document.thisForm.txtContactEmail.disabled=false;
		document.thisForm.elements["rdModePayment"].disabled=false;
		
		document.thisForm.txtMemberID.disabled=false;
		document.thisForm.txtMemberName.disabled=false;
		
		document.thisForm.txtMoneyOrderNumber.disabled=true;
		document.thisForm.txtPostofficeName.disabled=true;
		document.thisForm.txtMoneyDate.disabled=true;
		document.thisForm.txtDemandNumber.disabled=true;
		document.thisForm.txtBankName.disabled=true;
		document.thisForm.txtDemandDate.disabled=true;
		/*document.thisForm.txtStreet.disabled=true;
		document.thisForm.txtArea.disabled=true;
		document.thisForm.txtCity.disabled=true;
		document.thisForm.txtState.disabled=true;*/
	}
}
</script>
</head>
<body class="homeinbody" onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
<div class="menuleftimg">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
    <td align="right"><? fnBannerImage('  ','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>  
  <tr>
    <td colspan="2" valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td valign="top">
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:10px 20px 0px 0px; width:573px; float:right;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<div class="titlebg"><h1 class="title">Upgrade Membership</h1></div></td>
			    <td valign="top">&nbsp;</td>
			    </tr>
			  <tr>
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			    </tr>
			  <tr>
			  	<td width="592" valign="top">						
					<div style="float:left; padding:10px 0px 0px 10px;"><?php /*?>action="upgrade_details.php" <?php */?>
						<form name="thisForm" id="thisForm" method="post" onsubmit="return fnValidate();">
						<? if($_REQUEST['action']!="success"){?>
								<table border="0" width="100%"   class="one" align="center" cellspacing="2" cellpadding="0" bgcolor="#fffdcb">
								<?	$sql_package="select * from tbl_packages where package_id!=1 order by package_id";
									$res_package=mysql_query($sql_package);	
									if(mysql_num_rows($res_package)>0){
										$iCnt=0;
										while($obj_package=mysql_fetch_object($res_package)){  
										   if($obj_package->package_id!=""){
												if($iCnt > 1){
													echo "</tr><tr bgcolor=\"#FFFFFF\">";
												}								
										?>
									<tr bgcolor="#ffffff">
										<td>
											<table align="left"  class="bdr" cellpadding="1" cellspacing="0" border="0" width="100%" bordercolor="#fffdcb">																						
												<tr>
													<td rowspan="2">
														<table align="left" cellpadding="3" cellspacing="1" border="0" width="400" bordercolor="#fffdcb">
															<tr>
																<td class="selectbold" width="30%">
															<?	if (GetVar("package_id") == $obj_package->package_id) { ?>
													 			<input type="radio" value="<?=$obj_package->package_id;?>" name="rdPackage" checked>
															 <?	} else { ?>
																	<input type="radio" value="<?=$obj_package->package_id;?>" name="rdPackage" onClick="return fnclick(this.value);">
															 <? } ?>
															 <?=str_replace('package','membership',$obj_package->package_name);?>
															</td>
															<td class="selectbold" align="left" width="10%"><?=$obj_package->valid_period;?> Months</td>
															<td class="selectbold" align="left" width="15%">Rs. <?=number_format($obj_package->package_price,2);?></td>
															</tr>
														</table>
													</td>
												  <td valign="top" class="select">&nbsp;</td>
												</tr>								
											</table>
										</td>
									</tr>
									<?
										$iCnt++;
										 }
										}//while loop
										 }else{	//if loop								 
										?>
											
										<? }?>
									<tr bgcolor="#FFFFFF"><td align="right"><a href="payment.php" target="_blank">Compare Membership Schemes</a></td></tr>
									<tr><td>
									<table width="100%" border="0" cellspacing="2" cellpadding="4" >
									 <tr><td>
										<!--<form name="thisForm" method="post">-->
										<input type="hidden" name="rdPackage1" value="<?=$_REQUEST['package_id']?>">
										<input type="hidden" name="txtHidMemberAutoid" value="<? echo $_SESSION['id'];?>">
										<div style="float:left; padding:0px 0px 0px 0px;">
										<table order="0" cellspacing="0" width="100%" cellpadding="0" >
										 <tr><td colspan="2"><font color="#a80326"><b>&nbsp;&nbsp;&nbsp;Payment Options</b></font></td></tr>
										 <tr><td colspan="2">
											 <table align="left" cellpadding="1"   cellspacing="1" width="100%">
												 <tr bgcolor="#f9e7a3"><td colspan="2"><input type="radio" name="rdPaymentType" value="Cash_at_Office" onClick="return fnDisable();"><!-- </td><td>-->Cash at Shaadi Address</td></tr>
												 <tr bgcolor="#fffcdb"><td colspan="2">
												 	<div style="padding-left:25px; padding-top:0px;">
														<font color="#FF0000" size="2" style="font-weight:bold">Maa Shakti Marriage Bureau</font><br>
														
														<div style="padding-left:0px;padding-top:5px;padding-bottom:5px;">
															<a href="mailto:info@maashaktimarriage.com" class="faq_inner">info@maashaktimarriage.com</a>
														</div>
														
													 </div>
												 </td></tr>
												 <tr bgcolor="#f9e7a3"><td colspan="2"><input type="radio" name="rdPaymentType" value="Money_order" onClick="return fnDisable();">Money order</td></tr>
												<tr bgcolor="#fffcdb">
													 <td colspan="2"> 
														<table align="left" cellpadding="1" cellspacing="1" border="0" width="370" id="tbl_MoneyOrder" style="display:block;"> 
														<tr><td width="50%">Money Order number <font color="#FF0000">*</font> </td><td><input type="text" name="txtMoneyOrderNumber" class="packtxtbox" maxlength="25"></td></tr>
														<tr><td width="50%">Post office Name with Location <font color="#FF0000">*</font></td><td><input type="text" name="txtPostofficeName" class="packtxtbox" maxlength="255"></td></tr>											
														<tr><td width="50%">Date <font color="#FF0000">*</font></td><td><input type="text" name="txtMoneyDate" class="packtxtbox" maxlength="20" id="txtMoneyDate">&nbsp;<img src="images/cal.gif" border="0" style="cursor:pointer" onClick="fnShowCalendar(document.thisForm.txtMoneyDate);"> </td></tr>											
														</table>
													 </td>	
												 </tr>									 
												 <tr bgcolor="#f9e7a3"><td colspan="2"><input type="radio" name="rdPaymentType" value="Demand_draft" onClick="return fnDisable();">Demand draft</td></tr>
												 <tr bgcolor="#fffcdb">
													 <td colspan="2"> 
														<table align="left" cellpadding="1" cellspacing="1" border="0" width="400" id="tbl_Demand" style="display:block;"> 
														<tr><td width="50%">Demand Draft number <font color="#FF0000">*</font></td><td><input type="text" name="txtDemandNumber" class="packtxtbox" maxlength="25"></td></tr>
														<tr><td width="50%">Bank Name with Location <font color="#FF0000">*</font></td><td><input type="text" name="txtBankName" class="packtxtbox" maxlength="255"></td></tr>											
														<tr><td width="50%">Date <font color="#FF0000">*</font></td><td><input type="text" name="txtDemandDate" class="packtxtbox" maxlength="20" readonly="true">&nbsp;<img src="images/cal.gif" border="0" style="cursor:pointer" onClick="fnShowCalendar(document.thisForm.txtDemandDate);"> </td></tr>											
														</table>
													 </td>	
												 </tr>									 
												 
												 <?php /*?><tr bgcolor="#f9e7a3">
												 <td valign="top" colspan="2"><input type="radio" name="rdPaymentType" value="Pay_at_post_office" onClick="return fnDisable();">Pay at post office </td>
												</tr> 
												
												<tr bgcolor="#fffcdb">
												 <td colspan="2"> 
													<table align="left" cellpadding="1" cellspacing="1" border="0" width="400" id="tbl_Postoffice" style="display:block;"> 
														<tr><td width="50%">Member id <font color="#FF0000">*</font> </td><td width="50%"><input type="text" name="txtMemberID" class="packtxtbox" value="<? echo $_SESSION['userid'];?>"></td></tr>
														<tr><td width="50%">Member Name <font color="#FF0000">*</font> </td><td width="50%"><input type="text" name="txtMemberName" class="packtxtbox" value="<? echo $_SESSION['member_name'];?>"></td></tr>
														<tr><td colspan="2"><b>Address details</b> <font color="#FF0000">*</font></td></tr>
														<tr><td width="50%">Street Address</td><td><input type="text" name="txtStreet" class="packtxtbox" maxlength="255"></td></tr>
														<tr><td width="50%">Area</td><td><input type="text" name="txtArea" class="packtxtbox" maxlength="255"></td></tr>
														<tr><td width="50%">City</td><td><input type="text" name="txtCity" class="packtxtbox" maxlength="255"></td></tr>
														<tr><td width="50%">State</td><td><input type="text" name="txtState" class="packtxtbox" maxlength="255"></td></tr>
														<tr><td width="50%">Country</td><td>
														<select name="cmbCountry" class="cmbbox">
														<script language="javascript">
															GetCountry('India','');									
														</script>
														</select>
														</td></tr>						
													</table>
												 </td>
												 </tr><?php */?>
                                                                                                 <!--
												 <tr bgcolor="#f9e7a3">
                                                                                                    <td colspan="2">
                                                                                                        <input type="radio" name="rdPaymentType" value="Door_step_service" onClick="return fnDisable();">Door step service.
                                                                                                    </td>
                                                                                                 </tr>
												 <tr bgcolor="#fffcdb"><td colspan="2">
													<table align="left" cellpadding="1" cellspacing="1" border="0" width="400" id="tbl_Doorstep" style="display:block;"> 
														<tr><td width="50%">Member id <font color="#FF0000">*</font> </td><td><input type="text" name="txtMemberID" class="packtxtbox" value="<? echo $_SESSION['userid'];?>"></td></tr>
														<tr><td width="50%">Member Name <font color="#FF0000">*</font> </td><td><input type="text" name="txtMemberName" class="packtxtbox" value="<? echo $_SESSION['member_name'];?>"></td></tr>
														<tr><td colspan="2"><b>Address details</b> <font color="#FF0000">*</font></td></tr>
														<tr><td width="50%">Street Address</td><td><input type="text" name="txtStreet1" class="packtxtbox" maxlength="255"></td></tr>
														<tr><td width="50%">Area</td><td><input type="text" name="txtArea1" class="packtxtbox" maxlength="255"></td></tr>
														<tr><td width="50%">City</td><td><input type="text" name="txtCity1" class="packtxtbox" maxlength="255"></td></tr>
														<tr><td width="50%">State</td><td><input type="text" name="txtState1" class="packtxtbox" maxlength="255"></td></tr>
														<tr><td width="50%">Country</td><td>
														<select name="cmbCountry" class="cmbbox">
														<script language="javascript">
															GetCountry('India','');									
														</script>
														</select>
														</td></tr>	
														<tr><td>Contact person Name</td><td><input type="text" name="txtContactName" class="packtxtbox" maxlength="255"></td></tr>					
														<tr><td>Contact Phone Number</td><td><input type="text" name="txtContactPhone" class="packtxtbox" maxlength="255"></td></tr>					
														<tr><td>Best time of contact</td><td><input type="text" name="txtTimeContact" class="packtxtbox" maxlength="255"></td></tr>	
														<tr><td>Email Address</td><td><input type="text" name="txtContactEmail" class="packtxtbox" maxlength="255"></td></tr>					
														<tr>
														<td>Mode of Payment</td>
														<td>
															<input type="radio" name="rdModePayment" value="Demand_Draft">Demand Draft <br/>
															<input type="radio" name="rdModePayment" value="Cash">Cash<br/>
														</td>
														</tr>
														<tr><td>
															<a href="doorstep_collection_cities.php" target="_blank">Doorstep Collection Services</a>
														</td></tr>
													</table>
												 </td></tr>-->
											 </table>
										  </td></tr>						 
										 
										 <tr bgcolor="#FFFCDB">
										 <td colspan="2" align="center">
										 <input type="button" name="btnProceedcheckout" value="Proceed Checkout" class="button2" style="width:140px;" onClick="fnProceedCheckout();"> 
										 </td>
										 </tr>	 
										 
										 <? }else{?>		
											
											 <tr bgcolor="#FFFFFF">
											 <td colspan="2" align="center">
												<strong>Your Membership upgrade request has been posted successfully..</strong>
											 </td>
										 </tr>
										 <tr><td colspan="2" align="center"><br><br>
										 	<input type="button" name="btn" value="Back To My Matrimony" class="button2" style="width:140px;" onClick="fnBack();">
										 </td></tr>
										 <? }?>					
										  </table>
										</div>
									 </td>
									<!--</form>-->
									 </td></tr>
								  </table>
									</td>
									</tr>
						  </table>
						</form>
					</div>
					</td>
			    <td width="592" valign="top" style="padding-top:10px;"><img src="images/right_banner.gif"></td>
			    </tr>
			 
			  <tr>
				<td rowspan="-2">				</td>
			    <td rowspan="-2"></td>
			    </tr>
			</table>
		</div>
		</td>
	  </tr>
	</table>
	</td>
  </tr>
  <tr>
  <td colspan="2">
  	<? 
		  		include("includes/fotter.php") ?>
  </td>
  </tr>
</table>
<div>
</body>
</html>