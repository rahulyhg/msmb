<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
  <tr>
	<td align="left" style="padding:5px 5px 9px 30px;" height="16"><h3 class="topic">Occupation/Family details</h3></td><td idth="254">&nbsp;</td>
	<td idth="314">&nbsp;</td>
  </tr>  
  <tr>
	<td align="center" colspan="2">
		<table width="22%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="tbdrlft" bgcolor="#f3fae6" align="center" width="500" >
					<table width="90%" border="0" cellspacing="0" cellpadding="7">
					  <tr><td colspan="3"><b>Professional Details</b></td></tr>	
					  <tr>
						<td class="intxt" align="left">Education category <font color="#FF0000">*</font></td>
						<td width="25" class="intxt">:</td>
						<td class="intxt" width="105" align="left">
						<select name="education" class="mprcmbbox">
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
						<? if ($config[userinfo][education]) {?>
							<script language="javascript">
								document.thisForm.education.value = "<?=$config[userinfo][education]?>";
							</script>
						<? } ?>
					   </td>
					  </tr>
					  <tr>
						<td class="intxt"align="left">Education in detail</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<input type="text" name="educationDetail" class="mprtxtbox" value="<?=$user[educationDetail]?>">
						</td>
					</tr>										  
					<tr>
						<td class="intxt" align="left">Occupation <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<select name="occupation" class="mprcmbbox">
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
						<td class="intxt" align="left">Occupation in detail</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<input type="text" name="occupationDetail" class="mprtxtbox" value="<?=$user['occupationDetail']?>">
						</td>
					</tr>					  
					<tr>
						<td class="intxt" align="left">Annual income</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							&nbsp;&nbsp;Amount : &nbsp;<span title="header=[<img src='images/info.gif' style='vertical-align:middle'>&nbsp;&nbsp;Profile Details] size='20'; body=[Please enter ONLY digits in this field.]" tyle="vertical-align:middle;font-family:arial;font-size:20px;font-weight:bold;color:#ABABAB;cursor:pointer"><input type="text" name="income" class="mprtxtbox" value="<?=$user[income]?>" onblur="toggleHint('hide', this.name);">&nbsp;</span>
						</td>
					</tr>
					<tr><td class="intxt" colspan="3" height="10"></td></tr>					
					<tr>
						<td colspan="3"><b style="color:#dd1915;">Community Details</b></td>
					</tr>
					<tr>
						<td class="intxt" align="left">Caste / Division <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
						<?
							if ($user[religion]) {
								$religion_id =  $user[religion];
							} else {	
								$religion_id =  GetVar("religion");
							}
						?>																				
						<select name="caste" class="mprcmbbox">									
							<option value="">--Select--</option>		
							<?
								$resCaste = Execute("select * from tbl_caste_master where religionid = '$religion_id' order by caste");
								if (mysql_num_rows($resCaste) > 0) { 
									while ($CasteMaster = mysql_fetch_array($resCaste)) {
									?>
									<option value="<?=$CasteMaster[id]?>"><?=$CasteMaster[caste]?></option>
								<?  }
								 }	?>							
						</select>																								
						<? if ($user[caste]) { ?>
							<script language="javascript">
								document.thisForm.caste.value = "<?=$user[caste]?>";											
							</script>			
						<? 	} ?>
						<br>						 		
						</td>
					</tr>
					<tr>
						<td colspan="2" class="intxt">&nbsp;</td><td class="intxt" align="left"><input type="checkbox" name="nocaste" value="1" class="radio" <? if($user[nocaste] == 1) { ?> checked <? } ?>>&nbsp;Caste no bar</td>
					</tr>
					<tr>						
						<td class="intxt" width="124" align="left">Sub Caste</td>
						<td class="intxt" width="25">:</td>
						<td class="intxt" width="105" align="left"><input type="text" name="subcaste" class="mprtxtbox" value="<?=$user[subcaste]?>"></td>														
					</tr>						
					  <tr>
						<td class="intxt" width="124" align="left">Mother tongue <font color="#FF0000">*</font></td>
						<td class="intxt" width="25">:</td>
						<td class="intxt" width="105" align="left">
							<select name="language" class="mprcmbbox">
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
						<td class="intxt" width="124" align="left">Gothra(m)</td>
						<td class="intxt" width="25">:</td>
						<td class="intxt" width="105" align="left">
							<input type="text" name="gothram" class="mprtxtbox" value="<?=$user[gothram]?>">
						</td>
					  </tr>
					  <tr>
						<td class="intxt" width="124" align="left">Star</td>
						<td class="intxt" width="25">:</td>
						<td class="intxt" width="105" align="left">
							<select name="star" class="mprtxtbox">	
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
						<td class="intxt" width="124" align="left">Padam</td>
						<td class="intxt" width="25">:</td>
						<td class="intxt" width="105" align="left">
							<select name="padam" class="mprcmbbox">									
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
						<td class="intxt" width="124" align="left">Sevvai Dosham / manglik</td>
						<td class="intxt" width="25">:</td>
						<td class="intxt" width="105" align="left">
							<input type="radio" name="sevvaiDosham" value="2" class="radio" <? if ($sevvai == 2) {?> checked <? } ?> checked>&nbsp;&nbsp;No&nbsp;&nbsp;<input type="radio" name="sevvaiDosham" value="1" class="radio" <? if ($sevvai == 1) {?> checked <? } ?>>&nbsp;&nbsp;Yes&nbsp;&nbsp;
						</td>
					  </tr>
					  <tr><td class="intxt" colspan="3" height="10"></td></tr>
					  <tr>
						<td colspan="3"><b style="color:#dd1915;">Family Details</b></td>
					  </tr>		  
					  <tr>
						<td class="intxt"align="left">Family value <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<select name="familyValue" class="mprcmbbox">
								<option value="">--Select--</option>	
								<option value="Traditional">Traditional</option>											
								<option value="Moderate">Moderate</option>
								<option value="Liberal">Liberal</option>
								<option value="Orthodox">Orthodox</option>
							</select>	
							<? if ($user[familyValue]) { ?>
								<script language="javascript">
									document.thisForm.familyValue.value = "<?=$user[familyValue]?>";											
								</script>
							<? } ?>	
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">Family type <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<select name="familyType" class="mprcmbbox">
								<option value="">--Select--</option>
								<option value="Joint family">Joint family</option>
								<option value="Nuclear family">Nuclear family</option>
								<option value="Others">Others</option>									
							</select>
							<? if ($user[familyType]) {?>
								<script language="javascript">
									document.thisForm.familyType.value = "<?=$user[familyType]?>";											
								</script>
							<? } ?>
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">Family status <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<select name="familyStatus" class="mprcmbbox">
								<option value="">--Select--</option>
								<option value="Middle class">Middle class</option>
								<option value="Upper middle class">Upper middle class</option>
								<option value="Rich / Affluent">Rich / Affluent</option>
							</select>	
							<? if ($user[familyStatus]) {?>
								<script language="javascript">
									document.thisForm.familyStatus.value = "<?=$user[familyStatus]?>";											
								</script>
							<? } ?>	
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">Father Name <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<input type="text" name="fatherName" class="mprtxtbox" value="<?=$user[fatherName]?>">	
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">Father Professions</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<input type="text" name="fatherProfessions" class="mprtxtbox" value="<?=$user[fatherProfessions]?>">
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">Mother Name <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<input type="text" name="motherName" class="mprtxtbox" value="<?=$user[motherName]?>">
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">Mother Profession</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<input type="text" name="motherProfession" class="mprtxtbox" value="<?=$user[motherProfession]?>">
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">No of Sister</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<table class="story"><tr><td>Married</td><td>
								<select name="marriedSister" class="agebox">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<? if ($user[marriedSister]) {?>
								<script language="javascript">
									document.thisForm.marriedSister.value = "<?=$user[marriedSister]?>";
								</script>
								<? } ?>								
								</td><td>UnMarried</td><td>								
								<select name="unMarriedSister" class="agebox">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<? if ($user[unMarriedSister]) {?>
								<script language="javascript">
									document.thisForm.unMarriedSister.value = "<?=$user[unMarriedSister]?>";
								</script>	
								<? } ?>
							</td></tr></table>	
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">No of Brothers</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<table class="story"><tr><td>Married</td><td>
								<select name="marriedBrothers" class="agebox">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<? if ($user[marriedBrothers]) {?>
								<script language="javascript">
									document.thisForm.marriedBrothers.value = "<?=$user[marriedBrothers]?>";
								</script>	
								<? } ?>									
								</td><td>UnMarried</td><td>
								<select name="unMarriedBrothers" class="agebox">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>									
								<? if ($user[unMarriedBrothers]) {?>
								<script language="javascript">
									document.thisForm.unMarriedBrothers.value = "<?=$user[unMarriedBrothers]?>";
								</script>	
								<? } ?>	
							</td></tr></table>	
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">About my family</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<textarea name="aboutFamily" class="regarea" onKeyPress="return isMaxLen(document.thisForm.aboutFamily_count,this,1000,'About my family')" onBlur="formElementLimiter(this,1000);"><?=$user[aboutFamily]?></textarea>
							<br />(min. 50 Characters;max. 1000)&nbsp;&nbsp;<!--<a href=javascript:fnGetlink('register_hints.php') class="moreid">Hints</a>-->
							<input type="text" name="aboutFamily_count" class="pinbox" readonly />
							<script language="javascript">
								var strLen1 = document.thisForm.aboutFamily.value;
								document.thisForm.aboutFamily_count.value = strLen1.length;
							</script>
						</td>
					  </tr>				
					  <tr>
						<td align="center" colspan="3" class="intxt" style="padding-right:46px;">
							<input type="submit" value="Update" class="button" />
						</td>
					  </tr>	  		  
					</table>
				</td>
				<td class="tbdrrgt" valign="top">
					<table width="100%" border="0" cellspacing="0" cellpadding="5">					  
					  <tr><td colspan="3"><b>Contact Details</b></td></tr>
					  <tr>
						<td class="intxt" align="left">Street Address <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<input type="text" name="streetAddress" class="mprtxtbox" value="<?=$user[streetAddress]?>">
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">Area <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<input type="text" name="area" class="mprtxtbox" value="<?=$user[area]?>">
						</td>
					  </tr>	
					  <tr>
						<td class="intxt" align="left">Country <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<table>
								<tr>
									<td>
									<select class="mprcmbbox" name="country" onchange="selState()">
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
								<div id="div_country_1" style="display:none">
								<br />
								<input type="text" name="country_1" class="mprtxtbox" value="<?=$user[country_1]?>"  />
								</div>
								</td>
							  </tr>	
							  		
							</table>
						</td>
					  </tr>	
					  <tr>
						<td class="intxt" align="left">State <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<table>
								<tr>
									<td>
								<!--<input type="text" name="state" class="regbox" value="<?=$user[state]?>">-->
									<select name="state" class="mprcmbbox" onchange="selCity()">
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
								<div id="div_state_1" style="display:none">
								<br />
								<input type="text"  class="mprtxtbox" name="state_1"  value="<?=$user["state_1"]?>" />
								</div>
								</td>
							  </tr>											  
							</table>
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">City <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<table>
								<tr>
									<td>
									<select name="city" class="mprcmbbox" onchange="selCityOthers()">
										<option value="">-Select city-</option>	
										<option value="Others">Others</option>									
									</select>
									<select name="state_vs_city" style="display:none">
										<? GetCity();	?>
									</select>
									<select name="state_vs_city1" style="display:none">
										<? GetStateVsCity();	?>
									</select>										
									</td>
							  </tr>  
							  <tr>
								<td>
								<div id="div_city_1" style="display:none">
								<br />
								<input type="text" name="city_1" class="mprtxtbox" value="<?=$user[city_1]?>" />
								</div>
								</td>
							  </tr>
							  <script language="javascript" type="text/javascript">
									selState();													
							  </script>
							  <? if ($user[state]) { ?>
								<script language="javascript">
									document.thisForm.state.value = "<?=$user[state];?>";
									selCity();													
								</script>	
							  <? } else { ?>
								<script language="javascript">									
									selCity();
								</script>
							  <? } ?>										
							  <? if ($user[city]) { ?>
								<script language="javascript">
									document.thisForm.city.value = "<?=$user[city];?>";																					
								</script>	
							  <? } ?>
									
									<? if ($user[country_1]) { ?>										
										<script language="javascript">
											document.thisForm.country.value = "Others";
											document.getElementById("div_country_1").style.display = "block";
										</script>
									<? } ?>
									
									<? if ($user[state_1]) { ?>										
										<script language="javascript">
											document.thisForm.state.value = "Others";
											document.getElementById("div_state_1").style.display = "block";
										</script>
									<? } ?>
									
									<? if ($user[city_1]) { ?>										
										<script language="javascript">
											document.thisForm.city.value = "Others";
											document.getElementById("div_city_1").style.display = "block";																					
										</script>
									<? } ?>			  
							</table>
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">Pin code <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<input type="text" name="pincode" class="mprtxtbox" value="<?=$user[pincode]?>">
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">Phone Number</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<table class="story"><tr><td><font size="-2">Country code</font>
							<? 
							if ($user[phoneNumber]) {
								$phone = explode("-",$user[phoneNumber]);									
							}	
							?>
							</td><td><input type="text" name="countryCode" class="mprsmlbox" <? if ($phone[0]) { ?> value="<?=$phone[0]?>" <? } else {?> value="91" <? } ?> maxlength="2" />&nbsp;<input type="text" name="areaCode" class="mprsmlbox" value="<?=$phone[1]?>" maxlength="6" /> &nbsp; <input type="text" name="phoneNumber" class="mprlgtbox1" value="<?=$phone[2]?>" maxlength="12" /></td></tr>
							<!--<tr><td><font size="-2">Area code</font></td><td><input type="text" name="areaCode" class="pinbox" value="<?=$phone[1]?>" maxlength="4" /><input type="text" name="phoneNumber" class="txtbox1" value="<?=$phone[2]?>" maxlength="8" /></td></tr>
							<tr><td><font size="-2">Phone Number</font></td><td><input type="text" name="phoneNumber" class="txtbox1" value="<?=$phone[2]?>" maxlength="8" /></td></tr>-->
							</table>
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left" colspan="3">
							(Either phone number or mobile number are mandatory)
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">Mobile</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<input type="text" name="mobileNumber" class="mprtxtbox" value="<?=$user[mobileNumber]?>">
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left">Fax</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<input type="text" name="fax" class="mprtxtbox" value="<?=$user[fax]?>">
						</td>
					  </tr>
					  <tr>
						<td class="intxt" align="left" valign="top">Precently Residing in <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<table class="story">
								<tr><td valign="top"><b>Country</b></td>
									<td>	
										<table>
											 <tr>
												<td>										
												<select class="mprcmbbox" name="residingCountry" onchange="selState1()">
													<option value="">Select</option>										
													<?	GetCountry(); ?>
													<option value="Others">Others</option>														
												</select>								
												<? if ($user[residingCountry]) {?>
												<script language="javascript">
													document.thisForm.residingCountry.value = "<?=$user[residingCountry]?>";
												</script>
												<? } else if (GetVar("residingCountry")) { ?>
													<script language="javascript" type="text/javascript">
														document.thisForm.residingCountry.value = "<?=GetVar("residingCountry")?>";
													</script>
												<? } ?>															
												</td>
											 </tr>
											 <tr>
												<td>
												<div id="div_residingCountry_1" style="display:none; padding-top:10px">												
												<input type="text" name="residingCountry_1" class="mprtxtbox" value="<?=$user[residingCountry_1]?>" />
												</div>
												</td>
											</tr>											 
										</table>
									</td>
								</tr>								
								<tr><td valign="top"><b>State</b></td>
									<td>
									<!--<input type="text" name="residingState" class="regbox" value="<?=$user[residingState]?>">-->
										<table>
											<tr>
												<td>										
												<select name="residingState" class="mprcmbbox" onchange="selCity1()">
													<option value="">-Select state-</option>
													<option value="Others">Others</option>										
												</select>																					
												</td>
											  </tr>											  
											  <tr>
												<td>
												<div id="div_residingState_1" style="display:none; padding-top:10px">												
												<input type="text" name="residingState_1" class="mprtxtbox" value="<?=$user[residingState_1]?>" />
												</div>
												</td>
											</tr>				  
										</table>
									</td>
								</tr>
								<tr><td valign="top"><b>City</b></td>
									<td>
									<!--<input type="text" name="residingCity" class="regbox" value="<?=$user[residingCity]?>">-->
										<table>
											<tr>
												<td>
												<select name="residingCity" class="mprcmbbox" onchange="selCityOthers1()">
													<option value="">-Select city-</option>
													<option value="Others">Others</option>							
												</select>																							
												</td>
											</tr>
											<tr>
												<td>
													<div id="div_residingCity_1" style="display:none; padding-top:10px">												
													<input type="text" name="residingCity_1" class="txtbox" value="<?=$user[residingCity_1]?>"/>
													</div>
																			
													<script language="javascript" type="text/javascript">
														selState1();													
													</script>				
													<? if ($user[state]) { ?>
													<script language="javascript">
														document.thisForm.residingState.value = "<?=$user[state];?>";
														selCity1();
													</script>	
													<? } else { ?>					
													<script language="javascript">																	
														selCity1();
													</script>	
													<? } ?>
													<? if ($user[residingCity]) { ?>
														<script language="javascript">
															document.thisForm.residingCity.value = "<?=$user[residingCity];?>";																					
														</script>											
													<? } ?>
													<? if ($user[residingCountry_1]) { ?>										
														<script language="javascript">
															document.thisForm.residingCountry.value = "Others";
															document.getElementById("div_residingCountry_1").style.display = "block";
														</script>
													<? } ?>
													
													<? if ($user[residingState_1]) { ?>										
														<script language="javascript">
															document.thisForm.residingState.value = "Others";
															document.getElementById("div_residingState_1").style.display = "block";
														</script>
													<? } ?>
													
													<? if ($user[residingCity_1]) { ?>										
														<script language="javascript">
															document.thisForm.residingCity.value = "Others";															
															document.getElementById("div_residingCity_1").style.display = "block";																					
														</script>
													<? } ?>													
											  </td>
											 </tr> 													
										</table>
									</td>
								</tr>
								</table>
						</td>
					  </tr>	
					  <tr>
						<td class="intxt" align="left">Nationality <font color="#FF0000">*</font></td>
						<td class="intxt" valign="top">:</td>
						<td class="intxt" align="left" valign="top">
							<select class="mprcmbbox" name="nationality" onchange="selNationalityOthers()">
								<option value="">Select</option><? GetCountry();?>
								<option value="Others">Others</option>
							</select>	
							<? if ($user[nationality]) {?>
							<script language="javascript">
								document.thisForm.nationality.value="<?=$user[nationality]?>";
							</script>
							<? } else { ?>	
							<script language="javascript">
								document.thisForm.nationality.value="100";
							</script>	
							<? } ?>	
						</td>
					  </tr>	
					  <tr>
					  		<td colspan="2"></td>
							<td align="left" id="div_nationality" style="display:none">								
							<input type="text" name="nationality_1" class="mprtxtbox" value="<?=$config[userinfo][nationality_1]?>" /> 
								  <? if ($user[nationality_1]) { ?>										
								<script language="javascript">
									document.thisForm.nationality.value = "Others";
									document.getElementById("div_nationality").style.display = "block";
								</script>
							<? } ?>
							</td>									                     
					  </tr>		
					  <tr><td class="intxt" colspan="3" height="10"></td></tr>	
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
<script src="includes/boxover.js"></script>