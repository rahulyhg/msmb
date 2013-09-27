<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
isMember();

	if($_SESSION['upgrade_orderno']!=""){
		$total_order_amount=0;
		$sql="select * from tbl_member_profile_upgrade where order_no='".$_SESSION['upgrade_orderno']."'";	
		$res=mysql_query($sql);
		$no=mysql_num_rows($res);
		if($no>0){
			$rs=mysql_fetch_object($res);							
			$product_id=$rs->package_id;
		}							
		$product_name= GetSingleField('package_name','tbl_packages','package_id',$product_id);
	}
	$sql_cus="select * from tbl_member_profile_upgrade where order_no='".$_SESSION['upgrade_orderno']."'";	
	
	$res_cus=mysql_query($sql_cus);
	if(mysql_num_rows($res_cus)>0){
		$rsC=mysql_fetch_object($res_cus);
	}
	
	$total_order_amount = GetSingleField('package_price','tbl_packages','package_id',$product_id);		
	$userfirstname = $config[userinfo][name];
		
	$useraddress = $config[userinfo][streetAddress] . ', ' . $config[userinfo][area];
	
	if ($config[userinfo][city]) {
		$user_city = GetSingleField('city','tbl_city_master','id',$config[userinfo][city]);
	} else {
		$user_city = $config[userinfo][city_1];
	}
	
	if ($config[userinfo][country])	{ 
		$user_country = GetSingleField('country','tbl_country_master','id',$config[userinfo][country]);
	} else {
		$user_country = $config[userinfo][country_1];
	}
		
	$userzipcode = $config[userinfo][pincode];
	if ($config[userinfo][state]) {
		$user_state = GetSingleField('state','tbl_state_master','id',$config[userinfo][state]);
	} else {
		$user_state = $config[userinfo][state_1];
	}	
	$delivery_customer_name = $config[userinfo][name];
	
	//$delivery_customer_lastname=$rsC->shipping_customer_lastname;
	
	$delivery_customer_address = $config[userinfo][streetAddress] . ', ' . $config[userinfo][area];
	$delivery_customer_city = $user_city;
	$delivery_customer_state = $user_country;
	$delivery_customer_country = $user_country;
	$delivery_customer_zipcode = $config[userinfo][pincode];
	$useremail = $config[userinfo][email];
	
	if ($config[userinfo][phoneNumber] && $config[userinfo][phoneNumber] != 91) { 		
		$phone_number = $config[userinfo][phoneNumber];
	} else { 
		if ($config[userinfo][mobileNumber]) {
			$phone_number = $config[userinfo][mobileNumber];
		}
	}	
	$flag = 1;
	$product_id = $rs->package_id;	
	
	require("libfuncs.php");

	$Merchant_Id = "M_Pothamma_7041" ;//This id(also User Id)  available at "Generate Working Key" of "Settings & Options" 	
	$Amount = $total_order_amount ;//your script should substitute the amount in the quotes provided here	
	$Order_Id = $_SESSION['upgrade_orderno'] ;//your script should substitute the order description in the quotes provided here
	$Redirect_Url = "http://topmatrimonial.thecreativeit.com/redirect_url.php" ;//your redirect URL where your customer will be redirected after authorisation from CCAvenue

	$WorkingKey = "o2ia6cxoud174g1z5jdpf6a2f88dg8ak"  ;//put in the 32 bit alphanumeric key in the quotes provided here.Please note that get this key ,login to your CCAvenue merchant account and visit the "Generate Working Key" section at the "Settings & Options" page. 
	$Checksum = getCheckSum($Merchant_Id,$Amount,$Order_Id ,$Redirect_Url,$WorkingKey);

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/payment.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" src="includes/validate.js"></script>
<script language="JavaScript" src="includes/functions.js"></script>	
<script type="text/JavaScript">
<!--


//-->
</script>
</head>
<body class="homeinbody" onLoad="return fnSubmit();">
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
					<div class="titlebg"><h1 class="title">Processing Order</h1></div>
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>				
					  <td width="592" rowspan="4" valign="top">				
						<div style="float:left; padding:10px 0px 0px 10px;">
						<table border="0" width="184%" align="center" cellspacing="1" cellpadding="0" bgcolor="#c0ba84">				
							  
							
								
						<form name="CCAvenue" method="post" action="https://www.ccavenue.com/shopzone/cc_details.jsp" ction="test.php"> 
						<tr bgcolor="#ffffff">
								<td style="padding-left:100px" height="100px"><b class="red">Please wait while we processing your order...</b></td>
							
						<!-- Mandatory Parameters  -->
						<input type=hidden name="Merchant_Id"		value="<?php echo $Merchant_Id; ?>">
						<input type=hidden name="Amount"				value="<?php echo $Amount; ?>">
						<input type=hidden name="Order_Id"				value="<?php echo $Order_Id; ?>">
						<!--<input type=hidden name="Currency"				value="<?php echo $Currency; ?>">
						<input type=hidden name="TxnType"				value="A">
						<input type=hidden name="actionID"				value="txn">-->	
						<input type=hidden name="Redirect_Url"		value="<?php echo $Redirect_Url; ?>">
						<input type=hidden name="Checksum"			value="<?php echo $Checksum; ?>">					
						<input type="hidden" name="billing_cust_name" value="<?php echo $userfirstname; ?>"> 
						<input type="hidden" name="billing_cust_address" value="<?php echo $useraddress; ?>"> 
						<input type="hidden" name="billing_cust_city"	value="<? echo $user_city;?>">
						<input type="hidden" name="billing_cust_state"				value="<? echo $user_state;?>">
						<input type="hidden" name="billing_cust_country" value="<?php echo $user_country; ?>"> 
						<input type="hidden" name="billing_cust_zip" value="<? echo $userzipcode;?>">
						<input type="hidden" name="billing_cust_tel" value="<?php echo $phone_number; ?>"> 
						<input type="hidden" name="billing_cust_email" value="<?php echo $useremail; ?>"> 
						<input type="hidden" name="delivery_cust_name" value="<?php echo $delivery_customer_name; ?>"> 
						<input type="hidden" name="delivery_cust_address" value="<?php echo $delivery_customer_address; ?>"> 
						<input type="hidden" name="delivery_cust_city"					value="<? echo $user_city;?>">
						<input type="hidden" name="delivery_cust_state"				value="<? echo $user_state;?>">
						<input type="hidden" name="delivery_cust_country" value="<?php echo $user_country; ?>">
						<input type="hidden" name="delivery_cust_zip" value="<? echo $$userzipcode;?>">
						<input type="hidden" name="delivery_cust_tel" value="<?php echo $phone_number; ?>"> 
						<input type="hidden" name="delivery_cust_notes" value="<?php echo $delivery_cust_notes; ?>"> 
						<input type="hidden" name="Merchant_Param" value="<?php echo $Merchant_Param; ?>">						
						
						</form>		
						</tr>
						
						</table>
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
		include("includes/fotter.php");
	?>
  </td>
  </tr>
</table>
<div>
<script language="JavaScript">
function fnSubmit()
{
	document.CCAvenue.submit();
}
</script>
</body>
</html>
