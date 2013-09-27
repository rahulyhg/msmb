<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
isMember();

$package = $_REQUEST['rdPackage'];
$id = $_SESSION['id_user'];
if ($_REQUEST['rdPackage'] != "") {
    $sql = "select * from tbl_packages where package_id='$package'";
    $res = mysql_query($sql);
    if (mysql_num_rows($res) > 0) {
        $obj = mysql_fetch_object($res);
    }
}

if ($_REQUEST['Mode'] == "Save") {
    $package = $_REQUEST['rdPackage'];
    $id = $_SESSION['id_user'];

    $sql_userid = "select * from tbl_register where id='" . $_REQUEST['txtHidMemberAutoid'] . "'";
    $res_userid = mysql_query($sql_userid);
    if (mysql_num_rows($res_userid) > 0) {
        $obj_userid = mysql_fetch_object($res_userid);
        $prev_expdate = $obj_userid->package_expiry_date;
        $prev_phone_allowed = $obj_userid->phone_allowed;
        $prev_address_allowed = $obj_userid->address_allowed;
    }

    $sql_duration = "select (TO_DAYS('" . $prev_expdate . "')-to_days(CURRENT_DATE())) as difference";
    $res_duration = mysql_query($sql_duration);
    if (mysql_num_rows($res_duration) > 0) {
        $obj_duration = mysql_fetch_object($res_duration);
    }

    if ($obj_duration->difference > 0) {
        $diff_duration = $obj_duration->difference;
    } else {
        $diff_duration = 0;
    }

    $sql = "select * from tbl_packages where package_id = '" . $_REQUEST['rdPackage'] . "'";
    $res = mysql_query($sql);
    if (mysql_num_rows($res) > 0) {
        $obj = mysql_fetch_object($res);
    }

    $total_days = $obj->valid_period * 30;
    $package_duration = $total_days;
    $total_days = $total_days + $diff_duration;

    $total_phone_allowed = ($obj->phone_number_allowed + $prev_phone_allowed);
    $total_address_allowed = ($obj->address_allowed + $prev_address_allowed);

    $sql_date = "select date_add(CURRENT_DATE(), INTERVAL " . $total_days . " DAY) as expdate";
    $res_date = mysql_query($sql_date);
    if (mysql_num_rows($res_date) > 0) {
        $obj_date = mysql_fetch_object($res_date);
    }


    $payment_type = str_replace("_", " ", $_REQUEST['rdPaymentType']);
    $door_mode_payment = str_replace("_", " ", $_REQUEST['rdModePayment']);

    if (!$_REQUEST['txtDemandDate']) {
        $_REQUEST['txtDemandDate'] = '0000-00-00';
    }

    if (!$_REQUEST['txtMoneyDate']) {
        $_REQUEST['txtMoneyDate'] = '0000-00-00';
    }

    $sql_insert = "insert into tbl_member_profile_upgrade(order_no,member_unique_id,member_auto_id,member_id,package_id,package_duration_time,package_expiry_date,payment_mode,cheque_number,bank_name,cheque_date,moneyorder_number,post_office_name,moneyorder_date,created_date,total_no_days,street_address,area,city,state,country,contact_person_name,contact_phone,best_time_contact,contact_email,door_mode_payment,phone_allowed,address_allowed)";
    $sql_insert.="values('" . $_SESSION['upgrade_orderno'] . "','" . $_SESSION['member_unique_id'] . "','" . $_SESSION['id_user'] . "','" . $_SESSION['userid'] . "','" . $package . "','" . $package_duration . "','" . $obj_date->expdate . "','" . $payment_type . "','" . $_REQUEST['txtDemandNumber'] . "','" . $_REQUEST['txtBankName'] . "','" . $_REQUEST['txtDemandDate'] . "',";
    $sql_insert.=" '" . $_REQUEST['txtMoneyOrderNumber'] . "','" . $_REQUEST['txtPostofficeName'] . "','" . $_REQUEST['txtMoneyDate'] . "',CURRENT_DATE(),'" . $total_days . "','" . $_REQUEST['txtStreet'] . "','" . $_REQUEST['txtArea'] . "','" . $_REQUEST['txtCity'] . "','" . $_REQUEST['txtState'] . "','" . $_REQUEST['cmbCountry'] . "','" . $_REQUEST['txtContactName'] . "','" . $_REQUEST['txtContactPhone'] . "','" . $_REQUEST['txtTimeContact'] . "','" . $_REQUEST['txtContactEmail'] . "','" . $door_mode_payment . "','" . $total_phone_allowed . "','" . $total_address_allowed . "')";

    $res2 = mysql_query($sql_insert);

    $select_usr = "select username,name,mobileNumber from tbl_register where username='" . $_SESSION['userid'] . "'";
    $result_usr = mysql_query($select_usr, $link);
    if ($val = mysql_fetch_array($result_usr)) {
        $h_username = $val[0];
        $h_name = $val[1];
        $h_mobile = $val[2];

        $sms_subject = $h_mobile;
        if ($sms_subject != "") {
            $headers1 = "From: sms@thecreativeit.com.com\n";
            $sms_email1 = "sms@thecreativeit.com.com";
            $sms_message1 = "Your request for the account upgradation is posted successfully.After admin approval,your account will be activated.";
            $sms_email2 = "cretivedesignforyou@gmail.com";
            $mail_sms1 = @mail($sms_email2, $sms_subject, $sms_message1, $headers1);
            $mail_sms1 = @mail($sms_email1, $sms_subject, $sms_message1, $headers1);
        }
        if (mysql_error($res2)) {
            echo mysql_error();
            die();
        }
        $insert_id = mysql_insert_id();
        $_SESSION['msg'] = "Updated Successfully...";
        if ($_REQUEST['rdPaymentType'] == "CCAvenue_Payment") {
            header("Location: member_checkout.php?member_id=" . $insert_id);
            die();
        } else {
            header("Location: upgrade_details.php?rdPackage=" . $package . "&action=success");
            die();
        }
    }
    ?>

    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
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

                    function fnProceedCheckout(){
                        var strpaymenttype="";
                        for(ic=0;ic<=6;ic++){
                            if(document.thisForm.elements["rdPaymentType"][ic].checked==true)
                                strpaymenttype=document.thisForm.elements["rdPaymentType"][ic].value;
                        }
                        if(notChecked(document.thisForm.elements["rdPaymentType"],"any one Payment option")){return false;}			
                        if(strpaymenttype=="Money_order"){	
                            if (isNull(document.thisForm.txtMoneyOrderNumber,"Money Order number")) { return false; }
                            if (isNull(document.thisForm.txtPostofficeName,"Post office Name with Location ")) { return false; }
                            if (isNull(document.thisForm.txtMoneyDate,"Date")) { return false; }
                        }
                        if(strpaymenttype=="Demand_draft"){	
                            if (isNull(document.thisForm.txtDemandNumber,"Demand Draft number")) { return false; }
                            if (isNull(document.thisForm.txtBankName,"Bank Name with Location")) { return false; }
                            if (isNull(document.thisForm.txtDemandDate,"Demand Date")) { return false; }
                        }
                        if(strpaymenttype=="Pay_at_post_office"){	
                            if (isNull(document.thisForm.txtStreet,"Street Address")) { return false; }
                            if (isNull(document.thisForm.txtArea,"Area")) { return false; }
                            if (isNull(document.thisForm.txtCity,"City")) { return false; }
                            if (isNull(document.thisForm.txtState,"State")) { return false; }
                        }
                        if(strpaymenttype=="Door_step_service"){	
                            if (isNull(document.thisForm.txtStreet1,"Street Address")) { return false; }
                            if (isNull(document.thisForm.txtArea1,"Area")) { return false; }
                            if (isNull(document.thisForm.txtCity1,"City")) { return false; }
                            if (isNull(document.thisForm.txtState1,"State")) { return false; }
                            if (isNull(document.thisForm.txtContactName,"Contact Person Name")) { return false; }
                            if (isNull(document.thisForm.txtContactPhone,"Contact Phone Number")) { return false; }
                            if (isNull(document.thisForm.txtTimeContact,"Best Time of Contact")) { return false; }
                            if (isNull(document.thisForm.txtContactEmail,"Email Address")) { return false; }
                            if (notEmail(document.thisForm.txtContactEmail,"Email Address")) { return false; }
                            if(notChecked(document.thisForm.elements["rdModePayment"],"Mode of Payment")){return false;}			
                        }		
                        document.thisForm.action="upgrade_details.php?Mode=Save";
                        document.thisForm.submit();
                    }
    	
    	
    	
    	
                    function fnPayment(){
                        for(ic=0;ic<=6;ic++){
                            if(document.thisForm.elements["rdPaymentType"][ic].checked==true){
                                if(document.thisForm.elements["rdPaymentType"][ic].value=="Pay_at_post_office"){
                                    document.getElementById("tbl_Postoffice").style.display="block";	
                                    document.getElementById("tbl_Doorstep").style.display="none";
                                    document.getElementById("tbl_Demand").style.display="none";				
                                    document.getElementById("tbl_MoneyOrder").style.display="none";									
                                }else if(document.thisForm.elements["rdPaymentType"][ic].value=="Door_step_service"){
                                    document.getElementById("tbl_Doorstep").style.display="block";
                                    document.getElementById("tbl_Postoffice").style.display="none";				
                                    document.getElementById("tbl_Demand").style.display="none";				
                                    document.getElementById("tbl_MoneyOrder").style.display="none";
                                }else if(document.thisForm.elements["rdPaymentType"][ic].value=="Money_order"){					
                                    document.getElementById("tbl_MoneyOrder").style.display="block";
                                    document.getElementById("tbl_Doorstep").style.display="none";
                                    document.getElementById("tbl_Postoffice").style.display="none";
                                    document.getElementById("tbl_Demand").style.display="none";												
                                }else if(document.thisForm.elements["rdPaymentType"][ic].value=="Demand_draft"){
                                    document.getElementById("tbl_Demand").style.display="block";
                                    document.getElementById("tbl_MoneyOrder").style.display="none";
                                    document.getElementById("tbl_Doorstep").style.display="none";
                                    document.getElementById("tbl_Postoffice").style.display="none";																											
                                }else{
                                    document.getElementById("tbl_MoneyOrder").style.display="none";
                                    document.getElementById("tbl_Doorstep").style.display="none";
                                    document.getElementById("tbl_Postoffice").style.display="none";
                                    document.getElementById("tbl_Demand").style.display="none";
                                } 
    				
                            }
                        }
                    }	
                    //-->
            </script>
        </head>
        <body class="homeinbody" onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
            <div class="menuleftimg">
                <table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
                        <td align="right"><? fnBannerImage('  ', 'top') ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
                    </tr>  
                    <tr>
                        <td colspan="2" valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td valign="top">
    <? include("includes/side_menu.php"); ?>
                                    </td>
                                    <td valign="top">
                                        <div style="padding:12px 0px 0px 4px; float:left;" >
                                            <table width="573" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td valign="top">
                                                        <div class="titlebg"><h1 class="title">Upgrade Membership</h1></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table width="100%" border="0" cellspacing="2" cellpadding="4" >
                                                            <tr><td>
                                                                    <form name="thisForm" method="post">
                                                                        <input type="hidden" name="rdPackage" value="<? echo $_REQUEST['rdPackage']; ?>">
                                                                        <input type="hidden" name="txtHidMemberAutoid" value="<? echo $_SESSION['id_user']; ?>">



                                                                        <div style="float:left; padding:0px 0px 0px 0px;">
                                                                            <table order="0" cellspacing="0" width="50%" cellpadding="0" >
    <? if ($_REQUEST['action'] != "success") { ?>
                                                                                    <tr bgcolor="#dcddde"> 
                                                                                        <td  height="25" width="50%" style="padding-left:10px"><font color="#a80326"><b>Package Name</b></font></td>
                                                                                        <td style="padding-left:10px" bgcolor="#ebebec"><font color="#a80326"><b><?= str_replace('package', 'membership', $obj->package_name); ?></b></font></td>
                                                                                    </tr>
                                                                                    <tr  bgcolor="#f5f5f6">
                                                                                        <td  height="25" style="border-bottom:#FFFFFF 1px solid; padding-left:10px;">Package Price(INR)</td>
                                                                                        <td align="left" style="border-bottom:#FFFFFF 1px solid; padding-left:10px;"><?= $obj->package_price; ?></td>
                                                                                    </tr>

                                                                                    <tr bgcolor="#f5f5f6">
        <? if ($obj->phone_allowed_status == "L")
            $s = 0;else
            $s = 1; ?>
                                                                                        <? if ($s == 1)
                                                                                            $val = "Unlimited";else
                                                                                            $val = $obj->phone_number_allowed; ?>
                                                                                        <td  height="25" style="border-bottom:#FFFFFF 1px solid; padding-left:10px;">Phone numbers allowed</td>
                                                                                        <td align="left" style="border-bottom:#FFFFFF 1px solid; padding-left:10px;"><?= $val; ?></td>
                                                                                    </tr>

                                                                                    <tr bgcolor="#f5f5f6">
        <? if ($obj->address_allowed_status == "L")
            $s = 0;else
            $s = 1; ?>
        <? if ($s == 1)
            $val = "Unlimited";else
            $val = $obj->address_allowed; ?>
                                                                                        <td  height="25" style="border-bottom:#FFFFFF 1px solid; padding-left:10px;">Addresses allowed</td>
                                                                                        <td  align="left" style="border-bottom:#FFFFFF 1px solid; padding-left:10px;"><?= $val; ?></td>
                                                                                    </tr>

                                                                                    <tr bgcolor="#f5f5f6">
                                                                                        <td  height="25" style="border-bottom:#FFFFFF 1px solid; padding-left:10px;">Validity Period</td>
                                                                                        <td width="373" align="left" style="border-bottom:#FFFFFF 1px solid; padding-left:10px;"><?= $obj->valid_period . " Months"; ?></td>
                                                                                    </tr>
                                                                                    <tr><td colspan="2" bgcolor="#f5f5f6" height="5"></td></tr>
                                                                                    <tr bgcolor="#f5f5f6">
                                                                                        <td height="25" colspan="2" style=" padding-left:10px;"><font color="#a80326"><b>Additional Features</b></font></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2" bgcolor="#f5f5f6" style=" padding-left:10px;">
                                                                                            <font color="#a80326"><b><?
        $fd = fopen("package_features/" . $obj->file_name, "r");
        $content = fread($fd, filesize("package_features/" . $obj->file_name));
        fclose($fd);
        echo $content;
        ?></b></font>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr><td colspan="2" bgcolor="#f5f5f6" height="5"></td></tr>
                                                                                    <tr><td colspan="2" bgcolor="#ffffff" height="10"></td></tr>
                                                                                    <tr><td colspan="2"><font color="#a80326"><b>&nbsp;&nbsp;&nbsp;Payment Options</b></font></td></tr>
                                                                                    <tr><td colspan="2" bgcolor="#ffffff" height="10"></td></tr>
                                                                                    <tr><td colspan="2">
                                                                                            <table align="left" cellpadding="1"   cellspacing="1" width="400">
                                                                                                    <tr bgcolor="#f9e7a3"><td colspan="2"><input type="radio" name="rdPaymentType" value="Cash_at_Office" onClick="fnPayment();"><!-- </td><td>-->Cash at Shaadi Address</td></tr>
                                                                                                <tr bgcolor="#f9e7a3"><td colspan="2"><input type="radio" name="rdPaymentType" value="Money_order" onClick="fnPayment();">Money order</td></tr>
                                                                                                <tr bgcolor="#fffcdb">
                                                                                                    <td colspan="2"> 
                                                                                                        <table align="left" cellpadding="1" cellspacing="1" border="0" width="370" id="tbl_MoneyOrder" style="display:none;"> 
                                                                                                            <tr><td width="50%">Money Order number <font color="#FF0000">*</font> </td><td><input type="text" name="txtMoneyOrderNumber" class="packtxtbox" maxlength="25"></td></tr>
                                                                                                            <tr><td width="50%">Post office Name with Location <font color="#FF0000">*</font></td><td><input type="text" name="txtPostofficeName" class="packtxtbox" maxlength="255"></td></tr>											
                                                                                                            <tr><td width="50%">Date <font color="#FF0000">*</font></td><td><input type="text" name="txtMoneyDate" class="packtxtbox" maxlength="20" id="txtMoneyDate">&nbsp;<img src="images/cal.gif" border="0" style="cursor:pointer" onClick="fnShowCalendar(document.thisForm.txtMoneyDate);"> </td></tr>											
                                                                                                        </table>
                                                                                                    </td>	
                                                                                                </tr>									 
                                                                                                <tr bgcolor="#f9e7a3"><td colspan="2"><input type="radio" name="rdPaymentType" value="Demand_draft" onClick="fnPayment();">Demand draft</td></tr>								 
                                                                                                <tr bgcolor="#fffcdb">
                                                                                                    <td colspan="2"> 
                                                                                                        <table align="left" cellpadding="1" cellspacing="1" border="0" width="400" id="tbl_Demand" style="display:none;"> 
                                                                                                            <tr><td width="50%">Demand Draft number <font color="#FF0000">*</font></td><td><input type="text" name="txtDemandNumber" class="packtxtbox" maxlength="25"></td></tr>
                                                                                                            <tr><td width="50%">Bank Name with Location <font color="#FF0000">*</font></td><td><input type="text" name="txtBankName" class="packtxtbox" maxlength="255"></td></tr>											
                                                                                                            <tr><td width="50%">Date <font color="#FF0000">*</font></td><td><input type="text" name="txtDemandDate" class="packtxtbox" maxlength="20" readonly="true">&nbsp;<img src="images/cal.gif" border="0" style="cursor:pointer" onClick="fnShowCalendar(document.thisForm.txtDemandDate);"> </td></tr>											
                                                                                                        </table>
                                                                                                    </td>	
                                                                                                </tr>									 
                                                                                                <tr bgcolor="#f9e7a3"><td><input type="radio" name="rdPaymentType" value="ICICI_Online_account" onClick="fnPayment();"><!--</td><td>-->ICICI Online account</td></tr>
                                                                                                <tr bgcolor="#f9e7a3">
                                                                                                    <td valign="top" colspan="2"><input type="radio" name="rdPaymentType" value="Pay_at_post_office" onClick="fnPayment();">Pay at post office </td>
                                                                                                </tr> 

                                                                                                <tr bgcolor="#fffcdb">
                                                                                                    <td colspan="2"> 
                                                                                                        <table align="left" cellpadding="1" cellspacing="1" border="0" width="400" id="tbl_Postoffice" style="display:none;"> 
                                                                                                            <tr><td width="50%">Member id <font color="#FF0000">*</font> </td><td width="50%"><input type="text" name="txtMemberID" class="packtxtbox" value="<? echo $_SESSION['userid']; ?>"></td></tr>
                                                                                                            <tr><td width="50%">Member Name <font color="#FF0000">*</font> </td><td width="50%"><input type="text" name="txtMemberName" class="packtxtbox" value="<? echo $_SESSION['member_name']; ?>"></td></tr>
                                                                                                            <tr><td colspan="2"><b>Address details</b> <font color="#FF0000">*</font></td></tr>
                                                                                                            <tr><td width="50%">Street Address</td><td><input type="text" name="txtStreet" class="packtxtbox" maxlength="255"></td></tr>
                                                                                                            <tr><td width="50%">Area</td><td><input type="text" name="txtArea" class="packtxtbox" maxlength="255"></td></tr>
                                                                                                            <tr><td width="50%">City</td><td><input type="text" name="txtCity" class="packtxtbox" maxlength="255"></td></tr>
                                                                                                            <tr><td width="50%">State</td><td><input type="text" name="txtState" class="packtxtbox" maxlength="255"></td></tr>
                                                                                                            <tr><td width="50%">Country</td><td>
                                                                                                                    <select name="cmbCountry" class="cmbbox">
                                                                                                                        <script language="javascript">
                                                                                                                                GetCountry('India','');									
                                                                                                                        </script>
                                                                                                                    </select>
                                                                                                                </td></tr>						
                                                                                                        </table>
                                                                                                    </td>
                                                                                                <tr bgcolor="#f9e7a3"><td colspan="2">
                                                                                                        <input type="radio" name="rdPaymentType" value="Door_step_service" onClick="fnPayment();">Door step service.
                                                                                                    </td></tr>
                                                                                                <tr bgcolor="#fffcdb"><td colspan="2">
                                                                                                        <table align="left" cellpadding="1" cellspacing="1" border="0" width="400" id="tbl_Doorstep" style="display:none;"> 
                                                                                                            <tr><td width="50%">Member id <font color="#FF0000">*</font> </td><td><input type="text" name="txtMemberID" class="packtxtbox" value="<? echo $_SESSION['userid']; ?>"></td></tr>
                                                                                                            <tr><td width="50%">Member Name <font color="#FF0000">*</font> </td><td><input type="text" name="txtMemberName" class="packtxtbox" value="<? echo $_SESSION['member_name']; ?>"></td></tr>
                                                                                                            <tr><td colspan="2"><b>Address details</b> <font color="#FF0000">*</font></td></tr>
                                                                                                            <tr><td width="50%">Street Address</td><td><input type="text" name="txtStreet1" class="packtxtbox" maxlength="255"></td></tr>
                                                                                                            <tr><td width="50%">Area</td><td><input type="text" name="txtArea1" class="packtxtbox" maxlength="255"></td></tr>
                                                                                                            <tr><td width="50%">City</td><td><input type="text" name="txtCity1" class="packtxtbox" maxlength="255"></td></tr>
                                                                                                            <tr><td width="50%">State</td><td><input type="text" name="txtState1" class="packtxtbox" maxlength="255"></td></tr>
                                                                                                            <tr><td width="50%">Country</td><td>
                                                                                                                    <select name="cmbCountry" class="cmbbox">
                                                                                                                        <script language="javascript">
                                                                                                                                GetCountry('India','');									
                                                                                                                        </script>
                                                                                                                    </select>
                                                                                                                </td></tr>	
                                                                                                            <tr><td>Contact person Name</td><td><input type="text" name="txtContactName" class="packtxtbox" maxlength="255"></td></tr>					
                                                                                                            <tr><td>Contact Phone Number</td><td><input type="text" name="txtContactPhone" class="packtxtbox" maxlength="255"></td></tr>					
                                                                                                            <tr><td>Best time of contact</td><td><input type="text" name="txtTimeContact" class="packtxtbox" maxlength="255"></td></tr>	
                                                                                                            <tr><td>Email Address</td><td><input type="text" name="txtContactEmail" class="packtxtbox" maxlength="255"></td></tr>					
                                                                                                            <tr>
                                                                                                                <td>Mode ofPayment</td>
                                                                                                                <td>
                                                                                                                    <input type="radio" name="rdModePayment" value="Demand_Draft">Demand Draft <br/>
                                                                                                                    <input type="radio" name="rdModePayment" value="Cash">Cash<br/>
                                                                                                                </td>
                                                                                                            </tr>					



                                                                                                        </table>
                                                                                                    </td></tr>
                                                                                            </table>
                                                                                        </td></tr>						 

                                                                                    <tr bgcolor="#FFFFFF">
                                                                                        <td colspan="2" align="center">
                                                                                            <input type="button" name="btnProceedcheckout" value="Proceed Checkout" class="button2" style="width:140px;" onClick="fnProceedCheckout();"> 
                                                                                        </td>
                                                                                    </tr>	 

    <? }else { ?>		

                                                                                    <tr bgcolor="#FFFFFF">
                                                                                        <td colspan="2" align="center">
                                                                                            <strong>Your Membership upgrade request has been posted successfully..</strong>
                                                                                        </td>
                                                                                    </tr>
    <? } ?>					
                                                                            </table>



                                                                        </div>

                                                                </td>
                                                                </form>

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
        </div>
    </body>
</html>
