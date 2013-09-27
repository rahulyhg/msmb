
<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
  <tr>
	<td width="161" align="left" style="padding:5px 5px 9px 47px;" height="16"><h3 class="topic">Basic details</h3></td><td width="254">&nbsp;</td>
	<td width="314">&nbsp;</td>
  </tr>
  <tr>
	<td align="center" colspan="2">
		<table width="22%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="tbdrlft" bgcolor="#f3fae6" align="center">
					<table width="90%" border="0" cellspacing="0" cellpadding="5">
					  <tr>
						<td class="intxt" width="124" align="left">Domain</td>
						<td width="25" class="intxt">:</td>
						<td class="intxt" width="105" align="left">
						<? if ($config["new_domain"]) { ?>
						<select name="domain" class="mprcmbbox" tyle="display:none" onChange="selReligion();">
							<option value="">--Select--</option>	
						<?	$resDomain = Execute("select * from tbl_domain_master order by id");
							if (mysql_num_rows($resDomain) > 0) {
								while ($domain = mysql_fetch_array($resDomain)) {									
							?>
							<option value="<?=$domain[id]?>"><?=$domain[domain]?></option>
						<?  	}
							} ?>
						</select>
					<?	} else {  ?>							
						<select name="domain" class="mprcmbbox" tyle="display:none" onChange="selReligion();">										
						<?php 
										$sql = "Select * from tbl_domain_master";
										$query = mysql_query ($sql);
										while($row = mysql_fetch_array($query))
										{
									 ?>
											<option value="<?=$row[id]?>" selected="selected"><?=$row[domain]?></option>
									<?  		
										}
						} ?>									
					</select>
				<?  if ($config[userinfo][domain]) {?>
					<script language="JavaScript" type="text/javascript">						
						document.thisForm.domain.value="<?=$config[userinfo][domain]?>";
						//document.thisForm.domain.value="<?=$config["new_domain"]?>";									
					</script>
				<? } else {?>
				<?	if (GetVar("domain")) { ?>
					<script language="JavaScript" type="text/javascript">
						document.thisForm.domain.value="<?=GetVar(domain)?>";
						//document.thisForm.domain.value="<?=$config["new_domain"]?>";
					</script>								
				<?	} }	?>
					   </td>
					  </tr>
					  <tr>
						<td class="intxt"align="left">Registered by</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<select name="registerby" class="mprcmbbox">
							<option value="">--Select--</option>
							<option value="Self">Self</option>
							<option value="Parents">Parents</option>
							<option value="Guardians">Guardians</option>
							<option value="Friends">Friends</option>
							<option value="Others">Others</option>								
						</select>	
						<?  if ($config[userinfo]['registerby']) {?>
							<script language="JavaScript" type="text/javascript">
								document.thisForm.registerby.value="<?=$config[userinfo][registerby]?>";
								//document.thisForm.domain.value="<?=$config[new_domain]?>";									
							</script>
						<? } else {?>
						<?	if (GetVar(registerby)) { ?>
							<script language="JavaScript" type="text/javascript">
								document.thisForm.registerby.value="<?=GetVar(registerby)?>";
								//document.thisForm.domain.value="<?=$config[new_domain]?>";
							</script>								
						<?	} }	?></td>
					</tr>										  
					<tr>
						<td class="intxt" align="left">Name</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left"><input type="text" name="name" class="mprtxtbox" maxlength="255" value="<? if ($config[userinfo]['name']) { echo $config[userinfo]['name']; } else { ?><?=GetVar(name)?><? } ?>"></td>
					</tr>
					<tr>
						<td class="intxt" align="left">D.O.B</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">												
						<select name="mydateD" onChange="updateHiddenDate(); DOB2Age();" style="width:50px;" class="cmbbox" onBlur="DOB2Age();toggleHint('hide', this.name);"></select>
						<select name="mydateM" onChange="rem(); mydate.adjustDaysInMonth(); updateHiddenDate(); DOB2Age();" style="width:80px;" class="cmbbox" onBlur="DOB2Age();toggleHint('hide', this.name);"></select>
						<span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;Profile Details] size='20'; body=[Date Of Birth Will Not Be Shown To Others, Its Only For Calculating Your Age]" tyle="vertical-align:middle;font-family:arial;font-size:20px;font-weight:bold;color:#ABABAB;cursor:pointer"><select name="mydateY" onChange="rem(); mydate.adjustDaysInMonth(); updateHiddenDate(); DOB2Age();" style="width:60px;" class="cmbbox" onBlur="DOB2Age();toggleHint('hide', this.name);"></select></span>
						</td>
					</tr>
					  
					<tr><input type="hidden" name="mydateHid">
						<td class="intxt" align="left">Age</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left"><input type="text" name="age" class="mprsmlbox" maxlength="2" value="<? if ($config[userinfo]['age']) { echo $config[userinfo]['age']; } else { ?><?=GetVar(age)?><? } ?>" readonly="readonly">&nbsp;Years</td>
					</tr>
					<tr>
						<td class="intxt" align="left">Gender</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left"><input type="radio" name="gender" class="radio" value="M" nclick="ChangePrefix()" checked="checked">Male&nbsp;<input type="radio" name="gender" class="radio" value="F" nclick="ChangePrefix()" <? if (GetVar(gender) == "F" || $user['gender'] == "F") {?> checked="checked" <? } ?>>&nbsp;Female</td>
					</tr>
					<tr>
						<td class="intxt" align="left">Martial Status</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
						<input type="radio"  name="maritalStatus" class="radio" value="Unmarried" onClick="isMarried()" checked/>&nbsp;Unmarried&nbsp;
						<input type="radio" name="maritalStatus" class="radio" value="Widow/Widower" onClick="isMarried()"  <? if ($config[userinfo]['maritalStatus'] == "Widow/Widower") { ?> checked <? } else { ?><? if (GetVar(maritalStatus) == "Widow/Widower") {?> checked <? }} ?>>&nbsp;Widow/Widower&nbsp;
						<br>
						<input type="radio" name="maritalStatus" class="radio" value="Divorced"  onClick="isMarried()" <? if($config[userinfo]['maritalStatus'] == "Divorced") { ?> checked <? } else { ?><? if (GetVar(maritalStatus) == "Divorced") {?> checked <? }} ?>>&nbsp;Divorced &nbsp;&nbsp;
						<input type="radio" name="maritalStatus" class="radio" value="Separated"  onClick="isMarried()" <? if($config[userinfo]['maritalStatus'] == "Separated") { ?> checked <? } else { ?><? if (GetVar(maritalStatus) == "Separated") {?> checked <? }} ?>>&nbsp;Separated
						</td>
					</tr>
					<tr>
						<td class="intxt" align="left">No. of children</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
						<select name="no_of_Children" class="mprcmbbox" onChange="hasChildren()">
							<option value="">--Select--</option>
							<option value="None">None</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4 and above">4 and above</option>
						</select>
						<?  if ($config[userinfo][no_of_Children]) { ?>
							<script language="JavaScript" type="text/javascript">
								document.thisForm.no_of_Children.value = "<?=$config[userinfo]['no_of_Children']?>";
							</script>
						<? } else {?>
						<?	if (GetVar("no_of_Children")) { ?>
							<script language="JavaScript" type="text/javascript">
								document.thisForm.no_of_Children.value = "<?=GetVar(no_of_Children)?>";
							</script>
						<? }} ?>		
						</td>
					</tr>
					<tr d="tr2" tyle="display:none">						
						<td class="intxt"  align="left" width="35%">Children living status</td><td class="intxt" colspan="2"><input type="radio" name="childrenLivingStatus" class="radio" value="Living with me" <? if (GetVar(childrenLivingStatus) == "Living with me" || $config[userinfo]['childrenLivingStatus'] == "Living with me") {?> checked="checked" <? } ?>>&nbsp;Living with me&nbsp;<input type="radio" name="childrenLivingStatus" class="radio" value="Not living with me" <? if (GetVar(childrenLivingStatus) == "Not living with me" || $config[userinfo]['childrenLivingStatus'] == "Not living with me") {?> checked="checked" <? } ?>>&nbsp;Not living with me</td>														
					 </tr>		
					 <tr>
						<td class="intxt" width="124" align="left">Religion</td>
						<td class="intxt" width="25">:</td>
						<td class="intxt" width="105" align="left">
						<select name="religion" class="mprcmbbox">										
							<option value="">Select</option>																										
						</select>								
						<select name="domain_vs_religion" style="display:none">
							<?
								$resReligion = Execute("select * from tbl_religion_master order by id");
								if (mysql_num_rows($resReligion) > 0) { 
									while ($ReligionMaster = mysql_fetch_array($resReligion)) {
									?>
									<option value="<?=$ReligionMaster[id]?>"><?=$ReligionMaster[domain]?></option>
								<?  }
								 }	?>
						</select>
						<select name="domain_vs_religion1" style="display:none">
							<?
								$resReligion = Execute("select * from tbl_religion_master order by id");
								if (mysql_num_rows($resReligion) > 0) { 
									while ($ReligionMaster = mysql_fetch_array($resReligion)) {
									?>
									<option value="<?=$ReligionMaster[id]?>"><?=$ReligionMaster[religion]?></option>
								<?  }
								 }	?>
						</select>
						<script language="JavaScript" type="text/javascript">
							selReligion();							
						</script>
						
						<? if ($config[userinfo][religion]) {?>
							<script language="JavaScript" type="text/javascript">
								document.thisForm.religion.value = "<?=$config[userinfo][religion]?>";											
							</script>
						<? } else { ?>
							<?	if (GetVar("religion")) { ?>
							<script language="JavaScript" type="text/javascript">
								document.thisForm.religion.value = "<?=GetVar("religion")?>";											
							</script>										
						<? } } ?>
						</td>
					  </tr> 	
					  <tr>
						<td class="intxt" width="124" align="left">Citizenship</td>
						<td class="intxt" width="25">:</td>
						<td class="intxt" width="105" align="left">
							
							<select class="mprcmbbox" name="citizenship" onchange="selCitizenshipOthers()">									 
								<script language="JavaScript" type="text/javascript">
									GetCountry('India','');
								</script>
								<option value="Others">Others</option>
							</select>
							<?	if ($config[userinfo][citizenship]) { ?>
								<script language="JavaScript" type="text/javascript">
									document.thisForm.citizenship.value = "<?=$config[userinfo][citizenship]?>";
								</script>
							<? } else { ?>
							<?	if (GetVar(citizenship)) { ?>
								<script language="JavaScript" type="text/javascript">
									document.thisForm.citizenship.value = "<?=GetVar(citizenship)?>";
								</script>
							<? }} ?>								
						</td>
					  </tr>		
					  <tr>					  
					  		<td colspan="2"></td>
							<td id="div_citizenship" style="display:none">								
								<input type="text" name="citizenship_1" class="mprtxtbox" value="<?=$config[userinfo][citizenship_1]?>" /> 
							</td>								
	                       <? if ($user[citizenship_1]) { ?>										
								<script language="javascript">
									document.thisForm.citizenship.value = "Others";
									document.getElementById("div_citizenship").style.display = "block";
								</script>
							<? } ?>
						</tr>	
					   <tr>
						<td colspan="3" class="intxt">
						&nbsp;&nbsp; &nbsp; &nbsp;<input type="submit" value="Update" class="button" />
						</td>
					  </tr>	  
					</table>
				</td>
				<td class="tbdrrgt" valign="top">
					<table width="95%" border="0" cellspacing="0" cellpadding="5" style="border:1px solid #ced8b3;">		 
					  <tr>
						<td colspan="3" bgcolor="#FFFFFF"><h3 class="topic">Login Details</h3></td>
					  </tr>		  
					  <tr>
						<td class="intxt"align="left">E-Mail</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<input type="text" name="email" maxlength="255" class="mprlgtbox" value="<? if ($config[userinfo][email]) { echo $config[userinfo][email]; } else {?><?=GetVar(email)?><? } ?>">
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">Choose password</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;Profile Details] size='20'; body=[Minimum 5 characters. No special characters are allowed.]" tyle="vertical-align:middle;font-family:arial;font-size:20px;font-weight:bold;color:#ABABAB;cursor:pointer"><input type="password" class="mprlgtbox" name="password" value="<?=$config[userinfo][password]?>" nBlur="toggleHint('hide', this.name);">&nbsp;</span>
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">Confirm password</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<input type="password" class="mprlgtbox" name="cpassword" value="<?=$config[userinfo][password]?>">
						</td>
					  </tr>					  
					</table>
				</td>
				</tr>
				<tr>
				<td colspan="2" valign="bottom"><img src="images/topic_bg_bottom.jpg" border="0"/></td>
			  </tr>
			  <tr><td colspan="2">&nbsp;</td></tr>								  
			</table>
	  </td>	
  </tr>
 
