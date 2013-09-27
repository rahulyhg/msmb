<?
ob_start();
session_start();
include("includes/lib.php");

$strFrom='info@maashaktimarriage.com';
$strTo="creativedesignforyou@gmail.com";
$strSubject = "Welcome to the Matrmonial shaadi ";			
$strContent = "info test";
send_mail($strTo,$strFrom,$strSubject,$strContent);		
?>