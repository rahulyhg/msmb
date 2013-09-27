<?
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
$view_profilebyid_text = 'View Profile by id'; 
print '
<div style="padding-top:12px; order:#00FF00 1px solid; width:172px; float:left;">
 <table width="172"  border="0"  cellspacing="0" cellpadding="0" class="menuinnerbg">
    <form name="frmProfile_view" method="get"  action="view_member_profile.php">';
	
	if($_SESSION['franchisee_id']!=""){ 
		print '<tr><td height="25" bgcolor="#e68800" style="padding-left:5px;"><strong style="color:#fbf7d1;">Franchise Services</strong></a></td></tr>
			   <tr><td height="2" bgcolor="#fff9d4"></td></tr>   
			   <tr><td><a href="franchise_upgrade_member.php"  class="submenuinner" >Upgrade membership</a></td></tr>
			   <tr><td><a href="view_franchise_upgrade_report.php?franchise_auto_id='.$_SESSION['franchisee_id'].'&franchise_id='.$_SESSION['franchisee_reg_id'].'"  class="submenuinner" >View Upgrade report</a></td></tr>';
			   						
		print "<tr><td><a href=\"#\"  class=\"submenuinner\" onclick=\"javascript:poptastic('chat/php121im.php?uname=".$_SESSION['franchise_username']."&upass=".$_SESSION['franchise_password']."');\">Chat</a></td></tr>
			   <tr><td><a href=\"franchise_account.php\"  class=\"submenuinner\">My Account</a></td></tr>";			   
			   
		print  '<tr><td><a href="logout.php?mode=franchise" class="submenuinner" >Logout</a></td></tr>';	
  } 	
  if (($config[userinfo])&&($_SESSION['franchisee_id']=="")) { 	
  	
		print  '<tr><td height="25" bgcolor="#e68800">&nbsp;<strong style="color:#fbf7d1;">My Profile</strong></a></td></tr>
		  <tr><td height="2" bgcolor="#fff9d4"></td></tr>';  
		  if ($pfile != 'my_matrimony.php') { 
			print '<tr><td><a href="my_matrimony.php" class="submenuinner">My Matrimony</a></td></tr>';
		  }
	  print '<tr><td><a href="partner_match.php" class="submenuinner">My Matches</a></td></tr>
	  <tr><td><a href="express_interest.php?action=received" class="submenuinner">Interest Received</a></td></tr>
	  <tr><td><a href="express_interest.php?action=sent" class="submenuinner">Interest Sent</a></td></tr>
	  <tr><td><a href="view_bookmark.php" class="submenuinner">View Book mark</a></td></tr>
	  <tr><td><a href="edit_my_profile.php" class="submenuinner">Modify Profile</a></td></tr>
	  <tr><td><a href="edit_my_profile.php?action1=lookingfor" class="submenuinner">Set Partner Preferences</a></td></tr>';
	  if ($pfile != 'my_matrimony.php') { 
			print '<tr><td><a href="edit_my_profile.php?action1=occupation&cursor=phone" class="submenuinner">Change Phone No</a></td></tr>';
	  } 
  		print '<tr><td><a href="payment.php" class="submenuinner">Payment Option</a></td></tr>
  		<tr><td><a href="delete_profile.php" class="submenuinner">Hide/Delete Profile</a></td></tr>
  		<tr><td><a href="logout.php?mode=member" class="submenuinner">Logout</a></td></tr>';
  }  if ($_SESSION['franchisee_id']=="") { 
  		print '<tr><td height="25" bgcolor="#e68800">&nbsp;<strong style="color:#fbf7d1;">Matrimony Services</strong></a></td></tr>  
  		<tr><td height="2" bgcolor="#fff9d4"></td></tr>';  
		  if (!$config[userinfo]) { 
				print '<tr><td height="25"><a href="my_matrimony.php" class="submenuinner">&nbsp;My matrimony</a></td></tr>';
		  }
		  print '<tr><td><a href="wedding_directory.php" class="submenuinner">Wedding Directory</a></td></tr>
		  <tr><td><a href="franchise_login.php" class="submenuinner">Franchise</a></td></tr> 
		  <tr><td><a href="franchise_search.php" class="submenuinner">Franchise Search</a></td></tr>';   
		  if (!$config[userinfo]) { 
		  print '<tr><td><a href="payment.php" class="submenuinner">Payment Option</a></td></tr>
		  <tr><td><a href="member_login.php" class="submenuinner">Member Login</a></td></tr>
		  <tr><td><a href="register.php" class="submenuinner">Register Free</a></td></tr>';
		  }  
		  print '<tr><td><a href="successful_stories.php" class="submenuinner">Successful Stories</a></td></tr>
		  <tr><td><a href="contact_us.php" class="submenuinner">Contact Us</a></td></tr>';
 }
	print '</form>
			</table>
			<div style="padding-top:5px; order:#00FF00 1px solid; "></div> 
			<table width="172" border="0"  cellspacing="0" cellpadding="0" style="border:#e1c179 solid 1px;">';
	print  "<form name=\"searchForm\" method=\"get\" action=\"search.php\" onSubmit=\"return fnValidateSearch('<?=$val1?>');\">";
	print '<input type="hidden" name="action" value="search" />
		<tr><td bgcolor="#fee19f" height="35" style="padding-left:7px;"><h4 class="intitle">Partner Search</h4></td></tr>
	  <tr><td bgcolor="#fee19f" height="25" class="inselect">';
			
    if ($config["userinfo"]) { 
			$user_gender = GetSingleRecord("tbl_register","username",$_SESSION['userid']);
	
			print '<input name="gender" type="radio" value="F"';
			if ($user_gender[gender] == "M") { 
				print 'checked';
			}
			print '>Female&nbsp; 
				<input name="gender" type="radio" value="M"';
			if ($user_gender[gender] == "F") { 
				print 'checked';
			}
			print '>Male';		
	} else { 	
			print '<input name="gender" type="radio" value="F" checked="checked">Female &nbsp; 
		<input name="gender" type="radio" value="M">Male';
		
	} 
		print '</td></tr>';
	if ($config["new_domain"] == "") { 
		print '<tr>
		  <td bgcolor="#fee19f" height="35" class="inselect"> &nbsp;				
			
				<select name="domain" class="dominbox" nChange="selMultipleDomainCaste();" onChange="selMultipleDomainCaste1()">
					<option value="" selected>-Select A Domain-</option>';	
				<?	$resDomain = Execute("select * from tbl_domain_master order by id");
					if (mysql_num_rows($resDomain) > 0) {
						while ($domain1 = mysql_fetch_array($resDomain)) {									
					?>
					<option value="<?=$domain1[id]?>"><?=$domain1[domain]?></option>
				<?  	}
					} ?>
				</select>			  </td>
	 </tr>
	 <?	} else { ?>
		 <tr>
		  <td bgcolor="#fee19f" height="35" class="inselect"> &nbsp;				
			
			<? 	$domain = $config["new_domain"]; ?>
			<select name="religion" class="dominbox" onChange="SelectSearchCaste();">										
				<option value="">-Select Religion-</option>
				<?
					$resRegion = Execute("select * from tbl_religion_master where domain = '$domain' order by religion ");
					if (mysql_num_rows($resRegion) > 0) { 
						while ($religion1 = mysql_fetch_array($resRegion)) {
						?>
						<option value="<?=$religion1[id]?>"><?=$religion1[religion]?></option>
					<?  }
					 }	?>																	
			</select>			  </td>
	 </tr>
	 <? } ?>
	 <tr>
		  <td bgcolor="#fee19f" height="35" class="inselect"> &nbsp;
				<select name="caste" class="dominbox">									
					<option value="">--Select Caste--</option>														
				</select>				
		</td>
	 </tr>
	 <tr>
		  <td bgcolor="#fee19f" height="35" class="inselect"> &nbsp;
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
	 <tr><td bgcolor="#fee19f" height="35" class="inselect">&nbsp;
	 with photo<input name="withPhoto" type="checkbox" value="1" checked>
	 </td></tr>
	 <tr><td bgcolor="#fee19f" valign="top" height="35" ><a href="search_by_id.php" class="sid">Search  Reg No/ID</a>
	 <input name="Submit" type="submit" value="Search" class="button"></td></tr>
	 </form>
</table>		
<table  border="0" cellspacing="0" cellpadding="0" style="padding-top:5px;">
  <tr>
	<td align="left">
	<?
		$file = $_SERVER["SCRIPT_NAME"];
		$break = Explode('/', $file);
		$pfile = $break[count($break) - 1]; 
		if($pfile=="search.php")
		  fnBannerImage('search','left');
		else 
		  fnBannerImage('search','left');
	?>	</td>
  </tr>
</table>
 
</div>
