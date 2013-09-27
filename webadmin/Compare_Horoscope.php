<?php
ob_start();
session_start();
include("includes/connection.php");
include("includes/functions.php");
include("includes/menu.php");
$linkid=db_connect();
$arg="successful_stories_status";
isAdmin($arg);

if($_REQUEST['Mode']=="Save"){
	$precent_date=getdate();
	$filename=$precent_date[year].$precent_date[mon].$precent_date[mday].$precent_date[hours].$precent_date[minutes].$precent_date[seconds];	
	$filename=$filename.".html";
	if($HTTP_POST_FILES['fileImage']['name']!=""){
		$img_story_image=post_img($HTTP_POST_FILES['fileImage']['name'], $HTTP_POST_FILES['fileImage']['tmp_name'],"../successful_stories_images");
		$thumbnail_name="thumb_".$img_story_image;
		fnMagic($HTTP_POST_FILES['fileImage']['tmp_name'],"../successful_stories_images/".$thumbnail_name,120,120);	
		$fileid = fopen("../successful_stories/".$filename,"w+");
		$strFileContent=$_REQUEST['description'];
		$strmsg = $strFileContent;
		fwrite($fileid,$strmsg);
		fclose($fileid);
		$table="tbl_successful_stories";
		$insert_string=array("title"=>$_REQUEST['txtTitle'],"author"=>$_REQUEST['txtAuthor'],"bride"=>$_REQUEST['cmbBride'],"groom"=>$_REQUEST['cmbGroom'],"marriage_date"=>$_REQUEST['txtDate'],"marriage_year"=>$_REQUEST['txtYear'],"file_name"=>$filename,"image"=>$img_story_image,"created_date"=>date('U'));	
		$status=DB_Insert($linkid,$table,$insert_string);							
		$_SESSION['_msg']="Story details stored successfully.";
	}	
?>
<script language="JavaScript">window.location.href="add_successful_stories.php";</script>
<?
die();	
}

if($_REQUEST['Mode']=="Update"){
	
	$res_chk=mysql_query("select * from tbl_successful_stories where auto_id=".$_REQUEST['story_id']);
	if(mysql_num_rows($res_chk)>0){
		$obj=mysql_fetch_object($res_chk);
	}
	
	if($HTTP_POST_FILES['fileImage']['name']!=""){
		$img_story_image=post_img($HTTP_POST_FILES['fileImage']['name'], $HTTP_POST_FILES['fileImage']['tmp_name'],"../successful_stories_images");
		$thumbnail_name="thumb_".$img_story_image;
		fnMagic($HTTP_POST_FILES['fileImage']['tmp_name'],"../successful_stories_images/".$thumbnail_name,120,120);	
		
		if(file_exists("../successful_stories_images/".$_REQUEST['txtHidImage'])){
			unlink("../successful_stories_images/".$_REQUEST['txtHidImage']);
			unlink("../successful_stories_images/"."thumb_".$_REQUEST['txtHidImage']);
		}
				
		$fp = fopen("../successful_stories/".$obj->file_name,"w+");
		$strFileContent=$_REQUEST['description'];
		$strmsg = $strFileContent;
		fwrite($fp,$strmsg);
		fclose($fp);
		
		$sql_update="update tbl_successful_stories set title='".$_REQUEST['txtTitle']."',author='".$_REQUEST['txtAuthor']."',bride='".$_REQUEST['cmbBride']."',groom='".$_REQUEST['cmbGroom']."',marriage_date='".$_REQUEST['txtDate']."',marriage_year='".$_REQUEST['txtYear']."',image='".$img_story_image."' where auto_id=".$_REQUEST['story_id'];
		mysql_query($sql_update);
		echo mysql_error();
		$_SESSION['_msg']="Story details updated successfully.";										
		
	}else{		
		
		$fp = fopen("../successful_stories/".$obj->file_name,"w+");
		$strFileContent=$_REQUEST['description'];
		$strmsg = $strFileContent;
		fwrite($fp,$strmsg);
		fclose($fp);
		
		$sql_update="update tbl_successful_stories set title='".$_REQUEST['txtTitle']."',author='".$_REQUEST['txtAuthor']."',bride='".$_REQUEST['cmbBride']."',groom='".$_REQUEST['cmbGroom']."',marriage_date='".$_REQUEST['txtDate']."',marriage_year='".$_REQUEST['txtYear']."' where auto_id=".$_REQUEST['story_id'];
		mysql_query($sql_update);
		echo mysql_error();
		$_SESSION['_msg']="Story details updated successfully.";	
			
	}

?>
<script language="JavaScript">window.location.href="view_successful_stories.php";</script>
<?	
die();
}


function rteSafe($strText) {
	//returns safe code for preloading in the RTE
	$tmpString = $strText;
	
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);
	
	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);
//	$tmpString = str_replace("\"", "\"", $tmpString);
	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	
	return $tmpString;
}

if($_REQUEST['story_id']!=""){
	$sql_in="select * from tbl_successful_stories where auto_id=".$_REQUEST['story_id'];	
	$res_in=mysql_query($sql_in);
	if(mysql_num_rows($res_in)>0){
		$res1=mysql_fetch_object($res_in);
	}	
}

