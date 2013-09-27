<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
$linkid=db_connect();
$arg="advertisement_status";
isAdmin($arg);



if($_REQUEST['mode']=="Save"){	

	$total_domain=($_REQUEST['ChkDomain']);
	foreach($total_domain as $key=>$value){
		$str_domain.=$value.",";
	}

	$len=strlen($str_domain);
	$str_domain=substr($str_domain,0,$len-1);			
	
	if ($HTTP_POST_FILES['txtImage']['name']!=""){
		$image_name = post_img($HTTP_POST_FILES['txtImage']['name'], $HTTP_POST_FILES['txtImage']['tmp_name'],"../ad_banner_images");		
	}
	$sql_insert="insert into tbl_advertisements(banner_title,banner_image,website_url,created_date,domains_show,banner_display_type,posted_by)";
	$sql_insert.=" values('".$_REQUEST['txtTitle']."','".$image_name."','".$_REQUEST['txtWebsiteURL']."',CURRENT_DATE(),'".$str_domain."','".$_REQUEST['rdBannerTop']."','".$_SESSION['user_id']."') ";	
	mysql_query($sql_insert);
	echo mysql_error();
	$_SESSION['_msg']="Advertisement saved successfully";
?>
	<script language="javascript">window.location.href="add_advertisements.php";</script>
<?
die();		
}

if($_REQUEST['banner_id']!=""){
	$sql="select * from tbl_advertisements where auto_id='".$_REQUEST['banner_id']."'";
	$res=mysql_query($sql);
	if(mysql_num_rows($res)>0){
		$obj=mysql_fetch_object($res);
	}
}

if($_REQUEST['mode']=="Update"){		
		
	$total_domain=($_REQUEST['ChkDomain']);
	foreach($total_domain as $key=>$value){
		$str_domain.=$value.",";
	}
	
	$len=strlen($str_domain);
	$str_domain=substr($str_domain,0,$len-1);							
	
	if ($HTTP_POST_FILES['txtImage']['name']!=""){
		$image_name = post_img($HTTP_POST_FILES['txtImage']['name'], $HTTP_POST_FILES['txtImage']['tmp_name'],"../ad_banner_images");		
		removeFile("../ad_banner_images".$_REQUEST['txtHidImage']);	
		$sql_update="update tbl_advertisements set banner_title='".$_REQUEST['txtTitle']."',banner_image='".$image_name."',website_url='".$_REQUEST['txtWebsiteURL']."',domains_show='".$str_domain."',banner_display_type='".$_REQUEST['rdBannerTop']."' where auto_id=".$_REQUEST['banner_id'];
		mysql_query($sql_update);
		echo mysql_error();	
	}else{		
		$sql_update="update tbl_advertisements set banner_title='".$_REQUEST['txtTitle']."',website_url='".$_REQUEST['txtWebsiteURL']."',domains_show='".$str_domain."',banner_display_type='".$_REQUEST['rdBannerTop']."' where auto_id=".$_REQUEST['banner_id'];
		mysql_query($sql_update);
		echo mysql_error();	
	}
	$_SESSION['_msg']="Advertisement updated successfully";	
?>
<script language="javascript">window.location.href="view_advertisements.php";</script>
<?
die();	
}


?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript">

function notImage_SWF_File(obj,msg){
	var exp = /^.+\.(jpg|gif|jpeg|JPG|JPEG|GIF|PNG|png|swf|SWF)$/;
	if (!exp.test((obj.value).toLowerCase())){
		alert("Please choose jpg/gif/swf file for "+msg);
		obj.focus();
		return true;
	}else
		return false;
}


function fnValidate(){ 			
	if(isNull(document.thisForm.txtTitle,"Banner title")){return false;}
	if(document.thisForm.txtHidImage.value==""){
		if(isNull(document.thisForm.txtImage,"Banner image")){return false;}
		if(notImage_SWF_File(document.thisForm.txtImage,"Banner upload")){return false;}
	 }else{
	 		if(document.thisForm.txtImage.value!=""){	
	 			if(notImage_SWF_File(document.thisForm.txtImage,"Banner upload")){return false;}
			}
	 } 
	 
	 if(notChecked(document.thisForm.elements['ChkDomain[]'],"Any one Domains to apply")){return false;}
	
}


