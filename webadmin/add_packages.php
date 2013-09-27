<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
$linkid=db_connect();

$arg="package_status";
isAdmin($arg);


if ($_REQUEST["mode"]=="save"){	
	$precent_date=getdate();
	$filename=$precent_date[year].$precent_date[mon].$precent_date[mday].$precent_date[hours].$precent_date[minutes].$precent_date[seconds];	
	$filename=$filename.".html";
	$sql_chk="select * from tbl_packages where package_name='".$_REQUEST['txtPackageName']."'";	
	$res_chk=mysql_query($sql_chk);
	if($_REQUEST['rdPhone']=="L"){
		$phone_allowed=$_REQUEST['txtPhoneAllowed'];
	}else{
		$phone_allowed=1000000;
	}
	if($_REQUEST['rdAddress']=="L"){
		$address_allowed=$_REQUEST['txtAddressAllowed'];
	}else{
		$address_allowed=1000000;
	}

	
	if(mysql_num_rows($res_chk)==0){
	   
		$fileid = fopen("../package_features/".$filename,"w+");
		$strFileContent=$_REQUEST['description'];
		$strmsg = $strFileContent;
		fwrite($fileid,$strmsg);
		fclose($fileid);
	
		//$sql_insert="insert into tbl_packages(package_name,phone_number_allowed,address_allowed,valid_period,package_price,file_name,created_date,phone_allowed_status,address_allowed_status,franchise_percentage)values('".$_REQUEST['txtPackageName']."','".$phone_allowed."','".$address_allowed."','".$_REQUEST['cmbMonth']."','".$_REQUEST['txtPackageCost']."','".$filename."',CURRENT_DATE(),'".$_REQUEST['rdPhone']."','".$_REQUEST['rdAddress']."','".$_REQUEST['cmbPercentage']."')";
		$sql_insert="insert into tbl_packages(package_name,phone_number_allowed,address_allowed,valid_period,package_price,phone_allowed_status,address_allowed_status,franchise_percentage,contact_details_other_member,verified_phone,feature_profile,profile_highlighting,top_pacement,";
		 $sql_insert.="protect_photo_horoscope,add_photo,add_horoscope,express_intrest,privacy_settings,file_name,contact_members,created_date,double_verified_phones,special_highlight,profile_highlight,daily_match_watch,book_mark_profile,hide_delete_profile,sms_daily_match)";
		$sql_insert.="values('".$_REQUEST['txtPackageName']."','".$phone_allowed."','".$address_allowed."','".$_REQUEST['cmbMonth']."','".$_REQUEST['txtPackageCost']."','".$_REQUEST['rdPhone']."','".$_REQUEST['rdAddress']."','".$_REQUEST['cmbPercentage']."','$_REQUEST[rdocontact_details_other_member]','$_REQUEST[rdoVerified_phone]',";
		$sql_insert.="'$_REQUEST[rdoFeature_profile]','$_REQUEST[rdoProfile_highlighting]','$_REQUEST[rdoTop_pacement]','".$_REQUEST['rdoProtect_photo_horoscope']."',";
		$sql_insert.="'".$_REQUEST['rdoAdd_photo']."','".$_REQUEST['rdoAdd_horoscope']."','".$_REQUEST['rdoExpress_intrest']."','".$_REQUEST['rdoPrivacy_settings']."'";
		 $sql_insert.=",'".$filename."','$_REQUEST[rdoContact_Members]',CURRENT_DATE(),'$_REQUEST[rdodouble_verified_phones]','$_REQUEST[rdospecial_highlights]','$_REQUEST[rdoprofile_highlight]','$_REQUEST[rdodaily_match_watch]','$_REQUEST[rdobook_mark_profile]','$_REQUEST[rdohide_delete_profile]','$_REQUEST[rdosms_daily_match]')";
		mysql_query($sql_insert);
		echo mysql_error();	
		
		$_SESSION['_msg'] = "Saved Successfully";	
	}else{
		$_SESSION['_msg'] = "Package Name already exists";	
	}
	header("Location:view_packages.php");
	die();	
	
}

