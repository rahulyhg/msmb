<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
$linkid = db_connect();
if($_REQUEST['Report']==1){
	$strFields ="";
	$com=",";
	$strFields.="\r\n Matrmonial shaadi \r\n";
	$strFields.="\r\n Sales Report For Members\r\n";
	$strFields.= "S.No,Member Id,Name,Registered Date,Activation Status,Verify Status,Package Type,Payment Amount,Upgraded By,Payment Type\n";
	$sql=$_SESSION['hidQuery'];
	$res=mysql_query($sql);
	$no=mysql_num_rows($res);
	$iCnt=1;
	if($no>0){ 
		while($rs=mysql_fetch_object($res)){
			$mem=$rs->username;
			if($rs->enable==1)
				$activate="Activated";
			else
				$activate="Deactivated";
			if($rs->verifiedBy==1)
				$verified=GetSingleField("admin_loginname","tbl_admin","Id",$rs->verifiedBy);
			else
				$verified="Deactivated";
			$package_amount=GetSingleField("package_price","tbl_packages","package_id",$rs->membership_type);
	 	    $total_amt=$total_amt + $package_amount;
			$package_name=GetSingleField("package_name","tbl_packages","package_id",$rs->membership_type);
			$package_res =  Execute("select * from tbl_member_profile_upgrade where member_id = '" . $rs->username . "' order by created_date desc limit 0,1");//and payment_status = '1' 
			if (mysql_num_rows($package_res) > 0) {
				$package_rs = mysql_fetch_array($package_res);
				if ($package_rs[franchise_auto_id]) {
					$upgrade= 'FR('.GetSingleField("franchisee_name","tbl_franchisee","auto_id",$package_rs[franchise_auto_id]) . ')';
				} else {
					$upgrade='self';
				}
			}
			$pack_mode=$package_rs[payment_mode];
			$strFields .= $iCnt.",".$mem.",".$rs->name.",".strftime("%d %b %Y",strtotime($rs->registration_date)).",".$activate.",".$verified.",".$package_name.",".$package_amount.",".$upgrade.",".$pack_mode."\r\n";
			$iCnt++;	
		}
	}
	//$strFields = str_replace("\\n","  ",$strFields)."\n"; 
	header('Content-Type: text/x-csv');	
	header('Content-Disposition: attachment; filename="matrimony.csv"');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	echo $strFields;
	die();
}
if($_REQUEST['Report']==2){
	$strFields ="";
	$com=",";
	$strFields.="\r\n Matrmonial shaadi \r\n";
	$strFields.="\r\n Sales Report For Members\r\n";
	$strFields.= "S.No,Member Id,Name,Registered Date,Activation Status,Verify Status\n";
	$sql=$_SESSION['hidQuery'];
	$res=mysql_query($sql);
	$no=mysql_num_rows($res);
	$iCnt=1;
	if($no>0){ 
		while($rs=mysql_fetch_object($res)){
			$mem=$rs->username;
			if($rs->enable==1)
				$activate="Activated";
			else
				$activate="Deactivated";
			if($rs->verifiedBy==1)
				$verified=GetSingleField("admin_loginname","tbl_admin","Id",$rs->verifiedBy);
			else
				$verified="Deactivated";
			$strFields .= $iCnt.",".$mem.",".$rs->name.",".strftime("%d %b %Y",strtotime($rs->registration_date)).",".$activate.",".$verified."\r\n";
			$iCnt++;	
		}
	}
	//$strFields = str_replace("\\n","  ",$strFields)."\n"; 
	header('Content-Type: text/x-csv');	
	header('Content-Disposition: attachment; filename="matrimony.csv"');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	echo $strFields;
	die();
}
?>