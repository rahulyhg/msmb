<?php
ob_start();
session_start();
include("includes/lib.php");
include("matchprofile.php");

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
		
		if ($_FILES['horoscope1']['name'] != "") {			
			$_REQUEST['horoscope'] = post_img($_FILES['horoscope1']['name'], $_FILES['horoscope1']['tmp_name'],"horoscope");
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
			$_REQUEST['phoneNumber'] = $_REQUEST['phoneNumber'];	
		}
		
		# create profile			
		//print_r("<pre>");print_r($_REQUEST);print_r("</pre>"); exit;
		$sql = DTMLCreateRecord("tbl_register",$_REQUEST);


		//$res = Execute($sql);
		$res=mysql_query($sql);	
		
		$insert_id = mysql_insert_id();
			
		PartnerMatch :: InsertMatchingPartner($insert_id); 
		

//		$insert_id = mysql_insert_id();

		# upload user images
		
		if (!is_dir("userimages")) {
			mkdir("userimages");
			chmod("userimages",0777);
		}
		if ($_FILES['photo1']['name'] != "") {			
			$photo1 = post_img($_FILES['photo1']['name'], $_FILES['photo1']['tmp_name'],"userimages");
			$sql = "insert into tbl_photo(userid,photo) values('$insert_id','$photo1')";
			$imgRes = Execute($sql);
		}
		if ($_FILES['photo2']['name'] != "") {			
			$photo2 = post_img($_FILES['photo2']['name'], $_FILES['photo2']['tmp_name'],"userimages");
			$sql = "insert into tbl_photo(userid,photo) values('$insert_id','$photo2')";
			$imgRes = Execute($sql);
		}
		if ($_FILES['photo3']['name'] != "") {			
			$photo3 = post_img($_FILES['photo3']['name'], $_FILES['photo3']['tmp_name'],"userimages");
			$sql = "insert into tbl_photo(userid,photo) values('$insert_id','$photo3')";
			$imgRes = Execute($sql);
		}			
		
		$user = GetSingleRecord("tbl_register","id",$insert_id);
		
		
		$_SESSION['regname'] = GetSingleField("username","tbl_register","id",$insert_id);
		$_SESSION['name'] = GetSingleField("name","tbl_register","id",$insert_id);
		$_SESSION['regid'] = $insert_id;

                //print_r($_REQUEST); exit;
		
		# Send mail to user
		
		$strLink = $config["siteurl"]."activate_member.php?id=".$user[uniqueID];
		$mailmsg = "";  		
		$mailmsg .= "<style>td { font-family:verdana; font-size:11px; }</style>";
		$mailmsg .= "Dear ".trim($user[name]).",<br><br>";
		$mailmsg .= "<table cellpadding='3'>";
		$mailmsg .= "<tr><td colspan='2'><font color='#ff9900'><b>Thank you</b></font> for your interest in Maa Shakti Marriage Bureau.</td></tr>";
		$mailmsg .= "<tr><td colspan='2'>I personally wanted to welcome you to the <a target='_blank' herf='http://maashaktimarriage.com'>Maashaktimarriage.com</a>. Below you will find link to activate your account.</td></tr>";
		$mailmsg .= "<tr><td colspan='2'><a href='".$strLink."' target='_blank'>Click Here</a> To Activate your Membership</td></tr>";
		$mailmsg .= "<tr><td colspan='2'>We strongly recommend that you make your profile as attractive as possible so that it receives maximum response. Set Partner Preference's and Get your match Immediately.</td></tr>";
		$mailmsg .= "<tr><td colspan='2'><br><a target='_blank' href='http://maashaktimarriage.com/member_login.php'>Add your photographs</a> - Get 15 times more responses </td></tr>";
		$mailmsg .= "<tr><td colspan='2'><br><a target='_blank' href='http://maashaktimarriage.com/member_login.php'>Add your horoscope</a>  - Free in 9 Indian languages or upload scanned Horoscope</td></tr>";
		$mailmsg .= "<tr><td colspan='2'><br><a target='_blank' href='http://maashaktimarriage.com/member_login.php'>Edit the profile</a> - when you required. </td></tr>";
		$mailmsg .= "<tr><td colspan='2'><br><a target='_blank' href='http://maashaktimarriage.com/member_login.php'>Change your password</a>  - regularly to protect your posted data.</td></tr>";
		$mailmsg .= "<tr><td colspan='2'>We wish you all the best in your partner search. </td></tr>";
		$mailmsg .= "<tr><td colspan='2'>Thanks,</td></tr><tr><td>Regards,</td></tr><tr><td>Maashaktimarriage.com</td></tr></table>"; 	 			
		$strTo = $user[email];
		$strFrom = "info@maashaktimarriage.com";		
		$strSubject = "Welcome to Maa Shakti Marriage Bureau";
		$strContent = $mailmsg;
		//send_mail($strTo,$strFrom,$strSubject,$strContent);
		phpmailer_send($strTo,$strSubject,$strContent);
                /*$msg = 'Congratulations! You are now a FREE member of shaadi.com';
		$_SESSION['msg1'] = $msg;
		header("Location: edidprofile.php?action1=physical&mode=thanks");*/
		$_SESSION['msg'] = "Congratulations!<br> Your are now a Free member.<br> Your ID is : ".$_SESSION['msg'].= $_SESSION['regname']."<br>";	
		$_SESSION['msg'].= "Your profile will activated by Administrator.<br>";	
	
		$_SESSION['userid'] = $_SESSION['regname'];
		$_SESSION['member_name'] = $_SESSION['name'];
		$_SESSION['id_user'] = $_SESSION['regid'];	
				
		
		header("Location: thanks.php?id=30");
		//header("Location:register3.php");
		die();
	} else if ($action == 'basic') {		
		extract($_REQUEST);
		$no = rand(1,10000);
		$f2 .= "<form name=\"register_save\" method=\"post\">";
		$f2 .= "<input type=\"hidden\" name=\"action\" value=\"Save\">";
		/* Load register form with original variables */
		foreach($_REQUEST as $post_key=>$post_value) {
			if ($post_key != 'action') {	
				$f2 .= "<input type=\"hidden\" name=\"" . $post_key . "\" value=\"" . $post_value . "\" />" . "\r\n";			
			}	
		}
		echo $f2 .= "</form>";

	  $mail = GetSingleRecord("tbl_register","email",$email);
		if ($mail) {	
			echo $f2;
			?>
			<script type="text/javascript">
				alert('email address already exist');
				location.href = 'register.php?action=basic';
				//document.f2.submit();			
			</script>
			<?	
			die();
		}
		//echo $f2;
	?>
	<script type="text/javascript">
		document.register_save.action="register_save.php?action=Save";
		//location.href = 'register_save.php?action=Save';
		document.register_save.submit();
	</script>
<? }	?>
