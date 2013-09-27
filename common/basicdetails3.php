<script language="javascript">
function fncheck()
{
		f1 = document.thisForm;	
			for(i = 0; i < f1.maritalStatus.length; i++)
			{
				if (f1.maritalStatus[i].checked) 
				{	
					if (f1.maritalStatus[i].value == "Unmarried")
					{
						//document.getElementById('tr1').style.display="none";
						//document.getElementById('tr2').style.display="none";
					}
					else
					{
						//document.getElementById('tr1').style.display="block";
						//document.getElementById('tr2').style.display="block";

					}
				}
			}
}
</script>
<div>
<div style="margin:11px 0px 0px 0px; float:right;">
	<!--<table
	<tr>
		<td colspan="2"><h4 class="rtitle" style="padding:6px 5px 0px 5px;"> Register Now to create a profile to find your perfect match on newindamatrimony.com.</h4></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	</table>-->
	<font color="#83A31A">
	<a onclick="fnOpenEmail()" style="cursor:pointer"><b><h2>Tell to friend</h2></b></a>
	</font>
<table width="490" border="0" cellspacing="0" cellpadding="0" class="regtop">				
	<tr>
		<td valign="top">
			<table cellpadding="0" cellspacing="0" width="480" border="0" align="right">
				<tr>
					<td valign="top" align="right" style="padding-right:80px;">
						<font color="#FF0000">*</font> <font color="#888585" size="1">All fields are mandatory </font> 
					</td>
				</tr>
				<tr>
					<td colspan="2" height="20" valign="top"><h4 class="rtitle" style="padding:6px 5px 0px 5px;">Basic Details of profile</h4></td>
				</tr>
				<tr><td colspan="2" height="10">&nbsp;</td></tr>
				<tr>
					<td style="padding:5px;">
						<table cellpadding="5" cellspacing="0" width="100%" border="0">
							<tr><td colspan="2" height="10"></td></tr>
							<tr>
								<td width="40%">Domain</td>
								<td>					
								<? 
									if ($config["new_domain"] == "") { ?><?	} else { ?> 							
								  <select name="domain" class="cmbrbox" tyle="display:none" onChange="selReligion();">										
									<?	$domain = GetSingleRecord("tbl_domain_master","id",$config["new_domain"]);
										if ($domain) {
									 ?>
											<option value="<?=$domain[id]?>" selected="selected"><?=$domain[domain]?></option>
									<?  		
										}
									} ?>									
								</select>
							<?  if ($user['domain']) {?>
								<script language="JavaScript" type="text/javascript">									
									document.thisForm.domain.value="<?=$user['domain']?>";
									//document.thisForm.domain.value="<?=$config["new_domain"]?>";									
								</script>
							<? } else {?>
							<?	if (GetVar(domain)) { ?>
								<script language="JavaScript" type="text/javascript">
									document.thisForm.domain.value="<?=GetVar(domain)?>";
									//document.thisForm.domain.value="<?=$config["new_domain"]?>";
								</script>								
							<?	} }	?>							</td>
						</tr>
						<tr>
							<td>Registered by </td>
							<td>
								<select name="registerby" class="cmbrbox">
									<option value="">--Select--</option>
									<option value="Self">Self</option>
									<option value="Parents">Parents</option>
									<option value="Guardians">Guardians</option>
									<option value="Friends">Friends</option>
									<option value="Others">Others</option>								
								</select>	
								<?  if ($user['registerby']) {?>
									<script language="JavaScript" type="text/javascript">
										document.thisForm.registerby.value="<?=$user[registerby]?>";
										//document.thisForm.domain.value="<?=$config[new_domain]?>";									
									</script>
								<? } else {?>
								<?	if (GetVar(registerby)) { ?>
									<script language="JavaScript" type="text/javascript">
										document.thisForm.registerby.value="<?=GetVar(registerby)?>";
										//document.thisForm.domain.value="<?=$config[new_domain]?>";
									</script>								
								<?	} }	?>							</td>					
						</tr>
						<tr>
							<td>Name </td>
							<td><input type="text" name="name" class="txtrbox" maxlength="255" value="<? if ($user['name']) { echo $user['name']; } else { ?><?=GetVar(name)?><? } ?>"></td>					
						</tr>
						<tr>
							<td>D.O.B </td>
							<td height="25">
								<select name="mydateM" onchange="rem(); mydate.adjustDaysInMonth(); updateHiddenDate(); DOB2Age();" style="width:60px;" class="cmbrbox" onblur="DOB2Age();"></select>
								<select name="mydateD" onchange="updateHiddenDate(); DOB2Age();" style="width:50px;" class="cmbrbox" onblur="DOB2Age();"></select>
								<select name="mydateY" onChange="rem(); mydate.adjustDaysInMonth(); updateHiddenDate(); DOB2Age();" style="width:60px;" class="cmbbox" onblur="DOB2Age();"></select>							
								<span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;Profile Details] size='20'; body=[Date Of Birth Will Not Be Shown To Others, Its Only For Calculating Your Age]" style="padding-right:10px" tyle="vertical-align:middle;font-family:arial;font-size:20px;font-weight:bold;color:#ABABAB;cursor:pointer">
								&nbsp;<b style="cursor:pointer">[?]</b>								</span>
								&nbsp;&nbsp;&nbsp;&nbsp;							
								
								<input type="hidden" name="mydateHid">							</td>					
						</tr>
						<tr>
							<td>Age </td>
							<td>Now you have completed <input type="text" name="age" align="left" class="txtagein1" maxlength="2" value="<? if ($user['age']) { echo $user['age']; } else { ?><?=GetVar(age)?><? } ?>" readonly>&nbsp;Years</td>
						</tr>
						<tr>
							<td>Gender</td><td><input type="radio" name="gender" class="radio" value="M" nclick="ChangePrefix()" checked="checked">Male&nbsp;<input type="radio" name="gender" class="radio" value="F" nclick="ChangePrefix()" <? if (GetVar(gender) == "F" || $user['gender'] == "F") {?> checked="checked" <? } ?>>&nbsp;Female</td>
						</tr>
						<tr>
							<td>Martial Status</td>
							<td>
								<input type="radio"  name="maritalStatus" class="radio" value="Unmarried" onClick="isMarried()" checked />&nbsp;Unmarried&nbsp;
								<input type="radio" name="maritalStatus" class="radio" value="Widow/Widower" onClick="isMarried()" <? if ($user['maritalStatus'] == "Widow/Widower") { ?> checked <? } else { ?><? if (GetVar("maritalStatus") == "Widow/Widower") {?> checked <? }} ?> />&nbsp;Widow/Widower&nbsp;
								<br>
								<input type="radio" name="maritalStatus" class="radio" value="Divorced" onClick="isMarried()" <? if($user['maritalStatus'] == "Divorced") { ?> checked <? } else { ?><? if (GetVar("maritalStatus") == "Divorced") {?> checked <? }} ?>/>&nbsp;Divorced &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="maritalStatus" class="radio" value="Separated" onClick="isMarried()" <? if($user['maritalStatus'] == "Separated") { ?> checked <? } else { ?><? if (GetVar("maritalStatus") == "Separated") {?> checked <? }} ?> />&nbsp;Separated</td>
						</tr>
						<tr>
							<td>No. of Children</td>
							<td>
								<select name="no_of_Children" class="cmbrbox" onchange="hasChildren()">
									<option value="">--Select--</option>
									<option value="None">None</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4 and above">4 and above</option>
								</select>
								<?  if ($user[no_of_Children]) { ?>
									<script language="JavaScript" type="text/javascript">
										document.thisForm.no_of_Children.value = "<?=$user['no_of_Children']?>";
									</script>
								<? } else {?>
								<?	if (GetVar("no_of_Children")) { ?>
									<script language="JavaScript" type="text/javascript">
										document.thisForm.no_of_Children.value = "<?=GetVar("no_of_Children")?>";
									</script>
								<? }} ?>							</td>								
						</tr>
						<tr>						
							<td>Children Living Status</td>
							<td><input type="radio" name="childrenLivingStatus" class="radio" value="Living with me" <? if (GetVar(childrenLivingStatus) == "Living with me" || $user['childrenLivingStatus'] == "Living with me") {?> checked="checked" <? } ?>>&nbsp;Living with me&nbsp;<input type="radio" name="childrenLivingStatus" class="radio" value="Not living with me" <? if (GetVar(childrenLivingStatus) == "Not living with me" || $user['childrenLivingStatus'] == "Not living with me") {?> checked="checked" <? } ?>>&nbsp;Not living with me</td>
						</tr>		
						<tr>
							<td>Religion </td>
							<td>								
								<select name="religion" class="cmbrbox" onchange="FillCaste3();">										
									<option value="">Select</option>																										
								</select>								
								<select name="domain_vs_religion" style="display:none" onchange="FillCaste3();">
									<?
										$resReligion = Execute("select * from tbl_religion_master order by id");
										if (mysql_num_rows($resReligion) > 0) { 
											while ($ReligionMaster = mysql_fetch_array($resReligion)) {
											?>
											<option value="<?=$ReligionMaster[id]?>"><?=$ReligionMaster[domain]?></option>
										<?  }
										 }	?>
								</select>
								<select name="domain_vs_religion1" style="display:none" onchange="FillCaste3();">
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
								<? if ($user[religion]) {?>
									<script language="JavaScript" type="text/javascript">
										document.thisForm.religion.value = "<?=$user[religion]?>";											
									</script>
								<? } else { ?>
									<?	if (GetVar("religion")) { ?>
									<script language="JavaScript" type="text/javascript">
										document.thisForm.religion.value = "<?=GetVar("religion")?>";											
									</script>										
								<? } } ?>							</td>
						</tr>					 												
						<tr>
							<td valign="top" >Citizenship</td>
							<td valign="top">
								<table width="100" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td>
											<select class="cmbrbox" name="citizenship" onchange="selCitizenshipOthers()">									 
												<script language="JavaScript" type="text/javascript">
													GetCountry('India','');									
												</script>	
												<option value="Others">Others</option>							
											</select>
											<?	if ($user[citizenship]) { ?>
												<script language="JavaScript" type="text/javascript">
													document.thisForm.citizenship.value = "<?=$user[citizenship]?>";
												</script>
											<? } else { ?>
											<?	if (GetVar(citizenship)) { ?>
												<script language="JavaScript" type="text/javascript">
													document.thisForm.citizenship.value = "<?=GetVar("citizenship")?>";
												</script>
											<? }} ?>										</td>
									</tr>
									<tr id="div_citizenship" style="display:none">
										<td>
											<br />
											<input type="text" name="citizenship_1" class="txtrbox" />										</td>
									</tr>
								</table>							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td colspan="2" height="23">&nbsp;</td></tr>
			<tr>
				<td>
					<table width="100%" border="0" align="right" cellspacing="0" cellpadding="0" class="regall">
						 <tr>
							<td valign="top">
							   <table cellpadding="0" cellspacing="0" width="100%" border="0" class="reghbtm">
									<tr>
										<td colspan="2"><h4 class="rtitle" style="padding:10px 0px 0px 10px;">Professional Details</h4></td>
									</tr>
									<tr>
									<td style="padding:5px;">
									<table cellpadding="5" cellspacing="0" width="100%" border="0">											 						
									<tr>
								<td width="40%" height="25">Education category <font color="#FF0000">*</font></td>
								<td>
								<select name="education" class="cmbrbox">
									<option value="">-Select-</option>
									<?
										$res = Execute("select * from tbl_education_master");
										if (mysql_num_rows($res) > 0) {
											while ($education = mysql_fetch_array($res)) { ?>
												<option value="<?=$education[id]?>"><?=$education[education]?></option>	
										<?	}
										}
									?>
								</select>
								<? if ($user[education]) {?>
									<script language="javascript">
										document.thisForm.education.value = "<?=$user[education]?>";
									</script>
								<? } ?>
								</td>							
							 </tr>
							 <tr>
								<td height="25">Education in detail</td><td><input type="text" name="educationDetail" class="txtrbox" value="<?=$user[educationDetail]?>"></td>							
							 </tr>
							<tr>
								<td height="25">Occupation <font color="#FF0000">*</font></td>
								<td>
									<select name="occupation" class="cmbrbox">
										<?=GetOccupation(); ?>
									</select>
									<? if ($user[occupation]) {?>
											<script language="javascript">
												document.thisForm.occupation.value = "<?=$user[occupation]?>";
											</script>
										<? } ?>
									</td>							
								 </tr>	
								 <tr>
									<td height="25">Occupation in detail</td><td><input type="text" name="occupationDetail" class="txtrbox" value="<?=$user['occupationDetail']?>"></td>							
								 </tr>
								 <tr>
									<td>Annual income</td>
									<td height="25">
										<table cellpadding="0" cellspacing="0" width="100%" align="right" border="0">
										<tr>
											<td>
											&nbsp;&nbsp;Amount : &nbsp;<span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;Profile Details] size='20'; body=[Please enter ONLY digits in this field]" tyle="vertical-align:middle;font-family:arial;font-size:20px;font-weight:bold;color:#ABABAB;cursor:pointer">
											  <input type="text" name="income" class="incomebox" value="<?=$user[income]?>" onblur="toggleHint('hide', this.name);">&nbsp;</span>									
											<br />											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Indian Rupees.) </td>
										  </tr>									
										</table>
									</td>									
								 </tr>														
								<tr><td height="13" colspan="2"></td></tr>
							</table>
						</td>
					</tr>									
				</table>
			</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td style="padding-top:10px;">
		<table width="100%" border="0" align="right" cellspacing="0" cellpadding="0" class="regall">
		   <tr>
			   <td valign="top">
			   <table cellpadding="0" cellspacing="0" width="100%" border="0" class="reghbtm">
					<tr>
						<td colspan="2"><h4 class="rtitle" style="padding:10px 0px 0px 10px;">Community Details</h4></td>
					</tr>
					<tr>
						<td style="padding:5px;">
						<table cellpadding="5" cellspacing="0" width="100%" border="0">											 						
								<tr>
									<td width="40%">Caste / Division <font color="#FF0000">*</font></td>
									<td width="60%">
										<table cellpadding="0" cellspacing="0" width="100%" align="right" border="0"><tr><td>
										<?
											if ($user[religion]) {
												$religion_id =  $user[religion];
											} else {	
												$religion_id =  GetVar("religion");
											}
										?>																				
										<select name="caste" class="cmbrbox">									
											<option value="">--Select--</option>		
										</select>
										<?php /*?><?
												$resCaste = Execute("select * from tbl_caste_master where religionid = '$religion_id' order by religionid");
												if (mysql_num_rows($resCaste) > 0) { 
													while ($CasteMaster = mysql_fetch_array($resCaste)) {
													?>
													<option value="<?=$CasteMaster[id]?>"><?=$CasteMaster[caste]?></option>
												<?  }
												 }	?>	<?php */?>
										<? if ($user[caste]) { ?>
											<script language="javascript">
												document.thisForm.caste.value = "<?=$user[caste]?>";											
											</script>			
										<? 	} ?>
											</td>
											<td>&nbsp;</td>
											<td>																		
												<input type="checkbox" name="nocaste" value="1" class="radio" <? if($user[nocaste] == 1) { ?> checked <? } ?>>&nbsp;Caste no bar 
												<!--Select "Caste no bar" if you are not particular about caste.-->
											</td>
										</tr>									
										</table>
								  </td>
								</tr>									
								<tr>
									<td>Sub Caste</td><td><input type="text" name="subcaste" class="txtrbox" value="<?=$user[subcaste]?>"></td>
								</tr>
								<tr>
									<td>Mother tongue <font color="#FF0000">*</font></td>
									<td>
										<select name="language" class="cmbrbox">
											<script language="javascript">
												Language();
											</script>
										</select>
										<? if ($user[language]) {?>
											<script language="javascript">
												document.thisForm.language.value = "<?=$user[language]?>";											
											</script>
										<? } ?>
									</td>
								</tr>
								<tr>
									<td>Gothra(m)</td><td><input type="text" name="gothram" class="txtrbox" value="<?=$user[gothram]?>"></td>
								</tr>
								<tr>
									<td>Star</td>
									<td>
										<select name="star" class="cmbrbox">	
											<script language="javascript">
												star();
											</script>
										</select>
										<? if ($user[star]) {?>
											<script language="javascript">
												document.thisForm.star.value = "<?=$user[star]?>";											
											</script>
										<? } ?>
									</td>
								</tr>
								<tr>
									<td>Padam</td>
									<td>
										<select name="padam" class="cmbrbox">									
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="none" selected>none</option>
										</select>
										<? if ($user[padam]) {?>
											<script language="javascript">
												document.thisForm.padam.value = "<?=$user[padam]?>";											
											</script>
										<? } ?>
									</td>
								</tr>
								<tr>
									<? $sevvai = $user[sevvaiDosham]; ?>
									<td>Sevvai Dosham / manglik</td>
									<td><input type="radio" name="sevvaiDosham" value="2" class="radio" <? if ($sevvai == 2) {?> checked <? } ?> checked/>&nbsp;&nbsp;No&nbsp;&nbsp;<input type="radio" name="sevvaiDosham" value="1" class="radio" <? if ($sevvai == 1) {?> checked <? } ?> >&nbsp;&nbsp;Yes&nbsp;&nbsp;</td>
								</tr>
								</table>
						</td>
					</tr>									
				</table>
			</td>
			</tr>
		</table>
	</td>
