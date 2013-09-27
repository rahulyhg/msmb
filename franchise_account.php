<?php
ob_start();
session_start();
include("includes/lib.php");
#checking for franchise login
isFranchise();
 $sql="select * from tbl_franchisee where (auto_id='".$_SESSION['franchisee_id']."' and franchisee_email='".$_SESSION['franchisee_email']."')";
 $res=mysql_query($sql);
 if(mysql_num_rows($res)>0)
 {
   $obj=mysql_fetch_object($res);
   $franchisee_id=$obj->franchisee_id;
   $franchisee_name=$obj->franchisee_name;
   $franchisee_username=$obj->franchisee_username;
   $franchisee_password=$obj->franchisee_password;
   $franchisee_email=$obj->franchisee_email;
   $franchisee_address=$obj->franchisee_address;
   $franchisee_address1 = $obj->franchisee_address;   
   $franchisee_phone=$obj->franchisee_phone;
   if ($obj->country) {
	   $country =  GetSingleField("country","tbl_country_master","id",$obj->country);
   } 
   if ($obj->state) { 
	   $state =  GetSingleField("state","tbl_state_master","id",$obj->state);
   }
   if ($obj->city) {	   
	   $city =  GetSingleField("city","tbl_city_master","id",$obj->city);
   }   
 }
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
<script language="javascript" >
var newwindow="";
	function poptastic(url){
	newwindow=window.open(url,'name','height=500,width=280,left=20,top=20,toolbar=no,menubar=no,directories=no,location=no,scrollbars=yes,status=no,resizable=yes,fullscreen=no');
	if (window.focus) {newwindow.focus()}
	}

</script>

</head>
<body class="homeinbody" onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
<div class="menuleftimg">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
    <td align="right"><? fnBannerImage(' ','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>  
  <tr>
    <td colspan="2" valign="top">
	<table width="780" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td>
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:12px 0px 0px 0px; float:left;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<div class="titlebg"><h1 class="title">Account Information</h1>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
					    <td width="592" rowspan="4" valign="top" >
						<!--<h1 class="title">Member Login</h1>
						<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
						<? if ($_SESSION['_msg']) {?>
							<table cellpadding="0" cellspacing="0" border="1"><tr><td colspan="3" align="center"><div style="float:center; padding-top:23px;"><? if($_SESSION['_msg']!=""){?> <font class=""><?=$_SESSION['_msg']; $_SESSION['_msg']="";?></font>&nbsp;&nbsp;<? }?></div></td></tr></table>
						<? } ?>	
						<div style="float:left; padding:0px 0px 0px 10px;">
						
						<table border="0" width="90%" bgcolor="#fffff0"  cellspacing="1" cellpadding="0" style="border:1px solid #80817e;">
							
							  <!--<tr>
								<td width="50%" height="20" bgcolor="#a5b400"><h4 class="mparv">Login</h4></td>
								<td width="50%" height="20" bgcolor="#a5b400" align="center"><h4 class="mserv"></h4></td>
							  </tr>-->
							<tr bgcolor="#fffff">
								<td style="padding:5px;">
								<form name="thisForm" method="post" action="confirm_upgrade_member.php?Mode=Upgrade" onSubmit="return fnValidateUpgrade();">
									<table border="0" width="100%" align="center" cellspacing="1" cellpadding="5" gcolor="#ffffff">
										<div style="float:right; position:absolute; padding-left:335px;"><img src="images/account_information.gif"></div>
										<tr>
								  <td width="35%" gcolor="#fcf9e0">Franchise Name</td>
  								  <td width="3%" >:</td>
								  <td width="62%"><?=$franchisee_name; ?></td>
						  </tr>
								 
								<tr >
							      <td width="35%" gcolor="#ffffff">Franchise Id</td>
   								  <td width="3%" >:</td>
								  <td width="62%" ><?=$franchisee_id; ?></td>
								</tr>
								
								<tr>
								   <td width="35%" gcolor="#fcf9e0">Franchise Username (chat)</td>
							      <td width="3%"  >:</td>
								   <td width="62%"><?=$franchisee_username; ?></td>
								</tr>
								<?
								$newpasslen=strlen($franchisee_password);
								for($iC=1;$iC<=$newpasslen;$iC++){
									$newpass.="*";
								} 
								
								?>
								<tr>
								   <td width="35%" gcolor="#ffffff">Franchise Password</td>
							      <td width="3%" >:</td>
								   <td width="62%"><? echo $newpass; ?></td>
								</tr>
								
								<tr>
								   <td width="35%" gcolor="#fcf9e0">Franchise Email address</td>
								   <td width="3%"   valign="top">:</td>
								   <td width="62%" ><?=$franchisee_email; ?></td>
								</tr>
								
								<tr>
								   <td width="35%"  valign="top" gcolor="#ffffff">Franchise Country</td>
								   <td width="3%"  valign="top">:</td>
								   <td width="62%"><? echo str_replace(chr(13),"<br>",$country); ?></td>
								</tr>
								
								<tr>
								   <td width="35%"  valign="top" gcolor="#fcf9e0">Franchise State</td>
								   <td width="3%"  valign="top">:</td>
								   <td width="62%"><? echo str_replace(chr(13),"<br>",$state); ?></td>
								</tr>
								
								<tr>
								   <td width="35%"  valign="top" gcolor="#ffffff">Franchise City</td>
								   <td width="3%"  valign="top">:</td>
								   <td width="62%"><? echo str_replace(chr(13),"<br>",$city); ?></td>
								</tr>
								
								<tr>
								   <td width="35%"  valign="top" gcolor="#fcf9e0">Franchise Address</td>
								   <td width="3%"  valign="top">:</td>
								   <td width="62%"><? echo str_replace(chr(13),"<br>",$franchisee_address); ?></td>
								</tr>
								
								<tr>
								   <td width="35%"  valign="top" gcolor="#ffffff">Franchise Address1</td>
								   <td width="3%"  valign="top">:</td>
								   <td width="62%"><? echo str_replace(chr(13),"<br>",$franchisee_address1); ?></td>
								</tr>						
								

								<tr class="select">
								   <td width="35%" gcolor="#fcf9e0">Contact Phone number</td>
   								   <td width="3%" >:</td>
								   <td width="62%"><font style="font-weight:normal;"><?=$franchisee_phone; ?></font></td>
								</tr>
									</table>
										</form>
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
