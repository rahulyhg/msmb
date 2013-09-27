						<tr class="tblContent">					 	
							<td align="left" colspan="2"><b>Hobbies</b></td>														
						 </tr>
						 <tr class="tblContent">
						 	<td colspan="2">
						 	<table>
							<? $i = 0;								
								foreach ($config["menu_hobbie"] as $key => $value) {
									if ($i == 0) { ?>
								<tr>
								<?  }  ?>
								 	<td valign="top"><input type=checkbox name="hobbie_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?  if ($i == 3) { ?>									
								</tr>
							<? 		
										$i = -1;	
									}															
									$i++;
								} ?>
								<tr>
									<td colspan="4">Any other hobby/ies worth mentioning&nbsp;<input type="text" name="txthobbie" class="txtbox"></td>
								</tr>
							</table>
							</td>						 	
						</tr>							
						<tr class="headerbg">
						 	<td colspan="2" align="left"><b>Interest</b></td>
						 </tr>
						<tr class="tblContent">
						 	<td colspan="2">
						 	<table>
							<? $i = 0;								
								foreach ($config["menu_interest"] as $key => $value) {
									if ($i == 0) { ?>
								<tr>
							<?  }  ?>
									<td valign="top"><input type=checkbox name="interest_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?  if ($i == 3) { ?>									
								</tr>
							<? 		
										$i = -1;	
									}															
									$i++;
								} ?>
							<tr>
								<td colspan="4">Any other interest/s worth mentioning&nbsp;<input type="text" name="txtinterest" class="txtbox"></td>
							</tr>
							</table>
							</td>
						</tr>	
						<tr class="headerbg">
						 	<td colspan="2" align="left"><b>Music</b></td>
						</tr>
						<tr class="tblContent">
						 	<td colspan="2">
						 	<table>
							<? $i = 0;								
								foreach ($config["menu_music"] as $key => $value) {
									if ($i == 0) { ?>
								<tr>
								<?  }  ?>
								 	<td valign="top"><input type=checkbox name="music_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?  if ($i == 3) { ?>									
								</tr>
							<? 		
										$i = -1;	
									}															
									$i++;
								} ?>
							<tr>
								<td colspan="4">Any other music worth mentioning&nbsp;<input type="text" name="txtmusic" class="txtbox"></td>
							</tr>
							</table>
							</td>
						</tr>	
						<tr class="headerbg">
						 	<td colspan="2" align="left"><b>Favourite Reads</b></td>
						 </tr>
						<tr class="tblContent">
						 	<td colspan="2">
						 	<table>
							<? $i = 0;								
								foreach ($config["menu_read"] as $key => $value) {
									if ($i == 0) { ?>
								<tr>
								<?  }  ?>
								 	<td valign="top"><input type=checkbox name="read_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?  if ($i == 3) { ?>									
								</tr>
							<? 		
										$i = -1;	
									}															
									$i++;
								} ?>
							<tr>
								<td colspan="4">Any particular author/ reads worth mentioning&nbsp;<input type="text" name="txtread" class="txtbox"></td>
							</tr>
							</table>
							</td>
						</tr>	
						<tr class="headerbg">
						 	<td colspan="2" align="left"><b>Preferred Movies</b></td>
						 </tr>
						<tr class="tblContent">
						 	<td colspan="2">
						 	<table>
							<? $i = 0;								
								foreach ($config["menu_movie"] as $key => $value) {
									if ($i == 0) { ?>
								<tr>
								<?  }  ?>
								 	<td valign="top"><input type=checkbox name="movie_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?  if ($i == 3) { ?>									
								</tr>
							<? 		
										$i = -1;	
									}															
									$i++;
								} ?>
							<tr>
								<td colspan="4">Any particular movie/s worth mentioning&nbsp;<input type="text" name="txtmovie" class="txtbox"></td>
							</tr>
							</table>
							</td>							
						</tr>						
						<tr class="headerbg">
						 	<td colspan="2" align="left"><b>Sports / Fitness Activities	</b></td>
						</tr>
						<tr class="tblContent">
						 	<td colspan="2">
						 	<table>
							<? $i = 0;								
								foreach ($config["menu_sport"] as $key => $value) {
									if ($i == 0) { ?>
								<tr>
								<?  }  ?>
								 	<td valign="top"><input type=checkbox name="sport_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?  if ($i == 3) { ?>									
								</tr>
							<? 		
										$i = -1;	
									}															
									$i++;
								} ?>
							<tr>
								<td colspan="4">Any other particular sport worth mentioning&nbsp;<input type="text" name="txtsport" class="txtbox"></td>
							</tr>
							</table>
							</td>
						</tr>
						<tr class="headerbg">
						 	<td colspan="2" align="left"><b>Favorite Cuisine</b></td>
						</tr>	
						<tr class="tblContent">
						 	<td colspan="2">
						 	<table>
							<? $i = 0;								
								foreach ($config["menu_cuisine"] as $key => $value) {
									if ($i == 0) { ?>
								<tr>
								<?  }  ?>
								 	<td valign="top"><input type=checkbox name="cuisine_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
								<?  if ($i == 3) { ?>									
								</tr>
							<? 		
										$i = -1;	
									}															
									$i++;
								} ?>
							<tr>
								<td colspan="4">Any particular cuisine/dish worth mentioning&nbsp;<input type="text" name="txtcuisine" class="txtbox"></td>
							</tr>							
							</table>
							</td>
						</tr>
						<tr class="headerbg">
						 	<td colspan="2" align="left"><b>Preferred Dress Style</b></td>
						</tr>	
						<tr class="tblContent">
						 	<td colspan="2">
						 	<table><tr>
						 	<? foreach ($config["menu_dress"] as $key => $value) { ?>
								
								 	<td valign="top"><input type=checkbox name="dress_<?= $key; ?>" value="<?= $key; ?>"><?= $value; ?></td>
							<?	} ?>
							</tr>	
							<tr>
								<td colspan="4">Any other form of dressing/designer worth mentioning&nbsp;<input type="text" name="txtdress" class="txtbox"></td>
							</tr>													
							</table>
							</td>							
						</tr> 	
						<?				 
							$res = Execute("select * from tbl_interests where userid='$id'");
								if (mysql_num_rows($res)>0) {
									while ($rs = mysql_fetch_array($res)) {				
										?>
										<script language="javascript">
											SelHobbies('<?=$rs['interest']?>','<?=$rs['type']?>');
										</script>
										<?		
									}		
								}
						?>		
						
				