</tr>
<tr><td colspan="2" height="15">&nbsp;</td></tr>
<tr>
	<td style="padding-top:10px;">
		<table width="100%" border="0" align="right" cellspacing="0" cellpadding="0" class="regall">
		   <tr>
			   <td valign="top">
			   <table cellpadding="0" cellspacing="0" width="100%" border="0" class="reghbtm">
					<tr>
						<td colspan="2"><h4 class="rtitle" style="padding:10px 0px 0px 10px;">Contact Details</h4></td>
					</tr>
					<tr>
						<td style="padding:5px;">
						<table cellpadding="5" cellspacing="0"  width="100%" border="0">						
								<tr>
									<td>Street Address <font color="#FF0000">*</font></td>
									<td><input type="text" name="streetAddress" class="txtrbox" value="<?=$user[streetAddress]?>"></td>
								</tr>
								<tr>
									<td>Area <font color="#FF0000">*</font></td><td><input type="text" name="area" class="txtrbox" value="<?=$user[area]?>"></td>
								</tr>
								<tr>								
									<td valign="top">Country <font color="#FF0000">*</font></td>
									<td valign="top">
										 <table cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td>
												<select class="cmbrbox" name="country" onchange="selState()">
													<option value="">Select</option>
													<?	GetCountry(); ?>
													<option value="Others">Others</option>
												</select>								
												<? if ($user[country]) {?>
												<script language="javascript">
													document.thisForm.country.value = "<?=$user[country]?>";
												</script>
												<? } else if (GetVar("country")) { ?>
													<script language="javascript" type="text/javascript">
														document.thisForm.country.value = "<?=GetVar("country")?>";
													</script>
												<? } ?>											
											</td>
										  </tr>										 
										   <tr>
											<td>
											<div id="div_country_1" style="display:none; padding-top:10px">											
											<input type="text" name="country_1" class="txtrbox" <? if (!$user[country] && $user[country_1]) { ?>value="<?=$user[country_1]?>" <? } else { ?>value="<?=GetVar("country_1")?>"<? } ?> />
											</div>
											</td>
										  </tr>
										</table>  	
									</td>
								</tr>							
								<tr>
									<td valign="top">State <font color="#FF0000">*</font></td>
									<td valign="top">
										 <table cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td>
									<!--<input type="text" name="state" class="txtrbox" value="<?=$user[state]?>">-->
										<select name="state" class="cmbrbox" onchange="selCity()">
											<option value="">-Select state-</option>										
										</select>
										<select name="country_vs_state" style="display:none">
											<? GetState();	?>
										</select>
										<select name="country_vs_state1" style="display:none">
											<? GetCountryVsState();	?>
										</select>																	
											</td>
										  </tr>
										  <tr>
											<td>
											<div id="div_state_1" style="display:none; padding-top:10px">											
											<input type="text"  class="txtrbox" name="state_1"  <? if (!$user[state] && $user[state_1]) { ?>value="<?=$user[state_1]?>" <? } else { ?>value="<?=GetVar("state_1")?>"<? } ?> />
											</div>
											</td>
										  </tr>
										</table> 
									</td>
								</tr>
								<tr>
									<td valign="top">City <font color="#FF0000">*</font></td>
									<td valign="top">
										 <table width="100%" cellpadding="0" cellspacing="0" align="right" border="0">
											<tr>
												<td align="left">
												<select name="city" class="cmbrbox" onchange="selCityOthers()">
													<option value="">-Select city-</option>										
												</select>																						
												</td>
											</tr>
											<tr>
												<td>
												<select name="state_vs_city" style="display:none">
													<? GetCity();	?>
												</select>
												<select name="state_vs_city1" style="display:none">
													<? GetStateVsCity();	?>
												</select>	
												<script language="javascript" type="text/javascript">
													//selState();									
												</script>												
												<? if ($user[state]) { ?>
													<script language="javascript">
														document.thisForm.state.value = "<?=$user[state];?>";
														selCity();													
													</script>	
												<? } else if (GetVar("state")) { ?>
													<script language="javascript">
														document.thisForm.state.value = "<?=GetVar("state")?>";
														selCity();
													</script>
												<? } else { ?>										
													<script language="javascript">
														//selCity();
													</script>
												<? } ?>
												<? if ($user[city]) { ?>
													<script language="javascript">
														document.thisForm.city.value = "<?=$user[city];?>";																					
													</script>	
												<? } else if (GetVar("city")) { ?>
													<script language="javascript">
														document.thisForm.city.value = "<?=GetVar("city")?>";																					
													</script>
												<? } ?>
												<div id="div_city_1" style="display:none; padding-top:10px">												
												<input type="text" name="city_1" class="txtrbox" <? if (!$user[city] && $user[city_1]) { ?>value="<?=$user[city_1]?>" <? } else { ?>value="<?=GetVar("city_1")?>"<? } ?> />
												</div>
												</td>
											  </tr>
										</table>									
									</td>
								</tr>	
								<tr>
									<td>Pin code <font color="#FF0000">*</font></td><td><input type="text" name="pincode" class="txtrbox" value="<?=$user[pincode]?>"></td>
								</tr>
								<a name="phonenum"></a>
								<tr>
									<td>Phone Number </td>
									<td>
										<table cellpadding="0" cellspacing="0" width="100%" align="right" border="0"><tr><td><font size="-2">Country code</font></td><td><font size="-2">Area code</font></td><td><font size="-2">Phone Number</font></td></tr>
										<tr>
										<? 
										if ($user[phoneNumber]) {
											$phone = explode("-",$user[phoneNumber]);									
										}	
										?>
										<td><input type="text" name="countryCode" class="pinbox" <? if ($phone[0]) { ?> value="<?=$phone[0]?>" <? } else {?> value="91" <? } ?> maxlength="2" /></td>
										<td><input type="text" name="areaCode" class="pinbox" value="<?=$phone[1]?>" maxlength="6" /></td>
										<td><input type="text" name="phoneNumber" class="incomebox" value="<?=$phone[2]?>" maxlength="12" /></td>
										</tr>
										</table>
									</td>						 
								</tr>
								<tr>							
									<td colspan="2" align="center">(Either phone number or mobile number are mandatory)</td>
								</tr>
								<tr>
									<td>Mobile</td>
									<td><input type="text" name="mobileNumber" class="txtrbox" value="<?=$user[mobileNumber]?>"></td>
								</tr>							
																			 						
							</table>
						</td>
					</tr>									
				</table>
			</td>
			</tr>
		</table>
	</td>
