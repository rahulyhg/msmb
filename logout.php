<?php
@ob_start();
@session_start();
@session_destroy();
@session_start();
$_SESSION['_msg']="Successfully Logged Out";
if($_REQUEST['mode']=="franchise"){
	header("Location:franchise_login.php");
	die();
} else {
	//header("Location:member_login.php");
	header("Location:index.php");
	die();
}
	
?>