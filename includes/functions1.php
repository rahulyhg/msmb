<?php

include('htmlMimeMail.php');
include('class.phpmailer.php');

function do_pages($total, $page_size=25) {

    $index_limit = 10;

    $query = preg_replace('/page=[0-9]+/', '', $_SERVER['QUERY_STRING']);
    $query = preg_replace('/^&*(.*)&*$/', "$1", $query);
    if (!empty($query))
        $query = "&amp;$query";

    $current = GetVar("iPageNum");
    if (intval($current) <= 0)
        $current = 1;

    $total_pages = ceil($total / $page_size);
    $start = max($current - intval($index_limit / 2), 1);
    $end = $start + $index_limit - 1;

    if ($start > 1) {
        $i = 1;
        //echo '&nbsp; <a href="javascript:paging('.$i.')" title=""> '.$i.' </a> &nbsp;';
        //echo ' ...';
    }
    for ($i = $start; $i <= $end && $i <= $total_pages; $i++) {
        if ($i == $current) {
            echo '&nbsp; <a class="next"><font color="#CCCCCC"> ' . $i . ' </font></a> &nbsp;';
        } else {
            echo '&nbsp; <a href="javascript:paging(' . $i . ')" title="" class="next"> ' . $i . ' </a> &nbsp;';
        }
    }
    if ($total_pages > $end) {
        $i = $total_pages;
        //echo ' ...';
        //echo '&nbsp; <a href="javascript:paging('.$i.')" title="" class="next">'.$i.'</a> &nbsp;';
    }
    echo "of&nbsp;$total_pages";
    echo '</td><td width="20%" height="29"  class="sbar">';
    if ($total > 0) {
        if ($current == 1) {
            echo '&nbsp;&nbsp;&nbsp;&nbsp;<font color="#CCCCCC">Previous</a>&nbsp;';
        } else {
            $i = $current - 1;
            echo '<a href="javascript:paging(' . $i . ')" class="next">Previous</a> &nbsp;';
        }
        if ($current < $total_pages) {
            $i = $current + 1;
            echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:paging(' . $i . ')" class="next">Next</a>&nbsp;';
        } else {
            echo '&nbsp;&nbsp;&nbsp;&nbsp;<font color="#CCCCCC">Next</a>&nbsp;';
        }
    }
}

function isStillMember($expire_date) {

    $today = date("Y-m-d");
    $resDate = Execute("select DATEDIFF('$expire_date','$today')");
    if (mysql_num_rows($resDate) > 0) {
        $rsDate = mysql_fetch_array($resDate);
        if ($rsDate[0] < 0)
            return false;
        else
            return true;
    }
}

function GetPackageExpiryDate($id) {
    return strftime("%d %b %Y", strtotime(GetSingleField("package_expiry_date", "tbl_register", "id", $id)));
}

function GetPackageExpiryDays($id) {
    return round((strtotime(GetSingleField("package_expiry_date", "tbl_register", "id", $id)) - strtotime(date("Y-m-d"))) / 60 / 60 / 24);
}

function GetPackageExpiry_Date($startdate, $no_of_days) {

    $no_of_days = $no_of_days - 1;
    //echo ("select DATE_ADD($startdate,INTERVAL $no_of_days DAY)");
    $resDate = Execute("select DATE_ADD('$startdate',INTERVAL $no_of_days DAY)");
    if (mysql_num_rows($resDate) > 0) {
        $rsDate = mysql_fetch_array($resDate);
        return $rsDate[0];
    }
}

function GetPackageExpiry_Date1($startdate, $no_of_months) {

    //echo ("select DATE_ADD($startdate,INTERVAL $no_of_days DAY)");
    $resDate = Execute("select DATE_ADD('$startdate',INTERVAL $no_of_months MONTH)");
    if (mysql_num_rows($resDate) > 0) {
        $rsDate = mysql_fetch_array($resDate);
        return $rsDate[0];
    }
}

