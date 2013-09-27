 <? if ($_SESSION['userid']) { ?>	
 <tr>
	<td>
		<table width="182" border="0" cellspacing="0" cellpadding="0">
				<tr><td height="32" align="center" bgcolor="#7c6d2e" style="background:url(images/pro_top.gif) left top no-repeat;"><h4 class="mserv"><font color="#e1c85b">My Profile&nbsp;&nbsp;</font></h4></td></tr>
				<tr><td height="30" class="yelbdr" align="left" bgcolor="#7c6d2e"><a href="my_matrimony.php" class="promenu">View My Profile</a></td></tr>
				<tr><td height="30" class="yelbdr" align="left" bgcolor="#7c6d2e"><a href="editprofile.php" class="promenu">Modify Profile</a></td></tr>
				<tr><td height="30" class="yelbdr" align="left" bgcolor="#7c6d2e"><a href="#" class="promenu">Show Partner preference</a></td></tr>
				<tr><td height="30" class="yelbdr" align="left" bgcolor="#7c6d2e"><a href="editprofile.php?action1=lookingfor" class="promenu">Modify Partner Preference</a></td></tr>
				<tr><td height="30" class="yelbdr" align="left" bgcolor="#7c6d2e"><a href="change_password.php" class="promenu">Change Password</a></td></tr>
				<tr><td height="30" class="yelbdr" align="left" bgcolor="#7c6d2e"><a href="editprofile.php?action1=occupation#phonenum" class="promenu">Add/Modify Phone Number</a></td></tr>
				<!--<tr><td height="30" class="yelbdr" align="left" bgcolor="#7c6d2e"><a href="editprofile.php" class="promenu">Hide/Delete Profile</a></td></tr>-->
				<tr><td height="20" align="left" bgcolor="#7c6d2e" style="background:url(images/pro_btm.gif) left bottom no-repeat;"><a href="logout.php" class="promenu">Logout</a></td></tr>
		</table>
	</td>
  </tr>		
 <? } ?>
 <tr>
	<td>
		<table width="182" border="0" cellspacing="0" cellpadding="0" style="background:url(images/ms_inbg.jpg) top left no-repeat; background-color:#fdeb9b;">
			<tr><td height="31" align="center" tyle="background:url(images/ms_top.gif) left top no-repeat;"><h4 class="mserv">Matrimony Services</h4></td></tr>
				<tr><td height="30" class="whitbdr" align="left" gcolor="#fdeb9b"><img src="images/bull.gif" vspace="1" hspace="10"/><a href="editprofile.php" class="innermenu">My matrimony</a></td></tr>
					<tr><td height="30" class="whitbdr" align="left" gcolor="#fdeb9b"><img src="images/bull.gif" vspace="1" hspace="10"/><a href="wedding_directory.php" class="innermenu">Wedding Directory</a></td></tr>
						<tr><td height="30" class="whitbdr" align="left" gcolor="#fdeb9b"><img src="images/bull.gif" vspace="1" hspace="10"/><a href="franchise_login.php" class="innermenu">Franchise</a></td></tr>
					<tr><td height="30" class="whitbdr" align="left" gcolor="#fdeb9b"><img src="images/bull.gif" vspace="1" hspace="10"/><a href="#" class="innermenu">Payment Options</a></td></tr>
				 <? if (!$_SESSION['userid']) { ?>	
				<tr><td height="30" class="whitbdr" align="left" gcolor="#fdeb9b"><img src="images/bull.gif" vspace="1" hspace="10"/><a href="register.php" class="innermenu">Register Free</a></td></tr>
				<?  } ?>
			<tr><td height="30" class="whitbdr" align="left" style="background:url(images/ms_btm.jpg) left bottom no-repeat;"><img src="images/bull.gif" vspace="1" hspace="10"/><a href="successful_stories.php" class="innermenu">Success Stories</a></td></tr>
		</table>
						</td>
  </tr>
  <tr>
	<td>
		<?
			if ($config["new_domain"]) {
				$val1 = 1;
			} else {
				$val1 = 0;
			}
		?>
		<table width="184" border="0" cellspacing="0" cellpadding="0" style="border-left:#2e3e10 solid 1px; border-right:#2e3e10 solid 1px;">
		<form name="searchForm" method="get" action="search.php" onSubmit="return fnValidateSearch('<?=$val1?>');">
			<input type="hidden" name="action" value="search" />
		  <tr><td bgcolor="#a5b400" height="31" style="border:#006600 solid 1px; background-color:#476f02;" align="center"><h4 class="mserv">Partner Search</h4></td></tr>
		  <tr><td bgcolor="#a5b400" height="30" class="inselect">&nbsp;
		  <? if ($_SESSION['userid']) { ?>
		  	<input name="gender" type="radio" value="F" <? if ($user[gender] == "M") { ?> checked <? } ?>>Female&nbsp; 
			<input name="gender" type="radio" value="M" <? if ($user[gender] == "F") { ?> checked <? } ?>>Male
			
		  <? } else { ?>	
		  	<input name="gender" type="radio" value="F" checked="checked">Female &nbsp; 
			<input name="gender" type="radio" value="M">Male
			
		  <? } ?>
			</td></tr>
			<? if ($config["new_domain"] == "") { ?>
		  <tr>
			  <td bgcolor="#a5b400" height="30" class="inselect"> &nbsp;				
				
					<select name="domain" class="dominbox" onChange="selMultipleDomainCaste();">
						<option value="" selected>-Select A Domain-</option>	
					<?	$resDomain = Execute("select * from tbl_domain_master order by id");
						if (mysql_num_rows($resDomain) > 0) {
							while ($domain = mysql_fetch_array($resDomain)) {									
						?>
						<option value="<?=$domain[id]?>"><?=$domain[domain]?></option>
					<?  	}
						} ?>
					</select>																
			  </td>
		 </tr>
		 <?	} else { ?>
		 	 <tr>
			  <td bgcolor="#a5b400" height="30" class="inselect"> &nbsp;				
				
				<? 	$domain = $config["new_domain"]; ?>
				<select name="religion" class="dominbox" onChange="SelectSearchCaste();">										
					<option value="">-Select Religion-</option>
					<?
						$resRegion = Execute("select * from tbl_religion_master where domain = '$domain' order by religion ");
						if (mysql_num_rows($resRegion) > 0) { 
							while ($religion = mysql_fetch_array($resRegion)) {
							?>
							<option value="<?=$religion[id]?>"><?=$religion[religion]?></option>
						<?  }
						 }	?>																	
				</select>																
			  </td>
		 </tr>
		 <? } ?>
		 <tr>
			  <td bgcolor="#a5b400" height="30" class="inselect"> &nbsp;
			  		<select name="caste" class="dominbox">									
						<option value="">--Select Caste--</option>														
					</select>
					<select name="domain_vs_religion" style="display:none">
						<?
							$resReligion = Execute("select * from tbl_religion_master order by id");
							if (mysql_num_rows($resReligion) > 0) { 
								while ($ReligionMaster = mysql_fetch_array($resReligion)) {
								?>
								<option value="<?=$ReligionMaster[id]?>"><?=$ReligionMaster[domain]?></option>
							<?  }
							 }	?>
					</select>
					<select name="domain_vs_religion1" style="display:none">
						<?
							$resReligion = Execute("select * from tbl_religion_master order by id");
							if (mysql_num_rows($resReligion) > 0) { 
								while ($ReligionMaster = mysql_fetch_array($resReligion)) {
								?>
								<option value="<?=$ReligionMaster[id]?>"><?=$ReligionMaster[religion]?></option>
							<?  }
							 }	?>
					</select>										
					<select name="religion_vs_caste" style="display:none">
						<?
							$resCaste = Execute("select * from tbl_caste_master order by caste");
							if (mysql_num_rows($resCaste) > 0) { 
								while ($CasteMaster = mysql_fetch_array($resCaste)) {
								?>
								<option value="<?=$CasteMaster[caste]?>"><?=$CasteMaster[religionid]?></option>
							<?  }
							 }	?>
					</select>	
			  </td>
		 </tr>
		 <tr>
			  <td bgcolor="#a5b400" height="30" class="inselect"> &nbsp;
			  Age&nbsp;<select name="fromAge" class="agebox">
					<option value="18" selected="selected">18</option>
					<? for ($i = 19; $i < 99; $i++) { ?>
					<option value="<?=$i?>"><?=$i?></option>
					<? } ?>					
				</select>
				&nbsp;to&nbsp;
				<select name="toAge"  class="agebox">					
					<? for ($i = 18; $i < 99; $i++) { ?>
					<option value="<?=$i?>" <? if ($i == 30) { ?> selected <? } ?>><?=$i?></option>
					<? } ?>
				</select>							</td>
		 </tr>
		 <tr><td bgcolor="#a5b400" height="30" class="inselect">&nbsp;
		 with photo<input name="withPhoto" type="checkbox" value="1" checked>
		 </td></tr>
		 <tr><td bgcolor="#a5b400" valign="top" height="30" align="right">&nbsp;<a href="#" class="reg">Search  Reg No/ID</a>&nbsp;
		 <input name="Submit" type="submit" value="Submit" class="button3">&nbsp;</td></tr>
		 </form>
		</table>						</td>
  </tr>
<tr valign="top">
<td>
<? fnSuccessful_stories_others(); ?>
</td>
</tr>