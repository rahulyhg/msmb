<?php

ob_start();
session_start();
include_once("includes/lib.php");
include_once("includes/matchprofile.php");

# check login user
isMember(); 


$action = GetVar("action");
$action1 = GetVar("action1");
$matchid = GetVar("matchid");


$mode = GetVar("mode");
$TodayDateTime = date("Y-m-d G:i:s");
//$user = GetSingleRecord("tbl_register","username",$config[userinfo][username]);	
$user = GetSingleRecord("tbl_register","id",$_SESSION['id_user']);	
$iResultsLimit = GetVar("iResultsLimit");

# Insert Match Profiles

//PartnerMatch :: InsertMatch($config[userinfo][id]);
//PartnerMatch :: InsertMatch($_SESSION['userid']);
if ($action == "delete" && $matchid!="") {
	if (GetSingleRecord("tbl_match_profile","matchid",$matchid))
	 {
		//$res = Execute("UPDATE tbl_match_profile SET deleted=1 where userid = '" . $config[userinfo][id] . "' and matchid = '$matchid'");
		$res = Execute("UPDATE tbl_match_profile SET deleted=1 where userid = '" . $_SESSION['userid'] . "' and matchid = '$matchid'");
		$_SESSION['msg'] = 'Deleted successfully';
		header("Location: partner_match.php");
		die();
	}
}

# Get Match Profiles
//echo $config[userinfo][id];
//$id = PartnerMatch :: GetPartnerMatch($config[userinfo][id]);
//$id = PartnerMatch :: GetPartnerMatch($_SESSION['userid']);
PartnerMatch :: InsertMatch($config[userinfo][id]); 								
$id = PartnerMatch :: GetPartnerMatch($config[userinfo][id]);
$sql = "select * from tbl_register where hideProfile = '0' and deleteProfile = '0' and id in($id) ";

$sql .= "order by membership_type desc ";

$searchMaxRows = Execute($sql);

if(!is_numeric($iResultsLimit)) {
	$iResultsLimit = 25;
}

$iPageNum = GetVar("iPageNum");
if (!is_numeric($iPageNum)) {
	$iPageNum = 1;
}

$iResultsLower = 	(($iPageNum - 1) * ($iResultsLimit));
$searchMaxRows = Execute($sql);	

/* Sanitise results */

if ($iResultsLower < 0) {
	$iResultsLower = 0;
}

$sql .= " limit $iResultsLower , $iResultsLimit";

$searchRes = Execute($sql);
//print_r($_SESSION);

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
<body class="homeinbody" onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
<div class="menuleftimg">

<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="354" height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
    <td width="418" align="right"><? fnBannerImage('  ','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>  
  <tr>
    <td colspan="2" valign="top">		
		<? include("includes/side_menu.php"); ?>
		<div style="margin:12px 0px 0px 9px;  float:left;">
			<table width="500" border="0"  cellspacing="0" cellpadding="0">			  
				<tr>
					<td>
					<div class="titlebg">
					  <h1 class="title">My Matches</h1>
					</div>
					</td>
					<td align="right" class="title">					
						 <? if ($config[userinfo]) { ?>					
					<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
					<? } ?>					
					</td>
			  	</tr>
				<?  
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
				<td colspan="2">&nbsp;</td>
			  </tr>
			  <tr>
				<td colspan="2">
				<div style="float:left; padding:10px 0px 0px 10px;">	
					<b class="title">
					Based on your partner preference, we found the following profiles match with your profile. You can find each partner by viewing the following lists.
					</b>
				</div>	
				</td>
			  </tr>		
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			  <tr>
				<td style="padding-top:5px;" colspan="2">
					<table width="560" border="0" cellspacing="0" align="center" cellpadding="0" class="sbar">
					  <tr>
					  	<td width="4"><img src="images/cruv_left.gif" border="0"/></td>
						<td width="28"><img src="images/search_icon_compar.gif"  onclick="fnCompare();"  style="cursor:pointer" title="Compare Profile" border="0"/></td>
						<td width="105"><a style="cursor:pointer" onclick="fnCompare()">Compare Profile</a></td>						
						<td width="28"><a onclick="fnBookmark()" style="cursor:pointer" class="mored"><img src="images/search_icon_book.gif" title="Book Mark" border="0"/></a></td>						
						<td width="66"><a onclick="fnBookmark()" style="cursor:pointer" class="orng1">Book Mark</a></td>	
						<td width="28"><img src="images/search_icon_forword.gif"  onclick="fnForward1();" style="cursor:pointer"  title="Forword Profile" border="0"/></td>					
						<td width="93"><a  onclick="fnForward1();" style="cursor:pointer" >Forward  Profile</a></td>						
						<td width="100" lass="sbar">
						<?  
							echo "Page";
							echo  do_pages($iTotalRows, $iResultsLimit);							
						?>
						</td>						
					  	<!--<td width="8" align="right"><img src="images/cruv_right.gif" border="0"/></td>-->
					  	<td width="8" align="right"><img src="images/cruv_right.gif" border="0"/></td>
					  </tr>
					</table>
				</td>
			  </tr>
			<?
				}
			?>

			   <tr>
				<td style="padding-top:5px;" colspan="2">
				 <form name="proForm" method="post" action="forward_profile.php">	
				 	<input type="hidden" name="mode">		  
												
			  	<?
								
								$k = 1;
								if ($iTotalRows > 0) {																		
									include("includes/partner_match.inc.php");									
									
								} else { ?>
									<div style="float:left; padding:10px 0px 0px 10px;">
									<table border="0" width="100%" align="center" cellspacing="0" cellpadding="0" bgcolor="#c0ba84">
										<tr bgcolor="#FFFFFF"><td>&nbsp;</td></tr>
										<tr bgcolor="#FFFFFF">
											<td align="center">No Matches found.  <a href='edit_my_profile.php?action1=lookingfor' class='idclr'>Click here</a> set your partner preference</td>
										</tr>
									</table>
									</div>
							<?	}	?>						
					
			  </form>
			  
			  </td>
			  </tr>			  
			  
			</table>
		</div>
	</td>
  </tr>
  <? include("includes/fotter.php") ?>
</table>
<div>
</body>
</html>
