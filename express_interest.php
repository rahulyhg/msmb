<?php
ob_start();
session_start();
include("includes/lib.php");
isMember();

$action = GetVar("action");
$action1 = GetVar("action1");
$mode = GetVar("mode");
$TodayDateTime = date("Y-m-d G:i:s");
$user = GetSingleRecord("tbl_register","username",$_SESSION['userid']);	
$iResultsLimit = GetVar("iResultsLimit");

if ($action == "received") {
	if ($mode == "accept") {
		$res = Execute("update tbl_express_interest set accept = 1, dateAccept = '$TodayDateTime' where sender = '" . GetVar("mem_id") . "' and recipient = '" . $user[id] . "'");
		$_SESSION['msg'] = "Interest Accepted Successfully";
		
		$sender_id=GetVar("mem_id");
	
	$select_sender_info="select email,mobileNumber from tbl_register where id='$sender_id'";
	$result_sender_info=mysql_query($select_sender_info,$link);
	if($send_inf=mysql_fetch_array($result_sender_info)){
	$send_email=$send_inf[0];
	$send_mobile=$send_inf[1];
	}
	
		$sms_subject=$send_mobile;			
	if($sms_subject!=""){		
$headers1 = "From: sms@thecreativeit.com.com\n";
$sms_email1="sms@thecreativeit.com.com";
 $sms_message1="Mr/Miss ".$user[name]." has Accept your Expressed Interest";
 $sms_email2="cretivedesignforyou@gmail.com";
 $mail_sms1=@mail($sms_email1,$sms_subject,$sms_message1,$headers1);
$mail_sms1=@mail($sms_email2,$sms_subject,$sms_message1,$headers1);
}		
		
		
		
		header("Location: thanks.php?id=8");
		die();
	} else if ($mode == "reject") {
		$res = Execute("update tbl_express_interest set reject = 1, dateReject = '$TodayDateTime' where sender = '" . GetVar("mem_id") . "' and recipient = '" . $user[id] . "'");
		
		
		$sender_id=GetVar("mem_id");
	
	$select_sender_info="select email,mobileNumber from tbl_register where id='$sender_id'";
	$result_sender_info=mysql_query($select_sender_info,$link);
	if($send_inf=mysql_fetch_array($result_sender_info)){
	$send_email=$send_inf[0];
	$send_mobile=$send_inf[1];
	}
	
		$sms_subject=$send_mobile;			
	if($sms_subject!=""){		
$headers1 = "From: sms@thecreativeit.com.com\n";
$sms_email1="sms@thecreativeit.com.com";
$sms_email2="cretivedesignforyou@gmail.com";
 $sms_message1="Mr/Miss ".$user[name]." has Denied your Expressed Interest";
$mail_sms1=@mail($sms_email1,$sms_subject,$sms_message1,$headers1);
$mail_sms1=@mail($sms_email2,$sms_subject,$sms_message1,$headers1);
}		
		
		$_SESSION['msg'] = "Interest Rejected Successfully";
		header("Location: thanks.php?id=9");
		die();
	}
	if ($action1 == 2) {
		$sql = "select * from tbl_express_interest where recipient = '" . $user[id] . "' and accept = 1 ";
	} else if ($action1 == 3) {	
	    $sql = "select * from tbl_express_interest where recipient = '" . $user[id] . "' and reject = 1 ";
	} else {
		$sql = "select * from tbl_express_interest where recipient = '" . $user[id] . "' and accept = 0 and reject = 0 ";
	}
} else {
		
	if ($action1 == 2) {
		$sql = "select * from tbl_express_interest where sender = '" . $user[id] . "' and accept = 1 ";
	} else if ($action1 == 3) {	
	    $sql = "select * from tbl_express_interest where sender = '" . $user[id] . "' and reject = 1 ";
	} else {
		$sql = "select * from tbl_express_interest where sender = '" . $user[id] . "' and accept = 0 and reject = 0 ";
	}
} 	
$searchMaxRows = Execute($sql);	


