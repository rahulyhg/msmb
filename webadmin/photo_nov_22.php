<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging.php");
include("includes/menu.php");
$linkid = db_connect();
isAdmin($arg);
$userid = GetVar("id");
$photoid = GetVar("photoid");
$action = GetVar("action");
$mode = GetVar("mode");

if ($action == "upload") {

	if ($mode == "thumbnail") {
		if (!is_dir("../userthumbnail")) {
			mkdir("../userthumbnail");
			chmod("../userthumbnail",0777);
		}
		if ($photoid) {
			$userphoto = GetSingleRecord("tbl_photo","id",$photoid);
			if ($userphoto) {
				removeFile("../userthumbnail/" . $userphoto[thumbnail]);
			}	
			if ($HTTP_POST_FILES['thumbnail1']['name'] != "") {			
				$photo_name = post_img($HTTP_POST_FILES['thumbnail1']['name'], $HTTP_POST_FILES['thumbnail1']['tmp_name'],"../userthumbnail");
				$sql = "update tbl_photo set thumbnail='$photo_name' where id = '$photoid'";
				$imgRes = Execute($sql);
			}
			if ($HTTP_POST_FILES['thumbnail2']['name'] != "") {			
				$photo_name = post_img($HTTP_POST_FILES['thumbnail2']['name'], $HTTP_POST_FILES['thumbnail2']['tmp_name'],"../userthumbnail");
				$sql = "update tbl_photo set thumbnail='$photo_name' where id = '$photoid'";
				$imgRes = Execute($sql);
			}
			if ($HTTP_POST_FILES['thumbnail3']['name'] != "") {			
				$photo_name = post_img($HTTP_POST_FILES['thumbnail3']['name'], $HTTP_POST_FILES['thumbnail3']['tmp_name'],"../userthumbnail");
				$sql = "update tbl_photo set thumbnail='$photo_name' where id = '$photoid'";
				$imgRes = Execute($sql);
			}	
		} else {
			if ($HTTP_POST_FILES['thumbnail1']['name'] != "") {			
				$photo_name = post_img($HTTP_POST_FILES['thumbnail1']['name'], $HTTP_POST_FILES['thumbnail1']['tmp_name'],"../userthumbnail");
				$sql = "insert into tbl_photo(userid,thumbnail) values('$userid','$photo_name')";
				$imgRes = Execute($sql);
			}
			if ($HTTP_POST_FILES['thumbnail2']['name'] != "") {			
				$photo_name = post_img($HTTP_POST_FILES['thumbnail2']['name'], $HTTP_POST_FILES['thumbnail2']['tmp_name'],"../userthumbnail");
				$sql = "insert into tbl_photo(userid,thumbnail) values('$userid','$photo_name')";
				$imgRes = Execute($sql);
			}
			if ($HTTP_POST_FILES['thumbnail3']['name'] != "") {			
				$photo_name = post_img($HTTP_POST_FILES['thumbnail3']['name'], $HTTP_POST_FILES['thumbnail3']['tmp_name'],"../userthumbnail");
				$sql = "insert into tbl_photo(userid,thumbnail) values('$userid','$photo_name')";
				$imgRes = Execute($sql);
			}
		}	
	} else {
		if (!is_dir("../userimages")) {
			mkdir("../userimages");
			chmod("../userimages",0777);
		}
		if ($photoid) {	
		
			$pid = $photoid;
			$userphoto = GetSingleRecord("tbl_photo","id",$photoid);
			if ($userphoto) {
				removeFile("../userimages/" . $userphoto[photo]);
			}	
			if ($HTTP_POST_FILES['enlarge1']['name'] != "") {			
				$photo_name = post_img($HTTP_POST_FILES['enlarge1']['name'], $HTTP_POST_FILES['enlarge1']['tmp_name'],"../userimages");
				$sql = "update tbl_photo set photo = '$photo_name' where id = '$photoid'";
				$imgRes = Execute($sql);
			}
			if ($HTTP_POST_FILES['enlarge2']['name'] != "") {			
				$photo_name = post_img($HTTP_POST_FILES['enlarge2']['name'], $HTTP_POST_FILES['enlarge2']['tmp_name'],"../userimages");
				$sql = "update tbl_photo set photo = '$photo_name' where id = '$photoid'";
				$imgRes = Execute($sql);
			}
			if ($HTTP_POST_FILES['enlarge3']['name'] != "") {			
				$photo_name = post_img($HTTP_POST_FILES['enlarge3']['name'], $HTTP_POST_FILES['enlarge3']['tmp_name'],"../userimages");
				$sql = "update tbl_photo set photo = '$photo_name' where id = '$photoid'";
				$imgRes = Execute($sql);
			}	
		} else {
			if ($HTTP_POST_FILES['enlarge1']['name'] != "") {			
				$photo_name = post_img($HTTP_POST_FILES['enlarge1']['name'], $HTTP_POST_FILES['enlarge1']['tmp_name'],"../userimages");
				$sql = "insert into tbl_photo(userid,photo) values('$userid','$photo_name')";
				$imgRes = Execute($sql);
			}
			if ($HTTP_POST_FILES['enlarge2']['name'] != "") {			
				$photo_name = post_img($HTTP_POST_FILES['enlarge2']['name'], $HTTP_POST_FILES['enlarge2']['tmp_name'],"../userimages");
				$sql = "insert into tbl_photo(userid,photo) values('$userid','$photo_name')";
				$imgRes = Execute($sql);
			}
			if ($HTTP_POST_FILES['enlarge3']['name'] != "") {			
				$photo_name = post_img($HTTP_POST_FILES['enlarge3']['name'], $HTTP_POST_FILES['enlarge3']['tmp_name'],"../userimages");
				$sql = "insert into tbl_photo(userid,photo) values('$userid','$photo_name')";
				$imgRes = Execute($sql);
			}
			$pid = mysql_insert_id();
		}
		
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
		
		$res = Execute("update tbl_photo set photo = 'usr".$pid.".jpg' where id = '" . $pid . "'");
		
		//remove uploaded file
		removeFile("../userimages/".$photo_name);
	}
	
	$_SESSION['Msg'] = "Image uploaded successfully";
	header("Location: photo.php?id=$userid");
	die();
} else if ($action == "approve") {

	$userphoto = GetSingleRecord("tbl_photo","id",$photoid);
	if ($userphoto) {
		$sql = "update tbl_photo set approve = 1, reject = 0  where id = '$photoid'";
		$imgRes = Execute($sql);
	}
	$_SESSION['Msg'] = "Photo approved successfully";
	header("Location: photo.php?id=$userid");
	die();
} else if ($action == "reject") {	

	$userphoto = GetSingleRecord("tbl_photo","id",$photoid);
	if ($userphoto) {		
		$sql = "update tbl_photo set approve = 0, reject = 1 where id = '$photoid'";
		$imgRes = Execute($sql);
	}
	$_SESSION['Msg'] = "photo reject successfully";
	header("Location: photo.php?id=$userid");
	die();
} else if ($action == "delete") {
	
	$userphoto = GetSingleRecord("tbl_photo","id",$photoid);
	if ($userphoto) {
		removeFile("../userthumbnail/" . $userphoto[thumbnail]);
		removeFile("../userimages/" . $userphoto[photo]);
		$sql = "delete from tbl_photo where id = '$photoid'";
		$imgRes = Execute($sql);
	}
	$_SESSION['Msg'] = "photo reject successfully";
	header("Location: photo.php?id=$userid");
	die();
}

