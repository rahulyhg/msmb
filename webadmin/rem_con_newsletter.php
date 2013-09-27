<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
include("fckeditor.php");
//include("../includes/functions1.php");

$linkid=db_connect();

$image_url="http://maashaktimarriage.com/images/logo.jpg";
$server_url="http://maashaktimarriage.com/";

if($_REQUEST['mode']=='save')
{	
	if($_REQUEST['FCKeditor1']=="")
	{
		$_SESSION['_msg'] = "Description is empty. Please fill the description.";
		header("location:view_members.php?membership_type=".$_REQUEST['membership_type']);
		die();
	}
	if($_REQUEST['mem_id']=="") {
	$id = explode("-",$_REQUEST["hidid"]);
	for($i=0;$i<count($id);$i++) {
		mysql_query("INSERT INTO tbl_con_rem_newsletter(id_fk,admin_id_fk,con_rem_id_fk,send_date) values('".$id[$i]."','".$_SESSION['user_id']."','".$_REQUEST["con_rem_id"]."',now())");
		echo mysql_error();
		$message= "<style>td { font-family:verdana; font-size:11px; }</style>\r\n";
		$message.="<table cellspacing='2' cellpadding='2' border='0'  width='80%' bgColor=\"#eaeaea\" align='center'>\r\n";
		$message.="<tr bgcolor='#FFFFFF'><td><img src=".$image_url." align=\"left\"></td></tr>\r\n";																			
		$message.="<tr bgcolor='#FFFFFF'>\r\n";
		$message.="<td>\r\n";
			$message.="<div style='color:#222'>".stripslashes($_REQUEST["FCKeditor1"])."<div><br><br>\r\n";
			$message.="<div style='color:#222'>Warm Regards,<br>";
			$message.="Maa Shakti Marriage Bureau";
			$message.="<div></td>\r\n";							
		$message.="</tr>\r\n";	
		$message.="</table>\r\n";	
	$StrFrom ="info@maashaktimarriage.com";
	$StrSubject=$_REQUEST["txtSubject"];
	$StrContent=stripslashes($_REQUEST["FCKeditor1"]);
	$subject=$StrSubject;
	$to=GetSingleField("email","tbl_register","id",$id[$i]);
	send_mail($to,$StrFrom,$StrSubject,$message);
  	}
  }
	if($_REQUEST['mem_id']!="") {
		$id=$_REQUEST['mem_id'];
		mysql_query("INSERT INTO tbl_con_rem_newsletter(id_fk,admin_id_fk,con_rem_id_fk,send_date) values('".$id."','".$_SESSION['user_id']."','".$_REQUEST["con_rem_id"]."',now())");
		echo mysql_error();
		$message= "<style>td { font-family:verdana; font-size:11px; }</style>";
		$message.="<table cellspacing='2' cellpadding='2' border='0'  width='80%' bgColor=\"#eaeaea\" align='center'>";
		$message.="<tr bgcolor='#FFFFFF'><td><img src=".$image_url." align=\"left\"></td></tr>";																			
		$message.="<tr bgcolor='#FFFFFF'>";
		$message.="<td>";
			//$message.="Dear ".GetSingleField("name","tbl_register","id",$id[$i]).", <br><br>";	
			$message.="<div style='color:#222'>".stripslashes($_REQUEST["FCKeditor1"])."</div><br><br>";
			$message.="<div style='color:#222'>Warm Regards,<br>";
			$message.="Maa Shakti Marriage Bureau";
			$message.="</div></td>";							
		$message.="</tr>";	
		$message.="</table>";	
	$StrFrom ="info@maashaktimarriage.com";
	$StrSubject=$_REQUEST["txtSubject"];
	$StrContent=stripslashes($_REQUEST["FCKeditor1"]);
	$subject=$StrSubject;
	$to=GetSingleField("email","tbl_register","id",$id);
	phpmailer_send($to,$StrSubject,$message);
	}
	$_SESSION['_msg']=" Message sent successfully ";
	if($_REQUEST['mem_id']!="")	{
		header("location:add_members.php?id=".$_REQUEST['mem_id']."&membership_type=".$_REQUEST['membership_type']);
		die();
	}
	if($_REQUEST['membership_type']=="")	{
		header("location:report_rem_con.php?action1=".$_REQUEST['action1']."&rem_type=".$_REQUEST['rem_type']);
		die();
	}
	header("location:view_members.php?membership_type=".$_REQUEST['membership_type']);
	die();
	}
# End - Sending mail to the registered customers 		
		
function rteSafe($strText) {
	//returns safe code for preloading in the RTE
	$tmpString = $strText;
	
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);
	
	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);
//	$tmpString = str_replace("\"", "\"", $tmpString);
	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	
	return $tmpString;
}

if($_REQUEST['ChkS']!="") {
	for($i=0;$i<count($_REQUEST['ChkS']);$i++){		
	if($i!=0) {
		$stremail.=",";
		$strid.="-";
	}
	$stremail.=GetSingleField("email","tbl_register","id",$_REQUEST["ChkS"][$i]);
	$strid.=$_REQUEST["ChkS"][$i];
   }
 }	

if($_REQUEST['mem_id']!="") {
	$stremail.=GetSingleField("email","tbl_register","id",$_REQUEST['mem_id']);
	$strid=$_REQUEST['mem_id'];
 }

