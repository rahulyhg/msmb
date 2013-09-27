		<script language="JavaScript" src="includes/simplecalendar_v1.3.js" type="text/javascript"></script>
<script type="text/javascript" src="includes/dsInput.js"></script>			
						 <tr class="tblContent">
						 	<td colspan="2" align="left"><b>Details of profile </b></td>
						 </tr>
						 <tr class="tblContent">
							<td width="100">Domain <font color="#FF0000">*</font></td>
							<td>
														
								<select name="domain" class="cmbbox" tyle="display:none" nchange="selReligion()" onchange="FillReligionsCaste1('<?=$user[religion]?>','<?=$user[caste]?>')">										
									<?	$resDomain = Execute("select * from tbl_domain_master order by id");
										if (mysql_num_rows($resDomain) > 0) {
											while ($domain = mysql_fetch_array($resDomain)) {									
										?>
										<option value="<?=$domain[id]?>"><?=$domain[domain]?></option>
									<?  	}
										} ?>								
								</select>
							<?  if ($user['domain']) {?>
								<script language="javascript">
									document.thisForm.domain.value="<?=$user['domain']?>";
									//document.thisForm.domain.value="1";
								</script>
							<? } ?>
							</td>
						</tr>
						<tr bgcolor="#FFFFFF">
							<td>Registered by</td>
							<td>
							<select name="registerby" class="cmbbox">
								<option value="">--Select--</option>
								<option value="Self">Self</option>
								<option value="Parents">Parents</option>
								<option value="Guardians">Guardians</option>
								<option value="Friends">Friends</option>
								<option value="Others">Others</option>								
							</select>	
							<?  if ($user['registerby']) {?>
							<script language="javascript">
								document.thisForm.registerby.value = "<?=$user['registerby']?>";
							</script>
							<? } ?>
							</td>					
						</tr>
						<tr class="tblContent">
							<td>Name <font color="#FF0000">*</font> </td>
							<td><input type="text" name="name" class="txtbox" maxlength="255" value="<? if ($user['name']) { echo $user['name']; } ?>"></td>					
						</tr>
						<tr class="tblContent">
							<td>Age <font color="#FF0000">*</font> </td>
							<td>						
							<select name="mydateD" onChange="updateHiddenDate(); DOB2Age();" style="width:50px;" class="cmbbox" onBlur="DOB2Age();"></select>							
							<select name="mydateM" onChange="rem(); mydate.adjustDaysInMonth(); updateHiddenDate(); DOB2Age();" style="width:80px;" class="cmbbox" onBlur="DOB2Age();"></select>			
							<select name="mydateY" onChange="rem(); mydate.adjustDaysInMonth(); updateHiddenDate(); DOB2Age();" style="width:60px;" class="cmbbox" onBlur="DOB2Age();"></select>&nbsp;&nbsp;&nbsp;or&nbsp;
							<input type="text" name="age" class="txtboxage" maxlength="2" value="<? if ($user['age']) { echo $user['age']; } ?>" readonly>&nbsp;Years								
							<input type="hidden" name="mydateHid"><br>
							Date fo birth will not be shown to others, its only for calculating your age.
							</td>					
						</tr>
						<tr class="tblContent">
							<td>Gender <font color="#FF0000">*</font></td><td>
							<input type="radio" name="gender" class="radio" value="M" checked="checked">&nbsp;Male
							&nbsp;
							<input type="radio" name="gender" class="radio" value="F" <? if ($user['gender'] == "F") {?> checked="checked" <? } ?>>&nbsp;Female</td>
						</tr>
						<tr class="tblContent">
							<td>Martial Status <font color="#FF0000">*</font></td>							
							<!--<td>					
							<select name="maritalStatus" class="cmbbox" onChange="isMarried();">
								<option value="">--Select--</option>
								<option value="Unmarried">Unmarried</option>
								<option value="Window/Windower">Window/Windower</option>
								<option value="Divorced">Divorced</option>
								<option value="Separated">Separated</option>								
							</select>
								<?  if ($user['maritalStatus']) { ?>
									<script language="javascript">
										document.thisForm.maritalStatus.value = "<?=$user['maritalStatus']?>";
									</script>
								<? } ?>
							</td>-->
							<td>
							<input type="radio" name="maritalStatus" class="radio" value="Unmarried" onClick="isMarried()" <?  if ($user['maritalStatus'] == "Unmarried") { ?> checked <? } else { ?><? if (GetVar(maritalStatus) == "Unmarried") {?> checked <? }} ?>>&nbsp;Unmarried&nbsp;<input type="radio" name="maritalStatus" class="radio" value="Widow/Widower" onClick="isMarried()"  <?  if ($user['maritalStatus'] == "Widow/Widower") { ?> checked <? } else { ?><? if (GetVar(maritalStatus) == "Widow/Widower") {?> checked <? }} ?>>&nbsp;Widow/Widower&nbsp;<input type="radio" name="maritalStatus" class="radio" value="Divorced" onClick="isMarried()" <?  if ($user['maritalStatus'] == "Divorced") { ?> checked <? } else { ?><? if (GetVar(maritalStatus) == "Divorced") {?> checked <? }} ?>>&nbsp;Divorced&nbsp;<input type="radio" name="maritalStatus" class="radio" value="Separated" onClick="isMarried()" <?  if ($user['maritalStatus'] == "Separated") { ?> checked <? } else { ?><? if (GetVar(maritalStatus) == "Separated") {?> checked <? }} ?>>&nbsp;Separated</td>
						</tr>
						<tr class="tblContent">
							<td>No. of children <font color="#FF0000">*</font></td>
							<td>
								<select name="no_of_Children" class="cmbbox" onChange="hasChildren()">
									<option value="">Select</option>
									<option value="None">None</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4 and above">4 and above</option>
								</select>
								<?	if ($user['no_of_Children']) { ?>
									<script language="javascript">
										document.thisForm.no_of_Children.value = "<?=$user['no_of_Children']?>";
									</script>
								<? } ?>
							</td>
						</tr>						
						<tr class="tblContent">
							<td>Children living status <font color="#FF0000">*</font></td><td><input type="radio" <? if($user['no_of_Children']=="None"){ ?>disabled="disabled" <? } ?> name="childrenLivingStatus" class="radio" value="Living with me" <? if ($user['childrenLivingStatus'] == "Living with me") {?> checked="checked" <? } ?>>&nbsp;Living with me&nbsp;<input type="radio" name="childrenLivingStatus" <? if($user['no_of_Children']=="None"){ ?>disabled="disabled" <? } ?> class="radio" value="Not living with me" <? if ($user['childrenLivingStatus'] == "Not living with me") {?> checked="checked" <? } ?>>&nbsp;Not living with me</td>
						</tr>							 						
						<!--<tr class="tblContent">
							<td>Country living in <font color="#FF0000">*</font></td>
							<td>
								<select class="cmbbox" name="countryLivingIn">									
								<script language="javascript">
									GetCountry('India','');									
								</script>
								</select>
								<?	if ($user[countryLivingIn]) { ?>
									<script language="javascript">
										document.thisForm.countryLivingIn.value = "<?=$user[countryLivingIn]?>";
									</script>
								<?  }  ?>
							</td>
						</tr>-->
						<tr class="tblContent">
							<td>Citizenship <font color="#FF0000">*</font></td>
							<td>
								<select class="cmbbox" name="citizenship" onchange="selCitizenshipOthers()">									 
								<script language="javascript">
									GetCountry('India','');
								</script>
									<option value="Others">Others</option>
								</select>
								<?	if ($user[citizenship]) { ?>
									<script language="javascript">
										document.thisForm.citizenship.value = "<?=$user[citizenship]?>";
									</script>
								<? } ?>
							</td>
						</tr>						
						 <tr class="tblContent">					  
					  		<td>&nbsp;</td>
							<td id="div_citizenship" style="display:none">								
								<input type="text" name="citizenship_1" class="txtbox" value="<?=$user[citizenship_1]?>" /> 
							</td>								
	                       <? if ($user[citizenship_1]) { ?>										
								<script language="javascript">
									document.thisForm.citizenship.value = "Others";
									document.getElementById("div_citizenship").style.display = "block";
								</script>
							<? } ?>
						</tr>
								
						<tr class="tblContent">
						 	<td colspan="2" align="left"><b>Login Details</b></td>
						 </tr>												
						<tr class="tblContent">
							<td>E-Mail <font color="#FF0000">*</font></td>							
							<td><input type="text" name="email" maxlength="255" class="txtbox" value="<? if ($user[email]) { echo $user[email]; } ?>">
						</tr>
						<tr class="tblContent">
							<td>Choose password <font color="#FF0000">*</font></td><td><input type="text" class="txtpasswordbox" name="password" value="<?=$user[password]?>">&nbsp;Minimum 5 characters.  No special characters allowed.</td>
						</tr>
						<tr class="tblContent">
							<td>Confirm password <font color="#FF0000">*</font></td><td><input type="text" class="txtpasswordbox" name="cpassword" value="<?=$user[password]?>"></td>
						</tr>																												
					<script type="text/javascript">
						mydate = new dsInput( 'mydate' );							
					</script>
					<script language="javascript">
						SetDefaultDate();
						isMarried();
						//ChangePrefix();					
					</script>
					<?
						if ($user['date_of_birth']) {
							$dob = $user['date_of_birth'];
						} else {
							if (GetVar('mydateY')) {
								$dob = GetVar('mydateY') . '-' . GetVar('mydateM') . '-' . GetVar('mydateD');
							}	
						}	
						if ($dob) {
							$dob = explode("-",$dob);
							//echo print_r($dob);
					?>
					<script language="javascript" type="text/javascript">							
							document.thisForm.mydateM.value = "<?=intval($dob[1]);?>";
							document.thisForm.mydateY.value = "<?=intval($dob[0]);?>";									
							document.thisForm.mydateD.value = "<?=intval($dob[2]);?>";									
							rem(); mydate.adjustDaysInMonth(); updateHiddenDate(); DOB2Age();
					</script>
					<?  }  ?>				