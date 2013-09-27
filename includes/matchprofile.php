<?php
	class PartnerMatch {
		static function InsertMatch($id) {
		
			$user = GetSingleRecord("tbl_register","id",$id);
			$user_match= GetSingleRecord("tbl_match_profile","userid",$id);
			
			
			//if($user[id]!=$user_match[userid]){
				//$exist = Execute("delete from tbl_match_profile where userid = '" . $user[id] . "' and deleted !=1 ");
				//$exist = Execute("delete from tbl_match_profile where userid = '" . $user[id] . "' and userid = '" . $user_match[matchid] . "' and deleted !=1 ");
				$partnerPref_notcompleted = isPartnerPreferenceNotCompleted($id);			

				if (!$partnerPref_notcompleted) {	
				
					$isdomainany = false;		

					$sql = "select id from tbl_register where 1 = 1 and id != '" . $user[id] . "' and enable = 1 and verifiedStatus = 1 and hideProfile = 0 and deleteProfile = 0 and gender != '" . $user[gender] . "' ";					
					if ($user[partnerDomain]) {
						$usrField = explode(",",$user[partnerDomain]);
						if ($usrField[0] != 0) {		
							$sql .= "and domain in (" . $user[partnerDomain] .") ";		
						}elseif($usrField[0] == 0) {
							$usrField = explode(",",$user[partnerReligion]);
							if ($usrField[0] != 0) {
								$sql_chk="select * from tbl_religion_master where id in ('".$user[partnerReligion]."') group by religion";
								$res_chk=mysql_query($sql_chk);
								$reg_id=array();
								while($rs_chk=mysql_fetch_object($res_chk)){
									$res2 = mysql_query("select * from tbl_religion_master where religion = '" .$rs_chk->religion. "'");
									if (mysql_num_rows($res2) > 0) {
										while ($rs2 = mysql_fetch_array($res2)) {
											array_push($reg_id,$rs2[id]);
										}	
									}																		
								}
								if (count($reg_id)>0) {
									$sql .= "and religion in ('" . implode("','",$reg_id) . "') ";
									$isdomainany = true;
								}	
							}
						}
					}	else {

						$usrField = explode(",",$user[partnerReligion]);
						if ($usrField[0] != 0) {
							$sql_chk="select * from tbl_religion_master where id in (".$user[partnerReligion].") group by religion";
							$res_chk=mysql_query($sql_chk);							
							$reg_id=array();
							while($rs_chk=mysql_fetch_object($res_chk)){								
								//echo ("select * from tbl_religion_master where religion = '" .$rs_chk->religion. "'");
								$res_religion = mysql_query("select * from tbl_religion_master where religion = '" .$rs_chk->religion. "'");
								if (mysql_num_rows($res_religion) > 0) {
									while ($rs_religion = mysql_fetch_array($res_religion)) {
										array_push($reg_id,$rs_religion[id]);
									}	
								}																		
							}
							if (count($reg_id)>0) {
								$sql .= "and religion in ('" . implode("','",$reg_id) . "') ";
								$isdomainany = true;
							}	
						}						
					}
				
					if ($user[ageFrom] && $user[ageTo]) {				
						$sql .= "and age >= '" . $user[ageFrom] . "' and age <= '" . $user[ageTo] . "' ";					
					}
				 
					if ($user[partnerMaritalStatus]) {
					
						$usrField = explode(",",$user[partnerMaritalStatus]);
						$partnerMaritalStatus = implode("','",$usrField);
						if ($usrField[0] != "unspec") {
							$sql .= "and maritalStatus in ('" . $partnerMaritalStatus . "') ";	
						}	
					}	
				
					if ($user[partnerEducation]) {
						
						$usrField = explode(",",$user[partnerEducation]);
						if ($usrField[0] != 0) {			
							//$sql .= "and education in ('" .. "') ";
							$sql .= "and education in ('" . $user[partnerEducation] . "') ";
						}	
					}	
				
					if ($user[partnerCitizenship]) {
				
						$usrField = explode(",",$user[partnerCitizenship]);		
						$partnerCitizenship = implode("','",$usrField);
						if ($usrField[0] != "unspec") {
							$sql .= "and citizenship in ('" . $partnerCitizenship . "') ";
						}	
					}
					
					if ($user[partnerResidingCountry]) {
						
						$usrField = explode(",",$user[partnerResidingCountry]);		
						$partnerResidingCountry = implode("','",$usrField);
						if ($usrField[0] != 0) {
							$sql .= "and (residingCountry in ('" . $partnerResidingCountry . "') or residingCountry_1 in ('" . $partnerResidingCountry . "')) ";
						}	
					}
				
					if ($user[partnerResidingState]) {
					
						$usrField = explode(",",$user[partnerResidingState]);	
						$partnerResidingState = implode("','",$usrField);
						if ($usrField[0] != 0) {
							$sql .= "and (residingState in ('" . $partnerResidingState . "') or residingState_1 in ('" . $partnerResidingState . "')) ";
						}	
					}
				
					if ($user[partnerResidingCity]) {
					
						$usrField = explode(",",$user[partnerResidingCity]);	
						$partnerResidingCity = implode("','",$usrField);
						if ($usrField[0] != 0) {
							$sql .= "and (residingCity in ('" . $partnerResidingCity . "') or residingCity_1 in ('" . $partnerResidingCity . "')) ";
						}	
					}
				
					if ($user[partnerReligion] && !$isdomainany) {
					
						$usrField = explode(",",$user[partnerReligion]);
						//$pReligion = explode(",",$user[partnerReligion]);
						if ($usrField[0] != 0) {		
							$sql .= "and religion in ('" . implode("','",$usrField) . "') ";
						}	
					}
				
					if ($user[partnerCaste]) {
				
						$usrField = explode(",",$user[partnerCaste]);
						if ($usrField[0] != 0) {		
							$sql .= "and caste in ('" . implode("','",$usrField) . "') ";
						}	
					} 
				
					if ($user[partnerHaveChild] && $user[partnerHaveChild] != 'unspec') {
				
						$partnerHaveChild = $user[partnerHaveChild];
						if ($partnerHaveChild == "no") {
							$sql .=	"and (no_of_Children = '' or (isnull(no_of_Children)) or no_of_Children = 'None') ";	
						} else if ($partnerHaveChild == "yes") {
							$sql .= "and (no_of_Children = '1' or no_of_Children = '2' or no_of_Children = '3' or no_of_Children = '4 and above') ";
						} else {
							$sql .= "and no_of_children = '$partnerHaveChild' ";
						}
					}
				
					if ($user[partnerPhysicalStatus]) {
				
						$physicalStatus = $user[partnerPhysicalStatus];
						if ($physicalStatus) {	
							if ($physicalStatus == "Normal") {
								$sql .= "and (physicalStatus = '$physicalStatus' or  (isnull(physicalStatus) or physicalStatus = '')) ";
							} else {
								$sql .= "and physicalStatus = '$physicalStatus' ";	
							}		
						}
					
					}
				
					if ($user[partnerMotherTongue]) {	
						$sql .= "and language = '" . $user[partnerMotherTongue] . "' ";	
					}
				
					if ($user[partnerHeightFrom] && $user[partnerHeightTo]) {
						$sql .= "and height >= '" . $user[partnerHeightFrom] . "' and height <= '" . $user[partnerHeightTo] . "' ";	
					}
				
					if ($user[partnerSevvaiDosham]) {
				
						if ($user[partnerSevvaiDosham] == 1) {
							$sql .= "and sevvaiDosham = '1' ";
						} else {
							if ($user[partnerSevvaiDosham] == 2) {
								$sql .= "and (sevvaiDosham = '2' or sevvaiDosham = '3') ";
							}	
						}	
					}
				
					if ($user[partnerEatingHabits]) {
				
						if ($user[partnerEatingHabits] == "Vegetarian") {
							$sql .= "and eatingHabits = 'Vegetarian' ";
						} else {
							if ($user[partnerEatingHabits] == "Non Vegetarian") {	
								$sql .= "and (eatingHabits = 'Non Vegetarian' or eatingHabits = 'Doesn\'t matter') ";
							} 
						}
					}					
				
//					die();
					
					$searchMaxRows = Execute($sql);
					
					print '<!--';
					print $sql;					
					print '-->';
//					$test =  "select id from tbl_register where 1 = 1 and id != '198' and enable = 1 and verifiedStatus = 1 and hideProfile = 0 and deleteProfile = 0 and gender != 'F' and age >= '18' and age <= '70' and (physicalStatus = 'Normal' or (isnull(physicalStatus) or physicalStatus = '')) and height >= '4.5' and height <= '7.1' and language = 'Assamese'";
					//$test2 = "select id from tbl_register where 1 = 1 and id != '198' and enable = 1 and verifiedStatus = 1 and hideProfile = 0 and deleteProfile = 0 and gender != 'F' and age >= '18' and age <= '70' and (no_of_Children = '' or (isnull(no_of_Children)) or no_of_Children = 'None') and (physicalStatus = 'Normal' or (isnull(physicalStatus) or physicalStatus = '')) and language = 'Assamese' and height >= '4.5' and height <= '7.1'";
					//$row = Execute($sql);
					//echo mysql_num_rows($searchMaxRows);
				//	die("aasd");
					if (mysql_num_rows($searchMaxRows) > 0) {
						while ($matchRes = mysql_fetch_array($searchMaxRows)) {
							$exist = Execute("select * from tbl_match_profile where userid = '" . $user[id] . "' and matchid = '" . $matchRes[id] . "' and deleted='1'");
							if (mysql_num_rows($exist) > 0) {
								//die("");
							} else {	
								//echo "insert into tbl_match_profile(userid,matchid) values('" . $user[id] . "','" . $matchRes[id] . "')";
								//die("");						
								$res = Execute("insert into tbl_match_profile(userid,matchid) values('" . $user[id] . "','" . $matchRes[id] . "')");
							}						
						}
					}
				
				}			
			//}
		}
		
		function SendMailPartnerMatch($id) {
		
			global $config;	
				
			$sql = "select * from tbl_match_profile where userid = '" . $id . "' and mailSent = 0";
			$res = Execute($sql);					
			
			if (mysql_num_rows($res) > 0) {				
				
				while ($matchRes = mysql_fetch_array($res)) { 					
					$this->MailProfile($id,$matchRes[matchid]);				
				}	
			}			
		}
		
		function MailProfile($id,$partner) {
		
			global $config;
			
			$user = GetSingleRecord("tbl_register","id",$id);
			$member = GetSingleRecord("tbl_register","id",$partner);
			
			if ($member) {
			
				$body = GetProfile($member[id]);
				$msg = 'Dear ' . $user[name] . ',<br><br>The profile with this mail will be match to you.  Please find the profile for further details.';
				$body = str_replace("MSG",$msg,$body);
				$subject = 'Matches profile from newindamatrimony.com';						
				send_mail($user[email],$config["admin_email"],$subject,$body);
				
				$res = Execute("update tbl_match_profile set mailSent = '1' where userid = '" . $user[id] . "' and matchid = '" . $member[id] . "'");
			}			
		}		
		
		static function GetPartnerMatch($id) {
			$sql = "select * from tbl_match_profile where userid = '" . $id . "' and deleted = 0";
			$res = Execute($sql);
			$id = array();
			if (mysql_num_rows($res) > 0) {				
				while ($matchRes = mysql_fetch_array($res)) {					
					array_push($id,$matchRes[matchid]);					
				}
			}
			if ($id) {
				return implode(",",$id);
			} else {
				return 0;
			}			
		}
		
		function DeleteMatch($id,$matchid) {					
			
			$sql = "select * from tbl_match_profile where userid = '" . $id . "' and matchid = '$matchid'";
			$res = Execute($sql);	
			if (mysql_num_rows($res) > 0) {
				$res1 = Execute("update tbl_match_profile set deleted = '1' where userid = '" . $id . "' and matchid = '$matchid'");
			}					
		}
		function AddMatchingPartnerToTblMatchProfile($id) {
			$user = GetSingleRecord("tbl_register","id",$id);					
			$sql = "select id from tbl_register where 1 = 1 and id != '" . $user[id] . "' and enable = 1 and verifiedStatus = 1 and hideProfile = 0 and deleteProfile = 0 and gender != '" . $user[gender] . "' ";
			if ($user[partnerReligion]) {
				$sql .= "and religion in (" . $user[partnerReligion] .") ";		
			}	
			if ($user[partnerCaste]) {	
					$sql .= "and caste in (" . $user[partnerCaste] . ") ";
			} 
			if ($user[ageFrom] && $user[ageTo]) {
				$sql .= "and age >= '" . $user[ageFrom] . "' and age <= '" . $user[ageTo] . "' ";
			}
			$searchMaxRows = Execute($sql);
			if (mysql_num_rows($searchMaxRows) > 0) {
				while ($matchRes = mysql_fetch_array($searchMaxRows)) {	
					$user_match= GetSingleRecord("tbl_match_profile","userid",$user[id]);
					if(($matchRes[id]==$user_match[matchid]) and ($user_match[deleted]!="1")){
						$res_del= Execute("delete from tbl_match_profile where matchid=".$matchRes[id]." and userid=".$user[id]);
						$res = Execute("insert into tbl_match_profile(userid,matchid) values('" . $user[id] . "','" . $matchRes[id] . "')");
					}
				}	
			}
		}
	
		
	}
?>