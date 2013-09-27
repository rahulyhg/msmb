
							 <tr class="tblContent">
								<td colspan="2" align="left"><b>Professional Details</b></td>
							 </tr>
							 <tr class="tblContent">
								<td width="200">Education category <font color="#FF0000">*</font></td>
								<td width="450">
									<select name="education" class="cmbbox">
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
							 <tr class="tblContent">
								<td>Education in detail</td><td><input type="text" name="educationDetail" class="txtbox" value="<?=$user[educationDetail]?>"></td>							
							</tr>
							<tr class="tblContent">
								<td>Occupation <font color="#FF0000">*</font></td>
								<td>
									<select name="occupation" class="cmbbox">
										<?=GetOccupation(); ?>
									</select>
									<? if ($user[occupation]) {?>
										<script language="javascript">
											document.thisForm.occupation.value = "<?=$user[occupation]?>";
										</script>
									<? } ?>
								</td>							
							 </tr>	
							<tr class="tblContent">
								<td>Occupation in detail</td><td><input type="text" name="occupationDetail" class="txtbox" value="<?=$user['occupationDetail']?>"></td>							
							 </tr>
							 <tr class="tblContent">
								<td>Annual income</td>
								<td>
									<table>
									<tr>
										<td>&nbsp;											
										</td>
										<td>Amount : &nbsp;<input type="text" name="income" class="txtpasswordbox" value="<?=$user[income]?>" /></td>
									</tr>
									<tr>
										<td colspan="2">(Indian Rupees.)</td>
									</tr>
									</table>
								</td>
							 </tr>							
							 <tr class="tblContent">
								<td colspan="2" align="left"><b>Horoscope details</b></td>
							 </tr>							
							<tr class="tblContent">
								<td>Upload Horoscope </td>
								<td><input type="file" name="horoscope1" class="txtbox">
								<? if ($user[horoscope]) {?>
								<a href="../horoscope/<?=$user[horoscope]?>"><?=$user[horoscope]?></a>
								<? } ?>
								</td>
							</tr>
							<tr class="tblContent">
								<td colspan="2" align="left"><b>Community Details</b></td>
							 </tr>
							<tr class="tblContent">
								<td>Religion <font color="#FF0000">*</font></td>
								<td>
									<? if ($user[domain]) {
											$domain = $user[domain];
									   }  ?>
									   <select name="religion" class="cmbbox" nChange="SelectCaste();" onChange="FillCaste3();">										
										<option value="">Select</option>
									   </select>										
								</td>
							<tr>						
							<tr class="tblContent">
								<td>Caste / Division <font color="#FF0000">*</font></td>
								<td>
									<table><tr><td>														
									<select name="caste" class="cmbbox">									
										<option value="">--Select--</option>									
									</select>									
									<? if ($user[religion]) { ?>			
									<script language="javascript">
										FillReligionsCaste1('<?=$user[religion]?>','<?=$user[caste]?>');
									</script>	
									<? } ?>
									<? if ($user[religion]) { ?>
										<script language="javascript">
											document.thisForm.religion.value = "<?=$user[religion]?>";											
										</script>			
									<? 	} ?>	
									<? if ($user[caste]) { ?>
										<script language="javascript">
											document.thisForm.caste.value = "<?=$user[caste]?>";											
										</script>			
									<? 	} ?>
									</td><td>								
									<input type="checkbox" name="nocaste" value="1" lass="radio" <? if($user[nocaste] == 1) { ?> checked <? } ?>>&nbsp;Caste no bar																	
									</td>
									</tr></table>
								</td>
							</tr>									
							<tr class="tblContent">
								<td>Sub Caste</td><td><input type="text" name="subcaste" class="txtbox" value="<?=$user[subcaste]?>"></td>
							</tr>
							<tr class="tblContent">
								<td>Mother tongue <font color="#FF0000">*</font></td>
								<td>
									<select name="language" class="cmbbox">
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
							<tr class="tblContent">
								<td>Gothra(m)</td><td><input type="text" name="gothram" class="txtbox" value="<?=$user[gothram]?>"></td>
							</tr>
							<tr bgcolor="#FFFFFF">
								<td>Star</td>
								<td>
									<select name="star" class="cmbbox">	
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
							<tr class="tblContent">
								<td>Padam</td>
								<td>
									<select name="padam" class="cmbbox">									
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
							<tr class="tblContent">
								<? $sevvai = $user[sevvaiDosham]; ?>
								<td>Sevvai Dosham / manglik</td>
								<td><input type="radio" name="sevvaiDosham" value="1" class="radio" <? if ($sevvai == 1) {?> checked <? } ?>>&nbsp;&nbsp;Yes&nbsp;&nbsp;<input type="radio" name="sevvaiDosham" value="2" class="radio" <? if ($sevvai == 2) {?> checked <? } ?>>&nbsp;&nbsp;No</td>
							</tr>
							<tr class="tblContent">
								<td colspan="2" align="left"><b>Family Details:</b></td>							
							</tr>
							<tr class="tblContent">
								<td>Family value <font color="#FF0000">*</font></td>
								<td>
									<select name="familyValue" class="cmbbox">
										<option value="">--Select--</option>	
										<option value="Traditional">Traditional</option>											
										<option value="Moderate">Moderate</option>
										<option value="Liberal">Liberal</option>
										<option value="Orthodox">Orthodox</option>
									</select>	
									<? if ($user[familyValue]) {?>
										<script language="javascript">
											document.thisForm.familyValue.value = "<?=$user[familyValue]?>";											
										</script>
									<? } ?>						
								</td>
							</tr>
							<tr class="tblContent">
								<td>Family type <font color="#FF0000">*</font></td>
								<td>
									<select name="familyType" class="cmbbox">
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
							<tr class="tblContent">
								<td>Family status</td>
								<td>
									<select name="familyStatus" class="cmbbox">
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
							<tr class="tblContent">
								<td>Father Name <font color="#FF0000">*</font></td><td><input type="text" name="fatherName" class="txtbox" value="<?=$user[fatherName]?>"></td>
							</tr>
							<tr class="tblContent">
								<td>Father Professions</td><td><input type="text" name="fatherProfessions" class="txtbox" value="<?=$user[fatherProfessions]?>"></td>
							</tr>
							<tr class="tblContent">
								<td>Mother Name <font color="#FF0000">*</font></td><td><input type="text" name="motherName" class="txtbox" value="<?=$user[motherName]?>"></td>
							</tr>
							<tr class="tblContent">
								<td>Mother Profession</td><td><input type="text" name="motherProfession" class="txtbox" value="<?=$user[motherProfession]?>"></td>
							</tr>
							<tr bgcolor="#FFFFFF">
								<td>No of Sister</td>
								<td>
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
							<tr bgcolor="#FFFFFF">
								<td>No of Brothers</td>
								<td>
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
							<!--<tr class="tblContent">
								<td>Family Origin</td><td><input type="text" name="familyOrigin" class="txtbox" value="<?=$user[familyOrigin]?>"></td>
							</tr>-->
							<tr class="tblContent">
								<td>About my family</td>
								<td>
									<textarea name="aboutFamily" class="txtarea" onKeyPress="return isMaxLen(this,1000,'About my family')" onBlur="formElementLimiter(this,1000);" ><?=$user[aboutFamily]?></textarea>
								</td>
							</tr>
							<tr class="tblContent">
								<td colspan="2" align="left"><b>Contact Details:</b></td>														
							</tr>	
							<tr class="tblContent">
								<td>Street Address <font color="#FF0000">*</font></td><td><input type="text" name="streetAddress" class="txtbox" value="<?=$user[streetAddress]?>"></td>
							</tr>
							<tr class="tblContent">
								<td>Area <font color="#FF0000">*</font></td><td><input type="text" name="area" class="txtbox" value="<?=$user[area]?>"></td>
							</tr>
							<tr class="tblContent">
								<td>Country <font color="#FF0000">*</font></td>
								<td>
									<table>
										<tr>
											<td>
											<select class="cmbbox" name="country" onchange="selState()">
												<option value="">Select</option>										
												<?	GetCountry(); ?>
												<option value="Others">Others</option>											
											</select>								
											<? if ($user[country]) { ?>
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
										<input type="text" name="country_1" class="txtbox" <? if (!$user[country] && $user[country_1]) { ?>value="<?=$user[country_1]?>" <? } else { ?>value="<?=GetVar("country_1")?>"<? } ?> />
										</div>
										</td>
									  </tr>
									</table>	
								</td>
							</tr>
							<tr class="tblContent">
								<td>State <font color="#FF0000">*</font></td>
								<td>
									<table>
										<tr>
											<td>
								<!--<input type="text" name="state" class="regbox" value="<?=$user[state]?>">-->
									<select name="state" class="cmbbox" onchange="selCity()">
										<option value="">-Select state-</option>
										<option value="Others">Others</option>										
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
										<input type="text"  class="txtbox" name="state_1"  <? if (!$user[state] && $user[state_1]) { ?>value="<?=$user[state_1]?>" <? } else { ?>value="<?=GetVar("state_1")?>"<? } ?> />
										</div>
										</td>
									  </tr>
									</table>
								</td>
							</tr>
							<tr class="tblContent">
								<td>City <font color="#FF0000">*</font></td>
								<td>
									<table>
										<tr>
											<td>
											<select name="city" class="cmbbox" onchange="selCityOthers()">
												<option value="">-Select city-</option>
												<option value="Others">Others</option>										
											</select>																					
											</td>
									 	</tr>
										<tr>
											<td>
											<div id="div_city_1" style="display:none">
											<input type="text" name="city_1" class="txtbox" value="<?=$user[city_1]?>" />
											</div>
											<select name="state_vs_city" style="display:none">
												<? GetCity();	?>
											</select>
											<select name="state_vs_city1" style="display:none">
												<? GetStateVsCity();	?>
											</select>	
											
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
											<? } else if (GetVar("city")) { ?>
												<script language="javascript">
													document.thisForm.city.value = "<?=GetVar("city")?>";																					
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
											</td>
										  </tr> 
									</table>
								</td>
							</tr>	
							<tr class="tblContent">
								<td>Pin code <font color="#FF0000">*</font></td><td><input type="text" name="pincode" class="txtbox" value="<?=$user[pincode]?>"></td>
							</tr>
							<tr class="tblContent">
								<td>Phone Number </td>
								<td>
									<table><tr><td><font size="-2">Country code</font></td><td><font size="-2">Area code</font></td><td><font size="-2">Phone Number</font></td></tr>
									<tr>
									<? 
									if ($user[phoneNumber]) {
										$phone = explode("-",$user[phoneNumber]);									
									}	
									?>
									<td align="center"><input type="text" name="countryCode" class="txtboxage" <? if ($phone[0]) { ?> value="<?=$phone[0]?>" <? } else {?> value="91" <? } ?> maxlength="2" /></td>
									<td align="center"><input type="text" name="areaCode" class="txtboxage" value="<?=$phone[1]?>" /></td>
									<td align="center"><input type="text" name="phoneNumber" class="txtbox" value="<?=$phone[2]?>" /></td>
									</tr>
									</table>
								</td>						 
							</tr>
							<tr bgcolor="tblContent">							
								<td colspan="2" align="center">(Either phone number or mobile number are mandatory)</td>
							</tr>
							<tr class="tblContent">
								<td>Mobile</td>
								<td><input type="text" name="mobileNumber" class="txtMobilebox" value="<?=$user[mobileNumber]?>"></td>
							</tr>							
							<tr class="tblContent">
								<td>Fax</td><td><input type="text" name="fax" class="txtbox" value="<?=$user[fax]?>"></td>						 
							</tr>	
							<tr class="tblContent">
								<td>Precently Residing in <font color="#FF0000">*</font></td><td>
									<table>
									<tr><td><b>Country</b></td>
										<td>
											<table>
												<tr>
													<td>										
													<select class="cmbbox" name="residingCountry" onchange="selState1()">
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
													<div id="div_residingCountry_1" style="display:none">
													<input type="text" name="residingCountry_1" class="txtbox" value="<?=$user[residingCountry_1]?>" />
													</div>
													</td>
												</tr>
											</table>
										</td>
									</tr>	
									<tr><td><b>State</b></td>
										<td>
											<table>
												<tr>
													<td>											
												<select name="residingState" class="cmbbox" onchange="selCity1()">
													<option value="">-Select state-</option>
													<option value="Others">Others</option>										
												</select>																				
													</td>
												  </tr>
												 <tr>
													<td>
													<div id="div_residingState_1" style="display:none">
													<input type="text" name="residingState_1" class="txtbox" <? if ($user[residingState_1]) { ?>value="<?=$user[residingState_1]?>" <? } else { ?>value="<?=GetVar("residingState_1")?>"<? } ?> />
													</div>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr><td><b>City</b></td>
										<td>
											<table>
												<tr>
													<td>
													<select name="residingCity" class="cmbbox" onchange="selCityOthers1()">
														<option value="">-Select city-</option>
														<option value="Others">Others</option>										
													</select>																							
													</td>
												</tr>												
												<tr>
												<td>
													<div id="div_residingCity_1" style="display:none">	
													<input type="text" name="residingCity_1" class="txtbox" value="<?=$user[residingCity_1]?>" />
													</div>	
																			
														<script language="javascript" type="text/javascript">
															selState1();													
														</script>													
													<? if ($user[residingState]) { ?>
														<script language="javascript">
															document.thisForm.residingState.value = "<?=$user[state];?>";
															selCity1();
														</script>	
													<? } else { ?>
														<script language="javascript">
															//document.thisForm.residingState.value = "<?=GetVar("residingState")?>";
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
							<tr class="tblContent">
								<td>Nationality <font color="#FF0000">*</font></td>
								<td>
									<select class="cmbbox" name="nationality" onchange="selNationalityOthers()">
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
							<tr class="tblContent">					  
								<td>&nbsp;</td>
								<td id="div_nationality" style="display:none">								
									<input type="text" name="nationality_1" class="txtbox" value="<?=$user[nationality_1]?>" /> 
								</td>								
							   <? if ($user[nationality_1]) { ?>										
									<script language="javascript">
										document.thisForm.nationality.value = "Others";
										document.getElementById("div_nationality").style.display = "block";
									</script>
								<? } ?>
							</tr>
							<!--<tr class="tblContent">			
								<td>Franchisees</td>
								<td>
									<select name="franchisees_autoid" class="cmbbox">
									<option value="">--Select--</option>
								<?
									$rsFranchisees = Execute("Select * from tbl_franchisee order by auto_id");
									if (mysql_num_rows($rsFranchisees) > 0) {
										while ($franchisees = mysql_fetch_array($rsFranchisees)) { ?>									
											<option value="<?=$franchisees[auto_id]?>"><?=$franchisees[franchisee_name]?></option>
									<?		
										}
									}	?>
									</select>
									<? if ($user[franchisees_autoid]) {?>
									<script language="javascript">
										document.thisForm.franchisees_autoid.value="<?=$user[franchisees_autoid]?>";
									</script>
									<? } else { ?>	
									<script language="javascript">
										document.thisForm.franchisees_autoid.value="";
									</script>	
									<? } ?>	
								</td>
							</tr>-->																											 												