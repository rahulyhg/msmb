<?php
ob_start();
session_start();
include("includes/lib.php");
#checking for franchise login
isFranchise();

$sql="select * from tbl_franchisee where (auto_id='".$_SESSION['franchisee_id']."' and franchisee_email='".$_SESSION['franchisee_email']."')";
 $res=mysql_query($sql);
 if(mysql_num_rows($res)>0){
   $obj=mysql_fetch_object($res);
   $franchisee_id=$obj->franchisee_id;  
   $franchisee_username=$obj->franchisee_username;
   $franchisee_password=$obj->franchisee_password;  
 }
 
 $sql_package="select * from tbl_packages where package_id!=1";
 $res_package=mysql_query($sql_package);
 if(mysql_num_rows($res_package)>0){
 	while($obj_package=mysql_fetch_object($res_package)){
		$strPackage.="<option value=".$obj_package->package_id.">".$obj_package->package_name."</option>";
	}
 }
 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/franchise.css" type="text/css" rel="stylesheet"/>
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
	function fnValidateUpgrade(){
		if(isNull(document.thisForm.txtMemberID,"Member ID")){return false;}
		if(notSelected(document.thisForm.cmbPackageType,"Package Type")){return false;}
		if(notSelected(document.thisForm.cmbPaymentMode,"Payment Mode")){return false;}		
		
	}
//-->
</script>
</head>
<body class="homeinbody" onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
<div class="menuleftimg">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
    <td align="right"><? fnBannerImage('','top')  ?></td>
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
			<div style="padding:12px 0px 0px 0px;  float:left;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<div class="titlebg"><h1 class="title">Account Information</h1>
					</div>
				</td>
			  </tr>
			<? if ($_SESSION['_msg']) {?>
				<tr><td colspan="3" align="right"><div style="float:right; color:#ba3501; font-weight:bold;"><? if($_SESSION['_msg']!=""){?> <font class=""><?=$_SESSION['_msg']; $_SESSION['_msg']="";?></font>&nbsp;&nbsp;<? }?></div></td></tr>
			<? } ?>	
			  <tr>
					<td width="561" valign="top">
						<div style="float:left; padding:10px 0px 0px 10px;">
						<table border="0" width="476"  cellspacing="1"  cellpadding="0" style="border-bottom:#d3d3d3 1px solid;" class="regall">
							<tr>
								<td style="padding:20px 0px 0px 40px;">
								<form name="thisForm" method="post" action="confirm_upgrade_member.php?Mode=Upgrade" onSubmit="return fnValidateUpgrade();">
									<table border="0" width="400" cellspacing="0" cellpadding="4" lass="reghbtm">
									
										<input type="hidden" name="txtHidToday" value="<? echo date('d-m-Y');?>">
										<tr><td>Enter Member ID</td>
										<td>:</td>
										<td><input type="text" name="txtMemberID" maxlength="15" class="txtfbox"></td></tr>
										<tr>
											<td>Package type</td>
											<td >:</td>
											<td><select name="cmbPackageType" class="cmbfbox"><option value="">--Select--</option><?echo $strPackage;?></select></td>
										</tr>
										<tr>
											<td>Mode of Payment</td>
											<td>:</td>
											<td><select name="cmbPaymentMode" class="cmbfbox"><option value="">--Select--</option><option value="Cash">Cash</option></select></td>
										</tr>
										<tr>
										<td valign="top">Payment note</td>
										<td valign="top">:</td>
										<td><textarea name="txtPaymentNote" class="txtrfbox" style="width:160px; height:70px"></textarea></td>
										</tr>								
										<tr><td>&nbsp;</td><td>&nbsp;</td><td colspan="2"><input type="submit" name="btns" value="Upgrade" class="button"></td></tr>
										
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
