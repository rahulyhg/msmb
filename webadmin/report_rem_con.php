<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging1.php");
include("includes/menu.php");
$linkid = db_connect();
$action = GetVar("action1");
isAdmin($arg);

?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript">
function validate1() {
	f1 = document.thisForm;
	if (notSelected(f1.rem_type,"Reminder type")) { return false; }
}
function funchange(mode) {
	if(notChecked(document.thisForm.elements["ChkS[]"],"Members to Confirmation and Reminder")) {return false;}
	var url;
	if(mode!='0') {
		url = "rem_newsletter.php?con_rem_id="+mode+"&action1=<?=GetVar("action1")?>";
	}
	else {
		url = "rem_con_newsletter.php?con_rem_id="+mode+"&action1=<?=GetVar("action1")?>";
	}
	document.thisForm.action=url;
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
						<td class="subtitle">Report Confirmation and Reminder</td>
						<td align="right"></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<form name="thisForm" method="post"  onSubmit="return validate1();">
					<input type="hidden" name="action1" value="search">	
					<tr>
						<td>
							<table align="center">
							<tr><td align="right"></td>
							<td>
								<select name="rem_type" class="cmbbox">
									<option value="">--Select--</option>
									<?	$resCat = Execute("select * from tbl_confirmation_reminder order by category_name");
											if (mysql_num_rows($resCat) > 0) {
												while ($cat = mysql_fetch_array($resCat)) {								
											?>
											<option value="<?=$cat[auto_id]?>"><?=$cat[category_name]?></option>
										<?  	}
											} ?>	
								</select>
								<script language="javascript">
									document.thisForm.rem_type.value = '<?=$_REQUEST['rem_type']?>';
								</script>
							</td>
							<td>
								<input type="submit" value="Search" class="butten">								
							</td>
							</tr></table>
						</td>
					</tr>	
					<tr><td align="center" valign="top">
						<table cellpadding="0" align="center" cellspacing="0" border="0" width="420">
						<tr><td>
						<?
						if ($action == 'search') {
							$sql="select * from tbl_con_rem_newsletter where con_rem_id_fk = '" . $_REQUEST['rem_type'] . "' order by send_date desc";
						/*else {
							$sql="select * from tbl_con_rem_newsletter order by send_date asc";
   						    //$sql="select * from tbl_con_rem_newsletter where con_rem_id_fk = '" . $_REQUEST['rem_type'] . "' order by send_date desc";
						}*/
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
							$rem_type=GetSingleField("category_name","tbl_confirmation_reminder","auto_id",$_REQUEST['rem_type'])
						?>
							<table border=0 cellpadding=1 cellspacing=5 width=100% height=25 bgcolor='#FFFFFF'>
							<tr class='menubg' height='25'>
							<td align=center style="background-color:#ccc90f"><A  style="cursor:pointer" onClick="return funchange('4')" title='Deleted' class='menu1'>Deleted</A></td>
							<td align=center  style="background-color:#ffcc00"><A style="cursor:pointer" onClick="return funchange('8')" title='Photo Approval' class='menu1'>Photo Approval</A></td>
							<td align=center style="background-color:#ff9933"><A  style="cursor:pointer"onClick="return funchange('9')" title='De Activated' class='menu1'>De Activated</A></td>				
							<td align=center  style="background-color:#ff6600"><A style="cursor:pointer" onClick="return funchange('7')" title='Payment Not Received' class='menu1'>Payment Not Received</A></td>
							<td align=center  style="background-color:#ff6600"><A  style="cursor:pointer" onClick="return funchange('6')" title='Payment Ok' class='menu1'>Payment Ok</A></td>
							<td align=center owspan="2" width="75"><A onClick="return funchange('11')"  style="cursor:pointer"  title='Phone No Not Correct' class='menu1'>Phone No Not Correct</A></td>

							 </tr>
							 <tr class='menubg' height='25'>
							<td align=center style="background-color:#ff0066"><A style="cursor:pointer" onClick="return funchange('10')"  title='Expired Member' class='menu1'>Expired Member</A></td>									
							<td align=center style="background-color:#6600cc"><A style="cursor:pointer" onClick="return funchange('2')" title='Horoscope Request' class='menu1'>Horoscope Request</A></td>
							<td align=center style="background-color:#6666ff"><A style="cursor:pointer" onClick="return funchange('3')" title='Incomplete On Hold' class='menu1'>Incomplete On Hold</A></td>				
							<td align=center style="background-color:#333399"><A style="cursor:pointer" onClick="return funchange('1')" title='Photo Request' class='menu1'>Photo Request</A></td>
							<td align=center style="background-color:#1b1464"><A style="cursor:pointer" onClick="return funchange('5')" title='Activate' class='menu1'>Activate</A></td>
							<td align=center owspan="2" width="75" style="background-color:#666600"><A onClick="return funchange('0')"  style="cursor:pointer"  title='Customized Mail' class='menu1'>Customized Mail</A></td>
							 </tr>
							 </table>
							<table cellpadding="5" cellspacing="1" border="0" width="850" class="tblBorder">
							<tr class="tblHead"><tr><td colspan="10"><b><?=$rem_type?> Notification Report</b></td></tr>
							<tr class="tblHead">
								<td widht='30' align="center"><b>Select</b></td>
								<td width="30" align="center"><b>S.No</b></td>
								<td width="30" align="center"><b>ID</b></td>
								<td width="100"><b>Name</b></td>
								<td width="80"><b>Email ID</b></td>
								<td width="30" align="center"><b>Login date</b></td>
								<td width="30"><b>Membership type</b></td>	
								<td width="30" align="center"><b>Edited by</b></td>
								<? if(($_REQUEST['rem_type']==6)or($_REQUEST['rem_type']==7)) { ?><td align="center"><b>Status of Paid, Free or Renewed</b></td><? } ?>
								<!--<td width="30" align="center"><b>Status of <?=$rem_type?></b></td>-->
								<td ><b>Date of <?=GetSingleField("message","tbl_confirmation_reminder","auto_id",$_REQUEST['rem_type'])?> </b></td>															
 							</tr>
						<?
							if ($page!=1){
								$rCnt = ($limit*($page-1)+1);
							} else {
								$rCnt=1;
							}
						?>
						<?	while($rs=mysql_fetch_object($res)){ 
							$resmember = Execute("select * from tbl_register where id=$rs->id_fk");
							//if (mysql_num_rows($resCat) > 0) {
								$objmember = mysql_fetch_array($resmember);  ?>
								<tr class="tblContent">
									<td width="30" align="center"><input type='checkbox' name="ChkS[]" value='<? echo $objmember[id]?>'></td>
									<td align="center" width="30"><? echo $rCnt ?></td>
									<td align="center" width="30"><? echo $objmember[username] ?></td>
									<td align="center" width="30"><? echo $objmember[name] ?></td>
										<td align="center" width="30"><? echo $objmember[email] ?></td>
									<td align="center" width="30"><? echo strftime("%d.%m.%Y",strtotime($objmember[lastLogin]));?> </td>
									<td><?=GetSingleField("package_name","tbl_packages","package_id",$objmember[membership_type])?></td>
									<td align="center" width="30"><?=GetSingleField("admin_loginname","tbl_admin","id",$rs->admin_id_fk)?></td>
									<? if(($_REQUEST['rem_type']==6)or($_REQUEST['rem_type']==7)) { ?><td align="center" width="70">
									<?  if($objmember[membership_type]==1)
									    echo"Free";
									   else  {
									   		$res_qu=mysql_query("select TO_days($objmember[package_expiry_date])-TO_days(NOW()) as expdate");
											$obj=mysql_fetch_object($res_qu);
											if($obj->expdate<0) {
											 echo"Renewled";
											} else 
											 echo"Paid";
									   }
										?></td> <? } ?>
									<!--<td align="center" width="30"><?=$rem_type?></td>-->
									<td width="100"><? echo  strftime("%d.%m.%Y",strtotime($rs->send_date));?></td>
								</tr>
						<?
							$rCnt++;
						}	?>		
											
							</form>
							</table>
							<?  $qstring = "rem_type=" . $_REQUEST["rem_type"] . "&action1=". GetVar("action1")."&";

							getpageNumbers($pager->numPages,$page,"report_rem_con.php?$qstring");?>
						<?
							mysql_free_result($res);
						}else{
							echo "<br><br><center>No users Found.</center>";
						}
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