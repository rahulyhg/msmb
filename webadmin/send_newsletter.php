<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
include("fckeditor.php");
$linkid=db_connect();

//$image_url="http://www.24x7a2z.com/Maa Shakti Marriage Bureau/ver2/images/logo.jpg";
//$server_url="http://www.24x7a2z.com/Maa Shakti Marriage Bureau/ver2/";
$image_url="http://topmatrimonial.thecreativeit.com/images/logo.jpg";
$server_url="http://topmatrimonial.thecreativeit.com/";

if($_REQUEST['mode']=='save')
{	
	if($_REQUEST['FCKeditor1']=="")
	{
		$_SESSION['_msg'] = "Description is empty. Please fill the description.";
		header("location:send_newsletter.php");
		die();
	}
	if($_REQUEST['sendmail']!="") 
	{
		
	    mysql_query("update tbl_subscribe set weeklyalert_status='' ");
		mysql_query("update tbl_franchisee set email_alerts='' ");
		mysql_query("update tbl_register set email_alert_status='N' ");
				 
		$_SESSION['txtTitle']=$_REQUEST['txtTitle'];
		$_SESSION['txtSubject']=$_REQUEST['txtSubject'] ;
		$_SESSION['ddlSelectCustomer']=$_REQUEST['ddlSelectCustomer'];
		$_SESSION['description']=stripslashes($_REQUEST["FCKeditor1"]) ;
		$html = stripslashes($_REQUEST["FCKeditor1"]);
		$filename = date('Ymdhis').".html";
		$fileid = fopen("../sendnewsletter_files/$filename","w+");
		fwrite($fileid,$html,strlen($html));
		fclose($fileid);
		mysql_query("INSERT INTO tbl_newsletter(title,subject,status,description,created_date) values('".$_SESSION['txtTitle']."','".$_SESSION['txtSubject']."','".$_SESSION['ddlSelectCustomer']."','".$filename."',now())");
		echo mysql_error();
	}
	$StrFrom ="info@thecreativeit.com";
	$StrSubject= $_SESSION['txtSubject'];
	$StrContent=stripslashes($_REQUEST["FCKeditor1"]);
	$subject=$StrSubject;	
	
	
# Start- Sending mail to the subscribers  	
	if($_SESSION['ddlSelectCustomer']=="2")	
	 {
	 			$string=md5("Subscribers");
                $SQL="SELECT * FROM tbl_subscribe where status='Y' and weeklyalert_status='' order by subscribe_id limit 0,57";  
				$res= mysql_query($SQL);
				$num=mysql_num_rows($res);
				if($num>0){
				$i=0;
				$strEmployeeIDs="";
					while($obj=mysql_fetch_object($res)) { 
					$strEmployeeIDs .="'".$obj->subscribe_id."',";
							$to=$obj->email; 
							$_SESSION['mailsentuser'].=$_SESSION['mailsentuser']+1;							
						
						# Mail message starts here #		
							$message= "<style>td { font-family:verdana; font-size:11px; }</style>";
							$message.="<table cellspacing='2' cellpadding='2' border='0'  width='80%' bgColor=\"#eaeaea\" align='center'>";
							$message.="<tr bgcolor='#FFFFFF'><td><img src=".$image_url." align=\"left\"></td></tr>";																			
							$message.="<tr bgcolor='#FFFFFF'>";
							$message.="<td>";
								$message.="Dear Subscriber, <br><br>";	
								$message.=stripslashes($_REQUEST["FCKeditor1"])."<br><br>";
								$message.="Warm Regards,<br>";
								$message.="Matrmonial shaadi  Team";
								$message.="</td>";							
							$message.="</tr>";	
														
						$message.="<tr bgcolor='#FFFFFF'>";
							$message.="<td>";
							$message.="if you no longer willing to receive this newsletter, please ";
							$message.="<a href='".$server_url."unsubscribe.php?member=".$string."&subscribe_id=".$obj->subscribe_id."'>click here</a> to unsubscribe.";
							$message.="</td>";							
						$message.="</tr>";	
						$message.="</table>";
					 # Mail message ends here #							 
					$StrContent=$message;								
					
					send_mail($to,$StrFrom,$StrSubject,$StrContent);
							$i++;
						if($i%57==0)
						 {
						    $strEmployeeIDs=substr($strEmployeeIDs,0,strlen($strEmployeeIDs)-1);
							mysql_query("update tbl_subscribe set weeklyalert_status='Y' where subscribe_id in(".$strEmployeeIDs.")  ");
							?>
							<script language="javascript">
									window.location.href="send_newsletter.php?mode=save&ddlSelectCustomer=<?=$_SESSION['ddlSelectCustomer']?>"
								</script>
							<?
							die();
						}
					}
				} else {
					$_SESSION['_msg']=" Message sent successfully ";
					header("location:send_newsletter.php");
					die();
				}
				$_SESSION['_msg']=" Message sent successfully ";
				header("location:send_newsletter.php");
				die();									
		}

# End- Sending mail to the subscribers  

		
# Start- Sending mail to the registered customers 
	
		if($_SESSION['ddlSelectCustomer']=="1")	
	 {
	 			$string=md5("members");
                $SQL="SELECT * FROM tbl_register where enable=1 and verifiedStatus=1 and newsletter_status=1 and email_alert_status='N' order by id limit 0,57";  
				$res= mysql_query($SQL);
				$num=mysql_num_rows($res);
				if($num>0){
				$i=0;
				$strEmployeeIDs="";
					while($obj=mysql_fetch_object($res)) { 
					$strEmployeeIDs .="'".$obj->id."',";
							$to=$obj->email; 
							$_SESSION['mailsentuser'].=$_SESSION['mailsentuser']+1;							
						
						# Mail message starts here #		
							$message= "<style>td { font-family:verdana; font-size:11px; }</style>";
							$message.="<table cellspacing='2' cellpadding='2' border='0'  width='80%' bgColor=\"#eaeaea\" align='center'>";
							$message.="<tr bgcolor='#FFFFFF'><td><img src=".$image_url." align=\"left\"></td></tr>";
							$message.="<tr bgcolor='#FFFFFF'>";
							$message.="<td>";
								$message.="Dear Subscriber, <br><br>";	
								$message.=stripslashes($_REQUEST["FCKeditor1"])."<br><br>";
								$message.="Warm Regards,<br>";
								$message.="Matrmonial shaadi  Team";
								$message.="</td>";							
							$message.="</tr>";	
														
						$message.="<tr bgcolor='#FFFFFF'>";
							$message.="<td>";
							$message.="if you no longer willing to receive this newsletter, please ";
							$message.="<a href='".$server_url."unsubscribe.php?member=".$string."&subscribe_id=".$obj->id."'>click here</a> to unsubscribe.";
							$message.="</td>";							
						$message.="</tr>";	
						$message.="</table>";
					 # Mail message ends here #							 
					$StrContent=$message;								
					send_mail($to,$StrFrom,$StrSubject,$StrContent);
							$i++;
						if($i%57==0)
						 {
						    $strEmployeeIDs=substr($strEmployeeIDs,0,strlen($strEmployeeIDs)-1);
							mysql_query("update tbl_register set email_alert_status='Y' where id in(".$strEmployeeIDs.")  ");
							?>
							<script language="javascript">
								window.location.href="send_newsletter.php?mode=save&ddlSelectCustomer=<?=$_SESSION['ddlSelectCustomer']?>"
							</script>
							<?
							die();
						}else{
							 $strEmployeeIDs=substr($strEmployeeIDs,0,strlen($strEmployeeIDs)-1);
							mysql_query("update tbl_register set email_alert_status='Y' where id in(".$strEmployeeIDs.")  ");
						}
					}
				} else {
					$_SESSION['_msg']=" Message sent successfully ";
					header("location:send_newsletter.php");
					die();
				}
				$_SESSION['_msg']=" Message sent successfully ";
				header("location:send_newsletter.php");
				die();								
		}
		
# End - Sending mail to the registered customers 		
		

# Start - Sending mail to the Franchise 				
		
	if($_SESSION['ddlSelectCustomer']=="4")		
	 {

	 			$string=md5("franchise");
                $SQL="SELECT * FROM tbl_franchisee where newsletter_status='Y' and  email_alerts='' order by auto_id limit 0,57";  
				$res= mysql_query($SQL);
				$num=mysql_num_rows($res);				
				if($num>0){
				$i=0;
				$strEmployeeIDs="";
					while($obj=mysql_fetch_object($res)) { 
					$strEmployeeIDs .="'".$obj->auto_id."',";
							$to=$obj->franchisee_email; 
							$_SESSION['mailsentuser'].=$_SESSION['mailsentuser']+1;							
						
						# Mail message starts here #		
							$message= "<style>td { font-family:verdana; font-size:11px; }</style>";
							$message.="<table cellspacing='2' cellpadding='2' border='0'  width='80%' bgColor=\"#eaeaea\" align='center'>";
							$message.="<tr bgcolor='#FFFFFF'><td><img src=".$image_url." align=\"left\"></td></tr>";
							$message.="<tr bgcolor='#FFFFFF'>";
							$message.="<td>";
								$message.="Dear Subscriber, <br><br>";	
								$message.=stripslashes($_REQUEST["FCKeditor1"])."<br><br>";
								$message.="Warm Regards,<br>";
								$message.="Matrmonial shaadi  Team";
								$message.="</td>";							
							$message.="</tr>";	
														
						$message.="<tr bgcolor='#FFFFFF'>";
							$message.="<td>";
							$message.="if you no longer willing to receive this newsletter, please ";
							$message.="<a href='".$server_url."unsubscribe.php?member=".$string."&franchise_id=".$obj->auto_id."'>click here</a> to unsubscribe.";
							$message.="</td>";							
						$message.="</tr>";	
						$message.="</table>";
					 # Mail message ends here #							 
					$StrContent=$message;								
					send_mail($to,$StrFrom,$StrSubject,$StrContent);
							$i++;
						if($i%57==0)
						 {
						    $strEmployeeIDs=substr($strEmployeeIDs,0,strlen($strEmployeeIDs)-1);
							mysql_query("update tbl_franchisee set email_alerts='Y' where auto_id in(".$strEmployeeIDs.")  ");
							?>
							<script language="javascript">
								window.location.href="send_newsletter.php?mode=save&ddlSelectCustomer=<?=$_SESSION['ddlSelectCustomer']?>"
							</script>
							<?
							die();
						}
					}
				} else {
					$_SESSION['_msg']=" Message sent successfully ";
					header("location:send_newsletter.php");
					die();
				}
				$_SESSION['_msg']=" Message sent successfully ";
				header("location:send_newsletter.php");
				die();									
		}	
		
# End - Sending mail to the Franchise 					



# Start- Sending mail to the Subscribers & Registered Members

			#Registered Members	
		
				if($_SESSION['ddlSelectCustomer']=="3")	
	 		{
	 			$string=md5("members");
                $SQL="SELECT * FROM tbl_register where enable=1 and verifiedStatus=1 and newsletter_status=1 and email_alert_status='N' order by id limit 0,57";  
				$res= mysql_query($SQL);
				$num=mysql_num_rows($res);
				if($num>0){
				$i=0;
				$strEmployeeIDs="";
					while($obj=mysql_fetch_object($res)) { 
					$strEmployeeIDs .="'".$obj->id."',";
							$to=$obj->email; 
							$_SESSION['mailsentuser'].=$_SESSION['mailsentuser']+1;							
						
						# Mail message starts here #		
							$message= "<style>td { font-family:verdana; font-size:11px; }</style>";
							$message.="<table cellspacing='2' cellpadding='2' border='0'  width='80%' bgColor=\"#eaeaea\" align='center'>";
							$message.="<tr bgcolor='#FFFFFF'><td><img src=".$image_url." align=\"left\"></td></tr>";
							$message.="<tr bgcolor='#FFFFFF'>";
							$message.="<td>";
								$message.="Dear Subscriber, <br><br>";	
								$message.=stripslashes($_REQUEST["FCKeditor1"])."<br><br>";
								$message.="Warm Regards,<br>";
								$message.="Matrmonial shaadi  Team";
								$message.="</td>";							
							$message.="</tr>";	
														
						$message.="<tr bgcolor='#FFFFFF'>";
							$message.="<td>";
							$message.="if you no longer willing to receive this newsletter, please ";
							$message.="<a href='".$server_url."unsubscribe.php?member=".$string."&subscribe_id=".$obj->id."'>click here</a> to unsubscribe.";
							$message.="</td>";							
						$message.="</tr>";	
						$message.="</table>";
					 # Mail message ends here #							 
					$StrContent=$message;								
					send_mail($to,$StrFrom,$StrSubject,$StrContent);
							$i++;
						if($i%57==0)
						 {
						    $strEmployeeIDs=substr($strEmployeeIDs,0,strlen($strEmployeeIDs)-1);
							mysql_query("update tbl_register set email_alert_status='Y' where id in(".$strEmployeeIDs.")  ");
							?>
							<script language="javascript">
								window.location.href="send_newsletter.php?mode=save&ddlSelectCustomer=<?=$_SESSION['ddlSelectCustomer']?>"
							</script>
							<?
							die();
						}else{
							 $strEmployeeIDs=substr($strEmployeeIDs,0,strlen($strEmployeeIDs)-1);
							mysql_query("update tbl_register set email_alert_status='Y' where id in(".$strEmployeeIDs.")  ");
						}
					}
				} 
								
				
				#Subscribers
				
				$string=md5("Subscribers");
                $SQL="SELECT * FROM tbl_subscribe where status='Y' and weeklyalert_status='' order by subscribe_id limit 0,57";  
				$res= mysql_query($SQL);
				$num=mysql_num_rows($res);
				if($num>0){
				$i=0;
				$strEmployeeIDs="";
					while($obj=mysql_fetch_object($res)) { 
					$strEmployeeIDs .="'".$obj->subscribe_id."',";
							$to=$obj->email; 
							$_SESSION['mailsentuser'].=$_SESSION['mailsentuser']+1;							
						
						# Mail message starts here #		
							$message= "<style>td { font-family:verdana; font-size:11px; }</style>";
							$message.="<table cellspacing='2' cellpadding='2' border='0'  width='80%' bgColor=\"#eaeaea\" align='center'>";
							$message.="<tr bgcolor='#FFFFFF'><td><img src=".$image_url." align=\"left\"></td></tr>";																			
							$message.="<tr bgcolor='#FFFFFF'>";
							$message.="<td>";
								$message.="Dear Subscriber, <br><br>";	
								$message.=stripslashes($_REQUEST["FCKeditor1"])."<br><br>";
								$message.="Warm Regards,<br>";
								$message.="Matrmonial shaadi  Team";
								$message.="</td>";							
							$message.="</tr>";	
														
						$message.="<tr bgcolor='#FFFFFF'>";
							$message.="<td>";
							$message.="if you no longer willing to receive this newsletter, please ";
							$message.="<a href='".$server_url."unsubscribe.php?member=".$string."&subscribe_id=".$obj->subscribe_id."'>click here</a> to unsubscribe.";
							$message.="</td>";							
						$message.="</tr>";	
						$message.="</table>";
					 # Mail message ends here #							 
					$StrContent=$message;								
					send_mail($to,$StrFrom,$StrSubject,$StrContent);
							$i++;
						if($i%57==0)
						 {
						    $strEmployeeIDs=substr($strEmployeeIDs,0,strlen($strEmployeeIDs)-1);
							mysql_query("update tbl_subscribe set weeklyalert_status='Y' where subscribe_id in(".$strEmployeeIDs.")  ");
							?>
							<script language="javascript">
									window.location.href="send_newsletter.php?mode=save&ddlSelectCustomer=<?=$_SESSION['ddlSelectCustomer']?>"
								</script>
							<?
							die();
						}
					}
				} 
				
				$_SESSION['_msg']=" Message sent successfully ";
				header("location:send_newsletter.php");
				die();								
		}
			
			
		
# End- Sending mail to the Subscribers & Registered Members




		
		
}

