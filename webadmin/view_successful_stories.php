<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging.php");
include("includes/menu.php");
$linkid = db_connect();

$arg="successful_stories_status";
isAdmin($arg);


if($_REQUEST['Mode']=="Delete"){
 for($i=0;$i<count($_REQUEST['ChkS']);$i++){
    $val=$_REQUEST['ChkS'][$i];
    delete($val);
 }
	$_SESSION['_msg']="Deleted Successfully";
	header("Location: view_successful_stories.php");
	die();	
}

function delete($id){
$sql="select * from tbl_successful_stories where auto_id='$id'";
$r=mysql_query($sql);
$res=mysql_fetch_object($r);

$file="../successful_stories/".$res->file_name;
unlink($file);

$image="../successful_stories_images/".$res->image;
unlink($image);
$image="../successful_stories_images/thumb_".$res->image;
unlink($image);

$sql1="delete from tbl_successful_stories where auto_id='$id'";
mysql_query($sql1);

}//function

if($_REQUEST['Mode']=="Activate"){
	if($_REQUEST['ChkS']<>""){
		for($i=0;$i<count($_REQUEST['ChkS']);$i++){
			$sql="update tbl_successful_stories set display_status='Y' where auto_id =".$_REQUEST['ChkS'][$i];
			mysql_query($sql);
			echo mysql_error();
			fnActive($_REQUEST['ChkS'][$i]);
									
			
		}
		$_SESSION['_msg']="Successful Stories Account(s) Activated successfully";
	}	
	header("location:view_successful_stories.php");
	die();
	
}

if($_REQUEST['Mode']=="DeActivate"){
	if($_REQUEST['ChkS']<>""){
		for($i=0;$i<count($_REQUEST['ChkS']);$i++){
			$sql="update tbl_successful_stories set display_status='N' where auto_id =".$_REQUEST['ChkS'][$i];
			mysql_query($sql);
			fnDeActive($_REQUEST['ChkS'][$i]);
			echo mysql_error();						
		}
		$_SESSION['_msg']="Successful Stories Account(s) De-Activated successfully";
	}	
	header("location:view_successful_stories.php");
	die();
	
}


function fnActive($arg){
	$res_chk=mysql_query("select * from tbl_successful_stories where auto_id=".$arg);
	if(mysql_num_rows($res_chk)>0){
		$obj=mysql_fetch_object($res_chk);		
	}
	$sql_update="update php121_users set php121_banned='0' where uemail='".$obj->franchisee_email."' and uname='".$obj->franchisee_username."'";
	mysql_query($sql_update);
	echo mysql_error();					
}

function fnDeActive($arg){
	$res_chk=mysql_query("select * from tbl_successful_stories where auto_id=".$arg);
	if(mysql_num_rows($res_chk)>0){
		$obj=mysql_fetch_object($res_chk);		
	}
	$sql_update="update php121_users set php121_banned='1' where uemail='".$obj->franchisee_email."' and uname='".$obj->franchisee_username."'";
	mysql_query($sql_update);
	echo mysql_error();
}
?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript">var linkPath="";</script>
<script language="javascript">
function fnDelete(){
     if(notChecked(document.thisForm.elements['ChkS[]'],'record to Delete'))
     return false;
	  
      if (confirm("Are you sure,you want to delete the selected article "))
       {
       thisForm.action="view_successful_stories.php?Mode=Delete"
       thisForm.submit();
       }
	else
 		return false;
	}

function fnActivate(){
	if(notChecked(document.thisForm.elements["ChkS[]"],"Successful Stories to Activate")) {return;}
	document.thisForm.action="view_successful_stories.php?Mode=Activate";
	document.thisForm.submit();
}
function fnDeActivate(){
	if(notChecked(document.thisForm.elements["ChkS[]"],"Successful Stories to De-Activate")) {return;}
	document.thisForm.action="view_successful_stories.php?Mode=DeActivate";
	document.thisForm.submit();
}
</script>
</head>
<body topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">
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
						<td class="title">Welcome <font class="session"><? echo $_SESSION['_user']; ?></font></td>
						<td align="right" class="session"><? echo $_SESSION['_msg']; ?><? $_SESSION['_msg'] = "";?></td>
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
						<td align="right"><a href="add_successful_stories.php">Add Successful Stories</a></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" align="center" cellspacing="0" border="0" width="420">
						<tr><td>
						<?
						$sql="select * from tbl_successful_stories order by marriage_year,created_date,auto_id asc";
						$res=mysql_query($sql);	
						echo mysql_error();
						$no=mysql_num_rows($res);
							//pager starts Here
						if($_REQUEST['page']=="")
							$page =1;
						else
							$page=$_REQUEST['page'];
							$total	=	$no;
							$limit	=	10;
							$pager	=	Pager::getPagerData($total, $limit, $page);
							$offset	=	$pager->offset;
							$limit	=	$pager->limit;
							$page	= 	$pager->page;
						//pager ends Here
						$res=mysql_query($sql." limit  $offset, $limit"); 
						if($no>0){
							$rCnt=1;	
						?>
							<table cellpadding="5" cellspacing="1" border="0" width="550" class="tblBorder">
							<form name="thisForm" method="post">
							<tr class="tblHead">
								<td widht='30' align="center"><b>Select</b></td>
								<td width="30" align="center"><b>S.No</b></td>
								<td idth="220"><b>Name</b></td>	
								<td idth="220"><b>Date</b></td>
								<td idth="220"><b>Year</b></td>
								<td><b>Posted Date</b></td>
								<td width="30"><b>Active Status</b></td>										
 							</tr>
						<?
							if ($page!=1){
								$rCnt = ($limit*($page-1)+1);
							} else {
								$rCnt=1;
							}
						?>
						<?	while($rs=mysql_fetch_object($res)){ ?>
								<tr class="tblContent">
									<td width="30" align="center"><input type='checkbox' name="ChkS[]" value='<? echo $rs->auto_id?>'></td>
									<td align="center" width="30"><? echo $rCnt ?></td>
									<td width="250"><a href="add_successful_stories.php?story_id=<? echo $rs->auto_id;?>">
										<? 
											if ($rs->title) {
												echo $rs->title;
											} else {
												echo 'Edit';
											}
										?>
									</a></td>									
									<td><? echo $rs->marriage_date?></td>
									<td><? echo $rs->marriage_year?></td>
									<td><? echo strftime("%d/%m/%Y",$rs->created_date)?></td>
									<td>
									<? if($rs->display_status=="N"){?>
										<img src="images/cross.gif" border="0">	
									<? }else{?>
									<img src="images/tick.gif" border="0">
									<? }?>
									</td>		
 								</tr>
						<?
							$rCnt++;
						}	?>		
							<tr><td colspan="7" align="center" bgcolor="#FFFFFF">								
							<input type="button" name="btns" value="Activate" onClick="fnActivate();" class="butten"> &nbsp;
							<input type="button" name="btnClick" class="butten" value="Delete" onClick="fnDelete()">&nbsp;
							<input type="button" name="btns" value="De-Activate" onClick="fnDeActivate();" class="butten">
							</td></tr>					
							</form>
							</table>
							<? getpageNumbers($pager->numPages,$page,"view_successful_stories.php");?>
						<?
							mysql_free_result($res);
						}else{
							echo "<br><br><center>No successful stories found..</center>";
						}
						?>
						</td></tr>
						</table>
					</td></tr>
					</table>
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