?>
<html>
<head>
<title>Web Control Panel :: Matrmonial shaadi </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">var linkPath="";</script>
<script language="JavaScript" src="../includes/horo_detail.js"></script>

<script language="JavaScript" type="text/javascript" src="includes/validate.js"></script>

<!-- START : Included Script and Styles for Text Editor -->	
<link href="includes/rte.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="includes/richtext.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/html2xhtml.js"></script>
<!-- END : Included Script and Styles for Text Editor -->

<script language="JavaScript">
function Trim(Str){ 
	return Str.replace(/(^\s*)|(\s*$)/g,""); 
}

function fnValidate(){  
	updateRTE('rte1');
	var sMsg;
	sMsg=document.thisForm.rte1.value;
	document.thisForm.description.value=sMsg;
	if(isNull(document.thisForm.txtTitle,"Title")){return false;}
	if(isNull(document.thisForm.txtAuthor,"Author")){return false;}	
	if (notSelected(document.thisForm.cmbBride,"Bride")) { return false; }		
	if (notSelected(document.thisForm.cmbGroom,"Groom")) { return false; }	
	if (isNull(document.thisForm.txtDate,"Date of marriage")){return false;}
	if (isNull(document.thisForm.txtYear,"Year of marriage")){return false;}
	
	if(document.thisForm.txtHidImage.value==""){
		if(isNull(document.thisForm.fileImage,"Image")){return false;}
		if(notImageFile(document.thisForm.fileImage,"Image")){return false;}	
	}else{
		if(document.thisForm.fileImage.value!=""){
			if(notImageFile(document.thisForm.fileImage,"Image")){return false;}	
		}	
			
	}		
 		
	if(document.thisForm.rte1.value==""){
		alert("Please enter the Successful stories description");
		frames['rte1'].focus();
		return false;
	}			
}
</script>
<style type="text/css">
<!--
.text {font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
	color: #02091E;
	text-align: left;
	vertical-align: middle;
}
-->
</style>
</head>
<body>

