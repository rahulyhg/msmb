<?php
ob_start();
session_start();
include("includes/lib.php");
$action = GetVar("action");
isMember();
//$d='937cc5926a5ac19d460c2ebe025d6dc7';
// echo base64_decode($d);
$usr1=$_SESSION['userid'];
$select_usr="select username,name,gender from tbl_register where username='$usr1'";
$result_usr=mysql_query($select_usr,$link);
if($val=mysql_fetch_array($result_usr)){
$h_username=$val[0];
$h_name=$val[1];
 $h_gender=$val[2];
}
if($h_gender=="M"){
$h_gen="MALE";
}
if($h_gender=="F"){
$h_gen="FEMALE";
}
$user = GetSingleRecord("tbl_register","username",$config[userinfo][username]);

if (!is_dir("horoscope")) {
	mkdir("horoscope");
	chmod("horoscope",0777);
}	
		
if ($HTTP_POST_FILES['horoscope']['name'] && $action == 'submit') {	
	
	if ($user[horoscope]) { removeFile("horoscope/" . $user[horoscope]); }
	$file = post_img($HTTP_POST_FILES['horoscope']['name'], $HTTP_POST_FILES['horoscope']['tmp_name'],"horoscope");
	$res = Execute("update tbl_register set horoscope = '$file' where id = '" . $config[userinfo][id] . "'");
	?>
	<script language="javascript">
		location.href = 'thanks.php?id=31';
	</script>
	<?
	die();
}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Maa Shakti Marriage Bureau - World Number 1 Maa Shakti Marriage Bureau</title>
<link href="includes/style.css" type="text/css" rel="stylesheet"/>
<link href="includes/payment.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" src="includes/validate.js"></script>
<script language="JavaScript" src="includes/horo_detail.js"></script>
<script language="JavaScript" src="includes/city_detail.js"></script>
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

