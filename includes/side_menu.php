<?
ob_start();
$usr1=$_SESSION['userid'];
?>
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
function dis_side_menu() {

	var ajaxRequest; 						
	try {
		ajaxRequest = new XMLHttpRequest();
	} catch (e) {
		try {
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				alert("Your browser does not support ajax!");
				return false;
			}
		}
	}
	ajaxRequest.onreadystatechange = function() {
		f1 = document.thisForm;	
		if (ajaxRequest.readyState == 4) {					
			result = ajaxRequest.responseText;							
			document.getElementById("div_side_menu").innerHTML = result;					
		}
	}
	ajaxRequest.open("GET","includes/side_menu_ajax.php", true);
	ajaxRequest.send(null);
}
</script>
<div id="div_side_menu">

<? $view_profilebyid_text = 'View Profile by id'; ?>
<div style="padding-top:12px; order:#00FF00 1px solid; width:172px; float:left;">
 <table width="172"  border="0"  cellspacing="0" cellpadding="0" class="menuinnerbg">
    <form name="frmProfile_view" method="get"  action="view_member_profile.php">
	
    
    
    
    
    
	<? if($_SESSION['franchisee_id']!=""){ ?>
			   <tr><td height="25" bgcolor="#e68800" style="padding-left:5px;"><strong style="color:#fbf7d1;">Franchise Services</strong></a></td></tr>
			   <tr><td height="2" bgcolor="#fff9d4"></td></tr>   
			   <tr><td><a href="<? echo $urlpath;?>franchise_upgrade_member.php"  class="submenuinner" >Upgrade membership</a></td></tr>
			   <tr><td><a href="<? echo $urlpath;?>view_franchise_upgrade_report.php?franchise_auto_id=<? echo $_SESSION['franchisee_id'];?>&franchise_id=<? echo $_SESSION['franchisee_reg_id'];?>"  class="submenuinner" >View Upgrade report</a></td></tr>						
			   <tr><td><a href="#"  class="submenuinner" onclick="javascript:poptastic('chat/php121im.php?uname=<? echo $_SESSION['franchise_username'];?>&upass=<? echo $_SESSION['franchise_password']; ?>');">Chat</a></td></tr>
			   <tr><td><a href="<? echo $urlpath;?>franchise_account.php"  class="submenuinner">My Account</a></td></tr>			   
			   <tr><td><a href="<? echo $urlpath;?>franchise_changepassword.php"  class="submenuinner">Change Password</a></td></tr>
			   <tr><td><a href="<? echo $urlpath;?>logout.php?mode=franchise" class="submenuinner" >Logout</a></td></tr>	
 <? } ?>	
  <? if (($config[userinfo])&&($_SESSION['franchisee_id']=="")) { ?>	
  	
  <tr><td height="25" bgcolor="#e68800">&nbsp;<strong style="color:#fbf7d1;">My Profile</strong></a></td></tr>
  <tr><td height="2" bgcolor="#fff9d4"></td></tr>
  <script>
  	//alert('<?=$pfile?>');
  </script>
  
  <tr><td><a href="<? echo $urlpath;?>partner_match.php" class="submenuinner">My Matches</a></td></tr>
  <tr><td><a href="<? echo $urlpath;?>express_interest.php?action=received" class="submenuinner">Interest Received</a></td></tr>
  <tr><td><a href="<? echo $urlpath;?>express_interest.php?action=sent" class="submenuinner">Interest Sent</a></td></tr>
  <tr><td><a href="<? echo $urlpath;?>view_bookmark.php" class="submenuinner">View Book mark</a></td></tr>
  <tr><td><a href="<? echo $urlpath;?>edit_my_profile.php" class="submenuinner">Modify Profile</a></td></tr>
  <tr><td><a href="<? echo $urlpath;?>edit_my_profile.php?action1=lookingfor" class="submenuinner">Set Partner Preferences</a></td></tr>
  <? if ($pfile != 'my_matrimony.php') { ?>
  <tr><td><a href="<? echo $urlpath;?>edit_my_profile.php?action1=occupation&cursor=phone" class="submenuinner">Change Phone No</a></td></tr>
  <? } ?>
  
 <?php /*?> <? if ($pfile != 'my_matrimony.php') { ?>
  <tr><td><a href="<? echo $urlpath;?>edit_my_profile.php?action1=occupation&cursor=phone" class="submenuinner">Change Phone No</a></td></tr>
  <? } ?><?php */?>
  <tr><td><a href="<? echo $urlpath;?>payment.php" class="submenuinner">Payment Option</a></td></tr>
  <tr><td><a href="<? echo $urlpath;?>delete_profile.php" class="submenuinner">Hide/Delete Profile</a></td></tr>
  
  <tr><td><a href="<? echo $urlpath;?>logout.php?mode=member" class="submenuinner">Logout</a></td></tr>
  
 <?php /*?> <tr><td valign="center" height="25">&nbsp;&nbsp;&nbsp
	  <input name="userid" type="text" value="View Profile by id" onfocus="this.value='';"  onclick="this.value='';"  class="mailbox" />&nbsp;&nbsp;<img src="images/btn_go.jpg" onClick="return profile_validate();" style="cursor:pointer;"  border="0" align="absmiddle"/>
  </td></tr> <?php */?>
  <? } 
   //if ($pfile == 'Userhoro1.PHP' || $pfile =='Userhoro_compare.php' || $pfile =='Daily_Prediction.php') { ?>

 
  
  <?
   // }

   if ($_SESSION['franchisee_id']=="") { ?>
  <tr><td height="25" bgcolor="#e68800">&nbsp;<strong style="color:#fbf7d1;">Matrimony Services</strong></a></td></tr>  
  <tr><td height="2" bgcolor="#fff9d4"></td></tr>  
  <? if (!$config[userinfo]) { ?>
  <tr><td height="25"><a href="<? echo $urlpath;?>my_matrimony.php" class="submenuinner">&nbsp;My matrimony</a></td></tr>
  <? } ?>
  <tr><td><a href="<? echo $urlpath;?>wedding_directory.php" class="submenuinner">Wedding Directory</a></td></tr>
  <tr><td><a href="<? echo $urlpath;?>franchise_login.php" class="submenuinner">Franchise</a></td></tr> 
  <tr><td><a href="<? echo $urlpath;?>franchise_search.php" class="submenuinner">Franchise Search</a></td></tr>   
  <? if (!$config[userinfo]) { ?>
  <tr><td><a href="<? echo $urlpath;?>payment.php" class="submenuinner">Payment Option</a></td></tr>
  <tr><td><a href="<? echo $urlpath;?>member_login.php" class="submenuinner">Member Login</a></td></tr>
  <tr><td><a href="<? echo $urlpath;?>register.php" class="submenuinner">Register Free</a></td></tr>
  <? } ?>  
  <tr><td><a href="<? echo $urlpath;?>successful_stories.php" class="submenuinner">Successful Stories</a></td></tr>
  
  
  <tr><td><a href="<? echo $urlpath;?>contact_us.php" class="submenuinner">Contact Us</a></td></tr>
  <? if (!$config[userinfo]) { ?>
   <?php /*?> 
  <tr><td valign="center" eight="35">&nbsp;&nbsp;&nbsp
	  <input name="userid" type="text" value="View Profile by id" onfocus="this.value='';" onclick="this.value='';" class="mailbox" />&nbsp;&nbsp;<img src="images/btn_go.jpg" onClick="return profile_validate();" style="cursor:pointer;"  border="0" align="absmiddle"/>
  </td></tr> <?php */?>
  <? }  }?>
	</form>
</table>
<div style="padding-top:5px; order:#00FF00 1px solid; "></div> 
<table width="172" border="0"  cellspacing="0" cellpadding="0" style="border:#e1c179 solid 1px;">
		<form name="searchForm" method="get" action="<? echo $urlpath;?>search.php" onSubmit="return fnValidateSearch('<?=$val1?>');">
		<input type="hidden" name="action" value="search" />
		<tr><td bgcolor="#fee19f" height="35" style="padding-left:7px;"><h4 class="intitle">Partner Search</h4></td></tr>
	  <tr><td bgcolor="#fee19f" height="25" class="inselect">
			
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
		  <td bgcolor="#fee19f" height="35" class="inselect"> &nbsp;				
			
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
				<option value="<?=$i?>" <? if ($i == 35) { ?> selected <? } ?>><?=$i?></option>
				<? } ?>
			</select>							</td>
	 </tr>
	 <tr><td bgcolor="#fee19f" height="35" class="inselect">&nbsp;
	 with photo<input name="withPhoto" type="checkbox" value="0">
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
</div>