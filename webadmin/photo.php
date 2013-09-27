<?php
ob_start();
session_start();

include("includes/connection.php");
include("includes/functions.php");
include("includes/paging.php");
include("common/image_crop.php");
include("includes/menu.php");
$linkid = db_connect();
isAdmin($arg);
$userid = GetVar("id");
$photoid = GetVar("photoid");
$action = GetVar("action");
$mode = GetVar("mode");
$membership_type = $_REQUEST["member_type"];

$member = GetSingleRecord("tbl_register","id",$userid);
$siteurl = realpath(".");
$siteurl = str_replace('\webadmin','',$siteurl);

//print_r($_REQUEST);
//die();
if ($action == "upload") {
        
	if (!is_dir("../userimages")) {
		mkdir("../userimages");
		chmod("../userimages",0777);
	}
	if (!is_dir("../userthumbnail")) {
		mkdir("../userthumbnail");
		chmod("../userthumbnail",0777);
	}
	if (!is_dir("../usernormal")) {
		mkdir("../usernormal");
		chmod("../usernormal",0777);
	}
	if (!is_dir("../userenlarge")) {
		mkdir("../userenlarge");
		chmod("../userenlarge",0777);
	}
	if ($photoid) {	
	
		$pid = $photoid;
		$userphoto = GetSingleRecord("tbl_photo","id",$photoid);
		
		if ($userphoto) {
			removeFile("../userimages/" . $userphoto[photo]);
			removeFile("../userthumbnail/" . $userphoto[photo]);
			removeFile("../usernormal/" . $userphoto[photo]);
			removeFile("../userenlarge/" . $userphoto[photo]);
		}	
		if ($_FILES['enlarge1']['name'] != "") {			
			$photo_name = post_img($_FILES['enlarge1']['name'], $_FILES['enlarge1']['tmp_name'],"../userimages");
			$sql = "update tbl_photo set photo = '$photo_name' where id = '$photoid'";
			$imgRes = Execute($sql);
		}
		if ($_FILES['enlarge2']['name'] != "") {			
			$photo_name = post_img($_FILES['enlarge2']['name'], $_FILES['enlarge2']['tmp_name'],"../userimages");
			$sql = "update tbl_photo set photo = '$photo_name' where id = '$photoid'";
			$imgRes = Execute($sql);
		}
		if ($_FILES['enlarge3']['name'] != "") {			
			$photo_name = post_img($_FILES['enlarge3']['name'], $_FILES['enlarge3']['tmp_name'],"../userimages");
			$sql = "update tbl_photo set photo = '$photo_name' where id = '$photoid'";
			$imgRes = Execute($sql);
		}	
	} else {
		if ($_FILES['enlarge1']['name'] != "") {			
			$photo_name = post_img($_FILES['enlarge1']['name'], $_FILES['enlarge1']['tmp_name'],"../userimages");
			$sql = "insert into tbl_photo(userid,photo) values('$userid','$photo_name')";
			$imgRes = Execute($sql);
		}
		if ($_FILES['enlarge2']['name'] != "") {			
			$photo_name = post_img($_FILES['enlarge2']['name'], $_FILES['enlarge2']['tmp_name'],"../userimages");
			$sql = "insert into tbl_photo(userid,photo) values('$userid','$photo_name')";
			$imgRes = Execute($sql);
		}
		if ($_FILES['enlarge3']['name'] != "") {			
			$photo_name = post_img($_FILES['enlarge3']['name'], $_FILES['enlarge3']['tmp_name'],"../userimages");
			$sql = "insert into tbl_photo(userid,photo) values('$userid','$photo_name')";
			$imgRes = Execute($sql);
		}
		$pid = mysql_insert_id();
	}
	
	$image_magic = new pb_imageMagick("../userimages/".$photo_name);
        
	$image_magic1 = $image_magic->crop(75,75,"../userthumbnail/usr".$pid."_" . $member[username] . ".jpg");
	$image_magic2 = $image_magic->crop(150,160,"../usernormal/usr".$pid."_" . $member[username] . ".jpg");
	$image_magic3 = $image_magic->crop(350,360,"..//userenlarge/usr".$pid."_" . $member[username] . ".jpg");
	
	/*
	// file resize code
	$sim = imagecreatefromjpeg("../userimages/".$photo_name);	
	$size = getimagesize("../userimages/".$photo_name);
	$width = 500;
	$ratio = $size[1] / $size[0];
	$height = $width * $ratio;
	$height = sprintf("%.0f",$height);
	$dim = imagecreatetruecolor($width,$height);			
	imagecopyresampled($dim,$sim,0,0,0,0,$width,$height,$size[0],$size[1]);
	$imfile="../userimages/usr".$pid.".jpg";		
	$fh=fopen("../userimages/".$photo_name,"w");
	imagejpeg($dim,"../userimages/usr".$pid.".jpg",100);			
	fclose($fh);
	*/
	
	$res = Execute("update tbl_photo set photo = 'usr".$pid."_" . $member[username].".jpg' where id = '" . $pid . "'");
	
	$ar_photo = GetSingleRecord("tbl_photo","userid",$member[id]);
	
	if ($ar_photo) {
		if ($ar_photo[approve]) {
			$res_photo1 = Execute("update tbl_register set userHasPhoto = '1', userPhotoApprove = '1' where id = '" . $member[id] . "'");	
		} else {
			$res_photo1 = Execute("update tbl_register set userHasPhoto = '1', userPhotoApprove = '0' where id = '" . $member[id] . "'");
		}		
	} else {
		$res_photo1 = Execute("update tbl_register set userHasPhoto = '0', userPhotoApprove = '0' where id = '" . $member[id] . "'");
	}	
	
	//remove uploaded file
	removeFile("../userimages/".$photo_name);	
	
	$_SESSION['_msg'] = "Image uploaded successfully";
	header("Location: photo.php?id=$userid&member_type=$membership_type");
	exit();
} else if ($action == "submit") {

	if (GetVar("featureProfile_".$photoid)) {	
		$res = Execute("update tbl_photo set featureProfile = '1' where id = '$photoid'");
	} else {
		$res = Execute("update tbl_photo set featureProfile = '0' where id = '$photoid'");
	}
	
	if (GetVar("approve_".$photoid)) {	
		$res = Execute("update tbl_photo set approve = '1' where id = '$photoid'");
	} else {
		$res = Execute("update tbl_photo set approve = '0' where id = '$photoid'");
	}
			
	/*$userphoto = GetSingleRecord("tbl_photo","id",$photoid);
	if ($userphoto) {
		$sql = "update tbl_photo set approve = 1, reject = 0  where id = '$photoid'";
		$imgRes = Execute($sql);
	}
	$_SESSION['Msg'] = "Photo approved successfully";
	header("Location: photo.php?id=$userid");
	die();
	
	$userphoto = GetSingleRecord("tbl_photo","id",$photoid);
	if ($userphoto) {		
		$sql = "update tbl_photo set approve = 0, reject = 1 where id = '$photoid'";
		$imgRes = Execute($sql);
	}*/
	
	$_SESSION['_msg'] = "Updated Successfully";
	header("Location: photo.php?id=$userid&member_type=$membership_type");
	die();
	
} else if ($action == "delete") {
	
	$userphoto = GetSingleRecord("tbl_photo","id",$photoid);
	if ($userphoto) {
		removeFile("../userimages/" . $userphoto[photo]);
		removeFile("../userthumbnail/" . $userphoto[photo]);
		removeFile("../usernormal/" . $userphoto[photo]);
		removeFile("../userenlarge/" . $userphoto[photo]);		
		$sql = "delete from tbl_photo where id = '$photoid'";
		$imgRes = Execute($sql);
	}
	$_SESSION['_msg'] = "Photo deleted successfully";
	header("Location: photo.php?id=$userid&member_type=$membership_type");
	die();
}