?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript" type="text/javascript" src="includes/functions.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript">

	function Upload_Enlarge_New1() {
		f1 = document.thisForm;		
		if (!isNull(f1.enlarge1,"Upload Enlarge1")) {
			document.thisForm.action = "photo.php?action=upload&mode=enlarge";
			document.thisForm.submit();		
		}
	}
	
	function Upload_Enlarge_New2() {
		f1 = document.thisForm;		
		if (!isNull(f1.enlarge2,"Upload Enlarge2")) {
			document.thisForm.action = "photo.php?action=upload&mode=enlarge";
			document.thisForm.submit();		
		}
	}
	
	function Upload_Enlarge_New3() {
		f1 = document.thisForm;		
		if (!isNull(f1.enlarge3,"Upload Enlarge3")) {
			document.thisForm.action = "photo.php?action=upload&mode=enlarge";
			document.thisForm.submit();		
		}
	}
	
	function Upload_New1() {
		f1 = document.thisForm;		
		if (!isNull(f1.thumbnail1,"Upload thumbanail1")) {
			document.thisForm.action = "photo.php?action=upload&mode=thumbnail";
			document.thisForm.submit();		
		}
	}
	
	function Upload_New2() {
		f1 = document.thisForm;		
		if (!isNull(f1.thumbnail2,"Upload thumbanail2")) {
			document.thisForm.action = "photo.php?action=upload&mode=thumbnail";
			document.thisForm.submit();		
		}
	}
	
	function Upload_New3() {
		f1 = document.thisForm;
		if (!isNull(f1.thumbnail3,"Upload thumbanail3")) {
			document.thisForm.action = "photo.php?action=upload&mode=thumbnail";
			document.thisForm.submit();
		}
	}
	
	function Upload_Enlarge1(id) {
		f1 = document.thisForm;		
		if (!isNull(f1.enlarge1,"Upload Enlarge1")) {
			document.thisForm.action = "photo.php?action=upload&mode=enlarge&photoid=" + id;
			document.thisForm.submit();		
		}
	}
	function Upload_Enlarge2(id) {
		f1 = document.thisForm;		
		if (!isNull(f1.enlarge2,"Upload Enlarge2")) {
			document.thisForm.action = "photo.php?action=upload&mode=enlarge&photoid=" + id;
			document.thisForm.submit();		
		}
	}
	function Upload_Enlarge3(id) {
		f1 = document.thisForm;		
		if (!isNull(f1.enlarge3,"Upload Enlarge3")) {
			document.thisForm.action = "photo.php?action=upload&mode=enlarge&photoid=" + id;
			document.thisForm.submit();		
		}
	}
	function Upload1(id) {	
		f1 = document.thisForm;		
		if (!isNull(f1.thumbnail1,"Upload thumbanail1")) {
			document.thisForm.action = "photo.php?action=upload&mode=thumbnail&photoid=" + id;
			document.thisForm.submit();		
		}	
	}
	function Upload2(id) {	
		f1 = document.thisForm;		
		if (!isNull(f1.thumbnail2,"Upload thumbanail2")) {
			document.thisForm.action = "photo.php?action=upload&mode=thumbnail&photoid=" + id;
			document.thisForm.submit();		
		}	
	}
	function Upload3(id) {	
		f1 = document.thisForm;		
		if (!isNull(f1.thumbnail3,"Upload thumbanail3")) {
			document.thisForm.action = "photo.php?action=upload&mode=thumbnail&photoid=" + id;
			document.thisForm.submit();		
		}	
	}
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
						<td align="right"><a href="view_members.php">View Members</a></td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->			
				<form name="thisForm" method="post" enctype="multipart/form-data">									
					<input type="hidden" name="id" value="<?=$userid?>">
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
												if ($userphoto[thumbnail]) {
													$thumbnail = "../userthumbnail/" . $userphoto[thumbnail];
												} 
												if ($userphoto[photo]) {
													$enlarge = "../userimages/" . $userphoto[photo];
												}	
													
												?>
												<tr class="tblContent">
													<td colspan="2" class="tblHead"><b>Photo <?=$i?></b></td>	
												</tr>
												<tr class="tblContent">
													<td><img src="<?=$enlarge?>" border="0"></td>
													<td>
													<table><tr><td>Enlarge<?=$i?></td></tr>
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
													<td>Enlarge</td>
													<td><input type="file" class="txtbox" name="enlarge<?=$i?>"></td>
												</tr>
												<tr class="tblContent">
													<td colspan="2" align="center">													
														<input type="button" value="Upload Enlarge<?=$i?>" class="butten" onClick="Upload_Enlarge<?=$i?>('<?=$userphoto[id]?>')">&nbsp;																																							
													</td>
												</tr>
												<? if ($thumbnail) { ?>
												<tr class="tblContent">
													<td><img src="<?=$thumbnail?>" border="0"></td>
													<td>
													<table><tr><td>Thumbnail<?=$i?></td></tr>
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
												<? } ?>												
												<tr class="tblContent">
													<td>Thumbnail (80 x 90)</td>
													<td><input type="file" class="txtbox" name="thumbnail<?=$i?>"></td>
												</tr>												
												<tr class="tblContent">
													<td colspan="2" align="center">													
														<input type="button" value="Upload Thumbnail<?=$i?>" class="butten" onClick="Upload<?=$i?>('<?=$userphoto[id]?>')">&nbsp;
													</td>
												</tr>	
												<tr class="tblContent">
													<td colspan="2" align="center">
														<? if ($thumbnail or $enlarge) { ?>
														<input type="button" value="Delete" class="butten" onClick="Delete('<?=$userphoto[id]?>')">&nbsp;
														<input type="button" value="Approve" class="butten" onClick="Approve('<?=$userphoto[id]?>')">&nbsp;																											
														<input type="button" value="Reject" class="butten" onClick="Reject('<?=$userphoto[id]?>')">
														<? } ?>
													</td>
												</tr>												
												<tr class="tblContent">
													<td colspan="2">&nbsp;</td>
												</tr>
												<?
												$thumbnail = "";
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
													<table><tr><td>Enlarge<?=$j?></td></tr>
													</table>
													</td>																										
												</tr>
												<tr class="tblContent">
													<td>Enlarge</td>
													<td><input type="file" class="txtbox" name="enlarge<?=$j?>"></td>
												</tr>
												<tr class="tblContent">
													<td colspan="2" align="center">													
														<input type="button" value="Upload Enlarge<?=$j?>" class="butten" onClick="Upload_Enlarge_New<?=$j?>()">&nbsp;																																							
													</td>
												</tr>
												<tr class="tblContent">
													<td></td>
													<td>
													<table><tr><td>Thumbnail<?=$j?></td></tr>
													</table>
													</td>																										
												</tr>																						
												<tr class="tblContent">
													<td>Thumbnail (80 x 90)</td>
													<td><input type="file" class="txtbox" name="thumbnail<?=$j?>"></td>
												</tr>
												<tr class="tblContent">
													<td colspan="2" align="center">
														<input type="button" value="Upload Thumbnail<?=$j?>" class="butten" onClick="Upload_New<?=$j?>()">&nbsp;
													</td>
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
													<table><tr><td>Enlarge<?=$j?></td></tr>
													</table>
													</td>																										
												</tr>
												<tr class="tblContent">
													<td>Enlarge</td>
													<td><input type="file" class="txtbox" name="enlarge<?=$j?>"></td>
												</tr>
												<tr class="tblContent">
													<td colspan="2" align="center">													
														<input type="button" value="Upload Enlarge<?=$j?>" class="butten" onClick="Upload_Enlarge_New<?=$j?>()">&nbsp;																																							
													</td>
												</tr>
												<tr class="tblContent">
													<td></td>
													<td>
													<table><tr><td>Thumbnail<?=$j?></td></tr>
													</table>
													</td>																										
												</tr>																						
												<tr class="tblContent">
													<td>Thumbnail (80 x 90)</td>
													<td><input type="file" class="txtbox" name="thumbnail<?=$j?>"></td>
												</tr>
												<tr class="tblContent">
													<td colspan="2" align="center">
														<input type="button" value="Upload Thumbnail<?=$j?>" class="butten" onClick="Upload_New<?=$j?>()">&nbsp;
													</td>
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