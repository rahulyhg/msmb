<?php
ob_start();
session_start();
include("includes/lib.php");
include("libfuncs.php");
$action = GetVar("action");

//CCAVenue Payment Coding here
	$WorkingKey	= "o2ia6cxoud174g1z5jdpf6a2f88dg8ak" ;		//	Put in the 32 bit working key in the quotes provided here
	$Merchant_Id = "M_Pothamma_7041";
	$Order_Id=$_REQUEST['Order_Id'];
	$_SESSION['upgrade_orderno']=$Order_Id;
	$Amount=$_REQUEST['Amount'];
	$AuthDesc=$_REQUEST['AuthDesc'];	
	$Auth_Status=$_REQUEST['Auth_Status'];
	$Checksum=$_REQUEST['Checksum'];	
	/*

		This is the sample RedirectURL PHP script. It can be directly used for integration with CCAvenue if your application is developed in PHP. You need to simply change the variables to match your variables as well as insert routines for handling a successful or unsuccessful transaction.
	
		return values i.e the parameters namely Merchant_Id,Order_Id,Amount,AuthDesc,Checksum,billing_cust_name,billing_cust_address,billing_cust_country,billing_cust_tel,billing_cust_email,delivery_cust_name,delivery_cust_address,delivery_cust_tel,billing_cust_notes,Merchant_Param POSTED to this page by CCAvenue. 
	
	*/
	
	//$WorkingKey = "o2ia6cxoud174g1z5jdpf6a2f88dg8ak" ; //put in the 32 bit working key in the quotes provided here
	
	
	//echo "($Merchant_Id,$Order_Id,$Amount,$AuthDesc,$Checksum,$WorkingKey)"."<br>";
	$Checksum = verifyChecksum($Merchant_Id,$Order_Id,$Amount,$AuthDesc,$Checksum,$WorkingKey);
	//$AuthDesc = 'Y';
	
	
	//$Checksum			=		verifyCheckSumAll($Merchant_Id, $Order_Id , $Amount, $WorkingKey,$Currency,$Auth_Status,$checkSumAll);
	//$Checksum="true";
	//$Auth_Status="Y";
	if($Checksum=="true" && $AuthDesc=="Y")
	{
			
			$Order_Id = $_SESSION['upgrade_orderno'];
			$order = GetSingleRecord('tbl_member_profile_upgrade','order_no',$Order_Id);
			$_SESSION['msg']= "<br>Thank you for upgraded your membership. Your credit card has been charged and your transaction is successful.";
			$_SESSION['msg'] .= "<br>Your upgrade Reference Number #:".$_SESSION['upgrade_orderno'];
			
			$order = GetSingleRecord('tbl_member_profile_upgrade','order_no',$Order_Id);	
		
			$member = GetSingleRecord('tbl_register','username',$order[member_id]);
			
			$package = GetSingleRecord('tbl_packages','package_id',$order[package_id]);
			
			if ($order) {				
				$res = Execute("update tbl_member_profile_upgrade set payment_status = 1, phone_allowed = '" . $package[phone_number_allowed] . "', address_allowed = '" . $package[address_allowed] . "' where order_no = '$Order_Id'");				
				$today = date("Y-m-d");
				//$exp_date = GetPackageExpiry_Date1($today,$package[valid_period]);
				$exp_date = $order[package_expiry_date];
				$res1 = Execute("update tbl_register set membership_type= '" . $order[package_id] ."', package_expiry_date = '$exp_date', phone_allowed = phone_allowed+" . $package[phone_number_allowed] . ", address_allowed = address_allowed+" . $package[address_allowed] ." where id = '" . $member[id] ."'");
			}		
			
			$mailmsg="";			
			$mailmsg .= "<style>td { font-family:verdana; font-size:11px; }</style>";
			$mailmsg .= "<table cellspacing='1' cellpadding='5' border='0'  width='550px' bgColor='#7BC2EA'>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td colspan='3' align='left'><b>Upgrade Details From:&nbsp; ".$member[name]." </b></td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Upgrade Number #</b></td> <td>:</td> <td>".$Order_Id."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Upgrade Date </b></td> <td>:</td> <td>".$order[created_date]."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Payment Type</b></td> <td>:</td> <td>".$order[payment_mode]."</td>\n</tr>\n";
			$mailmsg .= "<tr>\n<td colspan='3' align='left'><font color='#FFFFFF'><b>Customer Address Details</b></font></td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>First Name</b></td> <td>:</td> <td>".$member[name]."</td>\n</tr>\n";			
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Email Address</b></td> <td>:</td> <td>".$member[email]."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Address</b></td> <td>:</td> <td>".$member[streetAddress] . ', ' . $member[area]."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>City</b></td> <td>:</td> <td>".GetSingleField('city','tbl_city_master','id',$member[city])."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>State</b></td> <td>:</td> <td>".GetSingleField('state','tbl_state_master','id',$member[state])."</td>\n</tr>\n";			
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Zip Code</b></td> <td>:</td> <td>".$member[pincode]."</td>\n</tr>\n";
			
			if ($member[phoneNumber]) 
				$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Phone </b></td> <td>:</td> <td>".$member[phoneNumber]."</td>\n</tr>\n";										
				
			if ($member[mobileNumber])
				$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Mobile Number </b></td> <td>:</td> <td>".$member[mobileNumber]."</td>\n</tr>\n";						
			
			$mailmsg .= "<tr>\n<td colspan='3' align='left'><font color='#FFFFFF'><b>Package Details</b></font></td>\n</tr>\n";	
			$mailmsg.="<tr bgcolor='#FFFFFF'><td colspan='3'>";			
			
			if ($package) {
				$mailmsg.="<table align='left' cellpadding='3' cellspacing='1' width='550px' bgColor='#7BC2EA'>\n";
				$mailmsg.="<tr><td><b>Package Name</b></td><td><b>Package Price($) </b></td><td><b>Total Amount($)</b></td></tr>";					
				$mailmsg.="<tr bgcolor='#FFFFFF'><td>".$package[package_name]."</td><td>".$package[package_price]."</td><td>".$package[package_price]."</td></tr>\n";					
				$mailmsg.="<tr bgcolor='#FFFFFF'><td colspan='2' align='right'>Total Net Amount($)</td><td>".number_format($package[package_price],2)."</td></tr>\n";								
				$mailmsg.="</table>\n";					
			}			
			$mailmsg.="</td></tr></table>\n";		
																					
			$strTo ="sales@newindamatrimony.com";			
			$strFrom = $member[email];															
			$strSubject = "Upgrade Details From:".$member[name];
			$strContent = $mailmsg;
			send_mail($strTo,$strFrom,$strSubject,$strContent);
				
			$strTo = $member[email];				
			$strFrom = "sales@newindamatrimony.com";																																	
			$strSubject = "Your Upgrade Package Details from shaadi.com";
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
			$_SESSION['Msg']= "<br>Thank you for shopping with us.  We will keep you posted regarding the status of your order through e-mail";
			//Here you need to put in the routines/e-mail for a  "Batch Processing" order (if any)	
	}

	else if($Checksum=="true" && $Auth_Status=="N")
	{
		$_SESSION['Msg']= "<br>Thank you for shopping with us.  However,the transaction has been declined.";
		//Here you need to put in the routines for a failed
		//transaction such as sending an email to customer
		//setting database status etc etc
	}
	else
	{
		$_SESSION['Msg']="<br>Security Error. Illegal access detected";
		
		//Here you need to simply ignore this and dont need
		//to perform any operation in this condition
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

	var newwindow="";
	function poptastic(url){
	newwindow=window.open(url,'name','height=500,width=280,left=20,top=20,toolbar=no,menubar=no,directories=no,location=no,scrollbars=yes,status=no,resizable=yes,fullscreen=no');
	if (window.focus) {newwindow.focus()}
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
			<div style="padding:10px 6px 0px 0px; width:573px; float:right;" >
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
					    <td width="400" rowspan="4" valign="top">
						<!--<h1 class="title">Member Login</h1>
						<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
						<div style="float:left; padding:10px 0px 0px 0px;">
						<table border="0" width="550" align="left" cellspacing="0" cellpadding="0" style="background:url(images/vpro_menu.jpg) top center no-repeat; height:22px; width:550px">						  
						 
						  <tr>
						  	<td valign="top"  style="border:#b68e55 solid 1px;">
								<table border="0" width="400" cellpadding="5"   cellspacing="1">																			
									
						 			<tr>
									 	<td align="left"><b class="clr"><?=$_SESSION['Msg']?><? $_SESSION['Msg'] = ""; ?> </b></td>
									 </tr>
									 <tr bgcolor="#FFFFFF">
										<td>
											<a href="javascript:history.back()" class="edit"><b class="clr">Back</b></a>
										<br>
										</td>										
									 </tr>                               
									 								
								</table>			
							 </td>								 
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
		  		include("includes/fotter.php") ?>
  </td>
  </tr>
</table>
<div>
</body>
</html>
