<?php
ob_start();
session_start();
include("../includes/lib.php");
include("../common/image_crop.php");

if($_REQUEST['progress']=="upload"){
		if ($HTTP_POST_FILES['photo1']['name'] != "") {			
				$photo1 = post_img($HTTP_POST_FILES['photo1']['name'], $HTTP_POST_FILES['photo1']['tmp_name'],"../userthumbnail");
				$photo_name = $photo1;						
				$siteurl = realpath(".");
				$image_magic = new pb_imageMagick("../userthumbnail/".$photo_name);						
				$rand=rand(100,4000);
				$image_magic1 = $image_magic->crop(75,75,"../userthumbnail/usr212_".$rand.".jpg");						 	
			}
	?>
	<script language="javascript">alert("Uploaded..");</script>
	<?		
	header("Location:test_form_upload.php");
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

function validatePhoto() {
	
	f1 = document.thisForm;
	f1.imgno.value = 1;
	if (isNull(f1.photo1,"Photo")) { return false; }
	if (notJpgFile(f1.photo1,"Photo")) { return false; }		
}


function passwordProtect() {
	f1 = document.thisForm;
	if (f1.photo_password.disabled == false) {
		if (isNull(f1.photo_password,"password"))	{ return false; }
		if (isLen(f1.photo_password,5,"Password")){ return false;}
		if (isNull(f1.confirmpassword,"confirm Password")){return false; }       			
		if (isNotSame(f1.photo_password,f1.confirmpassword,"Password","Confirm Password")) { return false;}
	} else {
		alert("Please select protect photo as 'Yes'");
		return false;
	}	
}

function passwordUnProtect(id) {
	
	if(confirm("Are you sure want to unprotect the photo")) { 
		location.href = "add_photo.php?action=unprotect&id="+id;	
	}
}

function passwordProected() {

	f1 = document.thisForm;
	for(i = 0; i < f1.protect.length; i++) {
		if (f1.protect[i].checked) {
			if (f1.protect[i].value == 0) {				
				f1.photo_password.value = "";
				f1.confirmpassword.value = "";
				f1.photo_password.disabled = true;
				f1.confirmpassword.disabled = true;	
				<? if ($user[photo_password]) { ?>
				document.getElementById("divprotect").style.display = "none";
				document.getElementById("divunprotect").style.display = "block";								
				<? } ?>
			}
			if (f1.protect[i].value == 1) {				
				f1.photo_password.disabled = false;
				f1.confirmpassword.disabled = false;
				//f1.btnprotect.disabled = "false";
				<? if ($user[photo_password]) { ?>
				document.getElementById("divprotect").style.display = "block";
				document.getElementById("divunprotect").style.display = "none";
				<? } ?>
			}
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
		<td valign="top">
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:12px 0px 0px 0px;  float:left;">
			<table width="573" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td valign="top">
					<div class="titlebg"><h1 class="title">Upload Photos</h1>
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
								<form name="thisForm" method="post" action="test_form_upload.php?progress=upload" enctype="multipart/form-data" onSubmit="return validatePhoto();">	
									<input type="hidden" name="action" class="proinbox" value="submit">
									<input type="hidden" name="imgno">
									<table width="500" border="0" align="center" cellspacing="0" cellpadding="0" class="probg">
										<tr><td>
										<table cellpadding="0" cellspacing="0" border="0"  bgcolor="#fff6bd" width="500">
										<tr><td  class="tips_topbg"></td></tr>
										<tr><td class="tips_midbg"><br><b class="add_title">Tips for the perfect photo</b>
										<ul class="addphoto">
										
											<li>Make sure the photos should express yourself alone instead of group photos</li>
											<li>Enhance your photos with neat and clear</li>
											<li>For more clarity, please upload high resolution pictures</li>
										</ul></td></tr>
										<tr><td class="tips_btmbg"></td></tr>
										<tr><td class="probdr"></td></tr></table>
										<tr><td height="20"></td></tr>
										<tr><td class="probdr" height="25"><b class="tbl_title">Add photos to your profile</b></td></tr>	
										<tr><td class="probdr"></td></tr>	
										<tr bgcolor="#FFFFFF">
											<td>
												<table width="500" border="0" align="center" cellspacing="5" cellpadding="0" bgcolor="#fff6bd"  style="border:solid 1px #948036;">
													<tr>
											
													
												<td class="probdr">
												<table  border="0" align="center" cellspacing="0" cellpadding="0">
												<tr bgcolor="#FFFFFF">
													<td align="center"><img src="images/nopicture.png" border="0" width="75" height="75"></td>
												</tr>		
												<tr bgcolor="#FFFFFF">
													<td><input type="file" name="photo1" class="txtbox"></td>
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