if(!is_numeric($iResultsLimit))
{
	$iResultsLimit = 25;
}
$iPageNum = GetVar("iPageNum");
if (!is_numeric($iPageNum)) {
	$iPageNum = 1;
}
$iResultsLower = 	(($iPageNum - 1) * ($iResultsLimit));
$searchMaxRows = Execute($sql);	

/* Sanitise results */

if ($iResultsLower < 0) {
	$iResultsLower = 0;
}

$sql .= "limit $iResultsLower , $iResultsLimit";
	
$searchRes = Execute($sql);	

if ($action == "received") {	
	
	$res_accept = Execute("select * from tbl_express_interest where recipient = '" . $user[id] . "' and accept = 1 ");
	$accept = mysql_num_rows($res_accept);
	
	$res_reject = Execute("select * from tbl_express_interest where recipient = '" . $user[id] . "' and reject = 1 ");
	$reject = mysql_num_rows($res_reject);
	
	$res_pending = Execute("select * from tbl_express_interest where recipient = '" . $user[id] . "' and accept = 0 and reject = 0 ");	
	$pending = mysql_num_rows($res_pending);
	
} else {

	$res_accept = Execute("select * from tbl_express_interest where sender = '" . $user[id] . "' and accept = 1 ");
	$accept = mysql_num_rows($res_accept);
	
	$res_reject = Execute("select * from tbl_express_interest where sender = '" . $user[id] . "' and reject = 1 ");
	$reject = mysql_num_rows($res_reject);
	
	$res_pending = Execute("select * from tbl_express_interest where sender = '" . $user[id] . "' and accept = 0 and reject = 0 ");	
	$pending = mysql_num_rows($res_pending);
}	

if (!$pending) { $pending = 0; }
if (!$accept) { $accept = 0; }
if (!$reject) { $reject = 0; }

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" rel="stylesheet" type="text/css"/>
<link href="includes/search.css" type="text/css" rel="stylesheet"/>
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

function paging(i) {
	document.thisForm1.iPageNum.value=i;							
	//document.forms.formSearchWithLimits.action="\search.html?iPageNum="+i;
	document.thisForm1.submit();
}

//-->
</script>

