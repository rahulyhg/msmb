<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
if ($config[userinfo]) { header("Location: my_matrimony.php"); die();}
$_SESSION['package_id'] = GetVar('package_id');

	if ($action == 'Save') {
		$_REQUEST['uniqueID'] = "usr".StandardHash(microtime().$_SERVER["REMOTE_ADDR"]);
		$_REQUEST['income'] = str_replace(",","",$_REQUEST['income']);	
		$_REQUEST['phoneNumber'] = $_REQUEST['countryCode'] . "-" . $_REQUEST['areaCode'] . "-" . $_REQUEST['phoneNumber'];
		if (!is_dir("horoscope")) {
			mkdir("horoscope");
			chmod("horoscope",0777);
		}
		
		if ($_REQUEST['caste'] && !$_REQUEST['nocaste']) {
			$_REQUEST['nocaste'] = '0';		
		}
		
		if ($HTTP_POST_FILES['horoscope1']['name'] != "") {			
			$_REQUEST['horoscope'] = post_img($HTTP_POST_FILES['horoscope1']['name'], $HTTP_POST_FILES['horoscope1']['tmp_name'],"horoscope");
		}
		
		if ($_REQUEST['country'] && $_REQUEST['country'] != 'Others') {
			$_REQUEST['country_1'] = '';
		} else if ($_REQUEST['country_1']) {
			$_REQUEST['country'] = '';
		}
		
		if ($_REQUEST['state'] && $_REQUEST['state'] != 'Others') {
			$_REQUEST['state_1'] = '';
		} else if ($_REQUEST['state_1']) {
			$_REQUEST['state'] = '';
		}
		
		if ($_REQUEST['city'] && $_REQUEST['city'] != 'Others') {
			$_REQUEST['city_1'] = '';
		} else if ($_REQUEST['city_1']) {
			$_REQUEST['city'] = '';
		}
		
		if ($_REQUEST['residingCountry'] && $_REQUEST['residingCountry'] != 'Others') {
			$_REQUEST['residingCountry_1'] = '';
		} else if ($_REQUEST['residingCountry_1']) {
			$_REQUEST['residingCountry'] = '';
		}
		
		if ($_REQUEST['residingState'] && $_REQUEST['residingState'] != 'Others') {
			$_REQUEST['residingState_1'] = '';
		} else if ($_REQUEST['residingState_1']) {
			$_REQUEST['residingState'] = '';
		}
		
		if ($_REQUEST['residingCity'] && $_REQUEST['residingCity'] != 'Others') {
			$_REQUEST['residingCity_1'] = '';
		} else if ($_REQUEST['residingCity_1']) {
			$_REQUEST['residingCity'] = '';
		}
		
		if ($_REQUEST['citizenship'] && $_REQUEST['citizenship'] != 'Others') {
			$_REQUEST['citizenship_1'] = '';
		} else if ($_REQUEST['citizenship_1']) {
			$_REQUEST['citizenship'] = '';
		}
		
		if ($_REQUEST['nationality'] && $_REQUEST['nationality'] != 'Others') {
			$_REQUEST['nationality_1'] = '';
		} else if ($_REQUEST['nationality_1']) {
			$_REQUEST['nationality'] = '';
		}
		
		$TodayDateTime = date("Y-m-d G:i:s");
		$_REQUEST['registration_date'] = $TodayDateTime;
		$_REQUEST['lastLogin'] = $TodayDateTime;
		$today = date("Y-m-d");
		$_REQUEST['package_expiry_date'] = GetPackageExpiry_Date($today,'30');			
		
		# Get Unique Id
		
		$_REQUEST['username'] = GetUserUniqueId($_REQUEST['gender']);
		
		# Get Franchiees id
		
		if ($_REQUEST['franchisees_autoid']) {
			$_REQUEST['franchisees_id'] = GetSingleField("franchisee_id","tbl_franchisee","auto_id",$_REQUEST['franchisees_autoid']);
		}
		$_REQUEST['date_of_birth']	= $_REQUEST['mydateY']."-".$_REQUEST['mydateM']."-".$_REQUEST['mydateD'];
		if ($_REQUEST['countryCode'] && $_REQUEST['areaCode'] && $_REQUEST['phoneNumber']) {
			echo $_REQUEST['phoneNumber'] = $_REQUEST['phoneNumber'];	
		}
		
		# create profile			
		
		$sql = DTMLCreateRecord("tbl_register",$_REQUEST);			
		
		//$res = Execute($sql);
		$res=mysql_query($sql);	
		
		$insert_id = mysql_insert_id();
				
		# upload user images
		
		if (!is_dir("userimages")) {
			mkdir("userimages");
			chmod("userimages",0777);
		}
		if ($HTTP_POST_FILES['photo1']['name'] != "") {			
			$photo1 = post_img($HTTP_POST_FILES['photo1']['name'], $HTTP_POST_FILES['photo1']['tmp_name'],"userimages");
			$sql = "insert into tbl_photo(userid,photo) values('$insert_id','$photo1')";
			$imgRes = Execute($sql);
		}
		if ($HTTP_POST_FILES['photo2']['name'] != "") {			
			$photo2 = post_img($HTTP_POST_FILES['photo2']['name'], $HTTP_POST_FILES['photo2']['tmp_name'],"userimages");
			$sql = "insert into tbl_photo(userid,photo) values('$insert_id','$photo2')";
			$imgRes = Execute($sql);
		}
		if ($HTTP_POST_FILES['photo3']['name'] != "") {			
			$photo3 = post_img($HTTP_POST_FILES['photo3']['name'], $HTTP_POST_FILES['photo3']['tmp_name'],"userimages");
			$sql = "insert into tbl_photo(userid,photo) values('$insert_id','$photo3')";
			$imgRes = Execute($sql);
		}			
		
		$user = GetSingleRecord("tbl_register","id",$insert_id);	
		
		$_SESSION['regname'] = GetSingleField("username","tbl_register","id",$insert_id);
		$_SESSION['name'] = GetSingleField("name","tbl_register","id",$insert_id);
		$_SESSION['regid'] = $insert_id;
		
		
		# Send mail to user
		
		$strLink = $config["siteurl"]."activate_member.php?id=".$user[uniqueID];
		$mailmsg = "";  		
		$mailmsg .= "<style>td { font-family:verdana; font-size:11px; }</style>";
		$mailmsg .= "Dear ".trim($user[name]).",<br><br>";
		$mailmsg .= "<table cellpadding='3'>";
		$mailmsg .= "<tr><td colspan='2'><font color='#ff9900'><b>Thank you</b></font> for your interest in Maa Shakti Marriage Bureau.</td></tr>";
		$mailmsg .= "<tr><td colspan='2'>I personally wanted to welcome you to the <a target='_blank' herf='http://thecreativeit.com'>Matrimony Website .com</a>. Below you will find link to activate your account.</td></tr>";
		$mailmsg .= "<tr><td colspan='2'><a href='".$strLink."' target='_blank'>Click Here</a> To Activate your Membership</td></tr>";
		$mailmsg .= "<tr><td colspan='2'>We strongly recommend that you make your profile as attractive as possible so that it receives maximum response. Set Partner Preference  - Get You're my match Immediately.</td></tr>";
		$mailmsg .= "<tr><td colspan='2'><br><a target='_blank' href='http://topmatrimonial.thecreativeit.com/member_login.php'>Add your photographs</a>   - Get 15 times more responses </td></tr>";
		$mailmsg .= "<tr><td colspan='2'><br><a target='_blank' href='http://topmatrimonial.thecreativeit.com/member_login.php'>Add your horoscope</a>       - Free in 9 Indian languages or upload scanned Horoscope</td></tr>";
		$mailmsg .= "<tr><td colspan='2'><br><a target='_blank' href='http://topmatrimonial.thecreativeit.com/member_login.php'>Edit the profile</a> 	         - when you required. </td></tr>";
		$mailmsg .= "<tr><td colspan='2'><br><a target='_blank' href='http://topmatrimonial.thecreativeit.com/member_login.php'>Change your password</a>   - regularly to protect your posted data.</td></tr>";
		$mailmsg .= "<tr><td colspan='2'>We wish you all the best in your partner search. </td></tr>";
		$mailmsg .= "<tr><td colspan='2'>Thanks,</td></tr><tr><td>Regards,</td></tr><tr><td> Matrimony Website .com</td></tr></table>"; 	 			
		$strTo = $user[email];
		$strFrom = "info@maashaktimarriage.com";		
		$strSubject = "Welcome to the Matrmonial shaadi ";
		$strContent = $mailmsg;
		send_mail($strTo,$strFrom,$strSubject,$strContent);
		/*$msg = 'Congratulations! You are now a FREE member of shaadi.com';
		$_SESSION['msg1'] = $msg;
		header("Location: edidprofile.php?action1=physical&mode=thanks");*/
		?>
			<script language="javascript">
				location.href = 'register3.php?action1=physical';
			</script>
		<?
		//header("Location:register3.php");
		die();
	} else if ($action == 'basic') {		
		extract($_REQUEST);
		$no = rand(1,10000);
		$f2 .= "<form name='f2' action='register.php' method='post'>";
		$f2 .= "<input type=\"hidden\" name=\"action\" value=\"Save\">";
		/* Load register form with original variables */
		foreach($_REQUEST as $post_key=>$post_value) {			
				$f2 .= "<input type=\"hidden\" name=\"" . $post_key . "\" value=\"" . $post_value . "\" />" . "\r\n";			
		}
		$f2 .= "</form>";
  $mail = GetSingleRecord("tbl_register","email",$email);
		if ($mail) {	
			echo $f2;
			?>
			<script language="javascript">
				alert('email address already exist');									
				document.f2.submit();			
			</script>
			<?	
			die();
		}
	header("location:register.php");
}	?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/register.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" src="includes/validate.js"></script>
<script language="JavaScript" src="includes/functions.js"></script>
<script language="JavaScript" src="includes/simplecalendar_v1.3.js" type="text/javascript"></script>
<script type="text/javascript" src="includes/dsInput.js"></script>

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

