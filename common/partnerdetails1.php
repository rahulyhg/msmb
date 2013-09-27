<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
  <tr>
	<td width="161" align="left" style="padding:5px 5px 9px 30px;" height="16"><h3 class="topic">Expectation / Looking for</h3></td><td width="254">&nbsp;</td>
	<td width="314">&nbsp;</td>
  </tr>
  <tr>
	<td align="center" colspan="2">
		<table width="22%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="tbdrlft correct-border-right" bgcolor="#f3fae6" align="center">
					<table width="90%" border="0" cellspacing="0" cellpadding="7">
<!-- This is used to get the partner religion and caste if not it will be assigned to zero-->					
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
					  <tr>
						<td class="intxt" width="124" align="left" valign="top">Domain(s)</td>
						<td width="25" class="intxt" valign="top"><b>:</b></td>
						<td class="intxt" width="305" align="left">
						<select name="partnerDomain[]" class="regarea" multiple="multiple" onchange="FillReligionsCaste('<?=$reg?>','<?=$cast?>')" tyle="display:none">									
							<option value="0" selected>Any</option>
<!-- This is used to retrive the Domain from the table and load in the list box-->
							<?	$resDomain = Execute("select * from tbl_domain_master order by id");
								if (mysql_num_rows($resDomain) > 0) {
									while ($domain = mysql_fetch_array($resDomain)) {									
								?>
								<option value="<?=$domain[id]?>"><?=$domain[domain]?></option>
							<?  	}
								} ?>
						</select>
						<br />
						(Use control + mouse button or shift + arrow keys to selecte more options)
<!-- This is used to select the domain name which the user given-->
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
					  <tr>
						<td class="intxt"align="left">Age</td>
						<td class="intxt"><b>:</b></td>
						<td class="intxt" align="left"><font color="#de1e18">From</font> &nbsp; &nbsp;
							<select name="ageFrom" class="mprcmbbox" style="width: 45px;">
								<option value="18" selected>18</option>
<!-- used to load the age in the list box-->
								<? for ($i = 19; $i <= 70; $i++) { ?>											
										<option value="<?=$i?>"><?=$i?></option>
								<? } ?>
							</select>&nbsp; &nbsp; <font color="#de1e18">To</font> &nbsp; &nbsp;
							<select name="ageTo" class="mprcmbbox" style="width: 45px;">
<!-- used to load the age in the list box-->
								<? for ($i = 18; $i <= 70; $i++) { ?>											
										<option value="<?=$i?>" <? if($i == 24) { ?> selected <? } ?>><?=$i?></option>
								<? } ?>
							</select>								
							<? if ($user["ageFrom"]) { ?>
<!--This is used to select the age which the user given -->
							<script language="javascript">
								document.thisForm.ageFrom.value = "<?=$user["ageFrom"]?>";									
							</script>
							<? } ?>
							<? if ($user["ageTo"]) { ?>
<!--This is used to select the age which the user given -->
							<script language="javascript">
								document.thisForm.ageTo.value = "<?=$user["ageTo"]?>";									
							</script>
							<? } ?>
						</td>
					</tr>										  
					<tr>
						<td class="intxt" align="left" valign="top">Marital Status </td>
						<td class="intxt" valign="top"><b>:</b></td>
						<td class="intxt" align="left">
							<select name="partnerMaritalStatus[]" class="regarea" multiple>								
								<option value="unspec">Any</option>
								<option value="Unmarried">Unmarried</option>									
								<option value="Window/Windower">Window/Windower</option>
								<option value="Divorced">Divorced</option>
								<option value="Separated">Separated</option>
							</select>
							<br />
						(Use control + mouse button or shift + arrow keys to selecte more options)
							<? if ($user["partnerMaritalStatus"]) { ?>
<!-- It is used to select the marital status what user gave-->
								<script language="javascript">
									SelMaritalStatus('<?=$user["partnerMaritalStatus"]?>');
								</script>									
							<? } else { ?>
								<script language="javascript">
									SelMaritalStatus('Unmarried');
								</script>
							<? } ?>
						</td>
					</tr>
					<tr>
						<td class="intxt" align="left" valign="top">Have children</td>
						<td class="intxt" valign="top"><b>:</b></td>
						<td class="intxt" align="left">
						<select name="partnerHaveChild" class="mprcmbbox">									
							<option value="no">No</option>	
							<option value="yes">Yes</option>
							<option value="unspec">Doesn't matter</option>									
							
						</select>
<!-- It is used to select the Have child what user gave-->
	
						<? if ($user["partnerHaveChild"]) { ?>
						<script language="javascript">
							document.thisForm.partnerHaveChild.value = "<?=$user["partnerHaveChild"]?>";									
						</script>
						<? } else { ?>					
						<script language="javascript">
							document.thisForm.partnerHaveChild.value = "no";									
						</script>	
						<? } ?>
						</td>
					</tr>
					  
					<tr>
						<td class="intxt" align="left" valign="top">Height</td>
						<td class="intxt" valign="top"><b>:</b></td>
						<td class="intxt" align="left"><font color="#de1e18">From</font>&nbsp;&nbsp;&nbsp;
								<select name="partnerHeightFrom" class="mprcmbbox" style="width: 152px;">
