<?php
ob_start();
session_start();
include("includes/lib.php");
include("libfuncs.php");
$action = GetVar("action");
isMember();	



//CCAVenue Payment Coding here

	$WorkingKey		=		"s7jhgf8wf5fvt6ln1dax01hxye2h2ha2" ;		//	Put in the 32 bit working key in the quotes provided here
	$Merchant_Id = $_REQUEST['Merchant_Id'];
	$Order_Id=$_REQUEST['upgrade_orderno'];
	$_SESSION['upgrade_orderno']=$Order_Id;
	$Amount=$_REQUEST['Amount'];
	$Auth_Status=$_REQUEST['Auth_Status'];
	$checkSumAll=$_REQUEST['checkSumAll'];	
	$Checksum			=		verifyCheckSumAll($Merchant_Id, $Order_Id , $Amount, $WorkingKey,$Currency,$Auth_Status,$checkSumAll);
		
	if($Checksum=="true" && $Auth_Status=="Y")
	{
			$_SESSION['upgrade_orderno'] = 'ord_2007127105616';	
			$Order_Id = $_SESSION['upgrade_orderno'];
			$_SESSION['msg']= "<br>Thank you for purchasing. Your credit card has been charged and your transaction is successful.";
			$_SESSION['msg'] .= "We will be shipping your order to you soon. <br>Your Order Reference Number #:".$_SESSION['upgrade_orderno'];
			if (GetSingleRecord('tbl_member_profile_upgrade','order_no',$Order_Id)) {
				$res = Execute("update tbl_member_profile_upgrade set payment_status = 1 where order_no = '$Order_Id'");
			}
			
			$order = GetSingleRecord('tbl_member_profile_upgrade','order_no',$Order_Id);	
						
			$mailmsg="";
			$mailmsg ="";
			$mailmsg .= "<style>td { font-family:verdana; font-size:11px; }</style>";
			$mailmsg .= "<table cellspacing='1' cellpadding='5' border='0'  width='550px' bgColor='#7BC2EA'>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td colspan='3' align='left'><b>Order Details From:&nbsp; ".$config[userinfo][name]." </b></td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Order Number #</b></td> <td>:</td> <td>".$Order_Id."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Order Date </b></td> <td>:</td> <td>".$order[created_date]."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Payment Type</b></td> <td>:</td> <td>".$order[payment_mode]."</td>\n</tr>\n";
			$mailmsg .= "<tr>\n<td colspan='3' align='left'><font color='#FFFFFF'><b>Customer Address Details</b></font></td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>First Name</b></td> <td>:</td> <td>".$config[userinfo][name]."</td>\n</tr>\n";			
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Email Address</b></td> <td>:</td> <td>".$config[userinfo][email]."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Address</b></td> <td>:</td> <td>".$config[userinfo][streetAddress] . ', ' . $config[userinfo][area]."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>City</b></td> <td>:</td> <td>".GetSingleField('city','tbl_city_master','id',$config[userinfo][city])."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>State</b></td> <td>:</td> <td>".GetSingleField('state','tbl_state_master','id',$config[userinfo][state])."</td>\n</tr>\n";			
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Zip Code</b></td> <td>:</td> <td>".$config[userinfo][pincode]."</td>\n</tr>\n";
			
			if ($config[userinfo][phoneNumber]) 
				$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Phone </b></td> <td>:</td> <td>".$config[userinfo][phoneNumber]."</td>\n</tr>\n";										
				
			if ($config[userinfo][mobileNumber])
				$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Mobile Number </b></td> <td>:</td> <td>".$config[userinfo][mobileNumber]."</td>\n</tr>\n";						
			
			$mailmsg .= "<tr>\n<td colspan='3' align='left'><font color='#FFFFFF'><b>Package Details</b></font></td>\n</tr>\n";	
			$mailmsg.="<tr bgcolor='#FFFFFF'><td colspan='3'>";
			
			$package = GetSingleRecord('tbl_packages','package_id',$order[package_id]);
			if ($package) {
					$mailmsg.="<table align='left' cellpadding='3' cellspacing='1' width='550px' bgColor='#7BC2EA'>\n";
					$mailmsg.="<tr><td><b>Package Name</b></td><td><b>Package Price($) </b></td><td><b>Total Amount($)</b></td></tr>";				
					
					$mailmsg.="<tr bgcolor='#FFFFFF'><td>".$package[package_name]."</td><td>".$package[package_price]."</td><td>".$package[package_price]."</td></tr>\n";					
					$mailmsg.="<tr bgcolor='#FFFFFF'><td colspan='2' align='right'>Total Net Amount($)</td><td>".number_format($package[package_price],2)."</td></tr>\n";								
					$mailmsg.="</table>\n";			
					
			}			
			$mailmsg.="</td></tr></table>\n";			
																					
			$strTo ="sales@newindamatrimony.com";
			$strFrom = $config[userinfo][email];															
			$strSubject = "Order Details From:".$config[uesrinfo][name];
			$strContent = $mailmsg;
			send_mail($strTo,$strFrom,$strSubject,$strContent);						
				
			$strTo = $config[userinfo][email];
			//$strTo = "creativedesignforyou@gmail.com";
			$strFrom = "sales@newindamatrimony.com";																																	
			$strSubject = "Your Purchased Order Details from shaadi.com";
			$strContent = $mailmsg;
			send_mail($strTo,$strFrom,$strSubject,$strContent);							
			header("Location:thanks.php");
			die();		
			
			//Here you need to put in the routines for a successful 
			//transaction such as sending an email to customer,
			//setting database status, informing logistics etc etc
	}
	else if($Checksum=="true" && $Auth_Status=="B")
	{
			$_SESSION['Msg']= "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
			//Here you need to put in the routines/e-mail for a  "Batch Processing" order (if any)	
	}

	else if($Checksum=="true" && $Auth_Status=="N")
	{
			$_SESSION['Msg']= "<br>Thank you for shopping with us.However,the transaction has been declined.";
			//Here you need to put in the routines for a failed
			//transaction such as sending an email to customer
			//setting database status etc etc
	}
	else
	{
		$_SESSION['Msg']="<br>Checksum Mismatch";
		//Here you need to simply ignore this and dont need
		//to perform any operation in this condition
		// Anways please check the flow.
	}
?>

<body class="homeinbody">
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
					<div class="titlebg"><h1 class="title">Feedback</h1></div>
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>				
					  <td width="592" rowspan="4" valign="top">
						<!--<h1 class="title">Member Login</h1>
						<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
					
						<div style="float:left; padding:10px 0px 0px 10px;">
						<table border="0" width="90%" align="center" cellspacing="1" cellpadding="0" bgcolor="#c0ba84">
							
							  <!--<tr>
								<td width="50%" height="20" bgcolor="#a5b400"><h4 class="mparv">Login</h4></td>
								<td width="50%" height="20" bgcolor="#a5b400" align="center"><h4 class="mserv"></h4></td>
							  </tr>-->
							<tr bgcolor="#ffffff">
								<td align="center" height="100px"><b class="red"><?=$_SESSION['msg']?><? $_SESSION['msg'] = ""; ?></b></td>
							</tr>
					</td>
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
</body>
</html>
