<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
$id = GetVar("id");
$mode = GetVar("mode");



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

function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else
cntfield.value = maxlimit - field.value.length;
}

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
	
	function fnForward() {
	  f1 = document.thisForm;
	  if (isNull(f1.sender,"your name")) { return false; }
	  if (isNull(f1.senderemail,"your email address")) { return false; }
	  if (isNull(f1.receipient,"friend's email address")) { return false; }
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
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td>
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:12px 0px 0px 8px; float:left;" >
			<table width="500" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td>
				  <table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
					  <td>
						<div class="titlebg">
					  		<h1 class="title">Personal Message</h1>
						</div>
						</td>
						<td align="right" class="title">					
						  <? if ($config[userinfo]) { ?>					
						<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
						<? } else { ?>						
							<a href="index.php" class="lout">Home</a></strong>&nbsp; |&nbsp; <a href="member_login.php?mode=member" class="idclr">Login</a>
						<? } ?>						
						</td>
					 </tr>
				   </table>
				  </td> 	 					
			  	</tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
					    <td width="592" rowspan="4" valign="top">
						<!--<h1 class="title">Member Login</h1>
						<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
						<div style="float:left; padding:0px 0px 0px 10px;">						
						<form name="thisForm" method="post">
						  <table border="0" width="77%" align="center" cellspacing="0" cellpadding="0" bgcolor="#fff6bd" style="border:solid 1px #948036;">
						  <!--DWLayoutTable-->
						 <tr bgcolor="#FFFFFF"><td width="1" height="3"></td>
						   <td width="61"></td>
						   <td width="87"></td>
						   <td width="79"></td>
						   <td width="84"></td>
						   <td width="26"></td>
						   <td width="6"></td>
						 </tr>
						 <tr bgcolor="#FFFFFF">
						   <td height="27"></td>
						   <td colspan="5" align="left" valign="top"><h1 align="left" class="title">Personal Message</h1></td>
								  <td></td>
					      </tr>
						 <tr bgcolor="#FFFFFF">
						   <td height="21"></td>
						   <td>&nbsp;</td>
						   <td>&nbsp;</td>
						   <td>&nbsp;</td>
						   <td>&nbsp;</td>
						   <td>&nbsp;</td>
						   <td></td>
					      </tr>
						 <tr bgcolor="#FFFFFF">
						   <td height="150"></td>
						   <td>&nbsp;</td>
						   <td colspan="3" valign="top"><textarea name="personal_message" cols="45" rows="5" class="textarea" id="textarea" onKeyDown="textCounter(document.thisForm.personal_message,document.thisForm.remLen1,150)"
onKeyUp="textCounter(document.thisForm.personal_message,document.thisForm.remLen1,150)"></textarea><input readonly type="text" name="remLen1" size="3" maxlength="3" value="150" class="Sms_Count"  /></td>
						   <td>&nbsp;</td>
						   <td></td>
						   </tr>
						 
						 
						 
						 
						 
						 
						 <tr bgcolor="#FFFFFF">
						   <td height="16"></td>
						   <td></td>
						   <td></td>
						   <td></td>
						   <td></td>
						   <td></td>
						   <td></td>
						 </tr>
						 <tr bgcolor="#FFFFFF">
						   <td height="24"></td>
						   <td></td>
						   <td></td>
						   <td valign="top"><input name="submit" type="submit" class="button" id="button" value="Submit"></td>
						   <td></td>
						   <td></td>
						   <td></td>
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
<? //} 

if($_POST['submit']){
echo $pm=$_POST['personal_message'];
$select_info="select name,mobileNumber from tbl_register where id='$id'";
$result_info=mysql_query($select_info,$link);
if($info=mysql_fetch_array($result_info)){
$inf_name=$info[0];
$inf_mobile=$info[1];
}

echo $sms_subject=$inf_mobile;			
if($sms_subject!=""){		
$headers1 = "From: sms@thecreativeit.com.com\n";
$sms_email1="sms@thecreativeit.com.com";
$sms_email2="cretivedesignforyou@gmail.com";
$sms_message1=$pm;
$mail_sms1=@mail($sms_email1,$sms_subject,$sms_message1,$headers1);
$mail_sms1=@mail($sms_email2,$sms_subject,$sms_message1,$headers1);
header("Location:thanks.php?id=1000");
}	
}


?>	