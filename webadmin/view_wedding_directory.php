<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/paging_wedding.php");
include("includes/menu.php");
$linkid = db_connect();

if ($_REQUEST['parent_category']) {
	$parent_category = GetVar("parent_category");
} else {
	$parent_category = 2;
}

$arg="wedding_directory_status";
isAdmin($arg);


if($_REQUEST['m']!="")
	{
		$id=$_REQUEST['id'];
		$seq=$_REQUEST['seq'];
		$mode=$_REQUEST['m'];
		$catid=$_REQUEST['category_id'];	
		
		if($mode=="up" && $seq!="" && $id!="")
			{
				if($seq>0)
					{
						for($i=($seq-1);$i>0;$i--)
							{
								$sql="select directory_id from tbl_wedding_directory where sequence = '$i' and wedding_category_id = '$catid'";
								$restemp=mysql_query($sql);
								$no1=mysql_num_rows($restemp);
								mysql_free_result($restemp);
								if($no1>0)
									{
									$newseq=$i;
									break;
									}
							}
					}
				$sql="update tbl_wedding_directory set sequence=".$seq." where sequence=".$newseq . " and wedding_category_id = '$catid'";
				mysql_query($sql);
				$sql="update tbl_wedding_directory set sequence=".$newseq." where directory_id=".$id;
				mysql_query($sql);
			}
		else if($mode=="dn" && $seq!="" && $id!="")
			{
				$sql="select max(sequence) as maxcnt from tbl_wedding_directory where wedding_category_id=".$catid;
				$res=mysql_query($sql);
				if($rs=mysql_fetch_object($res))
					{
						$no_of_directory=$rs->maxcnt;					
					}
				mysql_free_result($res);
				
				if($seq>0)
					{
						for($i=($seq+1);$i<=$no_of_directory;$i++)
							{
								$sql="select directory_id from tbl_wedding_directory where sequence='$i'and wedding_category_id='$catid'";
								$restemp=mysql_query($sql);
								$no1=mysql_num_rows($restemp);
								mysql_free_result($restemp);
								if($no1>0)
									{
									$newseq=$i;
									break;
									}
							}
					}
				$sql="update tbl_wedding_directory set sequence=".$seq." where sequence=".$newseq . " and wedding_category_id = '$catid'";
				mysql_query($sql);
				$sql="update tbl_wedding_directory set sequence=".$newseq." where directory_id=".$id;
				mysql_query($sql);
			}
		header("Location:view_wedding_directory.php?category_id=".$catid);		
		die();
	}





if($_REQUEST['mode']=="del"){
   
   for($i=0;$i<count($_REQUEST['ChkS']);$i++){
        $sql_select="select * from tbl_wedding_directory where directory_id='".$_REQUEST['ChkS'][$i]."'";
		$res_select=mysql_query($sql_select);
		$obj_select=mysql_fetch_object($res_select);
		if($obj_select->image!="")
		{
	     $file="../wedding_directory_images/".$obj_select->image;
  	     unlink($file);
		}
     
       	$sql="delete from tbl_wedding_directory where directory_id='".$_REQUEST['ChkS'][$i]."'";
		mysql_query($sql);
		echo mysql_error();			
		$_SESSION['_msg']="Deleted Successfully"; 		
    }
	header("location:view_wedding_directory.php?category_id=".$_REQUEST['category_id']."&parent_category=$parent_category");
	die();
}

if($_REQUEST['mode']=="activate"){
 for($i=0;$i<count($_REQUEST['ChkS']);$i++){
    $val=$_REQUEST['ChkS'][$i];
    activate($val);
	$_SESSION['_msg']="Activated Successfully"; 		
	}
    header("location:view_wedding_directory.php?category_id=".$_REQUEST['category_id']."&parent_category=$parent_category");
	die();
}

if($_REQUEST['mode']=="deactivate"){
 for($i=0;$i<count($_REQUEST['ChkS']);$i++){
    $val=$_REQUEST['ChkS'][$i];
    deactivate($val);
	$_SESSION['_msg']="Deactivated Successfully"; 		
	}
    header("location:view_wedding_directory.php?category_id=".$_REQUEST['category_id']."&parent_category=$parent_category");
	die();
}

