<?php
ob_start();
session_start();
include("includes/lib.php");

$type = GetVar("type");

$action = GetVar("action");

$mode = GetVar("mode");
$id = GetVar("id");


if ($type == 'login') {
	
	$res = Execute("select * from tbl_register where username = '" . GetVar("username") . "' or email = '" . GetVar("username")  . "' and password = '" . GetVar("password") . "'");
	
	if (mysql_num_rows($res) > 0) {
	
		$rs = mysql_fetch_array($res);
		if (isStillMember($rs[package_expiry_date])) {					
			if (!$rs[deleteProfile]) {
				$_SESSION['userid'] = $rs['username'];
				$_SESSION['id_user'] = $rs['id'];
				$_SESSION['member_unique_id']=$rs['uniqueID'];
				$_SESSION['member_name']=$rs['name'];
				$LostLogin = date("Y-m-d G:i:s");
				$res1 = Execute("update tbl_register set lastLogin = '$LostLogin' where id = '" . $_SESSION['id_user'] . "'");
				$_SESSION['name'] = $rs['name'];
			} else { $msg = "Sorry your Profile is deleted.  To restore your profile plz contact admin with in 10 days after profile deleted"; }
		} else { $msg = "Sorry your membership is expired"; }
		
		$_SESSION['Msg1'] = $msg;	
		header("Location: member_verify.php?action=$action&mode=$mode&id=$id");
		die();		
		
	} else {	
		
		$_SESSION['Msg1'] = 'Invalid Username / Password';
		header("Location: member_verify.php?action=$action&mode=$mode&id=$id");
		die();
		
	}
		
}

$action = base64_decode(GetVar("action"));

$mode = base64_decode(GetVar("mode"));

$paidmember = 0;
$login = 0;
$contactallowed = true;

$memberid = base64_decode(GetVar("id"));

if ($action == "horoscope") {
	$mode = "horoscope";	
}

$contact = GetSingleRecord("tbl_register","id",$memberid);

if ($config[userinfo]) {

	$login = 1;
	
	$user = GetSingleRecord("tbl_register","id",$config[userinfo][id]);		
	
	# check uesr still valid member	
	if (isStillMember($user[package_expiry_date])) {
		
		# allow to view contact details only paid members
		if ($user[membership_type] && $user[membership_type] != "1") {											
		
			$paidmember = 1;
			
			if ($mode)	{
			
				$mode1 = $mode . "_allowed";
				
				if ($user["$mode1"] == 0)	{
				
					$res = Execute("select * from tbl_contact_view where userid= '" . $user[id] . "' and profile_id = '" . $memberid . "'");
					
					if (mysql_num_rows($res) > 0) {
					} else {
						$contactallowed = false;	
					}
						
				} 				
			}
			/* else if ($mode == "phone") {
				if ($user[phone_allowed] == 0)	{
					$res = Execute("select * from tbl_contact_view where userid= '" . $user[id] . "' and profile_id = '" . $memberid . "'");
					if (mysql_num_rows($res) > 0) {
					} else {
						$contactallowed = false;	
					}	
				}
			}*/								
			if ($action == "horoscope") { ?>
				<script language="javascript" type="text/javascript">
					location.href = "horoscope/<?=$contact[horoscope]?>";
				</script>			
		<?		die();
			}
		}
	}
}

$login_form = '<tr>
			<td colspan="2">
				<table width="100%" cellpadding="3" cellspacing="0" border="0"  gcolor="#000000">
					<form name="thisForm" method="post" onSubmit="return validate(this)">	
					<input type="hidden" name="action" value="'.base64_encode($action).'">
					<input type="hidden" name="mode" value="'.base64_encode($mode).'">
					<input type="hidden" name="id" value="'.base64_encode($memberid).'">
					<input type="hidden" name="type" value="login">	
					<tr><td colspan=2 align=right><font color=#FF0000>' . $_SESSION['Msg1'] . '</font></td></tr>
					<tr gcolor="#FFFFFF">
						<td>User ID/ Email</td>
						<td><input type="text" name="username" class="txtbox"></td>
					</tr>
					<tr gcolor="#FFFFFF">
						<td>Password</td>
						<td><input type="password" name="password" class="txtbox"></td>
					</tr>
					<tr>
						<td colspan=2 align=center><input type=submit value=Submit class=button><br>
						If you wish to see the contact details <a href="javascript:fnOpen();">Register FREE NOW!</a>
						</td>
					</tr>					
					</form>
				</table>
				
			</td>
		</tr>		
		';

$_SESSION['Msg1'] = '';
		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" src="includes/validate.js"></script>
<script language="JavaScript" src="includes/functions.js"></script>	
<script language="javascript">	
	function validate(f1) {
		
		if (isNull(f1.username,'Username')) { return false; }
		if (isNull(f1.password,'Password')) { return false; }
		
	}
	function fnOpen()
	{
		window.opener.location.href="register.php";
		window.close();
	}	