if($_REQUEST['mode']=="update"){
		$sql_chk="select * from tbl_packages where package_name='".$_REQUEST['txtPackageName']."' and package_id!='".$_REQUEST['package_id']."'";	
		$res_chk=mysql_query($sql_chk);
		if($_REQUEST['rdPhone']=="L"){
			$phone_allowed=$_REQUEST['txtPhoneAllowed'];
		}else{
			$phone_allowed=1000000;
		}

		if($_REQUEST['rdAddress']=="L"){
			$address_allowed=$_REQUEST['txtAddressAllowed'];
		}else{
			$address_allowed=1000000;
		}
		
		
		
        $sql_file="select * from tbl_packages where package_name='".$_REQUEST['txtPackageName']."' and package_id='".$_REQUEST['package_id']."'";
		$res_file=mysql_query($sql_file);
    
		if(mysql_num_rows($res_chk)==0)
		{
		$obj=mysql_fetch_object($res_file);
		$fp = fopen("../package_features/".$obj->file_name,"w+");
		$strFileContent=$_REQUEST['description'];
	
		$strmsg = $strFileContent; 
		fwrite($fp,$strmsg);
		fclose($fp);
		  
		  $sql_update="update tbl_packages set package_name='".$_REQUEST['txtPackageName']."',phone_number_allowed='".$phone_allowed."',address_allowed='".$address_allowed."',valid_period='".$_REQUEST['cmbMonth']."',package_price='".$_REQUEST['txtPackageCost']."',phone_allowed_status='".$_REQUEST['rdPhone']."',address_allowed_status='".$_REQUEST['rdAddress']."',franchise_percentage='".$_REQUEST['cmbPercentage']."',";
		  $sql_update.="contact_details_other_member='".$_REQUEST['rdocontact_details_other_member']."',";
		  $sql_update.="verified_phone='".$_REQUEST['rdoVerified_phone']."',";
		   $sql_update.="feature_profile='".$_REQUEST['rdoFeature_profile']."',";
		   $sql_update.="profile_highlighting='".$_REQUEST['rdoProfile_highlighting']."',";
		   $sql_update.="top_pacement='".$_REQUEST['rdoTop_pacement']."',";
		   $sql_update.="protect_photo_horoscope='".$_REQUEST['rdoProtect_photo_horoscope']."',";
		   $sql_update.="add_photo='".$_REQUEST['rdoAdd_photo']."',";
		   $sql_update.=" add_horoscope='".$_REQUEST['rdoAdd_horoscope']."',";
		   $sql_update.="express_intrest='".$_REQUEST['rdoExpress_intrest']."',";
		   $sql_update.="privacy_settings='".$_REQUEST['rdoPrivacy_settings']."',";
		   $sql_update.="double_verified_phones='".$_REQUEST['rdodouble_verified_phones']."',";
		   $sql_update.="special_highlight='".$_REQUEST['rdospecial_highlights']."',";
		   $sql_update.="profile_highlight='".$_REQUEST['rdoprofile_highlight']."',";
		   $sql_update.="daily_match_watch='".$_REQUEST['rdodaily_match_watch']."',";
		   $sql_update.="book_mark_profile='".$_REQUEST['rdobook_mark_profile']."',";
		   $sql_update.=" hide_delete_profile='".$_REQUEST['rdohide_delete_profile']."',";
		   $sql_update.="sms_daily_match='".$_REQUEST['rdosms_daily_match']."',";
		   $sql_update.="contact_members='".$_REQUEST['rdoContact_Members']."' ";
		   
		  $sql_update.="where package_id='".$_REQUEST['package_id']."'";
			mysql_query($sql_update);
			
			$_SESSION['_msg'] = "Updated Successfully";
		 }
		else
		{
			$_SESSION['_msg'] = "Package Name already exists";	
		}
    header("Location:view_packages.php");
	die();
}//update

function rteSafe($strText) {
	//returns safe code for preloading in the RTE
	$tmpString = $strText;
	
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);
	
	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);
//	$tmpString = str_replace("\"", "\"", $tmpString);
	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	
	return $tmpString;
}




if($_REQUEST['package_id']!="")
{
   	$sql_select="select * from tbl_packages where package_id='".$_REQUEST['package_id']."'";
	$r=mysql_query($sql_select);
	if(mysql_num_rows($r)>0)
	{	
	$res=mysql_fetch_object($r);
	}
	
}// if id!=""

