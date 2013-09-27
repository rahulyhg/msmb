<?php
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
	
function fnForward() {
  f1 = document.thisForm;
  if (isNull(f1.sender,"your name")) { return false; }
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
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td>
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:10px 0px 0px 0px;  float:left;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top" colspan="2">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr> <td>	
					<div class="titlebg">
					  <h1 class="title">Compare profiles</h1>
					</div>
						</td>
						<td align="right" class="title" style="padding-right:63px;">					
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
					    <td rowspan="4" valign="top">
						<!--<h1 class="title">Member Login</h1>
						<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
						<div style="float:left; padding:10px 0px 0px 10px;">						
							<form name="thisForm" action="forward_profile.php" method="post" onSubmit="return fnForward()">	
							<input type="hidden" name="action" value="submit" />
							<input type="hidden" name="id" value="<?=$id?>"	/>
							<input type="hidden" name="mode" value="<?=$mode?>" />				
							<table border="0"   cellspacing="0" cellpadding="0"  lass="cmpbg" >
								<tr>
									<td valign="top" bgcolor="#FFFFFF"><h1 class="title">View multiple profiles simultaneously & compare.</h1></td>
								</tr>
								<tr><td></td></tr>
								<tr>
									<td class="probdr" valign="top">
										<table cellpadding="2" cellspacing="0" border="0">								
											<tr>	
												<td valign="top">
													<table width="100%" cellpadding="6"  cellspacing="1" border="0" bgcolor="#ffdb7b">							
												<?
													if ($id) {
														
														$res = Execute("select * from tbl_register where id in ($id)");
														
														if (mysql_num_rows($res) > 0) { 
																
																$usrfields = array(
																	"photo"    => "Photo/Image",
																	"name" => "Name",
																	"username" => "Profile Id",
																	"gender" => "Gender",
																	"age" => "Age",
																	"religion" => "Religion",
																	"language" => "Mother Tongue",
																	"height" => "Height",
																	"bodyType" => "Body type",
																	"complexion" => "Complexion",
																	"education" => "Education",
																	"occupation" => "Occupation",
																	"location" => "Location",
																	"maritalStatus" => "Matrital Status",
																	"registerby" => "Profile Created By", 
																	"lastLogin" => "Last Login",																															
																);
																foreach ($usrfields as $key => $value) { 
																	
																	if ($key == 'photo') { ?>
																		<tr>
																			<td bgcolor="#FFFFFF"><font color="#a80326"><b>Photo / Image</b></font></td>
																		<?
																			//$resPhoto = Execute("select * from tbl_photo where userid = '".$member[id]."' and approve = '1' ");
																			for ($i = 0; $i < mysql_num_rows($res); $i++) {
																		?>	
																			<td bgcolor="#FFFFFF">
																			<?	
																				$memPhoto = GetSingleRecord("tbl_photo","userid",mysql_result($res,$i,"id"));
																				
																				if ($memPhoto) {
																				
																					if (mysql_result($res,$i,"photo_password")) { 
																					?>	
																						<a href="view_member_profile.php?userid=<?=mysql_result($res,$i,"username")?>"><img src="images/protectedphoto.gif" border="0" hspace="5" style="cursor:pointer" idth="60" eight="70"></a>
																				<?	} else { ?>																												
																						<a href="view_member_profile.php?userid=<?=mysql_result($res,$i,"username")?>"><img src="userthumbnail/<?=$memPhoto[photo]?>" border="0" style="border:#000000 1px solid;" style="cursor:pointer" ></a>
																				 <? } 
																																						 
																				} else { ?>																		
																				
																					<a href="view_member_profile.php?userid=<?=mysql_result($res,$i,"username")?>"><img src="images/nopicture.png" border="0" style="border:#000000 1px solid;" hspace="5" idth="80" eight="90"/></a>																								
																			<?	}  ?>
																			</td>																	
																		<?	}	?>
																		</tr>
																<?	} else if ($key == "lastLogin" or $key == "date_of_birth") {
																		?>
																			<tr>
																				<td bgcolor="#FFFFFF"><?=$value?></td>
																				<? 
																				for ($i = 0; $i < mysql_num_rows($res); $i++) {
																				 ?>	
																					<td bgcolor="#FFFFFF"><?=strftime("%d %b %Y",strtotime(mysql_result($res,$i,$key)))?>&nbsp;</td>
																				<?
																					}
																				?>														
																			</tr>
																		<?
																	} else if ($key == "gender") {
																		?>
																		<tr>
																			<td width="150" bgcolor="#FFFFFF"><?=$value?></td>
																			<? 
																			for ($i = 0; $i < mysql_num_rows($res); $i++) {
																			 ?>	
																				<td bgcolor="#FFFFFF">
																				<?  
																					if (mysql_result($res,$i,$key) == "F") {
																						$key1 = "Female";
																					} else {
																						$key1 = "Male";
																					}
																					echo $key1;
																				?>
																				&nbsp;</td>
																			<?
																				}
																			?>														
																		</tr>
																<?	} else if ($key == 'education') {	?>
																		<tr>
																			<td width="150" bgcolor="#FFFFFF"><?=$value?></td>																
																			<? 
																			for ($i = 0; $i < mysql_num_rows($res); $i++) {
																				?><td bgcolor="#FFFFFF"><?
																				if (mysql_result($res,$i,$key)) {																		
																					echo GetSingleField($key,"tbl_education_master","id",mysql_result($res,$i,"education"));
																					if (mysql_result($res,$i,"educationDetail")) {
																						echo ',' . mysql_result($res,$i,"educationDetail");
																					}	
																				} else { echo "-"; }																	
																				?>&nbsp;</td><?
																			}
																			?>															
																		</tr>
																<?	} else if ($key == 'occupation') {	?>
																		<tr>
																			<td width="150" bgcolor="#FFFFFF"><?=$value?></td>																
																			<? 
																			for ($i = 0; $i < mysql_num_rows($res); $i++) {
																				?><td bgcolor="#FFFFFF"><?
																				if (mysql_result($res,$i,$key)) {																		
																					echo GetSingleField($key,"tbl_occupation_master","id",mysql_result($res,$i,"occupation"));
																					if (mysql_result($res,$i,"occupationDetail")) {
																						echo ',' . mysql_result($res,$i,"occupationDetail");
																					}	
																				} else { echo "-"; }																	
																				?>&nbsp;</td><?
																			}
																			?>															
																		</tr>															
																<?	} else if ($key == 'religion') {	?>
																		<tr>
																			<td width="150" bgcolor="#FFFFFF"><?=$value?></td>																
																			<? 
																			for ($i = 0; $i < mysql_num_rows($res); $i++) {
																				?>
																				<td bgcolor="#FFFFFF">
																				<?
																					$mem_religion = GetSingleField("religion","tbl_religion_master","id",mysql_result($res,$i,$key));
																					echo $mem_religion;	
																					if (mysql_result($res,$i,"caste")) {
																						echo "," . GetSingleField("caste","tbl_caste_master","id",mysql_result($res,$i,"caste"));
																					}				
																					if (mysql_result($res,$i,"gothram")) {
																						echo "," . mysql_result($res,$i,"gothram");
																					}						
																				?>&nbsp;
																				</td>
																				<?
																			}
																			?>															
																		</tr>
																<?	} else if ($key == 'location') {	?>
																		<tr>
																			<td width="150" bgcolor="#FFFFFF"><?=$value?></td>																
																			<? 
																			for ($i = 0; $i < mysql_num_rows($res); $i++) {
																				?>
																				<td bgcolor="#FFFFFF">
																				<? 
																				if (mysql_result($res,$i,"city")) {
																					echo GetSingleField("city","tbl_city_master","id",mysql_result($res,$i,"city")) . ', ' ;
																				}
																				if (mysql_result($res,$i,"state")) {
																					echo GetSingleField("state","tbl_state_master","id",mysql_result($res,$i,"state")) . ', ';
																				}
																				if (mysql_result($res,$i,"country")) {
																					echo GetSingleField("country","tbl_country_master","id",mysql_result($res,$i,"country"));
																				}
																			?>&nbsp;</td><?
																			}
																			?>															
																		</tr>	
																<? } else if ($key == "height") {
																		?>
																			<tr>
																				<td width="150" bgcolor="#FFFFFF"><?=$value?></td>
																				<? 
																				for ($i = 0; $i < mysql_num_rows($res); $i++) {
																				 ?>	
																					<td bgcolor="#FFFFFF"><?=mysql_result($res,$i,$key)?> ft&nbsp;</td>
																				<?
																					}
																				?>														
																			</tr>
																<? } else { ?>
																		<tr>
																			<td width="150" bgcolor="#FFFFFF"><?=$value?></td>
																			<? 
																			for ($i = 0; $i < mysql_num_rows($res); $i++) {
																			 ?>	
																				<td bgcolor="#FFFFFF">
																				<? if ($key == 'username') { ?>	
																					<? echo '<a href="view_member_profile.php?userid='.mysql_result($res,$i,$key).'" class="idclr">'. mysql_result($res,$i,$key) . '</a>'; ?>&nbsp;
																				<? } else if ($key == 'name') { ?>	
																					<b><?=mysql_result($res,$i,$key)?></b>&nbsp;
																				<? } else { ?>
																					<?=mysql_result($res,$i,$key)?>&nbsp;
																				<? } ?>	
																				</td>
																			<?
																			}
																			?>														
																		</tr>
																<? }														
															}									
														} ?>
												<?	}
													?>
												</table>
												</td>
											</tr>
											<tr><td align="right"><a href="javascript:history.back();">Back To Search</a></td></tr>
							</table>
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
