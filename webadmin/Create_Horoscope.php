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
<script language="JavaScript" src="../includes/city_detail.js"></script>
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
						<td width="202" height="22" valign="top" class="subtitle">Astro - Generate Horoscope</td>
						<td width="701" align="right" valign="top"><a href="../astrohoro/updreply.php">Astro Product Download</a> |<a href="Astro_Product_Payment.php">Astro Product Payment</a> | <a href="Astro_Payment.php">Astro Request</a> | <a href="Compare_Horoscope.php">Astro Match </a>| <a href="Create_Horoscope.php">Generate Horoscope</a></td>
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
		  <td width="162" height="36">&nbsp;</td>
		  <td width="599">&nbsp;</td>
		  <td width="160">&nbsp;</td>
		</tr>
		<tr>
		  <td height="314">&nbsp;</td>
		  <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#fccf56" style="border:#8f830d solid 1px; margin-top:5px;">
              <!--DWLayoutTable-->
              <tr>
                <td width="20" height="18"></td>
                <td width="556"></td>
                <td width="21"></td>
              </tr>
              <tr>
                <td height="267"></td>
                <td valign="top"><form method="post">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#fff6bd" style="border:solid 1px #948036;">
                      <!--DWLayoutTable-->
                      <tr>
                        <td width="339" height="10"></td>
                        <td width="13"></td>
                        <td width="4"></td>
                        <td width="4"></td>
                        <td width="23"></td>
                        <td width="147"></td>
                        <td width="12"></td>
                        <td width="12"></td>
                      </tr>
                      <tr>
                        <td height="10"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td rowspan="9" valign="top"><img src="../images/horo1.jpg" width="138" height="137" /></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="19" colspan="4" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="141" height="19" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="143" height="19" valign="top" class="menup">&nbsp;Name</td>
                                  </tr>
                              </table></td>
                              <td width="221" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="221" height="19" valign="top"><input type="text" name="name" id="name"></td>
                                  </tr>
                                  
                              </table></td>
                            </tr>
                            
                        </table></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="8">&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                        <tr>
                        <td height="19" colspan="4" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="141" height="19" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="143" height="19" valign="top" class="menup">&nbsp;Gender</td>
                                  </tr>
                              </table></td>
                              <td width="221" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="221" height="19" valign="top"><input type="radio" name="gender" id="radio" value="MALE">
                                      Male 
                                      <input type="radio" name="gender" id="radio2" value="FEMALE">
                                      Female</td>
                                  </tr>
                                  
                              </table></td>
                            </tr>
                            
                        </table></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="8">&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                        <tr>
                        <td height="19" colspan="4" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="141" height="19" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="143" height="19" valign="top" class="menup">&nbsp;Date of Birth </td>
                                  </tr>
                              </table></td>
                              <td width="221" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="221" height="19" valign="top"><select name="dob_mon" style="width: 100px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="dob_mon">
                                        <option value="0" selected="selected">-Month-</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                      </select>
                                      <select name="dob_date" style="width: 55px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="dob_date">
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
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                        </select>
                                      <select name="dob_year" style="width: 55px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="dob_year">
                                        <option value="0" selected="selected">-Year-</option>
                                        <option value="2001">2001</option>
                                        <option value="1988">1988</option>
                                        <option value="1987">1987</option>
                                        <option value="1986">1986</option>
                                        <option value="1985">1985</option>
                                        <option value="1984">1984</option>
                                        <option value="1983">1983</option>
                                        <option value="1982">1982</option>
                                        <option value="1981">1981</option>
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
                                      </select>                                    </td>
                                  </tr>
                                  
                              </table></td>
                            </tr>
                            
                        </table></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="8">&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      
                      
                      <tr>
                        <td height="21" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="143" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="143" height="20" valign="top" class="menup">&nbsp;Time of Birth</td>
                                  </tr>
                              </table></td>
                              <td width="207" rowspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="207" height="20" valign="top"><select name="dob_hour" style="width: 50px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="dob_hour">
                                        <option value="" selected="selected">Hrs</option>
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
                                      </select>
                                      &nbsp;&nbsp;
                                      <select name="dob_min" style="width: 40px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="dob_min">
                                        <option value=""> Min </option>
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
                                        <option value="27">27</option>
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
                                      <select name="dob_sec" style="width: 40px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="dob_session">
                                        <option value=""> sec </option>
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
                                        <option value="27">27</option>
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
                                      </select>                                    </td>
                                  </tr>
                                  <tr>
                                    <td height="1"></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="1"></td>
                            </tr>
                        </table></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="8"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="19" colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="143" height="19" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="143" height="19" valign="top" class="menup">&nbsp;Country</td>
                                  </tr>
                              </table></td>
                              <td width="224" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="224" height="19" valign="top"><select name="country" id="country" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" >
                                        <option value="India" selected="selected">India</option>
                                      </select>                                    </td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="8"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="19" colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="143" height="19" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="143" height="19" valign="top" class="menup">&nbsp;Place of Birth </td>
                                  </tr>
                              </table></td>
                              <td width="220" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="220" height="19" valign="top"><font id="province">
                                      <select name="birth_place" id="birth_place" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" onChange="cit(this.value)">
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
                                    </font> </td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      
                      <tr>
                        <td height="6"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="2"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="4" rowspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="143" height="19" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="143" height="19" valign="top" class="menup">&nbsp;City</td>
                                  </tr>
                              </table></td>
                              <td width="223" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="223" height="19" valign="top"><font id="amper">
                                      <select name="birth_city" id="birth_city" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" onChange="hr(this.value)">
                                        <div id="cc">
                                        <option value="0">-Select-</option>
                                        </div>
                                      </select>
                                    </font> </td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                        <td height="9"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="3" rowspan="9" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="168" height="120" valign="top"><div id="hor"></div></td>
                              <td width="21">&nbsp;</td>
                            </tr>
                        </table></td>
                        <td height="10"></td>
                      </tr>
                      <tr>
                        <td height="8"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="20" colspan="4" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="143" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="143" height="20" valign="top" class="menup">&nbsp;Time Correction</td>
                                  </tr>
                              </table></td>
                              <td width="223" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="223" height="20" valign="top"><select name="M_TIMECORRECTION" id="M_TIMECORRECTION"  style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;">
                                        <option value="1">Standard Time</option>
                                        <option value="2">Daylight Saving</option>
                                    </select></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="8"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="19" colspan="4" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="143" height="19" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="143" height="19" valign="top" class="menup">&nbsp;Language</td>
                                  </tr>
                              </table></td>
                              <td width="223" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="223" height="19" valign="top"><select name="language" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="language">
                                        <option value="ENG">English</option>
                                        <option value="TAM" selected="selected">Tamil</option>
                                      </select>                                    </td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="8"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="19" colspan="4" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="143" height="19" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="143" height="19" valign="top" class="menup">&nbsp;Chart Style</td>
                                  </tr>
                              </table></td>
                              <td width="223" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="223" height="19" valign="top"><select name="chart_style" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="chart_style">
                                        <option value="0" selected="selected">South Indian</option>
                                        <option value="1">North Indian</option>
                                        <option value="2">East Indian</option>
                                        <option value="3">Kerala</option>
                                      </select>                                    </td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="0"></td>
                              <td></td>
                            </tr>
                        </table></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="24" colspan="4" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <!--DWLayoutTable-->
                            <tr>
                              <td width="285" height="24">&nbsp;</td>
                              <td width="56" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <!--DWLayoutTable-->
                                  <tr>
                                    <td width="56" height="24" valign="top"><input name="submit" type="submit" class="button" id="submit" value="Submit" /></td>
                                  </tr>
                              </table></td>
                              <td width="24">&nbsp;</td>
                            </tr>
                        </table></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="4"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="6"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>
                </form></td>
                <td></td>
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
                    document.getElementById(src).innerHTML=req.responseText; //&Atilde;&Ntilde;&ordm;&curren;&egrave;&Ograve;&iexcl;&Aring;&Ntilde;&ordm;&Aacute;&Ograve;
               } 
          }
     };
     req.open("GET", "test1.php?data="+src+"&val="+val); //&Ecirc;&Atilde;&eacute;&Ograve;&sect; connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
     req.send(null); //&Ecirc;&egrave;&sect;&curren;&egrave;&Ograve;
}