$strCount="";
for($iC=0;$iC<=100;$iC++){
	$strCount.="<option value=".$iC.">".$iC."</option>";
	
}

?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<!-- START : Included Script and Styles for Text Editor -->	
<link href="includes/rte.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="includes/richtext.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/html2xhtml.js"></script>
<!-- END : Included Script and Styles for Text Editor -->
<script language="JavaScript">
function Trim(Str){ 
	return Str.replace(/(^\s*)|(\s*$)/g,""); 
}

function fnValidate(id){ 	
	updateRTE('rte1');
	
	if(isNull(document.thisForm.txtPackageName,"Package name")){return false;}	
	if((document.thisForm.rdPhone[0].checked)==true){
		if(isNull(document.thisForm.txtPhoneAllowed,"Phone number allowed")){return false;}	
		//if(fnChkNum(document.thisForm.txtPhoneAllowed,"Phone number allowed")){return false;}	
	}
	if((document.thisForm.rdAddress[0].checked)==false && (document.thisForm.rdAddress[1].checked)==false ){
	alert("Please select the Address allowed");
	return false;
	}
	if((document.thisForm.rdAddress[0].checked)==true){
		if(isNull(document.thisForm.txtAddressAllowed,"Addresses allowed")){return false;}	
		if(fnChkNum(document.thisForm.txtAddressAllowed,"Addresses allowed")){return false;}	
	}
	if(notChecked(document.thisForm.rdAddress,"Addresses allowed")){return false;}
	if(notSelected(document.thisForm.cmbMonth,"Period allowed")){return false;}	
	if(isNull(document.thisForm.txtPackageCost,"Package cost")){return false;}	
	if(notPrice(document.thisForm.txtPackageCost,"Package cost")){return false;}
	if(notSelected(document.thisForm.cmbPercentage,"Franchise Commission")){return false;}
	
	
	if(id!=1){
	if(document.thisForm.txtPackageCost.value==0)
	{
	 alert("Please enter valid Package cost");
	 document.thisForm.txtPackageCost.focus();
	 return false;
	}	
	}
	
	if(isNull(document.thisForm.rdocontact_details_other_member,"View Contact Details of other members")){return false;}
	if(fnChkNum(document.thisForm.rdocontact_details_other_member,"View Contact Details of other members")){return false;}
	if(notChecked(document.thisForm.rdoContact_Members,"Contact Members on all 14 Regional portals")){return false;}
	if(notChecked(document.thisForm.rdoVerified_phone,"Verified phone numbers")){return false;}
	if(notChecked(document.thisForm.rdoFeature_profile,"Feature profile ")){return false;}
	if(notChecked(document.thisForm.rdoProfile_highlighting,"Profile highlighting")){return false;}
	if(notChecked(document.thisForm.rdoTop_pacement,"Top pacement")){return false;}
	if(notChecked(document.thisForm.rdoProtect_photo_horoscope,"Protect photo/horoscope")){return false;}
	if(notChecked(document.thisForm.rdoAdd_photo,"Add photo")){return false;}
	if(notChecked(document.thisForm.rdoAdd_horoscope,"Add Horoscope")){return false;}
	if(notChecked(document.thisForm.rdoExpress_intrest,"Express intrest")){return false;}
	if(notChecked(document.thisForm.rdoPrivacy_settings,"Privacy Settings")){return false;}
	if(notChecked(document.thisForm.rdodouble_verified_phones,"Doubled Verified phone numbers")){return false;}
	if(notChecked(document.thisForm.rdospecial_highlights,"Special Highlighting")){return false;}
	if(notChecked(document.thisForm.rdoprofile_highlight,"Profile Highlighting")){return false;}
	if(notChecked(document.thisForm.rdodaily_match_watch,"Daily Match Watch")){return false;}
	if(notChecked(document.thisForm.rdobook_mark_profile,"Bookmark Profiles")){return false;}
	if(notChecked(document.thisForm.rdohide_delete_profile,"Hide and delete Profiles")){return false;}
	if(notChecked(document.thisForm.rdosms_daily_match,"SMS for Daily match and Express interest Alerts")){return false;}
	var sMsg;
	sMsg=document.thisForm.rte1.value;
	document.thisForm.description.value=sMsg;
	if(document.thisForm.rte1.value==""){
		alert("Please enter the package features");
		frames['rte1'].focus();
		return false;
	}
	
}
function fnHidePhone(){
	if((document.thisForm.rdPhone[0].checked)==true){
		document.getElementById("trLimited").style.visibility="visible";
	}else{
		document.getElementById("trLimited").style.visibility="hidden";
	}
}

