<?php 
ob_start();
session_start();
include("includes/lib.php");

$action = GetVar("action");
if ($action == "login") {
    MemberLogin($_POST);
}
if ($_SESSION['userid']) {
    $user = GetSingleRecord("tbl_register", "username", $_SESSION['userid']);
    if ($user[gender] == "M")
        $sex = "gender=F";
    if ($user[gender] == "F")
        $sex = "gender=M";
}
//query to get the current year
$sql_year = "select date_format(current_date(),'%Y') as currentyear";
$res_year = mysql_query($sql_year);
$obj_year = mysql_fetch_object($res_year);
//var_dump($obj_year);
$currentyear = $obj_year->currentyear;
//exit;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Maashakti Marriage Bureau</title>
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
        <link href="includes/style.css" type="text/css" rel="stylesheet"/>
        <link href="includes/index.css" type="text/css" rel="stylesheet"/>
        <script language="JavaScript" src="includes/validate.js"></script>
        <script language="JavaScript" src="includes/functions.js"></script>	
        <script language="javascript">
            function active(){
                //document.getElementById("OnPage").style.backgroundColor=#ff3300;
            }
        </script> 
        <script type="text/JavaScript">
            <!--
            function MM_preloadImages() { //v3.0
                var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
                    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
                        if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
                }

                function MM_swapImgRestore() { //v3.0	
                    var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
                }

                function MM_findObj(n, d) { //v4.01
                    var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
                        d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
                    if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
                    for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
                    if(!x && d.getElementById) x=d.getElementById(n); return x;
                }

                function MM_swapImage() { //v3.0
                    var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
                    if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
                }

                function validate(f1) {	
	
                    if (isNull(f1.username, "User Id / Email Address")) { return false; }
                    var str = f1.username.value;
                    var email=0;
                    str = str.split('@');
                    var str;
                    len = str.length;
                    if (len > 1) { email = 1; }
                    if (email == 1)	{
                        if (notEmail(f1.username,"Email Address")) { return false; }	
                    }
                    if (isNull(f1.password, "Password")) { return false; }
                }

                //-->
                function fnsearch_Validate(){

                    if(notSelected(document.searchForm.domain,"Domain")){ return false; }
                    if(notSelected(document.searchForm.caste,"Caste")){ return false; }
                    document.searchForm.action = "search.php";
                    document.searchForm.submit();
                }
        </script>
    </head>
    <body class="homebody" onLoad="MM_preloadImages('images/logo.jpg','images/search_bg.jpg','images/home_banner.jpg','images/new_register.jpg','userthumbnail/usr101.jpg','successful_stories_images/partner_login.jpg','ad_banner_images/banner_bottom.gif')">
        <div class="menuleftimg">
            <div id="main"> 
                <div id="div1">
                    <div id="banner"><img src="images/logo.jpg"  border="0"/></div>
                    <div id="add" style="padding-top:23px;"><?php //fnBannerImage('index', 'top') ?></div>
                </div>
                <div id="div2">
                    <div id="lang" tyle="border:#00FF00 1px solid;">
    <?php include("includes/menu.php"); 
    ?>
                    </div>
                    <div id="menutop">
                        <a href="advertise.php" class="submenu">Advertise</a>&nbsp;&nbsp;<span class="pipe">|</span>&nbsp;&nbsp;<a href="contact_us.php" class="submenu">Contact Us</a>&nbsp;&nbsp;<span class="pipe">|</span>&nbsp;&nbsp;<a href="franchise_login.php" class="submenu">Franchise</a>&nbsp;&nbsp;<span class="pipe">|</span>&nbsp;&nbsp;
                        <?php if ($config[userinfo]) { ?>
                            <a href="my_profile.php" class="submenu">My Profile</a>&nbsp;&nbsp;<span class="pipe">|</span>&nbsp;&nbsp;
<?php } ?>
                        <a href="my_matrimony.php" class="submenu">My Matrimony</a>&nbsp;&nbsp;<span class="pipe">|</span>&nbsp;&nbsp;<a href="payment.php" class="submenu">Payment Option</a>&nbsp;&nbsp;<span class="pipe">|</span>&nbsp;&nbsp;<a href="search.php" class="submenu">Search</a>&nbsp;&nbsp;<span class="pipe">|</span>&nbsp;&nbsp;<a href="suggestion.php" class="submenu">Suggestion</a>&nbsp;&nbsp;<span class="pipe">|</span>&nbsp;&nbsp;<a href="wedding_directory.php" class="submenu">Wedding Directory</a>			
                    </div>
                </div>
                <div id="div3" style="margin:2px; border:0px solid #ff0000">
                    <div style="float:left; width:245px; margin-top:20px;">
                        <table border="0" cellspacing="0" cellpadding="0" class="ingbg">
                            <?php
                            if ($config["new_domain"]) {
                                $val1 = 1;
                            } else {
                                $val1 = 0;
                            }
                            ?>
                            <form name="searchForm" method="get" action="search.php" onSubmit="return fnValidateSearch('<?= $val1 ?>');">
                                <input type="hidden" name="action" value="search">
                                <tr>
                                    <td width="119" colspan="2" height="30" style="padding:0px 0px 0px 10px;"><h5 class="psearch">Partner Search</h5></td>
                                </tr>
                                <tr>
                                    <td style="padding:0px 0px 0px 10px;" height="25" colspan="2">
                                            <!--<input name="Male" type="radio" value="Male" checked="checked" />
                                                  Male &nbsp;
                                                  <input name="Female" type="radio" value="Female" />
                                                  Female-->
                                        <?php
                                        if ($_SESSION['userid']) {
                                            $user_gender = GetSingleRecord("tbl_register", "username", $_SESSION['userid']);
                                            ?>
                                            <input name="gender" type="radio" value="F" <?php if ($user_gender[gender] == "M") { ?> checked <?php } ?>>Female&nbsp; 
                                            <input name="gender" type="radio" value="M" <?php if ($user_gender[gender] == "F") { ?> checked <?php } ?>>Male									
                                        <?php } else { ?>	
                                            <input name="gender" type="radio" value="F" checked="checked">Female &nbsp; 
                                            <input name="gender" type="radio" value="M">Male									
                                <?php } ?>				 
                                    </td>
                                </tr>
