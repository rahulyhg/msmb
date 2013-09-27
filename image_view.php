<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
$memid = GetVar("memid");
$user = GetSingleRecord("tbl_register","username",$config[userinfo][username]);	
$member = GetSingleRecord("tbl_register","id",$memid);	
$allow = false;
if ($member[photo_password] && $memid != $config[userinfo][id]) {
	unset($allow);
} else {
	$allow = true;
}
if ($action == "chkpassword") {
	if ($member[photo_password] == $_POST['password']) {
		$allow = true;	
	} else {
		$_SESSION['msg2'] = "Invalid Password. Try again";
		unset($allow);
		header("Location: image_view.php?memid=$memid");		
		die();
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" src="includes/validate.js"></script>
<script language="JavaScript" src="includes/functions.js"></script>
<!--<script language="JavaScript" src="includes/progress.js"></script>-->
<script language="javascript">
	function validatePassword() {
		f1 = document.thisForm;
		if (isNull(f1.password,"photo password")) { return false; }
	}
</script>
</head>
<body>
	<table cellpadding="0" cellspacing="0"  border="0" style="border:#fdd76c 4px solid; background:url(images/indsn.jpg) no-repeat 322px 27px;" width="546" height="690">
		<tr>
			<td class="popbg" height="25" align="center">
<!--                            <img src="images/img_matritxt.jpg" height="25"/>-->
                        </td>
		</tr>
		<tr><td height="4" bgcolor="#fdd76c"></td></tr>
		<tr><td><img src="images/popup_logo.jpg" hspace="5" vspace="5"></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td valign="top" >
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
					<? if (!$allow) { ?>
						<td valign="top" colspan="2">						
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td align="right"><?=$_SESSION['msg2']?><? $_SESSION['msg2'] = ""; ?></td>
								</tr>
								<tr>
									<td align="center"><b>Photo Protected</b></td>
								</tr>
								<tr>
									<td>
									<UL><LI><?=$member[username]?> has protected the photo and to view the photo you need a photo password. If you have already obtained the photo password from the member, please enter it below.</LI><BR> &nbsp;<LI> If you do not have the photo password, you can contact the member and make a request for it.</LI></UL>
									</td>
								</tr>
								<tr>
									<td align="center">
									<form name="thisForm" action="image_view.php" method="post" onSubmit="return validatePassword();">									
										<input type="hidden" name="action" value="chkpassword">
										<input type="hidden" name="memid" value="<?=$memid?>">
										Enter the photo password&nbsp;<input type="password" name="password" class="txtbox">
										<input type="submit" value="Submit" class="butten">
									</form>
									</td>
								</tr>
							</table>	
						</td>	
					<? } else {?>
						<td valign="top" style="padding-top:10px;">						
							<table cellpadding="5" cellspacing="5" border="0">							
							<?
								if ($member[id] == $config[userinfo][id]) {
									$resPhoto = Execute("select * from tbl_photo where userid = '".$member[id]."'");
								} else {
									$resPhoto = Execute("select * from tbl_photo where userid = '".$member[id]."' and approve = '1' ");
								}
								$i = 1;
								if (mysql_num_rows($resPhoto) > 0) {
									while ($memPhoto = mysql_fetch_array($resPhoto)) {										
										  ?>
									<tr>
									  <td>
										<!--<img src="includes/thumbnail_popup.php?id=<?=$member[id]?>&thumbnail=120px&height=100px&path=userthumbnail/<?=$memPhoto[thumbnail]?>" hspace="5" style="cursor:pointer" width="80" height="90" onclick="GetLargeImage('imgLarge','includes/thumbnail_popup.php?id=<?=$member[id]?>&thumbnail=400px&height=150px&path=userthumbnail/<?=$memPhoto[thumbnail]?>')">-->
										<img src="userthumbnail/<?=$memPhoto[photo]?>" hspace="5" style="cursor:pointer" width="75" style="border:#999999 3px solid; padding:5px;" height="75" onclick="GetLargeImage('imgLarge','userenlarge/<?=$memPhoto[photo]?>')">
									  </td>	
									</tr>
							<? 	
									}
								}?>
								
							</table>
						</td>											
						<td style="padding-top:0px;">
							<table cellpadding="0" cellspacing="0" border="0" align="center"  width="100%">							
							<?
								$resPhoto = Execute("select * from tbl_photo where userid = '".$member[id]."'");
								$i = 1;
								if (mysql_num_rows($resPhoto) > 0) {
									$memPhoto = mysql_fetch_array($resPhoto); ?>
									<tr>
									  <td>
										<img id="imgLarge" name="imgLarge" src="userenlarge/<?=$memPhoto[photo]?>" style="border:#fdd76c 3px solid; padding:5px;" width="350" eight="350">
									  </td>	
									</tr>
									
							<? 										
								}?>
								
							</table>
						</td>
					<? } ?>
					</tr>
					
				</table>
			</td>
		</tr>
		<tr><td colspan="2" height="110" align="right"><? fnBannerImage('image_view','bottem')  ?></td></tr>	
	</table>
</body>
</html>
