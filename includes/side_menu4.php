<script language="javascript">
function fnRemoveTxt()	{
	if (Trim(document.frmProfile_view.userid.value)=='' || Trim(document.frmProfile_view.userid.value)=='View Profile by id')	{
		document.profile_view.userid.value=''
	}
}
function profile_validate() {	
	if (Trim(document.frmProfile_view.userid.value)=='' || Trim(document.frmProfile_view.userid.value)=='View Profile by id')	{
		alert("Please enter the View Profile by id");
		 return false;
	}	
	document.frmProfile_view.submit();
}
</script>
<? $view_profilebyid_text = 'View Profile by id'; ?>
<div style="padding-top:12px; float:left;" >
  <table width="150"  border="0" cellspacing="0" cellpadding="0" class="menuinnerbg">
    <form name="frmProfile_view" method="get"  action="view_member_profile.php">
	
	<? if($_SESSION['franchisee_id']!=""){ ?>
			  <tr><td height="25" bgcolor="#e68800"><strong style="color:#fbf7d1;">Franchise Services</strong></a></td></tr>
			  <tr><td height="2" bgcolor="#fff9d4"></td></tr>   
			   <tr><td><a href="franchise_account.php"  class="menuinnerbg">My Account</a></td></tr>
			   <tr><td><a href="franchise_upgrade_member.php"  class="menuinnerbg" >Upgrade membership</a></td></tr>
			   <tr><td><a href="view_franchise_upgrade_report.php?franchise_auto_id=<? echo $_SESSION['franchisee_id'];?>&franchise_id=<? echo $_SESSION['franchisee_reg_id'];?>"  class="menuinnerbg" >View Upgrade report</a></td></tr>						
			   <tr><td><a href="#"  class="menuinnerbg" onclick="javascript:poptastic('chat/php121im.php?uname=<? echo $_SESSION['franchise_username'];?>&upass=<? echo $_SESSION['franchise_password']; ?>');">Chat</a></td></tr>
			  <tr><td><a href="logout.php?mode=franchise" class="menuinnerbg" >Logout</a></td></tr>	
 <? } ?>	
  <? if (($config[userinfo])&&($_SESSION['franchisee_id']=="")) { ?>	
  	
  <tr><td height="25" bgcolor="#e68800">&nbsp;<strong style="color:#fbf7d1;">My Profile</strong></a></td></tr>
  <tr><td height="2" bgcolor="#fff9d4"></td></tr>
  <script>
  	//alert('<?=$pfile?>');
  </script>
  <? if ($pfile != 'my_matrimony.php') { ?>
  <tr><td><a href="my_matrimony.php" class="menuinnerbg">My Matrimony</a></td></tr>
  <? } ?>
  <tr><td><a href="partner_match.php" class="menuinnerbg">My Matches</a></td></tr>
  <tr><td><a href="express_interest.php?action=received" class="menuinnerbg">Interest Received</a></td></tr>
  <tr><td><a href="express_interest.php?action=sent" class="menuinnerbg">Interest Sent</a></td></tr>
  <tr><td><a href="view_bookmark.php" class="menuinnerbg">View Book mark</a></td></tr>
  <tr><td><a href="edit_my_profile.php" class="menuinnerbg">Modify Profile</a></td></tr>
  <tr><td><a href="edit_my_profile.php?action1=lookingfor" class="menuinnerbg">Set Partner Preferences</a></td></tr>
  <? if ($pfile != 'my_matrimony.php') { ?>
  <tr><td><a href="edit_my_profile.php?action1=occupation" class="menuinnerbg">Change Phone No</a></td></tr>
  <? } ?>
  <tr><td><a href="payment.php" class="menuinnerbg">Payment Option</a></td></tr>
  <tr><td><a href="delete_profile.php" class="menuinnerbg">Hide/Delete Profile</a></td></tr>
  <tr><td><a href="logout.php?mode=member" class="menuinnerbg">Logout</a></td></tr>
  
 <?php /*?> <tr><td valign="center" height="25">&nbsp;&nbsp;&nbsp
	  <input name="userid" type="text" value="View Profile by id" onfocus="this.value='';"  onclick="this.value='';"  class="mailbox" />&nbsp;&nbsp;<img src="images/btn_go.jpg" onClick="return profile_validate();" style="cursor:pointer;"  border="0" align="absmiddle"/>
  </td></tr> <?php */?>
  <? }  if ($_SESSION['franchisee_id']=="") { ?>
  <tr><td height="25" bgcolor="#e68800">&nbsp;<strong style="color:#fbf7d1;">Matrimony Services</strong></a></td></tr>  
  <tr><td height="2" bgcolor="#fff9d4"></td></tr>  
  <? if (!$config[userinfo]) { ?>
  <tr><td height="25"><a href="my_matrimony.php" class="menuinnerbg">&nbsp;My matrimony</a></td></tr>
  <? } ?>
  <tr><td><a href="wedding_directory.php" class="menuinnerbg">Wedding Directory</a></td></tr>
  <tr><td><a href="franchise_login.php" class="menuinnerbg">Franchise</a></td></tr> 
  <tr><td><a href="franchise_search.php" class="menuinnerbg">Franchise Search</a></td></tr> 
  <? if (!$config[userinfo]) { ?>
  <tr><td><a href="payment.php" class="menuinnerbg">Payment Option</a></td></tr>
  <tr><td><a href="member_login.php" class="menuinnerbg">Member Login</a></td></tr>
  <tr><td><a href="register.php" class="menuinnerbg">Register Free</a></td></tr>
  <? } ?>  
  <tr><td><a href="successful_stories.php" class="menuinnerbg">Successful Stories</a></td></tr>
  <tr><td><a href="contact_us.php" class="menuinnerbg">Contact Us</a></td></tr>
  <? if (!$config[userinfo]) { ?>
   <?php /*?> 
  <tr><td valign="center" eight="35">&nbsp;&nbsp;&nbsp
	  <input name="userid" type="text" value="View Profile by id" onfocus="this.value='';" onclick="this.value='';" class="mailbox" />&nbsp;&nbsp;<img src="images/btn_go.jpg" onClick="return profile_validate();" style="cursor:pointer;"  border="0" align="absmiddle"/>
  </td></tr> <?php */?>
  <? }  }?>
	</form>
