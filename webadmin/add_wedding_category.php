<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
$linkid=db_connect();

$arg="wedding_directory_status";
isAdmin($arg);


if ($_REQUEST["mode"]=="save"){	
		
	$sql_chk="select * from tbl_wedding_category where category_name='".$_REQUEST['txtCategoryName']."' and parent_category='".$_REQUEST['cmbCategory']."'";	
	$res_chk=mysql_query($sql_chk);
	if(mysql_num_rows($res_chk)==0){
	$sql_insert="insert into tbl_wedding_category(category_name,parent_category) values ('".$_REQUEST['txtCategoryName']."','".$_REQUEST['cmbCategory']."')";
		mysql_query($sql_insert);
		echo mysql_error();	
		
		$_SESSION['_msg'] = "Saved Successfully";	
	}else{
		$_SESSION['_msg'] = "Category Name already exists";	
	}
	header("Location:add_wedding_category.php");
	die();
	
}

if($_REQUEST['mode']=="update"){
		$sql_chk="select * from tbl_wedding_category where category_name='".$_REQUEST['txtCategoryName']."' and category_id!='".$_REQUEST['category_id']."'";	
		$res_chk=mysql_query($sql_chk);
	
		if(mysql_num_rows($res_chk)==0)
		{
		   $sql_update="update tbl_wedding_category set category_name='".$_REQUEST['txtCategoryName']."',parent_category='".$_REQUEST['cmbCategory']."' where category_id='".$_REQUEST['category_id']."'";
			mysql_query($sql_update);
			
			$_SESSION['_msg'] = "Updated Successfully";
		 }
		else
		{
			$_SESSION['_msg'] = "Wedding Category Name already exists";	
		}
    header("Location:view_wedding_category.php");
	die();
}//update


if($_REQUEST['category_id']!="")
{
   	$sql_select="select * from tbl_wedding_category where category_id='".$_REQUEST['category_id']."'";
	$r=mysql_query($sql_select);
	if(mysql_num_rows($r)>0)
	{	
	$res=mysql_fetch_object($r);
	}
	
}// if id!=""

?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript">
function fnValidate(id){ 	

	if(notSelected(document.thisForm.cmbCategory,"Category")){return false;}	
	if(isNull(document.thisForm.txtCategoryName,"Category name")){return false;}	
	
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
						<td class="subtitle">Manage Wedding Category</td>
						<td align="right"><a href="view_wedding_category.php">View Wedding Category</a></td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
				<?
					if($_REQUEST['category_id']==""){
						$secMode="save";
					}else{
						$secMode="update";
					}
				?>
				<form name="thisForm" method="post" onSubmit="return fnValidate(<?=$_REQUEST['category_id'] ?>);" action="add_wedding_category.php?mode=<? echo $secMode?>">
				<input type="hidden" name="category_id" value="<? echo($_REQUEST['category_id']);?>">					
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="520">
						<tr><td>
							<table cellpadding="10" cellspacing="1" border="0" width="500" class="tblBorder">
							<tr class="tblHead"><td align="center"><b>
								<?
								if ($_REQUEST["category_id"]!=""){
									echo "Update Wedding Category";
								} else {
									echo "Add Wedding Category";
								}
								?>
							</b></td></tr>
							<tr class="tblContent"><td>
								<table cellpadding="5" cellspacing="1" border="0" width="500" class="tblBorder">								

									<tr class="tblContent">
										<td>Select the Category <font color="#FF0000">*</font></td>
										<td>									
										<select name="cmbCategory" class="cmbbox">
										<option value="">Select</option>
										<option value="1">City</option>
										<option value="2">Category</option>
										</select>
										</td>
								    <? if($res->parent_category!=""){?>
										<script language="JavaScript">document.thisForm.cmbCategory.value="<? echo $res->parent_category;?>";</script>
									<? }?>

									</tr>
									<tr class="tblContent">
										<td>Wedding Category Name <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtCategoryName"  class="txtbox" value="<?=$res->category_name; ?>" ></td>
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