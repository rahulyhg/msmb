					<table align="center" border="0" width="500" cellpadding="5" cellspacing="0">											
						<tr>
						 	<td colspan="2" align="left"><div style="border:#999900 1px dotted; margin:5px; padding:5px;"><b class="yel">Advanced Search - Search based on specific criteria </b><br />This search will give you very specific results based on your inputs. Results can be viewed as Thumbnail View. If you like a profile you can Express your Interest</div></td>
						</tr>						 
						<tr bgcolor="#FFFFFF">
							<td style="color:#da8124;">Domain(s)</td>
								<td valign="top">
									<select name="partnerDomain[]" class="txtcbomulti" multiple="multiple" onchange="FillReligionsCaste('','')">									
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
									(Use control + arrow key to selecte more options)							</td>		
						 </tr>						 
						<tr bgcolor="#eae7c4">
							<td>Looking for</td><td>								
							<input type="radio" name="gender" class="radio" value="F" checked>&nbsp;Female&nbsp;<input type="radio" name="gender" class="radio" value="M" <? if ($config[userinfo] && $config[userinfo][gender] != 'M') { ?> checked <? } ?> >&nbsp;Male
							</td>
						</tr>
						<tr bgcolor="#FFFFFF">
						 	<td style="color:#da8124;">Marital Status</td>
							<td>
								<select name="partnerMaritalStatus[]" class="txtcbomulti" multiple>								
									<option value="unspec" selected>Any</option>
									<option value="Unmarried">Unmarried</option>									
									<option value="Window/Windower">Window/Windower</option>
									<option value="Divorced">Divorced</option>
									<option value="Separated">Separated</option>
								</select>
								<script language="javascript">
									document.thisForm.elements["partnerMaritalStatus[]"].value = 'Unmarried';
								</script>
							</td>							
						 </tr>	
						 <tr bgcolor="#FFFFFF">
						 	<td style="color:#da8124;">Have children</td>
							<td>
								<select name="partnerHaveChild" class="cmbboxmulti">									
									<option value="no">No</option>	
									<option value="yes">Yes</option>
									<option value="unspec">Doesn't matter</option>																		
								</select>							</td>
						</tr>
						<tr bgcolor="#FFFFFF">
						 	<td style="color:#da8124;">Height</td>
							<td>From
								<select name="partnerHeightFrom" class="cmbheightbox">
									<script language="javascript">
										GetHeight();
									</script>
								</select><br />								
								&nbsp;&nbsp;&nbsp;To&nbsp;&nbsp; 
								<select name="partnerHeightTo" class="cmbheightbox">
									<script language="javascript">
										GetHeight();
									</script>
								</select>							</td>
						 </tr>
						 
						 <tr bgcolor="#FFFFFF">
						 	<td style="color:#da8124;">Physical status</td>
							<td>
								<select name="partnerPhysicalStatus" class="cmbboxmulti">									
									<option value="Normal" selected>Normal</option>
									<option value="Disabled">Disabled</option>									
									<option value="unspec">Doesn't matter</option>																		
								</select>							</td>
						</tr>
						<tr bgcolor="#FFFFFF">
							<td style="color:#da8124;">Mother tongue </td>
							<td>
								<select name="partnerMotherTongue[]" class="txtcbomulti" multiple>
									<option value="0" selected>Any</option>	
									<script language="javascript">
										Language1();
									</script>
								</select>
							</td>
						</tr>
						<tr bgcolor="#FFFFFF">
							<td style="color:#da8124;">Religion</td>
							<td>
								<select name="partnerReligion[]" class="txtcbomulti" onChange="FillCaste1();" multiple>
									<option value="0" selected>Any</option>	
									<? FillReligion(); ?>																							
								</select>
							</td>
						<tr bgcolor="#FFFFFF">
							<td style="color:#da8124;">Caste / Division </td>
							<td>									
								<select name="partnerCaste[]" class="txtcbomulti" multiple>									
									<option value="0" selected>Any</option>									
									<? FillCaste(); ?>
								</select>								
								<script language="javascript">											
									//FillReligionsCaste('','');
									//FillCaste1('<?=$cast?>');										
								</script>							</td>
						</tr>							
						<!--<tr><td colspan="2"  height="5" style="background:url(images/middot.jpg) center repeat-x;"></td></tr>-->
						<tr>
						 	<td align="left" colspan="2"><b class="clr">Educational & Occupation Details:</b></td></td>
						 </tr>							 
						 <tr bgcolor="#FFFFFF">
							<td width="200">Education </td>
							<td width="450">
								<select name="partnerEducation[]" class="txtcbomulti" multiple="multiple">
									<option value="0" selected>Any</option>
									<?
										$res = Execute("select * from tbl_education_master");
										if (mysql_num_rows($res) > 0) {
											while ($education = mysql_fetch_array($res)) { ?>
												<option value="<?=$education[id]?>"><?=$education[education]?></option>	
										<?	}
										}
									?>
								</select>
							</td>							
						</tr>
						<tr bgcolor="#FFFFFF">
							<td width="200" style="color:#da8124;">Occupation </td>
							<td width="450">
								<select name="partnerOccupation[]" class="txtcbomulti" multiple="multiple">
									<option value="0" selected>Any</option>
									<?
										$res = Execute("select * from tbl_occupation_master");
										if (mysql_num_rows($res) > 0) {
											while ($occupation = mysql_fetch_array($res)) { ?>
												<option value="<?=$occupation[id]?>"><?=$occupation[occupation]?></option>	
										<?	}
										}
									?>
								</select>
							</td>							
						</tr>
						<!--<tr><td colspan="2"  height="5" style="background:url(images/middot.jpg) center repeat-x;"></td></tr>-->
						<tr>
						 	<td align="left" colspan="2"><b class="clr">Location Details:</b></td></td>
						</tr>						
						<tr bgcolor="#FFFFFF">
							<td style="color:#da8124;">Citizenship </td>
							<td>
								<select class="txtcbomulti" name="partnerCitizenship[]" multiple="multiple">
								<option value="0" selected>Any</option>
								<script language="JavaScript" type="text/javascript">
									GetCountry1('India','');
								</script>	
								</select>								
							</td>
						</tr>
						<tr bgcolor="#FFFFFF">
							<td colspan="2">
								Note: If you want to search for a particular State (in India),  select country name from the 'country of residence' section & then select the corresponding state.
							</td>
						</tr>
												
						<tr bgcolor="#FFFFFF">
							<td style="color:#da8124;">Country of Residence</td>
							<td>
								<select class="txtcbomulti" name="partnerResidingCountry[]" multiple="multiple" onchange="selPartnerInidanState()">
									<option value="0" selected>Any</option>
									<? GetCountry(); ?>
								</select>																
							</td>
						</tr>						
                        <tr bgcolor="#FFFFFF">
							<td style="color:#da8124;">Residing State</td>
							<td><b>Residing State in India</b><br />
								<select class="txtcbomulti" name="partnerResidingState[]" multiple="multiple" onchange="selectPartnerCity()">																
								</select>								
								<select name="india_vs_state" style="visibility:hidden">
									<? GetStateInIndia(); ?>
								</select>
							</td>
						</tr>
						<tr bgcolor="#FFFFFF">
							<td style="color:#da8124;">Residing City</td>
							<td><b>Residing in India</b><br />
								<select class="txtcbomulti" name="partnerResidingCity[]" multiple="multiple">																		
								</select>								
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center"><input name="Submit" type="image" src="images/search_btn.jpg" value=""></td>
						</tr>													
					</table>