</table> 
<table width="183" border="0" cellspacing="0" cellpadding="4" style="border:#e1c179 solid 1px;">
		<form name="searchForm" method="get" action="search.php" onSubmit="return fnValidateSearch('<?=$val1?>');">
		<input type="hidden" name="action" value="search" />
		<tr><td bgcolor="#fee19f"><h4 class="intitle">Partner Search</h4></td></tr>
	  <tr><td bgcolor="#fee19f" height="25" class="inselect" style="padding-left:10px;">
			
	  <? if ($config["userinfo"]) { 
			$user_gender = GetSingleRecord("tbl_register","username",$_SESSION['userid']);
		?>
		<input name="gender" type="radio" value="F" <? if ($user_gender[gender] == "M") { ?> checked <? } ?>>Female&nbsp; 
		<input name="gender" type="radio" value="M" <? if ($user_gender[gender] == "F") { ?> checked <? } ?>>Male
		
	  <? } else { ?>	
		<input name="gender" type="radio" value="F" checked="checked">Female &nbsp; 
		<input name="gender" type="radio" value="M">Male
		
	  <? } ?>
		</td></tr>
		<? if ($config["new_domain"] == "") { ?>
	  <tr>
		  <td bgcolor="#fee19f" height="25" class="inselect" style="padding-left:10px;"	> &nbsp;				
			
				<select name="domain" class="dominbox" nChange="selMultipleDomainCaste();" onChange="selMultipleDomainCaste1()">
					<option value="" selected>-Select A Domain-</option>	
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
		  <td bgcolor="#fee19f" height="25" class="inselect" style="padding-left:10px;"> &nbsp;				
			
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
		  <td bgcolor="#fee19f" height="25" class="inselect" style="padding-left:10px;"> &nbsp;
				<select name="caste" class="dominbox">									
					<option value="">--Select Caste--</option>														
				</select>				
		</td>
	 </tr>
	 <tr>
		  <td bgcolor="#fee19f" height="25" class="inselect" style="padding-left:10px;"> &nbsp;
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
	 <tr><td bgcolor="#fee19f" align="right" style="padding-right:40px;"><input name="Submit" type="submit" value="Search" class="button"></td></tr>
	 <tr><td bgcolor="#fee19f" height="25" class="inselect" style="padding-left:10px;">&nbsp;
	 with photo<input name="withPhoto" type="checkbox" value="1" checked>
	 </td></tr>
	 <tr><td bgcolor="#fee19f" valign="top" height="25" ><a href="search_by_id.php" class="sid">Search  Reg No/ID</a>
	 </td></tr>
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