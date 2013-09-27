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

if($_REQUEST['ChkS']!="") {
//echo "1";
//die();
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
//echo "2";
//die();
	$stremail.=GetSingleField("email","tbl_register","id",$_REQUEST['mem_id']);
	$strid=$_REQUEST['mem_id'];
 }
	// get contents of a file into a string
	$filename = "rem_con_newsletter/".$_REQUEST["con_rem_id"].".html";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
	//$contents = "Dear Customer, Welcome to Maa Shakti Marriage Bureau";
	$strid = explode("-",$strid);
	for($i=0;$i<count($strid);$i++) {
	mysql_query("INSERT INTO tbl_con_rem_newsletter(id_fk,admin_id_fk,con_rem_id_fk,send_date) values('".$strid[$i]."','".$_SESSION['user_id']."','".$_REQUEST["con_rem_id"]."',now())");
	echo mysql_error();
		$message= "<style>td { font-family:verdana; font-size:11px; }</style>";
		$message.="<table cellspacing='2' cellpadding='2' border='0'  width='80%' bgColor=\"#eaeaea\" align='center'>\n";
		$message.="<tr bgcolor='#FFFFFF'><td><img src=".$image_url." align=\"left\"></td></tr>\n";																			
		$message.="<tr bgcolor='#FFFFFF'>\n";
		$message.="<td>\n";
			//$message.="Dear ".GetSingleField("name","tbl_register","id",$id[$i]).", <br><br>";	
			$message.=$contents."<br><br>\n";
			//$message.="Warm Regards,<br>";
			//$message.="Matrmonial shaadi  Team";
			$message.="</td>\n";							
		$message.="</tr>\n";	
		$message.="</table>\n";	
	$StrFrom ="info@thecreativeit.com";
	$StrSubject="Reminder from Matrimonial Clone - Top Maa Shakti Marriage Bureau Software";
	$StrContent=stripslashes($contents);
	$subject=$StrSubject;	
	$to=GetSingleField("email","tbl_register","id",$strid[$i]);	
	send_mail($to,$StrFrom,$StrSubject,$message);
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

# End - Sending mail to the registered customers 		
?>
