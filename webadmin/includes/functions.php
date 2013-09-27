<?

include('htmlMimeMail.php');

//Checking purpose , Don't remove


function GetPhotoActivationStatus($id) {

    $res = Execute("select * from tbl_photo where userid = '$id' and approve = '1'");
    if (mysql_num_rows($res) > 0) {
        return true;
    } else {
        return false;
    }
}

function isAdmin($arg) {

    if ($_SESSION['_user'] == "") {
        $_SESSION['Msg'] = "Session expired, Please login again";
        header("Location:index.php");
        die();
    }
    if ($arg != "") {
        $sql_chk = "select * from tbl_admin where Id='" . $_SESSION['user_id'] . "' and $arg='Y'";
        $res_chk = mysql_query($sql_chk);
        if (mysql_num_rows($res_chk) == 0) {
            $_SESSION['_msg'] = "You are not having enough rights to view this page..";
            header("Location:home.php");
            die();
        }
    }
}

function convertdate2($date) {
    if ($date) {
        $lastdt = explode("/", $date);
        $lastdate = $lastdt[2] . "-" . $lastdt[0] . "-" . $lastdt[1];
        return $lastdate;
    }
}

function GetToFromDateDifference($todate, $fromdate) {

    $resDateDiff = Execute("select DATEDIFF('todate','$fromdate')");
    if (mysql_num_rows($resDateDiff) > 0) {
        $rsDateDiff = mysql_fetch_array($resDateDiff);
        $dateDiff = $rsDateDiff[0];
        if ($dateDiff < 0) {
            return false;
        } else {
            return true;
        }
    }
}

function convertdate1($date) {
    $lastdt = explode("-", $date);
    $lastdate = $lastdt[1] . "/" . $lastdt[2] . "/" . $lastdt[0];
    return $lastdate;
}

function GetOccupation() {

    $res = Execute("select * from tbl_occupation_master order by occupation");
    if (mysql_num_rows($res) > 0) {
        while ($occupation_res = mysql_fetch_array($res)) {
            echo "<option value=\"" . $occupation_res[id] . "\">" . $occupation_res[occupation] . "</option>";
        }
    }
}

function GetPackage() {

    $res = Execute("select * from tbl_packages order by package_id");
    if (mysql_num_rows($res) > 0) {
        while ($package_res = mysql_fetch_array($res)) {
            echo "<option value=\"" . $package_res[package_id] . "\">" . $package_res[package_name] . "</option>";
        }
    }
}

function post_img($fileName, $tempFile, $targetFolder) {
    if ($fileName != "") {
        if (!(is_dir($targetFolder)))
            mkdir($targetFolder);
        $counter = 0;
        $NewFileName = $fileName;
        if (file_exists($targetFolder . "/" . $NewFileName)) {
            do {
                $counter = $counter + 1;
                $NewFileName = $counter . "_" . $fileName;
            } while (file_exists($targetFolder . "/" . $NewFileName));
        }
        $NewFileName = str_replace(",", "-", $NewFileName);
        $NewFileName = str_replace(" ", "_", $NewFileName);
        if(move_uploaded_file($tempFile, $targetFolder . "/" . $NewFileName)) {
            return $NewFileName;
        }
        return false;
    }
}

function removeFile($filename) {
    if (file_exists($filename)) {
        if (unlink($filename)) {
            return true;
        } else {
            die("Failed to delete ".$filename);
        }
    }
}

function GetCountry() {

    $res = Execute("select * from tbl_country_master order by country");
    if (mysql_num_rows($res) > 0) {
        while ($country = mysql_fetch_array($res)) {
            echo "<option value=\"" . $country[id] . "\">" . $country[country] . "</option>";
        }
    }
}

function GetState() {

    $resstate = Execute("select * from tbl_state_master order by id");
    if (mysql_num_rows($resstate) > 0) {
        while ($stateMaster = mysql_fetch_array($resstate)) {
            echo "<option value=\"" . $stateMaster[id] . "\">" . $stateMaster[state] . "</option>";
        }
    }
}

function GetCountryVsState() {

    $resstate = Execute("select * from tbl_state_master order by id");
    if (mysql_num_rows($resstate) > 0) {
        while ($stateMaster = mysql_fetch_array($resstate)) {
            echo "<option value=\"" . $stateMaster[id] . "\">" . $stateMaster[country] . "</option>";
        }
    }
}

