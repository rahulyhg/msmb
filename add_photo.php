<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
include("common/image_crop.php");
isMember();

//print_r($_SESSION);

$user = GetSingleRecord("tbl_register", "username", $config[userinfo][username]);

if ($action == "deleteimage") {

    //remove photo
    $photoid = GetVar("id");
    $resPhoto = Execute("select * from tbl_photo where id = '" . $photoid . "' and userid='" . $user['id'] . "'");
    if (mysql_num_rows($resPhoto) > 0) {
        $userphoto = mysql_fetch_array($resPhoto);
        if ($userphoto[photo]) {
            removeFile("userimages/" . $userphoto[photo]);
            removeFile("userthumbnail/" . $userphoto[photo]);
            removeFile("usernormal/" . $userphoto[photo]);
            removeFile("userenlarge/" . $userphoto[photo]);
        }
        $res = Execute("delete from tbl_photo where id = '" . $photoid . "'");
        $msg = "Photo deleted successfully";
    }
    $_SESSION['msg'] = $msg;
    header("Location: add_photo.php");
    die();
} else if ($action == "submit") {

    if ($_FILES['photo1']['name'] != "" && $_REQUEST['imgno'] == 1) {

        $photo1 = post_img($_FILES['photo1']['name'], $_FILES['photo1']['tmp_name'], "userimages");
        if ($photo1 !== false) {
            $photo_name = $photo1;
            $sql = "insert into tbl_photo(userid,photo) values('" . $_SESSION['id_user'] . "','$photo1')";
            $imgRes = Execute($sql);
            $pid = mysql_insert_id();
        }
    }

    if ($_FILES['photo2']['name'] != "" && $_REQUEST['imgno'] == 2) {
        $photo2 = post_img($_FILES['photo2']['name'], $_FILES['photo2']['tmp_name'], "userimages");
        if ($photo2 !== false) {
            $photo_name = $photo2;
            $sql = "insert into tbl_photo(userid,photo) values('" . $_SESSION['id_user'] . "','$photo2')";
            $imgRes = Execute($sql);
            $pid = mysql_insert_id();
        }
    }

    if ($_FILES['photo3']['name'] != "" && $_REQUEST['imgno'] == 3) {
        $photo3 = post_img($_FILES['photo3']['name'], $_FILES['photo3']['tmp_name'], "userimages");
        if ($photo3 !== false) {
            $photo_name = $photo3;
            $sql = "insert into tbl_photo(userid,photo) values('" . $_SESSION['id_user'] . "','$photo3')";
            $imgRes = Execute($sql);
            $pid = mysql_insert_id();
        }
    }

    if (isset($_POST['photo_password'])) {
        $res = Execute("update tbl_register set photo_password = '" . $_POST['photo_password'] . "' where id = '" . $user[id] . "'");
        $msg = "Photo protected successfully";
        $_SESSION['msg'] = $msg;
        header("Location: thanks.php?id=1");
        die();
    }
    // file resize code


    $siteurl = realpath(".");
    $image_magic = new pb_imageMagick("userimages/" . $photo_name);
    $image_magic1 = $image_magic->crop(75, 75, "userthumbnail/usr" . $pid . "_" . $config[userinfo][username] . ".jpg");
    $image_magic2 = $image_magic->crop(150, 160, "usernormal/usr" . $pid . "_" . $config[userinfo][username] . ".jpg");
    $image_magic3 = $image_magic->crop(350, 360, "userenlarge/usr" . $pid . "_" . $config[userinfo][username] . ".jpg");
    //passthru("convert ".$siteurl."/userimages/".$photo_name." -resize 75x ".$siteurl."\userthumbnail\usr".$pid.".jpg",$retval);
    //passthru("convert ".$siteurl."/userimages/".$photo_name." -resize 150x ".$siteurl."\usernormal\usr".$pid.".jpg",$retval);
    //passthru("convert ".$siteurl."/userimages/".$photo_name." -resize 310x ".$siteurl."\userenlarge\usr".$pid.".jpg",$retval);
    //print_r("<pre>");print_r($_FILES);print_r("</pre>");
    //print_r("<pre>");print_r($_REQUEST);print_r("</pre>"); exit;	


    /* $sim = imagecreatefromjpeg("userimages/".$photo_name);	
      $size = getimagesize("userimages/".$photo_name);
      $width = 500;
      $ratio = $size[1] / $size[0];
      $height = $width * $ratio;
      $height = sprintf("%.0f",$height);
      $dim = imagecreatetruecolor($width,$height);
      imagecopyresampled($dim,$sim,0,0,0,0,$width,$height,$size[0],$size[1]);
      $imfile="userimages/usr".$pid.".jpg";
      $fh=fopen("userimages/".$photo_name,"w");
      imagejpeg($dim,"userimages/usr".$pid.".jpg",100);
      fclose($fh); */

    $res = Execute("update tbl_photo set photo = 'usr" . $pid . "_" . $config[userinfo][username] . ".jpg' where id = '" . $pid . "'");

    //remove uploaded file
    //removeFile("userimages/".$photo_name);		

    header("Location: add_photo.php");
    die();
} else if ($action == "unprotect") {

    $res = Execute("update tbl_register set photo_password='' where id = '" . GetVar("id") . "'");
    $msg = "Photo unprotected successfully";
    $_SESSION['msg'] = $msg;
    header("Location: thanks.php?id=2");
    die();
}
if (!is_dir("userimages")) {

    mkdir("userimages");
    chmod("userimages", 0777);
}