</script>
</head>
<body>
<!--		Start : Main Table		-->
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%" align="center">
<tr><td width="100%" height="20" colspan="3" align="center"><img src="images/spacer.gif" border="0" height="20"></td></tr>
<tr>
	<td width="20" height="100%"><img src="images/spacer.gif" border="0" width="20"></td>
	<td width="100%" height="100%" valign="top">
		<table cellpadding="0" cellspacing="0" border="1" width="100%" height="100%" class="tmain" bordercolor="#000000" style="border:thin;">
		<tr>
			<td>
				<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
				
				<!-- Start : Header  -->
				<tr><td><script language="JavaScript">fnHeader();</script></td></tr>
				<!-- End : Header  -->
				
				<!-- Start : Menu -->
				<tr><td><script language="JavaScript">fnMenu();</script></td></tr>
				<!-- End : Menu -->
				
				<!-- Start : Title -->
				<tr class="titlebg"><td>
					<table cellpadding="0" cellspacing="0" border="0" width="98%" height="22" align="center">
					<tr>
						<td class="title">Welcome <font class="session"><? echo $_SESSION['_user']?></font></td>
						<td align="right" class="session"><? echo $_SESSION['_msg'];?><? $_SESSION['_msg'] = "";?></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Title -->
				
				<tr><td><img src="images/spacer.gif" border="0" width="1" height="1"></td></tr>
				
				<!-- Start : Sub Title -->
				<tr class="subtitlebg"><td>
					<table cellpadding="0" cellspacing="0" border="0" width="98%" height="22" align="center">
					<tr>
						<td class="subtitle">Manage Advertisements</td>
						<td align="right"><a href="view_advertisements.php">View Advertisements</a></td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
				<?
					if($_REQUEST['banner_id']==""){
						$secMode="Save";
					}else{
						$secMode="Update";
					}
				?>
				<form name="thisForm" method="post" onSubmit="return fnValidate();" action="add_advertisements.php?mode=<? echo $secMode;?>&banner_id=<? echo $_REQUEST['banner_id']?>" enctype="multipart/form-data">
				<input type="hidden" name="banner_id" value="<? echo($_REQUEST['banner_id']);?>">					
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="520">
						<tr><td>
							<table cellpadding="10" cellspacing="1" border="0" width="500" class="tblBorder">
							<tr class="tblHead"><td align="center"><b>
								<?
								if ($_REQUEST["banner_id"]!=""){
									echo "Update Advertisement";
								} else {
									echo "Add Advertisement";
								}
								?>
							</b></td></tr>
							<tr class="tblContent"><td>
								<table cellpadding="5" cellspacing="1" border="0" width="500" class="tblBorder">								
									<tr class="tblContent">
										<td>Banner Title <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtTitle" class="txtbox" maxlength="255" value="<? echo $obj->banner_title;?>"></td>
									</tr>
									<tr class="tblContent">
										<td>Banner Image <font color="#FF0000">*</font></td>
										<td><input type="file" name="txtImage" class="txtbox"> <br><input type="hidden" name="txtHidImage" value="<? echo $obj->banner_image;?>">
										<font color="#FF0000">**</font> <font color="#999999">Banner must be (367 x 73px) or (539 x 117px) size </font>  </td>
									</tr>
									<tr class="tblContent">
										<td>Website URL </td>
										<td><input type="text" name="txtWebsiteURL" class="txtbox" maxlength="255" value="<? echo $obj->website_url;?>"><br><font color="#999999">For Ex. www.websiteurl.com</font></td>
									</tr>
									<tr class="tblContent">
										<td valign="top" width="180">Select the Domains to apply <font color="#FF0000">*</font></td>
										<td valign="top">
										<?
										$domains=$obj->domains_show;	
											 if($domains!=""){		
											 	$sqls="select 0 in($domains)";
												$res_if=mysql_query($sqls);										
												$rs_if = mysql_fetch_row($res_if);
												if($rs_if[0]>0){													
										?>
											<input type="checkbox" name="ChkDomain[]" value="0" checked="checked"> <strong>India Matrimony</strong> <br>
										 <?
										  }else{										 
										 ?>
										 		<input type="checkbox" name="ChkDomain[]" value="0"> <strong>India Matrimony</strong> <br>
										 <?
										  }
										  }else{
										 ?>
										 	<input type="checkbox" name="ChkDomain[]" value="0"> <strong>India Matrimony</strong> <br>
										 <?
										  }
										 ?>
										
										<?
											$sql_in="select * from tbl_domain_master order by id asc";
											$res_in=mysql_query($sql_in);
											if(mysql_num_rows($res_in)>0){		
											
										
											 while($obj_in=mysql_fetch_object($res_in)){	
											  if($domains!=""){		
											 	$sqls="select $obj_in->id in($domains)";
												$res_if=mysql_query($sqls);										
												$rs_if = mysql_fetch_row($res_if);
												if($rs_if[0]>0){
											?>
												<input type="checkbox" name="ChkDomain[]" value="<? echo $obj_in->id?>" checked="checked"> <? echo $obj_in->domain;?> Matrimony <br>		
											<?  
											}else{
											?>
												<input type="checkbox" name="ChkDomain[]" value="<? echo $obj_in->id?>"> <? echo $obj_in->domain;?> Matrimony <br>		
											<?
											}
											}else{
											?>
												<input type="checkbox" name="ChkDomain[]" value="<? echo $obj_in->id?>"> <? echo $obj_in->domain;?> Matrimony <br>		
											<?
											}
												
												}//while loop
											}//if loop	
											?>
										</td>
									</tr>
									
									<tr class="tblContent">
										<td valign="top">Banner Display Position <font color="#FF0000">*</font> </td>
										<td>
										<? if($_REQUEST['banner_id']!=""){?>									
											<input type="radio" name="rdBannerTop" value="1" <? if($obj->banner_display_type==1){ echo "checked=checked"; }?> > ROS TOP BANNER <br>
											<input type="radio" name="rdBannerTop" value="2" <? if($obj->banner_display_type==2){ echo "checked=checked"; }?>> SEARCH TOP <br>
											<input type="radio" name="rdBannerTop" value="3" <? if($obj->banner_display_type==3){ echo "checked=checked"; }?>>  SEARCH LEFT <br>
											<input type="radio" name="rdBannerTop" value="4" <? if($obj->banner_display_type==4){ echo "checked=checked"; }?>> LOGOUT PAGE <br>
											<input type="radio" name="rdBannerTop" value="5" <? if($obj->banner_display_type==5){ echo "checked=checked"; }?>> PHOTO VIEW PAGE<br>
											<input type="radio" name="rdBannerTop" value="6" <? if($obj->banner_display_type==6){ echo "checked=checked"; }?> > WEDDING DIRECTORY TOP <br>
											<!--<input type="radio" name="rdBannerTop" value="7" <? //if($obj->banner_display_type==7){ echo "checked=checked"; }?>> BOTTOM <br>-->
											<input type="radio" name="rdBannerTop" value="8" <? if($obj->banner_display_type==8){ echo "checked=checked"; }?>> HOME PAGE TOP BANNER <br>
											<input type="radio" name="rdBannerTop" value="0" <? if($obj->banner_display_type==0){ echo "checked=checked"; }?>> HOME PAGE RIGHT BOTTOM  <br>
										<? }else{?>
											<input type="radio" name="rdBannerTop" value="1"  checked="checked"> ROS TOP BANNER <br>
											<input type="radio" name="rdBannerTop" value="2"> SEARCH TOP <br>
											<input type="radio" name="rdBannerTop" value="3"> SEARCH LEFT <br>
											<input type="radio" name="rdBannerTop" value="4"> LOGOUT PAGE <br>
											<input type="radio" name="rdBannerTop" value="5"> PHOTO VIEW PAGE<br>
											<input type="radio" name="rdBannerTop" value="6"> WEDDING DIRECTORY TOP <br>
											<!--<input type="radio" name="rdBannerTop" value="7"> BOTTOM <br>-->
											<input type="radio" name="rdBannerTop" value="8"> HOME PAGE TOP BANNER <br>
											<input type="radio" name="rdBannerTop" value="0"> HOME PAGE RIGHT BOTTOM   <br>
										<? }?>
										
										</td>
									</tr>
									
									<tr class="tblContent">
										<td align="center" height="30" colspan="2">
											<input type="submit" value="Save" class="butten">
										</td>
									</tr>
								</table>
							</td></tr>
							</table>
						</td></tr>
						</table>
				 	</td></tr>
					<tr><td height="10"></td></tr>
			 		</table>
		 		</form>
				<!-- End : Table Of Contents -->
		 		</td></tr>
	 			</table>
				<br>
			</td>
		</tr>
		</table>
	</td>
	<td width="20" height="100%"><img src="images/spacer.gif" border="0" width="20"></td>
</tr>
<tr><td width="100%" height="20" colspan="3" align="center"><img src="images/spacer.gif" border="0" height="20"></td></tr>
</table>
<!--		End : Main Table		-->
</body>
</html>
<?
function convertdate($date)
{
	$lastdt=explode("/",$date);
	$lastdate=$lastdt[2]."-".$lastdt[1]."-".$lastdt[0];
	return $lastdate;
}
?>