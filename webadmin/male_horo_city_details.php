<?
include("../includes/lib.php");

if($_GET['dat']!=""){
$dat=$_GET['dat'];

 $select_lon="select longitude_deg,latitude_deg,time_zone,long_dir,lat_dir,longitude_min,latitude_min from citydata where place_name='$dat'";
 $result_lon=mysql_query($select_lon,$link);
 if($lon=mysql_fetch_array($result_lon)){
 $longi=$lon[0];
 $longi_m=$lon[5];
 $lati=$lon[1];
 $lati_m=$lon[6];
 $t_zone=$lon[2];
 $longi_d=$lon[3];
 $lati_d=$lon[4];
 }
?>
<input name="longi" type="hidden" value="<? echo $longi;?>" />
<input name="longi_m" type="hidden" value="<? echo $longi_m;?>" />
<input name="lati" type="hidden" value="<? echo $lati;?>" />
<input name="lati_m" type="hidden" value="<? echo $lati_m;?>" />
<input name="longi_d" type="hidden" value="<? echo $longi_d;?>" />
<input name="lati_d" type="hidden" value="<? echo $lati_d;?>" />
<input name="t_zone" type="hidden" value="<? echo $t_zone;?>" /><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr>
                      <td width="277" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <!--DWLayoutTable-->
                        <tr>
                          <td width="84" height="20" valign="top" class="text_b">Longitude:</td>
                            <td width="64" valign="top" class="text"><? echo $longi; ?></td>
                            <td width="67" valign="top" class="text"><? echo $longi_m; ?></td>
                            <td width="62" valign="top" class="text"><? echo $longi_d; ?></td>
                          </tr>
                                          </table></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                        </tr>
                    <tr>
                      <td height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <!--DWLayoutTable-->
                        <tr>
                          <td width="84" height="20" valign="top" class="text_b">Latitude :</td>
                            <td width="64" valign="top" class="text"><? echo $lati; ?></td>
                            <td width="67" valign="top" class="text"><? echo $lati_m; ?></td>
                            <td width="62" valign="top" class="text"><? echo $lati_d; ?></td>
                          </tr>
                                          </table></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                        </tr>
                    <tr>
                      <td height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <!--DWLayoutTable-->
                        <tr>
                          <td width="85" height="20" valign="top" class="text_b">Timezone</td>
                            <td width="192" valign="top" class="text"><? echo $t_zone; ?></td>
                          </tr>
                                          </table></td>
                    </tr>
                  </table>
                  
                  <?
				  }
				  
				  if($_GET['dat1']!=""){
$dat1=$_GET['dat1'];

 $select_lon1="select longitude_deg,latitude_deg,time_zone,long_dir,lat_dir,longitude_min,latitude_min from citydata where place_name='$dat1'";
 $result_lon1=mysql_query($select_lon1,$link);
 if($lon1=mysql_fetch_array($result_lon1)){
 $longi1=$lon1[0];
 $longi_m1=$lon1[5];
 $lati1=$lon1[1];
 $lati_m1=$lon1[6];
 $t_zone1=$lon1[2];
 $longi_d1=$lon1[3];
 $lati_d1=$lon1[4];
 }
?>
<input name="longi1" type="hidden" value="<? echo $longi1;?>" />
<input name="longi_m1" type="hidden" value="<? echo $longi_m1;?>" />
<input name="lati1" type="hidden" value="<? echo $lati1;?>" />
<input name="lati_m1" type="hidden" value="<? echo $lati_m1;?>" />
<input name="longi_d1" type="hidden" value="<? echo $longi_d1;?>" />
<input name="lati_d1" type="hidden" value="<? echo $lati_d1;?>" />
<input name="t_zone1" type="hidden" value="<? echo $t_zone1;?>" /><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr>
                      <td width="277" height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <!--DWLayoutTable-->
                        <tr>
                          <td width="84" height="20" valign="top" class="text_b">Longitude:</td>
                            <td width="64" valign="top" class="text"><? echo $longi1; ?></td>
                            <td width="67" valign="top" class="text"><? echo $longi_m1; ?></td>
                            <td width="62" valign="top" class="text"><? echo $longi_d1; ?></td>
                          </tr>
                                          </table></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                        </tr>
                    <tr>
                      <td height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <!--DWLayoutTable-->
                        <tr>
                          <td width="84" height="20" valign="top" class="text_b">Latitude :</td>
                            <td width="64" valign="top" class="text"><? echo $lati1; ?></td>
                            <td width="67" valign="top" class="text"><? echo $lati_m1; ?></td>
                            <td width="62" valign="top" class="text"><? echo $lati_d1; ?></td>
                          </tr>
                                          </table></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                        </tr>
                    <tr>
                      <td height="20" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <!--DWLayoutTable-->
                        <tr>
                          <td width="85" height="20" valign="top" class="text_b">Timezone</td>
                            <td width="192" valign="top" class="text"><? echo $t_zone1; ?></td>
                          </tr>
                                          </table></td>
                    </tr>
                  </table>
                  
                  <?
				  }
				  ?>