function GetStateInIndia() {

    $resstate = Execute("select * from tbl_state_master where country in (select id from tbl_country_master where country = 'India') order by id");
    if (mysql_num_rows($resstate) > 0) {
        while ($stateMaster = mysql_fetch_array($resstate)) {
            echo "<option value=\"" . $stateMaster[id] . "\">" . $stateMaster[state] . "</option>";
        }
    }
}

function GetCity() {

    $resCity = Execute("select * from tbl_city_master order by id");
    if (mysql_num_rows($resCity) > 0) {
        while ($cityMaster = mysql_fetch_array($resCity)) {
            echo "<option value=\"" . $cityMaster[id] . "\">" . $cityMaster[city] . "</option>";
        }
    }
}

function GetStateVsCity() {

    $resCity = Execute("select * from tbl_city_master order by id");
    if (mysql_num_rows($resCity) > 0) {
        while ($cityMaster = mysql_fetch_array($resCity)) {
            echo "<option value=\"" . $cityMaster[id] . "\">" . $cityMaster[stateid] . "</option>";
        }
    }
}

function IsUserCountryInDB($country) {
    if (GetSingleRecord("tbl_country_master", "country", $country)) {
        return true;
    } else {
        return false;
    }
}

function IsUserStateInDB($state) {
    if (GetSingleRecord("tbl_state_master", "state", $state)) {
        return true;
    } else {
        return false;
    }
}

function IsUserCityInDB($city) {

    if (GetSingleRecord("tbl_city_master", "city", $city)) {
        return true;
    } else {
        return false;
    }
}

function fnFillComboFromTable($field1, $field2, $table, $field3, $isSelect) {
    $strOption = "";
    $result = "";
    $SQL = "";
    $SQL = "SELECT $field1,$field2 FROM $table ORDER BY $field3";
    $result = mysql_query($SQL);
    if (mysql_num_rows($result) > 0) {
        while ($obj = mysql_fetch_object($result)) {
            $strOption .="<option value='" . $obj->$field1 . "'>" . $obj->$field2 . "</option>";
        }
        if ($isSelect != "") {
            $strOption = str_replace("<option value='" . $isSelect . "'>", "<option value='" . $isSelect . "' selected>", $strOption);
        }
        return $strOption;
    }
}

/* function send_mail($strTo,$strFrom,$strSubject,$strContent){

  $to=$strTo;
  $subject=$strSubject."\r\n";
  /*$subject="Welcome to Matrimonial Clone - Top Maa Shakti Marriage Bureau Software";
  $strFrom="creativedesignforyou@gmail.com";
  $headers="MIME-Version: 1.0\r\n";
  $headers.="Content-type: text/html; charset=iso-8859-1\r\n";
  $headers.="From: ".$strFrom."\r\n"; */

/* $mail = new htmlMimeMail();
  $text = $strContent;
  $mail->setHTML($text);
  $mail->setFrom("<".$strFrom.">");
  $mail->setSubject($strSubject);
  //$mail->setSMTPParams("localhost","25","localhost",true,"info@thecreativeit.com","Innewcom");
  $mail->setSMTPParams("70.84.48.20","25","70.84.48.20",true,"info@thecreativeit.com","Innewcom");
  $result = $mail->send(array($to),'smtp');
  $isSent = mail($to,$subject,$strContent,$headers);
  } */

function send_mail($strTo, $strFrom, $strSubject, $strContent) {



    $to = $strTo;
    $subject = $strSubject;
    $headers = "MIME-Version: 1.0\r\n";
    $headers.="Content-type: text/html; charset=iso-8859-1\r\n";
    $headers.="From:" . $strFrom . "\r\n";

    $mail = new htmlMimeMail();
    $text = $strContent;
    $mail->setHTML($text);
    $mail->setFrom("<" . $strFrom . ">");
    $mail->setSubject($strSubject);
    //$mail->setSMTPParams("localhost","25","localhost",true,"info@thecreativeit.com","Innewcom");			
    //$mail->setSMTPParams("70.84.48.20","25","70.84.48.20",true,"info@thecreativeit.com","Innewcom");			
    //$result = $mail->send(array($to),'smtp');
    $isSent = mail($to, $subject, $strContent, $headers);
}

