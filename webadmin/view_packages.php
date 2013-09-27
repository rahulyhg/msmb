<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging.php");
include("includes/menu.php");
$linkid = db_connect();
$arg="package_status"; 
isAdmin($arg);

if($_REQUEST['mode']=="del"){
	if($_REQUEST['ChkS']<>""){
		for($i=0;$i<count($_REQUEST['ChkS']);$i++){
			
			$sql_chk="select * from tbl_register where package_type='".$_REQUEST['ChkS'][$i]."'";
			$res_chk=mysql_query($sql_chk);
			if(mysql_num_rows($res_chk)>0){	
					$_SESSION['_msg']="Sorry! Unable to remove the package, as it is selected by members."; 		
					header("location:view_packages.php");
					die();				
			}else{
				 $sql_file="select * from tbl_packages where  package_id =".$_REQUEST['ChkS'][$i];
				$res_file=mysql_query($sql_file);
				if(mysql_num_rows($res_chk)==0)
				{
					$obj=mysql_fetch_object($res_file);
					unlink("../package_features/".$obj->file_name,"w+");
				}										
				$sql="delete from tbl_packages where package_id =".$_REQUEST['ChkS'][$i];
				mysql_query($sql);
				echo mysql_error();			
				$_SESSION['_msg']="Deleted Successfully"; 		
			}			
	  	}

		header("location:view_packages.php");
		die();
	}
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
	if(notChecked(document.thisForm.elements["ChkS[]"],"Package to delete")) {return;}
	if(confirm("Are you sure to delete the selected Package(s)?")){
		document.thisForm.action="view_packages.php?mode=del";
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
						<td class="subtitle">Manage Packages</td>
						<td align="right"><a href="add_packages.php">Add Packages</a></td>
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
						$sql="select * from tbl_packages order by package_id asc";
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
								<!--<td widht='30' align="center"><b>Select</b></td>-->
								<td width="30" align="center"><b>S.No</b></td>
								<td idth="250"><b>Package title</b></td>
								<td idth="250"><b>Package Amount</b></td>
								<td idth="250"><b>No of Month(s)</b></td>
																
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
									<!--<td width="30" align="center"><input type='checkbox' name="ChkS[]" value='<? echo $rs->package_id?>' <? if($rs->package_id==1) echo "disabled='disabled'"; ?> ></td>-->
									<td align="center" width="30"><? echo $rCnt ?></td>
									<td idth="250"><a href="add_packages.php?package_id=<? echo $rs->package_id;?>"><? echo $rs->package_name;?></a></td>									
									<td><? echo $rs->package_price;?></td>
									<td><? echo $rs->valid_period;?></td>
 								</tr>
						<?
							$rCnt++;
						}	?>		
							<!--<tr><td colspan="5" align="center" bgcolor="#FFFFFF"><input type="button" name="btnClick" class="butten" value="Delete" onClick="fnDelete()"></td></tr>-->					
							</form>
							</table>
							<? getpageNumbers($pager->numPages,$page,"view_packages.php");?>
						<?
							mysql_free_result($res);
						}else{
							echo "<br><br><center>No Package details Found.</center>";
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