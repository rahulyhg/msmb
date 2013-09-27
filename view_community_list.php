<?php
ob_start();
session_start();
include("includes/lib.php");
include("includes/paging.php");
$action = GetVar("action");
if ($_SESSION['userid']) {
	$user = GetSingleRecord("tbl_register","username",$_SESSION['userid']);
	if ($user[gender] == "M") $sex="gender=F";
	if ($user[gender] == "F") $sex="gender=M";
}
	if($sex=="") {
		if($_REQUEST["domain"]!="")
			$sex.="domain=".$_REQUEST["domain"]."&";
		if($_REQUEST["caste"]!="")
			$sex.="caste=".$_REQUEST["caste"]."&";
		if($_REQUEST["religion"]!="")
			$sex.="religion=".$_REQUEST["religion"]."&";
		if($_REQUEST["education"]!="")
			$sex.="education=".$_REQUEST["education"];
		}	
	else{
		if($_REQUEST["domain"]!="")
			$sex.="&domain=".$_REQUEST["domain"];
		if($_REQUEST["caste"]!="")
			$sex.="&caste=".$_REQUEST["caste"];	
		if($_REQUEST["religion"]!="")
			$sex.="&religion=".$_REQUEST["religion"];
		if($_REQUEST["education"]!="")
			$sex.="&education=".$_REQUEST["education"];
		}	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" rel="stylesheet" type="text/css"/>
