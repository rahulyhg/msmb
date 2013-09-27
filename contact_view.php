<?
ob_start();
session_start();
include("includes/lib.php");
$action = base64_decode(GetVar("action"));
$mode = GetVar("mode");
$id = base64_decode(GetVar("id"));
if ($action == "cantact") {
	if ($mode == "address") {		
		contactMember($id,"address");	
	} else if ($mode == "phone") {
		contactMember($id,"phone");	
	}	
}	
?>