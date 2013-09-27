<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging.php");
include("includes/menu.php");
$linkid = db_connect();

$arg="wedding_directory_status";
isAdmin($arg);


if($_REQUEST['mode']=="del"){
 
   for($i=0;$i<count($_REQUEST['ChkS']);$i++){
        $sqlcheck="select * from tbl_wedding_directory where directory_wedding_category='".$_REQUEST['ChkS'][$i]."'";
		$rescheck=mysql_query($sqlcheck);
		$objcheck=mysql_fetch_object($rescheck);
		
		if($objcheck->image!="")
		{
	     $file="../wedding_directory_images/".$objcheck->image;
  	     unlink($file);
		}

		
		$sqldel="delete from tbl_wedding_directory where directory_wedding_category='".$_REQUEST['ChkS'][$i]."'";
		mysql_query($sqldel);
		
		$sql="delete from tbl_wedding_category where category_id='".$_REQUEST['ChkS'][$i]."'";
		mysql_query($sql);
		echo mysql_error();			
		$_SESSION['_msg']="Deleted Successfully"; 		
    }//for
		header("location:view_wedding_category.php");
		die();
}//if

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
	if(notChecked(document.thisForm.elements["ChkS[]"],"Wedding Category to delete")) {return;}
	if(confirm("Deleting this Category will delete all the related Wedding Directory.Are you sure to delete the selected Wedding Category(s)?")){
		document.thisForm.action="view_wedding_category.php?mode=del";
		document.thisForm.submit();
	} else {
		return false;
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
						<td class="subtitle">Manage Wedding Category</td>
						<td align="right"><a href="add_wedding_category.php">Add Wedding Category</a></td>
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
						$sql="select * from tbl_wedding_category order by parent_category asc";
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
								<td width="250"><b>Wedding Category Name</b></td>								
								<td width="250"><b>Wedding Category Type</b></td>								
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
							<td width="30" align="center"><input type='checkbox' name="ChkS[]" value="<?=$rs->category_id; ?>" ></td>
									<td align="center" width="30"><? echo $rCnt ?></td>
									<td width="250"><a href="add_wedding_category.php?category_id=<? echo $rs->category_id;?>"><? echo $rs->category_name;?></a></td>		
									<td><? if($rs->parent_category==1){ echo "City";}else { echo "Category";} ?></td>							
 								</tr>
						<?
							$rCnt++;
						}	?>		
							<tr><td colspan="4" align="center" bgcolor="#FFFFFF"><input type="button" name="btnClick" class="butten" value="Delete" onClick="fnDelete()"></td></tr>					
							</form>
							</table>
							<? getpageNumbers($pager->numPages,$page,"view_wedding_category.php");?>
						<?
							mysql_free_result($res);
						}else{
							echo "<br><br><center>No Wedding Category details Found.</center>";
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
function convertdate($date)
	{
	$lastdt=explode("-",$date);
	$lastdate=$lastdt[2]."-".$lastdt[1]."-".$lastdt[0];
	return $lastdate;
	}
?>