</head>
<body class="homeinbody" onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
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
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td valign="top">
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:12px 0px 0px 1px;  float:left;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<div class="titlebg">
					  <h1 class="title">Express Interest</h1>
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
				<td colspan="2">&nbsp;</td>
			  </tr>
			  <tr>					
					<td width="592" rowspan="4" valign="top" colspan="2">
						<div style="float:left; padding:12px 0px 0px 0px;">
						<table border="0" width="100%" align="center" cellspacing="1" style="border:1px #999999 solid;" cellpadding="0" bgcolor="#f0edd4">
							<tr >
								<td>
									<div style="float:left;">
									<table border="0" width="100%" cellpadding="5" cellspacing="5" bgcolor="#fffdeb">
										
									<? if ($action == "received") { ?>	
										<tr>
											<td class="tbl_title"><b>This folder displays the interests you've received from members.</b></td>
										</tr>
										<tr>
											<ul class="exp">
												<li><font color="#ae1213" style="padding-left:5px">Pending :</font> This folder displays the interests you've received but haven't accepted or declined.</li>
												<li><font color="#ae1213" style="padding-left:5px">Accepted :</font> This folder displays the interests you've received and have accepted.</li>
												<li><font color="#ae1213" style="padding-left:5px">Declined :</font> This folder displays the interests you've received and have declined.</li>
											</ul>
										</tr>
									<? } else { ?>	
										<tr>
											<td class="tbl_title"><b>This folder displays the interests you've sent to other members.</b></td>
										</tr>
										<tr>
											<ul class="exp">
												<li><font color="#ae1213" style="padding-left:5px">Pending :</font>This folder displays the interests sent by you, but which the member haven't accepted or declined.</li>
												<li><font color="#ae1213" style="padding-left:5px">Accepted :</font>  This folder displays the mails sent by you, which the members have Accepted.</li>
												<li><font color="#ae1213" style="padding-left:5px">Declined :</font> This folder displays the mails sent by you, which the members have declined.</li>
											</ul>
										</tr>
									<? } ?>
									</table>
									</div>
								</td>
							 </tr>
						  </table>
						  </div>
						  <div style="float:right; padding:10px 0px 0px 10px;">
							<table >
								<tr>
									<td><a href="express_interest.php?action=<?=$action?>&action1=1" class="more">Pending(<?=$pending?>)</a>&nbsp;&nbsp;</td>
									<td><a href="express_interest.php?action=<?=$action?>&action1=2" class="more">Accept(<?=$accept?>)</a>&nbsp;&nbsp;</td>
									<td><a href="express_interest.php?action=<?=$action?>&action1=3" class="more">Reject(<?=$reject?>)</a></td>
								</tr>
							</table>
							</div>
					</td>
			  </tr>				
						  <? $iTotalRows = mysql_num_rows($searchMaxRows); ?>
								<form name="thisForm1" method="get">	
								<table border="0" width="90%" align="left" cellspacing="1" cellpadding="0">	
								<form name="thisForm1" method="get">	
									<?
										foreach($_REQUEST as $post_key=>$post_value) {
											if($post_key !== "iPageNum" && $post_key !== "iResultsLimit") {
												print "<input type=\"hidden\" name=\"" . $post_key . "\" value=\"" . $post_value . "\" />" . "\r\n";
											}
										}
									?>
								<input type="hidden" name="iPageNum" value="<?=$iPageNum?>">
									<input type="hidden" name="iResultsLimit" value="<?=$iResultsLimit?>">
									</form>
								<?
								if ($iTotalRows) {
							?>	
							
							  <tr>
								<td style="padding-top:5px;" colspan="2" >
									<table width="560" border="0" cellspacing="0" align="center" cellpadding="0" class="sbar">
									  <tr>
										<td width="4"><img src="images/cruv_left.gif" border="0"/></td>
										<td width="28"><img src="images/search_icon_compar.gif"  onclick="fnCompare();"  style="cursor:pointer" title="Compare Profile" border="0"/></td>
										<td width="105"><a style="cursor:pointer" onclick="fnCompare()">Compare Profile</a></td>						
										<td width="28"><a onclick="fnBookmark()" style="cursor:pointer" class="mored"><img src="images/search_icon_book.gif" title="Book Mark" border="0"/></a></td>						
										<td width="66"><a onclick="fnBookmark()" style="cursor:pointer" class="orng1">Book Mark</a></td>	
										<td width="28"><img src="images/search_icon_forword.gif"  onclick="fnForward1();" style="cursor:pointer"  title="Forword Profile" border="0"/></td>					
										<td width="93"><a  onclick="fnForward1();" style="cursor:pointer" >Forward  Profile</a></td>						
										<td width="100">
										<?  if ($action == "search") {
												echo "Page";
												echo  do_pages($iTotalRows, $iResultsLimit);
											}
										?>
										</td>						
										<!--<td width="8" align="right"><img src="images/cruv_right.gif" border="0"/></td>-->
										<td width="8" align="right"><img src="images/cruv_right.gif" border="0"/></td>
									  </tr>
									</table>
								</td>
							  </tr>
							  <?
								}
							?>
				
							   <tr>
								<td style="padding-top:5px;">
								 <form name="proForm" method="post" action="forward_profile.php">	
									<input type="hidden" name="mode">		  
																
								<?
												
										$k = 1;
										if ($iTotalRows > 0) {										
										
											include("includes/express_interest_view.php");									
											
										} else { ?>
											<div style="float:left; padding:10px 0px 0px 10px;">
											<table border="0" width="100%" align="center" cellspacing="0" cellpadding="0" bgcolor="#c0ba84">
												<tr bgcolor="#FFFFFF"><td>&nbsp;</td></tr>
												<tr bgcolor="#FFFFFF">
													<td align="center">No Records found.</td>
												</tr>
											</table>
											</div>
									<?	}	?>																
							  </form>
							  
							  </td>
							  </tr>	
						</table>							
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