function fnValidate() {	
	f1 = document.thisForm;
	if (isNull(f1.horoscope,'horoscope')) { return false; }
}
//-->
</script>
</head>
<body class="homeinbody" onLoad="MM_preloadImages('images/menu_assam_ovr.jpg','images/menu_benga_ovr.jpg','images/menu_guja_ovr.jpg','images/menu_hind_ovr.jpg','images/menu_kanad_ovr.jpg','images/menu_malay_ovr.jpg','images/menu_marat_ovr.jpg','images/menu_marw_ovr.jpg','images/menu_punj_ovr.jpg','images/menu_tamil_ovr.jpg','images/menu_telug_ovr.jpg','images/menu_urdu_ovr.jpg')">
<div class="menuleftimg">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="105"><a href="index.php"><img src="images/logo.jpg" vspace="10" border="0"/></a></td>
    <td align="right"><? fnBannerImage(' ','top')  ?></td>
  </tr>
  <tr>
    <td colspan="2" class="homemenu"><? include("includes/menu.php") ?></td>
  </tr>  
  <tr>
    <td colspan="2" valign="top">
	<table width="780" border="0" cellspacing="0" cellpadding="0">
	  <!--DWLayoutTable-->
	  <tr>
		<td width="172" rowspan="5" valign="top"><? include("includes/side_menu.php"); ?></td>
		<td width="16" height="23">&nbsp;</td>
	    <td width="77">&nbsp;</td>
	    <td width="64">&nbsp;</td>
	    <td width="451">&nbsp;</td>
	  </tr>
	  <tr>
	    <td height="279">&nbsp;</td>
	    <td colspan="3" valign="top"><form method="post">
	      <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <!--DWLayoutTable-->
            <tr>
              <td width="363" height="20">&nbsp;</td>
              <td width="3">&nbsp;</td>
              <td width="3">&nbsp;</td>
              <td width="32">&nbsp;</td>
              <td width="168">&nbsp;</td>
              <td width="23">&nbsp;</td>
            </tr>
            <tr>
              <td height="19" colspan="6" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <!--DWLayoutTable-->
                  <tr>
                    <td width="143" height="19" valign="top" class="textsmallbold">&nbsp;Date of Birth </td>
                    <td width="445" valign="top"><select name="dob_mon" style="width: 100px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="dob_mon">
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
                          <option value="27" selected="selected">27</option>
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
                        </select>                    </td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="4"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td height="25" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--DWLayoutTable-->
                <tr>
                  <td height="4" colspan="2" valign="top"><img src="horopage.php_files/trans_003.gif" height="4" width="1" /></td>
                    </tr>
                <tr>
                  <td width="143" height="20" valign="top" class="textsmallbold">&nbsp;Time of Birth</td>
                      <td width="223" valign="top"><select name="dob_hour" style="width: 50px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="dob_hour">
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
                        <select name="dob_min" style="width: 40px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="dob_min">
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
                        <select name="dob_sec" style="width: 40px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="dob_session">
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
                        </select>                    </td>
                    </tr>
                <tr>
                  <td height="1"></td>
                      <td></td>
                      </tr>
              </table></td>
            <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td height="4"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td height="23" colspan="6" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <!--DWLayoutTable-->
                  <tr>
                    <td height="4" colspan="2" valign="top"><img src="horopage.php_files/trans_003.gif" height="4" width="1" /></td>
                  </tr>
                  <tr>
                    <td width="143" height="19" valign="top" class="textsmallbold">&nbsp;Country</td>
                    <td width="445" valign="top">
                        <select name="country" id="country" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" >
                          
                          <option value="87" selected="selected">India</option>
                          
                        </select>
                   </td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="4"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td height="23" colspan="6" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <!--DWLayoutTable-->
                  <tr>
                    <td height="4" colspan="2" valign="top"><img src="horopage.php_files/trans_003.gif" height="4" width="1" /></td>
                  </tr>
                  <tr>
                    <td width="143" height="19" valign="top" class="textsmallbold">&nbsp;Place of Birth </td>
                    <td width="445" valign="top">
                        <font id=province><select name="birth_place" id="birth_place" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" onChange="cit(this.value)">
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
                        </select></font>
                   </td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="4"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td colspan="3" rowspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--DWLayoutTable-->
                <tr>
                  <td height="4" colspan="2" valign="top"><img src="horopage.php_files/trans_003.gif" height="4" width="1" /></td>
                    </tr>
                <tr>
                  <td width="143" height="19" valign="top" class="textsmallbold">&nbsp;City</td>
                      <td width="224" valign="top">
                        <font id=amper><select name="birth_city" id="birth_city" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" onChange="hr(this.value)">
                          <div id="cc"><option value="0">-Select-</option></div>
                         
                          </select></font>
                                                             </td>
                    </tr>
              </table></td>
            <td height="3"></td>
            <td></td>
            <td></td>
            </tr>
            <tr>
              <td height="20"></td>
              <td rowspan="8" valign="top"><div id="hor"></div></td>
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
              <td height="24" colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--DWLayoutTable-->
                <tr>
                  <td height="4" colspan="2" valign="top"><img src="horopage.php_files/trans_003.gif" height="4" width="1" /></td>
                    </tr>
                <tr>
                  <td width="143" height="20" valign="top" class="textsmallbold">&nbsp;Time Correction</td>
                      <td width="223" valign="top"><select name="M_TIMECORRECTION" id="M_TIMECORRECTION"  style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;">
                        <option value="1">Standard Time</option>
                        <option value="2">Daylight Saving</option>
                        </select></td>
                    </tr>
              </table></td>
            <td></td>
              <td></td>
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
              <td height="23" colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--DWLayoutTable-->
                <tr>
                  <td height="4" colspan="2" valign="top"><img src="horopage.php_files/trans_003.gif" height="4" width="1" /></td>
                    </tr>
                <tr>
                  <td width="143" height="19" valign="top" class="textsmallbold">&nbsp;Language</td>
                      <td width="223" valign="top"><select name="language" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="language">
                        <option value="ENG">English</option>
                        <option value="TAM" selected="selected">Tamil</option>
                        <option value="MAL">Malayalam</option>
                        <option value="KAN">Kannada</option>
                        <option value="TEL">Telugu</option>
                        <option value="HIN">Hindi</option>
                        <option value="MAR">Marathi</option>
                        <option value="GUJ">Gujarati</option>
                        <option value="BEN">Bengali</option>
                        </select>                    </td>
                    </tr>
              </table></td>
            <td></td>
              <td></td>
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
              <td height="23" colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--DWLayoutTable-->
                <tr>
                  <td height="4" colspan="2" valign="top"><img src="horopage.php_files/trans_003.gif" height="4" width="1" /></td>
                    </tr>
                <tr>
                  <td width="143" height="19" valign="top" class="textsmallbold">&nbsp;Chart Style</td>
                      <td width="223" valign="top"><select name="chart_style" style="width: 200px; font-family: arial,Verdana,sans-serif; font-size: 8pt;" id="chart_style">
                        <option value="0" selected="selected">South Indian</option>
                        <option value="1">North Indian</option>
                        <option value="2">East Indian</option>
                        <option value="3">Kerala</option>
                        </select>                    </td>
                    </tr>
                <tr>
                  <td height="0"></td>
                      <td></td>
                      </tr>
                
              </table></td>
            <td></td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td colspan="2" rowspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--DWLayoutTable-->
                <tr>
                  <td width="285" height="24">&nbsp;</td>
                      <td width="56" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <!--DWLayoutTable-->
                        <tr>
                          <td width="56" height="24" valign="top"><input type="submit" name="submit" id="submit" value="Submit" /></td>
                          </tr>
                        </table></td>
                      <td width="24">&nbsp;</td>
                    </tr>
              </table></td>
            <td height="18"></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td height="6"></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td height="24"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </table>
	      </form>	    </td>
	    </tr><script language=Javascript>
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
                    document.getElementById(src).innerHTML=req.responseText; //�Ѻ��ҡ�Ѻ��
               } 
          }
     };
     req.open("GET", "test1.php?data="+src+"&val="+val); //���ҧ connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
     req.send(null); //�觤��
}

window.onLoad=dochange('province', -1);     
                            </script> 
	  <tr>
	    <td height="28">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	  </tr>
	  <tr>
	    <td height="30">&nbsp;</td>
	    <td valign="top"><?
		if($_POST['submit']){
		
		
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

$output .="<CUSTID>$h_username</CUSTID>";
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
$output .= "<REPDMN>Shaadi</REPDMN>";

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

$ourFileName = "sample.xml";
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
fwrite($ourFileHandle, $output);
fclose($ourFileHandle);
//header("Content-type: text/xml");
//echo nl2br($output);
		
		header("Location:http://www.astrovisiononline.com/avservices/singlepagehoro/inserttolsdb.php?data=$output");
		}
		else{
		echo "<script language='javascript'>";
		echo "alert(' Please Enter All Necessary Field !');";
		echo "history.back();";
		echo "</script>";
		}
		}
        ?></td>
	    <td valign="top"><a href="add_horoscope_data.php?ds=<? echo $output;?>">fdsdf</a></td>
	    <td>&nbsp;</td>
	  </tr>
	  <tr>
	    <td height="767">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	  </tr>
	</table>
	</td>
  </tr>
  <tr>
  <td colspan="2">
  	<? 
		  		include("includes/fotter.php") ?>
  </td>
  </tr>
</table>
<div>
</body>
</html>
