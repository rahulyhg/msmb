						 <tr class="tblContent">	
						 	<td align="left" colspan="2"><b>Partner Preference:</b></td></td>
						 </tr>	
						  <? 
						 	if ($user[partnerReligion]) {
								$reg = $user[partnerReligion];
							} else {
								$reg = 0;
							}
							if ($user[partnerCaste]) {
								$cast = $user[partnerCaste];
							} else {
								$cast = 0;
							}
						 ?>
						 <tr bgcolor="#FFFFFF">
						 	<td>Domain(s)</td>
							<td>
								<select name="partnerDomain[]" class="txtcbomultiple" multiple="multiple" onchange="FillReligionsCaste('<?=$reg?>','<?=$cast?>')" tyle="display:none">									
									<option value="0" selected>Any</option>
									<?	$resDomain = Execute("select * from tbl_domain_master order by id");
										if (mysql_num_rows($resDomain) > 0) {
											while ($domain = mysql_fetch_array($resDomain)) {									
										?>
										<option value="<?=$domain[id]?>"><?=$domain[domain]?></option>
									<?  	}
										} ?>
								</select>
								<br />
								(Use control + arrow key to selecte more options)
								<? if ($user["partnerDomain"]) { ?>
									<script language="javascript">
										SelDomain('<?=$user[partnerDomain]?>');
										//SelDomain('<?=$config["new_domain"]?>');
									</script>									
								<? } else { ?>
									<script language="javascript">
										SelDomain('0');
										//SelDomain('<?=$config["new_domain"]?>');
									</script>
								<? } ?>
							</td>
						 </tr>				 				 
						 <tr bgcolor="#FFFFFF">
						 	<td>Age</td>
							<td>From
								<select name="ageFrom">
									<option value="18" selected>18</option>
									<? for ($i = 19; $i <= 70; $i++) { ?>											
											<option value="<?=$i?>"><?=$i?></option>
									<? } ?>
								</select>&nbsp;&nbsp;To
								<select name="ageTo">									
									<? for ($i = 18; $i <= 70; $i++) { ?>											
											<option value="<?=$i?>" <? if($i == 24) { ?> selected <? } ?>><?=$i?></option>
									<? } ?>
								</select>								
								<? if ($user["ageFrom"]) { ?>
								<script language="javascript">
									document.thisForm.ageFrom.value = "<?=$user["ageFrom"]?>";									
								</script>
								<? } ?>
								<? if ($user["ageTo"]) { ?>
								<script language="javascript">
									document.thisForm.ageTo.value = "<?=$user["ageTo"]?>";									
								</script>
								<? } ?>
							</td>							
						 </tr>
						 <tr bgcolor="#FFFFFF">
						 	<td>Marital Status</td>
							<td>
								<select name="partnerMaritalStatus[]" class="txtcbomultiple" multiple>								
									<option value="unspec">Any</option>
									<option value="Unmarried">Unmarried</option>									
									<option value="Window/Windower">Window/Windower</option>
									<option value="Divorced">Divorced</option>
									<option value="Separated">Separated</option>
								</select>
								
								<? if ($user["partnerMaritalStatus"]) { ?>
									<script language="javascript">
										SelMaritalStatus('<?=$user["partnerMaritalStatus"]?>');
									</script>									
								<? } else { ?>
									<script language="javascript">
										SelMaritalStatus('unspec');
									</script>
								<? } ?>
							</td>
						 </tr>
						 <tr bgcolor="#FFFFFF">
						 	<td>Have children</td>
							<td>
								<select name="partnerHaveChild" class="cmbbox">									
									<option value="no">No</option>	
									<option value="yes">Yes</option>
									<option value="unspec">Doesn't matter</option>									
									
								</select>	
								<? if ($user["partnerHaveChild"]) { ?>
								<script language="javascript">
									document.thisForm.partnerHaveChild.value = "<?=$user["partnerHaveChild"]?>";									
								</script>
								<? } else { ?>					
								<script language="javascript">
									document.thisForm.partnerHaveChild.value = "unspec";									
								</script>	
								<? } ?>
							</td>
						</tr>	
						<tr bgcolor="#FFFFFF">
						 	<td>Height</td>
							<td>From
								<select name="partnerHeightFrom" class="cmbheightbox">
									<script language="javascript">
										GetHeight();
									</script>
								</select>
								<? if ($user["partnerHeightFrom"]) {?>
									<script language="javascript">
										document.thisForm.partnerHeightFrom.value = "<?=$user["partnerHeightFrom"]?>";
									</script>
								<? } else { ?>
									<script language="javascript">
										document.thisForm.partnerHeightFrom.value = "5";
									</script>
								<? } ?>
								&nbsp;&nbsp;&nbsp;To 
								<select name="partnerHeightTo" class="cmbheightbox">
									<script language="javascript">
										GetHeight();
									</script>
								</select>
								<? if ($user["partnerHeightTo"]) { ?>
									<script language="javascript">
										document.thisForm.partnerHeightTo.value = "<?=$user["partnerHeightTo"]?>";
									</script>
								<? } else { ?>
									<script language="javascript">
										document.thisForm.partnerHeightTo.value = "6";
									</script>
								<? } ?>
							</td>
						 </tr>		 
						<tr bgcolor="#FFFFFF">
						 	<td>Physical status</td>
							<td>
								<select name="partnerPhysicalStatus" class="cmbbox">									
									<option value="Normal" selected>Normal</option>
									<option value="Disabled" selected>Disabled</option>									
									<option value="unspec" selected>Doesn't matter</option>																		
								</select>
								<? if($user[partnerPhysicalStatus]) {?>
									<script language="javascript">
										document.thisForm.partnerPhysicalStatus.value = "<?=$user[partnerPhysicalStatus]?>";											
									</script>
								<? } else { ?>
									<script language="javascript">
										document.thisForm.partnerPhysicalStatus.value = "Normal";											
									</script>
								<? } ?>
							</td>
						</tr>
						<tr bgcolor="#FFFFFF">
							<td>Mother tongue </td>
							<td>
								<select name="partnerMotherTongue" class="cmbbox">
									<script language="javascript">
										Language();
									</script>
								</select>
								<? if($user[partnerMotherTongue]) {?>
									<script language="javascript">
										document.thisForm.partnerMotherTongue.value = "<?=$user[partnerMotherTongue]?>";											
									</script>
								<? } else { ?>
									<script language="javascript">
										document.thisForm.partnerMotherTongue.value = "Tamil";											
									</script>
								<? } ?>
							</td>
						</tr>		
						 <tr bgcolor="#FFFFFF">
						 	<td>Expectation about Life Partner</td>
							<td>
								<textarea name="aboutLifePartner" class="txtcbomultiple"><?=$user["aboutLifePartner"];?></textarea>
								<br />
								(Use this space to talk about your partner preferences. Tell your prospective partner, what you would want see in him/her. Tell him/her you, your wants, your aspirations, your dreams and so on. )
							</td>
						 </tr>
						
						 <tr class="tblContent">
						 	<td align="left" colspan="2"><b class="clr">Religious Preference:</b></td></td>
						 </tr>			
						  <tr bgcolor="#FFFFFF">
								<td>Religion</td>
								<td>
									<select name="partnerReligion[]" class="txtcbomultiple" onChange="FillCaste1();" multiple>
										<option value="0" selected>Any</option>																										
									</select>																		
								</td>
							<tr>						
							<tr bgcolor="#FFFFFF">
								<td>Caste / Division </td>
								<td>									
									<select name="partnerCaste[]" class="txtcbomultiple" multiple>									
										<option value="0" selected>Any</option>									
									</select>								
									<script language="javascript">											
										FillReligionsCaste('<?=$reg?>','<?=$cast?>');
										//FillCaste1('<?=$cast?>');										
									</script>																				
								</td>
							</tr>
							<tr bgcolor="#FFFFFF">
								<? $sevvai = $user[partnerSevvaiDosham]; ?>
								<td>Sevvai Dosham / manglik</td>
								<td><input type="radio" name="partnerSevvaiDosham" value="3" class="radio" <? if ($sevvai == 3) {?> checked <? } ?> checked>&nbsp;&nbsp;Doesn't matter&nbsp;&nbsp;<input type="radio" name="partnerSevvaiDosham" value="1" class="radio" <? if ($sevvai == 1) {?> checked <? } ?>>&nbsp;&nbsp;Yes&nbsp;&nbsp;<input type="radio" name="partnerSevvaiDosham" value="2" class="radio" <? if ($sevvai == 2) {?> checked <? } ?>>&nbsp;&nbsp;No</td>
							</tr>
							<tr bgcolor="#FFFFFF">
						 	<td>Eating habits</td>
							<td>
								<select name="partnerEatingHabits" class="cmbbox">
									<option value="Doesn't matter" selected>Doesn't matter</option>
									<option value="Vegetarian">Vegetarian </option>
									<option value="Non Vegetarian">Non Vegetarian</option>																		 
								</select>
								<? if ($user["partnerEatingHabits"]) {?>
									<script language="javascript">
										document.thisForm.partnerEatingHabits.value = "<?=$user["partnerEatingHabits"]?>";
									</script>
								<? } ?>
							</td>
						</tr>					
						<tr class="tblContent">
						 	<td align="left" colspan="2"><b class="clr">Educational & Location Preference:</b></td></td>
						 </tr>
						 <tr bgcolor="#FFFFFF">
							<td width="200">Education </td>
							<td width="450">
								<select name="partnerEducation[]" class="txtcbomultiple" multiple="multiple">
									<option value="0">Any</option>
									<?
										$res = Execute("select * from tbl_education_master");
										if (mysql_num_rows($res) > 0) {
											while ($education = mysql_fetch_array($res)) { ?>
												<option value="<?=$education[id]?>"><?=$education[education]?></option>	
										<?	}
										}
									?>
								</select>									
								<? if ($user["partnerEducation"]) { ?>
									<script language="javascript">
										SelEducation('<?=$user["partnerEducation"]?>');
									</script>									
								<? } else { ?>
									<script language="javascript">
										SelEducation('0');
									</script>
								<? } ?>
							</td>							
						 </tr>							 					 							
						 <tr bgcolor="#FFFFFF">
							<td>Citizenship </td>
							<td>
								<select class="txtcbomultiple" name="partnerCitizenship[]" multiple="multiple">
									<script language="javascript">
										GetCountry('','unspec');											
									</script>
								</select>								
								<? if ($user["partnerCitizenship"]) { ?>
									<script language="javascript">
										SelCitizenship('<?=$user["partnerCitizenship"]?>');
									</script>									
								<? } else { ?>
									<script language="javascript">
										SelCitizenship('unspec');
									</script>
								<? } ?>	
							</td>
						</tr>						
                        <tr bgcolor="#FFFFFF">
							<td>Country of Residence</td>
							<td>								
								<select class="txtcbomultiple" name="partnerCountryLiving[]" multiple="multiple" onchange="selPartnerInidanState1()">
									<option value="0" selected>Any</option>
									<? GetCountry(); ?>
								</select>								
								<select name="india_vs_state" style="visibility:hidden">
									<? GetStateInIndia(); ?>
								</select>
								<? if ($user["partnerCountryLiving"]) { ?>
									<script language="javascript">
										SelLivingIn('<?=$user["partnerCountryLiving"]?>');
									</script>									
								<? } else { ?>
									<script language="javascript">
										SelLivingIn('0');
									</script>
								<? } ?>
								
							</td>
						</tr>
                        <tr bgcolor="#FFFFFF">
							<td>Residing State</td>
							<td><b>Residing in India</b><br />
								<select class="txtcbomultiple" name="partnerResidingState[]" multiple="multiple" onchange="selectPartnerCity('<?=$user[partnerResidingCity]?>')">									
									<script language="javascript">
										//getIndianState();											
									</script>
								</select>										
							</td>
						</tr>	
						<tr bgcolor="#FFFFFF">
							<td>Residing City</td>
							<td><b>Residing in India</b><br />
								<select class="txtcbomultiple" name="partnerResidingCity[]" multiple="multiple">									
								</select>
								<? if ($user[partnerResidingState]) { ?>
									<script language="javascript">
										selPartnerInidanState1();
										selPartnerState('<?=$user[partnerResidingState]?>');
									</script>									
								<? } ?>	
								<? if ($user[partnerResidingCity]) { ?>
								<script language="javascript">
									selectPartnerCity('<?=$user[partnerResidingCity]?>');									
								</script>
								<? } else { ?>
								<script language="javascript">
									selectPartnerCity('0');
								</script>	
								<? } ?>
							</td>
						</tr>
														                       						 										