<!--		Start : Main Table		-->
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%" align="center">
<tr><td width="100%" height="20" colspan="3" align="center"><img src="images/spacer.gif" border="0" height="20"></td></tr>
<tr>
	<td width="20" height="100%"><img src="images/spacer.gif" border="0" width="20"></td>
	<td width="100%" height="100%" valign="top">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%" class="tmain" bordercolor="#000000" style="border:thin;">
		  <!--DWLayoutTable-->
		<tr>
			<td height="68" colspan="3">
				<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
				
				<!-- Start : Header  -->
				<tr><td><script language="JavaScript">fnHeader();</script></td></tr>
				<!-- End : Header  -->
				
				<!-- Start : Menu -->
				<tr><td><script language="JavaScript">fnMenu();</script></td></tr>
				<!-- End : Menu -->
				
				<!-- Start : Title -->
				<tr class="titlebg"><td>
					<table cellpadding="0" cellspacing="0" border="0" width="98%" height="22" align="center">
					<tr>
						<td class="title">Welcome <font class="session"><? echo $_SESSION['_user']?></font></td>
						<td align="right" class="session"><? echo $_SESSION['_msg'];?><? $_SESSION['_msg'] = "";?></td>
					</tr>
					</table>
				</td></tr>
				<!-- End : Title -->
				
				<tr><td><img src="images/spacer.gif" border="0" width="1" height="1"></td></tr>
				
				<!-- Start : Sub Title -->
				<tr class="subtitlebg"><td>
					<table cellpadding="0" cellspacing="0" border="0" width="98%" height="22" align="center">
					  <!--DWLayoutTable-->
					<tr>
						<td width="132" height="22" valign="top" class="subtitle">Astro - Astro Match</td>
						<td width="771" align="right" valign="top"><a href="../astrohoro/updreply.php">Astro Product Download</a> |<a href="Astro_Product_Payment.php">Astro Product Payment</a> | <a href="Astro_Payment.php">Astro Request</a> | <a href="Compare_Horoscope.php">Astro Match </a>| <a href="Create_Horoscope.php">Generate Horoscope</a></td>
 					</tr>
					</table>
				</td></tr>
				<!-- End : Sub Title -->
				
				<tr><td width="100%" height="100%" valign="top" class="contentbg">
				<!-- Start : Table Of Contents -->
				
							
					<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
					<tr><td></td></tr>
					<tr><td align="center" valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="520">
						  <!--DWLayoutTable-->
						<tr><td>&nbsp;</td>
						</tr>
						</table>
				 	</td></tr>
					<tr><td height="10"></td></tr>
			 		</table>
					
			
		 		</td></tr>
	 			</table>							</td>
		</tr>
		<tr>
		  <td width="174" height="33">&nbsp;</td>
		  <td width="599">&nbsp;</td>
		  <td width="148">&nbsp;</td>
		</tr>
		<tr>
		  <td height="146">&nbsp;</td>
		  <td valign="top"><form method="post">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#fccf56" style="border:#8f830d solid 1px; margin-top:5px;">
              <!--DWLayoutTable-->
              <tr>
                <td width="21" height="31">&nbsp;</td>
                <td width="210">&nbsp;</td>
                <td width="124">&nbsp;</td>
                <td width="200">&nbsp;</td>
                <td width="42">&nbsp;</td>
              </tr>
              <tr>
                <td height="375">&nbsp;</td>
                <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#fff6bd" style="border:solid 1px #948036;">
                    <!--DWLayoutTable-->
                    <tr>
                      <td width="10" height="10"></td>
                      <td width="9"></td>
                      <td width="163"></td>
                      <td width="111"></td>
                      <td width="54"></td>
                      <td width="185"></td>
                    </tr>
                    <tr>
                      <td height="15"></td>
                      <td colspan="2" valign="top" class="menup">Bride Details</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="9"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <!--DWLayoutTable-->
                    <tr>
                      <td height="22"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="22" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="22" valign="top" class="text">First Name:</td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><input type="text" name="m_fname" id="m_fname" /></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="22"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="22" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="22" valign="top" class="text">Sur Name:</td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><input type="text" name="m_surname" id="m_surname" /></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="20" valign="top" class="text"><span class="textsmallbold">&nbsp;Date of Birth </span></td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><select name="m_dob_mon" style="width: 100px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="m_dob_mon">
                                      <option value="0" selected="selected">-Month-</option>
                                      <option value="1">January</option>
                                      <option value="2">February</option>
                                      <option value="3">March</option>
                                      <option value="4">April</option>
                                      <option value="5">May</option>
                                      <option value="6" selected="selected">June</option>
                                      <option value="7">July</option>
                                      <option value="8">August</option>
                                      <option value="9">September</option>
                                      <option value="10">October</option>
                                      <option value="11">November</option>
                                      <option value="12">December</option>
                                    </select>
                                      <select name="m_dob_date" style="width: 55px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="m_dob_date">
                                        <option value="0" selected="selected">-Date-</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27" selected="selected">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                      </select>
                                      <select name="m_dob_year" style="width: 55px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="m_dob_year">
                                        <option value="0" selected="selected">-Year-</option>
                                        <option value="2001">2001</option>
                                        <option value="1988">1988</option>
                                        <option value="1987">1987</option>
                                        <option value="1986">1986</option>
                                        <option value="1985">1985</option>
                                        <option value="1984">1984</option>
                                        <option value="1983">1983</option>
                                        <option value="1982">1982</option>
                                        <option value="1981" selected="selected">1981</option>
                                        <option value="1980">1980</option>
                                        <option value="1979">1979</option>
                                        <option value="1978">1978</option>
                                        <option value="1977">1977</option>
                                        <option value="1976">1976</option>
                                        <option value="1975">1975</option>
                                        <option value="1974">1974</option>
                                        <option value="1973">1973</option>
                                        <option value="1972">1972</option>
                                        <option value="1971">1971</option>
                                        <option value="1970">1970</option>
                                        <option value="1969">1969</option>
                                        <option value="1968">1968</option>
                                        <option value="1967">1967</option>
                                        <option value="1966">1966</option>
                                        <option value="1965">1965</option>
                                        <option value="1964">1964</option>
                                        <option value="1963">1963</option>
                                        <option value="1962">1962</option>
                                        <option value="1961">1961</option>
                                        <option value="1960">1960</option>
                                        <option value="1959">1959</option>
                                        <option value="1958">1958</option>
                                        <option value="1957">1957</option>
                                        <option value="1956">1956</option>
                                        <option value="1955">1955</option>
                                        <option value="1954">1954</option>
                                        <option value="1953">1953</option>
                                        <option value="1952">1952</option>
                                        <option value="1951">1951</option>
                                        <option value="1950">1950</option>
                                        <option value="1949">1949</option>
                                        <option value="1948">1948</option>
                                        <option value="1947">1947</option>
                                        <option value="1946">1946</option>
                                        <option value="1945">1945</option>
                                        <option value="1944">1944</option>
                                        <option value="1943">1943</option>
                                        <option value="1942">1942</option>
                                        <option value="1941">1941</option>
                                        <option value="1940">1940</option>
                                        <option value="1939">1939</option>
                                        <option value="1938">1938</option>
                                        <option value="1937">1937</option>
                                        <option value="1936">1936</option>
                                        <option value="1935">1935</option>
                                    </select></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="21"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="21" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="21" valign="top" class="text"><span class="textsmallbold">&nbsp;Time of Birth</span></td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><select name="m_dob_hour" style="width: 50px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="m_dob_hour">
                                      <option value="" selected="selected">Hrs</option>
                                      <option value="01">00</option>
                                      <option value="02" selected="selected">02</option>
                                      <option value="03">03</option>
                                      <option value="04">04</option>
                                      <option value="05">05</option>
                                      <option value="06">06</option>
                                      <option value="07">07</option>
                                      <option value="08">08</option>
                                      <option value="09">09</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                    </select>
                                    &nbsp;&nbsp;
                                    <select name="m_dob_min" style="width: 40px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="m_dob_min">
                                      <option value=""> Min </option>
                                      <option value="00">00</option>
                                      <option value="01">01</option>
                                      <option value="02">02</option>
                                      <option value="03">03</option>
                                      <option value="04">04</option>
                                      <option value="05">05</option>
                                      <option value="06">06</option>
                                      <option value="07">07</option>
                                      <option value="08">08</option>
                                      <option value="09">09</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                      <option value="13">13</option>
                                      <option value="14">14</option>
                                      <option value="15">15</option>
                                      <option value="16">16</option>
                                      <option value="17">17</option>
                                      <option value="18">18</option>
                                      <option value="19">19</option>
                                      <option value="20">20</option>
                                      <option value="21">21</option>
                                      <option value="22">22</option>
                                      <option value="23">23</option>
                                      <option value="24">24</option>
                                      <option value="25">25</option>
                                      <option value="26">26</option>
                                      <option value="27" selected="selected">27</option>
                                      <option value="28">28</option>
                                      <option value="29">29</option>
                                      <option value="30">30</option>
                                      <option value="31">31</option>
                                      <option value="32">32</option>
                                      <option value="33">33</option>
                                      <option value="34">34</option>
                                      <option value="35">35</option>
                                      <option value="36">36</option>
                                      <option value="37">37</option>
                                      <option value="38">38</option>
                                      <option value="39">39</option>
                                      <option value="40">40</option>
                                      <option value="41">41</option>
                                      <option value="42">42</option>
                                      <option value="43">43</option>
                                      <option value="44">44</option>
                                      <option value="45">45</option>
                                      <option value="46">46</option>
                                      <option value="47">47</option>
                                      <option value="48">48</option>
                                      <option value="49">49</option>
                                      <option value="50">50</option>
                                      <option value="51">51</option>
                                      <option value="52">52</option>
                                      <option value="53">53</option>
                                      <option value="54">54</option>
                                      <option value="55">55</option>
                                      <option value="56">56</option>
                                      <option value="57">57</option>
                                      <option value="58">58</option>
                                      <option value="59">59</option>
                                    </select>
                                    &nbsp;&nbsp;
                                    <select name="m_dob_sec" style="width: 40px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="dob_session">
                                      <option value=""> sec </option>
                                      <option value="00">00</option>
                                      <option value="01">01</option>
                                      <option value="02">02</option>
                                      <option value="03">03</option>
                                      <option value="04">04</option>
                                      <option value="05">05</option>
                                      <option value="06">06</option>
                                      <option value="07">07</option>
                                      <option value="08">08</option>
                                      <option value="09">09</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                      <option value="13">13</option>
                                      <option value="14">14</option>
                                      <option value="15">15</option>
                                      <option value="16">16</option>
                                      <option value="17">17</option>
                                      <option value="18">18</option>
                                      <option value="19">19</option>
                                      <option value="20">20</option>
                                      <option value="21">21</option>
                                      <option value="22">22</option>
                                      <option value="23">23</option>
                                      <option value="24">24</option>
                                      <option value="25">25</option>
                                      <option value="26">26</option>
                                      <option value="27" selected="selected">27</option>
                                      <option value="28">28</option>
                                      <option value="29">29</option>
                                      <option value="30">30</option>
                                      <option value="31">31</option>
                                      <option value="32">32</option>
                                      <option value="33">33</option>
                                      <option value="34">34</option>
                                      <option value="35">35</option>
                                      <option value="36">36</option>
                                      <option value="37">37</option>
                                      <option value="38">38</option>
                                      <option value="39">39</option>
                                      <option value="40">40</option>
                                      <option value="41">41</option>
                                      <option value="42">42</option>
                                      <option value="43">43</option>
                                      <option value="44">44</option>
                                      <option value="45">45</option>
                                      <option value="46">46</option>
                                      <option value="47">47</option>
                                      <option value="48">48</option>
                                      <option value="49">49</option>
                                      <option value="50">50</option>
                                      <option value="51">51</option>
                                      <option value="52">52</option>
                                      <option value="53">53</option>
                                      <option value="54">54</option>
                                      <option value="55">55</option>
                                      <option value="56">56</option>
                                      <option value="57">57</option>
                                      <option value="58">58</option>
                                      <option value="59">59</option>
                                    </select></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="20" valign="top" class="text"><span class="textsmallbold">&nbsp;Country</span></td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><select name="m_country" id="m_country" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" >
                                      <option value="India" selected="selected">India</option>
                                  </select></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="20" valign="top" class="text"><span class="textsmallbold">&nbsp;Place of Birth </span></td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><font id="province">
                                    <select name="m_birth_place" id="m_birth_place" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" onChange="cit(this.value)">
                                      <option value="0">-Select-</option>
                                      <?
                          $select_state="select distinct region_name from citydata order by region_name DESC";
						  $result_state=mysql_query($select_state,$link);
						  while($stat=mysql_fetch_array($result_state)){
						  ?>
                                      <option value="<? echo $stat[0]?>"><? echo $stat[0]?></option>
                                      <?
						  }
						  ?>
                                    </select>
                                  </font></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="20" valign="top" class="text"><span class="textsmallbold">&nbsp;City</span></td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><font id="amper">
                                    <select name="m_birth_city" id="m_birth_city" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" onChange="hr(this.value)">
                                      <option value="0">-Select-</option>
                                    </select>
                                  </font></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="20" valign="top" class="text"><span class="textsmallbold">&nbsp;Time Correction</span></td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><select name="m_time_correction" id="m_time_correction"  style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;">
                                      <option value="1">Standard Time</option>
                                      <option value="2">Daylight Saving</option>
                                  </select></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="24"></td>
                      <td></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="80"></td>
                      <td></td>
                      <td colspan="2" valign="top"><div id="datm"></div></td>
                      <td>&nbsp;</td>
                      <td></td>
                    </tr>
                </table></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="14"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td height="374"></td>
                <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#fff6bd" style="border:solid 1px #948036;">
                    <!--DWLayoutTable-->
                    <tr>
                      <td width="10" height="10"></td>
                      <td width="11"></td>
                      <td width="125"></td>
                      <td width="151"></td>
                      <td width="53"></td>
                      <td width="182"></td>
                    </tr>
                    <tr>
                      <td height="18"></td>
                      <td colspan="2" valign="top" class="menup">Groom Details</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="5"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <!--DWLayoutTable-->
                    <tr>
                      <td height="22"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="22" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="22" valign="top" class="text">First Name:</td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><input type="text" name="f_fname" id="f_fname" /></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="22"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="22" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="22" valign="top" class="text">Sur Name:</td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><input type="text" name="f_surname" id="f_surname" /></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="20" valign="top" class="text"><span class="textsmallbold">&nbsp;Date of Birth </span></td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><select name="f_dob_mon" style="width: 100px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="f_dob_mon">
                                      <option value="0" selected="selected">-Month-</option>
                                      <option value="1">January</option>
                                      <option value="2">February</option>
                                      <option value="3">March</option>
                                      <option value="4">April</option>
                                      <option value="5">May</option>
                                      <option value="6" selected="selected">June</option>
                                      <option value="7">July</option>
                                      <option value="8">August</option>
                                      <option value="9">September</option>
                                      <option value="10">October</option>
                                      <option value="11">November</option>
                                      <option value="12">December</option>
                                    </select>
                                      <select name="f_dob_date" style="width: 55px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="f_dob_date">
                                        <option value="0" selected="selected">-Date-</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27" selected="selected">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                      </select>
                                      <select name="f_dob_year" style="width: 55px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="f_dob_year">
                                        <option value="0" selected="selected">-Year-</option>
                                        <option value="2001">2001</option>
                                        <option value="1988">1988</option>
                                        <option value="1987">1987</option>
                                        <option value="1986">1986</option>
                                        <option value="1985">1985</option>
                                        <option value="1984">1984</option>
                                        <option value="1983">1983</option>
                                        <option value="1982">1982</option>
                                        <option value="1981" selected="selected">1981</option>
                                        <option value="1980">1980</option>
                                        <option value="1979">1979</option>
                                        <option value="1978">1978</option>
                                        <option value="1977">1977</option>
                                        <option value="1976">1976</option>
                                        <option value="1975">1975</option>
                                        <option value="1974">1974</option>
                                        <option value="1973">1973</option>
                                        <option value="1972">1972</option>
                                        <option value="1971">1971</option>
                                        <option value="1970">1970</option>
                                        <option value="1969">1969</option>
                                        <option value="1968">1968</option>
                                        <option value="1967">1967</option>
                                        <option value="1966">1966</option>
                                        <option value="1965">1965</option>
                                        <option value="1964">1964</option>
                                        <option value="1963">1963</option>
                                        <option value="1962">1962</option>
                                        <option value="1961">1961</option>
                                        <option value="1960">1960</option>
                                        <option value="1959">1959</option>
                                        <option value="1958">1958</option>
                                        <option value="1957">1957</option>
                                        <option value="1956">1956</option>
                                        <option value="1955">1955</option>
                                        <option value="1954">1954</option>
                                        <option value="1953">1953</option>
                                        <option value="1952">1952</option>
                                        <option value="1951">1951</option>
                                        <option value="1950">1950</option>
                                        <option value="1949">1949</option>
                                        <option value="1948">1948</option>
                                        <option value="1947">1947</option>
                                        <option value="1946">1946</option>
                                        <option value="1945">1945</option>
                                        <option value="1944">1944</option>
                                        <option value="1943">1943</option>
                                        <option value="1942">1942</option>
                                        <option value="1941">1941</option>
                                        <option value="1940">1940</option>
                                        <option value="1939">1939</option>
                                        <option value="1938">1938</option>
                                        <option value="1937">1937</option>
                                        <option value="1936">1936</option>
                                        <option value="1935">1935</option>
                                    </select></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="21"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="21" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="21" valign="top" class="text"><span class="textsmallbold">&nbsp;Time of Birth</span></td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><select name="f_dob_hour" style="width: 50px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="f_dob_hour">
                                      <option value="" selected="selected">Hrs</option>
                                      <option value="01">00</option>
                                      <option value="02" selected="selected">02</option>
                                      <option value="03">03</option>
                                      <option value="04">04</option>
                                      <option value="05">05</option>
                                      <option value="06">06</option>
                                      <option value="07">07</option>
                                      <option value="08">08</option>
                                      <option value="09">09</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                    </select>
                                    &nbsp;&nbsp;
                                    <select name="f_dob_min" style="width: 40px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="f_dob_min">
                                      <option value=""> Min </option>
                                      <option value="00">00</option>
                                      <option value="01">01</option>
                                      <option value="02">02</option>
                                      <option value="03">03</option>
                                      <option value="04">04</option>
                                      <option value="05">05</option>
                                      <option value="06">06</option>
                                      <option value="07">07</option>
                                      <option value="08">08</option>
                                      <option value="09">09</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                      <option value="13">13</option>
                                      <option value="14">14</option>
                                      <option value="15">15</option>
                                      <option value="16">16</option>
                                      <option value="17">17</option>
                                      <option value="18">18</option>
                                      <option value="19">19</option>
                                      <option value="20">20</option>
                                      <option value="21">21</option>
                                      <option value="22">22</option>
                                      <option value="23">23</option>
                                      <option value="24">24</option>
                                      <option value="25">25</option>
                                      <option value="26">26</option>
                                      <option value="27" selected="selected">27</option>
                                      <option value="28">28</option>
                                      <option value="29">29</option>
                                      <option value="30">30</option>
                                      <option value="31">31</option>
                                      <option value="32">32</option>
                                      <option value="33">33</option>
                                      <option value="34">34</option>
                                      <option value="35">35</option>
                                      <option value="36">36</option>
                                      <option value="37">37</option>
                                      <option value="38">38</option>
                                      <option value="39">39</option>
                                      <option value="40">40</option>
                                      <option value="41">41</option>
                                      <option value="42">42</option>
                                      <option value="43">43</option>
                                      <option value="44">44</option>
                                      <option value="45">45</option>
                                      <option value="46">46</option>
                                      <option value="47">47</option>
                                      <option value="48">48</option>
                                      <option value="49">49</option>
                                      <option value="50">50</option>
                                      <option value="51">51</option>
                                      <option value="52">52</option>
                                      <option value="53">53</option>
                                      <option value="54">54</option>
                                      <option value="55">55</option>
                                      <option value="56">56</option>
                                      <option value="57">57</option>
                                      <option value="58">58</option>
                                      <option value="59">59</option>
                                    </select>
                                    &nbsp;&nbsp;
                                    <select name="f_dob_sec" style="width: 40px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="dob_session">
                                      <option value=""> sec </option>
                                      <option value="00">00</option>
                                      <option value="01">01</option>
                                      <option value="02">02</option>
                                      <option value="03">03</option>
                                      <option value="04">04</option>
                                      <option value="05">05</option>
                                      <option value="06">06</option>
                                      <option value="07">07</option>
                                      <option value="08">08</option>
                                      <option value="09">09</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                      <option value="13">13</option>
                                      <option value="14">14</option>
                                      <option value="15">15</option>
                                      <option value="16">16</option>
                                      <option value="17">17</option>
                                      <option value="18">18</option>
                                      <option value="19">19</option>
                                      <option value="20">20</option>
                                      <option value="21">21</option>
                                      <option value="22">22</option>
                                      <option value="23">23</option>
                                      <option value="24">24</option>
                                      <option value="25">25</option>
                                      <option value="26">26</option>
                                      <option value="27" selected="selected">27</option>
                                      <option value="28">28</option>
                                      <option value="29">29</option>
                                      <option value="30">30</option>
                                      <option value="31">31</option>
                                      <option value="32">32</option>
                                      <option value="33">33</option>
                                      <option value="34">34</option>
                                      <option value="35">35</option>
                                      <option value="36">36</option>
                                      <option value="37">37</option>
                                      <option value="38">38</option>
                                      <option value="39">39</option>
                                      <option value="40">40</option>
                                      <option value="41">41</option>
                                      <option value="42">42</option>
                                      <option value="43">43</option>
                                      <option value="44">44</option>
                                      <option value="45">45</option>
                                      <option value="46">46</option>
                                      <option value="47">47</option>
                                      <option value="48">48</option>
                                      <option value="49">49</option>
                                      <option value="50">50</option>
                                      <option value="51">51</option>
                                      <option value="52">52</option>
                                      <option value="53">53</option>
                                      <option value="54">54</option>
                                      <option value="55">55</option>
                                      <option value="56">56</option>
                                      <option value="57">57</option>
                                      <option value="58">58</option>
                                      <option value="59">59</option>
                                    </select></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="20" valign="top" class="text"><span class="textsmallbold">&nbsp;Country</span></td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><select name="f_country" id="f_country" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" >
                                      <option value="India" selected="selected">India</option>
                                  </select></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="20" valign="top" class="text"><span class="textsmallbold">&nbsp;Place of Birth </span></td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><font id="province1">
                                    <select name="f_birth_place" id="f_birth_place" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" onChange="cit(this.value)">
                                      <option value="0">-Select-</option>
                                      <?
                          $select_state="select distinct region_name from citydata order by region_name DESC";
						  $result_state=mysql_query($select_state,$link);
						  while($stat=mysql_fetch_array($result_state)){
						  ?>
                                      <option value="<? echo $stat[0]?>"><? echo $stat[0]?></option>
                                      <?
						  }
						  ?>
                                    </select>
                                  </font></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="20" valign="top" class="text"><span class="textsmallbold">&nbsp;City</span></td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><font id="amper1">
                                    <select name="f_birth_city" id="f_birth_city" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" onChange="hr(this.value)">
                                      <div id="cc">
                                      <option value="0">-Select-</option>
                                      </div>
                                    </select>
                                  </font></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                      <td></td>
                      <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!--DWLayoutTable-->
                          <tr>
                            <td width="100" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="100" height="20" valign="top" class="text"><span class="textsmallbold">&nbsp;Time Correction</span></td>
                                </tr>
                            </table></td>
                            <td width="231" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!--DWLayoutTable-->
                                <tr>
                                  <td width="231" height="20" valign="top"><select name="f_time_correction" id="f_time_correction"  style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;">
                                      <option value="1">Standard Time</option>
                                      <option value="2">Daylight Saving</option>
                                  </select></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="24"></td>
                      <td></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="80"></td>
                      <td></td>
                      <td colspan="2" valign="top"><div id="fdat"></div></td>
                      <td>&nbsp;</td>
                      <td></td>
                    </tr>
                </table></td>
                <td></td>
              </tr>
              <tr>
                <td height="20"></td>
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td height="88"></td>
                <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#fff6bd" style="border:solid 1px #948036;">
                    <!--DWLayoutTable-->
                    <tr>
                      <td width="22" height="20"></td>
                      <td width="183">&nbsp;</td>
                      <td width="327"></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                      <td valign="top" class="text">Language</td>
                            <td valign="top"><select name="language" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="language">
                              <option value="ENG">English</option>
                              <option value="TAM" selected="selected">Tamil</option>
                            </select></td>
                      </tr>
                    <tr>
                      <td height="10"></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <!--DWLayoutTable-->
                    
                    <tr>
                      <td height="20"></td>
                      <td valign="top" class="text">Chart Format</td>
                            <td valign="top"><select name="chart_style" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="chart_style">
                              <option value="0">South Indian</option>
                              <option value="1">North Indian</option>
                              <option value="2">East Indian</option>
                              <option value="3">Kerala</option>
                            </select></td>
                      </tr>
                    <tr>
                      <td height="16"></td>
                      <td></td>
                      <td></td>
                    </tr>
                    
                </table></td>
                <td></td>
              </tr>
              <tr>
                <td height="24"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td></td>
              </tr>
              <tr>
                <td height="28"></td>
                <td>&nbsp;</td>
                <td valign="top"><input name="submit" type="submit" class="butten" id="submit" value="Compare" /></td>
                <td>&nbsp;</td>
                <td></td>
              </tr>
              <tr>
                <td height="32"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td></td>
              </tr>
            </table>
		    </form>
		  </td>
		  <td>&nbsp;</td>
		  </tr>
          <script language=Javascript>
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange(src, val) {
     var req = Inint_AJAX();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
               if (req.status==200) {
                    document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
               } 
          }
     };
     req.open("GET", "test2.php?data="+src+"&val="+val); //สร้าง connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
     req.send(null); //ส่งค่า
}