<!-- The fuction used to load the height-->
									<script language="javascript">
										GetHeight();
									</script>
								</select>
<!-- This is used to select the age what the used gave-->
								<? if ($user["partnerHeightFrom"]) {?>
									<script language="javascript">
										document.thisForm.partnerHeightFrom.value = "<?=$user["partnerHeightFrom"]?>";
									</script>
								<? } else { ?>
									<script language="javascript">
										document.thisForm.partnerHeightFrom.value = "5";
									</script>
								<? } ?>
								&nbsp; &nbsp; &nbsp; <font color="#de1e18">To</font> &nbsp; &nbsp; &nbsp;
								<select name="partnerHeightTo" class="mprcmbbox" style="width: 152px;">
<!-- The fuction used to load the height-->
									<script language="javascript">
										GetHeight();
									</script>
								</select>
<!-- This is used to select the age what the used gave-->								
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
					<tr>
						<td class="intxt" align="left" valign="top">Physical status</td>
						<td class="intxt" valign="top"><b>:</b></td>
						<td class="intxt" align="left">
						<select name="partnerPhysicalStatus" class="mprcmbbox">									
							<option value="Normal" selected>Normal</option>
							<option value="Disabled">Disabled</option>									
							<option value="unspec">Doesn't matter</option>																		
						</select>
<!-- This is used to select the physical status what the used gave-->								
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
					<tr>
						<td class="intxt" align="left" valign="top">Mother tongue</td>
						<td class="intxt" valign="top"><b>:</b></td>
						<td class="intxt" align="left">
						<select name="partnerMotherTongue" class="mprcmbbox">
<!-- The fuction used to load the Language-->
							<script language="javascript">
								Language();
							</script>
						</select>
<!-- This is used to select the mothertongue what the used gave-->							

						<? if($config[userinfo][partnerMotherTongue]) {?>
							<script language="javascript">
								document.thisForm.partnerMotherTongue.value = "<?=$config[userinfo][partnerMotherTongue]?>";											
							</script>
						<? } else { ?>
							<script language="javascript">
								//document.thisForm.partnerMotherTongue.value = "Tamil";											
							</script>
						<? } ?>		
						</td>
					</tr>
					<tr d="tr2" tyle="display:none">						
						<td class="intxt" width="124" align="left">Expectation about Life Partner</td>
						<td class="intxt" width="25"><b>:</b></td>
						<td class="intxt" idth="105" align="left">
							<textarea name="aboutLifePartner" class="regarea"><?=$user["aboutLifePartner"];?></textarea>
							<br />
							<font size="-2">(Use this space to talk about your partner preferences. Tell your prospective partner, what you would want see in him/her. Tell him/her you, your wants, your aspirations, your dreams and so on. )</font>
						</td>														
					 </tr>
					 <tr>
						<td colspan="3"><b style="color:#CC0000;">Religious Preference</b></td>
					  </tr>						 					 	
					 <tr>
						<td class="intxt" width="124" align="left" valign="top">Religion</td>
						<td class="intxt" width="25" valign="top"><b>:</b></td>
						<td class="intxt" width="105" align="left">
						<select name="partnerReligion[]" class="regarea" onChange="FillCaste1();" multiple>
							<option value="0" selected>Any</option>																										
						</select>
						<br />
						(Use control + mouse button or shift + arrow keys to selecte more options)
						</td>
					  </tr> 	
					  <tr>
						<td class="intxt" width="124" align="left" valign="top">Caste / Division</td>
						<td class="intxt" width="25" valign="top"><b>:</b></td>
						<td class="intxt" width="105" align="left">
							<select name="partnerCaste[]" class="regarea" multiple>									
								<option value="0" selected>Any</option>									
							</select>
							<br/>
						(Use control + mouse button or shift + arrow keys to selecte more options)
<!-- This function is used to load the religion-->
							<script language="javascript">											
								FillReligionsCaste('<?=$reg?>','<?=$cast?>');
								//FillCaste1('<?=$cast?>');										
							</script>
						</td>
					</tr>
					<tr>
						<? $sevvai = $user[partnerSevvaiDosham]; ?>
						<td class="intxt" align="left">Sevvai Dosham / manglik</td>
						<td class="intxt"><b>:</b></td>
						<td class="intxt" align="left">
						<input type="radio" name="partnerSevvaiDosham" value="3" class="radio" <? if ($sevvai == 3) {?> checked <? } ?> checked>&nbsp;&nbsp;Doesn't matter&nbsp;&nbsp;<input type="radio" name="partnerSevvaiDosham" value="1" class="radio" <? if ($sevvai == 1) {?> checked <? } ?>>&nbsp;&nbsp;Yes&nbsp;&nbsp;<input type="radio" name="partnerSevvaiDosham" value="2" class="radio" <? if ($sevvai == 2) {?> checked <? } ?>>&nbsp;&nbsp;No											
						</td>
					</tr>
					<tr>						
						<td class="intxt" align="left" valign="top">Eating habits</td>
						<td class="intxt" valign="top"><b>:</b></td>
						<td class="intxt" align="left">
						<select name="partnerEatingHabits" class="mprcmbbox">
							<option value="Doesn't matter" selected>Doesn't matter</option>
							<option value="Vegetarian">Vegetarian </option>
							<option value="Non Vegetarian">Non Vegetarian</option>																		 
						</select>
