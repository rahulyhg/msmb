<?php
ob_start();
session_start();
include("includes/lib.php");
include("includes/number_to_word.php");
$action = GetVar("action");

#checking for franchise login
isFranchise();

$sql_in = "select * from tbl_franchisee where auto_id='".$_REQUEST['franchise_auto_id']."' and franchisee_id='".$_REQUEST['franchise_id']."'";

if ($action == 'search') {
	//$sql_in .= " and auto_id in (select franchise_auto_id from tbl_member_profile_upgrade where created_date >= '" . convertdate(GetVar("upgrade_date"))  . "' and created_date <= '" . convertdate(GetVar("upgrade_date1")) . "')";
}

//franchisee_id
$ar_franchise = GetSingleRecord('tbl_franchisee','auto_id',$_REQUEST['franchise_auto_id']);

$res_in=mysql_query($sql_in);
if(mysql_num_rows($res_in)>0){
	$obj_in=mysql_fetch_object($res_in);
	$initial_franchise_credit_amount=$obj_in->balance_credit_amount;
}

function convertdate($date)
{
	$lastdt=explode("/",$date);
	$lastdate=$lastdt[2]."-".$lastdt[0]."-".$lastdt[1];
	return $lastdate;
}

function convertdate1($date) {
	$lastdt = explode("-",$date);
	$lastdate = $lastdt[1]."/".$lastdt[2]."/".$lastdt[0];
	return $lastdate;
}	

 
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/payment.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" src="includes/validate.js"></script>
<script language="JavaScript" src="includes/functions.js"></script>	
<script language="javascript" src="includes/jquery-latest.js"></script>
<script language="javascript" src="includes/jquery.tablesorter.js"></script>

<script language="javascript">
	var newwindow="";
	function poptastic(url){
	newwindow=window.open(url,'name','height=500,width=280,left=20,top=20,toolbar=no,menubar=no,directories=no,location=no,scrollbars=yes,status=no,resizable=yes,fullscreen=no');
	if (window.focus) {newwindow.focus()}
	}
	
	function fnDisplay(){
		if(document.thisForm.cmbPaymentMode.value!=""){
			
			if(document.thisForm.cmbPaymentMode.value=="Cheque"){
				document.getElementById("tblCheque").style.display="block";
				document.getElementById("tblMoney").style.display="none";								
			}else if(document.thisForm.cmbPaymentMode.value=="Money_order"){
				document.getElementById("tblCheque").style.display="none";
				document.getElementById("tblMoney").style.display="block";								
			}						
		}
	}
	function validate(f1) {
		if (isNull(f1.upgrade_date,"From date")) { return false; }
		if (isNull(f1.upgrade_date1,"To date")) { return false; }
		if(f1.upgrade_date.value!="")
		{
			d=new Date();
			current_date=(d.getMonth()+1)+"/"+d.getDate()+"/"+d.getFullYear();
			s_date=new Date(current_date);
			dt=f1.upgrade_date.value.split("/"); 		
			StartDate= new Date(dt[2],dt[0]-1,dt[1]);
			if(StartDate>s_date)
			{
				alert("Please enter valid Start Date");
				f1.upgrade_date.focus();
				return false;
			}
		}
		if(f1.upgrade_date1.value!="")
		{
			d=new Date();
			current_date=(d.getMonth()+1)+"/"+d.getDate()+"/"+d.getFullYear();
			s_date=new Date(current_date);
			dt=f1.upgrade_date1.value.split("/"); 		
			StartDate= new Date(dt[2],dt[0]-1,dt[1]);
			if(StartDate>s_date)
			{
				alert("Please enter valid End Date");
				f1.upgrade_date1.focus();
				return false;
			}
		}
		if((f1.upgrade_date.value!="")&&(f1.upgrade_date1.value!=""))
		{
			dt=f1.upgrade_date.value.split("/");
			dt1=f1.upgrade_date1.value.split("/");
			if(dt1[2]<dt[2])
			{
				alert("Please enter valid Date");
				f1.upgrade_date.focus();
				return false;
			}
		}
	}
	
</script>
<script>
 /* $(document).ready(function(){
    $("#sortTable").tablesorter({sortList:[[0,0],[2,1]], widgets: ['zebra']});
  });*/
  </script>
