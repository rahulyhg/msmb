<?php 
ob_start();
session_start();
?>
<script language="javascript">
function Trim(Str){ 
	return Str.replace(/(^\s*)|(\s*$)/g,""); 
}
function fnValidate(){  
	updateRTE('rte1');
	if(isNull(document.thisForm.txtTitle,"Title")){return false;}
	//if(isNull(document.thisForm.txtAuthor,"Author")){return false;}
	/*if(notSelected(document.thisForm.cmbBride,"Bride")){return false;}	
	if(notSelected(document.thisForm.cmbGroom,"Groom")){return false;}	*/
	if(isNull(document.thisForm.txtDate,"Date of Marriage")){return false;}
	if(notSelected(document.thisForm.txtYear,"Year of Marriage")){return false;}	
	
	if(document.thisForm.txtHidImage.value==""){
		if(isNull(document.thisForm.fileImage,"Image")){return false;}
		if(notImageFile(document.thisForm.fileImage,"Image")){return false;}	
	}else{
		if(document.thisForm.fileImage.value!=""){
			if(notImageFile(document.thisForm.fileImage,"Image")){return false;}	
		}	
			
	}
 	var sMsg;
	sMsg=document.thisForm.rte1.value;
	document.thisForm.description.value=sMsg;
	if(document.thisForm.rte1.value==""){
		alert("Please enter the Successful stories description");
		frames['rte1'].focus();
		return false;
	}
	document.thisForm.action="register_successful.php?Mode=Save";
	document.thisForm.submit();			
}
</script>
<script language="JavaScript" type="text/javascript" src="includes/richtext.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/html2xhtml.js"></script>
<table align="center" border="0" <? if ($_SESSION['userid']) { ?>width="520" <? } else { ?> width="500" <? } ?> cellpadding="1" cellspacing="5">											
	<tr><td colspan="2" align="left"><div style="float:right; color:#FF0000;">[ * Fields are mandatory ]</div></td>
	</tr>
	<tr><td colspan="2" height="1" style="background:url(images/middot.jpg) repeat-x;"></td></tr>  					
	<tr gcolor="#FFFFFF">
		<td colspan="2" align="center">
		<table width="100%"   border="0" cellspacing="0" cellpadding="0">
		<tr>
			
			<td align="right" class="red"><? echo $_SESSION['_msg'];?><? $_SESSION['_msg'] = "";?></td>
		<tr>
			<td>
<!-------------------------------------------------------------------------------------------------------------------------------->
				<table cellpadding="5" cellspacing="1" border="0" width="500" class="tblBorder">								
					<tr>
						<td align="left">Title<font color="#FF0000">*</font></td>
						<td align="left"><input type="text" name="txtTitle" class="txtrbox" id="title" value="<?=$res1->title ?>" maxlength="255"></td>
					</tr>
					<!--<tr>
						<td align="left">Author<font color="#FF0000">*</font></td>
						<td align="left"> <input type="text" name="txtAuthor" class="txtrbox" id="author" value="<?=$res1->author ?>" maxlength="255"></td> 
					</tr>-->
					<?
						$sql_bride="select * from tbl_register where gender='F' and enable=1 and verifiedStatus=1";
						$res_bride=mysql_query($sql_bride);
					?>
					<tr>
						<td align="left">Bride<?php /*?><font color="#FF0000">*</font><?php */?></td>
						<td align="left"><select name="cmbBride" class="cmbrbox">
								<option value="">--Select--</option>
								<? if(mysql_num_rows($res_bride)>0){
										while($obj_bride=mysql_fetch_object($res_bride)){
								?>
								<option value="<?=$obj_bride->id ?>"><?=$obj_bride->username."-".$obj_bride->name ?></option>
									  <? }//while
								  }//if 
								?>
							</select>						</td> 
							<? if($res1->bride!=""){?>
								<script language="JavaScript">document.thisForm.cmbBride.value="<? echo $res1->bride;?>";</script>
							<? }?>
					</tr>
					<?
					$sql_groom="select * from tbl_register where gender='M' and enable=1 and verifiedStatus=1";
					$res_groom=mysql_query($sql_groom);
					?>
					<tr>
						<td align="left">Groom<?php /*?><font color="#FF0000">*</font><?php */?></td>
						<td align="left"><select name="cmbGroom" class="cmbrbox">
								<option value="">--Select--</option>
								<? if(mysql_num_rows($res_groom)>0){
										while($obj_groom=mysql_fetch_object($res_groom)){
									?>
								<option value="<?=$obj_groom->id ?>"><?=$obj_groom->username."-".$obj_groom->name ?></option>
									 <? }//while
								  }//if 
								?>
							</select>						</td> 
							<? if($res1->groom!=""){?>
								<script language="JavaScript">document.thisForm.cmbGroom.value="<? echo $res1->groom;?>";</script>
							<? }?>
					</tr>
					<tr>
						<td align="left">Date of Marriage<font color="#FF0000">*</font></td>
						<td align="left"> <input type="text" name="txtDate" class="txtrbox" value="<?=$res1->marriage_date; ?>"></td>
					</tr>
					<tr>
						<td align="left">Year of Marriage<font color="#FF0000">*</font></td>
						<? 
							$sql_year="select date_format(current_date(),'%Y') as currentyear";
							$res_year=mysql_query($sql_year);
							$obj_year=mysql_fetch_object($res_year);
							$start_year=$obj_year->currentyear;
						?>					   
						<td align="left">
							<select name="txtYear" class="cmbrbox">
							    <option value="">--Select--</option>
							    <? 
							     for($i=$start_year-1;$i<=$start_year+8;$i++){
							     ?>
							     <option value="<?=$i;?>"><?=$i;?></option>
							   <? } ?>
						    </select>
							<? if($res1->marriage_year!=""){ ?>
							    <script language="JavaScript">document.thisForm.txtYear.value="<?=$res1->marriage_year;?>"</script>							<? } ?>						</td>
					</tr>
					<tr>
						<td align="left">Image<font color="#FF0000">*</font></td>
						<td align="left"><input type="file" name="fileImage"  id="fileImage" class="txtrbox" />
						  <br>
						<? if($res1->image!="") {echo "<img src='../successful_stories_images/"."thumb_".$res1->image."'>";} ?> 
							<input type="hidden" name="txtHidImage" value="<? echo $res1->image;?>">					  </td> 
				  </tr>
						<?
							if($_REQUEST['story_id']!=""){
								if(file_exists("successful_stories/".$res1->file_name)){
									$filename="successful_stories/".$res1->file_name;
									$fp=fopen($filename,"r");
									$contents=fread($fp,filesize($filename));
									fclose($fp);
								}
							}
						?>
					<tr>
						<td align="left">Success Story Description </td>
					</tr>
					<tr>
						<td colspan="2" align="left">
							<script language="JavaScript" type="text/javascript">
								initRTE("image1/", "", "", true);
							</script>
							<script language="JavaScript" type="text/javascript">
								writeRichText('rte1', '<? echo rteSafe($content);?>',200, 200, true, false);
							</script>
							<input type="hidden" name="description">						</td>
					</tr>
					<tr>
						<td align="center" height="30" colspan="2"><input type="submit" value="Save" class="button" onclick="return fnValidate();"></td>
					</tr>
				</table>
<!-------------------------------------------------------------------------------------------------------------------------------->										
			</td>
		</tr>
	</table>
	</td>
</tr>	
</table>								
<?
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
					
					
					
				