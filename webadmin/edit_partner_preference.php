<?php

include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
include("config.php");

$linkid=db_connect();
isAdmin("edit_regn_member_status");
$id = GetVar("id");
$action = GetVar("action");
$action1 = GetVar("action1");
$user = GetSingleRecord("tbl_register","id",$id);

if ($action == "update") {

	if ($_REQUEST['partnerDomain']) {
		$_REQUEST['partnerDomain'] = implode(",",$_REQUEST['partnerDomain']);
	}
	if ($_REQUEST['partnerMaritalStatus']) {	
		$_REQUEST['partnerMaritalStatus'] = implode(",",$_REQUEST['partnerMaritalStatus']);
	}
	if ($_REQUEST['partnerEducation']) {		
		$_REQUEST['partnerEducation'] = implode(",",$_REQUEST['partnerEducation']);
	}
	if ($_REQUEST['partnerCitizenship']) {	
		$_REQUEST['partnerCitizenship'] = implode(",",$_REQUEST['partnerCitizenship']);
	} 
	if ($_REQUEST['partnerCountryLiving']) {	
		$_REQUEST['partnerCountryLiving'] = implode(",",$_REQUEST['partnerCountryLiving']);
	}
	if ($_REQUEST['partnerResidingState']) {
		$_REQUEST['partnerResidingState'] = implode(",",$_REQUEST['partnerResidingState']);
	}
	if ($_REQUEST['partnerReligion']) {	
		$_REQUEST['partnerReligion'] = implode(",",$_REQUEST['partnerReligion']);
	}
	if ($_REQUEST['partnerCaste']) {	
		$_REQUEST['partnerCaste'] = implode(",",$_REQUEST['partnerCaste']);
	}
}
?>