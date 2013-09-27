<?php
ob_start();
session_start();
include("lib.php");
$action = GetVar("action");
$email = GetVar("email");

if ($action == 'submit') {	
	
	if (GetSingleRecord("tbl_register","email",$email))	{		
		print '1';		
	} else {	
		print '0';
	}
		
}
	
?>