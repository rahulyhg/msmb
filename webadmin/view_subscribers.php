<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging.php");
include("includes/menu.php");
$linkid = db_connect();

$arg="";
isAdmin($arg);

if($_REQUEST['Action']=="Delete")
{
	for($icnt=0;$icnt<count($_REQUEST['chkSelect']);$icnt++)
	{
		$sql="delete from tbl_subscribe where subscribe_id=".$_REQUEST['chkSelect'][$icnt];				
		mysql_query($sql);
		echo mysql_error();
	}
	$_SESSION['_msg']="Subscriber(s) Deleted Successfully";
	header("Location:view_subscribers.php");
	die();
}
if($_REQUEST["Action"]=="activate")
{
	for($icnt=0;$icnt<count($_REQUEST['chkSelect']);$icnt++)
	{
		$sql="update tbl_subscribe set status='Y' where subscribe_id=".$_REQUEST['chkSelect'][$icnt];		
		mysql_query($sql);
		echo mysql_error();
	}
	$_SESSION['_msg']="Subscriber(s) Activated Successfully";
	header("Location:view_subscribers.php?page=".$_REQUEST['page']);
	die();
}
if($_REQUEST["Action"]=="deactivate")
{
	for($icnt=0;$icnt<count($_REQUEST['chkSelect']);$icnt++)
	{
		$sql="update tbl_subscribe set status='N' where subscribe_id=".$_REQUEST['chkSelect'][$icnt];		
		mysql_query($sql);
		echo mysql_error();
	}
	$_SESSION['_msg']="Subscriber(s) DeActivated Successfully";
	header("Location:view_subscribers.php?page=".$_REQUEST['page']);
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
function fnDelete()
{
	if(notChecked(document.thisForm.elements['chkSelect[]'],'Subscriber(s) to Delete')) return false;
	if (confirm("Are you sure to delete the selected Subscriber(s)?")==true)
	{
		thisForm.action="view_subscribers.php?Action=Delete"
		thisForm.submit();
	}
}
function fnActive()
{
	if(notChecked(document.thisForm.elements['chkSelect[]'],'Subscriber to Activate')) return false;
	thisForm.action="view_subscribers.php?Action=activate"
	thisForm.submit();
}
function fnDeactive()
{
	if(notChecked(document.thisForm.elements['chkSelect[]'],'Subscriber to Deactivate')) return false;
	if (confirm("Are your sure, do you want to deactivate the selected Subscriber(s)?")==true)
	{
		thisForm.action="view_subscribers.php?Action=deactivate"
		thisForm.submit();
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
						<td class="subtitle">Manage Subscribers</td>
						<td align="right"><a href="view_newsletters.php">View Newsletters</a>&nbsp;|&nbsp;<a href="send_newsletter.php">Send Newsletters</a></td>
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
						$sql="select * from tbl_subscribe order by subscribe_id asc";
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
								<td idth="250"><b>Email Address</b></td>
								<td><b>Date</b></td>
								<td width="100"><b>Status</b></td>								
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
									<td width="30" align="center"><input type='checkbox' name="chkSelect[]" value='<? echo $rs->subscribe_id?>'></td>
									<td align="center" width="30"><? echo $rCnt ?></td>
									<td width="250"><? echo $rs->email;?></td>
									<td><? 
											if ($rs->subscribe_date)
												echo strftime("%d %b %y",strtotime($rs->subscribe_date));
										?>
									</td>
									<? if($rs->status=='Y'){?>	
									<td width="100"><img src="images/tick.gif" border="0"></td>
									<? }else{?>
									<td width="100"><img src="images/cross.gif" border="0"></td>	
									<? } ?>															
 								</tr>
						<?
							$rCnt++;
						}	?>		
							<tr><td colspan="5" align="center" bgcolor="#FFFFFF">							
							<input type="button" name="btnactive" class="butten" value="Activate" onClick="return fnActive();">
							<input type="button" name="btnClick" class="butten" value="Delete" onClick="fnDelete()">
							<input type="button" name="btndeactive" class="butten" value="Deactivate" onClick="return fnDeactive();">
							</td></tr>					
							</form>
							</table>
							<? getpageNumbers($pager->numPages,$page,"view_subscribers.php");?>
						<?
							mysql_free_result($res);
						}else{
							echo "<br><br><center>No subscribers details Found.</center>";
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