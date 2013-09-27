<?php
session_start();
include("includes/lib.php");
$action = GetVar("action");
$id = GetVar("id");
$mode = GetVar("mode");
$image_url="http://topmatrimonial.thecreativeit.com/images/logo.jpg";
$server_url="http://topmatrimonial.thecreativeit.com/";
	
	if ($action == 'submit') {
	
		# send e-mail to friend
		
		$yourname=$_REQUEST['sender'];
		$youremail=$_REQUEST['senderemail'];
		
		$name1=$_REQUEST['receipientname1'];
		$email1=$_REQUEST['receipientemail1'];
		
		$name2=$_REQUEST['receipientname2'];
		$email2=$_REQUEST['receipientemail2'];
		
		$name3=$_REQUEST['receipientname3'];
		$email3=$_REQUEST['receipientemail3'];
		
		$name4=$_REQUEST['receipientname4'];
		$email4=$_REQUEST['receipientemail4'];
		
		$name5=$_REQUEST['receipientname5'];
		$email5=$_REQUEST['receipientemail5'];

		$profile = '<html>';
		$profile .= "<style>td { font-family:verdana; font-size:11px; }</style>";
		$profile .= '<body>';
		$profile .= "<table cellspacing='2' cellpadding='2' border='0' align='center' width='100%'><tr><td>&nbsp;</td></tr>";
		$profile .="<tr bgcolor='#FFFFFF'><td><img src=".$image_url." align=\"left\"></td></tr>";																			
		$profile .= '<tr><td>';
		
		if ($_REQUEST['message']) {
			$msg1 .= '<br>Friend message: '. stripslashes($_REQUEST['message']);
		}
		$msg1.='<br><br>Regards,<br>' . $yourname;
		$message='Visit <a href="http://thecreativeit.com">Shaadi.com - World Number 1 Maa Shakti Marriage Bureau</a> to find your life partner,View Phone Number & Addressess at no Cost. Gold Membership 100% Free! <a href="http://topmatrimonial.thecreativeit.com/register.php">Join Now</a>';

		$msg = 'Dear ' . $name1 . '<br><br>'.$message;
		$profile1 .= '</td></tr></table>';	
		$profile1 .= '</body></html>';
		$body = $profile.$msg.$msg1.$profile1;
		$subject = 'Shaadi.com - World Number 1 Maa Shakti Marriage Bureau Join now';
		send_mail($email1,$youremail,$subject,$body);
		$body="";$subject="";$msg="";
		
		if($email2!="") {
			$msg = 'Dear ' . $name2 . '<br><br>'.$message;
			$profile1 .= '</td></tr></table>';	
			$profile1 .= '</body></html>';
			$body = $profile.$msg.$msg1.$profile1;
			$subject = 'Shaadi.com - World Number 1 Maa Shakti Marriage Bureau Join now';
			send_mail($email2,$youremail,$subject,$body);
			$body="";$subject="";$msg="";
		}
		
		if($email3!="") {
			$msg = 'Dear ' . $name3 . '<br><br>'.$message;
			$profile1 .= '</td></tr></table>';	
			$profile1 .= '</body></html>';
			$body = $profile.$msg.$msg1.$profile1;
			$subject = 'Shaadi.com - World Number 1 Maa Shakti Marriage Bureau Join now';
			send_mail($email3,$youremail,$subject,$body);
			$body="";$subject="";$msg="";
		}
		
		if($email4!="") {
			$msg = 'Dear ' . $name4 . '<br><br>'.$message;
			$profile1 .= '</td></tr></table>';	
			$profile1 .= '</body></html>';
			$body = $profile.$msg.$msg1.$profile1;
			$subject = 'Shaadi.com - World Number 1 Maa Shakti Marriage Bureau Join now';
			send_mail($email4,$youremail,$subject,$body);
			$body="";$subject="";$msg="";
		}
		
		if($email5!="") {
			$msg = 'Dear ' . $name4 . '<br><br>'.$message;
			$profile1 .= '</td></tr></table>';	
			$profile1 .= '</body></html>';
			$body = $profile.$msg.$msg1.$profile1;
			$subject = 'Shaadi.com - World Number 1 Maa Shakti Marriage Bureau Join now';
			send_mail($email5,$youremail,$subject,$body);
			$body="";$subject="";$msg="";
		}
	$_SESSION['msg'] = "Mail sent successfully";
			
		header("Location: thanks.php?id=33");
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
function fnForward() {
  f1 = document.thisForm;
  if (isNull(f1.sender,"your name")) { return false; }
  if (isNull(f1.senderemail,"your email address")) { return false; }
  if (isNull(f1.receipientname1,"friend's name")) { return false; }
  if (isNull(f1.receipientemail1,"friend's email address")) { return false; }
  
  if((f1.receipientname2.value!="")||(f1.receipientemail2.value!="")){
	  if (isNull(f1.receipientname2,"friend's name")) { return false; }
	  if (isNull(f1.receipientemail2,"friend's email address")) { return false; }
  }
  if((f1.receipientname3.value!="")||(f1.receipientemail3.value!="")){
	  if (isNull(f1.receipientname3,"friend's name")) { return false; }
	  if (isNull(f1.receipientemail3,"friend's email address")) { return false; }
  }
  if((f1.receipientname4.value!="")||(f1.receipientemail4.value!="")){
	  if (isNull(f1.receipientname4,"friend's name")) { return false; }
	  if (isNull(f1.receipientemail4,"friend's email address")) { return false; }
  }
  if((f1.receipientname5.value!="")||(f1.receipientemail5.value!="")){
	  if (isNull(f1.receipientname5,"friend's name")) { return false; }
	  if (isNull(f1.receipientemail5,"friend's email address")) { return false; }
  }
}
</script>
</head>
<body>
	<table cellpadding="0" cellspacing="0"  border="0" style="border:#fdd76c 4px solid; background:url(images/indsn.jpg) no-repeat 322px 27px;" width="300" height="690">
	<tr>
		<td class="popbg" height="25" align="center"><img src="images/img_matritxt.jpg" height="25"/></td>
	</tr>
	<tr><td height="4" bgcolor="#fdd76c"></td></tr>
		<tr><td><img src="images/popup_logo.jpg" hspace="5" vspace="5"></td></tr>
		<tr><td>&nbsp;</td></tr>
  <tr>
    <td colspan="2" valign="top">
	<table width="100%" border="0"  cellspacing="0" cellpadding="0">
	  <tr>
		<td valign="top">
			<div style="padding:12px 0px 0px 8px; float:left;" >
			<table width="500" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td>
				  <table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
					  <td>
						<div class="titlebg">
					  		<h1 class="title">Email to friend</h1>
						</div>
						</td>
					 </tr>
				   </table>
				  </td>
			  	</tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
					    <td width="592" rowspan="4" valign="top">
						<? if ($_SESSION['_msg']) {?>
							<table width="90%" cellpadding="0" cellspacing="0" border="0"><tr><td colspan="3" align="center"><div style="float:center; padding-top:20px;"><? if($_SESSION['_msg']!=""){?> <font class=""><?=$_SESSION['_msg']; $_SESSION['_msg']="";?></font>&nbsp;&nbsp;<? }?></div></td></tr></table>
						<? } ?>	
						<div style="float:left; padding:0px 0px 0px 10px;">						
						<form name="thisForm" action="emailtofriend.php" method="post" onSubmit="return fnForward()">	
							<input type="hidden" name="action" value="submit" />
							<input type="hidden" name="id" value="<?=$id?>"	/>
							<input type="hidden" name="mode" value="<?=$mode?>" />					
						<table border="0" width="90%" align="center" cellspacing="0" cellpadding="0">
						 <tr bgcolor="#FFFFFF"><td>
							<table width="574" border="0"  cellspacing="0" cellpadding="0">
							
								<!--<tr><td height="25" colspan="3" lass="forward_topbg"><h1 class="title">Forward Profile(s) to Friend</h1></td></tr>		
								<tr><td class="probdr">&nbsp;</td></tr> -->
								<tr>
									<td>
										<table width="574" cellpadding="0" cellspacing="2">
											<tr>
												<td width="33%" style="padding-left:10px;">Your name <font color="#CC0000">*</font></td>
											  <td width="67%"><input type="text" name="sender" class="txtbox"></td>
											</tr>
											
											<tr>
											  <td width="33%" style="padding-left:10px;">Your email address <font color="#CC0000">*</font></td>
											  <td width="67%"><input type="text" name="senderemail" class="txtbox"></td>
											</tr>
											
											<tr>
												<td width="33%" style="padding-left:10px;">Your friend's name 1<font color="#CC0000">*</font></td>
											  <td width="67%"><input type="text" name="receipientname1" class="txtbox"></td>
											</tr>
											
											<tr>
												<td style="padding-left:10px;">Your friend's email address 1<font color="#CC0000">*</font></td>
												<td><input type="text" name="receipientemail1" class="txtbox"></td>
											</tr>
											
											<tr>
												<td width="33%" style="padding-left:10px;">Your friend's name 2</td>
											    <td width="67%"><input type="text" name="receipientname2" class="txtbox"></td>
											</tr>
											
											<tr>
												<td style="padding-left:10px;">Your friend's email address 2</td>
												<td><input type="text" name="receipientemail2" class="txtbox"></td>
											</tr>
											
											<tr>
												<td width="33%" style="padding-left:10px;">Your friend's name 3</td>
											    <td width="67%"><input type="text" name="receipientname3" class="txtbox"></td>
											</tr>
											
											<tr>
												<td style="padding-left:10px;">Your friend's email address 3</td>
												<td><input type="text" name="receipientemail3" class="txtbox"></td>
											</tr>
											
											<tr>
												<td width="33%" style="padding-left:10px;">Your friend's name 4</td>
											    <td width="67%"><input type="text" name="receipientname4" class="txtbox"></td>
											</tr>
											
											<tr>
												<td style="padding-left:10px;">Your friend's email address 4</td>
												<td><input type="text" name="receipientemail4" class="txtbox"></td>
											</tr>
											
											<tr>
												<td width="33%" style="padding-left:10px;">Your friend's name 5</td>
											    <td width="67%"><input type="text" name="receipientname5" class="txtbox"></td>
											</tr>
											
											<tr>
												<td style="padding-left:10px;">Your friend's email address 5</td>
												<td><input type="text" name="receipientemail5" class="txtbox"></td>
											</tr>
											
											<tr>
												<td style="padding-left:10px;" valign="top">Your message</td>
												<td><textarea name="message" onClick="this.value='';" class="txtarea1" lass="txtcbomultiple"></textarea></td>
											</tr>
											<tr>
												<td height="35" style="padding-left:10px;"></td>
												<td><input type="submit" class="button" value="Send"/></td>
											</tr>
											<tr>
												<td colspan="2" style="padding-left:10px;">Fields marked with <font color="#CC0000">*</font> are mandatory</td>
											</tr>	
															
																
										</table>
									</td>
								</tr>
							</table>
							</td></tr></table>
						</form>	
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
  </tr>
</table>
</body>
</html>