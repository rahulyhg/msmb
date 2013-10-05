<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
$mode = GetVar("mode");
//print_r($_REQUEST);

if ($mode == "advance") {

	//extract($_REQUEST,EXTR_REFS);
	if ($_REQUEST['partnerDomain']) {	
		if (is_array($_REQUEST['partnerDomain'])) {
			$partnerDomain = $_REQUEST['partnerDomain'];
		} else {
			$partnerDomain = explode(',',$_REQUEST['partnerDomain']);
		}	
		if ($partnerDomain[0] != 0) {
			$_REQUEST['domain'] = implode("','",$partnerDomain);
			$_REQUEST['partnerDomain'] = $_REQUEST['domain'];		
		} else { $_REQUEST['partnerDomain'] = ''; }
		
	}
	
	if ($_REQUEST['partnerMaritalStatus']) {		
	
		if (is_array($_REQUEST['partnerMaritalStatus'])) {
			$partnerMaritalStatus = $_REQUEST['partnerMaritalStatus'];
		} else {
			$partnerMaritalStatus = explode(',',$_REQUEST['partnerMaritalStatus']);
		}
		
		if ($partnerMaritalStatus[0] != "unspec") {			
			$_REQUEST['maritalStatus'] = implode("','",$partnerMaritalStatus);
			$_REQUEST['partnerMaritalStatus'] = implode(",",$partnerMaritalStatus);
				
		} else {  $_REQUEST['partnerMaritalStatus'] = ''; }				
	}
	
	if ($_REQUEST['partnerEducation']) {
			
		if (is_array($_REQUEST['partnerEducation'])) {
			$partnerEducation = $_REQUEST['partnerEducation'];
		} else {
			$partnerEducation = explode(',',$_REQUEST['partnerEducation']);
		}
		
		if ($partnerEducation[0] != 0) {	
			$_REQUEST['education'] = implode("','",$partnerEducation);
			$_REQUEST['partnerEducation'] = implode(",",$partnerEducation);
		} else {  $_REQUEST['partnerEducation'] = ''; }	
	}
		
	if ($_REQUEST['partnerCitizenship']) {	
	
		if (is_array($_REQUEST['partnerCitizenship'])) {
			$partnerCitizenship = $_REQUEST['partnerCitizenship'];
		} else {
			$partnerCitizenship = explode(',',$_REQUEST['partnerCitizenship']);
		}		
				
		if ($partnerCitizenship[0] != '0') {			
			$_REQUEST['citizenship'] = implode("','",$partnerCitizenship);			
			$_REQUEST['partnerCitizenship'] = implode(",",$partnerCitizenship);
			
		} else {  $_REQUEST['partnerCitizenship'] = ''; }			
		
	}
	 	
	if ($_REQUEST['partnerResidingCountry']) {
	
		if (is_array($_REQUEST['partnerResidingCountry'])) {
			$partnerResidingCountry = $_REQUEST['partnerResidingCountry'];
		} else {
			$partnerResidingCountry = explode(',',$_REQUEST['partnerResidingCountry']);
		}	
		
		if ($partnerResidingCountry[0] != 0) {	
			$_REQUEST['residingCountry'] = implode("','",$partnerResidingCountry);
			$_REQUEST['partnerResidingCountry'] = implode(",",$partnerResidingCountry);
			
		} else { $_REQUEST['residingCountry'] = ''; } 	
	}
	
	if ($_REQUEST['partnerResidingState']) {
	
		if (is_array($_REQUEST['partnerResidingState'])) {
			$_REQUEST['residingState'] = implode("','",$_REQUEST['partnerResidingState']);
			$_REQUEST['partnerResidingState'] = implode(",",$_REQUEST['partnerResidingState']);
		} else {
			$_REQUEST['residingState'] = $_REQUEST['partnerResidingState'];
		}	
		
	}
	
	if ($_REQUEST['partnerResidingCity']) {
	
		if (is_array($_REQUEST['partnerResidingCity'])) {
			$_REQUEST['residingCity'] = implode("','",$_REQUEST['partnerResidingCity']);
			$_REQUEST['partnerResidingCity'] = implode(",",$_REQUEST['partnerResidingCity']);
		} else {
			$_REQUEST['residingCity'] = $_REQUEST['partnerResidingCity'];
		}
	
		//$_REQUEST['residingCity'] = implode("','",$_REQUEST['partnerResidingCity']);
	}
	
	if ($_REQUEST['partnerReligion']) {	
			
		if (is_array($_REQUEST['partnerReligion'])) {
			$partnerReligion = $_REQUEST['partnerReligion'];
		} else {
			$partnerReligion = explode(',',$_REQUEST['partnerReligion']);
		}	
		
				
		if ($partnerReligion[0] != 0) {			
			$_REQUEST['religion'] = implode("','",$partnerReligion);
			$_REQUEST['partnerReligion'] = implode(",",$partnerReligion);
			
		} else {
			$_REQUEST['partnerReligion'] = '';
		}	
		
	}
	
	/*if ($_REQUEST['caste']) {	
	
		if (is_array($_REQUEST['caste'])) {
			$caste = explode(',',$_REQUEST['caste']);
		} else {
			$caste = $_REQUEST['caste'];
		}	
	}*/
	
	if ($_REQUEST['partnerHaveChild']) {
	
		if (is_array($_REQUEST['partnerHaveChild'])) {
			$partnerHaveChild = $_REQUEST['partnerHaveChild'];
		} else {
			$partnerHaveChild = explode(',',$_REQUEST['partnerHaveChild']);
		}	
			
		if ($partnerHaveChild[0] != "unspec") {	
			$_REQUEST['no_of_Children'] = implode("','",$partnerHaveChild);			
			$_REQUEST['partnerHaveChild'] = implode(",",$partnerHaveChild);
		} else {
			$_REQUEST['partnerHaveChild'] = '';
		}			
	}
	
	if ($_REQUEST['partnerHeightFrom']) {	
		$_REQUEST['fromHeight'] = $_REQUEST['partnerHeightFrom'];
	}
	
	if ($_REQUEST['partnerHeightTo']) {	
		$_REQUEST['toHeight'] = $_REQUEST['partnerHeightTo'];
	}
	
	if ($_REQUEST['partnerPhysicalStatus']) {		
		
		if ($_REQUEST['partnerPhysicalStatus'] != 'unspec') {	
			$_REQUEST['physicalStatus'] = $_REQUEST['partnerPhysicalStatus'];
		}	
	}
	
	if ($_REQUEST['partnerMotherTongue']) {	
		
		if (is_array($_REQUEST['partnerMotherTongue'])) {
			$partnerMotherTongue = $_REQUEST['partnerMotherTongue'];
		} else {
			$partnerMotherTongue = explode(',',$_REQUEST['partnerMotherTongue']);
		}
		
		
		if ($partnerMotherTongue[0] != '0') {				
			$_REQUEST['language'] = implode("','",$partnerMotherTongue);	
			$_REQUEST['partnerMotherTongue'] = implode(",",$partnerMotherTongue);			
		} else  { $_REQUEST['partnerMotherTongue'] = ''; } 	
	}			
}