if($_REQUEST['mode']=='Savenewsletter')
{
   $html = stripslashes($_REQUEST["FCKeditor1"]);
   $filename = date('Ymdhis').".html";
   $fileid = fopen("../sendnewsletter_files/$filename","w+");   
   fwrite($fileid,$html,strlen($html));
   fclose($fileid);
   mysql_query("INSERT INTO tbl_newsletter(title,subject,status,description,created_date) values('".$_REQUEST['txtTitle']."','".$_REQUEST['txtSubject']."','".$_REQUEST['ddlSelectCustomer']."','".$filename."',now())");
   echo mysql_error();
   header("location:view_newsletters.php");
   die();
}



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
?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
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
	//updateRTE('rte1');
	
	if(isNull(document.thisForm.txtTitle,"Title")){return false;}
	if(isNull(document.thisForm.txtSubject,"Subject")){return false;}
	if(notSelected(document.thisForm.ddlSelectCustomer,"Customer")){return false;}
	
	//var sMsg;
	//sMsg=document.thisForm.rte1.value;
	//document.thisForm.description.value=sMsg;
	/*if(document.thisForm.rte1.value==""){
		alert("Please enter the description");
		frames['rte1'].focus();
		return false;
	}*/			
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
						<td class="subtitle">Manage Newsletter</td>
						<td align="right"><a href="view_subscribers.php">View Subscribers</a>&nbsp;|&nbsp;<a href="view_newsletters.php">View Newsletters</a></td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
				<form name="thisForm" method="post"  action="send_newsletter.php?mode=save" enctype="multipart/form-data" onSubmit="return fnValidate();">
				<input type="hidden" name="sendmail" value="sendmail">
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
										<td>Title<font color="#FF0000">*</font></td>
										<td><input type="text" name="txtTitle" class="txtbox" id="title" maxlength="255"></td>
									</tr>
									<tr class="tblContent">
										<td>Subject<font color="#FF0000">*</font></td>
										<td><input type="text" name="txtSubject" class="txtbox" id="author" maxlength="255"></td> 
									</tr>
									<tr class="tblContent">
										<td>To<font color="#FF0000">*</font></td>
										<td>
										<select name="ddlSelectCustomer" class="cmbbox">
										<option value="">---Select--</option>
											<option value="1">Registered Customer</option>
											<option value="2">Subscribered Customer</option>
											<option value="3">Registered & Subscribered Customers</option>
											<option value="4">Franchise</option>
										</select>
										</td> 
									</tr>
									<tr class="tblContent">
									    <td colspan="2">Description<font color="#FF0000">*</font> </td>
									</tr>
									
									<tr class="tblContent">
									   <td colspan="2">		
									  <? /* ?>					   		
												<script language="JavaScript" type="text/javascript">
													initRTE("images/", "", "", true);
												</script>
													<noscript><p><b>Javascript must be enabled to use this form.</b></p></noscript>
												<script language="JavaScript" type="text/javascript">
													writeRichText('rte1', '<? echo rteSafe($contents);?>',520, 200, true, false);
													//-->
												</script>
												<input type="hidden" name="description">									  
									 <? */ ?>
									 <?
											$sBasePath = $_SERVER['PHP_SELF'] ;
											$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;											
											$oFCKeditor = new FCKeditor('FCKeditor1') ;
											$oFCKeditor->BasePath = $sBasePath ;
											$oFCKeditor->Height = 500;
											$oFCKeditor->width = 400;
											$oFCKeditor->ToolbarSet = "Default";
											/*if($comments!="")
											{
											   $content=$comments;
											   $filename = "../newsfile/$content";
											   $fd = fopen ($filename, "r");
											   $contents = fread ($fd, filesize ($filename));
											   fclose ($fd);
											   if($contents!="")
											   {
													$oFCKeditor->Value = $contents;
												}
											 }*/
										$oFCKeditor->Create() ;								
										?>			
									   </td>
									</tr>
									
									<tr class="tblContent">
									    <td align="center" height="30" colspan="2">
										<input type="button" value="Save" class="butten" onClick="fnNewslettersave();">
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