window.onLoad=dochange('province', -1);     
                            </script>
              <tr>
                <td height="3"></td>
                <td></td>
                <td></td>
              </tr>
              <?
		if($_POST['submit']){
		$h_name=$_POST['name'];
		$h_gen=$_POST['gender'];
		
		$longi=$_POST['longi'];
		$longi_m=$_POST['longi_m'];
		$longi_f="0".$longi.".".$longi_m;
		$longi_d=$_POST['longi_d'];
		
		$lati=$_POST['lati'];
		$lati_m=$_POST['lati_m'];
		$lati_f=$lati.".".$lati_m;
		 $lati_d=$_POST['lati_d'];
		 $t_zone=$_POST['t_zone'];
		
		 $t_zon=substr($t_zone, 0,5);
		 $t_zon_d=substr($t_zone, -1);
		 $dob_month=$_POST['dob_mon'];
		 $dob_date=$_POST['dob_date'];
		 $dob_year=$_POST['dob_year'];
		$dob_hour=$_POST['dob_hour'];
		 $dob_min=$_POST['dob_min'];
		 $dob_sec=$_POST['dob_sec'];
	 $dob_country=$_POST['country'];
		 $birth_place=$_POST['birth_place'];
		 $birth_city=$_POST['birth_city'];
		 $language=$_POST['language'];
		$chart_style=$_POST['chart_style'];
		  $time=$dob_hour.".".$dob_min.".".$dob_sec;


if(($dob_month!="0") && ($dob_date!="0") && ($dob_year!="0") && ($dob_hour!="0") && ($dob_min!="0") && ($dob_sec!="0") && ($dob_country!="0") && ($birth_place!="0") && ($birth_city!="0")){

$output .= "<DATA>";
$output .="<BIRTHDATA>";

$output .="<CUSTID>Admin</CUSTID>";
$output .= "<SEX>$h_gen</SEX>";
$output .= "<NAME>$h_name</NAME>";
$output .= "<DAY>$dob_date</DAY>";
$output .= "<MONTH>$dob_month</MONTH>";
$output .= "<YEAR>$dob_year</YEAR>";
$output .= "<TIME24HR>$time</TIME24HR>";
$output .= "<CORR>1</CORR>";
$output .= "<PLACE>$birth_city</PLACE>";
$output .= "<LONG>$longi_f</LONG>";
$output .= "<LAT>$lati_f</LAT>";
$output .= "<LONGDIR>$longi_d</LONGDIR>";
$output .= "<LATDIR>$lati_d</LATDIR>";
$output .= "<TZONE>$t_zon</TZONE>";
$output .= "<TZONEDIR>$t_zon_d</TZONEDIR>";
$output .="</BIRTHDATA>";

$output .="<OPTIONS>";
$output .= "<CHARTSTYLE>$chart_style</CHARTSTYLE>";
$output .= "<LANGUAGE>$language</LANGUAGE>";
$output .= "<REPTYPE>LS-SP</REPTYPE>";
$output .= "<REPDMN>newindia</REPDMN>";

$output .= "<HSETTINGS>";
$output .= "<AYANAMSA>1</AYANAMSA>";
$output .= "<DASASYSTEM>1</DASASYSTEM>";
$output .= "<GULIKATYPE>1</GULIKATYPE>";
$output .= "<PARYANTHARSTART>0</PARYANTHARSTART>";
$output .= "<PARYANTHAREND>25</PARYANTHAREND>";
$output .= "<FAVMARPERIOD>50</FAVMARPERIOD>";
$output .= "<BHAVABALAMETHOD>1</BHAVABALAMETHOD>";
$output .= "<ADVANCEDOPTION1>0</ADVANCEDOPTION1>";
$output .= "<ADVANCEDOPTION2>0</ADVANCEDOPTION2>";
$output .= "<ADVANCEDOPTION3>0</ADVANCEDOPTION3>";
$output .= "<ADVANCEDOPTION4>0</ADVANCEDOPTION4>";
$output .= "</HSETTINGS>";
$output .="</OPTIONS>";
$output .="</DATA>";


$dob_h=$dob_year."-".$dob_month."-".$dob_date;
$time_h=$dob_hour.":".$dob_min.":".$dob_sec;
$select_hr="select * from astrohoro where username='$h_username'";
$result_hr=mysql_query($select_hr);
if($dat=mysql_fetch_array($result_hr)){
$nos_h=$dat[9];
}


$num_hr=mysql_num_rows($result_hr);
//if($num_hr=="0"){
$ins_hr="insert into astrohoro (username,dob,time,country,birth_place,city,nos) values('Admin','$dob_h','$time_h','$dob_country','$birth_place','$birth_city','1')";
$res_hr=mysql_query($ins_hr);
echo "insert";
$ourFileName = "sample.xml";
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
fwrite($ourFileHandle, $output);
fclose($ourFileHandle);
//header("Content-type: text/xml");
//echo nl2br($output);
header("Location:http://www.astrovisiononline.com/avservices/singlepagehoro/inserttolsdb.php?data=$output");
//}




		
		
		}
		else{
		echo "<script language='javascript'>";
		echo "alert(' Please Enter All Necessary Field !');";
		echo "history.back();";
		echo "</script>";
		}

		}
        ?>
                              </table></td>
		  <td>&nbsp;</td>
		  </tr>
		<tr>
		  <td height="33">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		</table>
	</td>
	<td width="20" height="100%"><img src="images/spacer.gif" border="0" width="20"></td>
</tr>
<tr><td width="100%" height="20" colspan="3" align="center"><img src="images/spacer.gif" border="0" height="20"></td></tr>
</table>
<!--		End : Main Table		-->
</body>
</html>
ob_country','$birth_place','$birth_city','1')";
$res_hr=mysql_query($ins_hr);
echo "insert";
$ourFileName = "sample.xml";
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
fwrite($ourFileHandle, $output);
fclose($ourFileHandle);
//header("Content-type: text/xml");
//echo nl2br($output);
header("Location:http://www.astrovisiononline.com/avservices/singlepagehoro/inserttolsdb.php?data=$output");
//}




		
		
		}
		else{
		echo "<script language='javascript'>";
		echo "alert(' Please Enter All Necessary Field !');";
		echo "history.back();";
		echo "</script>";
		}

		}
        ?>
                              </table></td>
		  <td>&nbsp;</td>
		  </tr>
		<tr>
		  <td height="33">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		</table>
	</td>
	<td width="20" height="100%"><img src="images/spacer.gif" border="0" width="20"></td>
</tr>
<tr><td width="100%" height="20" colspan="3" align="center"><img src="images/spacer.gif" border="0" height="20"></td></tr>
</table>
<!--		End : Main Table		-->
</body>
</html>
