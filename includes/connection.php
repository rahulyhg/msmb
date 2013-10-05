<?php

error_reporting(0);
//echo '<pre>';
//print_r($_SERVER);
//exit;
if (($_SERVER['SERVER_NAME'] == 'maashaktimarriage.com') || ($_SERVER['SERVER_NAME'] == 'www.maashaktimarriage.com')) {
    $host = "maashakti.db.11559038.hostedresource.com";
    $dbusername = "maashakti";
    $dbpassword = "Sonam123@";
    $dbname = "maashakti";
} else {
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "baramunda1";
    $dbname = "maashakti";
}

function db_connect() {
    global $host, $dbusername, $dbpassword, $dbname;
    if (!($link_id = mysql_pconnect($host, $dbusername, $dbpassword))) {
        echo("error connecting to host");
        exit();
    }
// Select the Database    
    if (!mysql_select_db($dbname, $link_id)) {
        echo("error in selecting the database");
        echo(sprintf("Error : %d %s", mysql_errno($link_id), mysql_error($link_id)));
    } return $link_id;
}

global $rootpath;
$rootpath = substr(realpath("."), 0, strlen(realpath(".")));
$config["tbl_religion_master"] = array("1" => "New Tamil Matrimony", "2" => "New Telugu Matrimony", "3" => "New Kanada Matrimony", "4" => "New Kerala Matrimony", "5" => "New Assamese Matrimony", "6" => "New Bengali Matrimony", "7" => "New Marathi Matrimony", "8" => "New Marwadi Matrimony", "9" => "New Punjabi Matrimony", "10" => "New Gujrati Matrimony", "11" => "New Hindi Matrimony", "12" => "New Urdu Matrimony");
?>