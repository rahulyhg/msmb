<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
isMember();







$_SERVER['FULL_URL'] = 'http';
$script_name = '';
if(isset($_SERVER['REQUEST_URI'])) {
    $script_name = $_SERVER['REQUEST_URI'];
} else {
    $script_name = $_SERVER['PHP_SELF'];
    if($_SERVER['QUERY_STRING']>' ') {
        echo $script_name .=  '?'.$_SERVER['QUERY_STRING'];
    }
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {
    $_SERVER['FULL_URL'] .=  's';
}
$_SERVER['FULL_URL'] .=  '://';
if($_SERVER['SERVER_PORT']!='80')  {
    $_SERVER['FULL_URL'] .=
     $_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'].$script_name;
} else {
    $_SERVER['FULL_URL'] .=  $_SERVER['HTTP_HOST'].$script_name;
}

 $path1=$_SERVER['FULL_URL'];






$user = GetSingleRecord("tbl_register","username",$config[userinfo][username]);

if (!is_dir("horoscope")) {
	mkdir("horoscope");
	chmod("horoscope",0777);
}	
		
if ($HTTP_POST_FILES['horoscope']['name'] && $action == 'submit') {	
	
	if ($user[horoscope]) { removeFile("horoscope/" . $user[horoscope]); }
	$file = post_img($HTTP_POST_FILES['horoscope']['name'], $HTTP_POST_FILES['horoscope']['tmp_name'],"horoscope");
	$res = Execute("update tbl_register set horoscope = '$file' where id = '" . $config[userinfo][id] . "'");
	?>
	<script language="javascript">
		location.href = 'thanks.php?id=31';
	</script>
	<?
	die();
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

function fnValidate() {	
	f1 = document.thisForm;
	if (isNull(f1.horoscope,'horoscope')) { return false; }
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
		<td valign="top">
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:12px 0px 0px 0px;  float:left;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td valign="top">
					<div class="titlebg"><h1 class="title">Upload Horoscope</h1>
					</div>
				</td>
				<td align="right" class="title">					
						 <? if ($config[userinfo]) { ?>					
					<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
					<? } ?>						
				</td>
			  </tr>
			  <tr>
				<td colspan="2">
					<table width="100%" border="0" cellspacing="2" cellpadding="4" bgcolor="#fccf56" style="border:#8f830d solid 1px; margin-top:5px;">
					 <tr><td>
					 		<div style="float:left; padding:10px 0px 0px 10px;">						
								<form name="thisForm" method="post" enctype="multipart/form-data" onSubmit="return fnValidate()">	
									<input type="hidden" name="action" class="proinbox" value="submit">
									<table width="500" border="0" align="center" cellspacing="0" cellpadding="0" class="probg">
										<tr><td>
										<table cellpadding="0" cellspacing="0" border="0"  bgcolor="#fff6bd" width="500">
										<tr><td  class="tips_topbg"></td></tr>
										<tr><td class="tips_midbg"><br><b class="add_title">Benifits for adding your horoscope</b>
										<ul class="addphoto">
										
											<li>Prospective members would like to see your horoscope before contacting you</li>
											<li>By adding your horoscope members can match their horoscope.</li>
											
										</ul></td></tr>
										<tr><td class="tips_btmbg"></td></tr>
										<tr><td class="probdr"></td></tr></table>
										<tr><td height="20"></td></tr>
										<tr><td>									
									<table cellpadding="0" cellspacing="0" border="0"  bgcolor="#fff6bd" width="500">
									<tr><td  class="tips_topbg"></td></tr>
									<tr><td class="tips_midbg"><br><b class="add_title"><? if($user[horoscope]!=""){?>VIEW <? }else{?>GENERATE <? }?>HOROSCOPE</b></td></tr>
									
									<tr>
									  <td class="tips_midbg" ><ul class="addphoto">
										
											<li>
                                            <? if($user[horoscope]==""){?>
                                            Please use the below link to generate your horoscope <a href="astrohoro/Userhoro1.php" class="more">Generate Horoscope</a>.<? }else{?> 
                                            <a href="horoscope/<?=$user[horoscope]?>" target="_blank">View My Horoscope</a>  <? }?></li>
											<? if($user[horoscope]!=""){?><li><a href="astrohoro/Userhoro1.php">Click here</a> to change your horoscope.<? }?></li>
										</ul>
													
									</tr>									
									<tr><td class="tips_midbg" style="padding-left:20px"></td></tr>									
									<tr><td class="tips_midbg" style="padding-left:20px"></td></tr>
									<tr><td class="tips_btmbg"></td></tr>
									<tr><td class="probdr"></td></tr></table>
									</td></tr>
										<tr><td class="probdr" height="25"><b class="tbl_title">Add Horoscope to your profile</b></td></tr>	
										<tr><td class="probdr"></td></tr>	
										<tr bgcolor="#FFFFFF">
											<td>
												<table width="500" border="0" align="center" cellspacing="5" cellpadding="0" bgcolor="#fff6bd"  style="border:solid 1px #948036;">
													<tr>														
														<td>
															<table width="240"  border="0" align="center" cellspacing="0" cellpadding="0">	 
															<tr bgcolor="#FFFFFF">
																<td align="center" height="50"><? if ($user[horoscope]) {?>
																
																Click <a href="horoscope/<?=$user[horoscope]?>" class="moreid" target="_blank">here</a> to view horoscope.
																<? } ?></td>
															</tr>		
															<tr bgcolor="#FFFFFF">
																<td align="center"><input type="file" name="horoscope" class="txtbox"></td>
															</tr>
															<tr>
																<td align="center">
																<input type="submit" value="upload" class="button">
																</td>
															</tr>
														    </table>
														</td>
													</tr>
											</table>
										</td>
									</tr>
									<tr><td class="probdr">&nbsp;</td></tr>										
									<tr><td>									
									<table cellpadding="0" cellspacing="0" border="0"  bgcolor="#fff6bd" width="500">
									<tr><td  class="tips_topbg"></td></tr>
									<tr><td class="tips_midbg"><br><b class="add_title">Email your horoscope</b></td></tr>
									<tr><td class="tips_midbg">&nbsp;</td></tr>
									<tr><td class="tips_midbg" style="padding-left:20px">
									<!--Email or Post your horoscope at - info@maashaktimarriage.com with your Matrimony ID and Password. We will reduce the horoscope size and upload it.-->
									If Your horoscope file is more than 1 MB, then please send your horoscope along with the Matrimony User ID with password to <a href="mailto:info@maashaktimarriage.com" class="more">info@maashaktimarriage.com</a>				
									</tr>									
									<tr><td class="tips_midbg">&nbsp;</td></tr>									
									
									<tr><td class="tips_btmbg"></td></tr>
									<tr><td class="probdr"></td></tr></table>
									</td></tr>
									<tr><td class="probdr">&nbsp;</td></tr>	
									
									
									<tr><td class="probdr">&nbsp;</td></tr>	
									<!--<tr><td class="probdr">&nbsp;</td></tr>
									<tr><td>
										<table cellpadding="0" cellspacing="0" border="0"  bgcolor="#fff6bd" width="500">
										<tr><td  class="tips_topbg"></td></tr>
										<tr><td class="tips_midbg"><br><b class="add_title">Send your horoscope through post</b></td></tr>
										<tr><td class="tips_midbg">&nbsp;</td></tr>
										<tr><td class="tips_midbg" style="padding-left:20px">
										Kindly mention your matrimony ID and your password at the back of the horoscope and send them by post to our <a href="contact_us.php" class="more">office</a>. We will upload your horoscope, absolutely FREE. If you want your horoscope back, enclose a self-addressed envelope with pre-paid postage.
										</td></tr>									
										<tr><td class="tips_midbg">&nbsp;</td></tr>
										<tr><td class="tips_btmbg"></td></tr>
										<tr><td class="probdr"></td></tr></table>
									</td></tr>															   															
									<tr>
										<td class="probdr" align="center" style="padding-left:74px;">
											
										</td>
									</tr>	-->									
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
