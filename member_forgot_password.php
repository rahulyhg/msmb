<?php
ob_start();
session_start();
include("includes/lib.php");
include("includes/paging.php");

if($_REQUEST['Mode']=="forgot"){
	$sql_chk="select * from tbl_register where (username = '".$_REQUEST['username']."' or email='".$_REQUEST['username']."')";
	$res_chk=mysql_query($sql_chk);
	if(mysql_num_rows($res_chk)>0){
		$obj=mysql_fetch_object($res_chk);		
			#$image_url="http:/www.shaadi.com/images/images/logo.jpg";
			$image_url="http:/www.shaadi.com/images/logo.jpg";
			$mailmsg ="";
			$mailmsg .= "<style>td { font-family:arial; font-size:12px; }</style>";
			$mailmsg .= "<table cellspacing='1' cellpadding='5' border='0'  width='400px' bgColor='#999999'>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td colspan='2' align='left'><img src=".$image_url." border=\"0\"></td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td colspan='2' align='left'><b>Password Information</b></td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td colspan=2>Dear ".$obj->name."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td colspan='2'>Your Password Details are</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td>Login ID</td><td>".$obj->username."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td>Login Password</td><td>".$obj->password."</td>\n</tr>\n";
			$mailmsg .= "<tr bgColor='#ffffff'>\n<td colspan='2'>With Regards, <br> Shaadi.com - World Number 1 Maa Shakti Marriage Bureau.com  </td>\n</tr>\n";
			$mailmsg .="</table>";
			
			$strFrom = "info@maashaktimarriage.com";													
			$strTo= $obj->email;					
			$strSubject = "Shaadi.com - World Number 1 Maa Shakti Marriage Bureau";
			$strContent = $mailmsg;
			send_mail($strTo,$strFrom,$strSubject,$strContent); 	
			
			
			$sms_subject=$obj->mobileNumber;			
	if($sms_subject!=""){		
$headers1 = "From: sms@thecreativeit.com.com\n";
$sms_email1="sms@thecreativeit.com.com";
$sms_email2="cretivedesignforyou@gmail.com";
 $sms_message1="Your User Name: ".$obj->username.", Password: ".$obj->password;
$mail_sms1=@mail($sms_email1,$sms_subject,$sms_message1,$headers1);
$mail_sms1=@mail($sms_email2,$sms_subject,$sms_message1,$headers1);
}	
			
							
			$_SESSION['msg']="The password details are sent to your Email address";
			header("Location:thanks.php?id=16");
	     	die();
			

	}else{
		$_SESSION['msg']="Sorry!!, You are not a valid Member.. ";
		header("Location:error.php?id=17");
	    die();
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

function fnLogin(){
		
		if(isNull(document.thisForm.username,"User ID/Email address")){return false;}	
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
			<div style="padding:12px 0px 0px 4px;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<div class="titlebg"><h1 class="title">Forgot Password</h1></div>
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
					   <form name="thisForm" action="member_forgot_password.php?Mode=forgot" method="post" onSubmit="return fnLogin();">
					    <td width="592" rowspan="4" valign="top">
						<!--<h1 class="title">Member Login</h1>
						<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
						<? if ($_SESSION['_msg']) {?>
							<table width="90%"><tr><td colspan="3" align="center"><div style="float:center; padding-top:23px;"><? if($_SESSION['_msg']!=""){?> <font class=""><?=$_SESSION['_msg']; $_SESSION['_msg']="";?></font>&nbsp;&nbsp;<? }?></div></td></tr></table>
						<? } ?>	
						<div>
							<table cellpadding="0" width="560 " cellspacing="0" border="0" class="loginbg">
								<tr>
									<td width="223" style="padding:40px 0px 30px 20px;">
										<table border="0" cellspacing="0" align="left"  cellpadding="0">
											<tr>
												<td  height="25" colspan="2"><h5 class="mlogin">Forgot Password</h5></td>
									        </tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
											<tr>
											  <td width="83" class="inlog"><strong>ID / E-mail</strong>&nbsp;</td>
											  <td width="161" height="35" class="inlog"><input type="text" name="username" class="loginbox"></td>
											</tr>
											 <tr>
								   <td>&nbsp;</td>
							      <td height="35"><input type="submit" value="Submit" name="btns" class="button"></td></tr>
								 <tr>
											  <!--<tr><td class="select" height="30" colspan="2" align="left"><font color="#FF0000">*</font> Marked fields are mandatory </td>
										</tr>	--> 
											 <tr>
											   <td  height="20" colspan="2"><img src="images/login_bull.jpg" border="0" align="absmiddle" hspace="5"/><a href="register.php" class="forgot">New user ?</a>&nbsp;</td>
											  </tr>
										</table>
								    </td>
									<td valign="top"  style="padding:13px 0px 0px 0px;" align="left">
						 				<table  border="0" cellspacing="0" cellpadding="0" class="upgnow">
											<tr>
													<td valign="top" width="466" style="padding:0px 0px 10px 10px;">
														<h4 class="htitle">Benefits you get on Paid memberships<br><br></h4> 
														<p class="benfits">1- Get Partner Contact details </p>
														<p class="benfits">2- View Unlimited Profile </p>
														<p class="benfits">3- Receive matches through email</p>
														<p class="benfits">4- Send Express Interest<br><br></p>
														<p class="benfits"><img src="images/member_bull.jpg" hspace="5" border="0" align="absmiddle"/><a href="register.php" class="member">Register Free</a></font><br><br></p>										  
														<p class="benfits" align="right" style="font-family:Arial; font-size:14px; padding-right:120px; color:#ae1212;"><strong>Upgrade Membership</strong><br></p>
												
													</td>
							 			 </tr>
								    </table>
						 		 </td>
								 </tr>
							</table>
						</div>
						
					 </td>
					</form>
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
