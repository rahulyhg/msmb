<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging.php");
include("includes/menu.php");
$linkid = db_connect();
$arg="advertisement_status";
isAdmin($arg);

if($_REQUEST['mode']=="del"){
	if($_REQUEST['ChkS']<>""){
			for($i=0;$i<count($_REQUEST['ChkS']);$i++){
				$sql_chk="select * from tbl_advertisements where auto_id=".$_REQUEST['ChkS'][$i];
				$res_chk=mysql_query($sql_chk);
				echo mysql_error();
				if(mysql_num_rows($res_chk)>0){
					$obj_chk=mysql_fetch_object($res_chk);
					if($obj_chk->banner_image!=""){
						if(file_exists("../ad_banner_images/".$obj_chk->banner_image)){							
							unlink("../ad_banner_images/".$obj_chk->banner_image);
						}
					}
				}
				$del_query="delete from tbl_advertisements where auto_id =".$_REQUEST['ChkS'][$i]."";	
				mysql_query($del_query);	
				echo mysql_error();
			}	
	}

$_SESSION['_msg']="Advertisements deleted successfully";
header("location:view_advertisements.php");
die();
	
}	

?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript">
function fnDelete(){
	if(notChecked(document.thisForm.elements["ChkS[]"],"Advertisements to delete")) {return;}
	if(confirm("Are you sure to delete the selected Advertisement(s)?")==true){
		document.thisForm.action="view_advertisements.php?mode=del";
		document.thisForm.submit();
	} 
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
						<td class="subtitle">Manage Advertisements</td>
						<td align="right"><a href="add_advertisements.php">Add Advertisements</a></td>
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
						$sql="select * from tbl_advertisements order by auto_id desc";
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
							<table cellpadding="5" cellspacing="1" border="0" width="650" class="tblBorder">
							<form name="thisForm" method="post">
							<tr class="tblHead">
								<td align="center"><b>Select</b></td>
								<td align="center"><b>S.No</b></td>
								<td><b>Banner title</b></td>								
								<td><b>Website URL</b></td>								
								<td><b>Banner type & display </b></td>
								<td><b>Created date</b></td>
								<td><b>Posted by</b></td>																
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
									<td align="center"><input type='checkbox' name="ChkS[]" value='<? echo $rs->auto_id?>'></td>
									<td align="center"><? echo $rCnt ?></td>
									<td><a href="add_advertisements.php?banner_id=<? echo $rs->auto_id;?>"><? echo $rs->banner_title;?></a></td>									
									<td><? if($rs->website_url!=""){ echo "<a href=http://".$rs->website_url." target=\"_blank\">$rs->website_url</a>";}else{ echo "-";} ?></td>		
									<td><? echo banner_type($rs->banner_display_type); ?></td>							
									<td><? echo strftime('%d %b %Y',strtotime($rs->created_date))?></td>
									<td><?=GetSingleField("admin_loginname","tbl_admin","id",$rs->posted_by);?></td>
 								</tr>
						<?
							$rCnt++;
						}	?>		
							<tr><td colspan="7" align="center" bgcolor="#FFFFFF"><input type="button" name="btnClick" class="butten" value="Delete" onClick="fnDelete()"></td></tr>					
							</form>
							</table>
							<? getpageNumbers($pager->numPages,$page,"view_advertisements.php");?>
						<?
							mysql_free_result($res);
						}else{
							echo "<br><br><center>No Advertisements details Found.</center>";
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
<?
function banner_type($id){	
	$array_master=array(0=>"HOME PAGE RIGHT BOTTOM",1=>"ROS TOP BANNER",2=>"SEARCH TOP",3=>"SEARCH LEFT",4=>"LOGOUT	PAGE",5=>"PHOTO VIEW PAGE",6=>"WEDDING DIRECTORY TOP",7=>"BOTTOM BANNER",8=>"HOME PAGE TOP BANNER");
	foreach($array_master as $key => $value){
		if($key==$id){
			$banner_name=$value;						
		}
	}
	return $banner_name;	
}


function convertdate($date)
	{
	$lastdt=explode("-",$date);
	$lastdate=$lastdt[2]."-".$lastdt[1]."-".$lastdt[0];
	return $lastdate;
	}
?>