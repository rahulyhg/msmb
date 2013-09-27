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
	
  $sql="select max(sequence) as cnt from tbl_wedding_directory where wedding_category_id=".$_REQUEST['cmbWeddingCategory'];
  $res=mysql_query($sql);  
  $rs=mysql_fetch_object($res);

  if($rs->cnt>0){
		$cntNo=$rs->cnt+1;
  }else{
	$cntNo=1;
  }

  mysql_free_result($res);
    
	if($HTTP_POST_FILES['fileImage']['name']!=""){
	  $img_directory=post_img($HTTP_POST_FILES['fileImage']['name'], $HTTP_POST_FILES['fileImage']['tmp_name'],"../wedding_directory_images");
	} 		
	
	$sql_insert="insert into tbl_wedding_directory(wedding_category_id,wedding_city_id,shop_name,description,shop_address,contact_person,contact_phone,image,email_id,web_address,sequence)values ('".$_REQUEST['cmbWeddingCategory']."','".$_REQUEST['cmbCity']."','".$_REQUEST['txtShopName']."','".$_REQUEST['txtDescription']."','".$_REQUEST['txtShopAddress']."','".$_REQUEST['txtContactPerson']."','".$_REQUEST['txtContactNumber']."','".$img_directory."','".$_REQUEST['txtEmail']."','".$_REQUEST['txtWebAddress']."','".$cntNo."')";	

	mysql_query($sql_insert);
	echo mysql_error();			
	$_SESSION['_msg'] = "Saved Successfully";		
	?>
	<script language="javascript">window.location.href="add_wedding_directory.php";</script>
	<?
	die(); 
	
}

if($_REQUEST['mode']=="update"){

		$sql_chk="select * from tbl_wedding_directory where wedding_category_id='".$_REQUEST['cmbWeddingCategory']."' and wedding_city_id='".$_REQUEST['cmbCity']."' and shop_name='".$_REQUEST['txtShopName']."' and directory_id!='".$_REQUEST['directory_id']."'";
		$res_chk=mysql_query($sql_chk);
	
	    $sql_img="select * from tbl_wedding_directory where directory_id='".$_REQUEST['directory_id'] ."'";
		$res_img=mysql_query($sql_img);
		$obj_img=mysql_fetch_object($res_img);
	
   	    if($HTTP_POST_FILES['fileImage']['name']!="")
		{
		  $img_directory=post_img($HTTP_POST_FILES['fileImage']['name'], $HTTP_POST_FILES['fileImage']['tmp_name'],"../wedding_directory_images");
  		    if($obj_img->image!="")
		     {
		       $file="../wedding_directory_images/".$obj_img->image;
  	           unlink($file);
		     }

        }else{
			 $img_directory=$obj_img->image;
		}		
			
    			
		if(mysql_num_rows($res_chk)==0)
		{
		   $sql_update="update tbl_wedding_directory set wedding_category_id='".$_REQUEST['cmbWeddingCategory']."',wedding_city_id='".$_REQUEST['cmbCity']."',shop_name='".$_REQUEST['txtShopName']."',description='".$_REQUEST['txtDescription']."',shop_address='".$_REQUEST['txtShopAddress']."',contact_person='".$_REQUEST['txtContactPerson']."',contact_phone='".$_REQUEST['txtContactNumber']."',image='".$img_directory."',email_id='".$_REQUEST['txtEmail']."',web_address='".$_REQUEST['txtWebAddress']."' where directory_id='".$_REQUEST['directory_id']."'";
		  
			mysql_query($sql_update);
			
			$_SESSION['_msg'] = "Updated Successfully";
		 }
		else
		{
			$_SESSION['_msg'] = "Directory already exists";
		}
	
  ?>
  <script language="javascript">window.location.href="view_wedding_directory.php?category_id=<? echo $_REQUEST['cmbWeddingCategory'];?>";</script>
  <?
	die(); 
}//update


if($_REQUEST['directory_id']!="")
{
   	$sql_select="select * from tbl_wedding_directory where directory_id='".$_REQUEST['directory_id']."'";
	$r=mysql_query($sql_select);
	if(mysql_num_rows($r)>0)
	{	
	$res=mysql_fetch_object($r);
	} 
	
}// if id!=""


	$sql_in="select * from tbl_wedding_category where parent_category=2";
	$res_in=mysql_query($sql_in);
	if(mysql_num_rows($res_in)>0){
		while($obj_in=mysql_fetch_object($res_in)){
			$strCategory.="<option value=".$obj_in->category_id.">".$obj_in->category_name."</option>";
		}
	}
	
	$sql_in="select * from tbl_wedding_category where parent_category=1";
	$res_in=mysql_query($sql_in);
	if(mysql_num_rows($res_in)>0){
		while($obj_in=mysql_fetch_object($res_in)){
			$strCity.="<option value=".$obj_in->category_id.">".$obj_in->category_name."</option>";
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
<script language="javascript">
//Browser Support Code
function ajaxFunction(){
	var ajaxRequest; 
	var val=document.thisForm.cmbDirectory.value;
	var result;
	var newOption;
	try{
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				alert("Your browser does not support ajax!");
				return false;
			}
		}
	}
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			 result=ajaxRequest.responseText;
			 string1=result.split("/");
			 
			 //remove the previous items
 			 var len=document.thisForm.cmbWeddingCategory.options.length;
			 for(var k=len;k>=0;k--)
			 {
			   document.thisForm.cmbWeddingCategory.remove(k);
			 }

			 
			 for(var i=0;i<string1.length-1;i++)
			 {
			       string2=string1[i].split("_");
				   newOption=document.createElement("OPTION");
				   document.thisForm.cmbWeddingCategory.options.add(newOption);
				   newOption.text=string2[1];
				   newOption.value=string2[0];
			 }//for i
			 
			 //alert(document.thisForm.cmbWeddingCategory.options.length);
			 //document.thisForm.cmbWeddingCategory.options.remove(newOption); 
			
		}
	}
	ajaxRequest.open("GET","select_wedding_directory.php?selval="+val, true);
	ajaxRequest.send(null); 
}
</script>