function activate($id){
$sql="update tbl_wedding_directory set status='1' where directory_id='$id'";
mysql_query($sql);
echo mysql_error();
}

function deactivate($id){
$sql="update tbl_wedding_directory set status='0' where directory_id='$id'";
mysql_query($sql);
echo mysql_error();
}
if($_REQUEST['category_id']=="" && $parent_category == 2){
	$sql_load="select * from tbl_wedding_category where parent_category=2 order by category_id asc";
	$res_load=mysql_query($sql_load);
	if(mysql_num_rows($res_load)>0){	
		$obj_load=mysql_fetch_object($res_load);
		header("Location:view_wedding_directory.php?category_id=".$obj_load->category_id);
		die();

	}	
}

?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>
<script language="JavaScript">var linkPath="";</script>
<script language="javascript">
function listDirectory()
{
  var cmbVal=document.thisForm.cmbCategory.value;
  document.thisForm.action="view_wedding_directory.php?category_id="+cmbVal+"&parent_category=<?=$parent_category?>";
  document.thisForm.submit();
}
function listDirectory1()
{
  var cmbVal=document.thisForm.cmbCity.value;
  document.thisForm.action="view_wedding_directory.php?category_id="+cmbVal+"&parent_category=<?=$parent_category?>";
  document.thisForm.submit();
}
</script>
<script language="JavaScript">
function fnDelete(){
	if(notChecked(document.thisForm.elements["ChkS[]"],"Wedding Directory to delete")) {return;}
	if(confirm("Are you sure to delete the selected Wedding Directory(s)?")){
		document.thisForm.action="view_wedding_directory.php?mode=del&category_id=<? echo $_REQUEST['category_id'];?>&parent_category=<?=$parent_category?>";
		document.thisForm.submit();
	} else {
		return false;
	}
}
function fnActivate(){
	if(notChecked(document.thisForm.elements["ChkS[]"],"Wedding Directory to Activate")) {return;}
		document.thisForm.action="view_wedding_directory.php?mode=activate&category_id=<? echo $_REQUEST['category_id'];?>&parent_category=<?=$parent_category?>";
		document.thisForm.submit();
}

function fnDeActivate(){
	if(notChecked(document.thisForm.elements["ChkS[]"],"Wedding Directory to Deactivate")) {return;}
		document.thisForm.action="view_wedding_directory.php?mode=deactivate&category_id=<? echo $_REQUEST['category_id'];?>&parent_category=<?=$parent_category?>";
		document.thisForm.submit();
}

