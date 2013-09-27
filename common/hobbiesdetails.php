<table border="0" <? if ($_SESSION['userid']) { ?>width="550" <? } else { ?> width="583" <? } ?> cellpadding="5" cellspacing="1" align="center">					
						<!--<tr class="heading" bgcolor="#FFFFFF">
							<td colspan="2">
								<table border="0" width="100%" height="100%">
									<tr><td align="left"><b>You are login as <?=$_SESSION['name'];?></b></td><td align="right"><a href="logout.php"><b>Logout</b></a></td></tr>
								</table>	
							</td>							
						 </tr>-->						 
						 <tr bgcolor="#FFFFFF">
						 	<td align="right" colspan="2"><b>Not Compulsory</b></td>														
						 </tr>
						 <tr>
						 	<? if ($pagename != "editprofile.php") {?>
						 	<td align="left"><b class="clr">Hobbies</b></td><td align="right">							
							<a href="register5.php"><b>skip hobbies and interest</b></a>
							</td>
							<? } else { ?>
							<td align="left" colspan="2"><b class="clr">Hobbies</b></td>							
							<? } ?>							
						 </tr>
						 <tr bgcolor="#FFFFFF">
						 	<td colspan="2">
						 	<table cellpadding="0" cellspacing="0" border="0">
							<? $i = 0;								
								foreach ($config["menu_hobbie"] as $key => $value) {
									if ($i == 0) { ?>
								<tr>
								<?  }  ?>
								 	<td valign="top" width="160" height="25"><input type=checkbox name="hobbie_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?  if ($i == 3) { ?>									
								</tr>
							<? 		
										$i = -1;	
									}															
									$i++;
								} ?>
								<tr>
									<td colspan="4">Any other hobby/ies worth mentioning&nbsp;<input type="text" name="txthobbie" class="probox"></td>
								</tr>
							</table>
							</td>						 	
						</tr>
						<tr><td colspan="2"  height="25" style="background:url(images/middot.jpg) center repeat-x;"></td></tr>
						<tr>
						 	<td colspan="2" align="left"><b class="clr">Interest</b></td>
						 </tr>
						<tr bgcolor="#FFFFFF">
						 	<td colspan="2">
						 	<table cellpadding="0" cellspacing="0" border="0">
							<? $i = 0;								
								foreach ($config["menu_interest"] as $key => $value) {
									if ($i == 0) { ?>
								<tr>
								<?  }  ?>
								 	<td valign="top" width="160" height="25"><input type=checkbox name="interest_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?  if ($i == 3) { ?>									
								</tr>
							<? 		
										$i = -1;	
									}															
									$i++;
								} ?>
							<tr>
								<td colspan="4">Any other interest/s worth mentioning&nbsp;<input type="text" name="txtinterest" class="probox"></td>
							</tr>
							</table>
							</td>
						</tr>
						<tr><td colspan="2"  height="25" style="background:url(images/middot.jpg) center repeat-x;"></td></tr>
						<tr>
						 	<td colspan="2" align="left"><b class="clr">Music</b></td>
						 </tr>
						<tr bgcolor="#FFFFFF">
						 	<td colspan="2">
						 	<table cellpadding="0" cellspacing="0" border="0">
							<? $i = 0;								
								foreach ($config["menu_music"] as $key => $value) {
									if ($i == 0) { ?>
								<tr>
								<?  }  ?>
								 	<td valign="top" width="160" height="25"><input type=checkbox name="music_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?  if ($i == 3) { ?>									
								</tr>
							<? 		
										$i = -1;	
									}															
									$i++;
								} ?>
							<tr>
								<td colspan="4">Any other music worth mentioning&nbsp;<input type="text" name="txtmusic" class="probox"></td>
							</tr>
							</table>
							</td>
						</tr>
							<tr><td colspan="2"  height="25" style="background:url(images/middot.jpg) center repeat-x;"></td></tr>
						<tr>
						 	<td colspan="2" align="left"><b class="clr">Favourite Reads</b></td>
						 </tr>
						<tr bgcolor="#FFFFFF">
						 	<td colspan="2">
						 	<table cellpadding="0" cellspacing="0" border="0">
							<? $i = 0;								
								foreach ($config["menu_read"] as $key => $value) {
									if ($i == 0) { ?>
								<tr>
								<?  }  ?>
								 	<td valign="top" width="160" height="25"><input type=checkbox name="read_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?  if ($i == 3) { ?>									
								</tr>
							<? 		
										$i = -1;	
									}															
									$i++;
								} ?>
							<tr>
								<td colspan="4">Any particular author/ reads worth mentioning&nbsp;<input type="text" name="txtread" class="probox"></td>
							</tr>
							</table>
							</td>
						</tr>	
						<tr><td colspan="2"  height="25" style="background:url(images/middot.jpg) center repeat-x;"></td></tr>
						<tr>
						 	<td colspan="2" align="left"><b class="clr">Preferred Movies</b></td>
						 </tr>
						<tr bgcolor="#FFFFFF">
						 	<td colspan="2">
						 	<table cellpadding="0" cellspacing="0" border="0">
							<? $i = 0;								
								foreach ($config["menu_movie"] as $key => $value) {
									if ($i == 0) { ?>
								<tr>
								<?  }  ?>
								 	<td valign="top" width="160" height="25"><input type=checkbox name="movie_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?  if ($i == 3) { ?>									
								</tr>
							<? 		
										$i = -1;	
									}															
									$i++;
								} ?>
							<tr>
								<td colspan="4">Any particular movie/s worth mentioning&nbsp;<input type="text" name="txtmovie" class="probox"></td>
							</tr>
							</table>
							</td>							
						</tr>
							<tr><td colspan="2"  height="25" style="background:url(images/middot.jpg) center repeat-x;"></td></tr>
						<tr>
						 	<td colspan="2" align="left"><b class="clr">Sports / Fitness Activities	</b></td>
						</tr>
						<tr bgcolor="#FFFFFF">
						 	<td colspan="2">
						 	<table cellpadding="0" cellspacing="0" border="0">
							<? $i = 0;								
								foreach ($config["menu_sport"] as $key => $value) {
									if ($i == 0) { ?>
								<tr>
								<?  }  ?>
								 	<td valign="top" width="160" height="25"><input type=checkbox name="sport_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?  if ($i == 3) { ?>									
								</tr>
							<? 		
										$i = -1;	
									}															
									$i++;
								} ?>
							<tr>
								<td colspan="4">Any other particular sport worth mentioning&nbsp;<input type="text" name="txtsport" class="probox"></td>
							</tr>
							</table>
							</td>
						</tr>
							<tr><td colspan="2"  height="25" style="background:url(images/middot.jpg) center repeat-x;"></td></tr>
						<tr>
						 	<td colspan="2" align="left"><b class="clr">Favorite Cuisine</b></td>
						</tr>	
						<tr bgcolor="#FFFFFF">
						 	<td colspan="2">
						 	<table cellpadding="0" cellspacing="0" border="0">
							<? $i = 0;								
								foreach ($config["menu_cuisine"] as $key => $value) {
									if ($i == 0) { ?>
								<tr>
								<?  }  ?>
								 	<td valign="top" width="160" height="25"><input type=checkbox name="cuisine_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?  if ($i == 3) { ?>									
								</tr>
							<? 		
										$i = -1;	
									}															
									$i++;
								} ?>
							<tr>
								<td colspan="4">Any particular cuisine/dish worth mentioning&nbsp;<input type="text" name="txtcuisine" class="probox"></td>
							</tr>							
							</table>
							</td>
						</tr>
							<tr><td colspan="2"  height="25" style="background:url(images/middot.jpg) center repeat-x;"></td></tr>
						<tr>
						 	<td colspan="2" align="left"><b class="clr">Preferred Dress Style</b></td>
						</tr>	
						<tr bgcolor="#FFFFFF">
						 	<td colspan="2">
						 	<table cellpadding="0" cellspacing="0" border="0">
								<tr>
								<? foreach ($config["menu_dress"] as $key => $value) { ?>
									
										<td valign="top" width="160" height="25"><input type=checkbox name="dress_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?	} ?>
								</tr>	
								<tr>
									<td colspan="4">Any other form of dressing/designer worth mentioning&nbsp;<input type="text" name="txtdress" class="probox"></td>
								</tr>													
							</table>
							</td>							
						</tr> 					 
						<tr bgcolor="#FFFFFF">
							<td colspan="2" align="center"><input type="submit" value="Submit" class="probtn">
							&nbsp;<input type="reset" value="Reset" class="probtn"></td>
						</tr>							 					
					</table>
					