?>
<html>
<head>
<title>Web Control Panel :: MaaShakti </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript" type="text/javascript" src="includes/functions.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript">

	function Upload_Enlarge_New1(mem_type) {
		f1 = document.thisForm;		
		if (!isNull(f1.enlarge1,"Upload Enlarge1")) {
			f1.action = "photo.php?action=upload&mode=enlarge&member_type=" + mem_type;
                        alert(f1.action);
			f1.submit();
		}
	}
	
	function Upload_Enlarge_New2(mem_type) {
		f1 = document.thisForm;		
		if (!isNull(f1.enlarge2,"Upload Enlarge2")) {
			document.thisForm.action = "photo.php?action=upload&mode=enlarge&member_type=" + mem_type;
			document.thisForm.submit();		
		}
	}
	
	function Upload_Enlarge_New3(mem_type) {
		f1 = document.thisForm;		
		if (!isNull(f1.enlarge3,"Upload Enlarge3")) {
			document.thisForm.action = "photo.php?action=upload&mode=enlarge&member_type=" + mem_type;
			document.thisForm.submit();		
		}
	}
	
	function Upload_New1(mem_type) {
		f1 = document.thisForm;		
		if (!isNull(f1.thumbnail1,"Upload thumbanail1")) {
			document.thisForm.action = "photo.php?action=upload&mode=thumbnail&member_type=" + mem_type;
			document.thisForm.submit();		
		}
	}
	
	function Upload_New2(mem_type) {
		f1 = document.thisForm;		
		if (!isNull(f1.thumbnail2,"Upload thumbanail2")) {
			document.thisForm.action = "photo.php?action=upload&mode=thumbnail&member_type=" + mem_type;
			document.thisForm.submit();		
		}
	}
	
	function Upload_New3(mem_type) {
		f1 = document.thisForm;
		if (!isNull(f1.thumbnail3,"Upload thumbanail3")) {
			document.thisForm.action = "photo.php?action=upload&mode=thumbnail&member_type=" + mem_type;
			document.thisForm.submit();
		}
	}
	
	function Upload_Enlarge1(id,mem_type) {
		f1 = document.thisForm;		
		if (!isNull(f1.enlarge1,"Upload Enlarge1")) {
			document.thisForm.action = "photo.php?action=upload&mode=enlarge&photoid=" + id+"&member_type=" + mem_type;
			document.thisForm.submit();		
		}
	}
	function Upload_Enlarge2(id,mem_type) {
		f1 = document.thisForm;		
		if (!isNull(f1.enlarge2,"Upload Enlarge2")) {
			document.thisForm.action = "photo.php?action=upload&mode=enlarge&photoid=" + id+"&member_type=" + mem_type;
			document.thisForm.submit();		
		}
	}
	function Upload_Enlarge3(id,mem_type) {
		f1 = document.thisForm;		
		if (!isNull(f1.enlarge3,"Upload Enlarge3")) {
			document.thisForm.action = "photo.php?action=upload&mode=enlarge&photoid=" + id+"&member_type=" + mem_type;
			document.thisForm.submit();		
		}
	}
	function Upload1(id,mem_type) {	
		f1 = document.thisForm;		
		if (!isNull(f1.thumbnail1,"Upload thumbanail1")) {
			document.thisForm.action = "photo.php?action=upload&mode=thumbnail&photoid=" + id+"&member_type=" + mem_type;
			document.thisForm.submit();		
		}	
	}
	function Upload2(id,mem_type) {	
		f1 = document.thisForm;		
		if (!isNull(f1.thumbnail2,"Upload thumbanail2")) {
			document.thisForm.action = "photo.php?action=upload&mode=thumbnail&photoid=" + id+"&member_type=" + mem_type;
			document.thisForm.submit();		
		}	
	}
	function Upload3(id,mem_type) {	
		f1 = document.thisForm;		
		if (!isNull(f1.thumbnail3,"Upload thumbanail3")) {
			document.thisForm.action = "photo.php?action=upload&mode=thumbnail&photoid=" + id+"&member_type=" + mem_type;
			document.thisForm.submit();		
		}	
	}
	/*
	function Approve(id) {
		document.thisForm.action = "photo.php?action=approve&photoid=" + id;
		document.thisForm.submit();
	}
	function Delete(id) {
		if (confirm("Are you sure want delete this thumbnail & enlarge photos")) {
			document.thisForm.action = "photo.php?action=delete&photoid=" + id;
			document.thisForm.submit();
		}	
	}	
	function Reject(id) {	
		document.thisForm.action = "photo.php?action=reject&photoid=" + id;
		document.thisForm.submit();	
	}*/
	
	function UpdateDetails(id,mem_type) {
		f1 = document.thisForm;
		name = "delete_" + id;
		del = 0;
		for (i = 0; i < f1.elements.length; i++) {		
			if (f1.elements[i].name ==  name && f1.elements[i].checked) {
				del = 1;
				break;
			}
		}
		if (del == 1) {		
			if (confirm("Are you sure want delete")) {
				f1.action = "photo.php?action=delete&photoid=" + id +"&member_type=" + mem_type;
				f1.submit();
			}			 
		} else {	
			f1.action = "photo.php?action=submit&photoid=" + id +"&member_type=" + mem_type;
			f1.submit();
		}	
	}
	
	function show(imgid,source) {		
		document.getElementById(imgid).src = source;
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
						<td class="subtitle">Approve Photo</td>						
						<td align="right">
						<? if ($membership_type > 1) { ?>	
							<a href="view_members.php?membership_type=<?=$membership_type?>">View Paid Members</a>
						<? } else { ?>	
							<a href="view_members.php?membership_type=<?=$membership_type?>">View Free Members</a>
						<? } ?>
						</td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->			
				<form name="thisForm" method="post" enctype="multipart/form-data">									
					<input type="hidden" name="id" value="<?=$userid?>">		
					<input type="hidden" name="membership_type" value="<?=$membership_type?>">			
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="520">
						<tr><td>
							<table cellpadding="10" cellspacing="1" border="0" width="700" class="tblBorder">
							<tr class="tblHead"><td align="center"><b>
								<?
									echo "Approve Photo(s)";								
								?>
							</b></td></tr>
							<tr class="tblContent"><td>
								<table cellpadding="5" cellspacing="1" border="0" width="700" class="tblBorder">																										
											
									<?
										$resPhoto = Execute("select * from tbl_photo where userid='$userid' order by id");
										$no_of_photos = mysql_num_rows($resPhoto);									
										$i = 1;
										if (mysql_num_rows($resPhoto)>0) {
											while ($userphoto = mysql_fetch_array($resPhoto)) {												
												if ($userphoto[photo]) {
													$enlarge = "../userenlarge/" . $userphoto[photo];
													$normal = "../usernormal/" . $userphoto[photo];
													$thumbnail = "../userthumbnail/" . $userphoto[photo];
												}	
													
												?>
												<tr class="tblContent">
													<td colspan="2" class="tblHead"><b>Photo <?=$i?></b></td>	
												</tr>
												<tr class="tblContent">
													<td><img id="<?=$userphoto[id]?>" src="<?=$thumbnail?>" border="0"></td>
													<td>
													<table><tr><td>Image<?=$i?></td></tr>
													<tr><td>Status: 
													<? if ($userphoto[approve]) { 
													       echo "<b>Approved</b>"; 
													   } else { 
													   	  if ($userphoto[reject]) {
														      echo "<b>Photo rejected</b>"; 			
														  } else {
														      echo "<b>Not yet approved</b>"; 	
														  }	
													       
													   } ?>
													</td></tr></table>
													</td>																										
												</tr>
												<tr class="tblContent">
													<td>
														<a onClick="show('<?=$userphoto[id]?>','<?=$enlarge?>')" style="cursor:pointer">Show Enlarge</a>&nbsp;&nbsp;
														<a onClick="show('<?=$userphoto[id]?>','<?=$normal?>')" style="cursor:pointer">Show Normal</a>&nbsp;&nbsp;
														<a onClick="show('<?=$userphoto[id]?>','<?=$thumbnail?>')" style="cursor:pointer">Show Thumbnail</a>&nbsp;&nbsp;
													</td>
													<td><input type="file" class="txtbox" name="enlarge<?=$i?>">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Upload" class="butten" onClick="Upload_Enlarge<?=$i?>('<?=$userphoto[id]?>','<?=$membership_type?>')"></td>
												</tr>				
												<tr class="tblContent">
													<td colspan="2" align="center">
														<? if ($enlarge) { ?>
														<!--<input type="button" value="Delete" class="butten" onClick="Delete('<?=$userphoto[id]?>')">&nbsp;
														<input type="button" value="Approve" class="butten" onClick="Approve('<?=$userphoto[id]?>')">&nbsp;																											
														<input type="button" value="Reject" class="butten" onClick="Reject('<?=$userphoto[id]?>')">-->
														<table align="center">
															<tr><td>
																<input type="checkbox" name="delete_<?=$userphoto[id]?>">Delete Photo
															</td>
															<!--<tr><td>
																<input type="checkbox" name="featureProfile_<?=$userphoto[id]?>" <? if ($userphoto[featureProfile]) { ?> checked <? } ?>>Feature Profile
															</td></tr>-->
															<td>
																<input type="radio" name="approve_<?=$userphoto[id]?>" value="1" <? if ($userphoto[approve]) { ?> checked<? } ?>>Approve&nbsp;<input type="radio" name="approve_<?=$userphoto[id]?>" value="0" <? if (!$userphoto[approve]) { ?> checked <? } ?>>Reject
															</td>
															<td></td>
															<td>
																<input type="button" value="Commit Changes" class="butten" onClick="UpdateDetails('<?=$userphoto[id]?>','<?=$membership_type?>')">
															</td></tr>	
														</table>	
															
														<? } ?>
													</td>
												</tr>												
												<tr class="tblContent">
													<td colspan="2">&nbsp;</td>
												</tr>
												<?												
												$enlarge = "";	
												$i++;
											}																						
											for ($j = $i; $j <= 3; $j++) { ?>
												<tr class="tblContent">
													<td colspan="2" class="tblHead"><b>Photo <?=$j?></b></td>	
												</tr>
												<tr class="tblContent">
													<td></td>
													<td>
													<table><tr><td>Image<?=$j?></td></tr>
													</table>
													</td>																										
												</tr>
												<tr class="tblContent">
													<td>Image</td>
													<td><input type="file" class="txtbox" name="enlarge<?=$j?>">&nbsp;&nbsp;&nbsp;<input type="button" value="Upload Image<?=$j?>" class="butten" onClick="Upload_Enlarge_New<?=$j?>(<?=$_REQUEST["member_type"]?>)"></td>
												</tr>																																														
												<tr class="tblContent">
													<td colspan="2">&nbsp;</td>
												</tr>
											<?													
											}
										} else {																						
											for ($j = $i; $j <= 3; $j++) { ?>
												<tr class="tblContent">
													<td colspan="2" class="tblHead"><b>Photo <?=$j?></b></td>	
												</tr>
												<tr class="tblContent">
													<td></td>
													<td>
													<table><tr><td>Image<?=$j?></td></tr>
													</table>
													</td>																										
												</tr>
												<tr class="tblContent">
													<td>Image</td>
													<td><input type="file" class="txtbox" name="enlarge<?=$j?>">&nbsp;&nbsp;&nbsp;<input type="button" value="Upload Image<?=$j?>" class="butten" onClick="Upload_Enlarge_New<?=$j?>(<?=$_REQUEST["member_type"]?>)"></td>
												</tr>												
												<tr class="tblContent">
													<td colspan="2">&nbsp;</td>
												</tr>
											<?													
											}											
										}
									?>									
									<!--<tr class="tblContent">
										<td align="center" height="30" colspan="2">
											<input type="submit" value="Save" class="butten">
										</td>
									</tr>-->
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