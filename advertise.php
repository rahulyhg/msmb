<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
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
<script>
 function fnOpenWindow(img)
	{
	window.open('enlarge.php?image=' + img ,'','top=0, right=0, left=0, bottom=0, width=601, height=451, resizable=no, toolbar=no, menubar=no,location=no, scrollbars=no');
	}
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
			<div style="padding:12px 2px 0px 0px; float:left;">
			<table width="562" border="0"  cellspacing="0" cellpadding="0" >
			 <tr>
				<td>
					<div class="titlebg"><h1 class="title">Advertisement</h1></div>
				</td>
				<td align="right" style="padding-right:8px;">
				 <? if ($config[userinfo]) { ?>					
				<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
				<? } else { ?>						
					<a href="index.php" class="lout">Home</a></strong>&nbsp; |&nbsp; <a href="member_login.php?mode=member" class="idclr">Login</a>
				<? } ?>		
				</td>
			  </tr>
			  <tr>
					<td height="5"></td>
				</tr>
			  <tr>
				<td colspan="2"   bgcolor="#fff9d4" style="border:#fbe292 1px solid; padding:5px; line-height:18px;"  valign="top">
					<img src="images/exp_arrow.gif" border="0" align="absmiddle">&nbsp;&nbsp;Maa Shakti Marriage Bureau is a fore runner in portal matrimony concern operating all over India having made very huge impact on millions of website users of prospective spouses. All website advertising fructifies profusely when combined with intimate portal like our perfect matrimonial match making. The reason being prospective spouses surf the site more often than others for they are in rendezvous with destiny life.  It in close to their hearts. This generates most cast effective, Convenient and everlasting advertisement imprints on people.
				</td>
			  </tr>
			  <tr>
				<td colspan="2">
					<table width="100%" align="center" border="0" cellspacing="2" cellpadding="4" style="border:#dfe5cd solid 1px; margin-top:5px;" >
					  <tr>
						<td width="8%" class="advr">Sl.no.</td>
						<td width="26%" align="center" class="advr">Add description</td>
						<td width="16%" align="center" class="advr"> Pixel size</td>
						<td width="35%" align="center" class="advr">Position</td>
						<td width="15%" align="center" class="advr">View sample</td>
					  </tr>
					  <tr class="iclr">
						<td align="center"  class="advr1">1</td>
						<td align="center" class="advr1">HOME PAGE TOP BANNER</td>
						<td align="center" class="advr1">360x70</td>
						<td align="center" class="advr1">Run at home page top</td>
						<td align="center" class="advr1"><img src="images/advr_bull.gif" border="0" onClick="fnOpenWindow('popup_hometop.jpg');" style="cursor:pointer;"></td>
					  </tr>
					  <tr class="iclr">
						<td align="center"  class="advr1">2</td>
						<td align="center" class="advr1">HOME PAGE RIGHT BOTTOM</td>
						<td align="center" class="advr1">360x90</td>
						<td align="center" class="advr1">Run at home page right bottom</td>
						<td align="center" class="advr1"><img src="images/advr_bull.gif" border="0" onClick="fnOpenWindow('popup_homebtm.jpg');" style="cursor:pointer;"></td>
					  </tr>
					  <tr class="iclr">
						<td align="center"  class="advr1">3</td>
						<td align="center" class="advr1">SEARCH LEFT</td>
						<td align="center" class="advr1">172x318</td>
						<td align="center" class="advr1">Run at search page leftside</td>
						<td align="center" class="advr1"><img src="images/advr_bull.gif" border="0" onClick="fnOpenWindow('popup_comlft.jpg');" style="cursor:pointer;"></td>
					  </tr>
					  <tr class="iclr">
						<td align="center"  class="advr1">4</td>
						<td align="center" class="advr1">SEARCH TOP</td>
						<td align="center" class="advr1">360x70</td>
						<td align="center" class="advr1">Run at search page topside</td>
						<td align="center" class="advr1"><img src="images/advr_bull.gif" border="0" onClick="fnOpenWindow('popup_searchtop.jpg');" style="cursor:pointer;"></td>
					  </tr>
					  <tr class="iclr">
						<td align="center"  class="advr1">5</td>
						<td align="center" class="advr1">ROS TOP BANNER</td>
						<td align="center" class="advr1">360x70</td>
						<td align="center" class="advr1">Run at other than home page top</td>
						<td align="center" class="advr1"><img src="images/advr_bull.gif" border="0" onClick="fnOpenWindow('popup_rostop.jpg');" style="cursor:pointer;"></td>
					  </tr>
					  <tr class="iclr">
						<td align="center"  class="advr1">6</td>
						<td align="center" class="advr1">LOGOUT PAGE</td>
						<td align="center" class="advr1">272x100</td>
						<td align="center" class="advr1">Run at user logout page</td>
						<td align="center" class="advr1"><img src="images/advr_bull.gif" border="0" onClick="fnOpenWindow('popup_logout.jpg');" style="cursor:pointer;"></td>
					  </tr>
					  <tr class="iclr">
						<td align="center"  class="advr1">7</td>
						<td align="center" class="advr1">WEDDING DIRECTORY TOP</td>
						<td align="center" class="advr1">360x70</td>
						<td align="center" class="advr1">Run at wedding directory page topside</td>
						<td align="center" class="advr1"><img src="images/advr_bull.gif" border="0" onClick="fnOpenWindow('img_wed_banner.jpg');" style="cursor:pointer;"></td>
					  </tr>
					  <tr class="iclr">
						<td align="center"  class="advr1">8</td>
						<td align="center" class="advr1">PHOTO VIEW PAGE</td>
						<td align="center" class="advr1">468x60</td>
						<td align="center" class="advr1">Enlarged photoview window</td>
						<td align="center" class="advr1"><img src="images/advr_bull.gif" border="0" onClick="fnOpenWindow('popup_enlarge.jpg');" style="cursor:pointer;"></td>
					  </tr>
<!--					  <tr class="iclr">
						<td align="center"  class="advr1">9</td>
						<td align="center" class="advr1">BOTTOM</td>
						<td align="center" class="advr1">468x60</td>
						<td align="center" class="advr1">Run at bottom</td>
						<td align="center" class="advr1"><img src="images/advr_bull.gif" border="0"></td>
					  </tr>
-->				  </table>

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
	  <td colspan="2" align="left">
		<? 
					
					include("includes/fotter.php") ?>
	  </td>
  </tr>
</table>
<div>
</body>
</html>
