<?
//ob_start();
//session_start();
include("lib.php");
//$year = GetVar("year");
//$month = GetVar("month");
//$date = GetVar("date");
$action = GetVar("action");
$domain = GetVar("domainid");
//$religion_id = GetVar("religionid");



if ($action == "Getreligion") {	
	$resReligion = Execute("select * from tbl_religion_master where domain = $domain");	
	
	if (mysql_num_rows($resReligion) > 0 ) {
		$string = "";	
	    while ($religion = mysql_fetch_array($resReligion)) {
	   		$string .= $religion[id] . "_" . $religion[religion] . "/"; 
	    }
	}
	echo $string;	
}
?>