function DailyTasks() {

    global $config;

    # get current date

    $today = date("Y-m-d");

    $partner = new PartnerMatch;

    # Store Partner Matches for every user

    $userRes = Execute("select * from tbl_register where enable = '1' and verifiedStatus = '1'  and hideProfile = '0' and deleteProfile = '0'");
    if (mysql_num_rows($userRes) > 0) {
        while ($member = mysql_fetch_array($userRes)) {
            PartnerMatch :: InsertMatch($member[id]);
        }
    }
    mysql_free_result($userRes);

    # Sent One Match Profile in mail every day to users

    $userRes = Execute("select * from tbl_register where enable = '1' and verifiedStatus = '1'  and hideProfile = '0' and deleteProfile = '0'");
    if (mysql_num_rows($userRes) > 0) {
        while ($user = mysql_fetch_array($userRes)) {
            $partner->SendMailPartnerMatch($user[id]);
        }
    }
    mysql_free_result($userRes);

    # send mail before 7 or 1 day(s) about user's account expire

    $userRes = Execute("select * from tbl_register where deleteProfile = '0'");

    if (mysql_num_rows($userRes) > 0) {

        while ($user = mysql_fetch_array($userRes)) {

            # send mail before 7 or 1 day(s) about user's account expire

            if ($user[membership_type] > 1 && $user[package_expiry_date]) {

                $curdateRes = Execute("select TO_DAYS(CURDATE())");
                $curdate = mysql_result($curdateRes, 0);

                $expdateRes = Execute("select TO_DAYS('" . $user[package_expiry_date] . "')");
                $expdate = mysql_result($expdateRes, 0);

                $date_difference = $expdate - $curdate;

                if ($date_difference == 7 or $date_difference == 1) {

                    $package = GetSingleField("package_name", "tbl_packages", "package_id", $user[membership_type]);
                    $mailmsg = "";
                    $mailmsg .= "<style>td { font-family:verdana; font-size:11px; }</style>";
                    $mailmsg .= "Dear " . trim($user[name]) . ",<br><br>";
                    $mailmsg .= "<table cellpadding='3'>";
                    $mailmsg .= "<tr><td colspan='2'>Your package will expire on " . GetPackageExpiryDate($user[id]) . "</td></tr>";
                    $mailmsg .= "<tr><td>You have choosen $package.  Keeping your membership on our site, will ensure that you can make</td></tr>";
                    $mailmsg .= "<tr><td>to view phone number and address of your partner.</td></tr>";
                    $mailmsg .= "<tr><td>Thanks,</td></tr><tr><td>Regards,</td></tr><tr><td> Maa Shakti Marriage Bureau team<br>http://bestmatrimonial.com/</td></tr></table>";
                    $strTo = trim($user[email]);
                    $strFrom = "info@matrimonialclone.com";
                    $strSubject = "Your package will expire on " . GetPackageExpiryDate($user[id]);
                    $strContent = $mailmsg;
                    send_mail($strTo, $strFrom, $strSubject, $strContent);
                }

                # Set user package as a free package

                if ($date_difference == 0) {

                    $pac_expiry_date = GetPackageExpiry_Date($today, '30');

                    $resExpUser = Execute("update tbl_register set membership_type = 1 and package_expiry_date = '" . $pac_expiry_date . "'");
                }
            }

            # convert date of birth into age

            if ($user[date_of_birth]) {

                $dob = explode("-", $user[date_of_birth]);
                $age = DOB2Age($dob[0], $dob[2], $dob[1]);

                if ($age) {
                    $res = Execute("update tbl_register set age = '$age' where id = '" . $user[id] . "'");
                }
            }
        }
    }
    $res = Execute("INSERT INTO dailyrecord (date) VALUES (NOW())");
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
                $NewFileName = $counter . "" . $fileName;
            } while (file_exists($targetFolder . "/" . $NewFileName));
        }
        $NewFileName = str_replace(",", "-", $NewFileName);
        $NewFileName = str_replace(" ", "_", $NewFileName);
        move_uploaded_file($tempFile, $targetFolder . "/" . $NewFileName);

//				print_r($targetFolder);
//				die();
        return $NewFileName;
    }
}

function removeFile($filename) {
    if (file_exists($filename)) {
        unlink($filename);
    }
}

