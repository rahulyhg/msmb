<?php
ob_start();
session_start();
include("includes/lib.php");
isMember();
$action = GetVar("action");
if($_SESSION['upgrade_orderno']==""){
	$precent_date=getdate();
	$_SESSION['upgrade_orderno']="ord_".$precent_date[year].$precent_date[mon].$precent_date[mday].$precent_date[hours].$precent_date[minutes].$precent_date[seconds];	
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="file://///aesdc/Websites/newindia_matrimony/ver3/includes/style.css" type="text/css" rel="stylesheet"/>
<link href="file://///aesdc/Websites/newindia_matrimony/ver3/includes/my_matrimony.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" src="file://///aesdc/Websites/newindia_matrimony/ver3/includes/validate.js"></script>
<script language="JavaScript" src="file://///aesdc/Websites/newindia_matrimony/ver3/includes/functions.js"></script>		
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

function fnValidate(){
	if(notChecked(document.thisForm.elements["rdPackage"],"Package type")){return false;}			
}
//-->
</script>
</head>
<body class="homeinbody" onLoad="MM_preloadImages('file://///aesdc/Websites/newindia_matrimony/ver3/images/menu_assam_ovr.jpg','file://///aesdc/Websites/newindia_matrimony/ver3/images/menu_benga_ovr.jpg','file://///aesdc/Websites/newindia_matrimony/ver3/images/menu_guja_ovr.jpg','file://///aesdc/Websites/newindia_matrimony/ver3/images/menu_hind_ovr.jpg','file://///aesdc/Websites/newindia_matrimony/ver3/images/menu_kanad_ovr.jpg','file://///aesdc/Websites/newindia_matrimony/ver3/images/menu_malay_ovr.jpg','file://///aesdc/Websites/newindia_matrimony/ver3/images/menu_marat_ovr.jpg','file://///aesdc/Websites/newindia_matrimony/ver3/images/menu_marw_ovr.jpg','file://///aesdc/Websites/newindia_matrimony/ver3/images/menu_punj_ovr.jpg','file://///aesdc/Websites/newindia_matrimony/ver3/images/menu_tamil_ovr.jpg','file://///aesdc/Websites/newindia_matrimony/ver3/images/menu_telug_ovr.jpg','file://///aesdc/Websites/newindia_matrimony/ver3/images/menu_urdu_ovr.jpg')">
<div class="menuleftimg">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="105"><a href="file://///aesdc/Websites/newindia_matrimony/ver3/index.php"><img src="file://///aesdc/Websites/newindia_matrimony/ver3/images/logo.jpg" vspace="10" border="0"/></a></td>
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
					<div class="titlebg"><h1 class="title">Upgrade Membership</h1></div>
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
			  	<td width="592" rowspan="4" valign="top">						
						<div style="float:left; padding:10px 0px 0px 10px;">
						<form name="thisForm" action="file://///aesdc/Websites/newindia_matrimony/ver3/upgrade_details.php" method="post" onSubmit="return fnValidate();">
						<table border="0" width="90%" align="center" cellspacing="1" cellpadding="0" bgcolor="#ffb300">
							<tr bgcolor="#ffffff">																		
								
										<?
											$sql_package="select * from tbl_packages where package_id!=1";
											$res_package=mysql_query($sql_package);	
											if(mysql_num_rows($res_package)>0){
											$iCnt=0;
											while($obj_package=mysql_fetch_object($res_package)){  
										   if($obj_package->package_id!=""){
										   										   		
												if($iCnt > 1){
													echo "</tr><tr bgcolor=\"#FFFFFF\">";
												}								
										?>
										<td>
											<table align="left" cellpadding="1" cellspacing="1" border="0" width="230" bordercolor="#000009">
												<tr>
													 <td class="select" colspan="2"> 
													 	<? if ($_SESSION['package_id'] == $obj_package->package_id) { ?>
													 		<input type="radio" value="<?=$obj_package->package_id; ?>" name="rdPackage" checked>
													 		<? } else { 
																if (GetVar("package_id") == $obj_package->package_id) { ?>
													 		<input type="radio" value="<?=$obj_package->package_id; ?>" name="rdPackage" checked> 
															 <?	} else { ?>
																	<input type="radio" value="<?=$obj_package->package_id; ?>" name="rdPackage" <? if($rec_count==2) {?> checked="checked" <? } ?>> <?=$obj_package->package_name; ?>
															 <? } ?>	
														<? } ?>													</td>
											   </tr>
											   <tr>
													 <td class="select">Package Price(INR):</td>
													 <td class="select"><?=$obj_package->package_price; ?></td>
												 </tr>					
												  <tr>
													 <td class="select">Valid period:</td>
													 <td class="select"><?=$obj_package->valid_period." Months"; ?></td>
												 </tr>	
												 
												 <tr>
													<? if($obj_package->phone_allowed_status=="L") $s=0;else $s=1; ?>
												 <? if($s==1) $val="Unlimited";else $val=$obj_package->phone_number_allowed; ?>
													 <td class="select">Phone number allowed:</td>
													 <td class="select"><?=$val; ?></td>
												 </tr>										 
												  <tr>
													 <? if($obj_package->address_allowed_status=="L") $s=0;else $s=1; ?>
													 <? if($s==1) $val="Unlimited";else $val=$obj_package->address_allowed; ?>
													 <td class="select">Addresses allowed:</td>
													 <td class="select"><?=$val; ?></td>
												 </tr>
											 <? if(file_exists("package_features/".$obj_package->file_name)){ ?>
												 <tr>
												 <td class="select" colspan="2"><font color="#FF0099">Additional Features:</font></td>
												 </tr>
												 
												 <tr>
												 <td colspan="2">
												  <?   $fd=fopen("package_features/".$obj_package->file_name,"r");
													   $content=fread($fd,filesize("package_features/".$obj_package->file_name));
													   fclose($fd);
													   echo $content;
												  ?>												 </td>
												 </tr>
												<? }//if file exists ?>	 							
											</table>									
										</td>
										
										<? 
											if($iCnt > 1){
												echo '<td>&nbsp;</td>';
											}
										 
										$iCnt++;
										 }
										}//while loop
										 }else{	//if loop								 
										?>
											
										<? }?>
											
							 </tr>
							 <tr bgcolor="#FFFFFF">
					           <td align="right" colspan="3"><input type="submit" name="submit" value="Checkout" class="button" ></td>
					        </tr>
						 </table>
					</form>
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