$strPeriodMonth = "";
for ($iC = 1; $iC <= 12; $iC++) {
    if ($iC == 1) {
        $strPeriodMonth.="<option value=" . $iC . ">" . $iC . " Month</option>";
    } else {
        $strPeriodMonth.="<option value=" . $iC . ">" . $iC . " Months</option>";
    }
}

function DB_Insert($conn, $table, $newvals) {
    $selectstr = "";
    $fieldstr = "";
    # build the query string, have 2 strings to build, 
    # selectstring - field names
    # fieldstr - matching pairs, key = values
    while (list ($key, $val) = each($newvals)) {
        if ($val) {

            $selectstr = $selectstr . $key . ", ";
            $fieldstr = $fieldstr . "\"$val\"" . ", ";
        }
    }

    # we have to chop off last 2 chars off the string.  PHP chop only eliminates
    # whitespace, we have to get rid of ", "

    $selectstr = substr($selectstr, 0, strlen($selectstr) - 2);
    $fieldstr = substr($fieldstr, 0, strlen($fieldstr) - 2);

    $sql = "insert into $table ($selectstr) values ($fieldstr)";

    $result = mysql_query($sql, $conn);
    #result returns 1 here on success, 
    #echo ("<pre>DEBUG:DB_Insert:$sql:|$result|</pre>");
    if ($result) {
        $status = 0;
    } else {
        $status = mysql_error();
    }

    return ($status);
    # result will be 1 if insert succeded or 0 if failed
}

# end function insert

function Execute($sql) {
    $res = mysql_query($sql);
    return $res;
}

function DTMLUpdateRecord($rid, $table, $subdata) {

    # builds a SQL statement to update record $rid in $db/$table using
    # $subdata, which must be a $_POST or $HTTP_POST_VARS associative
    # array. Returns the SQL statement, which must be SQLExecute()-ed
    //print_r($subdata);
    //die();
    global $config;

    # retrieve field lists for comparison (field data will only be entered
    # into the table if the field keys are present in the table)
    $postfields = array_keys($subdata);
    $tablefields = split(",", GetFieldList($table));

    # build SQL statement, excluding hashed fields that require no changes
    $sql = "UPDATE $table SET ";

    foreach ($postfields as $field) {

        if (in_array($field, $tablefields) || ereg("_keepfile", $field)) {

            if (ereg("_keepfile", $field)) {

                # field is a marker for a file upload

                $filefield = ereg_replace("_keepfile", "", $field);

                if ($config["dtml_fieldinfo"][$db][$table][$filefield][1] == "fileupload") {

                    # field confirmed to be a file upload

                    if ($subdata[$field] == 0 && $_FILES[$filefield]["tmp_name"]) {

                        # user has supplied a valid file
                        $ufile = implode("", file($_FILES[$filefield]["tmp_name"]));
                        $sql .= "$filefield='" . base64_encode($ufile) . "',";
                    }
                }
            } else {

                # add normal field to SQL statement
                # detect and handle null values in boolean fields
                $fieldtype = $config["dtml_fieldinfo"][$db][$table][$field][1];
                if ($fieldtype == "boolean-yn" || $fieldtype == "boolean-oo") {
                    if ($subdata[$field] != 1) {
                        $subdata[$field] = 0;
                    }
                }

                if (($subdata[$field] || $subdata[$field] == 0) && $subdata[$field] != "80a346d732d8f7ef263178038c39b87e") {
                    $subdata[$field] = trim($subdata[$field]);
                    $sql .= "$field='" . $subdata[$field] . "',";
                }
            }
        }
    }
    $sql = StrTruncate($sql, 1) . " WHERE id='$rid';";

    return $sql;
}

function GetPackageExpiry_Date1($startdate, $no_of_months) {

    //echo ("select DATE_ADD($startdate,INTERVAL $no_of_days DAY)");
    $resDate = Execute("select DATE_ADD('$startdate',INTERVAL $no_of_months MONTH)");
    if (mysql_num_rows($resDate) > 0) {
        $rsDate = mysql_fetch_array($resDate);
        return $rsDate[0];
    }
}