window.onLoad=dochange('province', -1);  
window.onLoad=dochange('province1', -1);   
                            </script> 
		<tr>
		  <td height="258">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
          
          
         <?
   if($_POST['submit']){
   $m_fname=$_POST['m_fname'];
   $f_fname=$_POST['f_fname'];
   
   $m_surname=$_POST['m_surname'];
   $f_surname=$_POST['f_surname'];
   
   $language=$_POST['language'];
   $chart_style=$_POST['chart_style'];
   $longi=$_POST['longi'];
	$longi_m=$_POST['longi_m'];
	$longi_f="0".$longi.".".$longi_m;
	$longi_d=$_POST['longi_d'];
	$lati=$_POST['lati'];
	$lati_m=$_POST['lati_m'];
	$lati_f=$lati.".".$lati_m;
	$lati_d=$_POST['lati_d'];
	$t_zone=$_POST['t_zone'];
	$longi1=$_POST['longi1'];
	$longi_m1=$_POST['longi_m1'];
	$longi_f1="0".$longi1.".".$longi_m1;
	$longi_d1=$_POST['longi_d1'];
	$lati1=$_POST['lati1'];
	$lati_m1=$_POST['lati_m1'];
	$lati_f1=$lati1.".".$lati_m1;
	$lati_d1=$_POST['lati_d1'];
	$t_zone1=$_POST['t_zone1'];
	$t_zon=substr($t_zone, 0,5);
	$t_zon_d=substr($t_zone, -1);
	$t_zon1=substr($t_zone1, 0,5);
	$t_zon_d1=substr($t_zone1, -1);
	$m_dob_month=$_POST['m_dob_mon'];
	$m_dob_date=$_POST['m_dob_date'];
	$m_dob_year=$_POST['m_dob_year'];
	$m_dob_hour=$_POST['m_dob_hour'];
	$m_dob_min=$_POST['m_dob_min'];
	$m_dob_sec=$_POST['m_dob_sec'];
	$m_country=$_POST['m_country'];
	$m_birth_place=$_POST['m_birth_place'];
	$m_birth_city=$_POST['m_birth_city'];
	$f_dob_month=$_POST['f_dob_mon'];
	$f_dob_date=$_POST['f_dob_date'];
	$f_dob_year=$_POST['f_dob_year'];
	$f_dob_hour=$_POST['f_dob_hour'];
	$f_dob_min=$_POST['f_dob_min'];
	$f_dob_sec=$_POST['f_dob_sec'];
	$f_country=$_POST['f_country'];
	 $f_birth_place=$_POST['f_birth_place'];
	$f_birth_city=$_POST['f_birth_city'];
	$language=$_POST['language'];
	$chart_style=$_POST['chart_style'];
    $m_time=$m_dob_hour.":".$m_dob_min.":".$m_dob_sec;
	$f_time=$f_dob_hour.":".$f_dob_min.":".$f_dob_sec;
	
	$m_dob_h=$m_dob_year."-".$m_dob_month."-".$m_dob_date;
	$f_dob_h=$f_dob_year."-".$f_dob_month."-".$f_dob_date;
	
	
	
	$output .= "<DATA>";
	$output .="<BOYDATA>";
	$output .="<REGNO>-</REGNO>";
	$output .= "<NAME>$m_fname</NAME>";
	$output .= "<DAY>$m_dob_date</DAY>";
	$output .= "<MONTH>$m_dob_month</MONTH>";
	$output .= "<YEAR>$m_dob_year</YEAR>";
	$output .= "<TIME24HR>$m_time</TIME24HR>";
	$output .= "<CORR>1</CORR>";
	$output .= "<PLACE>$m_birth_city</PLACE>";
	$output .= "<LONG>$longi_f</LONG>";
	$output .= "<LAT>$lati_f</LAT>";
	$output .= "<LONGDIR>$longi_d</LONGDIR>";
	$output .= "<LATDIR>$lati_d</LATDIR>";
$output .= "<TZONE>$t_zon</TZONE>";
$output .= "<TZONEDIR>$t_zon_d</TZONEDIR>";
$output .="</BOYDATA>";
$output .="<GIRLDATA>";
$output .="<REGNO>-</REGNO>";
$output .= "<NAME>$f_fname</NAME>";
$output .= "<DAY>$f_dob_date</DAY>";
$output .= "<MONTH>$f_dob_month</MONTH>";
$output .= "<YEAR>$f_dob_year</YEAR>";
$output .= "<TIME24HR>$f_time</TIME24HR>";
$output .= "<CORR>1</CORR>";
$output .= "<PLACE>$f_birth_city</PLACE>";
$output .= "<LONG>$longi_f1</LONG>";
$output .= "<LAT>$lati_f1</LAT>";
$output .= "<LONGDIR>$longi_d1</LONGDIR>";
$output .= "<LATDIR>$lati_d1</LATDIR>";
$output .= "<TZONE>$t_zon1</TZONE>";
$output .= "<TZONEDIR>$t_zon_d1</TZONEDIR>";
$output .="</GIRLDATA>";
$output .="<OPTIONS>";
$output .= "<CUSTID>Admin</CUSTID>";
$output .= "<CHARTSTYLE>$chart_style</CHARTSTYLE>";
$output .= "<LANGUAGE>$language</LANGUAGE>";
$output .= "<REPTYPE>1</REPTYPE>";
$output .= "<PSETTINGS>";
$output .= "<METHOD>S1</METHOD>";
$output .= "<KUJADOSHACHECK>K1</KUJADOSHACHECK>";
$output .= "<PAPASAMYA>P1</PAPASAMYA>";
$output .= "<DASACHECK>D03</DASACHECK>";
$output .= "</PSETTINGS>";
$output .="</OPTIONS>";
$output .="</DATA>";

//echo $insert_com="insert into comparehoro (username,name,surname,dob,time,country,birth_place,city) values('$usr1','$f_fname','$f_surname','$f_dob_h','$f_time','$f_country','$f_birth_place','$f_birth_city')";
//$result_com=mysql_query($insert_com,$link);

echo $insert_match="insert into astromatch (username,name1,surname1,dob1,time1,country1,birth_place1,city1,name2,surname2,dob2,time2,country2,birth_place2,city2) values('Admin','$m_fname','$m_surname','$m_dob_h','$m_time','$m_country','$m_birth_place','$m_birth_city','$f_fname','$f_surname','$f_dob_h','$f_time','$f_country','$f_birth_place','$f_birth_city')";
$result_match=mysql_query($insert_match);
echo mysql_error();
$ourFileName = "sample.xml";
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
fwrite($ourFileHandle, $output);
fclose($ourFileHandle);

//header("Location:http://www.astrovisiononline.com/avservices/horomatch/inserttodb.php?data=$output");

//header("Content-type: text/xml");
//echo nl2br($output);	  
} 		  
   ?>   
		</table>
	</td>
	<td width="20" height="100%"><img src="images/spacer.gif" border="0" width="20"></td>
</tr>
<tr><td width="100%" height="20" colspan="3" align="center"><img src="images/spacer.gif" border="0" height="20"></td></tr>
</table>
<!--		End : Main Table		-->
</body>
</html>
