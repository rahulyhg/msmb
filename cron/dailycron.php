<?php
ob_start();
session_start();
include_once("../includes/lib.php");
include_once("../includes/matchprofile.php");

if (!GetSingleRecord("dailyrecord","date",GetSQLDate())) {
	DailyTasks();
}


?>