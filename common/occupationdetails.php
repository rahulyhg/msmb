<script language="javascript">
function fnGetlink(Fname)
{
	window.open(Fname,'','width=350,height=150,scrollbars=yes,status=no,toolbar=no,top=0,left=550');
}
</script>
<div style="margin:20px 20px 0px 0px;  float:right;">
<table width="476" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="regall">
		  <tr>
			<td>
				<table cellpadding="0" cellspacing="0" width="100%" border="0" class="reghbtm">
					<tr>
						<td colspan="2"><h4 class="rtitle" style="padding:10px 0px 0px 10px;">Professional Details</h4></td>
					</tr>
					<tr>
						<td style="padding:5px;">
							<table cellpadding="5" cellspacing="0" width="100%" border="0">
								<tr><td colspan="2" height="10"></td></tr>
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
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="regall">
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
											<?
												$resCaste = Execute("select * from tbl_caste_master where religionid = '$religion_id' order by religionid");
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
									<td><input type="radio" name="sevvaiDosham" value="2" class="radio" <? if ($sevvai == 2) {?> checked <? } ?> checked>&nbsp;&nbsp;No&nbsp;&nbsp;<input type="radio" name="sevvaiDosham" value="1" class="radio" <? if ($sevvai == 1) {?> checked <? } ?>>&nbsp;&nbsp;Yes&nbsp;&nbsp;</td>
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
<tr>
	<td style="padding-top:10px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="regall">
		   <tr>
			   <td valign="top">
			   <table cellpadding="0" width="100%" cellspacing="0"  border="0" class="reghbtm">
					<tr>
						<td colspan="2"><h4 class="rtitle" style="padding:10px 0px 0px 10px;">Family Details</h4></td>
					</tr>
					<tr>
						<td style="padding:5px;">
						<table cellpadding="5" cellspacing="0" width="100%" border="0">						
								<tr>
									<td width="40%">Family value <font color="#FF0000">*</font></td>
									<td width="60%">
										<select name="familyValue" class="cmbrbox">
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
									<td>Family type <font color="#FF0000">*</font></td>
									<td>
										<select name="familyType" class="cmbrbox">
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
									<td>Family status <font color="#FF0000">*</font></td>
									<td>
										<select name="familyStatus" class="cmbrbox">
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
									<td>Father Name <font color="#FF0000">*</font></td><td><input type="text" name="fatherName" class="txtrbox" value="<?=$user[fatherName]?>"></td>
								</tr>
								<tr>
									<td>Father Profession</td><td><input type="text" name="fatherProfessions" class="txtrbox" value="<?=$user[fatherProfessions]?>"></td>
								</tr>
								<tr>
									<td>Mother Name <font color="#FF0000">*</font></td><td><input type="text" name="motherName" class="txtrbox" value="<?=$user[motherName]?>"></td>
								</tr>
								<tr>
									<td>Mother Profession</td><td><input type="text" name="motherProfession" class="txtrbox" value="<?=$user[motherProfession]?>"></td>
								</tr>
								<tr>
									<td>No of Sister</td>
									<td>
										<table cellpadding="0" cellspacing="0" width="100%" align="right" border="0"><tr><td>Married</td><td>
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
									<td>No of Brothers</td>
									<td>
										<table cellpadding="0" cellspacing="0" width="100%" align="right" border="0"><tr><td>Married</td><td>
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
									<td>About my family</td>
									<td>
										<textarea name="aboutFamily" class="regarea" onKeyPress="return isMaxLen(document.thisForm.aboutFamily_count,this,1000,'About my family')" onBlur="formElementLimiter(this,1000);"><?=$user[aboutFamily]?></textarea>
										<br />(min. 50 Characters;max. 1000)&nbsp;&nbsp;<input type="text" name="aboutFamily_count" class="pinbox" readonly />
										<a href=javascript:fnGetlink('register_hints.php') class="hint">Hints</a>
										<script language="javascript">
											var strLen1 = document.thisForm.aboutFamily.value;
											document.thisForm.aboutFamily_count.value = strLen1.length;
										</script>
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
<tr>
	<td style="padding-top:10px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="regmidbg">
		   <tr>
			   <td valign="top">
			   <table cellpadding="0" cellspacing="0" width="100%"  border="0" class="reghtop">
					<tr>
						<td colspan="2"><h4 class="rtitle" style="padding:10px 0px 0px 10px;">Contact Details</h4></td>
					</tr>
					<tr>
						<td style="padding:5px;" class="reghbtm">
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
								<tr>
									<td>Fax</td><td><input type="text" name="fax" class="txtrbox" value="<?=$user[fax]?>"></td>						 
								</tr>							
								<tr><td valign="top"><strong>Precently Residing in</strong> <font color="#FF0000">*</font></td><td></td></tr>
										<tr><td valign="top">Country</td>
											<td>	
												 <table width="100%" cellpadding="0" cellspacing="0" align="right" border="0">
													 <tr>
														<td>										
														<select class="cmbrbox" name="residingCountry" onchange="selState1()">
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
														<input type="text" name="residingCountry_1" class="txtrbox" <? if (!$user[residingCountry] && $user[residingCountry_1]) { ?>value="<?=$user[residingCountry_1]?>" <? } else { ?>value="<?=GetVar("residingCountry_1")?>"<? } ?> />
														</div>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr><td valign="top">State</td>
											<td>
											<!--<input type="text" name="residingState" class="txtrbox" value="<?=$user[residingState]?>">-->
												 <table width="100%" cellpadding="0" cellspacing="0" align="right" border="0">
													<tr>
														<td>
												
													<select name="residingState" class="cmbrbox" onchange="selCity1()">
														<option value="">-Select state-</option>
														<option value="Others">Others</option>										
													</select>																					
														</td>
													  </tr>
													  <tr>
														<td>
														<div id="div_residingState_1" style="display:none; padding-top:10px">														
														<input type="text" name="residingState_1" class="txtrbox" <? if (!$user[residingState] && $user[residingState_1]) { ?>value="<?=$user[residingState_1]?>" <? } else { ?>value="<?=GetVar("residingState_1")?>"<? } ?> />
														</div>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr><td valign="top">City</td>
											<td>
											<!--<input type="text" name="residingCity" class="txtrbox" value="<?=$user[residingCity]?>">-->
												 <table width="100%" cellpadding="0" cellspacing="0" align="right" border="0">
													<tr>
														<td>
														<select name="residingCity" class="cmbrbox" onchange="selCityOthers1()">
															<option value="">-Select city-</option>	
															<option value="Others">Others</option>									
														</select>																																				
														</td>
													</tr>
													<tr>
														<td>
														<div id="div_residingCity_1" style="display:none; padding-top:10px">														
														<input type="text" name="residingCity_1" class="txtrbox" <? if (!$user[residingCity] && $user[residingCity_1]) { ?>value="<?=$user[residingCity_1]?>" <? } else { ?>value="<?=GetVar("residingCity_1")?>"<? } ?> />
														<? if ($user[residingCountry]) { ?>									
															<script language="javascript" type="text/javascript">
																selState1();													
															</script>
														<? } else if (GetVar("residingState")) { ?>
															<script language="javascript" type="text/javascript">
																selState1();									
															</script>
														<? } ?>
														<? if ($user[residingState]) { ?>
															<script language="javascript">
																document.thisForm.residingState.value = "<?=$user[state];?>";
																selCity1();
															</script>	
														<? } else if (GetVar("residingState")) { ?>
															<script language="javascript">
																document.thisForm.residingState.value = "<?=GetVar("residingState")?>";
																selCity1();	
															</script>
														<? } ?>													
														<? if ($user[residingCity]) { ?>
															<script language="javascript">
																document.thisForm.residingCity.value = "<?=$user[residingCity];?>";																					
															</script>	
														<? } else if (GetVar("residingCity")) { ?>
															<script language="javascript">
																document.thisForm.residingCity.value = "<?=GetVar("residingCity")?>";																					
															</script>
														<? } ?>	
														</div>															
													</td>
												</tr>
											</table>
									</td>
								</tr>
								<tr>								
									<td>Nationality <font color="#FF0000">*</font></td>
									<td>
										
											<select class="cmbrbox" name="nationality" onchange="selNationalityOthers()">
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
											<select name="sample" style="display:none">
												<option value="">select</option>
												<option value="">select</option>
												<option value="">select</option>
												<option value="">select</option>
												<option value="">select</option>											
											</select>				
									</td>
								</tr>
								<tr id="div_nationality" style="display:none">
									<td>&nbsp;</td>
									<td>
										<input type="text" name="nationality_1" class="txtrbox" />	
									</td>
								</tr>																	
								<tr>								
									<td colspan="2" align="center">
										<input type="submit" value="Submit" class="button">							
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
</div>
<script src="includes/boxover.js"></script>