function send_mail($strTo, $strFrom, $strSubject, $strContent) {
    $to = $strTo;
    $subject = $strSubject . "\r\n";
    $headers = "MIME-Version: 1.0\r\n";
    $headers.="Content-type: text/html; charset=iso-8859-1\r\n";
    $headers.="From: " . $strFrom . "\r\n";

    $mail = new htmlMimeMail();
    $text = $strContent;
    $mail->setHTML($text);
    $mail->setFrom("<" . $strFrom . ">");
    $mail->setSubject($strSubject);
    $isSent = mail($to, $subject, $strContent, $headers);
}

function phpmailer_send($strTo, $strSubject, $strContent) {
    try {
        $mail = new PHPMailer(true); //New instance, with exceptions enabled

        $mail->IsSMTP();                           // tell the class to use SMTP
        $mail->AddReplyTo("info@maashaktimarriage.com", "Maa Shakti Marriage Bureau");

        $mail->IsSendmail();  // tell the class to use Sendmail

        $body = $strContent;
        $to = $strTo;

        $mail->AddAddress($to);
        $mail->AddBCC('ceb.sushant@gmail.com');
        $mail->AddBCC('maashakti_2007@rediffmail.com');

        $mail->Subject = $strSubject;

        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
        $mail->WordWrap = 80; // set word wrap

        $mail->MsgHTML($body);

        $mail->IsHTML(true); // send as HTML

        $mail->Send();

    } catch (phpmailerException $e) {
        //echo $e->errorMessage();
        die('Mail sending failed');
    }
}

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

        if (in_array($field, $tablefields)) {
            # add normal field to SQL statement

            if ($subdata[$field] || $subdata[$field] == 0) {
                $subdata[$field] = trim($subdata[$field]);
                $sql .= "$field='" . $subdata[$field] . "',";
            }
        }
    }
    $sql = StrTruncate($sql, 1) . " WHERE id='$rid';";

    return $sql;
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
    $tablefields = explode(",", GetFieldList($table));
//    print_r("<pre>"); 
//    print_r($postfields); 
//    //print_r($tablefields); 
//    print_r("</pre>"); 
    
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
    //echo $sql;exit;
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

    $sql = "SELECT * FROM $table WHERE $critfield='" . $criteria . "'";
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

/* function DOB2Age($date_of_birth) {

  # converts date of birth $dob to an age integer
  # $dob must be in YYYY-MM-DD format

  $cur_year = date("Y");
  $cur_month = date("m");
  $cur_day = date("d");

  $dob_year = substr($date_of_birth, 0, 4);
  $dob_month = substr($date_of_birth, 5, 2);
  $dob_day = substr($date_of_birth, 8, 2);

  if ($cur_month > $dob_month || ($dob_month == $cur_month && $cur_day >= $dob_day) ) {
  return $cur_year - $dob_year;
  } else {
  return $cur_year - $dob_year -1;
  }

  } */

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

function fnNews_letter() {
    $strNewsletter = "<form name=\"newsLetterForm\" method=\"post\" action=\"subscribe.php?Mode=Subscribe\" onsubmit=\"return fnValidateNewsletter();\">";
    $strNewsletter.="<td width=\"236\" align=\"center\">";
    $strNewsletter.="<div style=\"background-color:#FFFFFF; width:225px; height:115px; border:solid 1px #a4b386;\">";
    $strNewsletter.="<div><img src=\"images/news_letter.jpg\" width=\"225\"/></div>";
    $strNewsletter.="<div class=\"story\" style=\"padding:10px 0px 10px 10px;\" align=\"left\">Sign up for a FREE Newsletter by entering your email address here.</div>";
    $strNewsletter.="<div><input name=\"txtEmailAddress\" type=\"text\" class=\"newsbox\">&nbsp;<input name=\"Submit\" type=\"Submit\" value=\"Submit\" class=\"button2\"></div>";
    $strNewsletter.="</div>";
    $strNewsletter.="</td>";
    $strNewsletter.="</form>";
    echo $strNewsletter;
}