?>
<html>
<head>
<title>Web Control Panel :: Maa Shakti </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>

<!-- START : Included Script and Styles for Text Editor -->	
<link href="includes/rte.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="includes/richtext.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/html2xhtml.js"></script>
<!-- END : Included Script and Styles for Text Editor -->

<script language="JavaScript">
function Trim(Str){ 
	return Str.replace(/(^\s*)|(\s*$)/g,""); 
}

function fnValidate(){  
	//if(isNull(document.thisForm.txtTitle,"Title")){return false;}
	if(isNull(document.thisForm.txtSubject,"Subject")){return false;}
	//if(notSelected(document.thisForm.ddlSelectCustomer,"Customer")){return false;}
	
}
function fnNewslettersave(){  
	updateRTE('rte1');
	
	if(isNull(document.thisForm.txtTitle,"Title")){return false;}
	if(isNull(document.thisForm.txtSubject,"Subject")){return false;}
	if(notSelected(document.thisForm.ddlSelectCustomer,"Customer")){return false;}
	
	var sMsg;
	sMsg=document.thisForm.rte1.value;
	document.thisForm.description.value=sMsg;
	if(document.thisForm.rte1.value==""){
		alert("Please enter the description");
		frames['rte1'].focus();
		return false;
	}	
	document.thisForm.action="send_newsletter.php?mode=Savenewsletter";
	document.thisForm.submit();		
}
</script>
</head>
<body>

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
						<td class="title">Welcome <font class="session"><? echo $_SESSION['_user']?></font></td>
						<td align="right" class="session"><? echo $_SESSION['_msg'];?><? $_SESSION['_msg'] = "";?></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Title -->
				
				<tr><td><img src="images/spacer.gif" border="0" width="1" height="1"></td></tr>
				
				<!-- Start : Sub Title -->
				<tr class="subtitlebg"><td>
					<table cellpadding="0" cellspacing="0" border="0" width="98%" height="22" align="center">
					<tr>
						<td class="subtitle">Confirmation and Reminder Newsletter</td>
						<td align="right">&nbsp;</td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
				<form name="thisForm" method="post"  action="rem_con_newsletter.php?mode=save&id=<?=$_REQUEST["id"]?>&con_rem_id=<?=$_REQUEST["con_rem_id"]?>&membership_type=<?=$_REQUEST['membership_type']?>" enctype="multipart/form-data" onSubmit="return fnValidate();">
				<input type="hidden" name="sendmail" value="sendmail">
				<input type="hidden" name="action1" value="<?=$_REQUEST['action1']?>">
				<input type="hidden" name="rem_type" value="<?=$_REQUEST['rem_type']?>">
				<? if($_REQUEST['mem_id']!="")	{	?>
					<input type="hidden" name="mem_id" value="<?=$strid?>">
				<? } else { ?>
					<input type="hidden" name="hidid" value="<?=$strid?>">
				<? } ?>
				<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="600">
						<tr><td>
							<table cellpadding="10" cellspacing="1" border="0" width="600" class="tblBorder">
							<tr class="tblHead"><td align="center"><b>Send Newsletters</b></td></tr>
							<tr class="tblContent"><td>
								<table cellpadding="5" cellspacing="1" border="0" width="600" class="tblBorder">								
									<tr class="tblContent">
										<td>To<font color="#FF0000">*</font></td>
										<td><input type="text" name="txtTo" readonly="true"  value="<?=$stremail?>"  class="txtbox" id="to" maxlength="255"></td> 
									</tr>
									<tr class="tblContent">
										<td>Subject<font color="#FF0000">*</font></td>
										<td><input type="text" name="txtSubject" class="txtbox" value="Maa Shakti Marriage Bureau"  maxlength="255"></td> 
									</tr>
									<tr class="tblContent">
									    <td colspan="2">Description<font color="#FF0000">*</font> </td>
									</tr>
									
									<tr class="tblContent">
									   <td colspan="2">		
									 <?
											$sBasePath = $_SERVER['PHP_SELF'] ;
											$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;											
											$oFCKeditor = new FCKeditor('FCKeditor1') ;
											$oFCKeditor->BasePath = $sBasePath ;
											$oFCKeditor->Height = 500;
											$oFCKeditor->width = 400;
											$oFCKeditor->ToolbarSet = "Default";
											if($_REQUEST["con_rem_id"]!="")
											{
											   $filename = "rem_con_newsletter/".$_REQUEST["con_rem_id"].".html";
											   if(file_exists($filename)) {
											   $fd = fopen ($filename, "r");
											   $contents = fread ($fd, filesize ($filename));
											   fclose ($fd);
											   if($contents!="")
											   {
													$oFCKeditor->Value = $contents;
												}
											  }
											 }
										$oFCKeditor->Create() ;								
										?>			
									   </td>
									</tr>
									
									<tr class="tblContent">
									    <td align="center" height="30" colspan="2">
										<input type="submit" value="Send Newsletters" class="butten"></td>
									</tr>
								</table>
							</td></tr>
							</table>
						</td></tr>
						</table>
				 	</td></tr>
					<tr><td height="10"></td></tr>
			 		</table>
		 		</form>
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