</script>
</head>
<body topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">
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
						<td class="title">Welcome <font class="session"><? echo $_SESSION['_user']; ?></font></td>
						<td align="right" class="session"><? echo $_SESSION['_msg']; ?><? $_SESSION['_msg'] = "";?></td>
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
						<td align="right">
						<? if ($parent_category == 1) {?>
						<a href="view_wedding_directory.php?parent_category=2">View Category</a>
						<? } else { ?>
						<a href="view_wedding_directory.php?parent_category=1">View City</a>
						<? } ?>
						<a href="add_wedding_directory.php">Add Wedding Directory</a>
						</td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
				<form method="post" name="thisForm">		
                   
				   
				   <table align="center" >
						<?
						   	   $sql_category="select * from tbl_wedding_category where parent_category=2 order by parent_category";
							   $res_category=mysql_query($sql_category);
							   
							?>
							  <tr>
							  <? if ($parent_category == 2) { ?>
								  <td>Sory by Category</td>
								  <td ><select name="cmbCategory" class="cmbbox"  onChange="listDirectory();">
								  <option value="">Select</option>
								  <? while($obj_category=mysql_fetch_object($res_category)){ 
									  if($_REQUEST['category_id']!="" && $_REQUEST['category_id']==$obj_category->category_id){						  								  
									  ?>
									  <option value="<?=$obj_category->category_id ?>" selected="selected"><?=$obj_category->category_name; ?></option>
									  <? 
									  }else{
									  ?>
									  <option value="<?=$obj_category->category_id ?>"><?=$obj_category->category_name; ?></option>
									  <?
									   }
									 }  
								  ?>
								  </select>
								  <td>	
							<? } else { ?>		  					  
						      <td>Sort by City</td>
						      <td>
							    <?
								   $sql_category="select * from tbl_wedding_category where parent_category=1 order by parent_category";
								   $res_category=mysql_query($sql_category);								   
								?>
							  <select name="cmbCity" class="cmbbox"  onChange="listDirectory1();">
  							  <option value="">Select</option>
							  <? while($obj_category=mysql_fetch_object($res_category)){ 
								  if($_REQUEST['category_id']!="" && $_REQUEST['category_id']==$obj_category->category_id){						  								  
								  ?>
								  <option value="<?=$obj_category->category_id ?>" selected="selected"><?=$obj_category->category_name; ?></option>
								  <? 
								  }else{
								  ?>
								  <option value="<?=$obj_category->category_id ?>"><?=$obj_category->category_name; ?></option>
								  <?
								   }
								 }  
							  ?>
							  </select>
							  <td>
						  <? } ?>
						  </tr>
					   <? if($_REQUEST['dirid']!=""){?>
					   <script language="JavaScript">document.thisForm.cmbCategory.value="<? echo $_REQUEST['dirid'];?>";</script>
					   <? } ?>					   
 					   </table>
				   
				   
				   
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td><img src="images/spacer.gif" border="0" width="1" height="20"></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" align="center" cellspacing="0" border="0" width="420">
						<tr><td>
							<table align="center" cellpadding="4" cellspacing="1" border="0" width="650" class="tblBorder1">
								<tr class="tblHead"><td><strong>Select</strong></td><td><strong>S.No</strong></td><td><strong>Shop Name</strong></td>
								<? if ($parent_category == 2) { ?>
								<td><strong>Category</strong></td>								
								<? } else { ?>
								<td><strong>City</strong></td>
								<? } ?>
								<? if ($parent_category == 2) { ?>
								<td><strong>Sequence</strong></td>
								<? } ?>
								<td><strong>Activate Status</strong></td></tr>
								<?									
									if ( $_REQUEST['category_id'] ) {
										if ($parent_category == 2) {									
											$sql="select a.*,b.* from tbl_wedding_directory a, tbl_wedding_category b where a.wedding_category_id=b.category_id and a.wedding_category_id=".$_REQUEST['category_id']." and b.parent_category = '" . $parent_category . "' order by a.sequence asc";																						
										} else {
											$sql="select a.*,b.* from tbl_wedding_directory a, tbl_wedding_category b where a.wedding_city_id=b.category_id and a.wedding_city_id=".$_REQUEST['category_id']." and b.parent_category = '" . $parent_category . "' order by a.sequence asc";
										}	
									} else {
										if ($parent_category == 2) {
											$sql="select a.*,b.* from tbl_wedding_directory a, tbl_wedding_category b where a.wedding_category_id=b.category_id and b.parent_category = '" . $parent_category . "' order by a.sequence asc";											
										} else {
											$sql="select a.*,b.* from tbl_wedding_directory a, tbl_wedding_category b where a.wedding_city_id=b.category_id and b.parent_category = '" . $parent_category . "' order by a.sequence asc";
										}	
									}
									
									//echo $sql;
									//die();
									
									$res=mysql_query($sql);																
									echo mysql_error();
									$no=mysql_num_rows($res);
										//pager starts Here
									if($_REQUEST['page']=="")
										$page =1;
									else
										$page=$_REQUEST['page'];
										$total	=	$no;
										$limit	=	400;
										$pager	=	Pager::getPagerData($total, $limit, $page);
										$offset	=	$pager->offset;
										$limit	=	$pager->limit;
										$page	= 	$pager->page;
										
									//Pager ends Here
									$res=mysql_query($sql." limit  $offset, $limit");
									
									if ($no > 0) {
										$rCnt = 1;
										if ($page != 1) {
											$rCnt = ($limit*($page-1)+1);
										} else {
											$rCnt = 1;
										}
										$icntTemp = 0;
										
									while ($rs = mysql_fetch_object($res)) { ?>	
								<tr bgcolor="#FFFFFF">
									<td><input type="checkbox" name="ChkS[]" value="<? echo $rs->directory_id;?>"></td>
									<td><? echo $rCnt;?></td>
									<td><a href="add_wedding_directory.php?directory_id=<? echo $rs->directory_id;?>"><? echo $rs->shop_name;?></a></td>
									<td><? echo $rs->category_name;?></td>	
									<? if ($parent_category == 2) { ?>								
									<td>
									<?									
									if($icntTemp==0 && $no != 1)
										{
											if ($parent_category == 2) {
												echo "<a href='view_wedding_directory.php?m=dn&id=".$rs->directory_id."&seq=".$rs->sequence."&category_id=".$_REQUEST['category_id']."&parent_category=$parent_category'><img src='images/b-down.gif' border=0></a>";											
											} else {
												//echo "<a href='view_wedding_directory.php?m=dn&id=".$rs->directory_id."&seq=".$rs->sequence."&category_id1=".$rs->wedding_category_id."&category_id=".$_REQUEST['category_id']."&parent_category=$parent_category'><img src='images/b-down.gif' border=0></a>";
											}	
										}
									//else if($icntTemp>0 && ($icntTemp<($rCnt-1)))
									else if($icntTemp>0 && ($icntTemp<($no-1)))
										{
											if ($parent_category == 2) {
												echo "<a href='view_wedding_directory.php?m=dn&id=".$rs->directory_id."&seq=".$rs->sequence."&category_id1=".$rs->wedding_category_id."&category_id=".$_REQUEST['category_id']."&parent_category=$parent_category'><img src='images/b-down.gif' border=0></a> <a href='view_wedding_directory.php?m=up&id=".$rs->directory_id."&seq=".$rs->sequence."&category_id=".$_REQUEST['category_id']."&parent_category=$parent_category'><img src='images/b-up.gif' border=0></a>";												
											} else {
												//echo "<a href='view_wedding_directory.php?m=dn&id=".$rs->directory_id."&seq=".$rs->sequence."&category_id1=".$rs->wedding_category_id."&category_id=".$_REQUEST['category_id']."&parent_category=$parent_category'><img src='images/b-down.gif' border=0></a> <a href='view_wedding_directory.php?m=up&id=".$rs->directory_id."&seq=".$rs->city_sequence."&category_id1=".$rs->category_id."&category_id=".$_REQUEST['category_id']."&parent_category=$parent_category'><img src='images/b-up.gif' border=0></a>";
											}	
										}
									//else if($icntTemp==($rCnt-1))
									else if($icntTemp==($no-1)  && $no != 1)
										{
											if ($parent_category == 2) {
												echo "<a href='view_wedding_directory.php?m=up&id=".$rs->directory_id."&seq=".$rs->sequence."&category_id1=".$rs->wedding_category_id."&category_id=".$_REQUEST['category_id']."&parent_category=$parent_category'><img src='images/b-up.gif' border=0></a>";												
											} else {
												//echo "<a href='view_wedding_directory.php?m=up&id=".$rs->directory_id."&seq=".$rs->sequence."&category_id1=".$rs->wedding_category_id."&category_id=".$_REQUEST['category_id']."&parent_category=$parent_category'><img src='images/b-up.gif' border=0></a>";
											}	
										}																			
									?>									
									</td>
									<? } ?>
									<td><? if($rs->status==1){ echo "<img src=\"images/tick.gif\">";}else{ echo "<img src=\"images/cross.gif\">";  } ?></td>
								</tr>
								<? 
								$icntTemp++;
								  $rCnt++;
								 }//while loop ending here	
								 ?>
								 <tr><td colspan="7" bgcolor="#FFFFFF" align="center">
								 <input type="button" name="btns" value="Activate" class="butten" onClick="fnActivate();" > &nbsp; 
								 <input type="button" class="butten" value="Delete" onClick="fnDelete();"> &nbsp;
								 <input type="button" name="btnbC" value="De-Activate" class="butten" onClick="fnDeActivate();"> </td></tr>
							 <?	 } else { ?>
							<tr><td colspan="7" align="center" bgcolor="#FFFFFF"><strong>No Wedding directory details found.</strong></td></tr>	
							 <? } ?>
							</table>							
						</td></tr>
						</table>
					</td></tr>
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