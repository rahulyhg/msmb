<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
$linkid=db_connect();
$arg="successful_stories_status";
isAdmin($arg);

if($_REQUEST['Mode']=="Save"){
	$precent_date=getdate();
	$filename=$precent_date[year].$precent_date[mon].$precent_date[mday].$precent_date[hours].$precent_date[minutes].$precent_date[seconds];	
	$filename=$filename.".html";
	if($_FILES['fileImage']['name']!=""){
		$img_story_image=post_img($_FILES['fileImage']['name'], $_FILES['fileImage']['tmp_name'],"../successful_stories_images");
		$thumbnail_name="thumb_".$img_story_image;
		fnMagic($_FILES['fileImage']['tmp_name'],"../successful_stories_images/".$thumbnail_name,120,120);	
		$fileid = fopen("../successful_stories/".$filename,"w+");
		$strFileContent=$_REQUEST['description'];
		$strmsg = $strFileContent;
		fwrite($fileid,$strmsg);
		fclose($fileid);
		$table="tbl_successful_stories";
		$insert_string=array("title"=>$_REQUEST['txtTitle'],"author"=>$_REQUEST['txtAuthor'],"bride"=>$_REQUEST['cmbBride'],"groom"=>$_REQUEST['cmbGroom'],"marriage_date"=>$_REQUEST['txtDate'],"marriage_year"=>$_REQUEST['txtYear'],"file_name"=>$filename,"image"=>$img_story_image,"created_date"=>date('U'));	
		$status=DB_Insert($linkid,$table,$insert_string);							
		$_SESSION['_msg']="Story details stored successfully.";
	}	
?>
<script language="JavaScript">window.location.href="add_successful_stories.php";</script>
<?
die();	
}

if($_REQUEST['Mode']=="Update"){
	
	$res_chk=mysql_query("select * from tbl_successful_stories where auto_id=".$_REQUEST['story_id']);
	if(mysql_num_rows($res_chk)>0){
		$obj=mysql_fetch_object($res_chk);
	}
	
	if($_FILES['fileImage']['name']!=""){
		$img_story_image=post_img($_FILES['fileImage']['name'], $_FILES['fileImage']['tmp_name'],"../successful_stories_images");
		$thumbnail_name="thumb_".$img_story_image;
		fnMagic($_FILES['fileImage']['tmp_name'],"../successful_stories_images/".$thumbnail_name,120,120);	
		
		if(file_exists("../successful_stories_images/".$_REQUEST['txtHidImage'])){
			unlink("../successful_stories_images/".$_REQUEST['txtHidImage']);
			unlink("../successful_stories_images/"."thumb_".$_REQUEST['txtHidImage']);
		}
				
		$fp = fopen("../successful_stories/".$obj->file_name,"w+");
		$strFileContent=$_REQUEST['description'];
		$strmsg = $strFileContent;
		fwrite($fp,$strmsg);
		fclose($fp);
		
		$sql_update="update tbl_successful_stories set title='".$_REQUEST['txtTitle']."',author='".$_REQUEST['txtAuthor']."',bride='".$_REQUEST['cmbBride']."',groom='".$_REQUEST['cmbGroom']."',marriage_date='".$_REQUEST['txtDate']."',marriage_year='".$_REQUEST['txtYear']."',image='".$img_story_image."' where auto_id=".$_REQUEST['story_id'];
		mysql_query($sql_update);
		echo mysql_error();
		$_SESSION['_msg']="Story details updated successfully.";										
		
	}else{		
		
		$fp = fopen("../successful_stories/".$obj->file_name,"w+");
		$strFileContent=$_REQUEST['description'];
		$strmsg = $strFileContent;
		fwrite($fp,$strmsg);
		fclose($fp);
		
		$sql_update="update tbl_successful_stories set title='".$_REQUEST['txtTitle']."',author='".$_REQUEST['txtAuthor']."',bride='".$_REQUEST['cmbBride']."',groom='".$_REQUEST['cmbGroom']."',marriage_date='".$_REQUEST['txtDate']."',marriage_year='".$_REQUEST['txtYear']."' where auto_id=".$_REQUEST['story_id'];
		mysql_query($sql_update);
		echo mysql_error();
		$_SESSION['_msg']="Story details updated successfully.";	
			
	}

?>
<script language="JavaScript">window.location.href="view_successful_stories.php";</script>
<?	
die();
}


