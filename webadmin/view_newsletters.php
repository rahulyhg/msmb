<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging.php");
include("includes/menu.php");

$linkid = db_connect();

$action = GetVar("action1");

$arg="newsletter_status";
isAdmin($arg);

if($_REQUEST['Action']=="Delete")
{
	for($icnt=0;$icnt<count($_REQUEST['ChkS']);$icnt++)
	{
	  $rs2 = mysql_query("select * from tbl_newsletter where newsletter_id=".$_REQUEST['ChkS'][$icnt]);
	  if(mysql_num_rows($rs2)>0)
		{
		  $obj2 = mysql_fetch_object($rs2);
		  if(file_exists("../sendnewsletter_files/".$obj2->description))
		  {
				unlink("../sendnewsletter_files/".$obj2->description);
		  }
		}   
		$sql="delete from tbl_newsletter where newsletter_id=".$_REQUEST['ChkS'][$icnt];
		mysql_query($sql);
		echo mysql_error();
	}
	$_SESSION['_msg']="Newsletter(s) Deleted Successfully";
	header("Location:view_newsletters.php");
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
	if(notChecked(document.thisForm.elements['ChkS[]'],'Newsletter(s) to Delete')) return false;
	if (confirm("Are you sure to delete the selected Newsletter(s)?")==true)
	{
		document.thisForm.action="view_newsletters.php?Action=Delete";
		document.thisForm.submit();
	}
}
function validate1() {
	f1 = document.thisForm;
	if (notSelected(f1.member_type,"member type")) { return false; }
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
						<td class="subtitle">Manage Newsletters</td>
						<td align="right"><a href="view_subscribers.php">View Subscribers</a>&nbsp;|&nbsp;<a href="send_newsletter.php">Send Newsletters</a></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<form name="thisForm" method="post">
					<input type="hidden" name="action1" value="search">
					<tr>
						<td>
							<table align="center">
							<tr><td align="right">Sort by newsletter sent to</td>
							<td>
								<select name="member_type" class="cmbbox">
									<option value="">--Select--</option>
									<option value="1">Register member</option>
									<option value="2">Subscriber</option>
									<option value="3">Registered & Subscribers Customers</option>
									<option value="4">Franchise</option>
								</select>
								<script language="javascript">
									document.thisForm.member_type.value = '<?=GetVar("member_type")?>';
								</script>
							</td>
							<td>
								<input type="submit" value="Search" class="butten" onClick="return validate1();">								
							</td>
							</tr></table>
						</td>
					</tr>	
					<tr><td align="center" valign="top">
						<table cellpadding="0" align="center" cellspacing="0" border="0" width="420">
						<tr><td>
						<?
						if ($action == 'search') {
							$sql="select * from tbl_newsletter where status = '" . $_REQUEST['member_type'] . "' order by newsletter_id asc";
						} else {
							$sql="select * from tbl_newsletter order by newsletter_id asc";
						}	
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
							
							<tr class="tblHead">
								<td widht='30' align="center"><b>Select</b></td>
								<td width="30" align="center"><b>S.No</b></td>
								<td width="150"><b>Title</b></td>
								<td><b>Subject</b></td>	
								<td width="200"><b>Newsletter created date</b></td>															
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
									<td width="30" align="center"><input type="checkbox" name="ChkS[]" value="<? echo $rs->newsletter_id?>"></td>
									<td align="center" width="30"><? echo $rCnt ?></td>
									<td width="100"><a href="resend_newsletter.php?newsletter_id=<?=$rs->newsletter_id?>"><? echo $rs->title;?></a></td>
									<td width="100"><? echo $rs->subject;?></td>
									<td width="100"><? echo  strftime('%d %b %Y',strtotime($rs->created_date));?></td>
								</tr>
						<?
							$rCnt++;
						}	?>		
							<tr><td colspan="5" align="center" bgcolor="#FFFFFF">
							<input type="button" name="btnClick" class="butten" value="Delete" onClick="fnDelete()">
							</td></tr>					
							</form>
							</table>
							<? getpageNumbers($pager->numPages,$page,"view_newsletters.php");?>
						<?
							mysql_free_result($res);
						}else{
							echo "<br><br><center>No users Found.</center>";
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