<script language="JavaScript">
function fnValidate(){ 	

	if (notSelected(document.thisForm.cmbWeddingCategory,"Wedding Category")){return false;}	
	if (notSelected(document.thisForm.cmbCity,"City")){return false;}	
	if (isNull(document.thisForm.txtShopName,"Shop name")){return false;}
	//if(isNull(document.thisForm.txtShopAddress,"Shop Address")){return false;}	
	if (isNull(document.thisForm.txtContactPerson,"Contact Person")){return false;}	
	if (isNull(document.thisForm.txtContactNumber,"Contact Number")){return false;}
	//if (fnChkNum2(document.thisForm.txtContactNumber, "Contact Number")) {return false;}
	//txtEmail
	//if(notImageFile(document.thisForm.fileImage,"Image")){ return false; }
    if(document.thisForm.fileImage.value!="")
	{
	   if(notImageFile(document.thisForm.fileImage,"Image")){ return false; }
	}//if
  
	if(document.thisForm.txtEmail.value!="")
	{
		if(notEmail(document.thisForm.txtEmail,"e-mail id")){ return false; }
	}//if
	
}//function
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
						<td class="subtitle">Manage Wedding Directory</td>
						<td align="right"><a href="view_wedding_directory.php">View Wedding Directory</a></td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
				<?
					if($_REQUEST['directory_id']==""){
						$secMode="save";
					}else{
						$secMode="update";
					}
				?>
				<form name="thisForm" method="post" onSubmit="return fnValidate();" enctype="multipart/form-data" action="add_wedding_directory.php?mode=<? echo $secMode?>" >
				<input type="hidden" name="directory_id" value="<? echo($_REQUEST['directory_id']);?>">					
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="520">
						<tr><td>
							<table cellpadding="10" cellspacing="1" border="0" width="500" class="tblBorder">
							<tr class="tblHead"><td align="center"><b>
								<?
								if ($_REQUEST["directory_id"]!=""){
									echo "Update Wedding Directory";
								} else {
									echo "Add Wedding Directory";
								}
								?>
							</b></td></tr>
							<tr class="tblContent"><td>
								<table cellpadding="5" cellspacing="1" border="0" width="500" class="tblBorder">								
															
									<tr class="tblContent">
											<td>Select the Category <font color="#FF0000">*</font></td>
											<td>
											<select name="cmbWeddingCategory" class="cmbbox">
											<option value="">--Select--</option>
											<? echo $strCategory?>
											</select>								
											</td>   										
											<? if($res->wedding_category_id!=""){?>
												<script language="JavaScript">document.thisForm.cmbWeddingCategory.value="<? echo $res->wedding_category_id;?>";</script>
										   <? }?>
									</tr>
									
									<tr class="tblContent">
											<td>Select the City <font color="#FF0000">*</font></td>
											<td>
											<select name="cmbCity" class="cmbbox">
											<option value="">--Select--</option>
											<? echo $strCity;?>
											</select>								
											</td>   										
											<? if($res->wedding_city_id!=""){?>
												<script language="JavaScript">document.thisForm.cmbCity.value="<? echo $res->wedding_city_id;?>";</script>
										   <? }?>
									</tr>


									
				
									<tr class="tblContent">
										<td>Shop Name <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtShopName"  class="txtbox" value="<?=$res->shop_name ?>" ></td>
									</tr>
									
									<tr class="tblContent">
										<td valign="top">Description </td>
					                    <td><textarea name="txtDescription" class="txtarea"><?=$res->description ?></textarea></td>
									</tr>

									
									<tr class="tblContent">
										<td valign="top">Shop Address </td>
					                    <td><textarea name="txtShopAddress" class="txtarea"><?=$res->shop_address ?></textarea></td>
									</tr>

									
									<tr class="tblContent">
										<td>Contact Person <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtContactPerson"  class="txtbox" value="<?=$res->contact_person ?>" ></td>
									</tr>
							
									<tr class="tblContent">
										<td>Contact Number <font color="#FF0000">*</font></td>
										<td><input type="text" name="txtContactNumber"  class="txtbox" value="<?=$res->contact_phone ?>" ></td>
									</tr>
								
									<tr class="tblContent">
										<td>Image</td>
										<td><input type="file" name="fileImage"  class="txtbox" ><? if($res->image!=""){ echo "<img src='../wedding_directory_images/".$res->image."' width='40' height='40' >"; } ?> <input type="hidden" name="hidimage" value="<?=$_SESSION['sesimage'] ?>"> </td>
									</tr>

									<tr class="tblContent">
										<td>e-mail Address </td>
										<td><input type="text" name="txtEmail"  class="txtbox" value="<? if($res->email_id!=""){echo $res->email_id;} ?>" ></td>
									</tr>
									
									<tr class="tblContent">
										<td>Website Addresss(url)</td>
										<td><input type="text" name="txtWebAddress"  class="txtbox" value="<?=$res->web_address ?>" > <br>
											<font color="#999999">For Ex.</font><font color="#FF0000">*</font> <font color="#999999">[http://www.websiteurl.com]</font> 
										</td>
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