function rteSafe($strText) {
	//returns safe code for preloading in the RTE
	$tmpString = $strText;
	
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);
	
	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);
//	$tmpString = str_replace("\"", "\"", $tmpString);
	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	
	return $tmpString;
}

if($_REQUEST['story_id']!=""){
	$sql_in="select * from tbl_successful_stories where auto_id=".$_REQUEST['story_id'];	
	$res_in=mysql_query($sql_in);
	if(mysql_num_rows($res_in)>0){
		$res1=mysql_fetch_object($res_in);
	}	
}

?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>

<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>

<!-- START : Included Script and Styles for Text Editor -->	
<link href="includes/rte.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="includes/richtext.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/html2xhtml.js"></script>
<!-- END : Included Script and Styles for Text Editor -->

<script language="JavaScript">
function Trim(Str){ 
	return Str.replace(/(^\s*)|(\s*$)/g,""); 
}

function fnValidate(){  
	updateRTE('rte1');
	var sMsg;
	sMsg=document.thisForm.rte1.value;
	document.thisForm.description.value=sMsg;
	if(isNull(document.thisForm.txtTitle,"Title")){return false;}
	if(isNull(document.thisForm.txtAuthor,"Author")){return false;}	
	/*if (notSelected(document.thisForm.cmbBride,"Bride")) { return false; }		
	if (notSelected(document.thisForm.cmbGroom,"Groom")) { return false; }	*/
	if (isNull(document.thisForm.txtDate,"Date of marriage")){return false;}
	if (isNull(document.thisForm.txtYear,"Year of marriage")){return false;}
	
	if(document.thisForm.txtHidImage.value==""){
		if(isNull(document.thisForm.fileImage,"Image")){return false;}
		if(notImageFile(document.thisForm.fileImage,"Image")){return false;}	
	}else{
		if(document.thisForm.fileImage.value!=""){
			if(notImageFile(document.thisForm.fileImage,"Image")){return false;}	
		}	
			
	}		
 		
	if(document.thisForm.rte1.value==""){
		alert("Please enter the Successful stories description");
		frames['rte1'].focus();
		return false;
	}			
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
						<td class="subtitle">Manage Successful Stories</td>
						<td align="right"><a href="view_successful_stories.php">View Successful Stories</a></td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
				<?
					if($_REQUEST['story_id']==""){
						$secMode="Save";
					}else{
						$secMode="Update";
					}
				?>
				<form name="thisForm" method="post"  action="add_successful_stories.php?Mode=<? echo $secMode?>&story_id=<? echo $_REQUEST['story_id'];?>" enctype="multipart/form-data" onSubmit="return fnValidate();">
				<input type="hidden" name="id" value="<?=$_REQUEST['id'];?>">					
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="520">
						<tr><td>
							<table cellpadding="10" cellspacing="1" border="0" width="500" class="tblBorder">
							<tr class="tblHead"><td align="center"><b>
								<?
								if ($_REQUEST["story_id"]!=""){
									echo "Update Successful Stories";
								} else {
									echo "Add Successful Stories";
								}
								?>
							</b></td></tr>
							<tr class="tblContent"><td>
								<table cellpadding="5" cellspacing="1" border="0" width="500" class="tblBorder">								
									<tr class="tblContent">
										<td>Title<font color="#FF0000">*</font></td>
										<td><input type="text" name="txtTitle" class="txtbox" id="title" value="<?=$res1->title ?>" maxlength="255"></td>										
									</tr>
									<tr class="tblContent">
										<td>Author<font color="#FF0000">*</font></td>
										<td><input type="text" name="txtAuthor" class="txtbox" id="author" value="<?=$res1->author ?>" maxlength="255"></td> 
									</tr>
									
									<?
									$sql_bride="select * from tbl_register where gender='F'";
									$res_bride=mysql_query($sql_bride);
									?>
									<tr class="tblContent">
									  <td>Bride<?php /*?><font color="#FF0000">*</font><?php */?></td>
									  <td><select name="cmbBride" class="cmbbox">
									          <option value="">--Select--</option>
											  <? if(mysql_num_rows($res_bride)>0){
											     while($obj_bride=mysql_fetch_object($res_bride)){
											  ?>
											    <option value="<?=$obj_bride->id ?>"><?=$obj_bride->username."-".$obj_bride->name ?></option>
											  <? }//while
											  }//if 
											  ?>
										  </select>
									   </td> 
									<? if($res1->bride){?>
									<script language="JavaScript">document.thisForm.cmbBride.value="<? echo $res1->bride;?>";</script>
									<? }?>

									</tr>
									
									<?
									$sql_groom="select * from tbl_register where gender='M'";
									$res_groom=mysql_query($sql_groom);
									?>
									<tr class="tblContent">
										<td>Groom<?php /*?><font color="#FF0000">*</font><?php */?></td>
										<td><select name="cmbGroom" class="cmbbox">
										    <option value="">--Select--</option>
										      <? if(mysql_num_rows($res_groom)>0){
											     while($obj_groom=mysql_fetch_object($res_groom)){
											  ?>
											<option value="<?=$obj_groom->id ?>"><?=$obj_groom->username."-".$obj_groom->name ?></option>
											 <? }//while
											  }//if 
											  ?>
											</select>
										</td> 
										<? if($res1->groom){?>
										<script language="JavaScript">document.thisForm.cmbGroom.value="<? echo $res1->groom;?>";</script>
										<? }?>
									</tr>
									<tr class="tblContent">
										<td>Date of Marriage<font color="#FF0000">*</font></td>
										<td><input type="text" name="txtDate" class="txtbox" value="<?=$res1->marriage_date; ?>"></td>
									</tr>
									
									<tr class="tblContent">
									    <td>Year of Marriage<font color="#FF0000">*</font></td>
									    <? 
										$sql_year="select date_format(current_date(),'%Y') as currentyear";
										$res_year=mysql_query($sql_year);
										$obj_year=mysql_fetch_object($res_year);
										$start_year=$obj_year->currentyear;

										?>
									    <!--<td>
										<input type="text" name="txtYear" class="txtbox" value="<?//=$res1->marriage_year; ?>">-->
										
										<td>
										<select name="txtYear" class="cmbbox">
								           <option value="">--Select--</option>
								             <? 
								                for($i=$start_year-1;$i<=$start_year+8;$i++){
								             ?>
								           <option value="<?=$i;?>"><?=$i;?></option>
							 	            <? } ?>
						                </select>
										<? if($res1->marriage_year!=""){ ?>
									    <script language="JavaScript">document.thisForm.txtYear.value="<?=$res1->marriage_year;?>"</script>							<? } ?>
										</td>
									</tr>

									
									<tr class="tblContent">
										<td>Image<font color="#FF0000">*</font></td>
										<td><input type="file" name="fileImage"  id="fileImage" class="txtbox"> <br>
										<? if($res1->image!="") {echo "<img src='../successful_stories_images/"."thumb_".$res1->image."'>";} ?> 
										<input type="hidden" name="txtHidImage" value="<? echo $res1->image;?>">
										</td> 
									</tr>
									<?
										if($_REQUEST['story_id']!=""){
											if(file_exists("../successful_stories/".$res1->file_name)){
												$filename="../successful_stories/".$res1->file_name;
												$fp=fopen($filename,"r");
												if (filesize($filename))
													$contents=fread($fp,filesize($filename));
												fclose($fp);
											}
										}
									?>
									
									<tr class="tblContent">
									    <td colspan="2">Success Story Description <font color="#FF0000">*</font></td>
									</tr>
									
									<tr class="tblContent">
									   <td colspan="2">									   		
												<script language="JavaScript" type="text/javascript">
													initRTE("images/", "", "", true);
												</script>
													<noscript><p><b>Javascript must be enabled to use this form.</b></p></noscript>
												<script language="JavaScript" type="text/javascript">
													writeRichText('rte1', '<? echo rteSafe($contents);?>',520, 200, true, false);
													//-->
												</script>
												<input type="hidden" name="description">									  
									   </td>
									</tr>
									
									<tr class="tblContent">
									    <td align="center" height="30" colspan="2"><input type="submit" value="Save" class="butten"></td>
									</tr>
								</table>
							</td></tr>
							</table>
						</td></tr>
						</table>
				 	</td></tr>
					<tr><td height="10"></td></tr>
			 		</table>
					<script language="javascript">
											document.thisForm.txtTitle.focus();
										</script>
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