function GetUserUniqueId($gender) {
    $num = 10000;
    $userid = $gender . $num;
    while (1) {
        $user = GetSingleRecord("tbl_register", "username", $userid);
        if ($user) {
            $num++;
            $userid = $gender . $num;
        } else {
            return $userid;
            break;
        }
    }
}

function GetFieldList($table) {

    # returns a CSV list of fields in $table in $db in the order in which
    # they appear, EXCLUDING the "id" field (which all tables should have)

    $sth = mysql_query("DESCRIBE $table");

    while ($row = mysql_fetch_array($sth)) {
        if ($row[0] != "id") {
            $fieldlist .= "$row[0],";
        }
    }
    return StrTruncate($fieldlist, 1);
}

function DTMLCreateRecord($table, $subdata) {

    # builds a SQL statement to create a new record in $db/$table using
    # $subdata, which must be a $_POST or $HTTP_POST_VARS associative
    # array. Returns the SQL statement, which must be SQLExecute()-ed
    # retrieve field lists for comparison (field data will only be entered
    # into the table if the field keys are present in the table)
    //echo "table".$table."<br>";
    //echo "subdata".print_r($subdata);
    $postfields = array_keys($subdata);
    $tablefields = split(",", GetFieldList($table));


    # handle any file uploads
    /* foreach ($postfields as $field) {
      if (ereg("_fileupload",$field)) {
      $filefield = ereg_replace("_fileupload","",$field);
      if ($_FILES[$filefield]["tmp_name"]) {
      array_push($postfields,$filefield);
      $ufile = implode("",file($_FILES[$filefield]["tmp_name"]));
      $subdata[$filefield] = base64_encode($ufile);
      }
      }
      } */

    # build SQL statement
    $sql = "INSERT INTO $table (";
    foreach ($postfields as $field) {

        if (in_array($field, $tablefields)) {
            $sql .= "$field,";
        }
    }
    $sql = StrTruncate($sql, 1) . ") VALUES (";
    foreach ($postfields as $field) {
        $subdata[$field] = trim($subdata[$field]);
        if (in_array($field, $tablefields)) {
            $sql .= "'" . $subdata[$field] . "',";
        }
    }
    $sql = StrTruncate($sql, 1) . ");";

    return $sql;
}

function StrTruncate($str, $chars) {

    # returns $str, truncated by $chars characters
    return substr($str, 0, strlen($str) - $chars);
}

function GetSingleField($field, $table, $critfield, $criteria) {

    # returns the value of $field in $table in $db where $critfield =
    # $criteria - useful for avoiding several lines of code just to get
    # one variable

    $sql = mysql_query("SELECT $field FROM $table WHERE $critfield='$criteria'");
    $row = mysql_fetch_array($sql);

    return $row[$field];
}

function GetSingleRecord($table, $critfield, $criteria) {

    # returns a single record from $table in $db where $critfield =
    # $criteria. Record is returned as normal associative array
    # useful for avoiding several lines of code just to get one record

    $sql = "SELECT * FROM $table WHERE $critfield='$criteria';";

    $res = mysql_query($sql);
    if (mysql_num_rows($res) > 0) {
        $row = mysql_fetch_array($res);
        return $row;
    }
}

function GetSQLDate() {

    # returns the current date in SQL 0000-00-00 format (yyyy-mm-dd)

    $dn = getdate();
    $sdate = sprintf("%04d-%02d-%02d", $dn["year"], $dn["mon"], $dn["mday"]);

    return $sdate;
}

function DOB2Age($year, $date, $month) {

    # converts date of birth $dob to an age integer
    # $dob must be in YYYY-MM-DD format	

    if ($year && $date && $month) {

        $year_diff = date("Y") - $year;
        $month_diff = date("m") - $month;
        $day_diff = date("d") - $date;
        if (($month_diff < 0 && date("m") != $month) || (date("m") == $month && $day_diff < 0)) {
            $year_diff = $year_diff - 1;
        } else {
            $year_diff = $year_diff;
        }
        return $year_diff;
    }
}

function StandardHash($plain) {

    # returns an MD5 sum of $plain plus our secret word
    # NEVER _EVER_ CHANGE THE SECRET WORD.

    return md5("$plain:AtogVoj7");
}