<?php if ($config["new_domain"] == "") { ?>
                                    <tr>
                                        <td colspan="2" style="padding:0px 0px 0px 10px;" height="30">Domain&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <select name="domain" class="dominbox" nChange="selMultipleDomainCaste();" onChange="selMultipleDomainCaste1()">
                                                <option value="" selected>-Select a Domain-</option>	
                                                <?php
                                                $resDomain = Execute("select * from tbl_domain_master order by id");
                                                if (mysql_num_rows($resDomain) > 0) {
                                                    while ($domain = mysql_fetch_array($resDomain)) {
                                                        ?>
                                                        <option value="<?= $domain[id] ?>"><?= $domain[domain] ?></option>
                                                    <? }
                                                } ?>
                                            </select>				 
                                        </td>
                                    </tr>
                                        <?php } else { ?>
                                    <tr>
                                        <td colspan="2" style="padding:0px 0px 0px 10px;" height="30">Religion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <?php
                                                $domain = $config["new_domain"];
                                                ?>
                                            <select name="religion" class="dominbox" onChange="SelectSearchCaste();">										
                                                <option value="">-Select Religion-</option>
                                                <?php   $resRegion = Execute("select * from tbl_religion_master where domain = '$domain' order by religion ");

                                                if (mysql_num_rows($resRegion) > 0) {
                                                    while ($religion = mysql_fetch_array($resRegion)) {
                                                        ?>
                                                        <option value="<?= $religion[id] ?>"><?= $religion[religion] ?></option>
                                        <? }
                                    } ?>																	
                                            </select>				  
                                        </td>
                                    </tr>
<? } ?>
                                <tr>
                                    <td colspan="2" style="padding:0px 0px 0px 10px;" height="30">Caste&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <select name="caste" class="dominbox">									
                                            <option value="">--Select Caste--</option>																			
                                        </select>				  
                                    </td>
                                </tr>				
                                <tr>
                                    <td colspan="2" style="padding:0px 0px 0px 10px;" lign="right" height="30" class="select">Age&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <select name="fromAge" class="agebox">
                                            <option value="18" selected="selected">18</option>