if ($action == "search") {
	
	//die("aaa");
	extract($_REQUEST,EXTR_REFS);	
	$iResultsLimit = GetVar("iResultsLimit");
		
	$sql = "SELECT * from tbl_register where enable = 1 and verifiedStatus = 1  and hideProfile = 0 and deleteProfile = 0 ";
		
	if (!empty($_REQUEST['domain'])) {		
		$dm =	$_REQUEST['domain'];
		$sql .= "and domain =  $dm ";	
		//$domain_name =  $domain;
	} 
//	else {
//		if ($config["new_domain"]) {
//			$sql .= "and domain in ('".$config["new_domain"]."') ";
//		}			
	//}	
	
	if ($gender) {
		$sql .= "and gender in ('$gender') ";
	}
	
	
	if ($religion) {
		$sql .= "and religion in ('$religion') ";	
		$religion_name =  $religion;	
	}
	
	if (!empty($_REQUEST['caste'])) {
		$a =	$_REQUEST['caste'];
		$sql .= " and caste = $a";
		//$caste_name =  $caste;		
	}
	//else{
//		$sql .= " and caste = '$caste' ";
//		$caste_name =  $caste;
//	}
	
	if ($fromAge) {
		$sql .= " and age >= '$fromAge' ";		
	}
	
	if ($toAge) {
		$sql .= " and age <= '$toAge' ";		
	}
		
	if ($age) {
		$sql .= " and age = '$age' ";
	}
	
	if ($fromHeight) {
		$sql .= "and height >= '$fromHeight' ";		
	}
	
	if ($toHeight) {
		$sql .= "and height <= '$toHeight' ";		
	}
	
	if ($education) {
		$sql .= "and education in ('$education') ";
	}
	
	if ($occupation) {
		$sql .= "and occupation in ('$occupation') ";
	}
	
	if ($citizenship) {	
		$sql .= "and citizenship in ('$citizenship') ";
	}
	
	if ($residingCountry) {	
		$sql .= "and (residingCountry in ('$residingCountry') or  residingCountry_1 in ('$residingCountry')) ";
	}
	
	if ($residingState) {	
		$sql .= "and (residingState in ('$residingState') or residingState_1 in ('$residingState')) ";
	}
	
	if ($residingCity) {	
		$sql .= "and (residingCity in ('$residingCity') or residingCity_1 in ('$residingCity')) ";
	}
	
	if ($country) {	
		$sql .= "and country in ('$country') ";
	}
	
	if ($horoscope) {
		$sql .= "and horoscope != '' ";
	}
	
	if ($no_of_Children) {	
		if ($no_of_Children == "no") {	
			$sql .= "and (isnull(no_of_Children) or no_of_Children = '' or no_of_Children = 'none') ";		
		} else if ($no_of_Children == "yes") {
			$sql .= "and ( no_of_Children = '1' or no_of_Children = '2' or no_of_Children = '3' or no_of_Children = '4 and above') ";
		} else {
			$sql .= "and no_of_children = '$no_of_Children' ";
		}	
	}
	
	if ($physicalStatus) {	
		$sql .= "and physicalStatus = '$physicalStatus' ";				
	}
	
	if ($language) {
		$sql .= "and language in ('$language') ";
	}	
	
	if ($maritalStatus) {
		$sql .= "and maritalStatus in ('$maritalStatus') ";
	}
	
	if ($withPhoto) {
		$ids1 = "";
		$pho_res = mysql_query("select distinct(userid) from tbl_photo where approve = 1");
		if (mysql_num_rows($pho_res)>0) {
			$pho_usrid = array();
			while ($p_rs = mysql_fetch_array($pho_res))	{
				array_push($pho_usrid,$p_rs[0]);					
			}
		}
		for ($j = 0; $j < count($pho_usrid); $j++) {
			$ids1 .= $pho_usrid[$j];
			if ($j == (count($pho_usrid)-1)) {
			} else {
				$ids1 .= ",";
			}
		}
		if (!$ids1) { $ids1=0; }
		$sql .= "and id in ($ids1) ";
	}
	
	if ($config[userinfo]) {
		$sql .= "and id != '" . $config[userinfo][id] . "' ";
	}

	$sql .= "order by id desc ";
	//echo $sql;
	//echo '<!--';
	//echo $sql;
	//echo '-->';
	//die();
	
	//$sql .= "order by lastLogin desc ";
	//$sql .= "order by membership_type desc ";		
	//echo $sql;
	$searchMaxRows = Execute($sql);		
	//search limit
	if(!is_numeric($iResultsLimit))	{
		$iResultsLimit = 5;
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
	$sql .= "limit $iResultsLower , $iResultsLimit";
	
	$searchRes = Execute($sql);	
	
	$user = GetSingleRecord("tbl_register","username",$config[userinfo][username]);	
				
} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/search.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" src="includes/validate.js"></script>
<script language="JavaScript" src="includes/functions.js"></script>

<!--<SCRIPT language=JavaScript src="includes/photoslider.js" type=text/javascript></SCRIPT>-->
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
function fnRemoveTxt()
	{
		if(Trim(document.profile_view.txtid.value)=='' || Trim(document.profile_view.txtid.value)=='View Profile by id')
		{
			document.profile_view.txtid.value=''
		}
	}
function profile_validate() {	
	if(Trim(document.profile_view.txtid.value)=='' || Trim(document.profile_view.txtid.value)=='View Profile by id')
		{
			alert("Please enter the View Profile by id");
			 return false;
		}

}

function paging(i) {
	document.thisForm1.iPageNum.value=i;							
	//document.forms.formSearchWithLimits.action="\search.html?iPageNum="+i;
	document.thisForm1.submit();
}

</script>
</head>
<body class="homeinbody" onLoad="MM_preloadImages('images/epro_btn1_ovr.jpg','images/epro_btn1.jpg','images/logo.jpg','images/search_btn.jpg')">
<div class="menuleftimg">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="354" height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
    <td width="418" align="right"><? fnBannerImage('search','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>  
  <tr>
    <td colspan="2" valign="top">		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td colspan="2" valign="top">
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
			  	<td valign="top"><? include("includes/side_menu.php"); ?></td>		
			  </tr>				  
			</table></td>
			<td valign="top">
		<div style="margin:12px 0px 0px 0px;  float:left;">
			<table border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td valign="top">
					<div class="titlebg">
					  <h1 class="title">Regular Search</h1>
					</div>
				</td>
				<td align="right" class="title">					
					 <? if ($config[userinfo]) { ?>					
					<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
					<? } else { ?>						
						<a href="index.php" class="lout">Home</a></strong>&nbsp; |&nbsp; <a href="member_login.php?mode=member" class="idclr">Login</a>
					<? } ?>						
				</td>
			</tr>	
			  <tr>
				<td colspan="2">
					<table width="560" border="0" cellspacing="0" cellpadding="0" align="left">
					  <tr>	
					  	
							<td align="right" valign="bottom" class="tmenubg">
							<div class="stitle" style="padding:0px 10px 0px 1px;"><a href="advance_search.php" class="epro">Advanced Search</a></div>
							<div class="stitle" style="padding:0px 0px 0px 0px;"><a href="#" class="eproselect">Regular Search</a></div></td>												
					  </tr>			
					  </tr>
						  <tr>
							<td>
								<table border="0" width="560" align="center" cellspacing="0" cellpadding="0" class="maindr">								
									  <form name="thisForm" method="get" action="search.php">
									  <input type="hidden" name="action" value="search">								 					  	
									  <tr>
										<td bgcolor="#f5f7d1" class="select" height="30">
										&nbsp;&nbsp;<b class="clr">Domain</b>&nbsp;&nbsp;&nbsp;&nbsp;										
											<?
                                                                                        $config["new_domain"] = "";
                                                                                        if ($config["new_domain"] == "") { ?>
												<select name="domain" class="dominbox" nChange="selMultipleDomainCaste_Search();" onChange="selMultipleDomainCaste_Search1();">
													<option value="" selected>-Select A Domain-</option>	
												<?	$resDomain = Execute("select * from tbl_domain_master order by id");
													if (mysql_num_rows($resDomain) > 0) {
														while ($domain1 = mysql_fetch_array($resDomain)) {									
													?>
													<option value="<?=$domain1[id]?>"><?=$domain1[domain]?></option>
												<?  	}
													} ?>
											</select>
											
											<script language="javascript">														
												document.thisForm.domain.value = '<?=$domain?>';
											</script>
											<?	} else { ?>
												<? 	$domain = $config["new_domain"]; ?>
												<select name="religion" class="dominbox" onChange="SelectSearchCaste_Search();">										
													<option value="">-Select Religion-</option>
													<?
                                                                                                        echo "select * from tbl_religion_master where domain = '$domain' order by religion ";
                                                                                                            //$resRegion = Execute("select distinct(religion), id from tbl_religion_master  order by religion ");

                                                                                                        $resRegion = Execute("select * from tbl_religion_master where domain = '$domain' order by religion ");
														if (mysql_num_rows($resRegion) > 0) { 
															while ($religion1 = mysql_fetch_array($resRegion)) {
															?>
															<option value="<?=$religion1[id]?>"><?=$religion1[religion] ?></option>
														<?  }
														 }	?>																	
												</select>
												<script language="javascript">												
													//document.thisForm.religion.value = '<?=$religion?>';
												</script>
											<? } ?>												
										</td>
										<td  bgcolor="#f5f7d1" class="select">
											&nbsp;&nbsp;<b class="clr">Education</b>&nbsp;&nbsp;&nbsp;&nbsp; 
											<select name="education" class="edubox">
												<option value="" selected>-------Education-------</option>									
												<option value="">Any</option>
												
												<?
													
														$res = Execute("select * from tbl_education_master");
														if (mysql_num_rows($res) > 0) {
															while ($rs_education = mysql_fetch_array($res)) { 
																if ($_REQUEST['action']==''){
																?>
																
																<option value="<?=$rs_education[id]?>"><?=$rs_education[education]?></option>	
														<?	}else {
															$a = $_REQUEST['education'];															
														?>
															<option value="<?=$rs_education[id]?>" <?php if ($a == $rs_education[id]){?> selected="selected"<?php }?>><?=$rs_education[education]?></option>	
														<?php	
														}
														
														}
													}	
												?>
											</select>
											<? if (!is_array($education) && $education) { ?>
											  <script language="javascript">								  		
													//document.thisForm.education.value = <?=$education?>;
											  </script>
											<? } ?>
										</td>
									  </tr>
									  <tr>
									  	<td bgcolor="#f5f7d1" class="select" height="30">
									  	<?php if ($_REQUEST['action'] == ''){?>
										&nbsp;&nbsp;<b class="clr">Caste</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									  		<select name="caste" class="dominbox">			
									  			
												<option value="">--Select Caste--</option>												
												
                                                <?
                                                $resRegion = Execute("select distinct(caste) from tbl_caste_master order by caste asc ");
                                                if (mysql_num_rows($resRegion) > 0) {
                                                        while ($religion1 = mysql_fetch_array($resRegion)) {
                                                        ?>
                                                        <option value="<?=$religion1["id"]?>" <?if($a == $religion1["id"]){?> selected <?}?>><?=$religion1[caste] ?></option>
                                                <?  }
                                                 }	?>
											</select>
											<?php }else { ?>
											&nbsp;&nbsp;<b class="clr">Caste</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<select name="caste" class="dominbox">			
									  			
												<option value="">--Select Caste--</option>												
												
                                                <?
                                                $resRegion = Execute("select distinct(caste) *from tbl_caste_master order by caste asc ");
                                                if (mysql_num_rows($resRegion) > 0) {
                                                        while ($religion1 = mysql_fetch_array($resRegion)) {
                                                        ?>
                                                        <option value="<?php echo $religion1["id"]?>" <?if($_REQUEST['caste'] == $religion1["id"]){?> selected="selected" <?}?>><?php echo $religion1['caste'] ?></option>
                                                <?  }
                                                 }	?>
											</select>
											<?php
											}?>
										</td>	
										<td  bgcolor="#f5f7d1">&nbsp;&nbsp;<b class="clr">Occupation</b>&nbsp;
										  <select name="occupation" class="edubox">
											<option value="" selected>------Occupation------</option>
											<?=GetOccupation(); ?>
										  </select>
										  <? if (!is_array($occupation) && $occupation) { ?>
										  <script language="javascript">
											//document.thisForm.occupation.value = <?=$occupation?>;
										  </script>
										  <? } ?></td>										
									  </tr>											
									  <tr>
										<td width="56%" bgcolor="#f5f7d1" height="30" class="red">
													
											  <? if ($gender) { ?>
												 &nbsp;<input name="gender" type="radio" value="F" <? if ($gender == "F") { ?> checked <? } ?>>Female&nbsp; 
												<input name="gender" type="radio" value="M" <? if ($gender == "M") { ?> checked <? } ?>>Male
											  <? } else { ?>
											  		<? if ($_SESSION['userid']) {
															$user_gender = GetSingleRecord("tbl_register","username",$_SESSION['userid']);
													  ?>
															<input name="gender" type="radio" value="F" <? if ($user_gender[gender] == "M") { ?> checked <? } ?>>Female&nbsp; 
															<input name="gender" type="radio" value="M" <? if ($user_gender[gender] == "F") { ?> checked <? } ?>>Male									
													  <? } else {	?>
												 			&nbsp;<input name="gender" type="radio" value="F" checked="checked">Female &nbsp; 
															<input name="gender" type="radio" value="M">Male
												      <? } ?>
											  <? } ?></td>	
										<td  bgcolor="#f5f7d1">&nbsp;&nbsp;<b class="clr">Country</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  <select name="country" class="edubox">
											<option value="" selected>--------Country--------</option>
											<option value="">Any</option>
											<? GetCountry(); ?>
											</select>
										  <? if ($country) { ?>
										  <script language="javascript">
													//document.thisForm.country.value = <?=$country?>;
											  </script>
										  <? } ?></td>	  									
									  </tr>									 
									  <tr>
										<td width="56%" bgcolor="#f5f7d1" class="select" height="30"> &nbsp;
											Height&nbsp;
											<select name="fromHeight" class="hgtbox">
												<script language="javascript">
													GetHeight();
												</script>	
											</select>
											<? if ($fromHeight) { ?>
											  <script language="javascript">
													document.thisForm.fromHeight.value = <?=$fromHeight?>;
											  </script>
											  <? } else { ?>
											  <script language="javascript">
													document.thisForm.fromHeight.value = "4.4";
											  </script>
											  <? } ?>									
											&nbsp;to&nbsp;
											<select name="toHeight" class="hgtbox">
												<script language="javascript">
													GetHeight();
												</script>
											</select>
											<? if ($toHeight) { ?>
											  <script language="javascript">
													document.thisForm.toHeight.value = <?=$toHeight?>;
											  </script>
											  <? } else { ?>
											  <script language="javascript">
													document.thisForm.toHeight.value = "7.1";
											  </script>
											  <? } ?>
											</td>
											<td bgcolor="#f5f7d1" class="select" height="30">&nbsp;&nbsp;Age&nbsp;
											  <select name="fromAge" class="agebox">
												<option value="18" selected="selected">18</option>
												<? for ($i = 19; $i < 99; $i++) { ?>
												<option value="<?=$i?>">
												  <?=$i?>
												</option>
												<? } ?>
											  </select>
											  <? if ($fromAge) { ?>
											  <script language="javascript">
														document.thisForm.fromAge.value = <?=$fromAge?>;
												  </script>
											  <? } ?>
													&nbsp;to&nbsp;
													<select name="toAge" class="agebox">
													  <? for ($i = 18; $i < 99; $i++) { ?>
													  <option value="<?=$i?>" <? if ($i == 35) { ?> selected <? } ?>>
													  <?=$i?>
													  </option>
													  <? } ?>
													</select>
													<? if ($toAge) { ?>
													<script language="javascript">
														document.thisForm.toAge.value = <?=$toAge?>;
													</script>
													<? } ?></td>
									  </tr>						  
										<tr>
										<td width="56%" bgcolor="#f5f7d1" class="select" height="30"> &nbsp;<input name="withPhoto" type="checkbox" value="1" <? if ($withPhoto) {?> checked <? } ?>> Profiles with Photo &nbsp;<input name="horoscope" type="checkbox" value="1" <? if ($horoscope) {?> checked <? } ?>> Profiles with Horoscope</td>
										<td  bgcolor="#f5f7d1" align="right" style="padding-right:15px;"><input name="Submit" type="image" src="images/search_btn.jpg" value=""></td>
									  </tr>	 
									  </form>
							  </table>					
							</td>
						  </tr>
					  <tr>
						<td align="center" colspan="2"><img src="images/search_menu_btm.gif" border="0" width="560"/></td>
					  </tr>
					</table>
				</td>
			  </tr>
			  			  
						  <? if ($action == "search") { 
								$iTotalRows = mysql_num_rows($searchMaxRows);
						?>
						<form name="thisForm1" method="get">	
							<?
								foreach($_REQUEST as $post_key=>$post_value) {
									if($post_key !== "iPageNum" && $post_key !== "iResultsLimit") {
										print "<input type=\"hidden\" name=\"" . $post_key . "\" value=\"" . $post_value . "\" />" . "\r\n";
									}
								}
							?>
						<input type="hidden" name="iPageNum" value="<?=$iPageNum?>">
							<input type="hidden" name="iResultsLimit" value="<?=$iResultsLimit?>">
							</form>
						<?
						if ($iTotalRows) {
					?>	

			  <tr>
				<td style="padding-top:5px;" colspan="2">
					<table width="560" border="0" cellspacing="0" align="left" cellpadding="0" class="sbar">
					  <tr>
					  	<td width="4"><img src="images/cruv_left.gif" border="0"/></td>
						<td width="35"><img src="images/search_icon_compar.gif"  onclick="fnCompare();"  style="cursor:pointer" title="Compare Profile" border="0"/></td>
						<td width="155"><a style="cursor:pointer" onclick="fnCompare()">Compare Profile</a></td>						
						<td width="35"><a onclick="fnBookmark()" style="cursor:pointer" class="mored"><img src="images/search_icon_book.gif" title="Book Mark" border="0"/></a></td>						
						<td width="100"><a onclick="fnBookmark()" style="cursor:pointer" class="orng1">Book Mark</a></td>	
						<td width="35"><img src="images/search_icon_forword.gif"  onclick="fnForward1();" style="cursor:pointer"  title="Forword Profile" border="0"/></td>					
						<td width="105"><a  onclick="fnForward1();" style="cursor:pointer" >Forward  Profile</a></td>						
					  	<!--<td width="8" align="right"><img src="images/cruv_right.gif" border="0"/></td>-->
					  	<td width="8" align="right"><img src="images/cruv_right.gif" border="0"/></td>
					  </tr>
					</table>
				</td>
			  </tr>
			  <?  if ($action == "search") { ?>
			  <tr>
				<td style="padding-top:5px;" colspan="2">
					<table width="560" border="0" cellspacing="0" align="left" cellpadding="0" class="sbar">
					  <tr>
					  	<td width="4"><img src="images/cruv_left.gif" border="0"/></td>
						<td width="452" class="sbar">
						<?  if ($action == "search") {
						
								echo "Page";
								echo  do_pages($iTotalRows, $iResultsLimit);
							}
						?>
						</td>						
					  	<td width="8" align="right"><img src="images/cruv_right.gif" border="0"/></td>
					  </tr>
					</table>
				</td>
			  </tr>
			  <? }
				}
			?>

			   <tr>
				<td style="padding-top:5px;" colspan="2">
				 <form name="proForm" method="post" action="forward_profile.php">	
				 	<input type="hidden" name="mode">		  
												
			  	<?
								$k = 1;
								if ($iTotalRows > 0) {										
										include("includes/profile_view.php");									
									
								} else { ?>
									<div style="float:left; padding:10px 0px 0px 10px;">
									<table border="0" width="520" align="center" cellspacing="0" cellpadding="0" bgcolor="#c0ba84">
										<tr bgcolor="#FFFFFF"><td>&nbsp;</td></tr>
										<tr>
											<td bgcolor="#FFFFFF">
												
												<? if ($config[userinfo]) { ?>
												Dear <b><?=$config[userinfo][name]?>,
												<? } else { ?>
												Dear Visitor,
												<? } ?>
												</b>
											</td>
										</tr>
										<tr>
											<td bgcolor="#FFFFFF">&nbsp;</td>
										</tr>
										<tr bgcolor="#FFFFFF">
											<td>
											
											Sorry, there are no profiles that match your search criteria. Please try our other search options to find better results.
											</td>
										</tr>
									</table>
									</div>
							<?	}	?>						
						<? } ?>
			  </form>			  
			  </td>
			  </tr>
			  <? if ($iTotalRows) {	?>	
			  <tr>
				<td style="padding-bottom:5px;" colspan="2">
					<table width="560" border="0" cellspacing="0" align="left" cellpadding="0" class="sbar">
					  <tr>
					  	<td width="4"><img src="images/cruv_left.gif" border="0"/></td>
						<td width="35"><img src="images/search_icon_compar.gif"  onclick="fnCompare();"  style="cursor:pointer" title="Compare Profile" border="0"/></td>
						<td width="155"><a style="cursor:pointer" onclick="fnCompare()">Compare Profile</a></td>						
						<td width="35"><a onclick="fnBookmark()" style="cursor:pointer" class="mored"><img src="images/search_icon_book.gif" title="Book Mark" border="0"/></a></td>						
						<td width="100"><a onclick="fnBookmark()" style="cursor:pointer" class="orng1">Book Mark</a></td>	
						<td width="35"><img src="images/search_icon_forword.gif"  onclick="fnForward1();" style="cursor:pointer"  title="Forword Profile" border="0"/></td>					
						<td width="105"><a  onclick="fnForward1();" style="cursor:pointer" >Forward  Profile</a></td>
					  	<td width="8" align="right"><img src="images/cruv_right.gif" border="0"/></td>
					  </tr>
					</table>
				</td>
			  </tr>
			  <tr>
				<td style="padding-top:5px;" colspan="2">
					<table width="560" border="0" cellspacing="0" align="left" cellpadding="0" class="sbar">
					  <tr>
					  	<td width="4"><img src="images/cruv_left.gif" border="0"/></td>
						<td width="452" class="sbar">
						<?  if ($action == "search") {
						
								echo "Page";
								echo  do_pages($iTotalRows, $iResultsLimit);
							}
						?>
						</td>						
					  	<td width="8" align="right"><img src="images/cruv_right.gif" border="0"/></td>
					  </tr>
					</table>
				</td>
			  </tr>
			 <? } ?>
			</table>			
		</div>
	</td>
  </tr>
  <? $PageName="Search"; ?>
  <tr><td colspan="3">
  <table align="left" cellpadding="1"  cellspacing="1" border="0">
	    <? include("includes/community_search.php");?>
	</table>
  </td></tr>
   <?    
   include("includes/fotter.php") 
   ?>

</table>
<div>
<script language="javascript">
selMultipleDomainCaste_Search1();
</script>
</body>
</html>