function GetVar($var) {

    # returns $var, whether it's from $_POST or $_GET
    if ($_GET[$var]) {
        return $_GET[$var];
    }
    if ($_POST[$var]) {
        return $_POST[$var];
    }
}

function ProcessInterests($subdata, $userid) {

    global $config;

    # remove old interest records
    $del = Execute("DELETE FROM tbl_interests WHERE userid='$userid';");

    # create new records
    foreach ($config["menu_hobbie"] as $key => $value) {
        if ($subdata["hobbie_$key"]) {
            $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','hobbie','" . $subdata["hobbie_$key"] . "');");
        }
    }
    foreach ($config["menu_interest"] as $key => $value) {
        if ($subdata["interest_$key"]) {
            $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','interest','" . $subdata["interest_$key"] . "');");
        }
    }
    foreach ($config["menu_music"] as $key => $value) {
        if ($subdata["music_$key"]) {
            $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','music','" . $subdata["music_$key"] . "');");
        }
    }
    foreach ($config["menu_read"] as $key => $value) {
        if ($subdata["read_$key"]) {
            $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','read','" . $subdata["read_$key"] . "');");
        }
    }
    foreach ($config["menu_movie"] as $key => $value) {
        if ($subdata["movie_$key"]) {
            $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','movie','" . $subdata["movie_$key"] . "');");
        }
    }
    foreach ($config["menu_sport"] as $key => $value) {
        if ($subdata["sport_$key"]) {
            $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','sport','" . $subdata["sport_$key"] . "');");
        }
    }
    foreach ($config["menu_cuisine"] as $key => $value) {
        if ($subdata["cuisine_$key"]) {
            $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','cuisine','" . $subdata["cuisine_$key"] . "');");
        }
    }
    foreach ($config["menu_dress"] as $key => $value) {
        if ($subdata["dress_$key"]) {
            $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','dress','" . $subdata["dress_$key"] . "');");
        }
    }

    if ($subdata['txthobbie']) {
        $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','hobbie','" . $subdata['txthobbie'] . "');");
    }
    if ($subdata['txtinterest']) {
        $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','interest','" . $subdata['txtinterest'] . "');");
    }
    if ($subdata['txtmusic']) {
        $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','music','" . $subdata['txtmusic'] . "');");
    }
    if ($subdata['txtread']) {
        $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','read','" . $subdata['txtread'] . "');");
    }
    if ($subdata['txtmovie']) {
        $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','movie','" . $subdata['txtmovie'] . "');");
    }
    if ($subdata['txtsport']) {
        $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','sport','" . $subdata['txtsport'] . "');");
    }
    if ($subdata['txtcuisine']) {
        $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','cuisine','" . $subdata['txtcuisine'] . "');");
    }
    if ($subdata['txtdress']) {
        $ins = Execute("INSERT INTO tbl_interests (userid,type,interest) VALUES ('$userid','dress','" . $subdata['txtdress'] . "');");
    }
    return true;
}

//function to create thumb nail image		
function fnMagic($src, $filename, $new_w, $new_h) {
    $type = getimagesize($src);
    $name = $src;

    if ($type[2] == "2")
        $src_img = imagecreatefromjpeg($name);
    else if ($type[2] == "1")
        $src_img = imagecreatefromgif($name);

    $old_x = imageSX($src_img);
    $old_y = imageSY($src_img);

    if ($new_w < $old_x && $new_h < $old_y) {
        if ($old_x > $old_y) {
            $thumb_w = $new_w;
            $thumb_h = round($old_y * ($new_w / $old_x));
        }
        if ($old_x < $old_y) {
            $thumb_w = round($old_x * ($new_h / $old_y));
            $thumb_h = $new_h;
        }
        if ($thumb_h > $new_h) {
            $thumb_h = $new_h;
        }
        if ($old_x == $old_y) {
            if ($new_w >= $new_h) {
                $thumb_w = $new_h;
                $thumb_h = $new_h;
            } else {
                $thumb_w = $new_w;
                $thumb_h = $new_w;
            }
        }
        $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
        imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

        if ($type[2] == "1")
            imagegif($dst_img, $filename);
        else if ($type[2] == "2")
            imagejpeg($dst_img, $filename);

        imagedestroy($dst_img);
        imagedestroy($src_img);
    }
    else {
        copy($src, $filename);
    }
}

?>
