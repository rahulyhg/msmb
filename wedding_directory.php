<?php
ob_start();
session_start();
include("includes/lib.php");
include("includes/paging.php");
	$sql_category="select * from tbl_wedding_category where parent_category=2 order by category_name asc";
	$res_category=mysql_query($sql_category);
	if(mysql_num_rows($res_category)>0){
		while($obj_category=mysql_fetch_object($res_category)){
			$strCategory.="<option value=".$obj_category->category_id.">".$obj_category->category_name."</option>";
		}		
	}
	$sql_city="select * from tbl_wedding_category where parent_category=1 order by category_name asc ";
	$res_city=mysql_query($sql_city);
	if(mysql_num_rows($res_city)>0){
		while($obj_city=mysql_fetch_object($res_city)){
			$strCity.="<option value=".$obj_city->category_id.">".$obj_city->category_name."</option>";
		}		
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

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function fnGetlink(Fname){
	window.open(Fname,'','width=520,height=250,scrollbars=yes,status=no,toolbar=no,top=30,left=240');
} 
function fnvalidate(){
	if(notSelected(document.thisForm.cmbCategory,"Category")) return false
	document.thisForm.action="wedding_directory.php?cmbCategory="+document.thisForm.cmbCategory.value+"&cmbCity="+document.thisForm.cmbCity.value;
	document.thisForm.submit();
}
//-->
</script>
</head>
<body class="homeinbody" onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
<div class="menuleftimg">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
    <td align="right"><? fnBannerImage('widding_directory','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>  
  <tr>
    <td colspan="2" valign="top">
	<table width="584" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td valign="top" align="right">
			<div style="padding:12px 0px 0px 0px;"> 
				<table cellpadding="0" cellspacing="0" align="right" border="0" width="182" bgcolor="#f4e4b4">
					<tr>
						<td class="wedpad">
							<table cellpadding="5" cellspacing="0" border="0" width="100%" bgcolor="#FFFFFF">
							<?
								  $sql_list_cat="select * from tbl_wedding_category where parent_category=2 order by category_name asc";
								  $res_list_cat=mysql_query($sql_list_cat);
								  if(mysql_num_rows($res_list_cat)>0){
									  while($obj_list_cat=mysql_fetch_object($res_list_cat)){
								  ?>
									 <tr>
											<td align="left" width="75%" style="padding-left:15px; border-bottom:#f4e4b4 1px solid;">
										<a href="wedding_directory.php?cmbCategory=<?=$obj_list_cat->category_id; ?>" class="widding_menu"><?=$obj_list_cat->category_name;?></a></span>												</td>
									</tr>
									
								  <? 
									 }//while
								   }//if
								  ?>
							</table>
						</td>
					</tr>
				</table>
			</div>		</td>
		<td valign="top">
			<div style="padding:9px 0px 0px 7px; width:561px;">
		    <form name="thisForm" method="get" >
			<table width="561" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td>
					<table width="100%">
						<tr>
						<td>
					<div class="titlebg"><h1 class="title">Wedding Directory</h1></div>						</td>
						<td align="right" class="title">					
						 <? if ($config[userinfo]) { ?>					
							<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
						<? } else { ?>						
							<a href="index.php" class="lout">Home</a></strong>&nbsp; |&nbsp; <a href="member_login.php?mode=member" class="idclr">Login</a>
						<? } ?>						</td>
						
					</table>					
				</td>					
			  </tr>
			  <tr>
				<td colspan="2" height="5"></td>
			  </tr>
			  <tr>
				<td colspan="2" style="padding:5px;" bgcolor="#fffacd">
					<font color="#8f830d"><b>Search A to Z all your wedding needs from your city</b></font><br> 
					Find the best of Jewelers, Mandaps, Decorators, invitation card shops and more.from your city. Wedding Directory will help you make your wedding day an enjoyable and unforgettable experience.
				</td>
			  </tr>
			  <tr>
				<td colspan="2" height="5"></td>
			  </tr>
			  <tr>
			  	<td colspan="2"><img src="images/wedcur_top.jpg"  border="0"></td>
			  </tr>
			  <tr>
			  	<td colspan="2">
				<table cellpadding="0" cellspacing="0" width="561" border="0" bgcolor="#ef8d31" >
						<tr>
							<td width="17%" align="center"><img src="images/wedsearch.gif" border="0"></td>
						  <td width="34%"><select name="cmbCategory" class="wedcmbbox"><option value="">Select Category</option><? echo $strCategory;?></select></td>
						  <td width="33%"><select name="cmbCity" class="wedcmbbox"><option value="">Select City</option><? echo $strCity;?></select> </td>
						  <td align="center" width="16%"><input name="Submit" type="submit" value="Search" onClick="return fnvalidate();" class="wedbutton"></td>
						</tr>
					</table>				</td>
			  </tr>
			  <tr>
			  	<td colspan="2"><img src="images/wedcur_bottom.jpg"  border="0"></td>
			  </tr>
			  <tr><td height="19" colspan="2">&nbsp;</td></tr>
			   <? if(($_REQUEST['cmbCategory']!="") or ($_REQUEST['cmbCity']!="")){	?>
								<script language="javascript">
									document.thisForm.cmbCategory.value="<?=trim($_REQUEST['cmbCategory'])?>"
									document.thisForm.cmbCity.value="<?=trim($_REQUEST['cmbCity'])?>"
								</script>
				<? } ?>
				 <? //if($_REQUEST['cmbCategory']!=""){?>
				
				<?					
				
				if($_REQUEST['cmbCategory']!=""){
					$sql_select="select * from tbl_wedding_directory where wedding_category_id='".$_REQUEST['cmbCategory']."'";					
				}
				if($_REQUEST['cmbCity']!=""){
					$sql_select.="AND wedding_city_id='".$_REQUEST['cmbCity']."' ";
				}
				if(($_REQUEST['cmbCategory']=="") and ($_REQUEST['cmbCity']=="")){
					/*$sql_select="select * from tbl_wedding_directory where wedding_category_id='".$_REQUEST['cmbCategory']."'";
					$sql_select.="AND wedding_city_id='".$_REQUEST['cmbCity']."' ";*/
					$sql_select="select * from tbl_wedding_directory where 1=1 ";
				}
					$sql_select.="AND 1=1 and status = 1 order by sequence asc";			
					$res_select=mysql_query($sql_select);														 
					$n=mysql_num_rows($res_select);
					 //pager starts Here
						if($_REQUEST['page']=="")
							$page=1;
						else
							$page=$_REQUEST['page'];
							$total	=	$n;
							$limit	=	10;
							$pager	=	Pager::getPagerData($total, $limit, $page);
							$offset	=	$pager->offset;
							$limit	=	$pager->limit;
							$page	= 	$pager->page;
					//pager ends Here
						$resultrs=mysql_query($sql_select." limit  $offset, $limit"); 
					 	if($n>0)
					  	{
							$sno=1;
							if ($page!=1)
							{
									$sno = ($limit*($page-1)+1);
							} else {
								$sno=1;
							}	
					    while($obj_select=mysql_fetch_object($resultrs)){
						  ?>
			  
			  <tr>
			  	<td>
					<table cellpadding="0" cellspacing="0" width="561" border="0" style="border:1px solid #888349;">
						<tr> 
							<td class="weddir" style="padding:5px 0px 10px 10px;" valign="top">
								<? if($obj_select->web_address!=""){ ?>
								<a href="<?=$obj_select->web_address?>" target="_blank" class="wedapp"><?=$obj_select->shop_name;  ?></a>
								<? } else  { ?>
									<b class="sums"><?=$obj_select->shop_name;  ?></b>
								<? } ?>
								<br><b>Ph :</b> <?=$obj_select->contact_phone; ?>  <br><b>Address :</b> <br> <?=str_replace(chr(13),"<br>",$obj_select->shop_address);?></td>
								<td align="right" style="padding:5px;">
								<? if($obj_select->image!=""){?>								
								<a href="<? if($obj_select->web_address!=""){ echo $obj_select->web_address;} else{ echo "#";} ?>" target="_blank">
								<img src="wedding_directory_images/<? echo $obj_select->image;?>" width="100" height="115" style="border:#000000 1px solid; padding:5px;" border="0">								
								</a>
								<? }?>
								</td>
						</tr>
						<tr>
							<td bgcolor="#f0edd4" colspan="2" align="left" style="padding:5px 10px 5px 10px;" class="weddir">
																<div style="float:right; width:100px;"><img src="images/rev_bull.gif" border="0">&nbsp;<a href="javascript:fnGetlink('show_shop_details.php?id=<?=$obj_select->directory_id;?>')" class="more">Read more &raquo;</a> </div>
								<? if($obj_select->description!="") { ?>
								<strong>Description :</strong>
								<? $next=substr($obj_select->description,50,strlen($obj_select->description)); $spacepos=strpos($next," "); echo substr($obj_select->description,0,50+$spacepos); ?><? } ?></td>
						</tr>
					</table>				</td>
			</tr>
			<tr><td height="10">&nbsp;</td></tr>
			<?  }
			 }else {//if 
		   ?>
			<tr><td align="center" height="25" width="430">No Details Found...</td>
			  </tr>
		   <? } ?>
			 
			<tr>
				<td height="27"  class="weddir">
					<table cellpadding="0" cellspacing="0" border="0" align="left" width="561" bgcolor="#e48931">
						<tr><td style="padding-left:5px;" bgcolor="#e48931"> 
					<font color="#FFCC00"><? getpageNumbers($pager->numPages,$page,"wedding_directory.php","cmbCategory",$_REQUEST['cmbCategory'],"cmbCity",$_REQUEST['cmbCity'],$limit,$total);?> </font>
						</td></tr>
								</table></td></tr>

				<? //}?>			
			</table>
			</form>
		</div>
		</td>
	  </tr>
	</table>
	</td>
  </tr>
  <tr><td colspan="2" height="30"></td></tr>
  <tr>
  <td colspan="2"><? 
		  		//include("includes/community_search.php");
		  		include("includes/fotter.php") ?></td>
  </tr>
</table>
<div>
</body>
</html>
