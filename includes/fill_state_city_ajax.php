<?php
ob_start();
session_start();
include("lib.php");
$stateid = GetVar("stateid");
$action = GetVar("action");

if ($action == "GetCity") {

	# Get cities for corresponding state	
	if ($stateid) {		
		$resCity = Execute("select * from tbl_city_master where stateid in ($stateid)");		
		if (mysql_num_rows($resCity) > 0 ) {
			$string = "";	
			while ($city = mysql_fetch_array($resCity)) {
				$string .= $city[id] . "_" . $city[city] . "#"; 
			}
		}
		echo $string;
	}	
}
?>