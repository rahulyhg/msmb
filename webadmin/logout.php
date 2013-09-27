<?php
ob_start();
session_start();
session_destroy();
session_start();
$_SESSION['Msg']="Successfully Logged Out";
header("Location:index.php");
die();
?>