						 <tr class="tblContent">
						 	<td colspan="2" align="left"><b>Physical details</b></td>
						 </tr>						 						 						 
						 <tr bgcolor="#FFFFFF">
						 	<td>Height <font color="#FF0000">*</font></td>
							<td>
								<select name="height" class="cmbbox">
									<script language="javascript">
										GetHeight();
									</script>
								</select>
								<? if ($user["height"]) {?>
									<script language="javascript">
										document.thisForm.height.value = "<?=$user["height"]?>";
									</script>
								<? } ?>
							</td>
						</tr>
						<tr bgcolor="#FFFFFF">
						 	<td>Body type <font color="#FF0000">*</font></td>
							<td>
								<select name="bodyType" class="cmbbox">
									<option value="">--Select--</option>
									<option value="Average">Average</option>
									<option value="Athletic">Athletic</option>
									<option value="Slim">Slim</option>
									<option value="Heavy">Heavy</option>
								</select>
								<? if ($user["bodyType"]) {?>
									<script language="javascript">
										document.thisForm.bodyType.value = "<?=$user["bodyType"]?>";
									</script>
								<? } ?>
							</td>
						</tr>
						<tr bgcolor="#FFFFFF">
						 	<td>Complexion <font color="#FF0000">*</font></td>
							<td>
								<select name="complexion" class="cmbbox">
										<option value="">--Select--</option>
										<option value="Very Fair">Very Fair</option>
										<option value="Fair">Fair</option>
										<option value="Wheatish">Wheatish</option>
										<option value="Wheatish Brown">Wheatish Brown</option>
										<option value="Dark">Dark</option>
									</select>
									<? if ($user["complexion"]) {?>
										<script language="javascript">
											document.thisForm.complexion.value = "<?=$user["complexion"]?>";
										</script>
									<? } ?>
							</td>
						</tr>	
						<tr bgcolor="#FFFFFF">
						 	<td>Physical status <font color="#FF0000">*</font></td>
							<td>
								<select name="physicalStatus" class="cmbbox">									
									<option value="Normal" selected>Normal</option>
									<option value="Physically Handicapped">Physically Handicapped</option>
									<option value="Visually Challenged">Visually Challenged</option>
									<option value="Hearing Impaired">Hearing Impaired</option>
								</select>
								<? if ($user["physicalStatus"]) {?>
									<script language="javascript">
										document.thisForm.physicalStatus.value = "<?=$user["physicalStatus"]?>";
									</script>
								<? } ?>
							</td>
						</tr>	
						<tr bgcolor="#FFFFFF">
						 	<td>Eating habits</td>
							<td>
								<select name="eatingHabits" class="cmbbox">
									<option value="">--Select--</option>
									<option value="Vegetarian">Vegetarian </option>
									<option value="Non Vegetarian">Non Vegetarian</option>
									<option value="Eggetarian">Eggetarian</option>									 
								</select>
								<? if ($user["eatingHabits"]) {?>
									<script language="javascript">
										document.thisForm.eatingHabits.value = "<?=$user["eatingHabits"]?>";
									</script>
								<? } ?>
							</td>
						 </tr>
						<tr bgcolor="#FFFFFF">
						 	<td>Smoke <font color="#FF0000">*</font></td>
							<td>
								<select name="smoking" class="cmbbox">
									<option value="">--Select--</option>
									<option value="Non-smoker">Non-smoker</option>
									<option value="Light / Social smoker">Light / Social smoker</option>
									<option value="Regular smoker">Regular smoker</option>
								</select>
								<? if ($user["smoking"]) {?>
									<script language="javascript">
										document.thisForm.smoking.value = "<?=$user["smoking"]?>";
									</script>
								<? } ?>
							</td>
						</tr>
						<tr bgcolor="#FFFFFF">
						 	<td>Drink <font color="#FF0000">*</font></td>
							<td>
								<select name="drink" class="cmbbox">
									<option value="">--Select--</option>
									<option value="Non-drinker">Non-drinker</option>
									<option value="Light / Social drinker">Light / Social drinker</option>
									<option value="Regular drinker">Regular drinker</option>
								</select>
								<? if ($user["drink"]) {?>
									<script language="javascript">
										document.thisForm.drink.value = "<?=$user["drink"]?>";
									</script>
								<? } ?>
							</td>
						</tr>	
						<tr bgcolor="#FFFFFF">
						 	<td>Blood Group</td>
							<td>
								<select name="bloodGroup" class="cmbbox">
									<script language="javascript">
										GetBloodGroup();
									</script>
								</select>
								<? if ($user["bloodGroup"]) {?>
									<script language="javascript">
										document.thisForm.bloodGroup.value = "<?=$user["bloodGroup"]?>";
									</script>
								<? } ?>
							</td>
						</tr>
						<tr class="tblContent">
						 	<td>Language known</td>
							<td>
								<table>
							        <tr><td width='23%'>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Others" onClick="return LangKn();"/>
									Others</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Arabic" onClick="return LangKn();"/>
									Arabic</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Assamese" onClick="return LangKn();"/>
									Assamese</td><td>
							
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Bengali" onClick="return LangKn();"/>
									Bengali</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Creole" onClick="return LangKn();"/>
									Creole</td><tr><td width='20%'>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Dutch" onClick="return LangKn();"/>
									Dutch<td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="English" onClick="return LangKn();"/>
							
									English</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="French" onClick="return LangKn();"/>
									French</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Garwhali" onClick="return LangKn();"/>
									Garwhali</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="German" onClick="return LangKn();"/>
									German</td><tr><td class='content' width='20%'>
							
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Gujarathi" onClick="return LangKn();"/>
									Gujarathi<td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Hindi" onClick="return LangKn();"/>
									Hindi</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Kannada" onClick="return LangKn();"/>
									Kannada</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Kashmiri" onClick="return LangKn();"/>
							
									Kashmiri</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Konkani" onClick="return LangKn();"/>
									Konkani</td><tr><td width='20%'>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Kutchi" onClick="return LangKn();"/>
									Kutchi<td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Malayalam" onClick="return LangKn();"/>
									Malayalam</td><td>
							
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Marathi" onClick="return LangKn();"/>
									Marathi</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Marwadi" onClick="return LangKn();"/>
									Marwadi</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Nepali" onClick="return LangKn();"/>
									Nepali</td><tr><td width='20%'>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Oriya" onClick="return LangKn();"/>
							
									Oriya<td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Punjabi" onClick="return LangKn();"/>
									Punjabi</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Pushtu" onClick="return LangKn();"/>
									Pushtu</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Sindhi" onClick="return LangKn();"/>
									Sindhi</td><td>
							
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Singhalese" onClick="return LangKn();"/>
									Singhalese</td><tr><td width='20%'>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Sowrashtra" onClick="return LangKn();"/>
									Sowrashtra<td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Spanish" onClick="return LangKn();"/>
									Spanish</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Tamil" onClick="return LangKn();"/>
							
									Tamil</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Telugu" onClick="return LangKn();"/>
									Telugu</td><td>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Tulu" onClick="return LangKn();"/>
									Tulu</td><tr><td width='20%'>
									<input type="checkbox" maxlength="5" name="languageKnown1" value="Urdu" onClick="return LangKn();"/>
									Urdu<td>
							
									<input type="checkbox" maxlength="5" name="languageKnown1" value="None" onClick="return LangKn();"/>
									None
									<input type="hidden" name="languageKnown">
									<?
										if ($user["languageKnown"]) { 
											$language1 = explode(",",$user["languageKnown"]);
											for ($i = 0; $i < count($language1); $i++) {
												?>
													<script language="javascript">
														SelLanguage('<?=$language1[$i]?>');
													</script>
												<?
											}
										}
									?>
									</td>
									</tr>
									<tr>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
									</tr>
								</table>														
							</td>
						</tr>	
						<tr class="tblContent">
						 	<td>Your Personality <font color="#FF0000">*</font></td>
							<td>
								<textarea name="personality" class="largeTxtarea" onKeyPress="return isMaxLen(this,1000,'personality')" onBlur="formElementLimiter(this,1000);"><?=$user["personality"]?></textarea><br>
								(min. 50 Characters;max. 1000)
							</td>
						</tr>												 										