</head>
<body class="homeinbody" onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
<div class="menuleftimg">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
    <td align="right"><? fnBannerImage('  ','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>  
  <tr>
    <td colspan="2" valign="top">
	<table width="780" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td valign="top">
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:12px 0px 0px 0px; float:left;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<div class="titlebg"><h1 class="title">Upgrade Report</h1></div>
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				 <form name="thisForm" method="post" onSubmit="return validate(this);">
						<input type="hidden" name="action" value="search">
						<input type="hidden" name="franchise_auto_id" value="<?=GetVar("franchise_auto_id")?>">
						<input type="hidden" name="franchise_id" value="<?=GetVar("franchise_id")?>">							
					    <td width="592" rowspan="4" valign="top">
						<!--<h1 class="title">Member Login</h1>
						<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
						<? if ($_SESSION['_msg']) {?>
							<table cellpadding="0" cellspacing="0" border="0"><tr><td colspan="3" align="center"><div style="float:center; padding-top:23px;"><? if($_SESSION['_msg']!=""){?> <font class=""><?=$_SESSION['_msg']; $_SESSION['_msg']="";?></font>&nbsp;&nbsp;<? }?></div></td></tr></table>
						<? } ?>	
						<div style="float:left; padding:0px 0px 0px 10px;">
						<table border="0" width="561"  cellspacing="0" cellpadding="0">
							<tr>
			  					<td colspan="2" valign="bottom"><img src="images/wedcur_top.jpg" align="absbottom"  border="0"></td>
			 				 </tr>
							 <tr>
								<td colspan="2" valign="top"  bgcolor="#ef8d31" >
									<table cellpadding="0" cellspacing="0" width="561" height="27" border="0" bgcolor="#ef8d31">
										<tr>
											<td align="center"><font color="#fff9d4"><b>Upgrade From date</b></font></td>
											<td align="center">
												<input name="upgrade_date" type="text" onClick="fnShowCalendar(document.thisForm.upgrade_date)" maxlength="10" style="cursor:pointer;" class="txtsmallbox" readonly="true">
												<img src="images/cal.gif"  onClick="fnShowCalendar(document.thisForm.upgrade_date);" align="absmiddle" border="0" style="cursor:pointer;">
												<?  if (GetVar("upgrade_date")) {?>
												<script language="javascript">
												document.thisForm.upgrade_date.value="<?=GetVar("upgrade_date")?>";
												</script>
									<? } ?>	
											</td>
											<td align="center"><font color="#fff9d4"><b>Upgrade To date</b></td>
											<td align="center">
												<input name="upgrade_date1" type="text" onClick="fnShowCalendar(document.thisForm.upgrade_date1)" maxlength="10" style="cursor:pointer;" class="txtsmallbox" readonly="true">
												<img src="images/cal.gif"  onClick="fnShowCalendar(document.thisForm.upgrade_date1);" align="absmiddle" border="0" style="cursor:pointer;">
												<?  if (GetVar("upgrade_date1")) {?>
													<script language="javascript">
														document.thisForm.upgrade_date1.value="<?=GetVar("upgrade_date1")?>";
													</script>
												<? } ?>
											</td>
											<td><input type="submit" value="Search" class="button"></td>
										</tr>
									</table>
								</td>
							 </tr>
							<tr bgcolor="#ffffff">
								<td >
									<table border="0" width="100%" align="center" cellspacing="1" cellpadding="4"  bgcolor="#ffe7a6" id="sortTable">
										<thead>	
											<tr  bgcolor="#ffffff">
												<td width="7%" align="center"><b>S.No</b></td>
												<td width="15%" align="center"><b>Member Name<br>
											  [Member ID]</b></a></td>								
												<!--<td width="10%" align="center"><a href="#" class="accmore"><b>Date of birth</b></a></td>-->
												<td width="15%" align="center" colspan="2"><b>Date of Upgrade</b></td>																
												<td width="14%" align="center"><b>Package Type</b></td>								
												<td width="16%" align="center"><b>Package Amount</b></td>	
												<td width="16%" align="center"><b>Commission earned</b></td>
											</tr>
										</thead>
										<tbody>	
											<?
											if($_REQUEST['franchise_auto_id']!="" && $_REQUEST['franchise_id']!=""){	
												$sql="select a.*,b.*, c.package_name,c.valid_period,c.package_price,DATE_FORMAT(b.date_of_birth,'%D %M, %Y')as date_of_birth,DATE_FORMAT(a.created_date,'%D %M, %Y')as created_date from tbl_member_profile_upgrade a, tbl_register b,tbl_packages c where a.franchise_auto_id='".$_REQUEST['franchise_auto_id']."' and a.franchise_id='".$_REQUEST['franchise_id']."' and a.member_auto_id=b.id and b.username=a.member_id and c.package_id=a.package_id ";
												if ($action == 'search') {
													$sql .= "and a.created_date >= '" . convertdate(GetVar("upgrade_date")) . "' and a.created_date <= '" . convertdate(GetVar("upgrade_date1")) . "'";
												}
												$sql .= "order by a.auto_id asc";
												//echo $sql;												
												$res=mysql_query($sql);
												if(mysql_num_rows($res)>0){								
													$rCnt =1;	
													$total_upgrade_amount=0;
													$package_amount = 0;
													while($obj=mysql_fetch_object($res)){								
											?>
											<tr bgcolor="#fffced">
												<td><? echo $rCnt;?></td>
												<td><? echo $obj->name;?><br> [<? echo $obj->member_id;?>]</td>												
												<td colspan="2"><? echo $obj->created_date;?></td>
												<td><? echo $obj->package_name;?></td>
												<td>Rs.<? echo number_format($obj->package_price,0);?></td>
												<td>Rs.<? echo number_format($obj->franchise_commission_amount,0);?></td>
												<?
													$package_amount = $package_amount + $obj->package_price;
												?>
											</tr>
												<?
													$commission_earned=$commission_earned+$obj->franchise_commission_amount;
												?>
											
											<? 
											$total_upgrade_amount=$total_upgrade_amount+$obj->package_price;
											$rCnt++;
											}//while loop ending							
											?>
											</tbody>
											<tr bgcolor="#fef3d4">
												<td colspan="7">
														<table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#feaf00">
															<tr>
																<td bgcolor="#fadc9b"  height="33" width="48%" style="border-bottom:#FFFFFF 1px solid; padding-right:40px;" align="right"><font color="#a80326"><b>Package Amount</b></font>&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;Rs.<? echo $total_upgrade_amount;?></td>
																<td bgcolor="#fbe2ad" width="30%" align="right" style=" border-bottom:#FFFFFF 1px solid;"><font color="#a80326"><b>Net Commission Earned</b></font></td>
																<td bgcolor="#fbe2ad" width="20%" style="border-bottom:#FFFFFF 1px solid;  padding-right:5px;">&nbsp;&nbsp;<b>:</b>&nbsp;Rs.<? echo number_format($commission_earned,0);?></td>
															</tr>
															<tr>
																<td bgcolor="#fadc9b"  height="33"  style=" padding-right:25px; border-bottom:#FFFFFF 1px solid;" align="right"><font color="#a80326"><? if ($ar_franchise[last_credit_added] && $ar_franchise[last_credit_added] != '0000-00-00') { ?><b>Last Deposit Amount added</b></font>&nbsp;&nbsp;<b>:</b>&nbsp;<?=strftime("%d-%b-%Y",strtotime($ar_franchise[last_credit_added]))?><? } ?></td>
																<td bgcolor="#fbe2ad"  align="right"  style="border-bottom:#FFFFFF 1px solid;"><font color="#a80326"><b>Deposit Amount</b></font></td>
																<td bgcolor="#fce5b4" style="border-bottom:#FFFFFF 1px solid; padding-right:5px;">&nbsp;&nbsp;<b>:</b>&nbsp;Rs.<? echo number_format($ar_franchise[credit_amount],0)?></td>
															</tr>
															<tr bgcolor="#f8e9c8">
																<td  height="33" style="padding-left:10px; border-bottom:#FFFFFF 1px solid;">&nbsp;</td>
																<td  align="right"  style="border-bottom:#FFFFFF 1px solid;"><font color="#a80326"><b>Net Credit Amount</b></font></td>
																<td  height="20"  style="border-bottom:#FFFFFF 1px solid; padding-right:5px;">&nbsp;&nbsp;<b>:</b>&nbsp;Rs.<? echo number_format($initial_franchise_credit_amount,0);?></td>
															</tr>
														</table>
												</td>
											</tr>
											<?
											}else{
											?>
											<tr><td colspan="7" align="center">No Upgrade details found..</td></tr>
											<?
											}	//if record checking ending
											 }	//if querystring checking ending
											?>
										
									</table>
								</td>
							 </tr>
						 							  
						  </table>
						</div>
						
					 </td>
					</form>
			  </tr>
			 
			  <tr>
				<td>
					
				</td>
			  </tr>
			</table>
		</div>
		</td>
	  </tr>
	</table>
	</td>
  </tr>
  <tr>
  <td colspan="2">
  	<? 
		  		include("includes/fotter.php") ?>
  </td>
  </tr>
</table>
<div>
</body>
</html>