</tr>

</table>
</td>
</tr>
					
	</table>
	

	
	
	
	<table width="504" border="0" cellspacing="0" cellpadding="0"  >
		
  		<tr>
			<td valign="top" style="padding-left:10px;" align="left">
				<table cellpadding="0" cellspacing="0" width="480" border="0" >
					<tr>
						<td height="20"></td>
					</tr>
					<tr>
						<td valign="top" class="regstrip" colspan="2"><h4 class="rtitle" style="padding:3px 5px 3px 20px;">Login Deatils</h4></td>
					</tr>
					<tr><td colspan="2" height="5"></td></tr>
					<tr>
						<td colspan="2">
							<table cellpadding="5" cellspacing="0" width="100%" border="0" class="regbtm">
								<tr><td colspan="2" height="5" ></td></tr>
								<tr>
									<td  style="padding-left:47px;">E-Mail</td>							
									<td><input type="text" name="email" maxlength="255" class="txtrbox" value="<? if ($user[email]) { echo $user[email]; } else {?><?=GetVar(email)?><? } ?>">&nbsp;&nbsp;<!--<a href="http://in.rd.yahoo.com/indiaprop/ipmailform/*http://edit.india.yahoo.com/config/eval_register?.src=ym&.intl=in&.done=http%3A%2F%2Fmail.yahoo.com&.u=17apt112em189" target="_blank"><img src="images/addmatri-yahooicon.gif" width="25" height="13" hspace="5" align="absmiddle" border="0"></a><font class="normaltxt1"><a href="http://in.rd.yahoo.com/indiaprop/ipmailform/*http://edit.india.yahoo.com/config/eval_register?.src=ym&.intl=in&.done=http%3A%2F%2Fmail.yahoo.com&.u=17apt112em189" target="_blank" class="linktxt">Sign up</a> for Yahoo! India Mail</font>-->
									</td>
								</tr>
								<tr>
									<td style="padding-left:47px;">Choose password</td><td><span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;Profile Details] size='20'; body=[Minimum 5 characters. No special characters are allowed.]" tyle="vertical-align:middle;font-family:arial;font-size:20px;font-weight:bold;color:#ABABAB;cursor:pointer"><input type="password" class="txtrbox" name="password" value="<?=$user[password]?>" nBlur="toggleHint('hide', this.name);">&nbsp;</span>	</td>						
								</tr>
								<tr>
									<td  style="padding-left:47px;">Confirm password</td><td><input type="password" class="txtrbox" name="cpassword" value="<?=$user[password]?>"></td>
								</tr>
								<tr>
									<? if (!$_SESSION['userid']) {?>
									<td colspan="2" style="padding-left:222px;"><input type="checkbox" name="terms" value="1" checked="checked">&nbsp;<a class="reg" onclick="openTerms()" style="cursor:pointer">I Accept the Terms & Conditions</a></td></tr><? } ?>
							   <tr>
							<td colspan="2" style="padding-left:222px;">
							 <input name="Button" type="button" class="button" value="Join Now" onclick="fnRegister_2();">
							</td></tr>
							<tr><td colspan="2" height="5"></td></tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
					
	</table>
</div>
<script language="javascript">
	function openTerms() {			
			window.open("terms_conditions.php?mode=1&userid=<?=$userid?>","","width=630,height=600,menubar=yes,resizable=yes, scrollbars=yes");
		}
</script>			
<script type="text/javascript">
	mydate = new dsInput( 'mydate' );
</script>
<script language="JavaScript" type="text/javascript">
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
<script language="JavaScript" type="text/javascript">
		document.thisForm.mydateM.value = "<?=intval($dob[1]);?>";
		document.thisForm.mydateY.value = "<?=intval($dob[0]);?>";									
		document.thisForm.mydateD.value = "<?=intval($dob[2]);?>";									
		rem(); mydate.adjustDaysInMonth(); updateHiddenDate(); DOB2Age();		
</script>

<?  }  ?>
<script src="includes/boxover.js"></script>				
