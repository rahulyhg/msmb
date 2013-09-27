<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
$mode = GetVar("mode");
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
</head>
<body <? if (!$mode) { ?> class="homeinbody" <? } ?> onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
<? if (!$mode) { ?>
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
	<table width="780" border="0" cellspacing="0"  cellpadding="0">
	  <tr>
		<td valign="top">
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top" width="584">
		<? } ?>
			<div style="padding:12px 4px 0px 0px; width:584px; text-align:justify; float:right;">
			<table width="584" border="0" cellspacing="0" cellpadding="0" <? if ($mode) { ?> style="padding-left:2px;" <? } ?>>
			  <tr>
				<td valign="top">
					<table width="100%">
						<tr>
							<td>
							<div class="titlebg">
							  <h1 class="title">Terms & Conditions</h1>
							</div>
							</td>
							<td align="right" class="title">					
							<? if (!$mode) { ?>
							 <? if ($config[userinfo]) { ?>					
							<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
							<? } else { ?>						
							<a href="index.php" class="lout">Home</a></strong>&nbsp; |&nbsp; <a href="member_login.php?mode=member" class="idclr">Login</a>
							<? } ?>
							<? } ?>
							</td>	
						</tr>	
					</table>
				</td>
			  </tr>	
			  <tr>
				<td>
				<div style="padding-top:23px;">
						<b class="title_terms">Dear User :</b> Please read these terms and conditions before registration. on Maa Shakti Marriage Bureau
							<br><br>
							<b>Terms and Conditions and service Agreement :</b> In order to use the services offered by the Maa Shakti Marriage Bureau you must register as a member of the site & agree to the terms of use ("Agreement") & follow the instructions in the registration process for legal binding terms.  This agreement is subjected to charges time to time.
							<br><br><b class="title_terms">Members Eligibility :</b> To register (or) to use the service the client must be 18 yrs. of age or over as per the laws of residing country.  By using the services of the site, you represent & warrant that you have the right & authority to enter in to this agreement & to abide by all the terms & conditions of this agreement.
							<br><br><b class="title_terms">Terms :</b> 	The agreement will be in effect while you use the site or as long as you remain a member of site.  Membership can be terminated at any time just by writing to Maa Shakti Marriage Bureau.  Incase of Maa Shakti Marriage Bureau terminating your membership because of any infringement of the terms herein, you will not be entitled to any refund of unused subscription fees if any.
							<br><br><b class="title_terms">Non - Commercial use by member :</b> The site may not be used in connection with any commercial endeavors, as it is concerned with the use of individual members.  In such cases, the site can cancel the registration & can take legal action against such registrants civil (or) criminal.
							<br><br><b class="title_terms">Other terms of use by members:</b> <b>You will not </b>
							<ul>
							<li>We any information from site to misuse and misguide, Transmit any junk mails, engage in any advertising, buying and selling of any products. The site has the eight to monitor the members conduct & in its sole discretion cancel the registration in case of any violation of rules.</li>
							<li>Proprietary rights in contact on Maa Shakti Marriage Bureau own & retains the proprietary rights in the site, other than the client information.  The site contains copy righted material, patents, and other proprietary information.  You may not copy, modify, transmit or sell any such proprietary information.</li>
							<li>Content posted on the site : Understand & agree that </li>
							<li>Maa Shakti Marriage Bureau may delete any content that in the sole judgment of the site that violate the terms and agreement which night be illegal, </li>
							<li>The paid members will be able to view details like user contact details who have permitted their contact details to be visible,</li>
							<li>The client is solely responsible for the content that he publish on Maa Shakti Marriage Bureau.  The site may ask for providing any form of evidence supporting the content published or post by the client.  Which in fail terminate the registration</li>
							</ul>
							<b class="title_terms">The following content that is illegal or prohibited on the site.</b>
							<br><br><b class="title_terms">It includes content that :</b> is patently offensive to the online community, involving transmission of chair letters or junk mail,  Promotion of false (or) misleading information promotion of un authorized copy of another persons work, as pirated programs or links to them. Containing restricted images (or) hidden pages, Display of pornographic kind of material. Exploiting people under age of 18 by providing abuse materials, providing instructional information about illegal activities, personal identifying information for unlawful purposes, engagement in commercial activities.
							<br><br>Client should not include any member profile visible to other members, any 
							telephone numbers, street address, last names,   URL's & email address.
							<br><br><b class="title_terms">Member disputes:</b> The Maa Shakti Marriage Bureau is only a service provides and you are solely responsible for any disputes between you & with other Maa Shakti Marriage Bureau members.
							<br><br><b class="title_terms">Limitation on liability :</b> Maa Shakti Marriage Bureau is not liable to you or any 3rd person for any damages including lost profits except in jurisdictions where such provisions are restricted.
							<br><br><b class="title_terms">Disputes:</b> The dispute will be governed by Indian laws & jurisdictional at the courts at New Delhi, India in case if there is any dispute about or involving the site and or the service.
							<br><br>13.Indemnity:	Not charged
							<br><br><b class="title_terms">Others :</b> On becoming the member of the site, you agree to receive certain specific emails.	
							This accepted agreement upon the usage of site contains the entire agreement band client & Maa Shakti Marriage Bureau on behalf of the usage of site or the service.  If any provision of this agreement is held invalid, the remainder of this agreement shall continue in full force & effect.
							<br><br><b class="title_terms">Disclaimers:</b> Maa Shakti Marriage Bureau provided on an "as is" and "as available" basis. Maa Shakti Marriage Bureau makes no representations or warranties of any kind, express or implied, as to the operation of this site or the information, content, materials, or products included on this site. you expressly agree that your use of this site is at your sole risk. to the full extent permissible by applicable law, Maa Shakti Marriage Bureau disclaims all warranties, express or implied, including, but not limited to, implied warranties of merchantability and fitness for a particular purpose. Maa Shakti Marriage Bureau does not warrant that this site, its servers, or e-mail sent from bharatmatrimony.com are free of viruses or other harmful components. Maa Shakti Marriage Bureau will not be liable for any damages of any kind arising from the use of this site, including, but not limited to direct, indirect, incidental, punitive, and consequential damages. 
							
							<br><br><b class="title_terms">Copyright :</b> All rights are reserved. All the information and material presented on Maa Shakti Marriage Bureau is copyrighted and owned and controlled Maa Shakti Marriage Bureau. Any kind of reproduction, publication or copying of the material or the commercial use of information found on www. Maa Shakti Marriage Bureau is prohibited without the express consent of Maa Shakti Marriage Bureau
							
							<br><br><b class="title_terms">ANNEXURE :  APPLICABLE DOMAINS </b>
							<ul >	
								<li><a href="http://thecreativeit.com" class="faq_inner1" target="_blank">www.Maa Shakti Marriage Bureau</a></li>
								<li><a href="http://www.newassamesematrimony.com" class="faq_inner1" target="_blank">www.newassamesematrimony.com</a> </li>
								<li><a href="http://www.newbengalimatrimony.com" class="faq_inner1" target="_blank">www.newbengalimatrimony.com</a> </li>
								<li><a href="http://www.newgujaratimatrimony.com" class="faq_inner1" target="_blank">www.newgujaratimatrimony.com</a> </li>
								<li><a href="http://www.newhindimatrimony.com" class="faq_inner1" target="_blank">www.newhindimatrimony.com</a> </li>
								<li><a href="http://www.newkannadamatrimony.com" class="faq_inner1" target="_blank">www.newkannadamatrimony.com</a> </li>
								<li><a href="http://www.newkeralamatrimony.com" class="faq_inner1" target="_blank">www.newkeralamatrimony.com</a> </li>
								<li><a href="http://www.newmarathimatrimony.com" class="faq_inner1" target="_blank">www.newmarathimatrimony.com</a></li>
								<li><a href="http://www.newmarwadimatrimony.com" class="faq_inner1" target="_blank">www.newmarwadimatrimony.com</a> </li>
								<li><a href="http://www.neworiyamatrimony.com" class="faq_inner1" target="_blank">www.neworiyamatrimony.com</a> </li>
								<li><a href="http://www.newpunjabimatrimony.com" class="faq_inner1" target="_blank">www.newpunjabimatrimony.com</a></li>
								<li><a href="http://www.newsindhimatrimony.com" class="faq_inner1" target="_blank">www.newsindhimatrimony.com</a></li>
								<li><a href="http://www.newtamilmatrimony.com" class="faq_inner1" target="_blank">www.newtamilmatrimony.com</a></li>
								<li><a href="http://www.newtelugumatrimony.com" class="faq_inner1" target="_blank">www.newtelugumatrimony.com</a></li>
								<li><a href="http://www.newurdumatrimony.com" class="faq_inner1" target="_blank">www.newurdumatrimony.com</a></li>
							</ul>
							<b class="title_terms">Suggestions,</b> and complaints are to be first addressed to Maa Shakti Marriage Bureau's Customer Support at <a href="mailto:support@thecreativeit.com.com" class="faq_inner">support@thecreativeit.com.com.</a>

				</div>
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  
			  <tr>
				<td>
					<table width="584" border="0" cellspacing="0" cellpadding="4" style="border:#8f830d solid 1px; margin-top:5px; osition:absolute;">
					
					
					 </table>
				</td>
			  </tr>
			</table>
		</div>
		<? if (!$mode) { ?>
		</td>
	  </tr>
	</table>
	</td>
  </tr>
  <tr>
  <td colspan="2">
  	<? 
		//include("includes/community_search.php");
		include("includes/fotter.php");
	?>
  </td>
  </tr>
</table>
<div>
<? } ?>
</body>
</html>