function fnSuccessful_stories_others() {
    $strRandSuccess = "";
    $sql_success = "select * from tbl_successful_stories where marriage_year='" . date('Y') . "' order by rand() limit 0,1";
    $res_sucess = mysql_query($sql_success);
    if (mysql_num_rows($res_sucess) > 0) {
        $obj_success = mysql_fetch_object($res_sucess);
        $fd = fopen("successful_stories/" . $obj_success->file_name, "r");
        $content = fread($fd, filesize("successful_stories/" . $obj_success->file_name));
        fclose($fd);
        $next = substr($content, 50, strlen($content));
        $spacepos = strpos($next, " ");
        $strMsg = trim(substr($content, 0, 50 + $spacepos) . "....");

        $strRandSuccess.="<table width=\"184\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border:#c2a93a solid 1px;\">";
        $strRandSuccess.="<tr><td bgcolor=\"#ecc84a\" height=\"24\" style=\"border-bottom:#c2a93a solid 1px; background-color:#ecc84a;\" align=\"center\"><h4 class=\"mparv\"><font color=\"#8f7f3d\">Successful Stories</h4></font></td></tr>";
        $strRandSuccess.="<tr><td align=\"center\"><img src=\"successful_stories_images/" . $obj_success->image . "\" vspace=\"5\" width=\"127\" height=\"84\"/><br><br></td></tr>";
        $strRandSuccess.="<tr><td class=\"story\">\"" . $strMsg . "\"<br><span style=\"float:right;\"><a href=\"successful_stories.php#" . $obj_success->auto_id . "\" class=\"more\">read more...</a></span><br><br></td></tr>";
        $strRandSuccess.="</table>";
    } else {

        $strRandSuccess.="<table width=\"184\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border:#2e3e10 solid 1px;\">";
        $strRandSuccess.="<tr><td bgcolor=\"#ecc84a\" height=\"24\"  style=\"border-bottom:#c2a93a solid 1px; background-color:#ecc84a;\"><h4 class=\"mparv\"><font color=\"#8f7f3d\">Successful Stories</font></h4></td></tr>";
        $strRandSuccess.="<tr><td align=\"center\">No Successful stories found..</td></tr>";
        $strRandSuccess.="<tr><td class=\"story\"></td></tr>";
        $strRandSuccess.="</table>";
    }
    echo $strRandSuccess;
}

function fnShowsideTopBanner() {

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

function do_pages1($total, $page_size=25) {

    $index_limit = 10;

    $query = preg_replace('/page=[0-9]+/', '', $_SERVER['QUERY_STRING']);
    $query = preg_replace('/^&*(.*)&*$/', "$1", $query);
    if (!empty($query))
        $query = "&amp;$query";

    $current = GetVar("iPageNum");
    if (intval($current) <= 0)
        $current = 1;

    $total_pages = ceil($total / $page_size);
    $start = max($current - intval($index_limit / 2), 1);
    $end = $start + $index_limit - 1;

    if ($start > 1) {
        $i = 1;
        echo '&nbsp; <a href="javascript:paging(' . $i . ')" title=""> ' . $i . ' </a> &nbsp;';
        echo ' ...';
    }
    for ($i = $start; $i <= $end && $i <= $total_pages; $i++) {
        if ($i == $current) {
            echo '&nbsp; <a class="castin"><font color="#CCCCCC"> ' . $i . ' </font></a> &nbsp;';
        } else {
            echo '&nbsp; <a href="javascript:paging(' . $i . ')" title="" class="castin"> ' . $i . ' </a> &nbsp;';
        }
    }
    if ($total_pages > $end) {
        $i = $total_pages;
        echo ' ...';
        echo '&nbsp; <a href="javascript:paging(' . $i . ')" title="" class="castin">' . $i . '</a> &nbsp;';
    }
    echo "of&nbsp;$total_pages";
    echo '</td><td width="20%" height="29" class="castin">';
    if ($total > 0) {
        if ($current == 1) {
            echo '&nbsp;&nbsp;&nbsp;&nbsp;<font color="#CCCCCC">Previous</a>&nbsp;';
        } else {
            $i = $current - 1;
            echo '<a href="javascript:paging(' . $i . ')" class="castin">Previous</a> &nbsp;';
        }
        if ($current < $total_pages) {
            $i = $current + 1;
            echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:paging(' . $i . ')" class="castin">Next</a>&nbsp;';
        } else {
            echo '&nbsp;&nbsp;&nbsp;&nbsp;<font color="#CCCCCC">Next</a>&nbsp;';
        }
    }
}

?>