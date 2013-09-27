<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");

 if($_REQUEST['Mode']=="Save"){
 
 $precent_date=getdate();
	$filename=$precent_date[year].$precent_date[mon].$precent_date[mday].$precent_date[hours].$precent_date[minutes].$precent_date[seconds];	
	$filename=$filename.".html";
	if($HTTP_POST_FILES['fileImage']['name']!=""){
		$img_story_image=post_img($HTTP_POST_FILES['fileImage']['name'], $HTTP_POST_FILES['fileImage']['tmp_name'],"successful_stories_images");
		$thumbnail_name="thumb_".$img_story_image;
		fnMagic($HTTP_POST_FILES['fileImage']['tmp_name'],"successful_stories_images/".$thumbnail_name,120,120);	
		$fileid = fopen("successful_stories/".$filename,"w+");
		$strFileContent=$_REQUEST['description'];
		$strmsg = $strFileContent;
		fwrite($fileid,$strmsg);
		fclose($fileid);
		
		$table="tbl_successful_stories";
		$insert_string=array("title"=>$_REQUEST['txtTitle'],"bride"=>$_REQUEST['cmbBride'],"groom"=>$_REQUEST['cmbGroom'],"marriage_date"=>$_REQUEST['txtDate'],"marriage_year"=>$_REQUEST['txtYear'],"file_name"=>$filename,"image"=>$img_story_image,"created_date"=>date('U'));
		$status=DB_Insert($link,$table,$insert_string);							
		$_SESSION['_msg']="Successful Stories stored successfully.";
	}	
?>
<script language="JavaScript">window.location.href="register_successful.php";</script>
<?
die();		
}?>

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

function validate(f1) {	
	if (isNull(f1.username, "User Id / Email Address")) { return false; }
	var str = f1.username.value;
	var email=0;
	str = str.split('@');
	var str;
	len = str.length;
	if (len > 1) { email = 1; }
	if (email == 1)	{
		if (notEmail(f1.username,"Email Address")) { return false; }	
	}
	if (isNull(f1.password, "Password")) { return false; }
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
		<td>
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:12px 0px 0px 4px;  float:left; " >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<div class="titlebg"><h1 class="title">Successful Stories</h1></div>
					<div style="float:left; padding:0px 0px 0px 0px;">
						<form name="thisForm" method="post"  enctype="multipart/form-data">
						<table  width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td  align="right" style="padding-right:25px;">
						<a href="successful_stories.php" class="hint" style="padding-right:35px;">Back To Successful Stories</a>
						</td></tr>
						<tr><td height="10"></td></tr>
						</table>
						<table width="500"  border="0" cellspacing="0" cellpadding="0" bgcolor="#fff1d1" style="border:#d9b35d 1px solid;">							
							<tr><td colspan="5">	
									<? include("add_register_successful.php"); ?>	
							  	</td>
							</tr>
						</table>
						</form>		
						</div>
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