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
<link href="includes/style.css" rel="stylesheet" type="text/css"/>
<link href="includes/franchise.css" type="text/css" rel="stylesheet"/>
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

function validate() {
	f1 = document.thisForm;
	if (notSelected(f1.city,"city")) { return false; }
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
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:12px 0px 0px 3px;  float:left;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">					
					<table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td>
					<div class="titlebg"><h1 class="title">Franchise Search</h1>
					</div>
					</td>
					<td align="right" class="title" style="padding-right:70px">
					  <? if ($config[userinfo]) { ?>					
						<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
					<? } else { ?>						
						<a href="index.php" class="lout">Home</a></strong>&nbsp; |&nbsp; <a href="member_login.php?mode=member" class="idclr">Login</a>
					<? } ?>	
					</td></tr></table>
				</td>
			  </tr>
			  <tr>
				<td></td>
			  </tr>
			  <tr>
					    <td width="400" rowspan="4" valign="top">
						<!--<h1 class="title">Member Login</h1>
						<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
						<div style="float:left; padding:10px 0px 0px 0px;">
						<table border="0" width="550" align="left" cellspacing="0" cellpadding="0" style="background:url(images/vpro_menu.jpg) top center no-repeat; height:22px; width:550px">						  
						  <tr>
						  	<td valign="top">
								<table border="0" width="500" cellpadding="0"   cellspacing="0" style="border:1px solid #eddab0;">																			
								<form name="thisForm" method="post" onSubmit="return validate();">
									<input type="hidden" name="action" value="search">
									<tr>
										<td colspan="2" align="right" bgcolor="#fccf56" height="25">
										<select name="city" class="cmbfbox">
											<option value="">--Select--</option>
									<?  
										$res2 = Execute("select * from tbl_city_master where stateid = '30'");
										if (mysql_num_rows($res2) > 0) {
											while ($cityRes2 =  mysql_fetch_array($res2)) { ?>										
												<option value="<?=$cityRes2[id]?>"><?=$cityRes2[city];?></option>
												
										<?	}
										}	
									 ?>	
									 		</select>
											<? if (GetVar("city"))?>
											<script language="javascript">
												document.thisForm.city.value = '<?=GetVar("city")?>';
											</script>
											&nbsp;&nbsp;
											<input type="submit" value="Search" class="buttonf">&nbsp;
									 		</td>										
									 </tr>
									<?
										if ($action == 'search') {
											$sql = "select * from tbl_franchisee where 1=1 ";
											
											if (GetVar("city")) {
												$sql .= "and city = '" . GetVar("city") . "' ";
											}
											
											$sql .= "group by city";											
											
											$res = Execute($sql);
											
											if (mysql_num_rows($res) > 0) {
												while ($cityRes =  mysql_fetch_array($res)) {											
												?>
												<tr><td colspan="2" height="5"></td></tr>
												  <tr>
													<td colspan="2" bgcolor="#ef8d31" style="padding-left:5px;"><h4 class="htitle"><?=GetSingleField('city','tbl_city_master','id',$cityRes[city]);?> Franchises</h4></td>					
												 </tr>
												 <tr>
													<td >
														<table cellpadding="5" cellspacing="0" border="0" width="100%" bgcolor="#ef8d31">
												 <?
													$res1 = Execute("select * from tbl_franchisee where city = '" . $cityRes[city] . "'");
													if (mysql_num_rows($res1) > 0) {
														$no = mysql_num_rows($res1);
														$i = 1;
														while ($franchiseeRes = mysql_fetch_array($res1)) {
															?>		
															 <tr bgcolor="#fef9d6">
																<td valign="top" width="150">Franchisee Name</td>
																<td>-</td>
																<td><?=$franchiseeRes[franchisee_name]?></td>
															 </tr>
															 <tr bgcolor="#ffffff">
																<td valign="top" style="color:#95403d;">Franchisee Email</td>
																<td>-</td>
																<td><?=$franchiseeRes[franchisee_email]?></td>
															 </tr>
															 <tr bgcolor="#fef9d6">
																<td valign="top" style="color:#95403d;">Franchisee Address</td>
																<td>-</td>
																<td><?=$franchiseeRes[franchisee_address]?></td>
															 </tr>
															 <tr bgcolor="#ffffff">
																<td valign="top" style="color:#95403d;">Franchisee Address1</td>
																<td>-</td>
																<td><?=$franchiseeRes[franchisee_address1]?></td>
															 </tr>
															 <tr bgcolor="#fef9d6">
																<td valign="top" style="color:#95403d;">Franchisee Phone</td>
																<td>-</td>
																<td><?=$franchiseeRes[franchisee_phone]?></td>
															 </tr>														 														 
															 <tr bgcolor="#ffffff">
																<td valign="top" style="color:#95403d;">Franchisee State</td>
																<td>-</td>
																<td><?=GetSingleField('state','tbl_state_master','id',$franchiseeRes[state])?></td>
															 </tr>
															 <tr><td colspan="3">&nbsp;</td></tr>
															 <? if ($i != $no) { ?>
															 <tr><td colspan="3" bgcolor="#FFFFFF" height="3"></td></tr>
															 <? } ?>
															
															<?	
															$i++;	
														}
													}else{?>
													
													 <tr><td colspan="2" bgcolor="#FFFFFF" height="3">No Franchise details found..</td></tr>
													<?	
													}
													 ?>
													</table>
													</td>
												</tr>
																						
											<?	}
											}
										}	
									?>                              
									 </form>                               
									 								
								</table>			
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
