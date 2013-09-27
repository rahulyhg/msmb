<?
ob_start();
session_start();
include("lib.php");
$year = GetVar("year");
$month = GetVar("month");
$date = GetVar("date");
$action = GetVar("action");
$domain = GetVar("domainid");
$religion_id = GetVar("religionid");

if (!$religion_id) {
	$religion_id = 0;
}

if (!$domain) {
	$domain = 0;
}
if ($domain == 0 || $domain) {
	$anyDomain1 = explode(",",$domain);
	$anyDomain1 = $anyDomain1[0];
	$anyDomain = false;
	if ($anyDomain1 == 0) {
		$anyDomain = true;	
	}
}
if ($religion_id == 0 || $religion_id) {
	$anyReligion1 = explode(",",$religion_id);
	$anyReligion1 = $anyReligion1[0];
	$anyReligion = false;
	if ($anyReligion1 == 0) {
		$anyReligion = true;	
	}
}	

if ($action == "GetReligion") {
	
	if ($anyDomain) {		
		$resReligion = Execute("select * from tbl_religion_master group by religion");
	} else {
		$resReligion = Execute("select * from tbl_religion_master where domain in ($domain) group by religion");	
	}	
	if (mysql_num_rows($resReligion) > 0 ) {
		$string = "";	
	    while ($religion = mysql_fetch_array($resReligion)) {
	   		$string .= $religion[id] . "_" . $religion[religion] . "/"; 
	    }
	}
	echo $string;
}

if ($action == "GetCaste") {

	if ($anyDomain) {		
		$resDomain = Execute("select * from tbl_domain_master");	
	} else {
		$resDomain = Execute("select * from tbl_domain_master where id in ($domain)");
	}	
	if (mysql_num_rows($resDomain) > 0 ) {
		$string = "";	
	    while ($domain = mysql_fetch_array($resDomain)) {
			$resReligion = Execute("select * from tbl_religion_master where domain = '" . $domain[id] . "'");
			if (mysql_num_rows($resReligion) > 0) {
				while ($religion = mysql_fetch_array($resReligion)) {
					$resCaste = Execute("select * from tbl_caste_master where religionid = '" . $religion[id] . "'");
					if (mysql_num_rows($resCaste) > 0) {
						while ($caste = mysql_fetch_array($resCaste)) {
							$string .= $caste[id] . "_" . $domain[domain_prefix] . "-" . $caste[caste] . "/"; 
						}
					}
				}
			}	   		
	    }
	}
	echo $string;
}

if ($action == "GetCaste1") {
	$f1 = 0;
	if ($anyReligion) {
		if ($anyDomain) {			
			$f1 = 1;
			//$resReligion = Execute("select * from tbl_religion_master");
		} else {		
			$resReligion = Execute("select * from tbl_religion_master where domain in ($domain)");
		}	
	} else {			
		$resReligion = Execute("select * from tbl_religion_master where id in ($religion_id)");
	}
	//$resReligion = Execute("select * from tbl_religion_master where id in ($religion_id)");	
	if (!$f1) {
		if (mysql_num_rows($resReligion) > 0) {
			while ($religion = mysql_fetch_array($resReligion)) {
				if ($anyDomain) {
					$resReligion1 = Execute("select * from tbl_religion_master where religion = '" . $religion[religion] . "'");
				} else {				
					$resReligion1 = Execute("select * from tbl_religion_master where domain in ($domain) and religion = '" . $religion[religion] . "'");
				}	
				if (mysql_num_rows($resReligion1) > 0) {				
					while ($religion1 = mysql_fetch_array($resReligion1)) {
						$domain1 = GetSingleRecord("tbl_domain_master","id",$religion1[domain]);						
						$resCaste = Execute("select * from tbl_caste_master where religionid = '" . $religion1[id] . "'");
						if (mysql_num_rows($resCaste) > 0) {
							while ($caste = mysql_fetch_array($resCaste)) {
								$string .= $caste[id] . "_" . $domain1[domain_prefix] . "-" . $caste[caste] . "/"; 
							}
						}
					}
				}
				mysql_free_result($resReligion1);		
			}
		}
	} else {
		if ($anyDomain) {		
			$resDomain = Execute("select * from tbl_domain_master");	
		} else {
			$resDomain = Execute("select * from tbl_domain_master where id in ($domain)");
		}	
		if (mysql_num_rows($resDomain) > 0 ) {
			$string = "";	
			while ($domain = mysql_fetch_array($resDomain)) {
				$resReligion = Execute("select * from tbl_religion_master where domain = '" . $domain[id] . "'");
				if (mysql_num_rows($resReligion) > 0) {
					while ($religion = mysql_fetch_array($resReligion)) {
						$resCaste = Execute("select * from tbl_caste_master where religionid = '" . $religion[id] . "'");
						if (mysql_num_rows($resCaste) > 0) {
							while ($caste = mysql_fetch_array($resCaste)) {
								$string .= $caste[id] . "_" . $domain[domain_prefix] . "-" . $caste[caste] . "/"; 
							}
						}
					}
				}	   		
			}
		}
	}
	
	echo $string;
}

if ($action == "GetCaste2") {

	$resDomain = Execute("select * from tbl_domain_master where id in ($domain)");
		
	if (mysql_num_rows($resDomain) > 0 ) {
		$string = "";	
	    while ($domain = mysql_fetch_array($resDomain)) {
			$resReligion = Execute("select * from tbl_religion_master where domain = '" . $domain[id] . "'");
			if (mysql_num_rows($resReligion) > 0) {
				while ($religion = mysql_fetch_array($resReligion)) {
					$resCaste = Execute("select * from tbl_caste_master where religionid = '" . $religion[id] . "'");
					if (mysql_num_rows($resCaste) > 0) {
						while ($caste = mysql_fetch_array($resCaste)) {
							$string .= $caste[id] . "_" . $caste[caste] . "/"; 
						}
					}
				}
			}	   		
	    }
	}
	echo trim($string);
}

if ($action == "GetCaste3") {

	$resCaste = Execute("select * from tbl_caste_master where religionid = '" . $religion_id . "' order by caste");
	if (mysql_num_rows($resCaste) > 0) {
		$string = '';
		while ($caste = mysql_fetch_array($resCaste)) {
			$string .= $caste[id] . "_" . $caste[caste] . "/"; 
		}
	}
	echo trim($string);	
}


if ($action == "DOB") {
	print DOB2Age($year,$date,$month);
}	
?>