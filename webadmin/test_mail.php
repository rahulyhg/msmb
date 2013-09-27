<?
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");

$strFrom='info@thecreativeit.com';
$strTo="creativedesignforyou@gmail.com";
$strSubject = "Welcome to the Matrmonial shaadi ";			
$strContent = "info test";
send_mail($strTo,$strFrom,$strSubject,$strContent);		
?>