</table>
<script language="JavaScript" src="includes/simplecalendar_v1.3.js" type="text/javascript"></script>
<script type="text/javascript" src="includes/dsInput.js"></script>
<script type="text/javascript">
try {
						mydate = new dsInput( 'mydate' );
} catch (e) {

}
						
					</script>
					<script language="JavaScript" type="text/javascript">
						SetDefaultDate();
						isMarried();
						//ChangePrefix();					
					</script>
					<?
						if ($config[userinfo]['date_of_birth']) {
							$dob = $config[userinfo]['date_of_birth'];
						} else {
							if (GetVar('mydateY')) {
								$dob = GetVar('mydateY') . '-' . GetVar('mydateM') . '-' . GetVar('mydateD');
							}	
						}	
						if ($dob) {
							$dob = explode("-",$dob);
							//echo print_r($dob);
					?>
					<script language="JavaScript" type="text/javascript">							
							document.thisForm.mydateM.value = "<?=intval($dob[1]);?>";
							document.thisForm.mydateY.value = "<?=intval($dob[0]);?>";									
							document.thisForm.mydateD.value = "<?=intval($dob[2]);?>";									
							rem(); mydate.adjustDaysInMonth(); updateHiddenDate(); DOB2Age();
					</script>
				 
					<?  }  ?>
				<script src="includes/boxover.js"></script>