<?php
session_start();
include("includes/lib.php");
$action = GetVar("action");
$id = GetVar("id");
$mode = GetVar("mode");

if (!$id && $_REQUEST['chkPro']) {
	$id = implode(",",$_REQUEST['chkPro']);
}

if ($mode == 'compare') {

	include("compare_profile.php");	
	
} else {

	if ($mode == 'bookmark' && $id) {	
		if ($config[userinfo][id]) {
			$user_ids = explode(",",$id);			
			for ($i = 0; $i < count($user_ids); $i++) {
				$res1 = Execute("select * from tbl_bookmark where userid = '" . $config[userinfo][id] . "' and bookmarked_id = '" . $user_ids[$i] . "'");
				if (mysql_num_rows($res1) == 0) {
					$res = Execute("insert into tbl_bookmark(userid,bookmarked_id,bookmarked_date) values('" . $config[userinfo][id] . "','" . $user_ids[$i] . "',NOW())");
				} else {
					$_SESSION['msg'] = "Selected profile(s) already in your bookmark list. <a href='view_bookmark.php'><b>Click here</b></a> to view book marked list..";
					header("Location: thanks.php?id=10");
					die();
				}	
			}
			$_SESSION['msg'] = "Selected list book marked successfully. <a href='view_bookmark.php'><b>Click here</b></a> to view book marked list.";
			header("Location: thanks.php?id=11");
			die();
		} else {
			//$_SESSION['msg'] = "Please <a href='member_login.php'><b>Click here</b></a> to Login/Register to book mark the profile(s).";
			//header("Location: error.php");
			//die();
			$_SESSION['_msg'] = 'Please login to book mark';
			header("Location: member_login.php?link1=bookmark&id=$id&mode=$mode&action=$action");
			die();			
		}		
	}
	
	# default message
	$defmsg = "Click here and you can add a short message which we will include when alerting your friends";
	
	if ($action == 'submit' && $mode == 'forward') {
	
		# send e-mail to friend
		
		if ($_REQUEST['sender'] && $_REQUEST['receipient']) {
		
			# remove message if it's not been changed from the default
			if ($_REQUEST["message"] == $defmsg) { unset($_REQUEST["message"]); }
			
			# split id if $id an array
			$ids = explode(",",$id);
			$profile = '<html>';
			$profile .= '<link href="'.$config["siteurl"].'/includes/style.css" rel="stylesheet" type="text/css"/>';
			$profile .= '<body>';
			$profile .= '<table width="100%"><tr><td>&nbsp;</td></tr>';			
			$profile .= '<tr><td>';
			$profile .= '<div tyle="float:left; padding:10px 0px 0px 10px;">
					  <table border="0" width="600" align="center" cellspacing="0" cellpadding="0" style=" border:#b54343 solid 1px;" class="story"><tr><td>MSG</td></tr></table>';
			for ($i = 0; $i < count($ids); $i++) {
						
				$profile .= GetForwardProfile($ids[$i]);
				$profile .= '<br><br>';	
			}
			$profile .= '</div>';
			$profile .= '</td></tr></table>';	
			$profile .= '</body></html>';
			
			$msg = 'Your friend ' . $_REQUEST['sender'] . ' has asked us to let you know about following profile(s) from shaadi';
			
			if ($_REQUEST['message']) {
				$msg .= '<br>Friend message: '. stripslashes($_REQUEST['message']);
			} else {
				$msg .= '<br>(Your friend did not write a personal message when sending this e-mail.)';
			}
					
			$body = str_replace("MSG",$msg,$profile);
					
			$subject = 'Your friend '. $_REQUEST['sender'] .' refers this profile from shaadi.com';
			send_mail($_REQUEST['receipient'],$config["admin_email"],$subject,$body);
			
			$_SESSION['msg'] = "Profile(s) sent successfully";
			
			header("Location: thanks.php?id=13");
			die();
		}
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
	<table width="100%" border="0"  cellspacing="0" cellpadding="0">
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
					  		<h1 class="title">Forward Profile</h1>
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
						<? if ($_SESSION['_msg']) {?>
							<table width="90%" cellpadding="0" cellspacing="0" border="0"><tr><td colspan="3" align="center"><div style="float:center; padding-top:20px;"><? if($_SESSION['_msg']!=""){?> <font class=""><?=$_SESSION['_msg']; $_SESSION['_msg']="";?></font>&nbsp;&nbsp;<? }?></div></td></tr></table>
						<? } ?>	
						<div style="float:left; padding:0px 0px 0px 10px;">						
						<form name="thisForm" action="forward_profile.php" method="post" onSubmit="return fnForward()">	
							<input type="hidden" name="action" value="submit" />
							<input type="hidden" name="id" value="<?=$id?>"	/>
							<input type="hidden" name="mode" value="<?=$mode?>" />					
						<table border="0" width="90%" align="center" cellspacing="0" cellpadding="0">
						 <tr bgcolor="#FFFFFF"><td>
							<table width="574" border="0"  cellspacing="0" cellpadding="0">
							
								<!--<tr><td height="25" colspan="3" lass="forward_topbg"><h1 class="title">Forward Profile(s) to Friend</h1></td></tr>		
								<tr><td class="probdr">&nbsp;</td></tr> -->
								<tr>
									<td>
										<table width="574" cellpadding="0" cellspacing="2" class="forwardbg">
											<tr><td align="center" colspan="2"><h1 class="title">Forward Profile(s) to Friend</h1></td></tr>
											<tr>
												<td width="33%" style="padding-left:10px;">Your name <font color="#CC0000">*</font></td>
											  <td width="67%"><input type="text" name="sender" class="txtbox"></td>
											</tr>
											
											<tr>
												<td width="33%" style="padding-left:10px;">Your email address <font color="#CC0000">*</font></td>
											  <td width="67%"><input type="text" name="senderemail" class="txtbox"></td>
											</tr>
											
											<tr>
												<td style="padding-left:10px;">Your friend's email address <font color="#CC0000">*</font></td>
												<td><input type="text" name="receipient" class="txtbox"></td>
											</tr>
											<tr>
												<td style="padding-left:10px;" valign="top">Your message</td>
												<td><textarea name="message" onClick="this.value='';" class="txtarea1" lass="txtcbomultiple"><?= $defmsg; ?></textarea></td>
											</tr>
											<tr>
												<td height="35" style="padding-left:10px;"></td>
												<td><input type="submit" class="button" value="Send"/></td>
											</tr>
											<tr>
												<td colspan="2" style="padding-left:10px;">Fields marked with <font color="#CC0000">*</font> are mandatory</td>
											</tr>	
															
																
										</table>
									</td>
								</tr>
							</table>
							</td></tr></table>
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
<? } ?>	