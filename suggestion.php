<?php
ob_start();
session_start();
include("includes/lib.php");
	if($_REQUEST['mode']=="send"){
		$mailmsg ="";
		$mailmsg .= "<style>td { font-family:verdana; font-size:11px; }</style>";
		$mailmsg .= "<table cellspacing='0' cellpadding='5' border='0'  width='80%'  style='border:#000000 1px solid;'  >\n";
		$mailmsg .= "<tr>\n<td colspan='3' align='center' bgColor='#FFFFFF'><font color='#000000'><b>Suggestions</b></font></td>\n</tr>\n";
		$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>First Name</b></td> <td>:</td> <td>".$_REQUEST['txtFName']."</td>\n</tr>\n";
		//$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Last Name</b></td> <td>:</td> <td>".$_REQUEST['txtLName']."</td>\n</tr>\n";
		$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Email Address</b></td> <td>:</td> <td>".$_REQUEST['txtEmail']."</td>\n</tr>\n";
		$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Address1</b></td> <td>:</td> <td>".$_REQUEST['address1']."</td>\n</tr>\n";
		//if($_REQUEST['address2']!="")
			//$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Address2</b></td> <td>:</td> <td>".$_REQUEST['address2']."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>City</b></td> <td>:</td> <td>".$_REQUEST['city']."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>State</b></td> <td>:</td> <td>".$_REQUEST['state']."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Country<sup></sup></b></td> <td>:</td> <td>".$_REQUEST['country']."</td>\n</tr>\n";
		if($_REQUEST['txtSuggestion']!="")
			$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td><b>Suggestion</b></td> <td>:</td> <td>".$_REQUEST['txtSuggestion']."</td>\n</tr>\n";
	//	$mailmsg .= "<tr bgColor='#FFFFFF'>\n<td colspan='3'><b>Enquiry</b><br>".$_REQUEST['txtSuggestion_desc']."</td>\n</tr>\n";
		echo $mailmsg .= "</table>";	
		
		$strFrom=$_REQUEST['txtEmail'];
		$strTo="support@thecreativeit.com.com";
		$strSubject = " Suggestions in Shaadi.com - World Number 1 Maa Shakti Marriage Bureau";		
		$strContent = $mailmsg;
		send_mail($strTo,$strFrom,$strSubject,$strContent);		
		$_SESSION["msg"]="Thank you for your Suggestion.";
		header("Location:thanks.php?id=23"); 
		die();
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/register.css" type="text/css" rel="stylesheet"/>
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

function fnValidate()
{
	if(isNull(document.thisForm.txtFName,"First Name")) { return false; }
	//if(isNull(document.thisForm.txtLName,"Last Name")) { return false; }	
	if(isNull(document.thisForm.txtEmail,"Email address")) { return false; }	
	if(notEmail(document.thisForm.txtEmail,"Email address")) { return false; }	
	if(isNull(document.thisForm.address1,"Address")) return false;
	if(isNull(document.thisForm.city,"City")) return false;
	if(isNull(document.thisForm.state,"State")) return false;
	if(isNull(document.thisForm.txtSuggestion,"Suggestion")) { return false; }	
}
//-->
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
			<div style="padding:12px 0px 0px 2px;  float:left;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<div class="titlebg">
					  <h1 class="title">Suggestion</h1>
					</div>
				</td>
				<td align="right" style="padding-right:95px;">
				 <? if ($config[userinfo]) { ?>					
				<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
				<? } else { ?>						
					<a href="index.php" class="lout">Home</a></strong>&nbsp; |&nbsp; <a href="member_login.php?mode=member" class="idclr">Login</a>
				<? } ?>			
				</td>
			  </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			  <tr>
					    <td width="592" colspan="2" valign="top" class="regmidbg">
							<table width="90%" cellpadding="0" border="0"  cellspacing="0" class="reghtop"> 
							<tr>
								<td colspan="3" align="center" class="reghbtm">
							<form name="thisForm" method="post" action="suggestion.php?mode=send" onsubmit="return fnValidate();">
								<table cellpadding="5" cellspacing="1" border="0" width="470"  align="right">
								<tr><td height="10"></td></tr>
								<tr><td align=left>First Name <font  color="#FF0000">*</font></td><td align=left><input type="text" name="txtFName" class="txtrbox" maxlength="255" ></td></tr>						
								<!--<tr><td align=left>Last Name <font  color="#FF0000">*</font></td><td align=left><input type="text" name="txtLName" class="txtrbox" maxlength="255" ></td></tr>-->						
								<tr><td align=left>Email Address <font  color="#FF0000">*</font></td><td align=left><input type="text" name="txtEmail" class="txtrbox" maxlength="255" ></td></tr>						
								<tr>
								<td align=left>Address 1 <font  color="#FF0000">*</font></td>
								<td align=left><input type=text size=25 maxlength=100 name="address1" class="txtrbox" ></td>
								</tr>
								<!--
								<tr> 
									<td align=left>Address 2</td>
									<td align=left ><input type=text  size=25 maxlength=100 class="txtrbox" name="address2">
									</td>
								</tr>-->
								<tr>
									<td align=left>City <font  color="#FF0000">*</font></td>
									<td align=left><input type=text size=25 maxlength=40 name="city" class="txtrbox" ></td>
								</tr>
								<tr>
									<td align=left>State<font  color="#FF0000"> *</font></td>
									<td align=left>
										<input type=text size=25 maxlength=40 name="state" class="txtrbox" >
									</td>
								</tr> 
								<tr>
									<td align=left >Country<font  color="#FF0000"> *</font></td>
									<td align=left>
									<select name="country" class="cmbrbox">
									<script language="javascript">
									GetCountry('India','India');
									</script>
									
									</select></td></tr>
									<tr>
									  <td align=left valign="top"> Suggestion<font  color="#FF0000"> *</font></td>
									  <td align=left><textarea name="txtSuggestion" style="height:70px;width:160px;" maxlength="255"></textarea></td></tr>						
									
								<!--	<tr>
									  <td valign="top" align=left> Enquiry<font  color="#FF0000">*</font></td>
									  <td align=left><textarea name="txtSuggestion_desc" style="height:150px;width:300px;" maxlength="255"></textarea></td></tr>						-->
									<tr><td colspan="2" align="left">
									<div style="padding-left:240px;"><input type="submit" class="button" value="Submit" align="middle" /></div>
									<div style="padding-left:2px;"><font  color="#FF0000">*</font> Denotes Required Field</sup></div>
									</td></tr>
								</table>
							</form>
							</td></tr></table>
					 </td>
					</form>
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
