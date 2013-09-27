<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
  <tr>
	<td width="161" align="left" style="padding:5px 5px 9px 47px;" height="16"><h3 class="topic">Physical details</h3></td><td width="254">&nbsp;</td>
	<td width="314">&nbsp;</td>
  </tr>
  <tr>
	<td align="center" colspan="2">
		<table width="22%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="tbdrlft" bgcolor="#f3fae6" align="center">
					<table width="90%" border="0" cellspacing="0" cellpadding="5">
					  <tr>
						<td class="intxt" width="124" align="left">Height <font color="#FF0000">*</font></td>
						<td width="25" class="intxt">:</td>
						<td class="intxt" width="105" align="left">
						<select name="height" class="mprcmbbox">
							<script language="javascript">
								GetHeight();
							</script>
						</select>
						<? if ($user["height"]) {?>
							<script language="javascript">
								document.thisForm.height.value = "<?=$user["height"]?>";
							</script>
						<? } ?>					   </td>
					  </tr>
					  <tr>
						<td class="intxt"align="left">Body type <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<select name="bodyType" class="mprcmbbox">
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
								<? } ?>						</td>
					</tr>
					
					<tr>
						<td class="intxt"align="left">Complexion <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<select name="complexion" class="mprcmbbox">
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
					
														  
					<tr>
						<td class="intxt" align="left">Physical status <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<select name="physicalStatus" class="mprcmbbox">									
								<option value="Normal" selected>Normal</option>
								<option value="Physically Handicapped">Physically Handicapped</option>
								<option value="Visually Challenged">Visually Challenged</option>
								<option value="Hearing Impaired">Hearing Impaired</option>
							</select>
							<? if ($user["physicalStatus"]) {?>
								<script language="javascript">
									document.thisForm.physicalStatus.value = "<?=$user["physicalStatus"]?>";
								</script>
							<? } ?>						</td>
					</tr>
					<tr>
						<td class="intxt" align="left">Eating habits</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
						<select name="eatingHabits" class="mprcmbbox">
							<option value="">--Select--</option>
							<option value="Vegetarian">Vegetarian </option>
							<option value="Non Vegetarian">Non Vegetarian</option>
							<option value="Eggetarian">Eggetarian</option>									 
						</select>
						<? if ($user["eatingHabits"]) {?>
							<script language="javascript">
								document.thisForm.eatingHabits.value = "<?=$user["eatingHabits"]?>";
							</script>
						<? } ?>						</td>
					</tr>
					  
					<tr>
						<td class="intxt" align="left">Smoke <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
							<select name="smoking" class="mprcmbbox">
								<option value="Non-smoker">Non-smoker</option>
								<option value="Light / Social smoker">Light / Social smoker</option>
								<option value="Regular smoker">Regular smoker</option>
							</select>
							<? if ($user["smoking"]) {?>
								<script language="javascript">
									document.thisForm.smoking.value = "<?=$user["smoking"]?>";
								</script>
							<? } ?>						</td>
					</tr>
					<tr>
						<td class="intxt" align="left">Drink <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
						<select name="drink" class="mprcmbbox">
							<option value="Non-drinker">Non-drinker</option>
							<option value="Light / Social drinker">Light / Social drinker</option>
							<option value="Regular drinker">Regular drinker</option>
						</select>
						<? if ($user["drink"]) {?>
							<script language="javascript">
								document.thisForm.drink.value = "<?=$user["drink"]?>";
							</script>
						<? } ?>						</td>
					</tr>
					<tr>
						<td class="intxt" align="left">Blood Group</td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
						<select name="bloodGroup" class="mprcmbbox">
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
					<tr d="tr2" tyle="display:none">
						<td class="intxt" width="124" align="left">Known languages</td>
						<td class="intxt" width="25">:</td>
						<td class="intxt" idth="105" align="left">
							<table border="0" width="100%" align="left" cellspacing="0" cellpadding="0">								
								<tr><td idth='35%'>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Others" onClick="return LangKn();"/>
								Others</td><td width="35%">
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Arabic" onClick="return LangKn();"/>
								Arabic</td><td  width="35%">
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Assamese" onClick="return LangKn();"/>
								Assamese</td></tr>
								
								<tr><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Bengali" onClick="return LangKn();"/>
								Bengali</td><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Dutch" onClick="return LangKn();"/>
								Dutch</td><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="English" onClick="return LangKn();"/>
								English</td></tr>
								
								<tr><td>									
								<input type="checkbox" maxlength="5" name="languageKnown1" value="French" onClick="return LangKn();"/>
								French</td><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="German" onClick="return LangKn();"/>
								German</td><td>							
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Gujarathi" onClick="return LangKn();"/>
								Gujarathi</td></tr>
								
								<tr><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Hindi" onClick="return LangKn();"/>
								Hindi</td><td>									
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Kannada" onClick="return LangKn();"/>
								Kannada</td><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Kashmiri" onClick="return LangKn();"/>
								Kashmiri</td></tr>
								
								<tr><td>									
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Malayalam" onClick="return LangKn();"/>
								Malayalam</td><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Marathi" onClick="return LangKn();"/>
								Marathi</td><td>									
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Marwadi" onClick="return LangKn();"/>
								Marwadi</td></tr>
								
								<tr><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Nepali" onClick="return LangKn();"/>
								Nepali</td><td>									
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Oriya" onClick="return LangKn();"/>
								Oriya</td><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Punjabi" onClick="return LangKn();"/>
								Punjabi</td></tr>
								
								<tr><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Sindhi" onClick="return LangKn();"/>
								Sindhi</td><td>																
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Singhalese" onClick="return LangKn();"/>
								Singhalese</td><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Sowrashtra" onClick="return LangKn();"/>
								Sowrashtra</td></tr>
								
								<tr><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Spanish" onClick="return LangKn();"/>
								Spanish</td><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Tamil" onClick="return LangKn();"/>
								Tamil</td><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Telugu" onClick="return LangKn();"/>
								Telugu</td></tr>
								
								<tr><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Tulu" onClick="return LangKn();"/>
								Tulu</td><td>
								<input type="checkbox" maxlength="5" name="languageKnown1" value="Urdu" onClick="return LangKn();"/>
								Urdu</td><td>							
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
					<tr>
						<td class="intxt" align="left">Your Personality <font color="#FF0000">*</font></td>
						<td class="intxt">:</td>
						<td class="intxt" align="left">
						<textarea name="personality" class="regarea" onKeyPress="return isMaxLen(document.thisForm.personality_counter,this,1000,'personality')" onBlur="formElementLimiter(this,1000);toggleHint('hide', this.name);" onFocus="toggleHint('show', this.name)"><?=$user["personality"]?></textarea><br>
						(min. 50 Characters;max. 1000)
						<input type="text" name="personality_counter" class="pinbox" />
						<script language="javascript">
							var len1 = document.thisForm.personality.value;
							document.thisForm.personality_counter.value = len1.length;
						</script>
						</td>
					</tr>
					<tr>
						<td class="intxt" tyle="padding-right:244px;" align="center" colspan="3"><input name="submit" type="submit" class="button" value="Update" /></td>
					  </tr>
					</table></td>
				</tr>				
				<tr>
				<td colspan="2" valign="bottom"><img src="images/topic_bg_bottom.jpg" border="0"/></td>
			  </tr>
			  <tr><td colspan="2">&nbsp;</td></tr>								  
			</table>	  </td>	
  </tr>
  
</table>
