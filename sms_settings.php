<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
$mode = GetVar("mode");
isMember();

$uusr=$config[userinfo][username];

if($_GET['sts']!=""){

$status=$_GET['sts'];
if($status=="1"){
$new_sts="0";
}
else{
$new_sts="1";
}
$s=rand();
echo $update_sts="update tbl_register set sms_alert='$new_sts' where username='$uusr'";
$result_upd=Execute($update_sts);
header("Location:sms_settings.php?$s");



}
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
    <td align="right"><? fnBannerImage('  ','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>  
  <tr>
    <td colspan="2" valign="top">
	<table width="780" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td valign="top">
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:12px 0px 0px 0px;  float:left;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td valign="top">
					<table width="100%" cellpadding="0" cellspacing="0" align="left" border="0">
						<tr>
							<td>
								<table width="100%" border="0">
									<tr>
										<td>
										<div class="titlebg">
										  <h1 class="title">SMS Settings</h1>
										</div>
										</td>
										<td align="right" class="title" <? if ($action != 'profile_search') { ?> style="padding-right:85px;" <? } ?>>					
										<? if ($config[userinfo]) { ?>					
										<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
										<? } ?>					
										</td>
									</tr>
								</table>		
							</td>							
						</tr>						
					</table>			
				</td>				
			  </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			  <? 
				if ($action == "profile_search") { ?>
			  <tr>
				<td colspan="2">
				<div style="float:left; padding:10px 0px 0px 10px;">					
				
				<?		if ($mode == 1) {
							echo '<h1 lass="title">Here\'s the list of Viewed Profiles (Address)</h1>';
						} else {
							echo '<h1 lass="title">Here\'s the list of Viewed Profiles (Phone Number)</h1>';
						}
				?>						 
				</div>	
				</td>
			  </tr>
			  <? } ?>			 			  
			  
			  <tr>
					<td colspan="2" valign="top">
					<!--<h1 class="title">Member Login</h1>
					<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
					<div style="float:left; padding:10px 0px 0px 10px;">
					<table border="0" width="100%" align="center" cellspacing="0" cellpadding="0" class="regall">						  
					 <? if ($action != 'profile_search') { ?>
					  <tr>
						<td valign="top">
							<table border="0" width="100%" cellpadding="4" cellspacing="1" class="reghbtm">
							  <!--DWLayoutTable-->																			
								<tr>
									<td height="46" colspan="2" ><h4 class="rtitle" style="padding:20px 0px 0px 35px;">SMS Status</h4></td>
									<td colspan="2"><h4 class="rtitle" style="padding:20px 0px 0px 0px;">
									
									
									
									<? $alert=$config[userinfo][sms_alert];
									
									if($alert=="1"){
									echo "Disable";
									$ch_sts="Enable";
									}
									else{
									echo "Enable";
									$ch_sts="Disable";
									}
                                    
                                    if($alert=="1"){
									$alt=1;;
									}
									else{
									$alt=0;
									}
									?>
                               
                                   
                                    
                                    
                                    </h4>                                    </td>
								</tr>
								 <tr>
									<td width="18" height="23">&nbsp;</td>
									<td width="170">&nbsp;</td>
									<td width="8">&nbsp;</td>
				                    <td width="330">&nbsp;</td>
								 </tr>
								 <tr>
								   <td height="26">&nbsp;</td>
								   <td colspan="2" valign="top"><a href="sms_settings.php?sts=<?=$alt?>">Click Here To <?=$ch_sts?>
								   </a></td>
									<td>&nbsp;</td>
						      </tr>
								 <tr>
								   <td height="167">&nbsp;</td>
								   <td>&nbsp;</td>
								   <td>&nbsp;</td>
								   <td>&nbsp;</td>
						      </tr>
								 
								 
								 
								 
								 

								 
								 
								 
								 
								 <? if (!$config[userinfo][phone_allowed] && !$config[userinfo][address_allowed]) { ?>
								 
								 <? } else { ?>
								 
								 <? } ?>	
							</table>			
						 </td>								 
					  </tr>	
					  <? } else { 
					  			 if ($action == "profile_search") { 
								 	
											if ($mode == 1) {
												$mode = 'address';
											} else {
												$mode = 'phone';
											}									
								  
								   			$contactRes = Execute("select * from tbl_contact_view where userid = '" . $config[userinfo][id] . "' and mode = '$mode'");
											
											$usr_ids = array();
											
											if (mysql_num_rows($contactRes) > 0) {
												while ($contactRs = mysql_fetch_array($contactRes)) {
													array_push($usr_ids,$contactRs[profile_id]);	
												}	
											}
											
											if (!$usr_ids) { $usr_ids = 0; }
											
											$sql = "select * from tbl_register where id in(" . implode(",",$usr_ids) . ") ";											
											 
											$searchMaxRows = Execute($sql);	 
								  				
								  			//search limit
											if(!is_numeric($iResultsLimit))	{
												$iResultsLimit = 5;
											}
											
											$iPageNum = GetVar("iPageNum");
											
											if(!is_numeric($iPageNum)) {
												$iPageNum = 1;
											}
											$iResultsLower = 	(($iPageNum - 1) * ($iResultsLimit));
										
											/* Sanitise results */
										
											if ($iResultsLower < 0) {
												$iResultsLower = 0;
											}
											$sql .= "limit $iResultsLower , $iResultsLimit";											
											
											
											$searchRes = Execute($sql);	
											$iTotalRows = mysql_num_rows($searchMaxRows); 								
									?>
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
						  </table>
						  <table border="0" width="100%" align="center" cellspacing="0" cellpadding="0">	
						  <tr>
							<td style="padding-top:5px;">
								<table width="560" border="0" cellspacing="0" align="left" cellpadding="0" class="sbar">
								  <tr>
									<td width="4"><img src="images/cruv_left.gif" border="0"/></td>
									<td width="28"></td>
									<td width="105">&nbsp;</td>						
									<td width="28">&nbsp;</td>						
									<td width="66">&nbsp;</td>	
									<td width="28">&nbsp;</td>					
									<td width="93">&nbsp;</td>						
									<td width="100">
									<? 
											echo "Page";
											echo  do_pages($iTotalRows, $iResultsLimit);
										
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
											
												include("includes/myaccount_profile.php");									
												
											} else { ?>
												<div style="float:left; padding:10px 0px 0px 10px;">
												<table border="0" width="520" align="center" cellspacing="0" cellpadding="0" bgcolor="#c0ba84">
													<tr bgcolor="#FFFFFF"><td>&nbsp;</td></tr>
													<tr><td bgcolor="#FFFFFF">&nbsp;</td></tr>
													<tr><td bgcolor="#FFFFFF">&nbsp;</td></tr>
													<tr bgcolor="#FFFFFF">
														<td>
															No records found.														
														</td>
													</tr>
												</table>
												</div>
										<?	}	
									 } ?>
						  </form>
						  
						  </td>
						  </tr>	
						  <? } ?>					  		  
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
