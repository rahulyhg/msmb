<?php
ob_start();
session_start();
include("includes/lib.php");

$action = GetVar("action");
$action1 = GetVar("action1");
	
if ($action == "physical") {

	//$_SESSION['id'] = GetSingleField("id","tbl_register","username",$_SESSION['userid']);
	$sql = DTMLUpdateRecord($_SESSION['regid'],"tbl_register",$_POST);		 
	$res = Execute($sql);
	echo mysql_error();
	//die();
	//$_SESSION['msg'] = "Congratulations! Your are now a <b>FREE member</b> of Newinidiamatrimony.com";
	//$_SESSION['msg'].= "&nbsp;Please note your Matrimony <b style='color:#e11612;'>ID: ".$_SESSION['regname']."</b>. And password will be the same as you entered. &nbsp;&nbsp;&nbsp; <br>";
	//$_SESSION['msg'].= "Your profile will activated, once the Administrator will Review / Approve your profile. <br>";				
	$_SESSION['msg'] = "Congratulations!<br> Your are now a Free member.<br> Your ID is : ".$_SESSION['msg'].= $_SESSION['regname']."<br>";	
	$_SESSION['msg'].= "Your profile will activated by Administrator.<br>";	
	
	$_SESSION['userid'] = $_SESSION['regname'];
	$_SESSION['member_name'] = $_SESSION['name'];
	$_SESSION['id_user'] = $_SESSION['regid'];	
	
	$select_usr="select username,name,mobileNumber from tbl_register where username='".$_SESSION['userid']."'";
$result_usr=mysql_query($select_usr,$link);
if($val=mysql_fetch_array($result_usr)){
 $h_username=$val[0];
$h_name=$val[1];
$h_mobile=$val[2];
					
	$sms_subject=$h_mobile;			
if($sms_subject!=""){		
$headers1 = "From: sms@thecreativeit.com.com\n";
$sms_email1="sms@thecreativeit.com.com";
$sms_message1="Thanks for your registration on shaadi.";
$mail_sms1=@mail($sms_email1,$sms_subject,$sms_message1,$headers1);
}			
		
	header("Location: thanks.php?id=30");
	die();
}
	
if ($action1 == "occupation") {	

	$user = GetSingleRecord("tbl_register","username",$_SESSION['userid']);
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

//-->
</script>
</head>
<body class="homeinbody" nLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
<div class="menuleftimg">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
    <td align="right"><img src="images/top_banner.jpg"/></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>  
  <tr>
    <td colspan="2" valign="top">
		<div style="padding-top:20px;  float:left;">
		<table width="268" height="440"  border="0" cellspacing="0" cellpadding="0" >
			<tr>
				<td valign="top" class="benefit" height="183">
					<ul class="benefits">
						<li>1- View Unlimited Profiles (Free)</li> 
						<li>2- Receive matches through email</li>
						<li>3- Send Express Interest</li>
						<li>4- Upload photo(s)</li>						
					</ul>
			</tr>
			<tr><td height="5"></td></tr>
		<tr><td><img src="images/add_left.jpg" border="0" width="268" /></td></tr>
		</table>
		</div>
		<form name="thisForm" method="post" onSubmit="return fnRegister3();">
			<input type="hidden" name="action" value="physical">
			<? include("common/physicaldetails.php"); ?>	
		</form>	
	</td>
 </tr>
 <tr>
  <td colspan="2">
  	<? 
		  		include("includes/fotter.php") ?>
  </td>
  </tr>
</table>
</div>
</body>
</html>
<?
}}
?>
