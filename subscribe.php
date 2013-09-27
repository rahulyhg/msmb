<?
ob_start();
session_start();
include("includes/lib.php");

if($_REQUEST['Mode']=="Subscribe"){

	$sql_chk_subscribe="select * from tbl_subscribe where  email='".$_REQUEST['txtEmailAddress']."'";
	//echo $sql_chk_subscribe;
	$res_chk_subscribe=mysql_query($sql_chk_subscribe);
	if(mysql_num_rows($res_chk_subscribe)>0)
	{
		$_SESSION['_msg']="Email Address already exists";
	}else{
	    $sql_ins_subscribe="insert into tbl_subscribe(email,subscribe_date)values('".$_REQUEST['txtEmailAddress']."','" . date("Y-m-d") . "')";
		//echo  $sql_ins_subscribe;
		mysql_query($sql_ins_subscribe);
		mysql_error;
		$message="";
		$message="<style>td { font-family:verdana; font-size:11px; }</style>";
		$message.="<table cellspacing='2' cellpadding='2' border='0'  width='80%' bgColor=\"#eaeaea\" align='center'>";
		$message.="<tr bgcolor='#FFFFFF'>";
		$message.="<td>";
			$message.="Dear Subscriber, <br><br>";	
			$message.="Thankyou for subscribing with Matrmonial shaadi .";
			$message.="Warm Regards,<br>";
			$message.="Matrmonial shaadi  Team";
			$message.="</td>";							
		$message.="</tr>";	
		$message.="</table>";
		$strTo=$_REQUEST['txtEmailAddress'];
		$strFrom="admin@thecreativeit.com.com";   
		$strSubject="Shaadi.com - World Number 1 Maa Shakti Marriage Bureau - Subscription";
		$strContent=$message;
		send_mail($strTo,$strFrom,$strSubject,$strContent); 				
		
		$_SESSION['msg']="Thanks for subscribing with Matrmonial shaadi .<br> Your email address added successfully with our subscribers list";		
	
	}	
	header("Location:thanks.php");	
	die();
	
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
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td>
			<? include("includes/side_menu.php"); ?>
		</td>
		<td valign="top">
			<div style="padding:10px 6px 0px 0px; width:573px; float:right;" >
			<table width="573" border="0" cellspacing="0" cellpadding="0" >
			  <tr>
				<td valign="top">
					<div class="titlebg">
					  <h1 class="title">Thanks</h1>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
					    <td width="400" rowspan="4" valign="top">
						<!--<h1 class="title">Member Login</h1>
						<div><img src="images/vdot.jpg" width="596" height="1" border="0" style="margin-top:0px"/></div>-->
						<div style="float:left; padding:10px 0px 0px 0px;">
						<table border="0" width="440" align="left" cellspacing="0" cellpadding="0" style="background:url(images/vpro_menu.jpg) top center no-repeat; height:22px; width:550px">						  
						 
						  <tr>
						  	<td valign="top"  style="border:#b68e55 solid 1px;">
								<table border="0" width="400" cellpadding="5"   cellspacing="1">																			
									
						 			<tr>
									 	<td align="left"><b class="clr">
										<?
										echo $_SESSION['_msg'];
										?>
										</b>
										<? $_SESSION['_msg'] = ""; ?>
										</td>
									 </tr>
									 <tr bgcolor="#FFFFFF">
										<td>
											<a href="index.php" class="edit"><b class="clr">Back</b></a>
										<br>
										</td>										
									 </tr>                               
									 								
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
  	<? 
		  		include("includes/fotter.php") ?>
  </td>
  </tr>
</table>
<div>
</body>
</html>