<!-- This is used to select the partner eating habits-->
						<? if ($user["partnerEatingHabits"]) {?>
							<script language="javascript">
								document.thisForm.partnerEatingHabits.value = "<?=$user["partnerEatingHabits"]?>";
							</script>
						<? } ?>										
						</td>
					</tr>
					<tr>
						<td colspan="3"><b style="color:#CC0000;">Educational & Location Preference</b></td>
					</tr>						
					<tr>						
						<td class="intxt" align="left" valign="top">Education</td>
						<td class="intxt" valign="top"><b>:</b></td>
						<td class="intxt" align="left">
						<select name="partnerEducation[]" class="regarea" multiple="multiple">
							<option value="0">Any</option>
<!-- Used to load the education-->
							<?
								$res = Execute("select * from tbl_education_master");
								if (mysql_num_rows($res) > 0) {
									while ($education = mysql_fetch_array($res)) { ?>
										<option value="<?=$education[id]?>"><?=$education[education]?></option>	
								<?	}
								}
							?>
						</select>
						<br />
						(Use control + mouse button or shift + arrow keys to selecte more options)
<!-- Used to select the partner education-->
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
					<tr>						
						<td class="intxt" align="left" valign="top">Citizenship</td>
						<td class="intxt" valign="top"><b>:</b></td>
						<td class="intxt" align="left">
						<select class="regarea" name="partnerCitizenship[]" multiple="multiple">
<!-- Used to load the partner citizenship-->
							<script language="javascript">
								GetCountry('','unspec');											
							</script>
						</select>
						<br />
						(Use control + mouse button or shift + arrow keys to selecte more options)
<!-- used to select the partner citizenship what he given-->
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
					<tr>						
						<td class="intxt" align="left" valign="top">Country of Residence</td>
						<td class="intxt" valign="top"><b>:</b></td>
						<td class="intxt" align="left">						
						<select class="regarea" name="partnerCountryLiving[]" multiple="multiple" onchange="selPartnerInidanState1()">
<!-- Used to load the countries in to the listbox-->
							<option value="0" selected>Any</option>
							<? GetCountry(); ?>
						</select>
						<select name="india_vs_state" style="visibility:hidden">
							<option value="0" selected>Any</option>
<!-- Used to load the states in india-->
							<? GetStateInIndia(); ?>
						</select>
														
						<? if ($user["partnerCountryLiving"]) { ?>
<!-- used to select the country what user gave-->
							<script language="javascript">
								SelLivingIn('<?=$user["partnerCountryLiving"]?>');
							</script>									
						<? } else { ?>
							<script language="javascript">
								SelLivingIn('0');
							</script>
						<? } ?>
						<br />
						(Use control + mouse button or shift + arrow keys to selecte more options)
						</td>
					</tr>
					<tr>						
						<td class="intxt" align="left" valign="top">Residing State</td>
						<td class="intxt" valign="top"><b>:</b></td>
						<td class="intxt" align="left">
						<!-- <b>Residing in India</b><br /> -->
<!-- On change on the state the city is been loaded-->
						<select class="regarea" name="partnerResidingState[]" multiple="multiple" onchange="selectPartnerCity('<?=$user[partnerResidingCity]?>')">
						<script language="javascript">
								//getIndianState();											
							</script>
						</select>
						<br />
						(Use control + mouse button or shift + arrow keys to selecte more options)
						</td>
					</tr>
					<tr>						
						<td class="intxt" align="left" valign="top">Residing City</td>
						<td class="intxt" valign="top"><b>:</b></td>
						<td class="intxt" align="left">
						<!-- <b>Residing in India</b><br /> -->
						<select class="regarea" name="partnerResidingCity[]" multiple="multiple" >									
						
						</select>
<!-- used to load states-->
						<? if ($user[partnerResidingState]) { ?>
							<script language="javascript">
								selPartnerInidanState1();
								selPartnerState('<?=$user[partnerResidingState]?>');
							</script>									
						<? } ?>
<!-- used to load cities-->
						<? if ($user[partnerResidingCity]) { ?>
						<script language="javascript">
							selectPartnerCity('<?=$user[partnerResidingCity]?>');									
						</script>								
						<? } else { ?>
						<script language="javascript">
							selectPartnerCity('0');
						</script>	
						<? } ?>
						<br />
						(Use control + mouse button or shift + arrow keys to selecte more options)
						</td>
					</tr>
					<tr>
	<td align="left" style="padding-left:154px;" class="intxt" colspan="3">
		<input type="submit" value="Update" class="button" />
	</td>
  </tr><td class="intxt" colspan="3" height="10"></td>
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