function fnHideAddress(){
	if((document.thisForm.rdAddress[0].checked)==true){
		document.getElementById("addLimited").style.visibility="visible";
	}else{
		document.getElementById("addLimited").style.visibility="hidden";
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
						<td class="subtitle">Manage Packages</td>
						<td align="right"><a href="view_packages.php">View Packages</a></td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
				<?
					if($_REQUEST['package_id']==""){
						$secMode="save";
					}else{
						$secMode="update";
					}
				?>
				<form name="thisForm" method="post" onSubmit="return fnValidate(<?=$_REQUEST['package_id'] ?>);" action="add_packages.php?mode=<? echo $secMode?>">
				<input type="hidden" name="package_id" value="<? echo($_REQUEST['package_id']);?>">					
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="520">
						<tr><td>
							<table cellpadding="10" cellspacing="1" border="0" width="500" class="tblBorder">
							<tr class="tblHead"><td align="center"><b>
								<?
								if ($_REQUEST["package_id"]!=""){
									echo "Update Package";
								} else {
									echo "Add Package";
								}
								?>
							</b></td></tr>
							<tr class="tblContent"><td>
							
						 <table cellpadding="5" cellspacing="1" border="0" width="500" class="tblBorder">								
									<tr class="tblContent">
										<td>Package Name <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtPackageName" class="txtbox" value="<?=str_replace("\"","&quot;",$res->package_name);?>" maxlength="255">
										<script language="javascript">
											document.thisForm.txtPackageName.focus();
										</script>
										</td>
									</tr>
									<tr class="tblContent">
										<td>Phone numbers allowed <font color="#FF0000">*</font></td>
										 <?php 
										  if($_REQUEST['package_id']!=""){
											  $status=$res->phone_allowed_status;
											  if($status=="L")
											  {
												$limited="checked";
												$unlimited="";
												$style="visible";
											  }
											  else
											  {
												$limited="";
												$unlimited="checked";
												$style="hidden";
											  }
										  }//package_id
										  else
										  {
										    $limited="checked";
											$unlimited="";
											$style="visible";
										  }
										 ?>
										<td>
										<input type="radio" name="rdPhone" value="L" <?=$limited; ?> onClick="fnHidePhone();"> Limited &nbsp; <input type="radio" name="rdPhone" value="U" <?=$unlimited; ?> onClick="fnHidePhone();"> Un-Limited
										 <table align="left" cellpadding="1" cellspacing="1" border="0">
										 <? if($res->phone_allowed_status=="L"){$price=$res->phone_number_allowed;} ?>
											<tr><td id="trLimited" style="visibility:<?=$style;?>"><input type="text" name="txtPhoneAllowed" class="txtbox"  value="<?=$price; ?>" maxlength="5"></td></tr>											
										</table>
										
										</td>
									</tr>
									<!--address -->
									<tr class="tblContent">
										<td>Addresses allowed <font color="#FF0000">*</font></td>
										 <?php 
										  if($_REQUEST['package_id']!=""){
											  $status=$res->address_allowed_status;
											  if($status=="L")
											  {
												$limited="checked";
												$unlimited="";
												$style="visible";
											  }
											  else
											  {
												$limited="";
												$unlimited="checked";
												$style="hidden";
											  }
										  }//package_id
  										  else
										  {
										    $limited="";
											$unlimited="";
											$style="hidden";
										  }

										 ?>
										<td>
										<input type="radio" name="rdAddress" value="L" <?=$limited; ?> onClick="fnHideAddress();"> Limited &nbsp; <input type="radio" name="rdAddress" value="U" <?=$unlimited; ?> onClick="fnHideAddress();"> Un-Limited
										 <table align="left" cellpadding="1" cellspacing="1" border="0">
										 <? if($res->address_allowed_status=="L"){$address=$res->address_allowed;} ?>
											<tr><td id="addLimited" style="visibility:<?=$style;?>"><input type="text" name="txtAddressAllowed" class="txtbox"  value="<?=$address; ?>" maxlength="5"></td></tr>											
										</table>
										
										</td>
									</tr>
									
									
									<!--end address -->
									<tr class="tblContent">									
										<td>Valid period(in Months) <font color="#FF0000">*</font></td>
										<td>
										<select name="cmbMonth" class="cmbbox">
										<option value="">Select</option>
										<? echo $strPeriodMonth; ?>
										</select>
										</td>
									</tr>
									<? if($res->valid_period!=""){?>
										<script language="JavaScript">document.thisForm.cmbMonth.value="<? echo $res->valid_period;?>";</script>
									<? }?>
									<tr class="tblContent">
										<td>Package Cost(INR) <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtPackageCost" class="txtbox" value="<?=str_replace("\"","&quot;",$res->package_price); ?>" maxlength="10"></td>
									</tr>
									<tr class="tblContent">
										<td>Franchise Commission <font color="#FF0000">*</font></td>
										<td><select name="cmbPercentage" class="cmbbox"><option value="">--Select--</option><? echo $strCount;?></select></td>
									</tr>
									<? if($res->franchise_percentage!=""){?>
										<script language="javascript">document.thisForm.cmbPercentage.value="<? echo $res->franchise_percentage;?>";</script>
									<? }?>
									
                              <? if($res->valid_period!=""){?>
                              <script language="JavaScript">document.thisForm.cmbMonth.value="<? echo $res->valid_period;?>";</script>
                              <? }?>
                              <tr class="tblContent">
                                <td>View Contact Details of other members<font color="#FF0000">*</font></td>
                                <td><input type="text" class="txtbox" name="rdocontact_details_other_member" value="<?=str_replace("\"","&quot;",$res->contact_details_other_member);?>" >
                                 
                              </tr>
							   <tr class="tblContent">
                                <td>Contact Members on all 14 Regional portals <font color="#FF0000">*</font></td>
                                <td>
								<input type="radio" name="rdoContact_Members" value="1" <? if($res->contact_members=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdoContact_Members" value="0" <? if($res->contact_members=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr>
                              <!--address -->
                              <tr class="tblContent">
                                <td>Verified phone numbers <font color="#FF0000">*</font></td>
                               
                                <td><input type="radio" name="rdoVerified_phone" value="1" <? if($res->verified_phone=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdoVerified_phone" value="0" <? if($res->verified_phone=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr>
                              <!--end address -->
                             
							  <tr class="tblContent">
                                <td>Feature profile <font color="#FF0000">*</font></td>
                                <td>
								<input type="radio" name="rdoFeature_profile" value="1" <? if($res->feature_profile=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdoFeature_profile" value="0" <? if($res->feature_profile=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr>
                              <tr class="tblContent">
                                <td>Profile highlighting <font color="#FF0000">*</font></td>
                                <td><input type="radio" name="rdoProfile_highlighting" value="1" <? if($res->profile_highlighting=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdoProfile_highlighting" value="0" <? if($res->profile_highlighting=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr>
                              <tr class="tblContent">
                                <td>Top pacement <font color="#FF0000">*</font></td>
                                <td><input type="radio" name="rdoTop_pacement" value="1" <? if($res->top_pacement=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdoTop_pacement" value="0" <? if($res->top_pacement=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr> <tr class="tblContent">
                                <td>Protect photo/horoscope<font color="#FF0000">*</font></td>
                                <td><input type="radio" name="rdoProtect_photo_horoscope" value="1" <? if($res->protect_photo_horoscope=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdoProtect_photo_horoscope" value="0" <? if($res->protect_photo_horoscope=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr> <tr class="tblContent">
                                <td>Add photo <font color="#FF0000">*</font></td>
                                <td><input type="radio" name="rdoAdd_photo" value="1" <? if($res->add_photo=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdoAdd_photo" value="0" <? if($res->add_photo=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr> <tr class="tblContent">
                                <td>Add Horoscope <font color="#FF0000">*</font></td>
                                <td><input type="radio" name="rdoAdd_horoscope" value="1" <? if($res->add_horoscope=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdoAdd_horoscope" value="0" <? if($res->add_horoscope=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr> <tr class="tblContent">
                                <td>Express interest <font color="#FF0000">*</font></td>
                                <td><input type="radio" name="rdoExpress_intrest" value="1" <? if($res->express_intrest=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdoExpress_intrest" value="0" <? if($res->express_intrest=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr>
							   <tr class="tblContent">
                                <td> Privacy Settings<font color="#FF0000">*</font></td>
                                <td><input type="radio" name="rdoPrivacy_settings" value="1" <? if($res->privacy_settings=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdoPrivacy_settings" value="0" <? if($res->privacy_settings=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr>
							  <tr class="tblContent">
                                <td>Doubled Verified phone numbers<font color="#FF0000">*</font></td>
                                <td><input type="radio" name="rdodouble_verified_phones" value="1" <? if($res->double_verified_phones=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdodouble_verified_phones" value="0" <? if($res->double_verified_phones=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr>
							   <tr class="tblContent">
                                <td>Special Highlighting<font color="#FF0000">*</font></td>
                                <td><input type="radio" name="rdospecial_highlights" value="1" <? if($res->special_highlight=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdospecial_highlights" value="0" <? if($res->special_highlight=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr>
							  <tr class="tblContent">
                                <td>Profile Highlighting <font color="#FF0000">*</font></td>
                                <td><input type="radio" name="rdoprofile_highlight" value="1" <? if($res->profile_highlight=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdoprofile_highlight" value="0" <? if($res->profile_highlight=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr>
							   <tr class="tblContent">
                                <td>Daily Match Watch<font color="#FF0000">*</font></td>
                                <td><input type="radio" name="rdodaily_match_watch" value="1" <? if($res->daily_match_watch=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdodaily_match_watch" value="0" <? if($res->daily_match_watch=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr>
							  <tr class="tblContent">
                                <td>Bookmark Profiles<font color="#FF0000">*</font></td>
                                <td><input type="radio" name="rdobook_mark_profile" value="1" <? if($res->book_mark_profile=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdobook_mark_profile" value="0" <? if($res->book_mark_profile=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr>
							   <tr class="tblContent">
                                <td> Hide and delete Profiles<font color="#FF0000">*</font></td>
                                <td><input type="radio" name="rdohide_delete_profile" value="1" <? if($res->hide_delete_profile=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdohide_delete_profile" value="0" <? if($res->hide_delete_profile=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr>
							 	 <tr class="tblContent">
                                <td> SMS for Daily match and Express interest Alerts <font color="#FF0000">*</font></td>
                                <td><input type="radio" name="rdosms_daily_match" value="1" <? if($res->sms_daily_match=="1") echo "checked"; ?> >
                                  Allowed &nbsp;
                                  <input type="radio" name="rdosms_daily_match" value="0" <? if($res->sms_daily_match=="0") echo "checked"; ?> >
                                  Not-Allowed </td>
                              </tr>
                              <?
										if($_REQUEST['package_id']!=""){
											if(file_exists("../package_features/".$res->file_name)){
												$filename="../package_features/".$res->file_name;
												$fp=fopen($filename,"r");
												$contents=fread($fp,filesize($filename));
												fclose($fp);
											}
										}
									?>
                              <tr class="tblContent">
                                <td colspan="2">Package Features <font color="#FF0000">*</font></td>
                              </tr>
                              <tr class="tblContent">
                                <td colspan="2"><script language="JavaScript" type="text/javascript">
													initRTE("images/", "", "", true);
												</script>
                                    <noscript>
                                      <p><b>Javascript must be enabled to use this form.</b></p>
                                      </noscript>
                                    <script language="JavaScript" type="text/javascript">
													writeRichText('rte1', '<? echo rteSafe($contents);?>',520, 200, true, false);
													//-->
												</script>
                                    <input type="hidden" name="description">
                                </td>
                              </tr>
                              <tr class="tblContent">
                                <td align="center" height="30" colspan="2"><input name="submit" type="submit" class="butten" value="Save">
                                </td>
                              </tr>
                            </table></td></tr>
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

ign="center"><img src="images/spacer.gif" border="0" height="20"></td></tr>
</table>
<!--		End : Main Table		-->
</body>
</html>
<?
/*function convertdate($date)
{
	$lastdt=explode("/",$date);
	$lastdate=$lastdt[2]."-".$lastdt[1]."-".$lastdt[0];
	return $lastdate;
}*/
?>