<? for ($i = 19; $i < 99; $i++) { ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <? } ?>					
                                        </select>
                                        &nbsp;to&nbsp;
                                        <select name="toAge"  class="agebox">					
<? for ($i = 18; $i < 99; $i++) { ?>
                                                <option value="<?= $i ?>" <? if ($i == 35) { ?> selected <? } ?>><?= $i ?></option>
<? } ?>
                                        </select>				  
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0px 0px 0px 6px;" height="25" class="select"><input name="withPhoto" type="checkbox" value="0"/>&nbsp;<span style="padding-top:0px;">with photo</span></td>
                                    <td width="126" height="35" align="left"  style="padding:0px 0px 0px 10px;"><input name="Submit2" type="submit" value="Search" class="button"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding:0px 0px 0px 6px;" height="25"><a href="search_by_id.php" class="more">Search by id?</a></td>
                                </tr>
                            </form>
                        </table>
                        <div style="font-size:14px; width:245px; margin-top:10px; float:left;">
<? if (!$_SESSION['userid']) { ?>
                                <div id="session_mes" style="display:none">			 	
                                    <strong style="color:#dd1915; font-size:13px;"><?= $_SESSION['_msg'] ?></strong>
                                </div>
                                <div id="mem_login">
                                    <strong>Already a member?</strong>&nbsp;&nbsp;<a href="member_login.php" class="more"><strong style="color:#dd1915; font-size:13px;">Login here</strong></a>
                                </div>
<? } else { ?>
                                <strong style="color:#ffad03; font-size:13px;"> <b><?= $config[userinfo][name]; ?></b></strong>&nbsp; |&nbsp;<a href="logout.php?mode=member" class="more"><strong style="color:#dd1915; font-size:13px;">Log Out</strong></a>
<? } ?>
                        </div>
                    </div>
                    <div id="step" style="order: #00FF00 1px solid; margin-top:0px;">
                        <div style="float:left; width:530px; height:190px; order: #00FF00 1px solid;"></div>
                        <div style="float:left; margin:0px;"><a href="register.php" class="user" style="padding-left:90px;">New user?</a><br><a href="register.php"><img src="images/new_register.jpg" height="38" title="Join Now Register Free" border="0"></a></div>
                    </div>
                </div>
                <div id="div5">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td width="390" valign="top">
                                <table cellpadding="0" cellspacing="0" border="0" width="390" style="border:1px solid #ffbc09;">
                                    <tr>
                                        <td colspan="2" height="20" style=" border-bottom:#ffbc09 1px solid;" bgcolor="#fee19f"><strong style="color:#e25712; padding-left:5px;">Featured profile - Bride</strong></td>
                                    </tr>
                                    <tr>
                                        <?
                                        $resQry = "select *,tbl_register.id as RegId from tbl_register INNER JOIN tbl_photo ON tbl_register.id = tbl_photo.userid where tbl_register.enable = '1' and tbl_register.verifiedStatus = '1' and tbl_register.membership_type > 0 and tbl_register.featuredProfile = '1' and tbl_photo.approve = '1' and tbl_register.hideProfile = '0' and tbl_register.deleteProfile = '0' and (isnull(tbl_register.photo_password) or tbl_register.photo_password = '') and tbl_register.gender = 'F' ";
                                        //$resQry ="select *,tbl_register.id as RegId from tbl_register INNER JOIN tbl_photo ON tbl_register.id = tbl_photo.userid where tbl_register.enable = '1' and tbl_register.verifiedStatus = '1' and tbl_register.featuredProfile = '1' and tbl_photo.thumbnail !='' and tbl_photo.approve = 1 ";
                                        if ($config["userinfo"][id]) {
                                            $resQry .= " and tbl_register.id != '" . $config["userinfo"][id] . "' ";
                                        }
                                        $resQry .= "group by tbl_photo.userid";
                                        $resQry.=" order by rand() limit 0,2";
                                        //echo $resQry;
                                        $res = Execute($resQry);
                                        //echo "num of images =>" . mysql_num_rows($res); 

                                        if (mysql_num_rows($res) > 0) {
                                            $numImages = mysql_num_rows($res);
                                            $total_width = 0;
                                            while ($feature_profile = mysql_fetch_array($res)) {
                                                ?>

                                                <td style="padding:3px;">
                                                    <table cellpadding="0" width="200" cellspacing="0" border="0">
                                                        <tr>
                                                            <td>
                                                                <div>
                                                                    <div style="float:left;">											
                                                                        <? if ($feature_profile[photo_password]) { ?>
                                                                            <img src="images/protectedphoto.gif" style="cursor:pointer" width="75" height="75" onclick="window.location.href='view_member_profile.php?userid=<? echo $feature_profile[username]; ?>'">
                                                                        <? } else { ?>
                                                                            <img id="user<?= $feature_profile[RegId] ?>" name="user<?= $feature_profile[RegId] ?>" src="userthumbnail/<?= $feature_profile[photo] ?>"  style="cursor:pointer; border: #333333 1px solid;" width="75" height="75" onclick="window.location.href='view_member_profile.php?userid=<? echo $feature_profile[username]; ?>'">
                                                                        <? } ?>
                                                                        <?
                                                                        $year = substr($feature_profile[date_of_birth], 0, 4);
                                                                        $month = substr($feature_profile[date_of_birth], 5, 2);
                                                                        $date = substr($feature_profile[date_of_birth], 8, 2);
                                                                        ?>
                                                                    </div>
                                                                    <div style="float:right; width:120px;" class="feature"><strong style="color:#ff8101;"><?= $feature_profile[name] ?></strong><br><?= DOB2Age($year, $date, $month) ?> years<br>
                                                                        <?
                                                                        $mem_religion = GetSingleField("religion", "tbl_religion_master", "id", $feature_profile[religion]);
                                                                        echo $mem_religion;
                                                                        if ($feature_profile[caste]) {
                                                                            echo ",";
                                                                            $caste = GetSingleField("caste", "tbl_caste_master", "id", $feature_profile[caste]);
                                                                            echo $caste = substr($caste, 0, 5);
                                                                            //substr($content,150,strlen($content));
                                                                        }
                                                                        echo '...<br>';
                                                                        echo substr(GetSingleField("occupation", "tbl_occupation_master", "id", $feature_profile[occupation]), 0, 8);
                                                                        ?>...&nbsp;&nbsp;&nbsp;&nbsp;  <a href="view_member_profile.php?userid=<? echo $feature_profile[username]; ?>" class="more">More</a> </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table> 
                                                </td>
                                            <? }
                                        } else {
                                            echo"<tr><td algin='center'>Not Found Bride Featured profile.</td></tr>";
                                        } ?>							