//-->
</script>
<style type="text/css">
<!--
.style1 {
	color: #AD5B12;
	font-weight: bold;
}
-->
</style>
</head>
<body class="homeinbody" nLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
<div class="menuleftimg">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
    <td align="right"><? fnBannerImage('  ','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr> 
  <tr><td colspan="2" height="8" width="100%" ></td> </tr> 
  <tr>
    <td width="100" height="124" colspan="2" > <img src="images/Base 5 final.jpg"></td>
    
  </tr>
  <tr>
    <td colspan="2" valign="top">
		<div style="padding:0px 0px 0px 0px;  float:left;">
		<table width="268"   border="0" cellspacing="0" cellpadding="0" >
			
            <tr>
				<td valign="top" class="benefit" height="183">
					<ul class="benefits">						
						<li>1- Get Instant Matches with Photos</li> 
						<li>2- Receive matches through email</li>
						<li>3- Send Express Interest</li>
						<li>4- Upload upto 3 photos</li>						
					</ul>
				</td>
			</tr>
			<tr><td height="5"></td></tr>
		<tr><td><img src="images/add_left.jpg" border="0" width="268" /></td></tr>
		</table>
		</div>
		<?php /*?><form name="thisForm" action="register1.php" method="post"><?php */?>
		<form name="thisForm" action="register_save.php" method="post">
			<input type="hidden" name="action" value="Save">
			<? include("common/basicdetails.php")?>		
		</form>
</td></tr>
<tr>
  <td colspan="2">
  	<? 
		  		include("includes/fotter.php") ?>
  </td>
  </tr>
</table>
</div>
</body>
</html>
