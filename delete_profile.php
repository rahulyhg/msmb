<?php
ob_start();
session_start();
include("includes/lib.php");
$mode = GetVar("mode");
$action = GetVar("action");
isMember();
$user = GetSingleRecord("tbl_register","username",$config[userinfo][username]);
if ($mode == 1) {
	$res = Execute("update tbl_register set hideProfile = '1' where id = '". $user['id'] ."'");
	$_SESSION['msg'] = "Profile hided successfully";
	header("Location:thanks.php?id=4");
	die();
}
if ($mode == "unhide") {
	$res = Execute("update tbl_register set hideProfile = '0' where id = '". $user['id'] ."'");
	$_SESSION['msg'] = "Profile unhided successfully";
	header("Location:thanks.php?id=32");
	die();
}
if ($action == "submit" && $mode == 2) {	
	
	# Set flag deleteprofile is to true. User can login.  The profile have basic information and 
	# other information also removed inlcuding (photo, and ect..).  Other users cann't see this profile until admin set to flag false.
	$res = Execute("update tbl_register set deleteProfile = '1', delete_reason = '" . $_REQUEST['reason'] . "', comments = '" . $_REQUEST['comments'] . "' where id = '". $user[id] ."'");	
		
	# send mail to admin
	$body  = "The below user was moved to delete the profile on ".strftime("%d/%m/%Y %H:%M",time())."<br><br>";		
	$body .= "User Id      :   " . $user[username] . "<br><br>";
	$body .= "Name      :   " . $user[name] . "<br><br>";
	$body .= "Email Address :   " . $user[email] . "<br><br>";		
	$body .= "Reason           :   " . $_REQUEST['reason']. "<br><br>"; 
	$body .= "Comments      :   " . $_REQUEST['comments'] . "<br><br>";
	$body .= "Please <a href='" . $config["siteurl"] . "view_member_profile.php?userid=" . $user[username] . "&mode1=" . $config["before_delete"] . "'>click here</a> to view and delete this profile";
	$body = str_replace("\'","'",$body); 
	mail($config[admin_email], "Profile deletion", $body, "From: " . $user[email] . "\r\n"."Reply-To: " . $user[email] . "\r\nContent-Type: text/html; charset=iso-8859-1\r\n");	
				
	session_destroy();	
	ob_start();
	session_start();
	$_SESSION['msg'] = "Profile deleted successfully";
	header("Location:thanks.php?id=5");
	die();
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
	
	function FunDel(f1) {	
		if (isNull(f1.reason,"reason")) { 		
			return false;
		} else {
			if (confirm("Are sure want to delete the profile"))	{
				return true;
			} else {
				return false;
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
			<div style="padding:12px 0px 0px 0px;  float:left;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
				  <tr>
						<td>
						<div class="titlebg">
						  <h1 class="title">Delete/Hide profile</h1>
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
				  <tr>
					<td colspan="2"&nbsp;</td>
				  </tr>
				  <tr>
							<td width="592" colspan="2" valign="top">
							<!--<h1 class="title">Member Login</h1>
							<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->						
							<div style="float:left; padding:10px 0px 0px 10px;">						
							<form name="thisForm" action="delete_profile.php?mode=2" method="post" onSubmit="return FunDel(this);">	
							<input type="hidden" name="action" class="proinbox" value="submit">				
							<table border="0" width="100%" align="center" cellspacing="1" cellpadding="0" bgcolor="#c0ba84">
							 <tr bgcolor="#fff9d4"><td>
								<table width="100%" border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="#fff9d4">
								<div style="position:absolute; padding-left:297px;"></div>
									<!--<tr><td height="25" colspan="3"><h1 class="title">Hide / Delete Profile</h1></td></tr> -->		
									<tr><td class="probdr">&nbsp;</td></tr>								
									<tr>
										<td style="padding-left:20px;"><b style="color:#dd1815;">Hide profile</b></td>
									</tr>
									<tr>
									<!--<div style="position:absolute; padding-left:354px;"><img src="images/eraser.gif"></div> -->
										<td width="400">
										<ul class="exp1">
											&nbsp;&nbsp;&nbsp;&nbsp;<li>Use this feature when you decided to stop looking temporarily<br> since
											you are busy, moving, in the middle of same big lifestyle changes and
											cannot spare time to look seriously.</li><br>
											&nbsp;&nbsp;&nbsp;&nbsp;<li>If you think you may have found someone but are not sure yet.
											  So you would like to stop looking till you are sure one way or
											  the other.</li><br>
											&nbsp;&nbsp;&nbsp;&nbsp;<li>When you hide your profile it will no longer be visible on Maa Shakti Marriage Bureau.
											The profile will not show up in search results and members who do try to access. 
											The profile will be told that the profile is temporarily unavailable.</li>											
											<p>&nbsp;&nbsp;&nbsp;&nbsp;You can 
										temporarily <a href="delete_profile.php?mode=1" class="faq_inner">hide your profile</a> 
										instead of deleting it.
										<?  if($user['hideProfile']!="0")
											{	?>
												&nbsp;&nbsp;To <a href="delete_profile.php?mode=unhide" class="faq_inner">unhide</a> your profile
										<?	}
										?>
										</p>
										</ul>
											
											<!--<p>You haven't found your life partner but may be want to come
										again later after a couple of months, then do not delete.  You can 
										temporarily <a href="delete_profile.php?mode=1">hide your profile</a> 
										instead of deleting it.  Because profile once deleted cannot be restored.
										If you want restore your profile, contact site admin with in 10 days after the deleting profile.-->
										</td>
									</tr>
									<tr>
										<td class="probdr"></td>
									</tr>
									<tr>
										<td style="padding-left:20px;"><b style="color:#dd1815;">Delete profile</b><br><br></td>
									</tr>
									<tr>
										<td class="probdr"></td>
									</tr>
									<?
										$membership = GetSingleRecord("tbl_packages","package_id",$user[membership_type]);
										$type = explode(" ",$membership[package_name]);										   
										$type = $type[0];	
										if ($user[membership_type] != 1) {									   		
									?>
									<tr>
										<td>
											<table width="400" border="0" align="center" cellspacing="5" cellpadding="0" bgcolor="#fff4cd" style="border:solid 1px #948036;">
												<tr>
													<td>												
													Note :  You are about to delete your <?=$type?> membership profile.  Please note that your
													membership fee will not be refunded and your payment will not be transferred to another profile.
													</td>
												</tr>											
											</table>
										</td>
									</tr>			
									<? } ?>
									<tr>
										<td class="probdr"></td>
									</tr>																									
									<tr>
										<td style="padding-left:20px;"><br><b style="color:#dd1815;">Still you want to delete and close your profile?</b><br><br></td>
									</tr>
									<tr><div style="position:absolute; padding-left:391px;"><img src="images/eraser.gif"></div> 
										<td></td>
									</tr>
									<tr>
										<td>
											<table>
											
												<tr>
													<td style="padding-left:20px;"><b>Select reason</b></td>
													<td style="padding-left:20px;">
													<select name="reason" class="cmbbox1" style="width:270px;">
														<option value="">--Select Reason--</option>
														<option value="Marraige fixed through shaadi">Marraige fixed through shaadi</option>
														<option value="Marraige fixed through other Matrimony sites">Marraige fixed through other Matrimony sites</option>
														<option value="Marraige fixed through other medium/sources">Marraige fixed through other medium/sources</option>
														<option value="Precently no: Interested in marriage">Precently no: Interested in marriage</option>
														<option value="Personal reasons">Personal reasons</option>
														<option value="Not getting response">Not getting response</option>
														<option value="Duplicate Profile">Duplicate Profile</option>
														<option value="Other reason">Other reason</option>
													</select>
													</td><td>&nbsp;</td>
													
												</tr>
												<tr><td>&nbsp;</td></tr>
												
												<tr>
													<td style="padding-left:20px;"><b>Comments</b></td>
													<td style="padding-left:20px;">
													<textarea name="comments" class="txtareabig"></textarea>	
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
												
													<td colspan="2" align="center" style="padding-left:32px;"><input type="submit" value="Delete Now" class="button_large">
													&nbsp;&nbsp;<input type="button" value="Later" class="button" onClick="javascript: location.href='my_matrimony.php'"></td>
												</tr>
											</table>
										</td>
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