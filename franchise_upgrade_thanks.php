<?php
ob_start();
session_start();
include("includes/lib.php");
include("includes/number_to_word.php");

#checking for franchise login
isFranchise();
if($_SESSION['upgrade_orderno']==""){
	$precent_date=getdate();
	$_SESSION['upgrade_orderno']="upg_".$precent_date[year].$precent_date[mon].$precent_date[mday].$precent_date[hours].$precent_date[minutes].$precent_date[seconds];	
}

$sql="select * from tbl_franchisee where (auto_id='".$_SESSION['franchisee_id']."' and franchisee_email='".$_SESSION['franchisee_email']."')";
 $res=mysql_query($sql);
 if(mysql_num_rows($res)>0){
   $obj=mysql_fetch_object($res);
   $franchisee_id=$obj->franchisee_id;  
   $franchisee_username=$obj->franchisee_username;
   $franchisee_password=$obj->franchisee_password;  
 } 
 
 
 if($_REQUEST['Mode']=="Upgrade"){ 		
	$res_chk=mysql_query("select * from tbl_register where username='".trim($_REQUEST['txtMemberID'])."'");
	if(mysql_num_rows($res_chk)==0){
		$_SESSION['_msg']="Sorry!!, Invalid member registration number!!.";
		header("Location:franchise_upgrade_member.php?action=notexists");
		die();
	} 	
	
	$res_member=mysql_query("select *,DATE_FORMAT(date_of_birth,'%D %M,%Y')as date_of_birth from tbl_register where username='".trim($_REQUEST['txtMemberID'])."'");
	if(mysql_num_rows($res_member)>0){
		$obj_member=mysql_fetch_object($res_member);
	}

	
	
 }

if($_REQUEST['cmbPackageType']!=""){
	$sql_package="select * from tbl_packages where package_id='".$_REQUEST['cmbPackageType']."'";
	$res_package=mysql_query($sql_package);
	if(mysql_num_rows($res_package)>0){
		$obj_package=mysql_fetch_object($res_package);
		
	}
} 

if($_REQUEST['Mode']=="finalUpgrade"){
	
	$sql_userid="select * from tbl_register where id='".$_REQUEST['txtHidMemberAutoid']."'";
	$res_userid=mysql_query($sql_userid);
	if(mysql_num_rows($res_userid)>0){
		$obj_userid=mysql_fetch_object($res_userid);
		$prev_expdate=$obj_userid->package_expiry_date;
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

		
		$sql="select * from tbl_packages where package_id='".$_REQUEST['txtHidPackageid']."'";
		$res=mysql_query($sql);
		if(mysql_num_rows($res)>0){
		 $obj=mysql_fetch_object($res);
		}
		$franchise_percentage=$obj->franchise_percentage;
		$package_amount=$obj->package_price;
		$total_days=$obj->valid_period*30;
		$total_days=$total_days+$diff_duration;
		
		$sql_date="select date_add(CURRENT_DATE(), INTERVAL ".$total_days." DAY) as expdate";
		$res_date=mysql_query($sql_date);
		if(mysql_num_rows($res_date)>0){
			$obj_date=mysql_fetch_object($res_date);
		}
	
		if($franchise_percentage>0){
			$net_commission_amount=(($package_amount)*($franchise_percentage/100));
			$net_reduction_amount=$package_amount-$net_commission_amount;
		}else{
			$net_reduction_amount=$package_amount;
		}		
			
		
	#record maintain for upgrade membership 
	$sql_insert="insert into tbl_member_profile_upgrade(member_unique_id,member_auto_id,member_id,package_id,package_duration_time,package_expiry_date,payment_mode,cheque_number,bank_name,cheque_date,moneyorder_number,post_office_name,moneyorder_date,franchise_auto_id,franchise_id,payment_notes,created_date,payment_status,franchise_commission_amount)values";
	$sql_insert.="('".$_SESSION['upgrade_orderno']."','".$_REQUEST['txtHidMemberAutoid']."','".$_REQUEST['txtHidMemberid']."','".$_REQUEST['txtHidPackageid']."','".$_REQUEST['txtHidPackageDuration']."','".$obj_date->expdate."','".$_REQUEST['txtPaymentType']."','".$_REQUEST['txtChequeNo']."','".$_REQUEST['txtBankName']."','".$_REQUEST['txtChequeDate']."','".$_REQUEST['txtMoneyNo']."','".$_REQUEST['txtPostofficeName']."','".$_REQUEST['txtPostDate']."','".$_SESSION['franchisee_id']."','".$_SESSION['franchisee_reg_id']."','".$_REQUEST['txtPaymentDescription']."',CURRENT_DATE(),'1','".$net_commission_amount."')";		
	mysql_query($sql_insert);
	echo mysql_error();
	

	 
	#upgrade in registration table
	$sql_update="update tbl_register set membership_type='".$_REQUEST['txtHidPackageid']."',package_expiry_date='".$obj_date->expdate."' where id='".$_REQUEST['txtHidMemberAutoid']."'";	
	mysql_query($sql_update);
	echo mysql_error();	
	 
	 
	$sql_update="update tbl_franchisee set credit_amount=credit_amount-'".$net_reduction_amount."' where auto_id='".$_SESSION['franchisee_id']."' and  franchisee_id='".$_SESSION['franchisee_reg_id']."'";
	mysql_query($sql_update);	
	echo mysql_error();
	
	
	$_SESSION['_msg']="The member profile has been upgraded successfully and <br> the package expires on:".strftime("%d-%B-%Y", strtotime($obj_date->expdate));
	header("Location:franchise_upgrade_thanks.php?mode=thanks");			
	die();					
	
	
  
		
		
		
	
}


 
 
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" rel="stylesheet" type="text/css"/>
<link href="includes/payment.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" src="includes/validate.js"></script>
<script language="JavaScript" src="includes/functions.js"></script>	
<script type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
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

	
	function fnDisplay(){
		if(document.thisForm.cmbPaymentMode.value!=""){
			
			if(document.thisForm.cmbPaymentMode.value=="Cheque"){
				document.getElementById("tblCheque").style.display="block";
				document.getElementById("tblMoney").style.display="none";								
			}else if(document.thisForm.cmbPaymentMode.value=="Money_order"){
				document.getElementById("tblCheque").style.display="none";
				document.getElementById("tblMoney").style.display="block";								
			}						
		}
	}
	

//-->
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
		<td>
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:10px 20px 0px 0px; width:573px; float:right;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<div class="titlebg">
					  <h1 class="title">Thanks</h1>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
					    <td width="592" rowspan="4" valign="top">
						<!--<h1 class="title">Member Login</h1>
						<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
						<? if ($_SESSION['_msg']) {?>
							<table width="90%"><tr><td colspan="3" align="center"><div style="float:center; padding-top:23px;"><? if($_SESSION['_msg']!=""){?> <font class=""><?=$_SESSION['_msg']; $_SESSION['_msg']="";?></font>&nbsp;&nbsp;<? }?></div></td></tr></table>
						<? } ?>	
						<div style="float:left; padding:10px 0px 0px 10px;">
						
						
						
						
						</div>
						
					 </td>
					
			  </tr>
			 
			  <tr>
				<td>
					
				</td>
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