<link href="includes/community.css" type="text/css" rel="stylesheet"/>
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

	var newwindow="";
	function poptastic(url){
	newwindow=window.open(url,'name','height=500,width=280,left=20,top=20,toolbar=no,menubar=no,directories=no,location=no,scrollbars=yes,status=no,resizable=yes,fullscreen=no');
	if (window.focus) {newwindow.focus()}
	}
	
	function fnDisplay(){
		if(document.thisForm.cmbPaymentMode.value!=""){
			
			if(document.thisForm.cmbPaymentMode.value=="Cheque"){
				document.getElementById("tblCheque").style.display="block";
				document.getElementById("tblMoney").style.display="none";								
			}else if(document.thisForm.cmbPaymentMode.value=="Money_order"){
				document.getElementById("tblCheque").style.display="none";
				document.getElementById("tblMoney").style.display="block";								
			}						
		}
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
    <td align="right"><img src="images/top_banner.jpg"/></td>
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
			<div style="padding:10px 20px 0px 0px; width:573px; float:right;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<table width="100%">
						<tr>
							<td>
							<div class="titlebg">
							  <h1 class="title">Community Search </h1>
							</div>
							</td>
							<td align="right">
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
				<td>&nbsp;</td>
			  </tr>
			  <tr>
					    <td width="592" rowspan="4" valign="top">
						<table border="0" width="400" cellpadding="5"   cellspacing="1">																			
						<tr>
							<td align="left"><b class="clr"><?=$_SESSION['msg']?><? $_SESSION['msg'] = ""; ?> </b></td>
						 </tr>
						 <tr bgcolor="#FFFFFF">
							<td>
									<?	
									if(GetVar("mode")=="cast") {
									$sql = "select a.caste,d.domain,d.id,a.religionid,a.id as caste_id from tbl_caste_master a, tbl_religion_master b, tbl_domain_master d where a.religionid=b.id and b.domain=d.id order by domain,caste";
									$res = mysql_query($sql);	
									echo mysql_error();
									$no = mysql_num_rows($res);
									//search limit
									if(!is_numeric($iResultsLimit))	{
										$iResultsLimit = 20;
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
									 $sql .= "  limit $iResultsLower , $iResultsLimit";
											//pager starts Here
												$iTotalRows = $no;							
										?>
										<form name="thisForm1" method="get">	
										<input type="hidden" name="iPageNum" value="<?=$iPageNum?>">
										<input type="hidden" name="iResultsLimit" value="<?=$iResultsLimit?>">
										<input type="hidden" name="mode" value="<?=GetVar("mode")?>">
										<?
										//pager ends Here
										$res = mysql_query($sql); 
										if ($no > 0) {
											$rCnt=1;	
										?>
									<table cellpadding="5" cellspacing="1" border="0" width="500" bgcolor="#ececec">
											
											<tr>
												<td colspan="3" bgcolor="#ffbf00"><b style="color:#dd1a16">Caste</b></td>
											</tr>
										<?
											if ($page!=1){
												$rCnt = ($limit*($page-1)+1);
											} else {
												$rCnt=1;
											}
											while($rs=mysql_fetch_object($res)){  ?>
											<tr>
												<td bgcolor="#FFFFFF" width="80">
													<a  class="castin" href="view_community_list.php?mode=occupation&domain=<?=$rs->id?>&caste=<?=$rs->caste_id?>&<?=$sex?>"><?=$rs->domain?></a>
												</td>
												<td bgcolor="#FFFFFF" width="40">
													&nbsp; - &nbsp;
												</td>
												<td bgcolor="#FFFFFF">
													<a  class="castin" href="view_community_list.php?mode=occupation&domain=<?=$rs->id?>&caste=<?=$rs->caste_id?>&<?=$sex?>"><?=$rs->caste?></a>
												</td>
											 </tr>	

											<?
												$rCnt++;
											} 
											?><table >
							<tr><td >
						<? 	echo "Page";
							echo  do_pages1($iTotalRows, $iResultsLimit); ?>
							
												

							</td></tr>
											</table>			
										<?	}
									?>
									</tr></table>
									</form>	
									</td>		
								<? } ?>		
								
								<?	
									if(GetVar("mode")=="occupation") {
									$sql = "select *  from tbl_occupation_master order by occupation";
									$res = mysql_query($sql);	
									echo mysql_error();
									$no = mysql_num_rows($res);
									//search limit
									if(!is_numeric($iResultsLimit))	{
										$iResultsLimit = 40;
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
									 $sql .= "  limit $iResultsLower , $iResultsLimit";
											//pager starts Here
												$iTotalRows = $no;							
										?>
										<form name="thisForm1" method="get">	
										<input type="hidden" name="iPageNum" value="<?=$iPageNum?>">
										<input type="hidden" name="iResultsLimit" value="<?=$iResultsLimit?>">
										<input type="hidden" name="mode" value="<?=GetVar("mode")?>">
										<input type="hidden" name="domain" value="<?=$_REQUEST["domain"]?>">
										<input type="hidden" name="caste" value="<?=$_REQUEST["caste"]?>">
										<input type="hidden" name="religion" value="<?=$_REQUEST["religion"]?>">
										<input type="hidden" name="education" value="<?=$_REQUEST["education"]?>">
										<?
										//pager ends Here
										$res = mysql_query($sql); 
										if ($no > 0) {
											$rCnt=1;	
										?>
											<table cellpadding="5" cellspacing="1" border="0" width="500" bgcolor="#ececec">
											
											<tr>
												<td colspan="3" bgcolor="#ffbf00"><b style="color:#dd1a16"><b>Occupation</b></td>											
											</tr>
										<?
											if ($page!=1){
												$rCnt = ($limit*($page-1)+1);
											} else {
												$rCnt=1;
											}
											$i=1;
											while($rs=mysql_fetch_object($res)){  ?>
											<? if($i==1) { ?>
											<tr>
												<td bgcolor="#FFFFFF" width="80"><a   class="castin"  href="search.php?action=search&occupation=<?=$rs->id?>&<?=$sex?>"><?=$rs->occupation?></a></td>
											<? 
												$i=0;
												} else { ?>
											<td width="250"><a  class="cast" href="search.php?action=search&occupation=<?=$rs->id?>&<?=$sex?>"><?=$rs->occupation?></a></td>
											 </tr>	
											<? 	$i=1;
											 } 
												$rCnt++;
											} 
											 if($i==0) { ?>
											<td></td></tr>
										<? } ?><table >
												<tr><td >
											<? 	echo "Page";
												echo  do_pages1($iTotalRows, $iResultsLimit); ?>
												
																	

												</td></tr>
											</table>			
										<?	}
									?>
									</tr></table>
									</form>	
									</td>		
								<? } ?>	
								
								<?	
									if(GetVar("mode")=="religion") {
									$sql = "select d.domain,d.id as domain_id ,b.religion,b.id from  tbl_religion_master b, tbl_domain_master d where b.domain=d.id";
									$sql . " group by religion";
									$res = mysql_query($sql);	
									echo mysql_error();
									$no = mysql_num_rows($res);
									//search limit
									if(!is_numeric($iResultsLimit))	{
										$iResultsLimit = 20;
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
									 $sql .= "  limit $iResultsLower , $iResultsLimit";
											//pager starts Here
												$iTotalRows = $no;							
										?>
										<form name="thisForm1" method="get">	
											<input type="hidden" name="iPageNum" value="<?=$iPageNum?>">
											<input type="hidden" name="iResultsLimit" value="<?=$iResultsLimit?>">
											<input type="hidden" name="mode" value="<?=GetVar("mode")?>">
										<?
										//pager ends Here
										$res = mysql_query($sql); 
										if ($no > 0) {
											$rCnt=1;	
										?>
											<table cellpadding="5" cellspacing="1" border="0" width="500">
											
											<tr>
<!--												<td width="50"><b>Domain</b></td>
-->												<td width="50"><b>Religion</b></td>
												<!--<td width="50"><b>Caste</b></td>-->
											</tr>
										<?
											if ($page!=1){
												$rCnt = ($limit*($page-1)+1);
											} else {
												$rCnt=1;
											}
											while($rs=mysql_fetch_object($res)){  ?>
											<tr>
												<td width="250"><a  class="cast" href="view_community_list.php?mode=occupation&domain=<?=$rs->domain_id?>&religion=<?=$rs->id?>&<?=$sex?>"><?=$rs->domain?></a>&nbsp; - &nbsp; <a  class="cast" href="view_community_list.php?mode=occupation&domain=<?=$rs->domain_id?>&religion=<?=$rs->id?>&<?=$sex?>"><?=$rs->religion?></a></td>
<!--												<td width="250"><a  class="cast" href="search.php?action=search&domain=<?=$rs->domain_id?>&religion=<?=$rs->id?>"><?=$rs->religion?></a></td>
-->											 </tr>	

											<?
												$rCnt++;
											} 
											?><table >
												<tr><td >
											<? 	echo "Page";
												echo  do_pages1($iTotalRows, $iResultsLimit); ?>
												
																	

												</td></tr>
											</table>			
										<?	}
									?>
									</tr></table>
									</form>	
									</td>		
								<? } ?>		
								<?	
									if(GetVar("mode")=="education") {
									$sql = "select *  from tbl_education_master order by education";
									$res = mysql_query($sql);	
									echo mysql_error();
									$no = mysql_num_rows($res);
									//search limit
									
									if(!is_numeric($iResultsLimit))	{
										$iResultsLimit = 40;
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
									 $sql .= "  limit $iResultsLower , $iResultsLimit";
											//pager starts Here
												$iTotalRows = $no;							
										?>
										<form name="thisForm1" method="get">	
											<input type="hidden" name="iPageNum" value="<?=$iPageNum?>">
											<input type="hidden" name="iResultsLimit" value="<?=$iResultsLimit?>">
											<input type="hidden" name="mode" value="<?=GetVar("mode")?>">
										<?
										//pager ends Here
										$res = mysql_query($sql); 
										if ($no > 0) {
											$rCnt=1;	
										?>
											<table cellpadding="5" cellspacing="1" border="0" width="500">
											
											<tr>
												<td width="250"><b>Education</b></td>
												<td width="250"><b></b></td>
											</tr>
										<?
											if ($page!=1){
												$rCnt = ($limit*($page-1)+1);
											} else {
												$rCnt=1;
											}
											$i=1;
											while($rs=mysql_fetch_object($res)){  ?>
											
											<? if($i==1) { ?>
												<tr>
												<td width="250"><a  class="cast" href="view_community_list.php?mode=occupation&education=<?=$rs->id?>&<?=$sex?>"><?=$rs->education?></a></td>
											<? 
												$i=0;
												} else { ?>
												<td width="250"><a  class="cast" href="view_community_list.php?mode=occupation&education=<?=$rs->id?>&<?=$sex?>"><?=$rs->education?></a></td>
												</tr>
											<? 	$i=1;
											 } 
												$rCnt++;
											} 
											 if($i==0) { ?>
											<td></td></tr>
										<? } ?><table cellpadding="0" cellspacing="0" border="0" >
												<tr><td >
											<? 	echo "Page";
												echo  do_pages1($iTotalRows, $iResultsLimit); ?>
												</td></tr>
											</table>			
										<?	}
									?>
									</tr></table>
									</form>	
									</td>		
								<? } ?>		
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
