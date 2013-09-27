<?php
ob_start();
session_start();
include("includes/lib.php");

$action = GetVar("action");
$id = GetVar("id");

if ($id == 30) {
	$msg = $_SESSION['msg'];
/*	
	$my_sql="select * from tbl_register where id=".$config[userinfo][id];
	$resultrs=mysql_query($my_sql);
	$n=mysql_num_rows($resultrs);
	while($rs1=mysql_fetch_object($resultrs))	{
		$genders=$rs1->gender;
		$relig=$rs1->religion;
		$cas=$rs1->caste;
		$ag=$rs1->age;
	}	
	if($genders=='M') { 
		$sex='F';
	} else{ $sex='M';}
	$my_search="select id from tbl_register where gender='".$sex."' and 
	religion='".$relig."' and caste='".$cas."'";
	if($sex=='F')	{
		$my_search.=" and age<='".$ag."'";
	}else{
		$my_search.=" and age>='".$ag."'";
	}
	$searchrs=mysql_query($my_search);
	$n1=mysql_num_rows($searchrs);
	while($rs=mysql_fetch_object($searchrs)) {
		$my_sql_insert="insert into tbl_match_profile(userid,matchid)values('".$config[userinfo][id]."','".$rs->id."')";
		$my_insert = mysql_query($my_sql_insert);
	}*/
	
} else {
	foreach ($config["error_message"] as $key => $value) {
		if ($key == $id) {
			$msg = $value;
			break;
		}
	}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" rel="stylesheet" type="text/css"/>
<link href="includes/payment.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" src="includes/validate.js"></script>
<script language="JavaScript" src="includes/functions.js"></script>	
<script type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

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
	

//-->
</script>
</head>
<body class="homeinbody" onLoad="MM_preloadImages('images/thanks_bg.jpg')">
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
		<td>
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:12px 0px 0px 0px; width:573px; float:left;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<div class="titlebg">
					  <h1 class="title">Thanks</h1>
					</div>
				</td>
				<td align="right">
				 <? if ($config[userinfo]) { ?>					
				<strong style="color:#ffad03; font-size:13px;"> <b><?=$config[userinfo][name];?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member" class="idclr">Logout</a>					
				<? } else { ?>						
					<a href="index.php" class="lout">Home</a></strong>&nbsp; |&nbsp; <a href="member_login.php?mode=member" class="idclr">Login</a>
				<? } ?>		
				</td>
			  </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			  <tr>
					    <td width="400" colspan="2" valign="top">
						<div style="float:left; padding:0px 0px 0px 0px;">
						<table border="0" width="550" align="left" cellspacing="0" cellpadding="0">						  
						  <tr>
						  	<td valign="top">
								<table border="0" width="100%" cellpadding="0" cellspacing="0" class="thanks">														
						 		
									 <tr>
										<td valign="top" align="right" style="padding-right:80px; padding-top:160px;">
											<table cellpadding="0" cellspacing="0"  width="195"  border="0">
												<tr>
													<td align="left"><font olor="#d12e27" color="#CC6600">
													<b>
												<?
													if (!$id) {
														echo $_SESSION['msg'];
													} else {
														echo $msg;												
													}	
												?>
													</b></font></td>
													<? $_SESSION['msg'] = ""; ?>
												</tr>
												<!--<tr>
													<td>
												
													<div style="float:right; padding:30px 10px 0px 0px;"><a href="my_matrimony.php" class="back"><font color="#d12e27">
													<? if ($config[userinfo]) { ?>
													<b>My Matrimony</b>
													<? } else { ?>
													<b>Home</b>
													<? } ?>
													</a></font></div>
													</td>
												</tr>-->
												
											</table>
										</td>
									</tr>
									<tr><td colspan="2" valign="bottom" align="right" style="padding-right:10px;"><a href="my_matrimony.php" class="idclr">Proceed to My Matrimony</a></td></tr>						  		  
										
								</table>			
							 </td>								 
						  </tr>	
						</table>
						</div>		
					 </td>
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
  	<? include("includes/fotter.php"); ?>
  </td>
  </tr>
</table>
<?
	$elapsed_seconds = number_format(time()%60,0);
?>
<script language="javascript">
//var seconds = parseInt("<?=$elapsed_seconds?>");
var seconds = 0;
function timer()
{
	if (seconds<10)
		fmt_seconds = "0"+seconds;
	else
		fmt_seconds = seconds;
		
	seconds++;	
	if(seconds>59)
	{
		minutes++;
		seconds = 0;
	}	
	if (seconds == 20 ) 		
		location.href = 'my_matrimony.php';		
	window.setTimeout("init_timer()",500);	
}
function init_timer()
{
	objtimer = window.setTimeout("timer()",500);
}
</script>
<script language="javascript">
init_timer();
</script>
<!--<script language="javascript">
location.href = 'my_matrimony.php';
</script>-->
</div>

</body>
</html>