<? if (mysql_num_rows($res) == 1) { ?>
                                            <td style="padding:3px;"><table cellpadding="0" cellspacing="0" border="0" width="200"><tr><td>&nbsp;</td></tr></table></td>		
<? } ?>					
                                    </tr>
                                    <tr><td colspan="2" height="20" align="right" style="padding-right:5px;" valign="top"><a href="feature_profile.php" class="more">View All</a></td></tr>
                                </table>
                            </td>
                            <td width="5"></td>

                            <!--success story--><td valign="top">
                                <table width="360"  border="0"  cellspacing="0" cellpadding="1" style="border:1px solid #ffbc09; margin-top: 0px;">
                                    <?
                                    $sql_success = "select * from tbl_successful_stories where marriage_year='" . date('Y') . "' and display_status='Y'  order by rand() limit 0,1";
                                    $res_sucess = mysql_query($sql_success);
                                    if (mysql_num_rows($res_sucess) > 0) {
                                        $obj_success = mysql_fetch_object($res_sucess);
                                    }
                                    ?>
                                    <tr>
                                       
                                        <td colspan="2" style=" border-bottom:#ffbc09 1px solid;" height="20" bgcolor="#fee19f"> &nbsp;&nbsp;
                                            <strong style="color:#e25712;">
                                                Success stories
                                            </strong></td>

                                    </tr>
                                    <tr>							
                                        <td style="padding:5px;">
                                                    <? if (mysql_num_rows($res_sucess) > 0) { ?>
                                                <div>
                                                    <div style="float:left;"><a href="successful_stories.php#<?= $obj_success->auto_id; ?>" ><img src="successful_stories_images/<? echo $obj_success->image; ?>" width="101"  border="0" /></a></div>
                                                    <div style="float:right; width:240px;">
                                                        <?
                                                        $fd = fopen("successful_stories/" . $obj_success->file_name, "r");
                                                        if (filesize("successful_stories/" . $obj_success->file_name) > 0)
                                                            $content = fread($fd, filesize("successful_stories/" . $obj_success->file_name));
                                                        fclose($fd);
                                                        $next = substr($content, 150, strlen($content));
                                                        $spacepos = strpos($next, " ");
                                                        echo substr($content, 0, 150 + $spacepos) . "...";
                                                        ?>
                                                        <a href="successful_stories.php#<? echo $obj_success->auto_id; ?>" class="more">more</a> </div>
                                                </div>
<? }else { ?>
                                                <div>
                                                    <div tyle="float:left">  No Successful stories found..</div>
                                                    <div style="float:right; width:240px;"><a href="successful_stories.php" class="more">Success Stories</a></div>
                                                </div>
<? } ?>	
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td colspan="3" height="5"></td></tr>

                        <tr>
                            <td width="390" valign="top">
                                <table cellpadding="0" cellspacing="0" border="0" width="390" style="border:1px solid #ffbc09;">
                                    <tr>
                                        <td colspan="2" height="20" style=" border-bottom:#ffbc09 1px solid;" bgcolor="#fee19f"><strong style="color:#e25712; padding-left:5px;">Featured profile - Groom</strong></td>
                                    </tr>
                                    <tr>
                                        <?
                                        $resQry = "select *,tbl_register.id as RegId from tbl_register INNER JOIN tbl_photo ON tbl_register.id = tbl_photo.userid where tbl_register.enable = '1' and tbl_register.verifiedStatus = '1' and tbl_register.membership_type > 1 and tbl_register.featuredProfile = '1' and tbl_photo.approve = '1' and tbl_register.hideProfile = '0' and tbl_register.deleteProfile = '0' and (isnull(tbl_register.photo_password) or tbl_register.photo_password = '') and tbl_register.gender = 'M' ";
                                        //$resQry ="select *,tbl_register.id as RegId from tbl_register INNER JOIN tbl_photo ON tbl_register.id = tbl_photo.userid where tbl_register.enable = '1' and tbl_register.verifiedStatus = '1' and tbl_register.featuredProfile = '1' and tbl_photo.thumbnail !='' and tbl_photo.approve = 1 ";
                                        if ($config["userinfo"][id]) {
                                            $resQry .= " and tbl_register.id != '" . $config["userinfo"][id] . "' ";
                                        }
                                        $resQry .= "group by tbl_photo.userid";
                                        $resQry.=" order by rand() limit 0,2";
                                        //print_r($resQry);
                                        $res1 = Execute($resQry);
                                        //echo "num of images =>" . mysql_num_rows($res); 

                                        if (mysql_num_rows($res1) > 0) {
                                            $numImages = mysql_num_rows($res1);
                                            $total_width = 0;
                                            while ($feature_profile = mysql_fetch_array($res1)) {
                                                ?>
                                                <td style="padding:3px;">
                                                    <table cellpadding="0" width="200" cellspacing="0" border="0">
                                                        <tr>
                                                            <td>
                                                                <div>
                                                                    <div style="float:left;">											
                                                                        <? if ($feature_profile[photo_password]) { ?>
                                                                            <img src="images/protectedphoto.gif" style="cursor:pointer" width="75" height="75" onclick="window.location.href='view_member_profile.php?userid=<? echo $feature_profile[username]; ?>'">
                                                                        <? } else { ?>
                                                                            <img id="user<?= $feature_profile[RegId] ?>" name="user<?= $feature_profile[RegId] ?>" src="userthumbnail/<?= $feature_profile[photo] ?>"  style="cursor:pointer; border: #333333 1px solid;" width="75" height="75" onclick="window.location.href='view_member_profile.php?userid=<? echo $feature_profile[username]; ?>'">
        <? } ?>
                                                                        <?
                                                                        $year = substr($feature_profile[date_of_birth], 0, 4);
                                                                        $month = substr($feature_profile[date_of_birth], 5, 2);
                                                                        $date = substr($feature_profile[date_of_birth], 8, 2);
                                                                        ?>
                                                                    </div>
                                                                    <div style="float:right; width:120px;" class="feature"><strong style="color:#ff8101;"><?= $feature_profile[name] ?></strong><br><?= DOB2Age($year, $date, $month) ?> years<br>
                                                                        <?
                                                                        $mem_religion = GetSingleField("religion", "tbl_religion_master", "id", $feature_profile[religion]);
                                                                        echo $mem_religion;
                                                                        if ($feature_profile[caste]) {
                                                                            echo ",";
                                                                            echo substr(GetSingleField("caste", "tbl_caste_master", "id", $feature_profile[caste]), 0, 5);
                                                                        }
                                                                        echo '...<br>';
                                                                        echo substr(GetSingleField("occupation", "tbl_occupation_master", "id", $feature_profile[occupation]), 0, 8);
                                                                        ?>... &nbsp;&nbsp;&nbsp;&nbsp; <a href="view_member_profile.php?userid=<? echo $feature_profile[username]; ?>" class="more">More</a> </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table> 
                                                </td>									
    <? }
} else {
    echo"<tr><td algin='center'>Not Found Groom Featured profile.</td></tr>";
} ?>
<? if (mysql_num_rows($res1) == 1) { ?>
                                            <td style="padding:3px;"><table width="200" ><tr><td>&nbsp;</td></tr></table></td>		
<? } ?>						
                                    </tr>
                                    <tr><td colspan="2" height="20" align="right" style="padding-right:5px;" valign="top"><a href="feature_profile.php" class="more">View All</a></td></tr>
                                </table>
                            </td>
                            <td width="5"></td>
                            <!--success story-->
                            <td valign="top">
                                <table width="360" border="0"  cellspacing="0" cellpadding="0" style="display:none;">
                                    <tr>
                                        <td colspan="2" height="25" style=" border:#ffbc09 1px solid;" bgcolor="#fee19f" align="center"> &nbsp;&nbsp;<a href="wedding_directory.php" class="more"><b>Your Wedding Needs</b></a></td><!--<a href="">-->
                                    </tr>
                                    <tr>	
                                        <td style="padding-top:5px;"><? //fnBannerImage('index', 'right_bottom') ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td colspan="3" height="10"></td></tr>
                        <tr><td colspan="3">
                                <table align="left" cellpadding="1"  cellspacing="1" border="0">