</script>
</head>
<body>
	<table  border="0" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top">
							<table cellpadding="0" cellspacing="0" border="0"  class="viewbg" align="center" >
						<tr>
						  	<td style="padding:0px 0px 140px 50px;">
								<table border="0" width="420" cellpadding="5"  cellspacing="5" align="center">																			
									<? if ($paidmember) { 
											if ($contactallowed) { ?>
													<tr class="heading">
														<td colspan="2" align="left"><font color="#dd1a16"><b>Contact details</b></font></td>
													 </tr>
											<?	if ($mode == "address") { 
													
													
													$con_address = 'S/o. '.$contact[fatherName] . ',<br>';
													$con_address .= $contact[streetAddress] . ',<br>';
													$con_address .= $contact[area] . ' - ' . $contact[pincode];
													
													if ($contact[city]) {
														$con_city = GetSingleField("city","tbl_city_master","id",$contact[city]);
													} else if ($contact[city_1]) {	
														$con_city = $contact[city_1];
													}
													
													if ($contact[state]) {
														$con_state = GetSingleField("state","tbl_state_master","id",$contact[state]);
													} else if ($contact[state_1]) {	
														$con_state = $contact[state_1];
													}
													
													if ($contact[country]) {
														$con_country =  GetSingleField("country","tbl_country_master","id",$contact[country]);
													} else if ($contact[country_1]) {	
														$con_country = $contact[country_1];
													}	
														 
													?>	
													
													 <tr >
														<td><b>Name</b></b></td>
														<td><?=$contact[name]?></td>														
													</tr>
																																						 
													 <tr >
														<td valign="top"><b>Address</b></td>
														<td>
															<?=$con_address;?>
														</td>					
													 </tr>
													 
													 <tr>
														<td><b>City</b></td>
														<td><?=$con_city?></td>														
													</tr>
													
													<tr>
														<td><b>State</b></td>
														<td><?=$con_state?></td>														
													</tr>
													
													<tr>
														<td><b>Country</b></td>
														<td><?=$con_country?></td>														
													</tr>
													 
													 <!--<tr bgcolor="#FFFFFF">
														<td>City</td><td><?=GetSingleField("city","tbl_city_master","id",$contact[city]);?></td>					
													 </tr>
													 <tr bgcolor="#FFFFFF">
														<td>Pin code</td><td><?=$contact[pincode];?></td>					
													 </tr>-->
											<? } else if ($mode == "phone") { ?>		 									 		
													 <tr >
														<td>Phonbe Number</td><td><?=$contact[phoneNumber];?></td>					
													 </tr>
													 <tr >
														<td>Mobile Number</td><td><?=$contact[mobileNumber];?></td>					
													 </tr>		
													 <tr >
														<td>Fax</td><td><?=$contact[fax];?></td>					
													 </tr>	
											<?	}	
											
									 		} else {
											
												if (!$login) { ?>
												
													<tr>
														<td colspan=2>
															<!--Contact details are available only to logged in members. If you wish to see the contact details, <a href="javascript:window.parent.opener.location.href='member_login.php';window.close();" class="memberid">Click here </a> to login.-->
															Contact details are available only to logged in members. If you wish to see the contact details, Please login below. 
														</td>
													</tr>
													<?=$login_form?>													
													
											<?	} else { ?>
											
													<tr>
														<td colspan=2>
															Sorry you do not have enough credits to view conatact details of this profile. <a href="javascript:window.parent.opener.location.href='upgrade_membership.php';window.close();" class="memberid">Click here</a> to upgrade membership.
														</td>
													</tr> 
											<?	}		
											}											
									 	} else { 
										
									 		if (!$login) {	
											
												if ($action == 'horoscope') { ?>											
												
													<tr >
														<td colspan=2>
															<!--Horoscope details are available only to logged in members. If you wish to see the horoscope details, <a class="memberid" href="javascript:window.parent.opener.location.href='member_login.php';window.close();">Click here </a> to login.-->
															Horoscope details are available only to logged in members. If you wish to see the horoscope details, Please login below.
														</td>
													</tr>
													<?=$login_form?>	
																									
											<?	} else { ?>
											
													<tr >
														<td colspan=2>
															<!--Contact details are available only to logged in members. If you wish to see the contact details, <a href="javascript:window.parent.opener.location.href='member_login.php';window.close();" class="memberid">Click here </a> to login.-->
															<br> Contact details are available only to logged in members. If you wish to see the contact details, Please login below.
														</td>
													</tr>
													<?=$login_form?>
													
											<?	}	
											
											} else { ?>																								
											
												<tr >
													<td colspan=2>
														Contact details are available only for paid members. <a href="javascript:window.parent.opener.location.href='upgrade_membership.php';window.close();" class="memberid">Click here</a> to become a paid member.
													</td>
												</tr>
																	
										<?	}	
				  					  	} ?>									 							
								</table>			
							 </td>								 
						  </tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>