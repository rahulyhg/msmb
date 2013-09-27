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

if ($action == "upload") {

	if (!is_dir("../userthumbnail")) {
		mkdir("../userthumbnail");
		chmod("../userthumbnail",0777);
	}	
	if ($HTTP_POST_FILES['thumbnail1']['name'] != "") {			
		$thumbnail1 = post_img($HTTP_POST_FILES['thumbnail1']['name'], $HTTP_POST_FILES['thumbnail1']['tmp_name'],"../userthumbnail");
		$sql = "update tbl_photo set thumbnail='$thumbnail1' where id = '$photoid'";
		$imgRes = Execute($sql);
	}
	if ($HTTP_POST_FILES['thumbnail2']['name'] != "") {			
		$thumbnail2 = post_img($HTTP_POST_FILES['thumbnail2']['name'], $HTTP_POST_FILES['thumbnail2']['tmp_name'],"../userthumbnail");
		$sql = "update tbl_photo set thumbnail='$thumbnail2' where id = '$photoid'";
		$imgRes = Execute($sql);
	}
	if ($HTTP_POST_FILES['thumbnail3']['name'] != "") {			
		$thumbnail3 = post_img($HTTP_POST_FILES['thumbnail3']['name'], $HTTP_POST_FILES['thumbnail3']['tmp_name'],"../userthumbnail");
		$sql = "update tbl_photo set thumbnail='$thumbnail3' where id = '$photoid'";
		$imgRes = Execute($sql);
	}
	$_SESSION['Msg'] = "Image uploaded successfully";
	header("Location: photo.php?id=$userid");
	die();
} else if ($action == "approve") {

	$userphoto = GetSingleRecord("tbl_photo","id",$photoid);
	if ($userphoto) {
		$sql = "update tbl_photo set approve = 1 where id = '$photoid'";
		$imgRes = Execute($sql);
	}
	$_SESSION['Msg'] = "Photo uploaded successfully";
	header("Location: photo.php?id=$userid");
	die();
} else if ($action == "reject") {

	$userphoto = GetSingleRecord("tbl_photo","id",$photoid);
	if ($userphoto) {
		$sql = "delete from tbl_photo where id = '$photoid'";
		$imgRes = Execute($sql);
	}
	$_SESSION['Msg'] = "Image deleted successfully";
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
	function Upload1(id) {	
		f1 = document.thisForm;		
		if (!isNull(f1.thumbnail1,"Upload thumbanail1")) {
			document.thisForm.action = "photo.php?action=upload&photoid=" + id;
			document.thisForm.submit();		
		}	
	}
	function Upload2(id) {	
		f1 = document.thisForm;		
		if (!isNull(f1.thumbnail2,"Upload thumbanail2")) {
			document.thisForm.action = "photo.php?action=upload&photoid=" + id;
			document.thisForm.submit();		
		}	
	}
	function Upload3(id) {	
		f1 = document.thisForm;		
		if (!isNull(f1.thumbnail3,"Upload thumbanail3")) {
			document.thisForm.action = "photo.php?action=upload&photoid=" + id;
			document.thisForm.submit();		
		}	
	}
	function Approve(id) {
		document.thisForm.action = "photo.php?action=approve&photoid=" + id;
		document.thisForm.submit();
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
						<td class="subtitle">Manage Members</td>
						<td align="right"><a href="view_members.php">View Members</a></td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->			
				<form name="thisForm" method="post" onSubmit="return fnValidate();">				
					<input type="hidden" name="action" value="update">
					<input type="hidden" name="id" value="<?=$id?>">
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
													<td><img src="<?=$enlarge?>" border="0"></td>
													<td>
													<table><tr><td>Enlarge<?=$i?></td></tr>
													<tr><td>Status: 
													<? if ($userphoto[approve]) { echo "<b>Approved</b>"; } else { echo "<b>Not yet approved</b>"; } ?>
													</td></tr></table>
													</td>																										
												</tr>
												<? if ($thumbnail) { ?>
												<tr class="tblContent">
													<td><img src="<?=$thumbnail?>" border="0"></td>
													<td>
													<table><tr><td>Thumbnail<?=$i?></td></tr>
													<tr><td>Status: 
													<? if ($userphoto[approve]) { echo "<b>Approved</b>"; } else { echo "<b>Not yet approved</b>"; } ?>
													</td></tr></table>
													</td>																										
												</tr>
												<? } ?>
												<? if (!$thumbnail) { ?>
												<tr class="tblContent">
													<td>Upload thumbnail</td>
													<td><input type="file" class="txtbox" name="thumbnail<?=$i?>"></td>
												</tr>
												<? } ?>
												<tr class="tblContent">
													<td colspan="2" align="center"><input type="button" value="Upload" class="butten" onClick="Upload<?=$i?>('<?=$userphoto[id]?>')">&nbsp;<input type="button" value="Approve" class="butten" onClick="Approve('<?=$userphoto[id]?>')">&nbsp;<input type="button" value="Reject" class="butten" onClick="Reject('<?=$userphoto[id]?>')"></td>
												</tr>													
												<tr class="tblContent">
													<td colspan="2">&nbsp;</td>
												</tr>
												<?
												$thumbnail = "";
												$enlarge = "";	
												$i++;
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
				<script language="javascript">
					f1 = document.thisForm.verifiedStatus;
					ViewCheckedBy(f1);
				</script>
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