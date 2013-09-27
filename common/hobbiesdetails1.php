<table width="754" border="0" cellspacing="0" cellpadding="0" align="center" class="topictitlebg2">
  <tr>
	<td width="161" align="left" style="padding:5px 5px 9px 30px;" height="16"><h3 class="topic">Interest / Hobbies details</h3></td><td width="254">&nbsp;</td>
	<td width="314">&nbsp;</td>
  </tr>
  <tr>
	<td align="center" colspan="2">
		<table width="22%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="tbdrlft" bgcolor="#f3fae6" align="center">
					<table width="90%" border="0" cellspacing="0" cellpadding="5">
					  <tr>
						<td class="intxt" width="124" align="left" colspan="3"><b>Hobbies</b></td>
					  </tr>
					  <tr>						
						<td class="intxt" align="left" colspan="3">
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
									<td colspan="4">Any other hobby/ies worth mentioning&nbsp;&nbsp;<input type="text" name="txthobbie" class="mprlgtbox"></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class="intxt" width="124" align="left" colspan="3"><b>Interest</b></td>
					</tr>
					<tr>
						<td class="intxt" align="left" colspan="3">
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
								<td colspan="4">Any other interest/s worth mentioning&nbsp;&nbsp;<input type="text" name="txtinterest" class="mprlgtbox"></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class="intxt" width="124" align="left" colspan="3"><b>Music</b></td>
					</tr>
					<tr>
						<td class="intxt" align="left" colspan="3">
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
								<td colspan="4">Any other music worth mentioning&nbsp;&nbsp;<input type="text" name="txtmusic" class="mprlgtbox"></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class="intxt" width="124" align="left" colspan="3"><b>Favourite Reads</b></td>
					</tr>
					<tr>
						<td class="intxt" align="left" colspan="3">
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
								<td colspan="4">Any particular author/ reads worth mentioning&nbsp;&nbsp;<input type="text" name="txtread" class="mprlgtbox"></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class="intxt" width="124" align="left" colspan="3"><b>Preferred Movies</b></td>
					</tr>
					<tr>
						<td class="intxt" align="left" colspan="3">
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
								<td colspan="4">Any particular movie/s worth mentioning&nbsp;&nbsp;<input type="text" name="txtmovie" class="mprlgtbox"></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class="intxt" width="224" align="left" colspan="3"><b>Sports / Fitness Activities</b></td>
					</tr>
					<tr>
						<td class="intxt" align="left" colspan="3">
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
								<td colspan="4">Any other particular sport worth mentioning&nbsp;&nbsp;<input type="text" name="txtsport" class="mprlgtbox"></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class="intxt" width="224" align="left" colspan="3"><b>Favorite Cuisine</b></td>
					</tr>
					<tr>
						<td class="intxt" align="left" colspan="3">
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
								<td colspan="4">Any particular cuisine/dish worth mentioning&nbsp;&nbsp;<input type="text" name="txtcuisine" class="mprlgtbox"></td>
							</tr>
							<tr><td colspan="4" height="5">&nbsp;</td></tr>							
							</table>
						</td>
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
  <tr>
	<td align="center" colspan="3">
		<input type="submit" value="Update" class="button" />
	</td>
  </tr>
</table>