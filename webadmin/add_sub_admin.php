<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
$linkid=db_connect();


if ($_REQUEST["mode"]=="save"){	
		
	$sql_chk="select * from tbl_admin where admin_loginname='".$_REQUEST['txtLoginName']."'";
	$res_chk=mysql_query($sql_chk);
	if (mysql_num_rows($res_chk) > 0) {
		$_SESSION['_msg']="User name already exists.. Please try to give alternative details..";
	} else {		
		
		$table = "tbl_admin";
		$insert_value =array("admin_loginname"=>$_REQUEST['txtLoginName'],"admin_password"=>$_REQUEST['txtPassword'],"super_admin_status"=>"N","created_date"=>date('Y-m-d'),"address"=>$_REQUEST['txtAddress'],"email"=>$_REQUEST['txtEmail']);
		$status = DB_Insert($linkid, $table, $insert_value);
		
		$_SESSION['_msg']="Sub-Admin details stored successfully";		
	}		

	header("Location:add_sub_admin.php");	
	die();	
}

if($_REQUEST['mode']=="update"){
	
	
	$sql_chk="select * from tbl_admin where  admin_loginname='".$_REQUEST['txtLoginName']."' and Id<>".$_REQUEST['admin_id'] ;
	$res_chk=mysql_query($sql_chk);
	if(mysql_num_rows($res_chk)>0){
		$_SESSION['_msg']="User name already exists.. Please try to give alternative details..";
	}else{	
		$sql_update="update tbl_admin set admin_loginname='".$_REQUEST['txtLoginName']."', admin_password='".$_REQUEST['txtPassword']."',address = '" . $_REQUEST['txtAddress'] . "',email = '" . $_REQUEST['txtEmail'] . "' where Id=".$_REQUEST['admin_id'];
		mysql_query($sql_update);
		echo mysql_error();				
	}		
	header("Location:view_sub_admin.php");
	die();
}


   if($_REQUEST['ID']!=""){
   	$res=mysql_query("select * from tbl_admin where Id=".$_REQUEST['ID']);
	$no=mysql_num_rows($res);
	if($no>0){
		$obj=mysql_fetch_object($res);
	}
   }

?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript">
function fnValidate(){ 	

	if(isNull(document.thisForm.txtLoginName,"Login name")){return false;}	
	if(isNull(document.thisForm.txtPassword,"Password")){return false;}
	if(isLen(document.thisForm.txtPassword,6,"Password")) {return false};	
	if(isNull(document.thisForm.txtEmail,"Email")){return false;}	
	if(notEmail(document.thisForm.txtEmail,"Email")){return false;}
	
}

function fnHidePhone(){
	if((document.thisForm.rdPhone[0].checked)==true){
		document.getElementById("trLimited").style.visibility="visible";
	}else{
		document.getElementById("trLimited").style.visibility="hidden";
	}
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
						<td class="subtitle">Manage Sub-Admin</td>
						<td align="right"><a href="view_sub_admin.php">View Sub-Admin</a></td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
				<?
					if($_REQUEST['ID']==""){
						$secMode="save";
					}else{
						$secMode="update";
					}
				?>
				<form name="thisForm" method="post" onSubmit="return fnValidate();" action="add_sub_admin.php?mode=<? echo $secMode?>&admin_id=<? echo $_REQUEST['ID'];?>">				
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="520">
						<tr><td>
							<table cellpadding="10" cellspacing="1" border="0" width="500" class="tblBorder">
							<tr class="tblHead"><td align="center"><b>
								<?
								if ($_REQUEST["ID"]!=""){
									echo "Update Sub-Admin";
								} else {
									echo "Add Sub-Admin";
								}
								?>
							</b></td></tr>
							<tr class="tblContent"><td>
								<table cellpadding="5" cellspacing="1" border="0" width="500" class="tblBorder">								
									<tr class="tblContent">
										<td>Sub Admin Login Name <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtLoginName" class="txtbox" maxlength="20" value="<? echo $obj->admin_loginname;?>"></td>
									</tr>
									<tr class="tblContent">
										<td>Sub Admin  Password <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtPassword" class="txtbox" maxlength="20" value="<? echo $obj->admin_password;?>"></td>
									</tr>
									<tr class="tblContent">
										<td>Email <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtEmail" class="txtbox" maxlength="255" value="<? echo $obj->email;?>"></td>
									</tr>
									<tr class="tblContent">
										<td>Address </td>
										<td><textarea name="txtAddress" class="txtarea"><? echo $obj->address;?></textarea></td>
									</tr>
									<tr class="tblContent">
										<td align="center" height="30" colspan="2">
											<input type="submit" value="Save" class="butten">
										</td>
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
<?
function convertdate($date)
{
	$lastdt=explode("/",$date);
	$lastdate=$lastdt[2]."-".$lastdt[1]."-".$lastdt[0];
	return $lastdate;
}
?>