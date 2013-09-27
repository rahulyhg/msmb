<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging.php");
include("includes/menu.php");
$linkid = db_connect();

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
	<tr><td valign="top">
		<table align="center" cellpadding="5" cellspacing="1" border="0" width="550" class="tblBorder">
		<?
			$sql="select a.*,b.*,c.package_name,c.package_price,c.package_id as org_package_id,DATE_FORMAT(b.package_expiry_date,'%D %M, %Y')as package_expiry_date,DATE_FORMAT(a.created_date,'%D %M, %Y')as created_date from tbl_member_profile_upgrade a,tbl_register b, tbl_packages c where b.username=a.member_id and a.member_auto_id=b.id and c.package_id=a.package_id and a.auto_id='".$_REQUEST['mem_autoid']."' order by a.auto_id asc";
			$res=mysql_query($sql);
			echo mysql_error();
			if(mysql_num_rows($res)>0){	
				$obj=mysql_fetch_object($res);
						
		?>
		<tr><td colspan="3"><strong>Upgrade Request Details</strong></td></tr>
		<tr bgcolor="#FFFFFF"><td>Member Name</td><td>:</td><td><? echo $obj->name;?></td></tr>
		<tr bgcolor="#FFFFFF"><td>Date of Expiry</td><td>:</td><td><? echo $obj->package_expiry_date;?></td></tr>
		<tr bgcolor="#FFFFFF"><td>Date of Renewal</td><td>:</td><td><? echo $obj->created_date;?></td></tr>
		<tr bgcolor="#FFFFFF"><td>Package Type</td><td>:</td><td><? echo $obj->package_name;?></td></tr>
		<tr bgcolor="#FFFFFF"><td>Package Price</td><td>:</td><td>Rs.<? echo $obj->package_price;?></td></tr>
		<tr><td colspan="3"><strong>Other details</strong></td></tr>
		<? if($obj->payment_mode!=""){?>
			<tr bgcolor="#FFFFFF"><td>Payment Method</td><td>:</td><td><? echo $obj->payment_mode;?></td></tr>
		 <? }?>	
		<? if($obj->cheque_number!=""){?>
			<tr bgcolor="#FFFFFF"><td>Cheque Number</td><td>:</td><td><? echo $obj->cheque_number;?></td></tr>
		 <? }?>	
		 <? if($obj->bank_name!=""){?>
			<tr bgcolor="#FFFFFF"><td>Bank Name</td><td>:</td><td><? echo $obj->bank_name;?></td></tr>
		 <? }?>	
		 <? if($obj->cheque_date!="0000-00-00"){?>
			<tr bgcolor="#FFFFFF"><td>Date</td><td>:</td><td><? echo $obj->cheque_date;?></td></tr>
		 <? }?>	
		 
		 <? if($obj->moneyorder_number!=""){?>
			<tr bgcolor="#FFFFFF"><td>Money Order Number</td><td>:</td><td><? echo $obj->moneyorder_number;?></td></tr>
		 <? }?>	
		 <? if($obj->post_office_name!=""){?>
			<tr bgcolor="#FFFFFF"><td>Post office Name</td><td>:</td><td><? echo $obj->post_office_name;?></td></tr>
		 <? }?>	
		  <? if($obj->moneyorder_date!="0000-00-00"){?>
			<tr bgcolor="#FFFFFF"><td>Date</td><td>:</td><td><? echo $obj->moneyorder_date;?></td></tr>
		 <? }?>	
		 <? if($obj->street_address!=""){?>
			<tr bgcolor="#FFFFFF"><td>Street Address</td><td>:</td><td><? echo $obj->street_address;?></td></tr>
		 <? }?>	
		 <? if($obj->area!=""){?>
			<tr bgcolor="#FFFFFF"><td>Area</td><td>:</td><td><? echo $obj->area;?></td></tr>
		 <? }?>	
		 <? if($obj->city!=""){	
		 		$res_city=mysql_query("select * from tbl_city_master where id=".$obj->city);
		 		$rs_city=mysql_fetch_object($res_city);	 ?>
			<tr bgcolor="#FFFFFF"><td>City</td><td>:</td><td><?=$rs_city->city;?></td></tr>
		 <? }?>	
		 <? if($obj->state!=""){	
		 		$res_state=mysql_query("select * from tbl_state_master where id=".$obj->state);
		 		$rs_state=mysql_fetch_object($res_state);	 ?>
			<tr bgcolor="#FFFFFF"><td>State</td><td>:</td><td><? echo $rs_state->state;?></td></tr>
		 <? }?>	
		 <? if($obj->country!=""){	
		 		$res_country=mysql_query("select * from tbl_country_master where id=".$obj->country);
		 		$rs_country=mysql_fetch_object($res_country);	 ?>
			<tr bgcolor="#FFFFFF"><td>Country</td><td>:</td><td><? echo $rs_country->country;?></td></tr>
		 <? }?>	
		 <? if($obj->contact_person_name!=""){?>
			<tr bgcolor="#FFFFFF"><td>Contact Person Name</td><td>:</td><td><? echo $obj->contact_person_name;?></td></tr>
		 <? }?>	
		 <? if($obj->contact_phone!=""){?>
			<tr bgcolor="#FFFFFF"><td>Contact Phone</td><td>:</td><td><? echo $obj->contact_phone;?></td></tr>
		 <? }?>	
		 		 
		 <? if($obj->best_time_contact!=""){?>
			<tr bgcolor="#FFFFFF"><td>Best time to contact</td><td>:</td><td><? echo $obj->best_time_contact;?></td></tr>
		 <? }?>	
		 <? if($obj->contact_email!=""){?>
			<tr bgcolor="#FFFFFF"><td>Contact Email</td><td>:</td><td><? echo $obj->contact_email;?></td></tr>
		 <? }?>	
		 <? if($obj->door_mode_payment!=""){?>
			<tr bgcolor="#FFFFFF"><td>Door Step Payment type</td><td>:</td><td><? echo $obj->door_mode_payment;?></td></tr>
		 <? }?>		  		 
		
		<? }?>	
			
		</table>
	</td></tr>
		
	<tr><td width="100%" height="20" colspan="3" align="center"><img src="images/spacer.gif" border="0" height="20"></td></tr>
</table>
<!--		End : Main Table		-->
</body>
</html>