<? include("includes/community_search.php"); ?>
                                </table>
                            </td></tr>
                        <!--ccavenue-->	<tr>
                            <td colspan="3">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border:#c9c363 1px solid;" bgcolor="#fccf56">

                        </tr><tr><td align="center"><strong><? echo date('l jS, F Y'); ?></strong></td></tr>

                    </table>
                    </td>
                    </tr>
                    <tr><td colspan="3" height="10"></td></tr>

                    </table>			
                </div>
            </div>

            <div id="div6" style="padding-right: 244px;">
                <div id="copy"><? include("includes/fotter.php") ?></div>
            </div>
        </div>
<?
$elapsed_seconds = number_format(time() % 60, 0);
?>
        <script language="javascript">
                //var seconds = parseInt("<?= $elapsed_seconds ?>");
                var seconds = 0;
                function timer()
                {
                    if (seconds<10)
                        fmt_seconds = "0"+seconds;
                    else
                        fmt_seconds = seconds;
		
                    seconds++;	
                    if(seconds>59)
                    {
                        minutes++;
                        seconds = 0;
                    }	
                    if (seconds == 3 ) {
                        document.getElementById('session_mes').style.display = 'none';
                        document.getElementById('mem_login').style.display = 'block';
                    }
		
                    window.setTimeout("init_timer()",500);	
                }
                function init_timer()
                {
                    objtimer = window.setTimeout("timer()",500);
                }
        </script>
        <?
        if ($_SESSION['_msg']) {
            $_SESSION['_msg'] = '';
            ?>	  
            <script language="javascript">
                    document.getElementById('session_mes').style.display = 'block';
                    document.getElementById('mem_login').style.display = 'none';
                    init_timer();
            </script>
<? } ?>
    </body>
</html>
