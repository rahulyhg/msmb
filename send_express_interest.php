<?php
ob_start();
session_start();
include("includes/lib.php");

$action = GetVar("action");
$message = GetSingleRecord("tbl_express_interest_message","id",1);

$_POST['recipient'] = GetVar("id");
$send_name = $config[userinfo][name];

$_POST['sender'] = $config[userinfo][id];
$TodayDateTime = date("Y-m-d G:i:s");
$_POST['dateSent'] = $TodayDateTime;
$_POST['message'] = $message[message];

if ($config[userinfo][id]) {

	if ($action == "sendInterest") {
			
		if (GetVar("id") == $_SESSION['id_user']) {
			$_SESSION['msg'] = "Sorry You cann't send interest yourself";
			header("Location: error.php?id=18");
			die();
		} else {		
			$res = Execute("select * from tbl_express_interest where sender = '" . $_SESSION['id_user'] ."' and recipient = '" . GetVar("id") . "' order by dateSent desc");			
			if (mysql_num_rows($res) > 0) {
			
				//$exp_int_message = mysql_fetch_array($res);
				//if ($exp_int_message[accept] == 0) {
					$_SESSION['msg'] = 'Your interest already sent to this user. Your interest was waiting for feedback.';
					header("Location: error.php?id=19");
					die();	
				//} else {
				//	$sql = DTMLCreateRecord("tbl_express_interest",$_POST);	
				//}
			} else {
			
				$res1 = Execute("select * from tbl_express_interest where recipient = '" . $_SESSION['id_user'] ."' and sender = '" . GetVar("id") . "' order by dateSent desc");			
				if (mysql_num_rows($res1) > 0) {
					$_SESSION['msg'] = 'You have already received interest from this user. Please check received items.';
					header("Location: error.php?id=20");
					die();	
				} else {
					$sql = DTMLCreateRecord("tbl_express_interest",$_POST);
					$res = Execute($sql);
					$_SESSION['msg'] = 'Your interest sent successfully.';
					
					echo $select_usr="select username,name,mobileNumber from tbl_register where id='".GetVar("id")."'";
$result_usr=mysql_query($select_usr,$link);
if($val=mysql_fetch_array($result_usr)){
 $h_username=$val[0];
$h_name=$val[1];
$h_mobile=$val[2];
					
	$sms_subject=$h_mobile;			
if($sms_subject!=""){		
$headers1 = "From: sms@thecreativeit.com.com\n";
$sms_email1="sms@thecreativeit.com.com";
$sms_message1="Your recieved a interest from ".$send_name;
$mail_sms1=@mail($sms_email1,$sms_subject,$sms_message1,$headers1);
}
}
					
					
					header("Location: thanks.php?id=21");
					die();
				}					
			}			
		}		
	} else { ?>		

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
		<td valign="top">
			<? include("includes/side_menu.php");?>
		</td>
		<td valign="top">
			<div style="padding:10px 6px 0px 0px; width:573px; float:right;" >
			<table width="300" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td valign="top">
					<div class="titlebg"><h1 class="title">Express Interest</h1></div>
				</td>
			  </tr>
			  <tr>
				<td>
					<table width="100%" border="0" cellspacing="2" cellpadding="4" style="border:#8f830d solid 1px; margin-top:5px;">
					 <tr><td>
					 	<div style="float:left; padding:10px 0px 0px 10px;">						
							<form name="thisForm" action="send_express_interest.php" method="post">	
								<input type="hidden" name="action" value="sendInterest" />
								<input type="hidden" name="id" value="<?=GetVar("id")?>" />
								<table width="500" border="0" align="center" cellspacing="0" cellpadding="0" class="probg">
									<tr><td class="probdr">&nbsp;</td></tr>
									<tr><td class="probdr">
											<table>
												<tr>
													<td colspan="2">Message:<br><br>"<?=$message[message]?>"</td>
												</tr>
												<tr>
													<td colspan="2" align="center"><input type="submit" class="button" value="Continue"/>&nbsp;&nbsp;<input type="button" class="button" value="Cancel" onclick="javascript:history.back();"/></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</form>	
							</div>
					 </td></tr>
				  </table>

				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
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
<?	}
} else {
	//$_SESSION['msg'] = "Please login to send express interest.  <a href='member_login.php'>Click here</a> to login";
	//header("Location: error.php?id=28");
	header("Location: member_login.php?action=send&id=".GetVar("id")."&link1=express_interest");
	die();
}
?>