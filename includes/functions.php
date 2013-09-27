<?php
ob_start();
session_start();
//include("urlpath.php");
	
	
		function isAdmin(){
			if ($_SESSION['_user'] == "") {
				header("Location:index.php");
				die();
			}
		}
		function isMember() {
		
			global $config;
			
			if($_SESSION['userid'] == "") {	
				//$_SESSION['_msg'] = "Session has expired";			
				header("Location: ../member_login.php");
				die();
			} else {				
				
			}
		}	
		
		function GetBookMarkedProfiles($id) {
		
			$sql = "select * from tbl_bookmark where userid = '" . $id . "'";
			$res = Execute($sql);
			
			$id = array();
			if (mysql_num_rows($res) > 0) {				
				while ($bookmarkRes = mysql_fetch_array($res)) {					
					array_push($id,$bookmarkRes[bookmarked_id]);					
				}
			}
			
			if ($id) {
				return implode(",",$id);
			} else {
				return 0;
			}
		}
		
		function GetCountry() {
		
			$res = Execute("select * from tbl_country_master order by country");
			if (mysql_num_rows($res) > 0) {
				while ($country = mysql_fetch_array($res)) {
					echo "<option value=".$country[id].">" . $country[country]."</option>";
				}	
			}			
		}
		
		function GetCountry1() {
		
			$res = Execute("select * from tbl_country_master order by country");
			if (mysql_num_rows($res) > 0) {
				while ($country = mysql_fetch_array($res)) {
					$str .= "<option value=".$country[id].">" . $country[country]."</option>";
				}	
			}
			return $str;			
		}
		
		function GetOccupation() {
			echo "<option value=\"\">--Select Occupation--</option>";
			$res = Execute("select * from tbl_occupation_master order by occupation");
			if (mysql_num_rows($res) > 0) {
				while ($occupation_res = mysql_fetch_array($res)) {
					echo "<option value=\"" . $occupation_res[id] . "\">" . $occupation_res[occupation] . "</option>";
				}	
			}			
		}
		
		function FillReligion() {
			
			$resReligion = Execute("select * from tbl_religion_master group by religion");
			
			if (mysql_num_rows($resReligion) > 0 ) {				
				while ($religion = mysql_fetch_array($resReligion)) { ?>
					<option value="<?=$religion[id]?>"><?=$religion[religion]?></option>
			<?	}
			}			
		}
		
		function FillCaste() {
			
			$resDomain = Execute("select * from tbl_domain_master");
			
			if (mysql_num_rows($resDomain) > 0 ) {
			
				while ($domain = mysql_fetch_array($resDomain)) {
				
					$resReligion = Execute("select * from tbl_religion_master where domain = '" . $domain[id] . "'");
					if (mysql_num_rows($resReligion) > 0) {
						while ($religion = mysql_fetch_array($resReligion)) {
							$resCaste = Execute("select * from tbl_caste_master where religionid = '" . $religion[id] . "'");
							if (mysql_num_rows($resCaste) > 0) {
								while ($caste = mysql_fetch_array($resCaste)) { ?>
									<option value="<?=$caste[id]?>"><?=$domain[domain_prefix] . "-" . $caste[caste]?></option>
							<?	}
							}
						}
					}	   		
				}	
			}			
		}
		
		function isPartnerPreferenceNotCompleted($id) { 
		
			$arr_partnerPreference = array (
				"partnerDomain",
				"ageFrom",
				"ageTo",
				"partnerMaritalStatus",
				"partnerHaveChild",
				"partnerHeightFrom",
				"partnerHeightTo",
				"partnerPhysicalStatus",
				"partnerMotherTongue",
				"aboutLifePartner",
				"partnerEducation",
				"partnerCitizenship",
				"partnerCountryLiving",
				"partnerResidingState",
				"partnerReligion",
				"partnerCaste",
				"partnerSevvaiDosham",
				"partnerEatingHabits",							
			);
			$partnerPref_notcompleted = true;
			for ($i = 0; $i < count($arr_partnerPreference); $i++) {
				if (GetSingleField($arr_partnerPreference[$i],"tbl_register","id",$id)) {
					unset($partnerPref_notcompleted);
					break;
				}
			}
			return $partnerPref_notcompleted;
		}
		
		function GetState() {
			
			$resstate = Execute("select * from tbl_state_master order by id");
			if (mysql_num_rows($resstate) > 0) { 
				while ($stateMaster = mysql_fetch_array($resstate)) {
					echo "<option value=\"" . $stateMaster[id] . "\">" . $stateMaster[state] ."</option>";					
				}
			}	
		}		
		
		function GetCountryVsState() {
			
			$resstate = Execute("select * from tbl_state_master order by id");
			if (mysql_num_rows($resstate) > 0) { 
				while ($stateMaster = mysql_fetch_array($resstate)) {
					echo "<option value=\"" . $stateMaster[id] . "\">" . $stateMaster[country] ."</option>";					
				}
			}	
		}	
		
		function GetStateInIndia() {
			
			$resstate = Execute("select * from tbl_state_master where country in (select id from tbl_country_master where country = 'India') order by id");
			if (mysql_num_rows($resstate) > 0) { 
				while ($stateMaster = mysql_fetch_array($resstate)) {
					echo "<option value=\"" . $stateMaster[id] . "\">" . $stateMaster[state] ."</option>";					
				}
			}
		}
		
		function GetCity() {
		
			$resCity = Execute("select * from tbl_city_master order by id");
			if (mysql_num_rows($resCity) > 0) { 
				while ($cityMaster = mysql_fetch_array($resCity)) {
					echo "<option value=\"" . $cityMaster[id] . "\">" . $cityMaster[city] ."</option>";					
				}
			}
		}
		
		function GetStateVsCity() {
		
			$resCity = Execute("select * from tbl_city_master order by id");
			if (mysql_num_rows($resCity) > 0) { 
				while ($cityMaster = mysql_fetch_array($resCity)) {
					echo "<option value=\"" . $cityMaster[id] . "\">" . $cityMaster[stateid] ."</option>";					
				}
			}
		}
		
		
		
		function IsUserCountryInDB($country) {
			if (GetSingleRecord("tbl_country_master","id",$country)) {
				return true;	
			} else {
				return false;
			}			
		}
		
		function IsUserStateInDB($state) {
			if (GetSingleRecord("tbl_state_master","id",$state)) {
				return true;	
			} else {
				return false;
			}			
		}
		
		function IsUserCityInDB($city) {
		
			if (GetSingleRecord("tbl_city_master","id",$city)) {
				return true;	
			} else {
				return false;
			}			
		}
		
		function isFranchise() {
		
			if($_SESSION['franchisee_id'] == "") {
				header("Location:franchise_login.php");
				die();				
			}
		}
		
		function DOB2Age($year,$date,$month) {
		
			if ($year && $date && $month) {
				$year_diff  = date("Y") - $year;
				$month_diff = date("m") - $month;
				$day_diff   = date("d") - $date;
				if (($month_diff < 0 && date("m") != $month) || (date("m") == $month  && $day_diff < 0)) {
					$year_diff = $year_diff - 1;					
				} else {
					$year_diff = $year_diff;
				}				  
				return $year_diff;
			}			
		}
		
		function MemberLogin($params) {

			$member = GetSingleRecord("tbl_register","username",$params[username]);
			
			if (!$member) {
				$member = GetSingleRecord("tbl_register","email",$params[username]);
			}
			
			if ($member) {					
				if ($member[password] == $params[password]) {				
					if (isStillMember($member[package_expiry_date])) {					
						if (!$member[deleteProfile]) {			
						
							$_SESSION['userid'] = $member['username'];
							$_SESSION['id_user'] = $member['id'];
							$_SESSION['member_unique_id']=$member['uniqueID'];
							$_SESSION['member_name']=$member['name'];
							$_SESSION['name'] = $member['name'];
							$LostLogin = date("Y-m-d G:i:s");					
							$res = Execute("update tbl_register set lastLogin = '$LostLogin' where id = '" . $_SESSION['id_user'] . "'");						
							if ($params[link1] == 'package') {								
								header("Location:upgrade_membership.php?package_id=".$params[packid]);
							} else if ($params[link1] == 'bookmark') {								
								header("Location:forward_profile.php?action=".$params[action]."&id=".$params[id]."&mode=".$params[mode]);
							} else if ($params[link1] == 'express_interest') {
								header("Location:send_express_interest.php?action=".$params[action]."&id=".$params[id]."&mode=".$params[mode]);
							} else {
								header("Location:my_matrimony.php");
							}							
							die();
							
						} else { $msg = "Sorry your Profile is deleted. To<br> restore your profile plz contact<br> admin with in 10 days after<br> profile deleted"; }	
						
					} else { $msg = "Sorry your membership is expired"; }
					
				} else { $msg = "Invalid Password"; }	
				
			} else { $msg = "Invalid username"; }	
			$_SESSION['_msg'] = $msg;
			header("Location: member_login.php?action=".$params[action]."&id=".$params[id]."&mode=".$params[mode]."&link1=".$params[link1]);
			die();
		}
		
		function contactMember($memberid,$mode) {
			
			global $config;
			
			$contact = GetSingleRecord("tbl_register","id",$memberid);
			
			$login = 1;
			
			$user = GetSingleRecord("tbl_register","id",$config[userinfo][id]);						
			
			if ($user) {
			
				if (isStillMember($user[package_expiry_date])) {							
								
					if ($user[membership_type] && $user[membership_type] != "1") {
					
						$res1 = Execute("select * from tbl_contact_view where userid = '" . $user[id] . "' and profile_id = '$memberid' and mode='$mode'");						
						if (mysql_num_rows($res1) > 0) {
						
							$rs1 = mysql_fetch_array($res1);									
							
							if ($rs1[mode] == $mode) {								
								$res3 = Execute("update tbl_contact_view set no_of_viewed = no_of_viewed+1 where userid = '" . $user[id] . "' and profile_id = '$memberid' and mode = '$mode'");								
							} else {								
								$res = Execute("insert into tbl_contact_view(userid,profile_id,no_of_viewed,mode) values('" . $user[id] . "','" . $memberid . "','1','$mode')");								
							}	
						?>
							<script language="javascript">
								location.href = "member_verify.php?mode=<?=base64_encode($mode);?>&action=<?=base64_encode("cantact");?>&id=<?=base64_encode($memberid)?>";
							</script>
						<?	
											
						} else {
						
							if ($mode)	{
							
								$mode1 = $mode . "_allowed";
								
								if ($user["$mode1"] > 0) {	
																			
									$res = Execute("insert into tbl_contact_view(userid,profile_id,no_of_viewed,mode) values('" . $user[id] . "','" . $memberid . "','1','$mode')");
									$res2 = Execute("update tbl_register set $mode1 = '" . ($user["$mode1"] - 1) . "' where id = '" . $user[id] . "'");									
								}	
							} 
							/*else if ($mode == "phone") {
								if ($user[phone_allowed] > 0) {
									$res = Execute("insert into tbl_contact_view(userid,profile_id) values('" . $user[id] . "','" . $memberid . "')");
									$res2 = Execute("update tbl_register set phone_allowed = '" . ($user[phone_allowed] - 1) . "' where id = '" . $user[id] . "'");
								}
							}*/	
							?>
							<script language="javascript">
								location.href = "member_verify.php?mode=<?=base64_encode($mode);?>&action=<?=base64_encode("cantact");?>&id=<?=base64_encode($memberid)?>";
							</script>
							<?							
						}
						
					} else {
						?>
							<script language="javascript">
								location.href = "member_verify.php?mode=<?=base64_encode($mode);?>&action=<?=base64_encode("cantact");?>&id=<?=base64_encode($memberid)?>";
							</script>
							<?
					}
				} else {						
				 ?>
					<script language="javascript">
						location.href = "member_verify.php?mode=<?=base64_encode($mode);?>&action=<?=base64_encode("cantact");?>&id=<?=base64_encode($memberid)?>";
					</script>						
			<?	}
			} else { ?>
				<script language="javascript">
					location.href = "member_verify.php?mode=<?=base64_encode($mode);?>&action=<?=base64_encode("cantact");?>&id=<?=base64_encode($memberid)?>";
				</script>
		<?	}							
			
		}
		
		function GetProfile($id) {
		
			global $config;
			
			$member = GetSingleRecord("tbl_register","id",$id);
			
			$body = '<html>';
			$body .= '<link href="'.$config["siteurl"].'/includes/style.css" rel="stylesheet" type="text/css"/>';
			$body .= '<body>';
			$body .= '<table width="100%"><tr><td>&nbsp;</td></tr>';			
			$body .= '<tr><td>';
			$body .= '<div tyle="float:left; padding:10px 0px 0px 10px;">
					  <table border="0" width="600" align="center" cellspacing="0" cellpadding="0" style=" border:#b54343 solid 1px;" class="story"><tr><td>MSG</td></tr></table>	
					  <table border="0" width="600" align="center" cellspacing="0" cellpadding="0" style=" border:#b54343 solid 1px;" class="story">					  
			          <tr><td width="3%" rowspan="9">			
					  <div class="photo" align="center">';
					  						
			$resPhoto = Execute("select * from tbl_photo where userid = '". $member[id] ."' and approve = '1' ");
				
			if (mysql_num_rows($resPhoto) > 0) {
				
				$memPhoto = mysql_fetch_array($resPhoto);
				if ($member[photo_password]) { 
					$body .= '<img src="'.$config["siteurl"].'/images/protectedphoto.gif" hspace="5" style="cursor:pointer" width="75" height="75">';						
				} else {						 										
					$body .= '<img id="user'.$member[id].'" name="user'.$member[id].'" src="'.$config["siteurl"].'/userthumbnail/'.$memPhoto[photo].'" hspace="5" style="cursor:pointer" width="75" height="75">';												
				}					
			} else { 
			
				$body .= '<img src="'.$config["siteurl"].'/images/nopicture.png" hspace="5" width="75" height="75"/>';						
			}
			
			if ($member[horoscope]) {
				$body .= '<br><a href="'.$config["siteurl"].'/member_verify.php?action=' . base64_encode("horoscope") . '&id=' . base64_encode($member[id]) .'" class="mored" target="_blank"><b>View Horoscope</b></a>';
			}
			$year = substr($member[date_of_birth],0,4);
			$month = substr($member[date_of_birth],5,2);
			$date = substr($member[date_of_birth],8,2);	
			$body .= '</div>
					  </td>		
     				  </tr>
					  <tr><td><a href="'.$config["siteurl"].'/view_member_profile.php?userid=' . $member[username] . '" class="memberid">' . $member[username] . '</a>&nbsp;&nbsp;	  
					  </td>
					  <td>&nbsp;</td>
					  </tr>
					  <tr>
					  <td class="searchup"><b>Age:</b> </td>
					  <td class="searchup">' . DOB2Age($year,$date,$month) . ' Yrs</td>
					  </tr>
					  <tr>
					  <td class="searchup"><b>Height:</b> </td>
			          <td class="searchup">' . $member[height] . ' ft</td>
					  </tr>
					  <tr>
                      <td class="searchup"><b>Religion:</b> </td>
                      <td class="searchup">';
			$mem_religion = GetSingleField("religion","tbl_religion_master","id",$member[religion]);
			$body .= $mem_religion;	
			
			if ($member[caste]) {
				$body .= ',' . GetSingleField("caste","tbl_caste_master","id",$member[caste]);
			}
							
			if ($member[gothram]) {
				$body .= ',' . $member[gothram];
			}
							
			$body .= '</td>
			  	      </tr>
				      <tr>
					  <td class="searchup"><b>Star:</b> </td>
					  <td class="searchup">' . $member[star] . '</td>
				      </tr>
				      <tr>
					  <td class="searchup"><b>Location:</b> </td>
					  <td class="searchup">';
				
			if ($member[city]) {
				$body .= GetSingleField("city","tbl_city_master","id",$member[city]) . ', ' ;						
			}
			
			if ($member[state]) {
				$body .= GetSingleField("state","tbl_state_master","id",$member[state]) . ', ';
			}
			
			if ($member[country]) {
				$body .= GetSingleField("country","tbl_country_master","id",$member[country]);
			}
								
			$body .= '</td>
                      </tr>
		  			  <tr>
					  <td class="searchup"><b>Education:</b> </td>
					  <td class="searchup">';				
			$mem_education = GetSingleField("education","tbl_education_master","id",$member[education]);
			$body .= $mem_education;	
			
			if ($member[educationDetail]) {
				$body .= "," . $member[educationDetail];
			}
			
			$body .= '</td>
					  </tr>
					  <tr>
					  <td class="searchup"><b>Occupation:</b> </td>
					  <td class="searchup">';
			$mem_occupation = GetSingleField("occupation","tbl_occupation_master","id",$member[occupation]);
			$body .= $mem_occupation;
			
			if ($member[occupationDetail]) {
				$body .= ',' . $member[occupationDetail];
			}
			
			$body .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$config["siteurl"].'/view_member_profile.php?userid=' . $member[username] . '" class="mored" arget="_blank"><b>more details...</b></a></td>
			          </tr>
					  <tr>
					  <td height="21" bgcolor="#fbd153"  colspan="2">&nbsp; Resent Login: ' .strftime("%d %b %Y",strtotime($member[lastLogin])) .'</td>
					  <td bgcolor="#fbd153" align="right">&nbsp;&nbsp;</td>
					  </tr>
					  </table>
					  </div>';
			$body .= '</td></tr></table>';	
			$body .= '</body></html>';
			return $body;
		}
		
		
		function GetForwardProfile($id) {
		
			global $config;
			
			$member = GetSingleRecord("tbl_register","id",$id);
			
			$body =	'<table border="0" width="600" align="center" cellspacing="0" cellpadding="0" style=" border:#b54343 solid 1px;" class="story">					  
			          <tr><td width="3%" rowspan="9">			
					  <div class="photo" align="center">';
					  						
			$resPhoto = Execute("select * from tbl_photo where userid = '". $member[id] ."' and approve = '1' ");
				
			if (mysql_num_rows($resPhoto) > 0) {
				
				$memPhoto = mysql_fetch_array($resPhoto);
				if ($member[photo_password]) { 
					$body .= '<img src="'.$config["siteurl"].'/images/protectedphoto.gif" hspace="5" style="cursor:pointer" width="75" height="75">';						
				} else {						 										
					$body .= '<img id="user'.$member[id].'" name="user'.$member[id].'" src="'.$config["siteurl"].'/userthumbnail/'.$memPhoto[photo].'" hspace="5" style="cursor:pointer" width="75" height="75">';												
				}					
			} else { 
			
				$body .= '<img src="'.$config["siteurl"].'/images/nopicture.png" hspace="5" width="75" height="75"/>';						
			}
			
			if ($member[horoscope]) {
				$body .= '<br><a href="'.$config["siteurl"].'/member_verify.php?action=' . base64_encode("horoscope") . '&id=' . base64_encode($member[id]) .'" class="mored" target="_blank"><b>View Horoscope</b></a>';
			}
			$year = substr($member[date_of_birth],0,4);
			$month = substr($member[date_of_birth],5,2);
			$date = substr($member[date_of_birth],8,2);					
			$body .= '</div>
					  </td>		
     				  </tr>
					  <tr><td><a href="'.$config["siteurl"].'/view_member_profile.php?userid=' . $member[username] . '" class="memberid">' . $member[username] . '</a>&nbsp;&nbsp;	  
					  </td>
					  <td>&nbsp;</td>
					  </tr>
					  <tr>
					  <td class="searchup"><b>Age:</b> </td>
					  <td class="searchup">' . DOB2Age($year,$date,$month) . ' Yrs</td>
					  </tr>
					  <tr>
					  <td class="searchup"><b>Height:</b> </td>
			          <td class="searchup">' . $member[height] . ' ft</td>
					  </tr>
					  <tr>
                      <td class="searchup"><b>Religion:</b> </td>
                      <td class="searchup">';
			$mem_religion = GetSingleField("religion","tbl_religion_master","id",$member[religion]);
			$body .= $mem_religion;	
			
			if ($member[caste]) {
				$body .= ',' . GetSingleField("caste","tbl_caste_master","id",$member[caste]);
			}
							
			if ($member[gothram]) {
				$body .= ',' . $member[gothram];
			}					
			$body .= '</td>
			  	      </tr>
				      <tr>
					  <td class="searchup"><b>Star:</b> </td>
					  <td class="searchup">' . $member[star] . '</td>
				      </tr>
				      <tr>
					  <td class="searchup"><b>Location:</b> </td>
					  <td class="searchup">';
				
			if ($member[city]) {
				$body .= GetSingleField("city","tbl_city_master","id",$member[city]) . ', ' ;						
			}
			
			if ($member[state]) {
				$body .= GetSingleField("state","tbl_state_master","id",$member[state]) . ', ';
			}
			
			if ($member[country]) {
				$body .= GetSingleField("country","tbl_country_master","id",$member[country]);
			}
								
			$body .= '</td>
                      </tr>
		  			  <tr>
					  <td class="searchup"><b>Education:</b> </td>
					  <td class="searchup">';				
			$mem_education = GetSingleField("education","tbl_education_master","id",$member[education]);
			$body .= $mem_education;	
			
			if ($member[educationDetail]) {
				$body .= "," . $member[educationDetail];
			}
			
			$body .= '</td>
					  </tr>
					  <tr>
					  <td class="searchup"><b>Occupation:</b> </td>
					  <td class="searchup">';
			$mem_occupation = GetSingleField("occupation","tbl_occupation_master","id",$member[occupation]);
			$body .= $mem_occupation;
			
			if ($member[occupationDetail]) {
				$body .= ',' . $member[occupationDetail];
			}
			
			$body .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$config["siteurl"].'/view_member_profile.php?userid=' . $member[username] . '" class="mored" arget="_blank"><b>more details...</b></a></td>
			          </tr>
					  <tr>
					  <td height="21" bgcolor="#fbd153"  colspan="2">&nbsp; Resent Login: ' .strftime("%d %b %Y",strtotime($member[lastLogin])) .'</td>
					  <td bgcolor="#fbd153" align="right">&nbsp;&nbsp;</td>
					  </tr>
					  </table>';
					  
			return $body;
		}		
?>