$ar_photo = GetSingleRecord("tbl_photo", "userid", $user[id]);

if ($ar_photo) {
    // userPhotoApprove
    if ($ar_photo[approve]) {
        $res_photo1 = Execute("update tbl_register set userHasPhoto = '1', userPhotoApprove = '1' where id = '" . $user[id] . "'");
    } else {
        $res_photo1 = Execute("update tbl_register set userHasPhoto = '1', userPhotoApprove = '0' where id = '" . $user[id] . "'");
    }
    //$res_photo1 = Execute("update tbl_register set userHasPhoto = '1' where id = '" . $user[id] . "'");
} else {
    $res_photo1 = Execute("update tbl_register set userHasPhoto = '0',userPhotoApprove = '0' where id = '" . $user[id] . "'");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Maa Shakti Marriage Bureau</title>
        <link href="includes/style.css" type="text/css" rel="stylesheet"/>
        <link href="includes/payment.css" type="text/css" rel="stylesheet"/>
        <script language="JavaScript" src="includes/validate.js"></script>
        <script language="JavaScript" src="includes/functions.js"></script>	
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

                function validatePhoto() {
	
                    f1 = document.thisForm;
                    f1.imgno.value = 1;
                    if (isNull(f1.photo1,"Photo")) { return false; }
                    if (notJpgFile(f1.photo1,"Photo")) { return false; }
		
                }

                function validatePhoto1() {
                    f1 = document.thisForm;
                    f1.imgno.value = 2;
                    if (isNull(f1.photo2,"Photo")) { return false; }
                    if (notJpgFile(f1.photo2,"Photo")) { return false; }	
                }

                function validatePhoto2() {
                    f1 = document.thisForm;
                    f1.imgno.value = 3;
                    if (isNull(f1.photo3,"Photo")) { return false; }
                    if (notJpgFile(f1.photo3,"Photo")) { return false; }	
                }

                function passwordProtect() {
                    f1 = document.thisForm;
                    if (f1.photo_password.disabled == false) {
                        if (isNull(f1.photo_password,"password"))	{ return false; }
                        if (isLen(f1.photo_password,5,"Password")){ return false;}
                        if (isNull(f1.confirmpassword,"confirm Password")){return false; }       			
                        if (isNotSame(f1.photo_password,f1.confirmpassword,"Password","Confirm Password")) { return false;}
                    } else {
                        alert("Please select protect photo as 'Yes'");
                        return false;
                    }	
                }

                function passwordUnProtect(id) {
	
                    if(confirm("Are you sure want to unprotect the photo")) { 
                        location.href = "add_photo.php?action=unprotect&id="+id;	
                    }
                }

                function passwordProected() {

                    f1 = document.thisForm;
                    for(i = 0; i < f1.protect.length; i++) {
                        if (f1.protect[i].checked) {
                            if (f1.protect[i].value == 0) {				
                                f1.photo_password.value = "";
                                f1.confirmpassword.value = "";
                                f1.photo_password.disabled = true;
                                f1.confirmpassword.disabled = true;	
<? if ($user[photo_password]) { ?>
                                                                    document.getElementById("divprotect").style.display = "none";
                                                                    document.getElementById("divunprotect").style.display = "block";								
<? } ?>
                                                            }
                                                            if (f1.protect[i].value == 1) {				
                                                                f1.photo_password.disabled = false;
                                                                f1.confirmpassword.disabled = false;
                                                                //f1.btnprotect.disabled = "false";
<? if ($user[photo_password]) { ?>
                                                                    document.getElementById("divprotect").style.display = "block";
                                                                    document.getElementById("divunprotect").style.display = "none";
<? } ?>
                                                            }
                                                        }
                                                    }			
                                                }

                                                //-->
        </script>
    </head>
    <body class="homeinbody" onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
        <div class="menuleftimg">
            <table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
                    <td align="right"><? fnBannerImage(' ', 'top') ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
                </tr>  
                <tr>
                    <td colspan="2" valign="top">
                        <table width="850" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td valign="top">
<? include("includes/side_menu.php"); ?>
                                </td>
                                <td valign="top">
                                    <div style="padding:12px 0px 0px 0px;  float:left;" >
                                        <table width="573" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td valign="top">
                                                    <div class="titlebg"><h1 class="title">Upload Photos</h1>
                                                    </div>
                                                </td>
                                                <td align="right" class="title">					
<? if ($config[userinfo]) { ?>					
                                                        <strong style="color:#ffad03; font-size:13px;"> <b><?= $config[userinfo][name]; ?></b></strong>&nbsp; |&nbsp; <a href="logout.php?mode=member"  class="idclr">Logout</a>					
<? } ?>						
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <table width="100%" border="0" cellspacing="2" cellpadding="4" bgcolor="#fccf56" style="border:#8f830d solid 1px; margin-top:5px;">
                                                        <tr>
                                                            <td>
                                                                <div style="float:left; padding:10px 0px 0px 10px;">						
                                                                    <form name="thisForm" method="post" enctype="multipart/form-data">	
                                                                        <input type="hidden" name="action" class="proinbox" value="submit">
                                                                        <input type="hidden" name="imgno">
                                                                        <table width="500" border="0" align="center" cellspacing="0" cellpadding="0" class="probg">
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0"  bgcolor="#fff6bd" width="500">
                                                                                        <tr><td  class="tips_topbg"></td></tr>
                                                                                        <tr><td class="tips_midbg"><br><b class="add_title">Tips for the perfect photo</b>
                                                                                                <ul class="addphoto">

                                                                                                    <li>Make sure the photos should express yourself alone instead of group photos</li>
                                                                                                    <li>Enhance your photos with neat and clear</li>
                                                                                                    <li>For more clarity, please upload high resolution pictures</li>
                                                                                                </ul></td></tr>
                                                                                        <tr><td class="tips_btmbg"></td></tr>
                                                                                        <tr><td class="probdr"></td></tr></table>
                                                                            <tr><td height="20"></td></tr>
                                                                            <tr><td class="probdr" height="25"><b class="tbl_title">Add photos to your profile</b></td></tr>	
                                                                            <tr><td class="probdr"></td></tr>	
                                                                            <tr bgcolor="#FFFFFF">
                                                                                <td>
                                                                                    <table width="500" border="0" align="center" cellspacing="5" cellpadding="0" bgcolor="#fff6bd"  style="border:solid 1px #948036;">
                                                                                        <tr>

<?
$resPhoto = Execute("select * from tbl_photo where userid='" . $config[userinfo][id] . "' order by id");

$no_of_photos = mysql_num_rows($resPhoto);
$i = 1;
if (mysql_num_rows($resPhoto) > 0) {
    while ($userphoto = mysql_fetch_array($resPhoto)) {

        if ($userphoto[photo]) {
            $image = "userthumbnail/" . $userphoto[photo];
        }
        ?>
                                                                                                    <td align="center">
                                                                                                        <table  border="0" align="center" cellspacing="0" cellpadding="0">
                                                                                                            <tr><td>
                                                                                                                    <img  height="75" width="75" border="0" src="<?= $image ?>"> 
                                                                                                                </td></tr>	
                                                                                                            <tr>
                                                                                                                <td align="center">
                                                                                                                    <a href="javascript:DeleteImage1('<?= $userphoto[id] ?>')" class="more">delete image</a>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td align="center"> 
        <?
        if ($userphoto[approve]) {
            echo "(Approved)";
        } else {
            if ($userphoto[reject]) {
                echo "(Photo rejected)";
            } else {
                echo "(Not yet approved)";
            }
        }
        ?>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>	
                                                                                                    </td>

        <?
        $i++;
    }
}
?>
                                                                                            <? if ($no_of_photos <= 0) { ?>
                                                                                                <td class="probdr">
                                                                                                    <table  border="0" align="center" cellspacing="0" cellpadding="0">
                                                                                                        <tr bgcolor="#FFFFFF">
                                                                                                            <td align="center"><img src="images/nopicture.png" border="0" width="75" height="75"></td>
                                                                                                        </tr>		
                                                                                                        <tr bgcolor="#FFFFFF">
                                                                                                            <td><input type="file" name="photo1" class="txtbox"></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center">
                                                                                                                <input type="submit" value="upload" class="button" onClick="return validatePhoto()">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </td>
<? }
if ($no_of_photos == 1 || $no_of_photos <= 0) { ?>
                                                                                                <td>
                                                                                                    <table  border="0" align="center" cellspacing="0" cellpadding="0">	 
                                                                                                        <tr bgcolor="#FFFFFF">
                                                                                                            <td align="center"><img src="images/nopicture.png" border="0"></td>
                                                                                                        </tr>		
                                                                                                        <tr bgcolor="#FFFFFF">
                                                                                                            <td><input type="file" name="photo2" class="txtbox"></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center">
                                                                                                                <input type="submit" value="upload" class="button" onClick="return validatePhoto1()">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </td>
<? }
if ($no_of_photos < 3 || $no_of_photos <= 0) { ?>
                                                                                                <td>
                                                                                                    <table  border="0" align="center" cellspacing="0" cellpadding="0">	 
                                                                                                        <tr bgcolor="#FFFFFF">
                                                                                                            <td align="center"><img src="images/nopicture.png" border="0"></td>
                                                                                                        </tr>		
                                                                                                        <tr bgcolor="#FFFFFF">
                                                                                                            <td><input type="file" name="photo3" class="txtbox"></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center">
                                                                                                                <input type="submit" value="upload" class="button" onClick="return validatePhoto2()">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </td>
<? } ?>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr><td class="probdr">&nbsp;</td></tr>										
                                                                            <tr><td>									
                                                                                    <table cellpadding="0" cellspacing="0" border="0"  bgcolor="#fff6bd" width="500">
                                                                                        <tr><td  class="tips_topbg"></td></tr>
                                                                                        <tr><td class="tips_midbg"><br><b class="add_title">Email your photos</b></td></tr>
                                                                                        <tr><td class="tips_midbg">&nbsp;</td></tr>
                                                                                        <tr><td class="tips_midbg" style="padding-left:20px">Email your photo at - info@maashaktimarriage.com with your Matrimony ID and Password. We will reduce the image size and upload it.</tr>									
                                                                                        <tr><td class="tips_midbg">&nbsp;</td></tr>
                                                                                        <tr><td class="tips_midbg"><b style="padding-left:50px">When to Email photo?</b>
                                                                                                <ul class="addphoto">
                                                                                                    <li>If your photo is not in GIF/JPG format</li>									
                                                                                                    <li>Your photo file size is more than 1 MB</li>
                                                                                                    <li>Unable to upload photo</li>
                                                                                                    <li>Internet connection is slow</li>
                                                                                                </ul></td></tr>
                                                                                        <tr><td class="tips_btmbg"></td></tr>
                                                                                        <tr><td class="probdr"></td></tr></table>
                                                                                </td></tr>
                                                                            <tr><td class="probdr">&nbsp;</td></tr>
                                                                            <tr><td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0"  bgcolor="#fff6bd" width="500">
                                                                                        <tr><td  class="tips_topbg"></td></tr>
                                                                                        <tr><td class="tips_midbg"><br><b class="add_title">Send your photos through post</b></td></tr>
                                                                                        <tr><td class="tips_midbg">&nbsp;</td></tr>
                                                                                        <tr><td class="tips_midbg" style="padding-left:20px">
                                                                                                Kindly mention your matrimony ID and your password at the back of the photo and send them by post to our <a href="contact_us.php" class="more">office</a>. We will upload your photo, absolutely FREE. If you want your photos back, enclose a self-addressed envelope with pre-paid postage.
                                                                                            </td></tr>									
                                                                                        <tr><td class="tips_midbg">&nbsp;</td></tr>
                                                                                        <tr><td class="tips_btmbg"></td></tr>
                                                                                        <tr><td class="probdr"></td></tr></table>
                                                                                </td></tr>									

<? if ($no_of_photos > 0) { ?>
                                                                                <tr><td class="probdr"><b>&nbsp;</b></td></tr>
                                                                                <tr><td class="probdr"><b class="tbl_title">Protect Photo</b></td></tr>
                                                                                <tr><td class="probdr">&nbsp;</td></tr>						
                                                                                <tr><td class="probdr">If you wish to protect your photo and show it only to select members, you can use this feature.</td></tr>																	
    <? if ($user[photo_password]) { ?>
                                                                                    <tr><td class="probdr">Your photo is protected.  If you want to change password, enter the new password and click protect.</td></tr>							
                                                                                <? } ?>															
                                                                                <tr>
                                                                                    <td style="padding-top:10px;"><font color="#990000">Protect Photo</font>&nbsp;<input type="radio" name="protect" value="0" checked onClick="passwordProected()">&nbsp;No&nbsp;&nbsp;<input type="radio" name="protect" value="1" onClick="passwordProected()" <? if ($user[photo_password]) { ?> checked <? } ?>>&nbsp;Yes 
                                                                                    </td>												
                                                                                </tr>
                                                                                <tr><td>&nbsp;</td></tr>	
                                                                                <tr>
                                                                                    <td style="color:#996666;"><b>If yes, please enter a password and click protect.
    <? if ($user[photo_password]) { ?>
                                                                                                <br> If no, select no and click unprotect</b>
                                                                                            <? } ?><br><br>

                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <table border="0" width="100%" align="left" cellspacing="5" cellpadding="5">
                                                                                            <tr>
                                                                                                <td width="39%">Photo Password</td>
                                                                                                <td width="61%"><input type="password" name="photo_password" class="txtbox"></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td >Confirm Photo Password</td>
                                                                                                <td style="padding-right:200px;"><input type="password" name="confirmpassword" class="txtbox"></td>
                                                                                            </tr>			
                                                                                            <tr><td align="center" colspan="3" style="padding-right:150px;">
                                                                                                    <div id="divprotect">
                                                                                                        <input type="submit" value="Protect" name="btnprotect" class="button" onClick="return passwordProtect()">												
                                                                                                    </div>
                                                                                                    <div id="divunprotect" style="display:none">
                                                                                                        <input type="button" value="Unprotect" name="btnunprotect" class="button" onClick="passwordUnProtect('<?= $user[id] ?>')">
                                                                                                    </div>

                                                                                                </td></tr>							

                                                                                        </table>			
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="probdr" align="center" style="padding-left:74px;"></td>
                                                                                </tr>	
                                                                                <script language="javascript" type="text/javascript">
                                                                                        passwordProected();
                                                                                </script>						
<? } ?>
                                                                        </table>
                                                                    </form>	
                                                                </div>

                                                            </td></tr>
                                                    </table>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>

                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
<? include("includes/fotter.php") ?>
                    </td>
                </tr>
            </table>
            <div>
                </body>
                </html>
